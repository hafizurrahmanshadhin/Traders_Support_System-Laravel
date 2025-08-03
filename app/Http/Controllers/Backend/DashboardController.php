<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\FAQ;
use App\Models\Subscription;
use App\Models\Testimonial;
use App\Models\Ticket;
use Illuminate\View\View;

class DashboardController extends Controller {
    /**
     * Display the dashboard page.
     *
     * @return View
     */
    public function index() {
        $question     = FAQ::get()->count();
        $testimonial  = Testimonial::get()->count();
        $ticket       = Ticket::get()->count();
        $subscription = Subscription::get()->count();

        return view('backend.layouts.dashboard.dashboard', compact(
            'question',
            'testimonial',
            'ticket',
            'subscription',
        ));
    }
}
