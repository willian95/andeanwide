<?php

namespace App\Listeners;

use App\User;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\UserSendIdentityProofEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Notifications\Admin\UserIdentityProofSubmittedNotification as AdminUserIdentityProofSubmittedNotification;

class SendToAdminTheUserIdentityProofSubmitionNotificationListener implements ShouldQueue
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
        $adminUsers = User::role('admin')->get();
        foreach ($adminUsers as $adminUser) {
            $adminUser->notify(new AdminUserIdentityProofSubmittedNotification($event->user));
        }
    }
}
