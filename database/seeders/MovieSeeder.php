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
        DB::table('movies')->insert([
            'title' => 'The Dark Knight',
            'summary' => 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Recusandae rem eum mollitia ipsam dignissimos tempora hic nam numquam reiciendis quae, enim laborum ducimus perferendis eius placeat aut harum qui. Commodi!',
            'author' => 'Chritopher Nolan',
            'genres' => 'Action, Adventure',
            'tags' => 'action, christopher nolan movie',
            'imdb_rating' => '9.9'
        ]);
    }
}
