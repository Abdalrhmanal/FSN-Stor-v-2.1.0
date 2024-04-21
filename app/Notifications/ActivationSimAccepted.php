<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ActivationSimAccepted extends Notification
{
    private $data;

    public function __construct($data)
    {
        $this->data = $data['message'];
    }



    public function toArray($notifiable)
    {
        return [
            'message' => $this->data,
        ];
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' =>  'رد الادمن  : '.$this->data,
            'user_id' => $notifiable->id, // Assuming user ID should be included
        ];
    }

    // Add the via method
    public function via($notifiable)
    {
        return ['database']; // Adjust as needed
    }
}
