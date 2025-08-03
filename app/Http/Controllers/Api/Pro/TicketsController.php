<?php

namespace App\Http\Controllers\Api\Pro;

use App\Models\User;
use App\Models\Reply;
use App\Models\Ticket;
use App\Traits\apiresponse;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notifications\TicketNotification;
use Illuminate\Support\Facades\Validator;
use App\Notifications\TicketReplyNotification;

class TicketsController extends Controller
{
    use apiresponse;
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'type' => 'required|in:subscription,technical,general',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Validation errors',
                    'errors' => $validator->errors(),
                ],
                422,
            );
        }

        try {
            $ticket = Ticket::create([
                'random_ticket_id' => Str::random(10),
                'title' => $request->title,
                'type' => $request->type,
                'email' => $request->email,
                'message' => $request->message,
                'user_id' => auth()->user()->id,
            ]);

            // Notify admin users about the new ticket
            $admins = User::where('role', 'admin')->get();
            foreach ($admins as $admin) {
                $admin->notify(new TicketNotification($ticket));
            }

            return $this->success($ticket, 'Ticket created successfully', 200);
        } catch (\Exception $e) {
            return $this->error(null, $e->getMessage(), 500);
        }
    }

    public function reply(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'content' => 'required|string',
            'ticket_id' => 'required|exists:tickets,id',
        ]);

        if ($validator->fails()) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Validation errors',
                    'errors' => $validator->errors(),
                ],
                422,
            );
        }

        try {
            $reply = Reply::create([
                'content' => $request->content,
                'ticket_id' => $request->ticket_id,
                'user_id' => auth()->user()->id,
                'is_user' =>0,
            ]);

            $user = auth()->user();

            // Check if the user is an admin
            if ($user->role === 'admin') {
                // Notify the user who created the ticket
                $ticket = Ticket::find($request->ticket_id);
                if ($ticket && $ticket->user) {
                    $ticket->user->notify(new TicketReplyNotification($reply));
                }
            } else {
                // Notify admin users
                $admins = User::where('role', 'admin')->get();
                foreach ($admins as $admin) {
                    $admin->notify(new TicketReplyNotification($reply));
                }
            }

            return $this->success($reply, 'Reply submitted successfully', 200);
        } catch (\Exception $e) {
            return $this->error(null, $e->getMessage(), 500);
        }
    }

    public function getTicketDetails($ticket_id)
    {

        $ticket = Ticket::with('replies')->where('id', $ticket_id)->first();

        return $this->success($ticket, 'Ticket Details fetched successfully', 200);
    }

    public function getPendingTicketList(Request $request)
    {
        $user = $request->user()->id;
        $tickets = Ticket::where('user_id', $user)
                         ->where('status', 'pending')
                        ->get();

         return $this->success($tickets, 'Pending Ticket List fetched successfully', 200);
    }

    public function getResolvedTicketList(Request $request)
    {
        $user = $request->user()->id;
        $tickets = Ticket::where('user_id', $user)
                         ->where('status', 'resolved')
                         ->get();

         return $this->success($tickets, 'Resolved Ticket List fetched successfully', 200);
    }
}
