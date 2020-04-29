<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;


class SetUsername extends Command
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'user:username';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'set random 8 character username for users';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function handle()
	{
		$users=\App\User::whereNull('username')->get();

		foreach ($users as $user) {
			$user->update(['username'=>$this->getRandomUsername()]);
		}

	}

	private function getRandomUsername(){
		$username=Str::random(8);
		if (\App\User::where('username',$username)->exists()){
			return $this->getRandomUsername();
		}
		return $username;
	}
}
