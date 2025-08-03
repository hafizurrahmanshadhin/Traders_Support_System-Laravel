<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminNotificationController extends Controller
{
    public function showNotifications()
    {
        // Retrieve all notifications for the authenticated admin
        $notificationsAdmin = auth()->user()->notifications;

        // Mark all notifications as read
        auth()->user()->unreadNotifications->markAsRead();

        // Pass notifications to the view
        return view('backend.partials.header', compact('notificationsAdmin'));
    }
}
