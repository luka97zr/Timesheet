<?php

namespace App\Listeners;

use App\Events\UpdatePassword;
use App\Notifications\VerifyUserNotification;
use Illuminate\Support\Facades\Notification;

class SendUserVerifyNotification
{
    protected $eventName;
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
    public function handle(UpdatePassword $event)
    {
        Notification::send($event->getUser(), new VerifyUserNotification($event->getUser()->id, $event->getToken()));
    }
}
