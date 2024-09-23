<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Offer;

class NewOfferNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $offer;

    /**
     * Create a new notification instance.
     */
    public function __construct(Offer $offer)
    {
        $this->offer = $offer;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via($notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
                    ->line('A new offer has been created!')
                    ->line('Offer Name: ' . $this->offer->name)
                    ->line('Offer Description: ' . $this->offer->description)
                    ->action('View Offer', url('/offers/' . $this->offer->id))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray($notifiable): array
    {
        return [
            'offer_id' => $this->offer->id,
            'offer_name' => $this->offer->name,
        ];
    }
}
