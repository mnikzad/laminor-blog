<?php

namespace Tests\Feature;

use App\Post;
use App\User;
use Faker\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BlogTest extends TestCase
{
	//  use RefreshDatabase;

	public function setUp(): void
	{
		parent::setUp();

		$this->withoutExceptionHandling();
	}

	/** @test */
	public function user_can_see_list_of_posts_their_author()
	{

		$response = $this->get('/');

		$response->assertStatus(200);
		$response->assertViewHas('posts');
		$posts = $response->viewData('posts');
		foreach ($posts as $post) {
			$this->assertArrayHasKey('author', $post);
		}
	}

	/** @test */
	public function user_can_view_a_post_with_its_author_and_comments()
	{
		$post = factory(Post::class, 1)->create()[0];
		// dump($post->toArray()   );

		$response = $this->get("/show/$post->id");

		$response->assertViewHas('post');
		$viewPost = $response->viewData('post');
		$this->assertArrayHasKey('comments', $viewPost);
		$this->assertArrayHasKey('author', $viewPost);
	}

	/** @test */
	public function user_can_submit_comment_for_a_post()
	{
		$faker = Factory::create('fa_IR');
		$post = Post::inRandomOrder()->first();
		$user = User::inRandomOrder()->first();
		$data = [
			'post_id' => $post->id,
			'body' => $faker->realText(1000),
		];
		$this->actingAs($user);
		$this->post(route('comment.store'), $data);

		$this->assertDatabaseHas(
			'comments',
			[
				'body' => $data['body'],
				'user_id' => $user->id,
				'commentable_type' => 'App\Post',
				'commentable_id' => $post->id,
			]
		);
		$comment=\App\Comment::where(['body' => $data['body'],'user_id' => $user->id])->first();

		$comment->delete();
	}
}
