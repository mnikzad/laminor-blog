<?php

namespace Tests\Feature;

use App\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BlogTest extends TestCase
{
   //  use RefreshDatabase;

    public function setUp():void {
        parent::setUp();

        $this->withoutExceptionHandling();
    }

    /** @test */
    public function user_can_see_list_of_posts_their_author() {

        $response = $this->get('/');

        $response->assertStatus(200);
		  $response->assertViewHas('posts');
		  $posts=$response->viewData('posts');
		  foreach ($posts as $post ) {
			  $this->assertArrayHasKey('author',$post);
		  }
    }

    /** @test */
    public function user_can_view_a_post_with_its_author_and_comments() {
        $post=factory(Post::class,1)->create()[0];
        // dump($post->toArray()   );

        $response=$this->get("/show/$post->id");

		  $response->assertViewHas('post');
		  $viewPost=$response->viewData('post');
		  $this->assertArrayHasKey('comments',$viewPost);
		  $this->assertArrayHasKey('author',$viewPost);
    }
}
