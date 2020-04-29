<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$posts=Post::latest()->get();
		return view('admin.posts')->with(compact('posts'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		return view('admin.post_edit');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		$user = Auth::user();
		Validator::make($request->all(),[
			'title' => 'required|min:3',
			'lead' => 'nullable|min:10',
			'body' => 'nullable|min:10',
			'banner_path'=>'nullable|string|min:7',
		])->validate();
		$post = (new Post)->fill($request->only(['title', 'lead', 'body', 'banner_path']));
		$user->posts()->save($post);
		return redirect(route('admin.post.index'))->with(['success'=>'پست ایجاد شد']);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Post  $post
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Post $post)
	{
		return view('admin.post_edit')->with(compact('post'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Post  $post
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Post $post)
	{
		Validator::make($request->all(),[
			'title' => 'required|min:3',
			'lead' => 'nullable|min:10',
			'body' => 'nullable|min:10',
			'banner_path'=>'nullable|string|min:7',
		])->validate();
		$post->update($request->only(['title','lead','body','banner_path']));
		return redirect()->back()->with(['success'=>'تغییرات ثبت شد']);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Post  $post
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Post $post)
	{
		$post->delete();
		return redirect()->back()->with(['success'=>'پست حذف شد']);
	}
}
