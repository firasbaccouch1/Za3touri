<?php

namespace App\Notifications;

use Carbon\Carbon;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;

class allNotifications extends Notification
{
   
public $title;
  

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($title)
    {
      $this->title = $title;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray()
    {
        return [
            'title'=> $this->title,
            'user'=> Auth::guard('admin')->user()->name,
            'photo'=> Auth::guard('admin')->user()->photo,
            'created_at'=> Carbon::now(),
        ];
    }
}
