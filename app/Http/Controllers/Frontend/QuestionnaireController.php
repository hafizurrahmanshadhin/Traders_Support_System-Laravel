<?php

namespace App\Http\Controllers\Frontend;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class QuestionnaireController extends Controller {
    public function index(Request $request) {
        $role      = $request->user()->role;
        $questions = Question::with('options')->where('category', $role)->get();
        return view('frontend.layouts.questions', compact('questions'));
    }

    public function tradeQuestion() {
        $questions = Question::with('options')->get();
        return view('frontend.layouts.trade.trade-questions', compact('questions'));
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'question_*'      => 'required|array',
            'question_*.file' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'question_*.text' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user    = Auth::user();
        $answers = $request->all();

        foreach ($answers as $key => $value) {
            if (strpos($key, 'question_') === 0) {
                $questionId = str_replace('question_', '', $key);
                $question   = Question::find($questionId);

                if ($question->type == 'file') {
                    if ($request->hasFile($key)) {
                        $filePath = Helper::fileUpload($request->file($key), 'answers');
                    }
                    Answer::create([
                        'user_id'     => $user->id,
                        'question_id' => $questionId,
                        'answer_file' => $filePath,
                    ]);
                } elseif ($question->type == 'textarea') {
                    Answer::create([
                        'user_id'     => $user->id,
                        'question_id' => $questionId,
                        'answer_text' => $value,
                    ]);
                } else {
                    foreach ($value as $optionId) {
                        Answer::create([
                            'user_id'     => $user->id,
                            'question_id' => $questionId,
                            'option_id'   => $optionId,
                        ]);
                    }
                }
            }
        }

        // if ($user->role == 'pro') {
        //     return redirect()->route('pro.dashboard');
        // } elseif ($user->role == 'trade') {
        //     return redirect()->route('trade.dashboard');
        // } else {
        //     return redirect()->route('home');
        // }

        return redirect()->route('verify-email');
    }
}
