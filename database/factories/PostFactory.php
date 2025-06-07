<?php

namespace Database\Factories;

use App\Post;
use App\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(), // Default to creating a new user
            'title' => $this->faker->sentence(6),
            'lead' => $this->faker->paragraph(2),
            'body' => $this->faker->paragraphs(5, true),
            'banner_path' => 'banners/default.jpg', // Placeholder
            // 'created_at' and 'updated_at' will be handled by Eloquent by default
        ];
    }
}
