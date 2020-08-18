<?php

namespace App\Notifications\Admin;

use App\User;
use App\Ticket;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class TicketCreatedNotification extends Notification
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
        $url = route('panel.admin.support.show', [
            'ticket'    => $this->ticket->id
        ]);

        return (new MailMessage)
            ->subject("Un usuario ha generado ticket (" . str_pad($this->ticket->id, 6, 0, STR_PAD_LEFT) . ") para soporte.")
            ->markdown('email.admin.tickets.created', [
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
