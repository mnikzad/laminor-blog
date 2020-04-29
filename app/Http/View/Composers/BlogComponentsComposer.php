<?php

namespace App\Http\View\Composers;

use App\Post;
use Illuminate\View\View;

class BlogComponentsComposer
{


   public function compose(View $view)
   {
		$recentPosts = Post::latest()->take(5)->get(['id', 'title'])->toArray();
		$popularPosts= Post::orderBy('views','desc')->take(5)->get(['id','title'])->toArray();
      $sidebarData = compact('recentPosts','popularPosts');
      // dd($sidebarData);
      $view->with(compact('sidebarData'));
   }
}
