<?php

namespace App\Http\Controllers\Api\Tread;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Option;
use App\Models\Question;
use App\Models\Subscription;
use App\Models\User;
use App\Models\UserDetail;
use App\Traits\apiresponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    use apiresponse;

    /**
     * Get MY Profile Data
     * @return \Illuminate\Http\Response
     */
    public function myProfile()
    {
        $user = User::where('id', Auth::id())->with('userDetail')->first();

        return $this->success(['user' => $user], "User fetched successfully", 200);
    }

    /**
     * Update My Profile
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function updateMyProfile(Request $request)
    {
        // Validation block
        $validation = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'gender' => 'nullable|string|in:male,female',
            'phone' => 'nullable|string|max:15',
            'address' => 'nullable|string|max:255',
            'about' => 'nullable|string',
        ]);

        // Check for validation errors
        if ($validation->fails()) {
            return $this->error(['error' => $validation->errors()], "Validation error", 422); // Changed status to 422 (Unprocessable Entity)
        }

        try {
            // Retrieve authenticated user
            $user = Auth::user();

            // Update user name if present
            $user->name = $request->input('name');

            // Handle avatar upload
            if ($request->hasFile('avatar')) {
                // You may want to delete the old avatar here to prevent orphan files
                if ($user->avatar) {
                    Helper::fileDelete($user->avatar); // Assuming you have a method to delete files
                }

                $url = Helper::fileUpload($request->file('avatar'), 'users', $user->name . "-" . time());
                $user->avatar = $url;
            }

            // Ensure that user details exist, or create a new UserDetail instance
            $userDetail = $user->userDetail ?: new UserDetail(['user_id' => $user->id]); // Assign the user_id in case it's a new instance

            // Assign the updated data to the user detail model
            $userDetail->phone_number = $request->input('phone');
            $userDetail->gender = $request->input('gender');
            $userDetail->address = $request->input('address');
            $userDetail->bio = $request->input('about');

            // Use transaction to ensure atomicity
            DB::transaction(function () use ($user, $userDetail) {
                // Save user and user details within a transaction to ensure data integrity
                $user->save();
                $user->userDetail()->save($userDetail);
            });

            return $this->success([], "User updated successfully", 200);

        } catch (\Exception $e) {
            // Log the exception for debugging purposes
            Log::error("Profile update error: " . $e->getMessage());
            return $this->error([], "An error occurred while updating the profile.", 500);
        }
    }

    /**
     * Pro Message Controller
     * @return \Illuminate\Http\Response
     */
    public function getAllQuestions()
    {
        $questions = Question::where('category', 'trade')->where('status', 'active')->with('options')->get();
        return $this->success([
            'questions' => $questions,
        ], "Questions fetched successfully", 200);
    }

    public function storeUserAnswers(Request $request)
    {
        // Validation

        DB::beginTransaction();
        try {
            $user = Auth::user();
            $answers = $request->all();

            foreach ($answers as $key => $value) {
                $question = Question::findOrFail($key);

                if ($question && $question->type == 'file') {
                    if ($request->hasFile($key)) {
                        $filePath = Helper::fileUpload($request->file($key), 'answers');
                    }
                    Answer::create([
                        'user_id' => $user->id,
                        'question_id' => $key,
                        'answer_file' => $filePath,
                    ]);
                } elseif ($question && $question->type == 'textarea') {
                    Answer::create([
                        'user_id' => $user->id,
                        'question_id' => $key,
                        'answer_text' => $value,
                    ]);
                } elseif ($question && $question->type == 'checkbox') {
                    foreach ($value as $optionId) {
                        $option = Option::where('option_text', $optionId)->where('question_id', $key)->first();
                        if (!$option) {
                            continue;
                        }

                        Answer::create([
                            'user_id' => $user->id,
                            'question_id' => $key,
                            'option_id' => $option->id,
                        ]);
                    }
                } else {
                    $option = Option::where('option_text', $value)->where('question_id', $key)->first();
                    Answer::create([
                        'user_id' => $user->id,
                        'question_id' => $key,
                        'option_id' => $option->id,
                    ]);
                }

                // User Update
                $user->update(['is_answered' => 1]);
            }

            DB::commit();
            return $this->success([], "Answers stored successfully", 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->error([], $e->getMessage(), 500);
        }

    }

    /**
     * Get Pro User List based on boost and status
     * @return \Illuminate\Http\Response
     */
    public function proProfilesList()
    {
        //! Check if the current trade user is subscribed
        $isSubscribed = Auth::user()->membership();

        if ($isSubscribed) {
            //! Fetch pro users with user details and filter based on subscription status and boost status
            $users = User::with('userDetail','membership')
                ->where('role', 'pro')
                ->orderBy('is_boost', 'desc')
                ->get();
        } else {
            $users = [];
        }

        return $this->success(['users' => $users], "Users fetched successfully", 200);
    }

    /**
     * Get Single User Profile details
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function proProfile(User $user)
    {
        $membership = Auth::user()->membership();
        if (!$membership) {
            return $this->error([], "You need to purchase a subscription to view this profile.", 204);
        }

        //! Check if the authenticated user is a trade user
        if (Auth::check() && Auth::user()->role == 'trade') {
            //! Increment the profile views count
            $membership->increment('profile_views_used');
            $user->increment('profile_views');
        }

        $Limite = Subscription::where('id', $membership->subscription_id)->pluck('view_limit')->first();

        if ($membership->profile_views_used >= $Limite) {
            return $this->error([], "You have exceeded your profile view limit. You need to purchase another subscription to view more profiles.", 202);
        }

        $user->load('userDetail', 'experiences');

        return $this->success(['user' => $user], "User fetched successfully", 200);
    }

}
