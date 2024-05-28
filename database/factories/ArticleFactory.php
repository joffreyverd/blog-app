<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
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
        $user = User::inRandomOrder()->first();
        $category = Category::inRandomOrder()->first();

        // $image = $this->faker->image('public/storage/images', 640, 480, null, false, true);
        return [
            'title' => $this->faker->sentence,
            'content' => $this->faker->words(500, true),
            'user_id' => $user ? $user->id : User::factory()->create()->id,
            'category_id' => $category ? $category->id : Category::factory()->create()->id,
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'updated_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
