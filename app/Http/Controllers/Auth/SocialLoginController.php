<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;

class SocialLoginController extends Controller {
    public function googleRedirect() {
        return Socialite::driver('google')->redirect();
    }

    public function googleCallback() {
        $googleUser = Socialite::driver('google')->user();
        // dd($googleUser);

        //! Check if user already exists or not
        $existingUser = User::where('google_id', $googleUser->id)->first();

        if ($existingUser) {
            //* Log the user in
            Auth::login($existingUser);
            return $this->redirectBasedOnRole();
        } else {
            //! Store user data in session
            Session::put('googleUser', [
                'name'              => $googleUser->name,
                'email'             => $googleUser->email,
                'google_id'         => $googleUser->id,
                'profile_picture'   => $googleUser->avatar,
                'email_verified_at' => $googleUser->user['verified_email'] ? now() : null,
                'terms_accepted'    => true,
            ]);

            //! Redirect to role selection page
            return redirect()->route('selectRole');
        }
    }

    protected function redirectBasedOnRole() {
        $user = Auth::user();

        if ($user->role === 'admin') {
            return redirect('/admin-dashboard');
        } elseif ($user->role === 'trade') {
            return redirect('/trade-dashboard');
        } elseif ($user->role === 'pro') {
            return redirect('/pro-dashboard');
        }

        //! Default redirect for other users
        return redirect('/home');
    }
}
