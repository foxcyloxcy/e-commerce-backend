<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Mail\Mailable;

class PaymentReceivedNonAuth extends Notification
{
    use Queueable;

    public $subject;
    public $mailBlade;
    public $data;
    public $id;

    /**
     * Create a new notification instance.
     */
    public function __construct($data, $id = null)
    {
        $this->subject = env('APP_NAME') . ' Payment Received';
        $this->mailBlade = 'mail.content.payment_received_non_auth';
        $this->data = $data;
        $this->id = $id ?? uniqid('payment_');
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
                'data' => $this->data
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
