<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ActivationSimeAdd extends Notification
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
            'message' => 'تمت إضافة تفعيل سيم جديد. الرقم التسلسلي: ' ,
            'serial_number' => $this->data['serial_number'],
            'user_id' =>  $this->data['user_id'],
            'activation_id' => 'التفعيل الذي قام بالعملية: ' . $this->data['activation_id'],
        ];
    }



    public function via($notifiable)
    {
        return ['database']; // يجب تضمين القناة 'database' هنا
    }

}
