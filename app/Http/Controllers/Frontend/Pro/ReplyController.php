<?php

namespace App\Http\Controllers\Frontend\Pro;

use App\Http\Controllers\Controller;
use App\Models\Reply;
use App\Models\Ticket;
use App\Models\User;
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

        $reply->save();
        // Notify the user who replied
        //auth()->user()->notify(new TicketReplyNotification($reply));

        // Notify admin users
        // $admins = User::where('role', 'admin')->get();
        // foreach ($admins as $admin) {
        //     $admin->notify(new TicketReplyNotification($reply));
        // }

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
        return redirect('/pro-help')->with('success', 'Reply Submitted Successfully');
    }
}
