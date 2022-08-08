<?php

namespace App\Listeners;

use App\Events\Verified;
use App\Notifications\VerifyUserNotification;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class SendUserVerifyNotification
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
     * @param  object Registered $event
     * @return void
     */
    public function handle(Verified $event)
    {
        Notification::send($event->getUser(), new VerifyUserNotification($event->getUser()->id, $event->getToken()));
    }
}
