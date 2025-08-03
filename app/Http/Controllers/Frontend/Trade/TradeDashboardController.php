<?php

namespace App\Http\Controllers\Frontend\Trade;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TradeDashboardController extends Controller
{
    public function index()
    {
        //! Check if the current trade user is subscribed
        $isSubscribed = Auth::user()->membership();

        if ($isSubscribed) {
            //! Fetch pro users with user details and filter based on subscription status and boost status
            $users = User::with('userDetail','membership')
                ->where('role', 'pro')
                ->orderBy('is_boost', 'desc')
                ->get();
        } else {
            $users = [];
        }

        return view('frontend.layouts.trade.trade-dashboard', compact('users'));
    }
}
