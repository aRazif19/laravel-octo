<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Movie_Showtime extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'movie_showtimes';

    public function movie() : BelongsTo
    {
        return $this->belongsTo(Movie::class, 'movie_id');
    }
}
