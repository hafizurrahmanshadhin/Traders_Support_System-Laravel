<?php

namespace App\Http\Controllers;
use App\Models\Subscription;
use App\Models\Transection;
use App\Models\User;
use PDF;

use Illuminate\Http\Request;

class TransactionController extends Controller
{


    public function downloadReceipt($id)
    {
        // Fetch the transaction details
        $transaction = Transection::findOrFail($id);
        $user = User::findOrFail($transaction->user_id);
        $subscription = Subscription::findOrFail($transaction->subscription_id);

        // Calculate the subscription dates
        $start_date = $transaction->created_at;
        $end_date = $start_date->copy()->addDays((int) $subscription->package_duration);
        
        // Generate the PDF
        $pdf = PDF::loadView('pdf.receipt', compact('transaction', 'user', 'subscription', 'start_date', 'end_date'));

        // Return the generated PDF to the browser for download
        return $pdf->download('receipt-' . $transaction->transaction_id . '.pdf');
    }
}
