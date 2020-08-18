<?php

namespace App\Listeners;

use App\Events\UserSubmitPaymentEvent;
use App\Notifications\User\PaymentSubmittedNotification;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendToUserThePaymentSubmitionNotificationListener implements ShouldQueue
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
     * @param  UserSubmitPaymentEvent  $event
     * @return void
     */
    public function handle(UserSubmitPaymentEvent $event)
    {
        $event->user->notify(new PaymentSubmittedNotification($event->user, $event->order, $event->payment));
    }
}
