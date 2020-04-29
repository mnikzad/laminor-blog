<?php

namespace Tests\Feature;

use App\Post;
use App\User;
use Faker\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class AdminTest extends TestCase
{
	public function setUp(): void
	{
		parent::setUp();

		$this->withoutExceptionHandling();

		$this->actingAs(User::find(1));
	}

	private function factory($type, $count = 1, $attrs = [])
	{
		$data = [];
		$faker = Factory::create('fa_IR');
		$images = Storage::disk('public')->allFiles('images');
		$rolesCount=\App\Role::count();

		switch ($type) {
			case 'post':
				$data[] = [
					'title' => $attrs['title'] ?? $faker->realText(120),
					'lead' => $attrs['lead'] ?? $faker->realText(700),
					'body' => $attrs['body'] ?? $faker->realText(5000),
					'banner_path' => $attrs['banner_path'] ?? Arr::random($images),
				];
				break;
			case 'user':
				$password=$faker->password;
				$data[] = [
					'name' => $attrs['name'] ?? $faker->name,
					'email' => $attrs['email'] ?? $faker->email,
					'username' => $attrs['username'] ?? $faker->userName,
					'password' => $attrs['password'] ?? $password,
					'password_confirmation' => $attrs['password'] ?? $password,
					'roles' => $attrs['roles'] ?? \App\Role::limit(rand(0,$rolesCount))->get()->pluck('id')->toArray(),
				];
				break;
		}
		return count($data) > 1 ? $data : $data[0];
	}

	public function validPostDataProvider()
	{
		$this->refreshApplication();

		$data = [];

		//* can set post with all filled valid data
		$data[] = [$this->factory('post')];

		//* can set post with empty lead
		$data[] = [$this->factory('post', 1, ['lead' => ''])];

		//* can set post with empty body
		$data[] = [$this->factory('post', 1, ['body' => ''])];

		//* can set post with empty banner_path
		$data[] = [$this->factory('post', 1, ['banner_path' => ''])];

		dump('valid post dataProvider');
		return $data;
	}

	/** @test
	 *  @dataProvider validPostDataProvider
	 */
	public function admin_can_create_a_post_with_valid_data($data)
	{
		// dump($data);
		$response = $this->post(route('admin.post.store'), $data);

		$this->assertDatabaseHas('posts', ['title' => $data['title']]);
		$post = Post::where('title', $data['title'])->first();
		$this->assertEquals($post['user_id'], 1);

		$post->delete();
	}

	/** @test
	 * @dataProvider validPostDataProvider
	 */
	public function admin_can_update_a_post_with_valid_data($data)
	{
		$post = (new Post)->fill(['title' => 'test']);
		$post->user_id = 5;
		$post->save();

		$this->put(route('admin.post.update', $post->id), $data);

		$this->assertDatabaseHas('posts', ['title' => $data['title']]);
		$post = Post::where('title', $data['title'])->first();
		$this->assertEquals($post['user_id'], 5);
	}

	/** @test */
	public function admin_can_delete_a_post()
	{
		$post = (new Post)->fill(['title' => 'test']);
		$post->user_id = 5;
		$post->save();

		$this->delete(route('admin.post.destroy', $post->id));

		$this->assertDatabaseMissing('posts', ['id' => $post->id]);
	}

	/** @test */
	public function admin_can_see_list_of_posts()
	{
		$response = $this->get(route('admin.post.index'));
		$response->assertViewHas('posts');
	}

	/** @test */
	public function admin_can_view_a_post_data_for_edit()
	{
		$post = Post::inRandomOrder()->first();

		$response = $this->get(route('admin.post.edit', $post->id));

		$response->assertViewHas('post');
	}

	/** @test */
	public function admin_can_see_list_of_users()
	{
		$response = $this->get(route('admin.user.index'));
		$response->assertViewHas('users');
	}

	/** @test */
	public function admin_can_see_a_user_data_for_edit()
	{
		$user = User::inRandomOrder()->first();
		$response = $this->get(route('admin.user.edit', $user->id));
		$response->assertViewHas('user');
	}

	public function validUserDataProvider()
	{
		$this->refreshApplication();

		$data = [];

		//* can set user with all filled valid data
		$data[] = [$this->factory('user')];

		//* username can be null
		$data[] = [$this->factory('user', 1, ['username' => ''])];

		//* roles can be null
		$data[] = [$this->factory('user', 1, ['roles' => []])];

		dump('valid user DataProvider');
		return $data;
	}

	/** @test
	 * @dataProvider validUserDataProvider
	 */
	public function admin_can_create_a_user_with_valid_data($data)
	{
		$this->post(route('admin.user.store'), $data);

		$this->assertDatabaseHas('users', Arr::only($data,['name','email']));
		$user=User::where('email',$data['email'])->first();
		$this->assertTrue(Hash::check($data['password'], $user['password']));
		$roles=$user->roles;
		$this->assertEquals(count($data['roles']),count($roles));
		foreach ($data['roles'] as $roleId ) {
			$this->assertTrue(in_array($roleId,$roles->pluck('id')->toArray()));
		}

		$user->delete();
	}

	/** @test
	 * @dataProvider validUserDataProvider
	 */
	public function admin_can_update_a_user_with_valid_data($data) {
		$user=User::inRandomOrder()->first();

		$this->put(route('admin.user.update',$user->id),$data);
		$user->refresh();

		$this->assertEquals($data['name'],$user['name']);
		$this->assertEquals($data['email'],$user['email']);
		$this->assertEquals($data['username'],$user['username']);
		$this->assertTrue(Hash::check($data['password'], $user['password']));
		$roles=$user->roles;
		dump($data['roles']);
		dump($roles->pluck('id')->toArray()	);
		$this->assertEquals(count($data['roles']),count($roles));
		foreach ($data['roles'] as $roleId ) {
			$this->assertTrue(in_array($roleId,$roles->pluck('id')->toArray()));
		}
	}

	/** @test */
	public function admin_can_delete_a_user() {
		$data=$this->factory('user');
		$user=(new User)->fill(Arr::only($data,['name','email','username']));
		$user['password']=$data['password'];
		$user->save();

		$this->delete(route('admin.user.destroy',$user->id));

		$this->assertDatabaseMissing('users',['email'=>$data['email']]);
	}
}
