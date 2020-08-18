<?php

namespace App\Listeners;

use App\User;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\UserSendAddressProofEvent;
use App\Notifications\Admin\AddressProofSubmittedNotification;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendToAdminTheUserAddressProofSubmitionNotificationListener implements ShouldQueue
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
        $adminUsers = User::role('admin')->get();
        foreach ($adminUsers as $adminUser) {
            $adminUser->notify(new AddressProofSubmittedNotification($event->user));
        }
    }
}
