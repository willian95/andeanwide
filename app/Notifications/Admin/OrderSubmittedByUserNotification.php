<?php

namespace App\Notifications\Admin;

use App\Order;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class OrderSubmittedByUserNotification extends Notification
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
        $url = route('panel.admin.orders.show', [
            'order' => $this->order->id,
        ]);

        return (new MailMessage)
            ->subject("Un usuario generado una nueva Orden No. " . str_pad($this->order->id, 6, 0, STR_PAD_LEFT) . " para envío de dinero.")
            ->markdown('email.admin.orders.created_by_user', [
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
