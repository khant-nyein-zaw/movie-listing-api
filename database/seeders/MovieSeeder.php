<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $movies = array(
        //     "The Godfather (1972)",
        //     "Titanic (1997)",
        //     "The Shawshank Redemption (1994)",
        //     "The Dark Knight (2008)",
        //     "Schindler's List (1993)",
        //     "Pulp Fiction (1994)",
        //     "Forrest Gump (1994)",
        //     "The Matrix (1999)",
        //     "Jurassic Park (1993)",
        //     "Inception (2010)"
        // );

        $movies = array(
            "Apocalypse Now (1979)",
            "Avatar (2009)",
            "The Green Mile (1999)",
            "Interstellar (2014)",
            "E.T. the Extra-Terrestrial (1982)",
            "Django Unchained (2012)",
            "Cast Away (2000)",
            "The Matrix (1999)",
            "Saving Private Ryan (1998)",
            "Dunkirk (2017)"
        );
        $nolanMovies = array(
            "Following (1998)",
            "Memento (2000)",
            "The Prestige (2006)",
            "Batman Begins (2005)",
            "The Dark Knight (2008)",
            "Inception (2010)",
            "The Dark Knight Rises (2012)",
            "Interstellar (2014)",
            "Dunkirk (2017)",
            "Tenet (2020)"
        );

        $directors = array(
            "Francis Ford Coppola",
            "James Cameron",
            "Frank Darabont",
            "Christopher Nolan",
            "Steven Spielberg",
            "Quentin Tarantino",
            "Robert Zemeckis",
            "The Wachowskis",
            "Steven Spielberg",
            "Christopher Nolan"
        );

        foreach (range(0, 9) as $index) {
            DB::table('movies')->insert([
                'title' => $nolanMovies[$index],
                'summary' => fake()->text(100),
                'author' => 'Christopher Nolan',
                'genres' => '' . fake()->name() . ',' . fake()->name() . '',
                'tags' => '' . fake()->name() . ',' . fake()->name() . '',
                'imdb_rating' => fake()->randomFloat(1, 1, 10)
            ]);
        }
    }
}
