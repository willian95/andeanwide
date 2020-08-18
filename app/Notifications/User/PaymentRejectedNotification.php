<?php

namespace App\Notifications\User;

use App\User;
use App\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class PaymentRejectedNotification extends Notification
{
    use Queueable;

    protected $user;
    protected $order;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $user, Order $order)
    {
        $this->user = $user;
        $this->order = $order;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $url = route('panel.user.order.show', [
            'order' => $this->order->id,
        ]);

        return (new MailMessage)
            ->subject("Orden No. " . str_pad($this->order->id, 6, 0, STR_PAD_LEFT) . " rechazada.")
            ->markdown('email.user.payment.rejected', [
                'user'      => $this->user,
                'order'     => $this->order,
                'url'       => $url,
            ]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
