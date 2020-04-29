<?php

namespace Tests\Feature;

use Faker\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class ProfileTest extends TestCase
{
	public function setUp(): void
	{
		parent::setUp();

		$this->withoutExceptionHandling();
	}

	private function factory($count = 1, $attrs = [])
	{
		$data = [];
		$faker = Factory::create('fa_IR');

		$password = $faker->password;
		$data[] = [
			'name' => $attrs['name'] ?? $faker->name,
			'email' => $attrs['email'] ?? $faker->email,
			'username' => $attrs['username'] ?? $faker->userName,
			'password' => $attrs['password'] ?? $password,
			'password_confirmation' => $attrs['password'] ?? $password,
		];
		return count($data) > 1 ? $data : $data[0];
	}

	public function validProfileDataProvider()
	{
		$this->refreshApplication();

		$data = [];

		//* can set user with all filled valid data
		$data[] = [$this->factory()];

		//* username can be null
		$data[] = [$this->factory(1, ['username' => ''])];

		//* password can be null
		$data[] = [$this->factory(['password'=>'','password_confirmation'=>''])];

		dump('valid user DataProvider');
		return $data;
	}

	/** @test */
	public function user_can_see_his_profile()
	{
		$this->actingAs(\App\User::inRandomOrder()->first());
		$response = $this->get(route('profile'));

		$response->assertViewHas('user');
	}

	/** @test
	 * @dataProvider validProfileDataProvider
	*/
	public function user_can_update_his_profile_with_valid_data($data)
	{
		$this->actingAs(\App\User::inRandomOrder()->first());
		$this->put(route('profile.update'),$data);
		$user=Auth::user();
		$user->refresh();

		$this->assertEquals($data['name'],$user['name']);
		$this->assertEquals($data['email'],$user['email']);
		$this->assertEquals($data['username'],$user['username']);
		$this->assertTrue(Hash::check($data['password'], $user['password']));
	}
}
