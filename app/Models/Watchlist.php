<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Watchlist extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'name'];

    // Relasi ke user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // ⚡ Relasi ke movies (ini yang bikin error kamu hilang)
    public function movies()
    {
        return $this->belongsToMany(Movie::class, 'movie_watchlist')
                    ->withPivot('added_at')
                    ->withTimestamps();
    }
}
