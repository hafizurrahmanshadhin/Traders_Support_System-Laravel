<?php

namespace App\Http\Controllers\Backend\Reply;

use App\Http\Controllers\Controller;
use App\Models\Reply;
use App\Models\Ticket;
use App\Notifications\TicketReplyNotification;
use Illuminate\Http\Request;

class ReplyController extends Controller
{
    public function store(Request $request)
    {
        $reply = new Reply();
        $reply->content = $request->content;
        $reply->ticket_id = $request->ticket_id;
        $reply->user_id = auth()->user()->id;
        $reply->is_user=1;


        $reply->save();

        // Check if the user is an admin
        $user = auth()->user();
        if ($user->role === 'admin') {
            // Notify the user who created the ticket
            $ticket = Ticket::find($request->ticket_id);
            if ($ticket && $ticket->user) {
                $ticket->user->notify(new TicketReplyNotification($reply));
            }
        }
        return redirect()->back()->with('success', 'Reply Submitted Successfully');
    }
}
