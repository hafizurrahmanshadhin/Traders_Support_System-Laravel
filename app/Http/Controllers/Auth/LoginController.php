<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller {
    use AuthenticatesUsers;

    public function login(Request $request) {
        $this->validateLogin($request);

        // Check if the user wants to be remembered
        $remember = $request->has('remember');

        // Attempt to log in
        if ($this->attemptLogin($request, $remember)) {
            $user = Auth::user();

            // Check if the user's email is verified
            if (is_null($user->email_verified_at)) {
                Auth::logout(); // Log out the user

                // Redirect to the OTP verification page with an error message
                return redirect()->route('request.otp')
                    ->withErrors(['email' => 'Please verify your email address before logging in.']);
            }

            return $this->sendLoginResponse($request);
        }

        // If login attempt was unsuccessful
        return $this->sendFailedLoginResponse($request);
    }

    protected function attemptLogin(Request $request, $remember) {
        return $this->guard()->attempt(
            $this->credentials($request), $remember
        );
    }

    protected function redirectTo() {
        $user = Auth::user();

        if ($user->role === 'admin') {
            return '/admin-dashboard';
        } elseif ($user->role === 'trade') {
            return '/trade-dashboard';
        } elseif ($user->role === 'pro') {
            return '/pro-dashboard';
        }

        // Default redirect for other users
        return '/home';
    }

    public function __construct() {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }
}
