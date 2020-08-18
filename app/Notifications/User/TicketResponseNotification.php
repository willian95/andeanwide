<?php

namespace App\Notifications\User;

use App\Ticket;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class TicketResponseNotification extends Notification
{
    use Queueable;

    protected $user;
    protected $ticket;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $user, Ticket $ticket)
    {
        $this->user = $user;
        $this->ticket = $ticket;
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
        $url = route('panel.support.show', [
            'ticket'    => $this->ticket->id
        ]);

        return (new MailMessage)
            ->subject("Respuesta: Ticket No. " . str_pad($this->ticket->id, 6, 0, STR_PAD_LEFT))
            ->markdown('email.user.tickets.response', [
                'user'      => $this->user,
                'ticket'    => $this->ticket,
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
