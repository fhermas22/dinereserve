<?php

namespace App\Notifications;

use App\Models\Reservation;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewReservationNotification extends Notification
{
    use Queueable;

    public Reservation $reservation;

    /**
     * Create a new notification instance.
     */
    public function __construct(Reservation $reservation)
    {
        $this->reservation = $reservation;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Nouvelle réservation - DineReserve')
            ->greeting('Bonjour ' . $notifiable->name . ',')
            ->line('Une nouvelle réservation a été créée.')
            ->line('Client: ' . $this->reservation->customer_name)
            ->line('Table: ' . $this->reservation->table->name)
            ->line('Date: ' . $this->reservation->formatted_date_time)
            ->line('Personnes: ' . $this->reservation->party_size)
            ->action('Voir la réservation', route('reservations.show', $this->reservation))
            ->line('Merci d\'utiliser DineReserve !');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'reservation_id' => $this->reservation->id,
            'customer_name' => $this->reservation->customer_name,
            'table_name' => $this->reservation->table->name,
            'reservation_date' => $this->reservation->formatted_date_time,
            'party_size' => $this->reservation->party_size,
        ];
    }
}
