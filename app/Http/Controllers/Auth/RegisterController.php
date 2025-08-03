<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller {
    use RegistersUsers;

    public function __construct() {
        $this->middleware('guest');
    }

    protected function validator(array $data) {
        return Validator::make($data, [
            'name'           => ['required', 'string', 'max:255'],
            'email'          => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password'       => ['required', 'string', 'min:8', 'confirmed'],
            'role'           => ['required', 'string', 'in:trade,pro'],
            'terms_accepted' => ['required', 'accepted'],
        ], [
            'role.in'                 => 'Invalid role selected.',
            'terms_accepted.accepted' => 'You must accept the Terms of Service and Privacy Policy.',
        ]);
    }

    protected function create(array $data) {
        $user = User::create([
            'name'           => $data['name'],
            'email'          => $data['email'],
            'password'       => Hash::make($data['password']),
            'role'           => $data['role'],
            'terms_accepted' => $data['terms_accepted'] == '1',
        ]);

        // Generate OTP
        $otp                  = rand(1000, 9999);
        $user->otp            = $otp;
        $user->otp_expires_at = Carbon::now()->addMinutes(10);
        $user->save();

        // Send OTP to user's email
        Mail::send('emails.otp', ['otp' => $otp], function ($message) use ($user) {
            $message->to($user->email);
            $message->subject('Your OTP Code');
        });

        // Store the user's answer
        if (!empty($data['question_id']) && !empty($data['answer_text'])) {
            Answer::create([
                'user_id'     => $user->id,
                'question_id' => $data['question_id'],
                'option_id'   => $data['option_id'],
                'answer_text' => $data['answer_text'],
            ]);
        }

        return $user;
    }

    protected function registered(Request $request, $user) {
        switch ($user->role) {
        case 'trade':
            return redirect()->route('trade.questionnaires');
        case 'pro':
            return redirect()->route('questionnaires');
        default:
            return redirect('/home');
        }
    }
}
