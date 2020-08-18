<?php

namespace App\Listeners;

use App\User;
use App\Events\SendContactEmailEvent;
use App\Notifications\Admin\SendContactMail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendContactEmailToAdminListener
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
     * @param  SendContactEmailEvent  $event
     * @return void
     */
    public function handle(SendContactEmailEvent $event)
    {
        $adminUsers = User::role('admin')->get();
        foreach ($adminUsers as $adminUser) {
            $adminUser->notify(new SendContactMail($event->data));
        }
    }
}
