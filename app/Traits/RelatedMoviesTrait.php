<?php

namespace App\Traits;

use App\Models\Movie;
use App\Models\RelatedMovie;

trait RelatedMoviesTrait
{
    // calculate relevence between movies
    private function calRelevence(Movie $movie)
    {
        $genres = explode(',', $movie->genres);
        $tags = explode(',', $movie->tags);
        $author = $movie->author;

        $movies = Movie::all();
        foreach ($movies as $calMovie) {

            if ($calMovie->id === $movie->id) :
                continue;
            endif;

            $relevenceScore = 0;

            $cal_genres = explode(',', $calMovie->genres);
            $genreIntersection = array_intersect($genres, $cal_genres);
            $genreRelevence = (float) count($genreIntersection) / count($genres);
            $relevenceScore += $genreRelevence;

            $cal_tags = explode(',', $calMovie->tags);
            $tagIntersection = array_intersect($tags, $cal_tags);
            $tagRelevence = (float) count($tagIntersection) / count($tags);
            $relevenceScore += $tagRelevence;

            $relevenceScore += $author == $calMovie->author ? 1 : 0;

            if ($relevenceScore > 0) {
                $relatedMovie = new RelatedMovie();
                $relatedMovie->movie_id = $movie->id;
                $relatedMovie->related_movie_id = $calMovie->id;
                $relatedMovie->score = $relevenceScore;
                $relatedMovie->save();
            }
        }
    }
}
