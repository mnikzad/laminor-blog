<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Comment;
use App\Post;
use Faker\Factory as Faker;
use Illuminate\Support\Carbon;

$factory->define(Post::class, function ($faker) {
	$faker = Faker::create('fa_IR');
	$images = Storage::disk('public')->allFiles('images');

	return [
		'user_id' => 1,
		'title' => $faker->realText(120),
		'lead' => $faker->realText(700),
		'body' => $faker->realText(5000),
		'created_at' => Carbon::yesterday('iran'),
		'banner_path'=>Arr::random($images),
	];
});

$factory->define(Comment::class, function ($faker) {
	$faker = Faker::create('fa_IR');

	return [
		'commentable_id' => 1,
		'commentable_type' => 'App\Post',
		'user_id' => 1,
		'body' => $faker->realText(1000),
		'created_at' => Carbon::yesterday('iran')->addMinute(5),
	];
});
