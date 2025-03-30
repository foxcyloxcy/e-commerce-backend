<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ItemSoldNonAuth extends Notification
{
    use Queueable;

    protected $subject;
    protected $mailBlade;

    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
        $this->subject = env('APP_NAME') . ' Item Sold';
        $this->mailBlade = 'mail.content.item_sold_seller_non_auth';
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
                        // 'data' => $this->data
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
