<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\SendWelcomeNotification;
use App\Models\Notification;
use Illuminate\Support\Facades\Log;

class UserCreateListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(SendWelcomeNotification $event)
    {
        $event = $event->getAttribute('user');
        Notification::create([
           'title' => 'Chào mừng' ,
            'content' => 'Chào mừng bạn'.$event->name.' đến với '.config('app.name'),
            'type' => 'welcome',
            'user_id' => auth()->id()
        ]);
    }
}
