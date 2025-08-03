<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Question;

class JoinController extends Controller {
    public function index() {
        // $questions = Question::where('category', 'register')->with('options')->where('status', 'active')->get();
        $question = Question::where('category', 'register')
            ->where('status', 'active')
            ->with('options')
            ->first();
        return view('auth.join', compact('question'));
    }
}
