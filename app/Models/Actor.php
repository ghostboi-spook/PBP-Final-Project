<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Actor extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'photo_path',
        'bio',
        'known_for',
        'gender',
        'birth_date',
        'birth_place',
    ];

    protected $casts = [
        'known_for' => 'array',
        'birth_date' => 'date',
    ];

    public function movies()
    {
        return $this->belongsToMany(Movie::class)->withPivot('character_name')->withTimestamps();
    }

    public function followers()
    {
        return $this->belongsToMany(
            \App\Models\User::class,
            'actor_user'
        )->withTimestamps();
    }
    
}
