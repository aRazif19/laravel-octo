<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Movie extends Model
{
    use HasFactory;

    protected $table = 'movies';

    public function movie_genre() : BelongsToMany
    {
        return $this->belongsToMany(Movie_Genre::class, 'genre_movie', 'movie_id', 'genre_id');
    }

    public function movie_performer() : BelongsToMany
    {
        return $this->belongsToMany(Movie_Performer::class);
    }

    public function movie_showtime() : BelongsToMany
    {
        return $this->belongsToMany(Movie_Showtime::class, 'movie_movie_showtime', 'movie_id', 'movie_showtime_id');
    }

}
