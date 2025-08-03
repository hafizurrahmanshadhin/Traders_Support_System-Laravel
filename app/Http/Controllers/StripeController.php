<?php

namespace App\Http\Controllers;

use App\Models\Boost;
use App\Models\BoostTransaction;
use App\Models\Membership;
use App\Models\Subscription;
use App\Models\Transection;
use App\Models\User;
use App\Notifications\PaymentSuccessNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Stripe\Checkout\Session as StripeSession;
use Stripe\Stripe;

class StripeController extends Controller {
    // Pro payment controller
    public function payment(Request $request) {
        $subscription = Subscription::find($request->subscription_id);

        Stripe::setApiKey(config('stripe.sk'));

        $redirectUrl = route('stripe.payment.success') . '?session_id={CHECKOUT_SESSION_ID}&subscription_id=' . $subscription->id . '&package_duration=' . $subscription->package_duration;
        $session     = StripeSession::create([
            'payment_method_types' => ['card'],
            'line_items'           => [
                [
                    'price_data' => [
                        'currency'     => 'usd',
                        'product_data' => [
                            'name' => $subscription->package_type,
                        ],
                        'unit_amount'  => $request->price * 100,
                    ],
                    'quantity'   => 1,
                ],
            ],
            'mode'                 => 'payment',
            'success_url'          => $redirectUrl,
            'cancel_url'           => $redirectUrl,
        ]);
        // dd($redirectUrl);
        return redirect()->away($session->url);
    }

    // Trade payment controller
    public function trade_payment(Request $request) {
        $subscription = Subscription::find($request->subscription_id);

        Stripe::setApiKey(config('stripe.sk'));

        $redirectUrl = route('trade.stripe.payment.success') . '?session_id={CHECKOUT_SESSION_ID}&subscription_id=' . $subscription->id . '&package_duration=' . $subscription->package_duration;
        $session     = StripeSession::create([
            'payment_method_types' => ['card'],
            'line_items'           => [
                [
                    'price_data' => [
                        'currency'     => 'usd',
                        'product_data' => [
                            'name' => $subscription->package_type,
                        ],
                        'unit_amount'  => $request->price * 100,
                    ],
                    'quantity'   => 1,
                ],
            ],
            'mode'                 => 'payment',
            'success_url'          => $redirectUrl,
            'cancel_url'           => $redirectUrl,
        ]);
        return redirect()->away($session->url);
    }

    public function boost_payment(Request $request) {
        $boost = Boost::find($request->boost_id);

        Stripe::setApiKey(config('stripe.sk'));

        $redirectUrl = route('stripe.boost.payment.success') . '?session_id={CHECKOUT_SESSION_ID}&boost_id=' . $boost->id;
        $session     = StripeSession::create([
            'payment_method_types' => ['card'],
            'line_items'           => [
                [
                    'price_data' => [
                        'currency'     => 'usd',
                        'product_data' => [
                            'name' => $boost->name,
                        ],
                        'unit_amount'  => $boost->price * 100,
                    ],
                    'quantity'   => 1,
                ],
            ],
            'mode'                 => 'payment',
            'success_url'          => $redirectUrl,
            'cancel_url'           => $redirectUrl,
        ]);
        return redirect()->away($session->url);
    }

    //pro-payment handler
    public function handlePaymentSuccess(Request $request) {
        $session_id      = $request->session_id;
        $subscription_id = $request->subscription_id;
        $subscription    = Subscription::find($subscription_id);
        $user_id         = auth()->id(); // Assuming user is authenticated

        $start_date = Carbon::now();
        $end_date = $start_date->copy()->addDays((int)$subscription->package_duration);

        // Fetch the Stripe session
        Stripe::setApiKey(config('stripe.sk'));
        $session = StripeSession::retrieve($session_id);

        // Check if the payment was successful
        if ($session->payment_status == 'paid') {
            $start_date = Carbon::now();
            // Adjust end_date based on your subscription duration logic
            $end_date = $start_date->copy()->addDays((int)$subscription->package_duration);

            // Ensure only one membership exists per user
            Membership::updateOrCreate(
                [
                    'user_id' => $user_id,
                ],
                [
                    'subscription_id'    => $subscription->id,
                    'start_date'         => $start_date,
                    'end_date'           => $end_date,
                    'profile_views_used' => 0,
                ],
            );

            // Update the user's is_subscribed field to 1
            $user = User::find($user_id);
            $user->update(['is_subscribed' => 1]);

            // Save the transaction details
            Transection::create([
                'user_id'         => $user_id,
                'subscription_id' => $subscription->id,
                'transaction_id'  => $session->payment_intent,
                'payment_status'  => $session->payment_status,
                'amount'          => $session->amount_total / 100, // Stripe amount is in cents
            ]);

            // Notify all admins
            $admins = User::where('role', 'admin')->get();
            foreach ($admins as $admin) {
                $admin->notify(new PaymentSuccessNotification($user, $subscription, $session->amount_total / 100));
            }

            // Redirect to a success page
            // return redirect()->route('pro.frontend.subscription')->with('t-success', 'Payment successfully');
            // Redirect to a success page based on the user's role
            if ($user->role == 'pro') {
                return redirect()->route('pro.dashboard')->with('t-success', 'Payment successfully');
            } elseif ($user->role == 'trade') {
                return redirect()->route('trade.dashboard')->with('t-success', 'Payment successfully');
            } else {
                // Default redirection for other roles, if necessary
                return redirect()->route('home')->with('t-success', 'Payment successfully');
            }
        } else {
            // Handle failed payment
            return redirect()->route('subscription.failed')->with('t-error', 'Paymeny Failed');
        }
    }

    public function handleBoostPaymentSuccess(Request $request) {
        $session_id = $request->session_id;
        $boost_id   = $request->boost_id;
        $boost      = Boost::find($boost_id);
        $user_id    = auth()->id(); // Assuming user is authenticated

        // Fetch the Stripe session
        Stripe::setApiKey(config('stripe.sk'));
        $session = StripeSession::retrieve($session_id);

        // Check if the payment was successful
        if ($session->payment_status == 'paid') {
            // Ensure only one membership exists per user

            // Update the user's is_subscribed field to 1
            // $user = User::find($user_id);
            // $user->update(['is_subscribed' => 1]);

            // Save the transaction details
            BoostTransaction::create([
                'user_id'        => $user_id,
                'boost_id'       => $boost->id,
                'transaction_id' => $session->payment_intent,
                'payment_status' => $session->payment_status,
                'amount'         => $session->amount_total / 100, // Stripe amount is in cents
                'started_at' => Carbon::now(),
                'ended_at' => Carbon::now()->addMinute((int)$boost->package_duration),
            ]);

            // Update the user's is_subscribed field to 1
            $user = User::find($user_id);
            $user->update(['is_boost' => $user->is_boost + 1]);

            // Redirect to a success page
            return redirect()->route('pro.dashboard')->with('t-success', 'Payment successfully');
        } else {
            // Handle failed payment
            return redirect()->route('subscription.failed')->with('t-error', 'Paymeny Failed');
        }
    }

    public function cancel() {
        // Add an error message to the session flash data
        session()->flash('t-error', 'Something went wrong');

        // Redirect to the 'user.buy-tickets' route
        return;
    }
}
