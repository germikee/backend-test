<?php

namespace Database\Factories;

use App\Models\Author;
use App\Models\News;
use Illuminate\Database\Eloquent\Factories\Factory;

class NewsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = News::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->name,
            'author_id' => Author::factory()->create()->id,
            'article' => $this->faker->sentence,
            'is_published' => 1
        ];
    }
}
