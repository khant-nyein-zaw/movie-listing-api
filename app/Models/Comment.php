<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['movie_id', 'commenter_name', 'commenter_email', 'comment_text'];

    public function movie(): BelongsTo
    {
        return $this->belongsTo(Movie::class);
    }
}
