<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\apiresponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;




class UserAuthController extends Controller
{
    use apiresponse;

    /**
     * Register a new user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        // Validate incoming request
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ['required', 'string', 'in:trade,pro'],
            'terms_accepted' => ['required', 'accepted'],
            'profession' => ['required', 'string', 'max:255'],
        ], [
            'role.in' => 'Invalid role selected.',
            'terms_accepted.accepted' => 'You must accept the Terms of Service and Privacy Policy.',
        ]);

        if ($validator->fails()) {
            return $this->error([], $validator->errors()->first(), 422);
        }

        // Create new user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'terms_accepted' => $request->terms_accepted == '1',
            'profession' => $request->profession
        ]);

        // Send verification email
        $registerdUser = User::where('id', $user->id)->first();
        if ($registerdUser && $registerdUser->email_verified_at == null) {
            $otp = $user->sendEmailVerificationNotification();
            $registerdUser->update(['otp' => $otp, 'otp_created_at' => now()]);
        }

        // Create token for user
        $token = JWTAuth::fromUser($user);

        return $this->success([
            'user' => $user,
            'email_verified_at' => $registerdUser['email_verified_at'],
            'token' => $token,
        ], 'User successfully registered. Check your email to Varify your email',
            200);
    }

    /**
     * Varify User Otp
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function varifyOtp($otp)
    {
        if (!auth()->check()) {
            return $this->error([], 'Unauthorized User', 404);
        }
        $otpUser = User::where('otp', $otp)->where('id', Auth::user()->id)->where('email_verified_at', null)->first();

        if (!$otpUser) {
            return $this->error([], 'Invalid OTP. Please try again.', 422);
        }

        $user = User::where('otp', $otp)->where('id', Auth::user()->id)->where('email_verified_at', null)->first();
        $otpExpirationTime = now()->subMinutes(10); // Example: OTP is valid for 10 minutes

        // Check if the OTP has expired
        if ($user->otp_created_at < $otpExpirationTime) {
            return $this->error([], 'OTP has expired.', 400);
        }

        // Check if the provided OTP matches the stored OTP
        if ($otp == $user->otp) {
            // Mark the email as verified
            $user->email_verified_at = now();
            $user->otp_created_at = null; // Clear the OTP creation timestamp
            $user->save();
            return $this->success([], 'OTP successfully verified', 200);
        }

        // If the OTP is invalid
        return $this->error([], 'Invalid OTP. Please try again.', 400);
    }

    /**
     * Varify User Otp
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function varifyOtpWithOutAuth(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'otp' => 'required',
            'email' => 'required|email',
        ]);

        if ($validation->fails()) {
            return $this->error([], $validation->errors()->first(), 422);
        }

        $user = User::where('otp', $request->otp)->where('email', $request->email)->first();

        if (!$user) {
            return $this->error([], 'Invalid OTP. Please try again.', 422);
        }
        $otpExpirationTime = now()->subMinutes(10); // Example: OTP is valid for 10 minutes

        // Check if the OTP has expired
        if ($user->otp_created_at < $otpExpirationTime) {
            return $this->error([], 'OTP has expired.', 400);
        }

        // Check if the provided OTP matches the stored OTP
        if ($request->otp == $user->otp) {
            // Mark the email as verified
            $user->email_verified_at = now();
            $user->otp_created_at = null; // Clear the OTP creation timestamp
            $user->save();
            return $this->success([], 'OTP successfully verified', 200);
        }

        // If the OTP is invalid
        return $this->error([], 'Invalid OTP. Please try again.', 400);
    }

    // Resend Otp
    public function resendOtp(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return $this->error([], 'User not found', 404);
        }
        $otp = $user->sendEmailVerificationNotification();
        $user->update(['otp' => $otp, 'otp_created_at' => now()]);
        return $this->success([], 'OTP sent successfully', 200);
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        // Attempt to log the user in
        if (!$token = JWTAuth::attempt($credentials)) {
            return $this->error([], 'Invalid credentials', 400);
        }

        $user = Auth::user();

        // Check if the user's email is verified
        if (is_null($user->email_verified_at)) {
            return $this->error([], 'Please verify your email.', 203);
        }

        return $this->success([
            'token' => $this->respondWithToken($token),
            'role' => $user->role,
            'is_subscribed' => $user->is_subscribed,
            'is_boost' => $user->is_boost,
            'is_verified' => $user->email_verified_at,
            'is_answered' => $user->is_answered
        ], 'User logged in successfully.', 200);
    }

    /**
     * Forget Password Controller
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function forgetPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);
        if ($validator->fails()) {
            return $this->error([], $validator->errors()->first(), 422);
        }
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return $this->error([], 'User not found', 404);
        }

        $otp = $user->PasswordResetNotification();
        $user->update(['otp' => $otp, 'otp_created_at' => now()]);

        return $this->success([], 'Check Your Email for Password Reset Otp', 200);
    }

    /**
     * Reset Password Controller
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function resetPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'otp' => 'required',
            'email' => 'required|email',
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if ($validator->fails()) {
            return $this->error([], $validator->errors()->first(), 422);
        }

        $user = User::where('otp', $request->otp)->where('email', $request->email)->first();
        if (!$user) {
            return $this->error([], 'Invalid OTP. Please try again.', 422);
        }

        $user->update([
            'password' => Hash::make($request->password),
            'otp' => null,
            'otp_created_at' => null,
        ]);
        return $this->success([], 'Password Reset Successfully', 200);

    }

    /**
     * Log out the user (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Get the authenticated user.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return $this->success(['user'=>Auth::user()->load('userDetail')], 'User retrieved successfully', 200);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        try {
            // Refresh the token
            $newToken = JWTAuth::refresh(JWTAuth::getToken());

            return $this->success([
                'access_token' => $newToken,
                'token_type' => 'bearer',
                'expires_in' => auth('api')->factory()->getTTL() * 60
            ], 'Token refreshed successfully', 200);
        } catch (\Exception $e) {
            return $this->error([], $e->getMessage(), 400);
        }
    }



    /**
     * Get Token
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ]);
    }

}
