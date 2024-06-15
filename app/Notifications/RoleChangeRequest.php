<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RoleChangeRequest extends Notification
{
    
    use Queueable;

    protected $senderEmail;
    protected $senderName;
   

    /**
     * Create a new notification instance.
     *
     * @param string $senderEmail
     * @param string $senderName
     */
    public function __construct($senderEmail, $senderName)
    {
        @dump( $senderEmail);
        $this->senderEmail = $senderEmail;
        $this->senderName = $senderName;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->from($this->senderEmail, $this->senderName)
                    ->line('A user has requested a role change.')
                    ->action('Review Request', url('/role-change-requests'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
