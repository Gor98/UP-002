<?php

namespace App\Modules\Auth\Notifications;

use App\Modules\Auth\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

/**
 * Class ChangeEmailNotification
 * @package App\Modules\Auth\Notifications
 */
class RegisterNotification extends Notification
{
    use Queueable;

    /**
     * @var string
     */
    private string $token;

    /**
     * @var string
     */
    private string $email;

    /**
     * Create a new notification instance.
     *
     * @param string $token
     * @param string $email
     */
    public function __construct(string $token, string $email)
    {
        $this->token = $token;
        $this->email = $email;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Confirm registration.')
            ->line('some text')
            ->action('Verify', config('front.verify_route') . '?token=' . $this->token);
    }


    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
