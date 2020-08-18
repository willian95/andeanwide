<?php

namespace App\Listeners;

use App\Events\AdminOrderExcecutedEvent;
use App\Notifications\User\PaymentCompleteddNotification;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendToUserTheOrderExcecutedNotificationListener implements ShouldQueue
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
     * @param  AdminOrderExcecutedEvent  $event
     * @return void
     */
    public function handle(AdminOrderExcecutedEvent $event)
    {
        $event->user->notify(new PaymentCompleteddNotification($event->user, $event->order));
    }
}
