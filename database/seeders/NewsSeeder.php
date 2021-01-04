<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\News;
use Illuminate\Database\Seeder;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        News::factory(3)->create([
            'author_id' => Author::first()->id
        ]);

        News::factory(2)->create([
            'author_id' => Author::find(2)
        ]);
    }
}
