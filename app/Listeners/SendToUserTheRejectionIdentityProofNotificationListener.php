<?php

namespace App\Listeners;

use App\Events\AdminRejectUserIdentityProofEvent;
use App\Notifications\User\IdentityProofRejectedNotification;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendToUserTheRejectionIdentityProofNotificationListener implements ShouldQueue
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
     * @param  AdminRejectUserIdentityProofEvent  $event
     * @return void
     */
    public function handle(AdminRejectUserIdentityProofEvent $event)
    {
        $event->user->notify(new IdentityProofRejectedNotification($event->user, $event->reasons));
    }
}
