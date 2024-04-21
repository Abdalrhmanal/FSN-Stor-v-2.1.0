<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class InternationalsimAdd extends Notification
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
            'message' => 'تمت اضافة تفعيل رقم دولي '. $this->data['serial_number'],
            'serial_number' =>  $this->data['serial_number'],
            'first_image' => $this->data['first_image'],
            'second_image' => $this->data['second_image'],
            'user_id' =>  $this->data['user_id'],
            'internationalSim_id' => '  معرف التحويل : ' . $this->data['internationalSim_id'],
        ];
        // استخراج معرف المستخدم الحالي
        // $userId = $this->data['user_id'];

        // // التحقق من وجود مفتاح "first_image" في $this->data
        // $firstImageValue = isset($this->data['first_image']) ? $this->data['first_image'] : 'قيمة افتراضية';

        // // التحقق من وجود مفتاح "second_image" في $this->data
        // $secondImageValue = isset($this->data['second_image']) ? $this->data['second_image'] : 'قيمة افتراضية';

        // // يمكنك تحديث رسالتك بما يناسبك باستخدام $firstImageValue و $secondImageValue
        // return [
        //     'message' => 'تمت اضافة تفعيل رقم دولي ' . $firstImageValue . $secondImageValue . $this->data['serial_number'],
        //     'user_id' => $userId,
        //     'internationalSim_id' => 'التفعيل الذي قام بالعملية: ' . $this->data['internationalSim_id'],
        // ];
    }




    public function via($notifiable)
    {
        return ['database']; // يجب تضمين القناة 'database' هنا
    }

}
