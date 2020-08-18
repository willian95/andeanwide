<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        'App\Events\UserSendIdentityProofEvent' => [
            'App\Listeners\SendToUserTheIndentityProofSubmittedNotificationListener',
            'App\Listeners\SendToAdminTheUserIdentityProofSubmitionNotificationListener'
        ],
        'App\Events\AdminReceiveUserIdentityProofEvent' => [
            'App\Listeners\SendToUserTheReceivementIdentityProofNotificationListener',
        ],
        'App\Events\AdminRejectUserIdentityProofEvent' => [
            'App\Listeners\SendToUserTheRejectionIdentityProofNotificationListener',
        ],
        'App\Events\UserSendAddressProofEvent' => [
            'App\Listeners\SendToUserTheAddressProofSubmittedNotificationListener',
            'App\Listeners\SendToAdminTheUserAddressProofSubmitionNotificationListener',
        ],
        'App\Events\AdminReceiveUserAddressProofEvent' => [
            'App\Listeners\SendToUserTheReceivementAddressProofNotificationListener',
        ],
        'App\Events\AdminRejectUserAddressProofEvent' => [
            'App\Listeners\SendToUserTheRejectionAddressProofNotificationListener',
        ],
        'App\Events\UserSendTicketEvent' => [
            'App\Listeners\SendToUserTheTicketSubmitionNotificationListener',
            'App\Listeners\SendToAdminTheUserTicketSubmitionNotificationListener',
        ],
        'App\Events\AdminSendTicketResponseEvent' => [
            'App\Listeners\SendToUserTheAdminTicketResponseNotificationListener',
        ],
        'App\Events\UserSubmitOrderEvent' => [
            'App\Listeners\SendToUserTheOrderSubmitionNotificationListener',
            'App\Listeners\SendToAdminTheUserOrderSubmitionNotificationListener',
        ],
        'App\Events\UserSubmitPaymentEvent' => [
            'App\Listeners\SendToUserThePaymentSubmitionNotificationListener',
            'App\Listeners\SendToAdminTheUserPaymentSubmitionNotificationListener',
        ],
        'App\Events\AdminPaymentReceiveEvent' => [
            'App\Listeners\SendToUserThePaymentReceiveNotificationListener',
        ],
        'App\Events\AdminPaymentRecjectionEvent' => [
            'App\Listeners\SendToUserThePaymentRejectionNotificationListener',
        ],
        'App\Events\AdminOrderExcecutedEvent' => [
            'App\Listeners\SendToUserTheOrderExcecutedNotificationListener',
        ],
        'App\Events\SendContactEmailEvent'  => [
            'App\Listeners\SendContactEmailToAdminListener',
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
