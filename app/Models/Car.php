<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Whtht\PerfectlyCache\Traits\PerfectlyCachable;

/**
 * Class Car
 * @package App\Models
 */
class Car extends Model
{
    use HasFactory, PerfectlyCachable;

    protected $guarded = [];
}
