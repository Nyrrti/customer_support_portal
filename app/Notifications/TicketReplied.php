<?php

namespace App\Notifications;

use App\Models\Reply;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TicketReplied extends Notification
{
    use Queueable;

    /**
     * Create a new notification for a reply on a ticket.
     *
     * @param Reply $reply The reply that was just added.
     */
    public function __construct(public Reply $reply)
    {
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ["mail"];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $ticket = $this->reply->ticket;

        return (new MailMessage)
            ->subject("New reply on your ticket #{$ticket->id}")
            ->greeting("Hello {$notifiable->first_name},")
            ->line("An administrator has replied to your ticket \"{$ticket->title}\".")
            ->line("Reply: {$this->reply->title}")
            ->action("View ticket", url("/tickets/{$ticket->id}"))
            ->line("Thank you for using our support portal!");
    }
}