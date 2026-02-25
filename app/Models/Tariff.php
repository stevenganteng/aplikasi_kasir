<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tariff extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price_per_hour',
        'price_per_day',
        'description',
        'is_active',
    ];

    protected $casts = [
        'price_per_hour' => 'decimal:2',
        'price_per_day' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    /**
     * Get the transactions for this tariff
     */
    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }
}
