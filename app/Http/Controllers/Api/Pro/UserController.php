<?php

namespace App\Http\Controllers\Api\Pro;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Boost;
use App\Models\BoostTransaction;
use App\Models\MyImages;
use App\Models\Option;
use App\Models\Question;
use App\Models\Transection;
use App\Models\User;
use App\Models\UserDetail;
use App\Traits\apiresponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    use apiresponse;

    // Update User Information
    /**
     * Update user primary info
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function updateUserInfo(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'profession' => 'required|string|max:255',
        ]);

        if ($validation->fails()) {
            return $this->error([], $validation->errors(), 500);
        }

        try
        {
            $user = User::where('id', Auth::id())->first();
            $user->name = $request->name;
            $user->profession = $request->profession;
            if ($request->hasFile('avatar')) {
                $url = Helper::fileUpload($request->file('avatar'), 'users', $user->name . "-" . time());
                $user->avatar = $url;
            }

            $user->save();
            return $this->success([], "User updated successfully", 200);
        } catch (\Exception $e) {
            return $this->error([], $e->getMessage(), 500);
        }
    }

    /**
     * Change Password
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function changePassword(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'old_password' => 'required|string|max:255',
            'new_password' => 'required|string|max:255|confirmed',
        ]);

        if ($validation->fails()) {
            return $this->error([], $validation->errors(), 500);
        }

        try
        {
            $user = User::where('id', Auth::id())->first();
            if (password_verify($request->old_password, $user->password)) {
                $user->password = Hash::make($request->new_password);
                $user->save();
                return $this->success([], "Password changed successfully", 200);
            } else {
                return $this->error([], "Old password is incorrect", 500);
            }
        } catch (\Exception $e) {
            return $this->error([], $e->getMessage(), 500);
        }
    }

    /**
     * Change additional info
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function changeAdditionalInfo(Request $request)
    {
        $validation = Validator::make($request->all(), [
            "phone" => "required|string|max:15",
            "address" => "required|string|max:255",
        ]);

        if ($validation->fails()) {
            return $this->error([], $validation->errors(), 500);
        }

        try {
            // Get the authenticated user
            $user = User::find(Auth::id());

            // Ensure that user details exist, or create a new UserDetail instance
            $userDetail = $user->userDetail ?: new UserDetail();

            // Assign the updated data to the user detail model
            $userDetail->phone_number = $request->phone;
            $userDetail->gender = $request->gender;
            $userDetail->address = $request->address;

            // Associate the user detail with the user and save it
            $user->userDetail()->save($userDetail);

            return $this->success([], "User updated successfully", 200);
        } catch (\Exception $e) {
            return $this->error([], $e->getMessage(), 500);
        }
    }

    /**
     * Get All my images
     * @return \Illuminate\Http\Response
     */
    public function getMyImages()
    {
        $user = Auth::user();
        $images = $user->myImages()->latest()->get();
        return $this->success([
            'images' => $images,
        ], "Images fetched successfully", 200);
    }

    /**
     * Change Bio and current job additional info
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function changeBioCurrentJobInfo(Request $request)
    {
        $validation = Validator::make($request->all(), [
            "bio" => "required|string",
            "current_company" => "required|string|max:255",
            "location" => "required|string|max:255",
            "current_designation" => "required|string|max:255",
            "industry" => "required|string|max:255",
        ]);

        if ($validation->fails()) {
            return $this->error([], $validation->errors(), 500);
        }

        try {
            // Get the authenticated user
            $user = User::find(Auth::id());

            // Ensure that user details exist, or create a new UserDetail instance
            $userDetail = $user->userDetail ?: new UserDetail();

            // Assign the updated data to the user detail model
            $userDetail->bio = $request->bio;
            $userDetail->current_company = $request->current_company;
            $userDetail->location = $request->location;
            $userDetail->current_designation = $request->current_designation;
            $userDetail->industry = $request->industry;

            // Associate the user detail with the user and save it
            $user->userDetail()->save($userDetail);

            return $this->success([], "User updated successfully", 200);
        } catch (\Exception $e) {
            return $this->error([], $e->getMessage(), 500);
        }
    }

    /**
     * Change key skill info
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function changeKeySkillJobInfo(Request $request)
    {
        $validation = Validator::make($request->all(), [
            "key_skills" => "required|string|max:255",
            "languages" => "required|string|max:255",
        ]);

        if ($validation->fails()) {
            return $this->error([], $validation->errors(), 500);
        }

        try {
            // Get the authenticated user
            $user = User::find(Auth::id());

            // Ensure that user details exist, or create a new UserDetail instance
            $userDetail = $user->userDetail ?: new UserDetail();

            // Assign the updated data to the user detail model
            $userDetail->key_skills = $request->key_skills;
            $userDetail->languages = $request->languages;

            // Associate the user detail with the user and save it
            $user->userDetail()->save($userDetail);

            return $this->success([], "User updated successfully", 200);
        } catch (\Exception $e) {
            return $this->error([], $e->getMessage(), 500);
        }
    }

    /**
     * Pro Message Controller
     * @return \Illuminate\Http\Response
     */
    public function getAllQuestions()
    {
        $questions = Question::where('category', 'pro')->where('status', 'active')->with('options')->get();
        return $this->success([
            'questions' => $questions,
        ], "Questions fetched successfully", 200);
    }

    /**
     * Pro deshboard Information
     * @return \Illuminate\Http\Response
     */
    public function getDeshboardProUserInfo()
    {

        $boosts = Boost::all();
        $user = Auth::user()->load(['userDetail', 'experiences', 'myImages']);
        $boostTransactionsCount = BoostTransaction::where('user_id', Auth::id())->count();
        $images = $user->images;

        return $this->success([
            'user' => $user,
            'boosts' => $boosts,
            'connect' => $user->myConnectionsForPro()->count(),
            'boostTransactionsCount' => $boostTransactionsCount,
        ], "User fetched successfully", 200);
    }

    /**
     * Stre User Question's Answers
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
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
     * Store User Multiple Images
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function storeUserImages(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validation->fails()) {
            return $this->error([], $validation->errors(), 500);
        }
        try {
            $user = User::where('id', Auth::id())->first();

            foreach ($request->images as $key => $value) {
                $url = Helper::fileUpload($value, 'users', $user->name . "-" . $key . "-" . time());
                $user->myImages()->create([
                    'image' => $url,
                ]);
            }

            return $this->success([], "Images stored successfully", 200);
        } catch (\Exception $e) {
            return $this->error([], $e->getMessage(), 500);
        }
    }

    /**
     * Delete User Image
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function deleteUserImage(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'image_id' => 'required|exists:my_images,id',
        ]);

        if ($validation->fails()) {
            return $this->error([], $validation->errors(), 500);
        }

        $image = MyImages::where('id', $request->image_id)->where('user_id', Auth::id())->first();
        if ($image) {
            // Check File Exist
            if (File::exists(public_path($image->first()->image))) {
                File::delete(public_path($image->first()->image));
            }
            $image->delete();
            return $this->success([], "Image deleted successfully", 200);
        }else{
            return $this->error([], "Image not found", 500);
        }

    }

    /**
     * Get My Notifications
     * @return \Illuminate\Http\Response
     */
    public function getMyNotifications()
    {
        $user = Auth::user();
        $notifications = $user->notifications()->latest()->get();
        return $this->success([
            'notifications' => $notifications,
        ], "Notifications fetched successfully", 200);
    }

    /**
     * Get My Payment History
     * @return \Illuminate\Http\Response
     */
    public function getMyPeyments()
    {
        $payments = Transection::where('user_id', Auth::id())->latest()->get();
        return $this->success([
            'payments' => $payments,
        ], "Payments fetched successfully", 200);
    }

}
