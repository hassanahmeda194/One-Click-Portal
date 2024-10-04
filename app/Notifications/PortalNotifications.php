<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;

class PortalNotifications extends Notification
{
    use Queueable;
    protected $NotificationData;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($NotificationData)
    {
        //
        $this->NotificationData = $NotificationData;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via(mixed $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
//    public function toMail($notifiable): MailMessage
//    {
//        return (new MailMessage)
//                    ->line('The introduction to the notification.')
//                    ->action('Notification Action', url('/'))
//                    ->line('Thank you for using our application!');
//    }

// ========================Old Before probation work =============================
    // public function toDatabase(mixed $notifiable): array
    // {
    //     $currentUser = Auth::guard('Authorized')->user();
    //     return [
    //         'Order_ID' => $this->NotificationData['Order_ID']?? null,
    //         'Role_Name' => $this->NotificationData['Role_Name']?? null,
    //         'Emp_ID' => $this->NotificationData['Emp_ID']?? null,
    //         'Message' => $this->NotificationData['Message'],
    //         'Play_Sound' => true,
    //         'sender_user_id' => $currentUser->id,
    //     ];
     
    // }
    
// ========================Old Before probation work =============================
public function toDatabase(mixed $notifiable): array
    {

        if($this->NotificationData['Order_ID'] == "PROBATION"){

            $currentUser = 1;
        }else{
            $currentUser = Auth::guard('Authorized')->user()->id;
        }


        return [
            'Order_ID' => $this->NotificationData['Order_ID']?? null,
            'Role_Name' => $this->NotificationData['Role_Name']?? null,
            'Emp_ID' => $this->NotificationData['Emp_ID']?? null,
            'Message' => $this->NotificationData['Message'],
            'Play_Sound' => true,
            'sender_user_id' => $currentUser,
        ];

    }
    

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray(mixed $notifiable): array
    {
        return [
            //
        ];
    }
}
