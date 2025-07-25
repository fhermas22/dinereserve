<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
}
