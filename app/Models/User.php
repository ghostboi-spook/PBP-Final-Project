<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Actor;
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

    public function getBadges(): array
    {
        $badges = [];

        $reviewCount = $this->reviews()->count();
        if ($reviewCount >= 20) {
            $badges[] = [
                'name' => 'Top Reviewer',
                'description' => 'Menulis 20+ review',
                'color' => 'from-yellow-400 to-amber-500',
                'text' => 'text-yellow-900',
                'icon' => '🏆'
            ];
        } elseif ($reviewCount >= 5) {
            $badges[] = [
                'name' => 'Critic',
                'description' => 'Menulis 5+ review',
                'color' => 'from-blue-400 to-blue-600',
                'text' => 'text-blue-100',
                'icon' => '⭐'
            ];
        }

        $watchlistCount = $this->watchlists()->count();
        if ($watchlistCount >= 10) {
            $badges[] = [
                'name' => 'Movie Buff',
                'description' => 'Watchlist 10+ film',
                'color' => 'from-amber-400 to-orange-500',
                'text' => 'text-amber-900',
                'icon' => '🎬'
            ];
        }

        $followCount = $this->followedActors()->count();
        if ($followCount >= 10) {
            $badges[] = [
                'name' => 'Superfan',
                'description' => 'Follow 10+ aktor',
                'color' => 'from-purple-400 to-purple-600',
                'text' => 'text-purple-100',
                'icon' => '👑'
            ];
        } elseif ($followCount >= 3) {
            $badges[] = [
                'name' => 'Fan',
                'description' => 'Follow 3+ aktor',
                'color' => 'from-pink-400 to-pink-600',
                'text' => 'text-pink-100',
                'icon' => '🎭'
            ];
        }

        if ($this->isAdmin()) {
            $badges[] = [
                'name' => 'Admin',
                'description' => 'Administrator',
                'color' => 'from-green-400 to-green-600',
                'text' => 'text-green-100',
                'icon' => '🛡️'
            ];
        }

        if ($this->created_at && $this->created_at->year <= 2025) {
            $badges[] = [
                'name' => 'Early Adopter',
                'description' => 'Member awal IMIX',
                'color' => 'from-teal-400 to-cyan-500',
                'text' => 'text-teal-100',
                'icon' => '📅'
            ];
        }

        return $badges;
    }
}
