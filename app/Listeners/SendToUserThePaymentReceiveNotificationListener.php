<?php

namespace App\Listeners;

use App\Events\AdminPaymentReceiveEvent;
use App\Notifications\User\PaymentReceivedNotification;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendToUserThePaymentReceiveNotificationListener implements ShouldQueue
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
     * @param  AdminPaymentReceiveEvent  $event
     * @return void
     */
    public function handle(AdminPaymentReceiveEvent $event)
    {
        $event->user->notify(new PaymentReceivedNotification($event->user, $event->order));
    }
}
