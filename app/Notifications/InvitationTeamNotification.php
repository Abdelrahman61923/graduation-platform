<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class InvitationTeamNotification extends Notification
{
    use Queueable;

    public $user_create;

    /**
     * Create a new notification instance.
     */
    public function __construct($user_create)
    {
        $this->user_create = $user_create;

    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Team', $this->teamUrl())
                    ->line('Thank you for using our application!');
    }

    protected function teamUrl()
    {
        return config('app.url').'/students/my-team';
    }

    public function toDatabase(object $notifiable) {
        $user_create = auth()->user();
        $body = sprintf(
            '%s want to join to the group ',
            $user_create->full_name);
        return [
            'name' => $user_create->full_name,
            'photo' => $notifiable->photo??'https://eu.ui-avatars.com/api/?name="'.$notifiable->full_name.'"',
            'body' => $body,
        ];
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
