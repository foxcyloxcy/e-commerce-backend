<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewCommentUserNotification extends Notification
{
    use Queueable;

    protected $subject;
    protected $mailBlade;
    protected $data;
    protected $identifier;

    /**
     * Create a new notification instance.
     */
    public function __construct($data, $identifier)
    {
        $this->subject = env('APP_NAME') . ' Item Comment';
        $this->mailBlade = 'mail.content.new_comment';
        $this->data = $data;
        $this->identifier = $identifier;
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
                    ->subject($this->subject)
                    ->view($this->mailBlade, [
                        'user' => $notifiable,
                        'data' => $this->data,
                        'identifier' => $this->identifier
                    ]);
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
