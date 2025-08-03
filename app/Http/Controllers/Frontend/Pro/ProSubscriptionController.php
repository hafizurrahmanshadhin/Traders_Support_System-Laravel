<?php

namespace App\Http\Controllers\Frontend\Pro;

use App\Http\Controllers\Controller;
use App\Models\Subscription;
use Illuminate\Http\Request;

class ProSubscriptionController extends Controller
{
    public function index() {
        $subscriptions=Subscription::where('user_type','pro')
            ->where('status','active')
            ->get();
        return view('frontend.layouts.pro.pro-subscription',compact('subscriptions'));
    }
}
