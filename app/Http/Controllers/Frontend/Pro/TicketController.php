<?php

namespace App\Http\Controllers\Frontend\Pro;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Models\User;
use App\Notifications\TicketNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TicketController extends Controller {
    public function index() {
        $user    = auth()->user()->id;
        $tickets = Ticket::with('replies.user')->where('user_id', $user)->get();
        return view('frontend.layouts.pro.prohelpsupport', compact('tickets'));
    }

    public function store(Request $request) {
        $this->validate($request, [
            'title'   => 'required|string|max:255',
            'email'   => 'required|string|email|max:255',
            'message' => 'required|string',
            'type'    => 'required|in:subscription,technical,general',
        ]);

        $ticket                   = new Ticket();
        $ticket->random_ticket_id = Str::random(10);
        $ticket->title            = $request->title;
        $ticket->email            = $request->email;
        $ticket->type             = $request->type;
        $ticket->message          = $request->message;
        $ticket->user_id          = auth()->user()->id;
        $ticket->is_user          = 1;
        $ticket->save();

        // Notify admin users
        $admins = User::where('role', 'admin')->get();
        foreach ($admins as $admin) {
            $admin->notify(new TicketNotification($ticket));
        }
        return redirect('/pro-help')->with('success', 'Ticket Submitted Successfully');
    }
}
