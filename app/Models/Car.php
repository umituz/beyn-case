<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Whtht\PerfectlyCache\Traits\PerfectlyCachable;

/**
 * Class Car
 * @package App\Models
 */
class Car extends Model
{
    use HasFactory, PerfectlyCachable;

    protected $guarded = [];

    /**
     * @return HasMany
     */
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}
