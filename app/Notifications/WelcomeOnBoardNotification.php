<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class WelcomeOnBoardNotification extends Notification
{
    use Queueable;

    public string $tempPass;

    /**
     * Create a new notification instance.
     */
    public function __construct(string $tempPass)
    {
        $this->tempPass = $tempPass;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->greeting('Dear '.$notifiable->name)
            ->line('Welcome on board!')
            ->lineIf($notifiable->email, 'Your email is '.$notifiable->email)
            ->line('Your temp password is '.$this->tempPass)
            ->action('Login', $this->loginUrl())
            ->line('Thank you for using our application!');
    }

    /**
     * Get the reset password URL for the given notifiable.
     *
     * @param  mixed  $notifiable
     * @return string
     */
    protected function loginUrl()
    {
        return config('app.url').'/login';
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
