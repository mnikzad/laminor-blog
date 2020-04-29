<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		if (!\App\User::count()) {
			factory(\App\User::class, 5)->create()->each(function ($user) {
				$user->posts()->saveMany(factory(\App\Post::class, 5)->make());
				$user->roles()->save(\App\Role::where('name','admin')->first());
			});

			factory(\App\User::class, 20)->create()->each(function ($user){
				$user->roles()->save(\App\Role::where('name','user')->first());
			});
		}
	}
}
