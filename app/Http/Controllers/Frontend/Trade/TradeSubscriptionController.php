<?php

namespace App\Http\Controllers\Frontend\Trade;

use App\Http\Controllers\Controller;
use App\Models\Subscription;

class TradeSubscriptionController extends Controller {
    public function index() {
        $subscriptions = Subscription::where('user_type', 'trade')->where('status', 'active')->get();
        return view('frontend.layouts.trade.trade-subscription', compact('subscriptions'));
    }
}
