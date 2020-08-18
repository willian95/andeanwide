<?php

namespace App\Listeners;

use App\Events\AdminReceiveUserIdentityProofEvent;
use App\Notifications\User\IdentityProofReceivedNotification;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendToUserTheReceivementIdentityProofNotificationListener implements ShouldQueue
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
     * @param  AdminReceiveUserIdentityProofEvent  $event
     * @return void
     */
    public function handle(AdminReceiveUserIdentityProofEvent $event)
    {
        $event->user->notify(new IdentityProofReceivedNotification($event->user));
    }
}
