<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
	protected $table = 'posts';

	protected $fillable=['title','lead','body','banner_path'];

	public function comments()
	{
		return $this->morphMany('App\Comment', 'commentable');
	}

	public function author() {
		return $this->belongsTo('App\User','user_id');
	}
}
