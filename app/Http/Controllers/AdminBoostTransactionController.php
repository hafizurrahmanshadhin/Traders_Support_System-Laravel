<?php

namespace App\Http\Controllers;

use App\Models\BoostTransaction;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
use PDF;
use Illuminate\Support\Facades\Log;

class AdminBoostTransactionController extends Controller
{
    public function index(Request $request)
    {


        if ($request->ajax()) {

            $data = BoostTransaction::with('user')->latest()->get();
         // Log the data
            // Log::info('BoostTransaction data: ', ['data' => $data]);

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
            //     ->addColumn('action', function ($data) {
            //         return '<div class="btn-group btn-group-sm mb-2" role="group" aria-label="Basic example">
            //     <a href="' .
            //             route('admin.transactions.download', ['id' => $data->id]) .
            //             '" type="button" class="btn btn-primary text-white" title="Download">
            //         Download
            //     </a>
            // </div>';
            //     })
                ->rawColumns(['created_at', 'email', 'name'])
                ->make();
        }


        
        return view('backend.layouts.boostTransaction.index');
    }
}
