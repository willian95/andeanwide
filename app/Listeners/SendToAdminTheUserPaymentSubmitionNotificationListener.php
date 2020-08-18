<?php

namespace App\Listeners;

use App\User;
use App\Events\UserSubmitPaymentEvent;
use App\Notifications\Admin\PaymentSubmittedByUserNotification;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendToAdminTheUserPaymentSubmitionNotificationListener implements ShouldQueue
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
        $adminUsers = User::role('admin')->get();
        foreach ($adminUsers as $adminUser) {
            $adminUser->notify(new PaymentSubmittedByUserNotification ($event->user, $event->order, $event->payment));
        }
    }
}
