<?php

namespace App\Listeners;

use App\User;
use App\Events\UserSendTicketEvent;
use App\Notifications\Admin\TicketCreatedNotification;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendToAdminTheUserTicketSubmitionNotificationListener implements ShouldQueue
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
     * @param  UserSendTicketEvent  $event
     * @return void
     */
    public function handle(UserSendTicketEvent $event)
    {
        $adminUsers = User::role('admin')->get();
        foreach ($adminUsers as $adminUser) {
            $adminUser->notify(new TicketCreatedNotification($event->user, $event->ticket));
        }
    }
}
