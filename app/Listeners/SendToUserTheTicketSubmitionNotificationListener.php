<?php

namespace App\Listeners;

use App\Events\UserSendTicketEvent;
use App\Notifications\User\TicketCreatedNotification;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendToUserTheTicketSubmitionNotificationListener implements ShouldQueue
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
     * @param  UserSendTicketEvent  $event
     * @return void
     */
    public function handle(UserSendTicketEvent $event)
    {
        $event->user->notify(new TicketCreatedNotification($event->user, $event->ticket));
    }
}
