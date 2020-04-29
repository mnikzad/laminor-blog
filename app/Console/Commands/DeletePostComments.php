<?php

namespace App\Console\Commands;

use App\Post;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class DeletePostComments extends Command
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'post:delete_comments {post}';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'delete a post comment';

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
		$post=\App\Post::findOrFail($this->argument('post'));
		$post->comments()->delete();
		Log::info("post $post->id comments deleted");
	}
}
