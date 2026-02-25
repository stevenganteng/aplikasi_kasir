<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'plate_number',
        'type',
        'brand',
        'color',
        'owner_name',
        'owner_phone',
    ];

    /**
     * Get the transactions for this vehicle
     */
    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }
}
