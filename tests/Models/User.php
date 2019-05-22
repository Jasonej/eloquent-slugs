<?php

namespace Jasonej\EloquentSlugs\Tests\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Jasonej\EloquentSlugs\HasSlugs;

/**
 * Class User
 * @package Jasonej\EloquentSlugs\Tests\Models
 * @property Carbon created_at
 * @property string first_name
 * @property integer id
 * @property string last_name
 * @property string slug
 * @property Carbon updated_at
 */
class User extends Model
{
    use HasSlugs;

    /** @inheritDoc */
    protected $guarded = [];

    /**
     * Define this model's slugs.
     *
     * @var array
     */
    protected $slugDefinitions = [
        'slug' => [
            'event' => 'saving',
            'source' => ['first_name', 'last_name']
        ]
    ];
}