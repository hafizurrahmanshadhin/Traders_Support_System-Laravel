<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class VerifyOtpController extends Controller {
    //! Show the form to request OTP by email
    public function showRequestOtpForm() {
        return view('auth.request_otp');
    }

    //! Send OTP to the email provided
    public function sendOtpToEmail(Request $request) {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'This email is not registered.']);
        }

        // Generate OTP and save it with an expiration time
        $otp                  = rand(1000, 9999);
        $user->otp            = $otp;
        $user->otp_expires_at = Carbon::now()->addMinutes(10);
        $user->save();

        // Send OTP to user's email
        Mail::send('emails.otp', ['otp' => $otp], function ($message) use ($user) {
            $message->to($user->email);
            $message->subject('Your OTP Code');
        });

        return redirect()->route('verify-email')->with('status', 'OTP sent successfully to your email.');
    }

    //! Show the form to verify OTP
    public function showVerifyOtpForm() {
        return view('auth.verify_email');
    }

    //! Verify the OTP entered by the user
    public function verifyOtp(Request $request) {
        $request->validate([
            'otp' => 'required|digits:4',
        ]);

        $user = User::where('otp', $request->otp)
            ->where('otp_expires_at', '>', Carbon::now())
            ->first();

        if ($user) {
            $user->otp               = 0;
            $user->otp_expires_at    = null;
            $user->email_verified_at = Carbon::now();
            $user->save();

            Auth::login($user); // Log in the user after successful OTP verification

            // Redirect based on user role
            switch ($user->role) {
            case 'trade':
                return redirect()->route('trade.dashboard');
            case 'pro':
                return redirect()->route('pro.dashboard');
            default:
                return redirect('/home');
            }
        }

        return back()->withErrors(['otp' => 'Invalid or expired OTP.']);
    }

    //! Resend the OTP
    public function resendOtp() {
        $user = Auth::user();

        $otp                  = rand(1000, 9999);
        $user->otp            = $otp;
        $user->otp_expires_at = Carbon::now()->addMinutes(10);
        $user->save();

        Mail::send('emails.otp', ['otp' => $otp], function ($message) use ($user) {
            $message->to($user->email);
            $message->subject('Your OTP Code');
        });

        return back()->with('status', 'OTP resent successfully.');
    }
}
