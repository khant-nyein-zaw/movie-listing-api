<?php

namespace Database\Seeders;

use App\Models\Movie;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $moviesId = Movie::query()->pluck('id')->toArray();
        // logger($moviesId);
        if (count($moviesId)) {
            foreach ($moviesId as $id) {
                DB::table('comments')->insert([
                    'movie_id' => $id,
                    'commenter_name' => fake()->name(),
                    'commenter_email' => fake()->email(),
                    'comment_text' => fake()->sentence(),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);
            }
        }
    }
}
