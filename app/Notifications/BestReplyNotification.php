<?php

namespace App\Notifications;

use App\Models\Reply;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class BestReplyNotification extends Notification
{
    public function __construct(protected Reply $reply)
    {
        //
    }

    public function via($notifiable): array
    {
        return ['mail'];
    }

    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->line('Your reply was marked as the best answer!');
    }

    public function toArray($notifiable): array
    {
        return [];
    }
}
