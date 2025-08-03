<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VerifiedEmailMiddleware {
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next) {
        $user = Auth::user();

        if ($user && is_null($user->email_verified_at)) {
            // If email is not verified, log out the user and redirect to the OTP verification page
            Auth::logout();
            return redirect()->route('verify-email')->withErrors([
                'email' => 'You need to verify your email address before accessing this page.',
            ]);
        }

        return $next($request);
    }
}
