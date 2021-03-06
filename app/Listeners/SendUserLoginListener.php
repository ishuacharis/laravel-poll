<?php

namespace App\Listeners;

use App\Events\LoginEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Notifications\UserLoginNotification;
use Illuminate\Notifications\Notifiable;
use App\Jobs\UserLoginJob;

class SendUserLoginListener
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
     * @param  \App\Events\LoginEvent
     * @return void
     */
    public function handle(LoginEvent $event)
    {
        $event->user->notify((new UserLoginNotification($event->user))
        ->delay(now()->addMinutes(2)));
    }
}
