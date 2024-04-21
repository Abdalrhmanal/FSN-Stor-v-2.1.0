<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewTransfer extends Notification
{
    private $data;
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct($data)
    {
        $this->data = $data;
    }
    public function toDatabase($notifiable)
    {

        return [
            'message' => 'اضافة تحويل رصيد عن بعد',
            'balance_code' => $this->data['balance_code'],
            'line_number' => $this->data['line_number'],
            'user_id' =>  $this->data['user_id'],
            'transfer_id' => '  معرف التحويل : ' . $this->data['transfer_id'],
        ];
    }
    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return ['database'];
    }
}
