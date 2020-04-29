<?php

namespace App\Http\View\Composers;

use App\BlogCat;
use App\BlogPost;
use App\BlogTag;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class AdminComponentsComposer
{


	public function compose(View $view)
	{
		$user = \Auth::user();

		$role = $user->roles->count() ? $user->roles()->orderBy('id', 'asc')->first()->name : '';


		$rightbarData = compact('user', 'role');
		$view->with(compact('rightbarData'));
	}
}
