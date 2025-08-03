<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\BoostTransaction;
use App\Models\Transection;
use Illuminate\Http\Request;

class SettingController extends Controller {
    public function index() {

        $user         = auth()->user();
        $transactions = Transection::with('user')->where('user_id', $user->id)->latest()->get();
        $boostTransactions = BoostTransaction::with('user')->where('user_id', $user->id)->latest()->get();

        return view('frontend.layouts.settings', compact('transactions','boostTransactions'));
    }

    public function storePaymentMethod(Request $request) {
        $data = $request->validate([
            'card-holder' => 'required|string',
            'card-number' => 'required|string',
            'cvc'         => 'required|string',
            'expiry'      => 'required|string',
        ]);

        // Store data in session
        session(['paymentMethod' => $data]);

        // Redirect back or to another page as needed
        return back()->with('t-success', 'Payment method added successfully.');
    }
}
