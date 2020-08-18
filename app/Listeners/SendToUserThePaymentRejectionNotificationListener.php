<?php

namespace App\Listeners;

use App\Events\AdminPaymentRecjectionEvent;
use App\Notifications\User\PaymentRejectedNotification;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendToUserThePaymentRejectionNotificationListener implements ShouldQueue
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
     * @param  AdminPaymentRecjectionEvent  $event
     * @return void
     */
    public function handle(AdminPaymentRecjectionEvent $event)
    {
        $event->user->notify(new PaymentRejectedNotification($event->user, $event->order));
    }
}
