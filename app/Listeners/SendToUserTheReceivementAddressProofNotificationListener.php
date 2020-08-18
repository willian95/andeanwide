<?php

namespace App\Listeners;

use App\Events\AdminReceiveUserAddressProofEvent;
use App\Notifications\User\AddressProofReceivedNotification;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendToUserTheReceivementAddressProofNotificationListener implements ShouldQueue
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
     * @param  AdminReceiveUserAddressProofEvent  $event
     * @return void
     */
    public function handle(AdminReceiveUserAddressProofEvent $event)
    {
        $event->user->notify(new AddressProofReceivedNotification($event->user));
    }
}
