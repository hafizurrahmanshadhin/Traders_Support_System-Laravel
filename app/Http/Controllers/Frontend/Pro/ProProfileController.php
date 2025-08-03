<?php

namespace App\Http\Controllers\Frontend\Pro;

use App\Http\Controllers\Controller;
use App\Models\Experience;
use App\Models\User;
use App\Models\UserDetail;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProProfileController extends Controller {
    public function index() {
        $userDetails = UserDetail::where('user_id', Auth::id())->first();
        return view('frontend.layouts.pro.pro-profile', ['userDetails' => $userDetails]);
    }

    public function UpdateProfile(Request $request) {
        $validator = Validator::make($request->all(), [
            'name'                           => 'nullable|string|max:255',
            'bio'                            => 'nullable|string',
            'description'                    => 'nullable|string',
            'phone_number'                   => 'nullable|string|max:20',
            'languages'                      => 'nullable|string',
            'key_skills'                     => 'nullable|string',
            'industry'                       => 'nullable|string',
            'current_designation'            => 'nullable|string',
            'current_company'                => 'nullable|string',
            'permanent_address'              => 'nullable|string',
            'location'                       => 'nullable|string',
            'qualification'                  => 'nullable|string',
            'address'                        => 'nullable|string',
            'experience'                     => 'nullable|string',
            'experiences.*.company_name'     => 'nullable|string|max:255',
            'experiences.*.designation'      => 'nullable|string|max:255',
            'experiences.*.details'          => 'nullable|string',
            'experiences.*.starting_date'    => 'nullable|date',
            'experiences.*.ending_date'      => 'nullable|date',
            'experiences.*.company_location' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $user       = Auth::user();
            $user->name = $request->input('name');
            $user->save();

            UserDetail::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'phone_number'        => $request->input('phone_number'),
                    'address'             => $request->input('address'),
                    'gender'              => $request->input('gender'),
                    'bio'                 => $request->input('bio'),
                    'description'         => $request->input('description'),
                    'qualification'       => $request->input('qualification'),
                    'current_company'     => $request->input('current_company'),
                    'current_designation' => $request->input('current_designation'),
                    'industry'            => $request->input('industry'),
                    'experience'          => $request->input('experience'),
                    'location'            => $request->input('location'),
                    'languages'           => $request->input('languages'),
                    'key_skills'          => $request->input('key_skills'),
                ]
            );

            $experiences = $request->input('experiences', []);
            foreach ($experiences as $experience) {
                if (!empty($experience['company_name']) || !empty($experience['designation']) || !empty($experience['details']) || !empty($experience['starting_date']) || !empty($experience['ending_date']) || !empty($experience['company_location'])) {
                    $experience['user_id'] = $user->id;
                    Experience::create($experience);
                }
            }

            return redirect()->back()->with('t-success', 'Profile updated successfully');
        } catch (Exception $e) {
            return redirect()->back()->with('t-error', 'Something went wrong: ' . $e->getMessage());
        }
    }

    public function updateExperience(Request $request) {
        $validator = Validator::make($request->all(), [
            'experiences.*.id'               => 'nullable|integer|exists:experiences,id',
            'experiences.*.company_name' => 'nullable|string|max:255',
            'experiences.*.designation'      => 'nullable|string|max:255',
            'experiences.*.details'          => 'nullable|string',
            'experiences.*.starting_date'    => 'nullable|date',
            'experiences.*.ending_date'      => 'nullable|date',
            'experiences.*.company_location' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $user = Auth::user();

            foreach ($request->input('experiences', []) as $exp) {
                if (isset($exp['id'])) {
                    $experience = Experience::find($exp['id']);
                    if ($experience) {
                        $experience->update([
                            'company_name'     => $exp['company_name'],
                            'designation'      => $exp['designation'],
                            'details'          => $exp['details'],
                            'starting_date'    => $exp['starting_date'] ? Carbon::createFromFormat('Y-m-d', $exp['starting_date']) : null,
                            'ending_date'      => $exp['ending_date'] ? Carbon::createFromFormat('Y-m-d', $exp['ending_date']) : null,
                            'company_location' => $exp['company_location'],
                        ]);
                    }
                } else {
                    Experience::create([
                        'user_id'          => $user->id,
                        'company_name'     => $exp['company_name'],
                        'designation'      => $exp['designation'],
                        'details'          => $exp['details'],
                        'starting_date'    => $exp['starting_date'] ? Carbon::createFromFormat('Y-m-d', $exp['starting_date']) : null,
                        'ending_date'      => $exp['ending_date'] ? Carbon::createFromFormat('Y-m-d', $exp['ending_date']) : null,
                        'company_location' => $exp['company_location'],
                    ]);
                }
            }

            return redirect()->back()->with('success', 'Experiences updated successfully');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to update experiences: ' . $e->getMessage());
        }
    }
}
