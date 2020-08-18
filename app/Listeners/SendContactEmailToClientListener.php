<?php

namespace App\Listeners;

use App\Events\SendContactEmailEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendContactEmailToClientListener
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
        //
    }
}
