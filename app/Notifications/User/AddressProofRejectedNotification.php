<?php

namespace App\Notifications\User;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class AddressProofRejectedNotification extends Notification
{
    use Queueable;

    protected $user;
    protected $reasons;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $user, $reasons)
    {
        $this->user = $user;
        $this->reasons = $reasons;
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
        $url = route('panel.user.verify');
        return (new MailMessage)
            ->subject('La verificación (Nivel 2) fue rechazada')
            ->markdown('email.user.verification.address_rejected', [
                'user'      => $this->user,
                'reasons'   => $this->reasons,
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
