<?php

namespace Tests\Fakes\App\Models;

use App\Scopes\ReverseScope;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ModelHavingScopesFake
 * @package Tests\Fakes\App\Models
 */
class ModelHavingScopesFake extends Model
{
    /**
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new ReverseScope());
    }
}
