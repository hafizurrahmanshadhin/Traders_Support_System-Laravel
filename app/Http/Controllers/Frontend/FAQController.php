<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\FAQ;

class FAQController extends Controller {
    public function index() {
        $faqs = FAQ::where('status', 'active')->get();
        return view('frontend.layouts.faq', compact('faqs'));
    }
}
