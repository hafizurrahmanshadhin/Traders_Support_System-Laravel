<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class RoleSelectionController extends Controller {
    public function showRoleSelection() {
        return view('auth.select-role');
    }

    public function completeRegistration(Request $request) {
        $request->validate([
            'role' => 'required|in:trade,pro',
        ]);

        //! Retrieve user data from session
        $googleUser = Session::get('googleUser');

        //! Create a new user
        $newUser = User::create([
            'name'              => $googleUser['name'],
            'email'             => $googleUser['email'],
            'google_id'         => $googleUser['google_id'],
            'email_verified_at' => $googleUser['email_verified_at'],
            'terms_accepted'    => $googleUser['terms_accepted'],
            'role'              => $request->role,
        ]);

        //! Create user details
        UserDetail::create([
            'user_id'         => $newUser->id,
            'profile_picture' => $googleUser['profile_picture'],
        ]);

        //! Log the new user in
        Auth::login($newUser);

        //! Clear session data
        Session::forget('googleUser');

        return $this->redirectBasedOnRole($newUser);
    }

    protected function redirectBasedOnRole($user) {
        if ($user->role === 'admin') {
            return redirect('/admin-dashboard');
        } elseif ($user->role === 'trade') {
            return redirect('/trade-dashboard');
        } elseif ($user->role === 'pro') {
            return redirect('/pro-dashboard');
        }

        //? Default redirect for other users
        return redirect('/home');
    }
}
