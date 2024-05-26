<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // $image = $this->faker->image('public/storage/images', 640, 480, null, false, true);
        return [
            'title' => $this->faker->sentence,
            'content' => $this->faker->words(500, true),
            'user_id' => \App\Models\User::inRandomOrder()->first()->id,
            'category_id' => \App\Models\Category::inRandomOrder()->first()->id,
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'updated_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
