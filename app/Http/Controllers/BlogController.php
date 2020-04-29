<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class BlogController extends Controller
{

   public function index(Request $request)
   {
      $input = $request->all();
      $posts = Post::latest()->withCount('comments')->paginate(10);

      return view('blog-list')->with(compact('posts'));
   }

   public function show(Post $post)
   {
		if (!in_array($post->id, request()->session()->get('viewed_posts') ?? [])) {
         $post->increment('views');
         request()->session()->push('viewed_posts', $post->id);
      }

      if (!in_array($post->id, request()->session()->get('viewed_posts') ?? [])) {
         $post->increment('views');
         request()->session()->push('viewed_posts', $post->id);
		}

		$post->load(['author']);
		$post['comments']=$post->comments()->latest()->get();

      return view('blog-single')->with(compact('post'));
   }


   public function storeComment(Request $request)
   {
		$user=Auth::user();
		Validator::make($request->all(), [
         'post_id' => 'required|exists:posts,id',
         'body' => 'required|string',
      ])->validate();

		$post=\App\Post::find($request['post_id']);
		$comment=(new \App\Comment)->fill(['body'=>$request['body'],'user_id'=>$user->id]);
		$post->comments()->save($comment);
      return response()->json(['success' => 'succ']);
   }

}
