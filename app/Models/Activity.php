<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Activity extends Model
{
    protected $table = 'activities';

    protected $fillable = [
        'title',
        'participant',
        'description',
        'location',
        'event_date',
        'thumbnail',
        'status',
        'slug',
    ];

    protected $casts = [
        'event_date' => 'date',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($activity) {
            if (empty($activity->slug)) {
                $activity->slug = Str::slug($activity->title) . '-' . uniqid();
            }
        });
    }
}
