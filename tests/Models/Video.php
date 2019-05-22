<?php

namespace Jasonej\EloquentSlugs\Tests\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Jasonej\EloquentSlugs\HasSlugs;

/**
 * Class Video
 * @package Jasonej\EloquentSlugs\Tests\Models
 * @property Carbon created_at
 * @property integer id
 * @property string slug
 * @property string title
 * @property Carbon updated_at
 */
class Video extends Model
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
            'event' => 'updating',
            'source' => 'title'
        ]
    ];
}