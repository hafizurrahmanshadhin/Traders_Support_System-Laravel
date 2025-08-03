<?php

namespace App\Http\Controllers\Backend\transaction;

use App\Http\Controllers\Controller;
use App\Models\Subscription;
use App\Models\Transection;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
use PDF;

class AdminTransactionController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Transection::with('user')->latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('created_at', function ($data) {
                    $formattedDate = Carbon::parse($data->created_at)->format('d/m/Y');
                    return '<p>' . $formattedDate . '</p>';
                })
                ->addColumn('name', function ($data) {
                    if ($data->user) {
                        return $data->user->name;
                    } else {
                        return 'User Not Available';
                    }
                })
                ->addColumn('email', function ($data) {
                    if ($data->user) {
                        return $data->user->email;
                    } else {
                        return 'User Not Available';
                    }
                })
                ->addColumn('action', function ($data) {
                    return '<div class="btn-group btn-group-sm mb-2" role="group" aria-label="Basic example">
                <a href="' .
                        route('admin.transactions.download', ['id' => $data->id]) .
                        '" type="button" class="btn btn-primary text-white" title="Download">
                    Download
                </a>
            </div>';
                })
                ->rawColumns(['created_at','action','email','name'])
                ->make();
        }
        return view('backend.layouts.transaction.index');
    }

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
