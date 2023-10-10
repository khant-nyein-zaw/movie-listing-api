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
            'cover_image' => $this->cover_image_name,
            'cover_image_url' => $this->cover_image_url,
            'author' => $this->author,
            'user'=>$this->user(function($query){
                       $query->select('id', 'name', 'email');
                   })->get(),
            'genres' => $this->genres,
            'tags' => $this->tags,
            'created_at'=>$this->created_at->format('d-M-Y'),
            'imdb_rating' => $this->imdb_rating,
            'pdf_download_link' => route('movie.download.pdf', ['movie' => $this->id]),
            'related_movies' => $this->getRelatedMovies(),
            'comments' => $this->comments()->get()
        ];
    }
}
