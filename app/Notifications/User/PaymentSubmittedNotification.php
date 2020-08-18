<?php

namespace App\Notifications\User;

use App\Order;
use App\Payment;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class PaymentSubmittedNotification extends Notification
{
    use Queueable;

    protected $user;
    protected $order;
    protected $payment;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $user, Order $order, Payment $payment)
    {
        $this->user = $user;
        $this->order = $order;
        $this->payment = $payment;
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
            ->subject("Hemos recibido un pago para la orden " . str_pad($this->order->id, 6, 0, STR_PAD_LEFT) . ".")
            ->markdown('email.user.payment.created', [
                'user'      => $this->user,
                'order'     => $this->order,
                'payment'   => $this->payment,
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
