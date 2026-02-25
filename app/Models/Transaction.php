<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'vehicle_id',
        'parking_area_id',
        'tariff_id',
        'user_id',
        'ticket_number',
        'entry_time',
        'exit_time',
        'total_price',
        'status',
        'notes',
    ];

    protected $casts = [
        'entry_time' => 'datetime',
        'exit_time' => 'datetime',
        'total_price' => 'decimal:2',
    ];

    /**
     * Get the vehicle
     */
    public function vehicle(): BelongsTo
    {
        return $this->belongsTo(Vehicle::class);
    }

    /**
     * Get the parking area
     */
    public function parkingArea(): BelongsTo
    {
        return $this->belongsTo(ParkingArea::class, 'parking_area_id');
    }

    /**
     * Get the tariff
     */
    public function tariff(): BelongsTo
    {
        return $this->belongsTo(Tariff::class);
    }

    /**
     * Get the user (petugas)
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
