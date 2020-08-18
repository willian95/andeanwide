<?php

namespace App\Listeners;

use App\Events\UserSendAddressProofEvent;
use App\Notifications\User\AddressProofSubmittedNotification;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendToUserTheAddressProofSubmittedNotificationListener implements ShouldQueue
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
     * @param  UserSendAddressProofEvent  $event
     * @return void
     */
    public function handle(UserSendAddressProofEvent $event)
    {
        $event->user->notify(new AddressProofSubmittedNotification($event->user));
    }
}
