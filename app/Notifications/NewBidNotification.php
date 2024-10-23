<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewBidNotification extends Notification
{
    use Queueable;

    protected $subject;
    protected $mailBlade;
    protected $bid;
    protected $item;

    /**
     * Create a new notification instance.
     */
    public function __construct($bid, $item)
    {
        $this->subject = env('APP_NAME') . ' New Item Bid';
        $this->mailBlade = 'mail.content.new_bid';
        $this->bid = $bid;
        $this->item = $item;
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
                        'bid' => $this->bid,
                        'item' => $this->item
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
