<?php

namespace App\Notifications\General;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Benwilkins\FCM\FcmMessage;

class FCMNotification extends Notification
{
    use Queueable;
    public $fcm_data;
    public $via_data;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($fcm_data , $via_data =['fcm','database'])
    {
        $this->fcm_data = $fcm_data;
        $this->via_data = $via_data;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
     public function via($notifiable)
     {
         return $this->via_data;
     }

    public function toFcm($notifiable)
    {
        pushFcmNotes($this->fcm_data, [$notifiable->id]);
        // $message = new FcmMessage();
        //
        // $message->setHeaders([
        //             'project_id'    =>  env('FCM_SERVER_ID','389361894218')   // FCM sender_id
        // ])->content($this->fcm_data+['sound' => 'default'])
        //   ->data($this->fcm_data+['sound' => 'default'])
        //   ->priority(FcmMessage::PRIORITY_HIGH);
        // return $message;
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
     public function toArray($notifiable)
     {
         return $this->fcm_data;
     }
}
