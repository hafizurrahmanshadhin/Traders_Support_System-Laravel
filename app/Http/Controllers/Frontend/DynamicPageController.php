<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\DynamicPage;

class DynamicPageController extends Controller {
    public function index(string $page_slug) {
        $pageData = DynamicPage::where('status', 'active')->where("page_slug", $page_slug)->first();
        return view('frontend.layouts.dynamic_page', compact('pageData'));
    }
}
