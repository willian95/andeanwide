<?php

namespace App\Listeners;

use App\Events\AdminRejectUserAddressProofEvent;
use App\Notifications\User\AddressProofRejectedNotification;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendToUserTheRejectionAddressProofNotificationListener implements ShouldQueue
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
     * @param  AdminRejectUserAddressProofEvent  $event
     * @return void
     */
    public function handle(AdminRejectUserAddressProofEvent $event)
    {
        $event->user->notify(new AddressProofRejectedNotification($event->user, $event->reasons));
    }
}
