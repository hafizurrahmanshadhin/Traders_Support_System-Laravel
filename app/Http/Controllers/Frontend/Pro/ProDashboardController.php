<?php

namespace App\Http\Controllers\Frontend\Pro;

use App\Http\Controllers\Controller;
use App\Models\Boost;
use App\Models\BoostTransaction;
use Illuminate\Support\Facades\Auth;

class ProDashboardController extends Controller {
    public function index() {
        $boost                 = Boost::first(); 
        $user                   = Auth::user()->load(['userDetail', 'experiences']);
        $boostTransactionsCount = BoostTransaction::where('user_id', Auth::id())->count();

        return view('frontend.layouts.pro.pro-dashboard', compact('user', 'boost', 'boostTransactionsCount'));
    }
}
