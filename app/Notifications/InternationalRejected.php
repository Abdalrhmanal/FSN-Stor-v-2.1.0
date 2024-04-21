<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class InternationalRejected extends Notification
{
    use Queueable;
    private $data; // أضف هذه الخاصية

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }
    public function toDatabase($notifiable)
    {
        return [
            'message' => ' تم رفض طلب تفعيل خط دولي الخاص بك. رسالة الأدمن: ' . $this->data['message'],
        ];
    }
    /**
     * Create a new notification instance.
     */


    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */

    /**
     * Get the mail representation of the notification.
     */


    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function via($notifiable)
    {
        return ['database']; // Adjust as needed
    }
}
