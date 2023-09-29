<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'summary', 'cover_image_url', 'cover_image_name', 'author', 'genres', 'tags', 'imdb_rating'];

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function relatedMovies(): BelongsToMany
    {
        return $this->belongsToMany(Movie::class, 'related_movies', 'movie_id', 'related_movie_id')
            ->withPivot('score')
            ->withTimestamps();
    }

    public function getRelatedMovies()
    {
        return $this->relatedMovies()->get();
    }
}
