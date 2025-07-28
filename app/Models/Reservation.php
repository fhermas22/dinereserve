<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;

class Reservation extends Model
{
    /** @use HasFactory<\Database\Factories\ReservationFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'table_id',
        'reservation_date',
        'reservation_time',
        'party_size',
        'special_requests',
        'status',
        'customer_name',
        'customer_email',
        'customer_phone',
        'confirmed_at',
        'cancelled_at',
        'cancellation_reason',
    ];

    protected $casts = [
        'reservation_date' => 'date',
        'reservation_time' => 'datetime:H:i',
        'confirmed_at' => 'datetime',
        'cancelled_at' => 'datetime',
    ];

    /**
     * Get the user that owns the reservation.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the table that the reservation belongs to.
     */
    public function table(): BelongsTo
    {
        return $this->belongsTo(Table::class);
    }

    /**
     * Check if the reservation can be cancelled.
     */
    public function canBeCancelled(): bool
    {
        $reservationDateTime = $this->reservation_date->setTimeFrom($this->reservation_time);
        return in_array($this->status, ['pending', 'confirmed']) && $reservationDateTime->isFuture();
    }

    /**
     * Check if the reservation can be confirmed.
     */
    public function canBeConfirmed(): bool
    {
        return $this->status === 'pending';
    }

    /**
     * Confirm the reservation.
     */
    public function confirm()
    {
        $this->update([
            'status' => 'confirmed',
            'confirmed_at' => now(),
        ]);
    }

    /**
     * Cancel the reservation.
     */
    public function cancel($reason = null)
    {
        $this->update([
            'status' => 'cancelled',
            'cancelled_at' => now(),
            'cancellation_reason' => $reason,
        ]);
    }

    /**
     * Get the formatted reservation date and time.
     */
    public function getFormattedDateTimeAttribute(): string
    {
        return $this->reservation_date->format('d/m/Y') . ' à ' .
            Carbon::parse($this->reservation_time)->format('H:i');
    }
}
