<?php

namespace App\Models;

use App\Scopes\ReverseScope;
use Elasticquent\ElasticquentTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Car
 * @package App\Models
 */
class Brand extends BaseModel
{
    use HasFactory, SoftDeletes, ElasticquentTrait;

    protected $fillable = ['name', 'model', 'url', 'year'];

    protected $mappingProperties = [
        'name' => array(
            'type' => 'string',
            'analyzer' => 'standard'
        ),
        'model' => array(
            'type' => 'string',
            'analyzer' => 'standard'
        ),
        'url' => array(
            'type' => 'string',
            'analyzer' => 'standard'
        ),
        'year' => array(
            'type' => 'string',
            'analyzer' => 'standard'
        ),
    ];

    /**
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new ReverseScope());
    }

    /**
     * @return BelongsTo
     */
    public function car(): BelongsTo
    {
        return $this->belongsTo(Car::class);
    }
}
