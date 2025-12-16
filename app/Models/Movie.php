<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'year',
        'runtime',
        'tagline',
        'description',
        'genres',
        'rating_avg',
        'vote_count',
        'poster_path',
        'backdrop_path',
        'trailer_url',
        'trailer_length',
        'language',
        'country',
        'release_date',
        'certificate',
        'director',
        'writer',
        'filming_locations',
        'production_companies',
    ];

    protected $casts = [
        'genres' => 'array',
        'release_date' => 'date',
    ];

    public function actors()
    {
        return $this->belongsToMany(Actor::class)
            ->withPivot('character_name')
            ->withTimestamps();
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
