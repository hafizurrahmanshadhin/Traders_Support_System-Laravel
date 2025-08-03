<?php

namespace App\Http\Controllers\Backend\Ticket;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class TicketController extends Controller {
    public function index(Request $request) {
        if ($request->ajax()) {
            $data = Ticket::with('user')->latest();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('name', function ($data) {
                    $name = $data->user->name;

                    return $name;
                })
                ->addColumn('status', function ($data) {
                    $status = '<div  style="display: flex;justify-content: center;margin-bottom: 8px;">';

                    // Dropdown HTML
                    $status .= '<select class="form-select" onchange="updateStatus(' . $data->id . ', this.value)" style="width: 120px;">';
                    $status .= '<option value="pending"' . ($data->status == 'pending' ? ' selected' : '') . '>Pending</option>';
                    $status .= '<option value="rejected"' . ($data->status == 'rejected' ? ' selected' : '') . '>Rejected</option>';
                    $status .= '<option value="resolved"' . ($data->status == 'resolved' ? ' selected' : '') . '>Resolved</option>';
                    $status .= '</select>';
                    $status .= '</div>';

                    return $status;
                })
                ->addColumn('action', function ($data) {
                    return '<div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                              <a href="' .
                    route('admin.ticket.show', ['id' => $data->id]) .
                        '" type="button" class="btn btn-info text-white" title="View">
                     <i class="bi bi-eye"></i>
                 </a>
                            </div>';
                })
                ->rawColumns(['name', 'status', 'action'])
                ->make();
        }
        return view('backend.layouts.ticket.index');
    }

    public function updateStatus(Request $request) {
        $ticket = Ticket::find($request->id);

        if (!$ticket) {
            return response()->json(['t-error' => 'Status not found'], 404);
        }

        $ticket->status = $request->status;
        $ticket->save();

        return response()->json(['message' => 'Status updated successfully'], 200);
    }

    public function show($id) {
        $ticket = Ticket::with('replies.user')->find($id);
        //dd($ticket);

        if (!$ticket) {
            return response()->json(['error' => 'Ticket not found'], 404);
        }

        return view('backend.layouts.ticket.view', compact('ticket'));
    }
}
