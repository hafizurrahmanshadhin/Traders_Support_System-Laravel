<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PaymentSuccessNotification extends Notification
{
    use Queueable;

    protected $user;
    protected $subscription;
    protected $amount;

    public function __construct($user, $subscription, $amount)
    {
        $this->user = $user;
        $this->subscription = $subscription;
        $this->amount = $amount;
    }

    public function via($notifiable)
    {
        return ['database'];
    }


    public function toArray($notifiable)
    {
        return [
            'message' => $this->user->name . ' subscribed with the ' . $this->subscription->package_type . ' plan.',
            'amount' => $this->amount,
        ];
    }
}
