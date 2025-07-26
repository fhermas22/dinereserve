<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    /** @use HasFactory<\Database\Factories\TableFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'capacity',
        'description',
        'is_available',
        'location',
    ];

    protected $casts = [
        'is_available' => 'boolean',
    ];

    /**
     * Get the reservations for the table.
     */
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    /**
     * Check if the table is available for a specific date and time.
     */
    public function isAvailableAt($date, $time)
    {
        if (!$this->is_available) {
            return false;
        }

        return !$this->reservations()
            ->where('reservation_date', $date)
            ->where('reservation_time', $time)
            ->whereIn('status', ['pending', 'confirmed'])
            ->exists();
    }

    /**
     * Get available tables for a specific date and time.
     */
    public static function getAvailableTablesAt($date, $time)
    {
        return self::where('is_available', true)
            ->whereDoesntHave('reservations', function ($query) use (
                $date,
                $time
            ) {
                $query->where('reservation_date', $date)
                    ->where('reservation_time', $time)

                    ->whereIn('status', ['pending', 'confirmed']);
            })->get();
    }
}
