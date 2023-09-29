<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RelatedMovie extends Model
{
    use HasFactory;

    protected $fillable = ['movie_id', 'related_movie_id', 'score'];
}
