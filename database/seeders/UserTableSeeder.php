<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\User;
use App\Post;
use App\Role;

class UserTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		if (!User::count()) {
			User::factory()->count(5)->create()->each(function ($user) {
				$user->posts()->saveMany(Post::factory()->count(5)->make(['user_id' => $user->id]));
				$user->roles()->save(Role::where('name','admin')->first());
			});

			User::factory()->count(20)->create()->each(function ($user){
				$user->roles()->save(Role::where('name','user')->first());
			});
		}
	}
}
