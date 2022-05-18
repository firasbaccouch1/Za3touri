<?php

namespace App\Events;

use Carbon\Carbon;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class NotificatonRecieved implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $connection = 'sync';
    public $title;
    /**
     * Create a new event instance.
     *
     * @return void
     */
   
    public function __construct($title)
    {
        $this->title = $title;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastNow()
    {
        return true;
    }
    public function broadcastOn()
    {
        return new Channel('Notification');
    }

    public function broadcastWith()
    {
        return [
            'title' =>$this->title,
            'user' => Auth::guard('admin')->user()->name,
            'photo' => Auth::guard('admin')->user()->photo,
            'created_at'=>Carbon::now(),
        ];
    }
}
