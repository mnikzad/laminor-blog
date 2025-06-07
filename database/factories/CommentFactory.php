<?php

namespace Database\Factories;

use App\Comment;
use App\User;
// It's common for comments to belong to a Post, but this should be flexible.
// use App\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Comment::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(), // Default to creating a new user
            'body' => $this->faker->paragraph(3),
            // 'commentable_id' and 'commentable_type' should be set when using the factory
            // e.g., Comment::factory()->for(Post::factory(), 'commentable')->create();
            // or Comment::factory()->create(['commentable_id' => $post->id, 'commentable_type' => Post::class]);
        ];
    }
}
