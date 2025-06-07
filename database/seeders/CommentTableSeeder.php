<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Comment;
use App\User; // Assuming User IDs are 1-25
use App\Post; // Assuming Post IDs are 1-25 for commentable_id

class CommentTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		// Ensure Users and Posts exist before running this, or adjust logic.
		// For this example, we assume User IDs 1-25 and Post IDs 1-25 are available.
		$userIds = User::pluck('id')->toArray();
		$postIds = Post::pluck('id')->toArray();

		if (empty($userIds) || empty($postIds)) {
            // Consider seeding users and posts first or handle this case
            $this->command->warn('No users or posts found to attach comments to. Skipping CommentTableSeeder.');
            return;
        }

		foreach (range(1, 25) as $i) {
			Comment::factory()->create([
				'user_id' => $userIds[array_rand($userIds)], // Get a random existing user ID
				'commentable_id' => $postIds[array_rand($postIds)], // Get a random existing post ID
				'commentable_type' => Post::class,
			]);
		}
	}
}
