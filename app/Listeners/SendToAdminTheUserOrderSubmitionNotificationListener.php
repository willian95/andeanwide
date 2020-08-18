<?php

namespace App\Listeners;

use App\User;
use App\Events\UserSubmitOrderEvent;
use App\Notifications\Admin\OrderSubmittedByUserNotification;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendToAdminTheUserOrderSubmitionNotificationListener implements ShouldQueue
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
        $adminUsers = User::role('admin')->get();
        foreach ($adminUsers as $adminUser) {
            $adminUser->notify(new OrderSubmittedByUserNotification($event->user, $event->order));
        }
    }
}
