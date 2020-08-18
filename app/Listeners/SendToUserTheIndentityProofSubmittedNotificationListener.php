<?php

namespace App\Listeners;

use App\Events\UserSendIdentityProofEvent;
use App\Notifications\User\IdentityProofSubmittedNotification;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendToUserTheIndentityProofSubmittedNotificationListener implements ShouldQueue
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
     * @param  UserSendIdentityProofEvent  $event
     * @return void
     */
    public function handle(UserSendIdentityProofEvent $event)
    {
        $event->user->notify(new IdentityProofSubmittedNotification($event->user));
    }
}
