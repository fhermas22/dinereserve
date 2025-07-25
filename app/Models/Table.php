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
}
