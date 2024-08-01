<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserVerificationNotification extends Notification
{
    use Queueable;

    protected $subject;
    protected $code;

    /**
     * Create a new notification instance.
     */
    public function __construct($code)
    {
        $this->subject = env('APP_NAME') . ' Verification Email';
        $this->code = $code;
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
                    ->line('Hi ' . $notifiable->first_name . '!')
                    ->line('Your OTP Code is: '.$this->code);
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
