<?php

namespace App\Models;

use App\Scopes\ReverseScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Whtht\PerfectlyCache\Traits\PerfectlyCachable;

/**
 * Class Service
 * @package App\Models
 */
class Service extends BaseModel
{
    use HasFactory, PerfectlyCachable, SoftDeletes;

    protected $fillable = ['name', 'price'];

    /**
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new ReverseScope());
    }

    /**
     * @return HasMany
     */
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}
