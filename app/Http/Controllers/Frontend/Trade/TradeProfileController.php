<?php
namespace App\Http\Controllers\Frontend\Trade;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TradeProfileController extends Controller {

    public function index(Request $request, User $user) {
        $membership = Auth::user()->membership();

        if (!$membership) {
            return response()->json(['status' => 'error', 'message' => 'Please subscribe to access this page.']);
        }

        if (Auth::check() && Auth::user()->role == 'trade') {
            // $membership->increment('profile_views_used');
            $membership->incrementProfileViewsUsed();
            $user->increment('profile_views');
        }

        $user->load('userDetail', 'experiences');

        if ($request->ajax()) {
            return response()->json(['status' => 'success', 'user' => $user]);
        }

        return view('frontend.layouts.trade.trade-profile', compact('user'));
    }
}
