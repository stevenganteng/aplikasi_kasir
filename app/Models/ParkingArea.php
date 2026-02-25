<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ParkingArea extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'capacity',
        'available_spaces',
        'location',
        'is_active',
    ];

    protected $casts = [
        'capacity' => 'integer',
        'available_spaces' => 'integer',
        'is_active' => 'boolean',
    ];

    /**
     * Get the transactions for this parking area
     */
    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }
}
