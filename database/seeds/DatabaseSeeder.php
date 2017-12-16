<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(GamesTableSeeder::class);
        $this->call(GenresTableSeeder::class);
        $this->call(RecordsTableSeeder::class);

        DB::table('games_genres')->insert([
            'game_id' => 1,
            'genre_id' => 2
        ]);
    }
}
