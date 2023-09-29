<?php

namespace App\Http\Resources;

use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MovieDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        return [
            'id' => $this->id,
            'title' => $this->title,
            'summary' => $this->summary,
            'cover_image' => $this->cover_image,
            'author' => $this->author,
            'genres' => $this->genres,
            'tags' => $this->tags,
            'imdb_rating' => $this->imdb_rating,
            'pdf_download_link' => route('movie.download.pdf', ['movie' => $this->id]),
            'related_movies' => $this->getRelatedMovies(),
            'comments' => $this->comments()->get()
        ];
    }
}
