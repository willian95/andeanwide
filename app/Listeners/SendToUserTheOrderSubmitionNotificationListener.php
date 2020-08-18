<?php

namespace App\Listeners;

use App\Events\UserSubmitOrderEvent;
use App\Notifications\User\OrderSubmittedNotification;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendToUserTheOrderSubmitionNotificationListener implements ShouldQueue
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
     * @param  UserSubmitOrderEvent  $event
     * @return void
     */
    public function handle(UserSubmitOrderEvent $event)
    {
        $event->user->notify(new OrderSubmittedNotification($event->user, $event->order));
    }
}
