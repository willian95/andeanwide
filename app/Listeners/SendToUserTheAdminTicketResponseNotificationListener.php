<?php

namespace App\Listeners;

use App\Events\AdminSendTicketResponseEvent;
use App\Notifications\User\TicketResponseNotification;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendToUserTheAdminTicketResponseNotificationListener implements ShouldQueue
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
     * @param  AdminSendTicketResponseEvent  $event
     * @return void
     */
    public function handle(AdminSendTicketResponseEvent $event)
    {
        $event->user->notify(new TicketResponseNotification($event->user, $event->ticket));
    }
}
