<?php

use Illuminate\Database\Seeder;

class CommentTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		foreach (range(1, 25) as $i) {
			factory(\App\Comment::class)->create(['user_id' => rand(1,25), 'commentable_id' => rand(1,25)]);
		}
	}
}
