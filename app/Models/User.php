<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Actor;
use App\Models\Watchlist;
use App\Models\Review;
use App\Models\Movie;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'avatar_path',
        'username',
        'bio',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function watchlists()
    {
        return $this->belongsToMany(Movie::class, 'watchlists')
            ->withPivot('added_at')
            ->withTimestamps();
    }


    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function isAdmin(): bool
    {
        return isset($this->role) && $this->role === 'admin';
    }

    public function followedActors()
    {
        return $this->belongsToMany(
            Actor::class,
            'actor_user'
        )->withTimestamps();
    }
}
