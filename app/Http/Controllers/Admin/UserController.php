<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$users = User::latest()->get();
		return view('admin.users')->with(compact('users'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		$roles=\App\Role::all();
		return view('admin.user_edit')->with(compact('roles'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		Validator::make($request->all(), [
			'name' => 'required|string|min:2',
			'email' => 'required|email|max:45|unique:users,email',
			'username' => 'nullable|string|min:6|max:20|unique:users,username',
			'password' => 'required|string|min:6|max:20|confirmed',
			'roles' => 'nullable|array',
			'roles.*' => 'nullable|exists:roles,id',
		])->validate();

		$user = (new User)->fill(Arr::only($request->all(), ['name', 'email', 'username']));
		$user->password=Hash::make($request['password']);
		$user->save();

		$user->roles()->sync($request['roles']);
		return redirect(route('admin.user.index'))->with(['success'=>'کاربر ثبت شد']);
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\User  $user
	 * @return \Illuminate\Http\Response
	 */
	public function edit(User $user)
	{
		$roles=\App\Role::all();
		return view('admin.user_edit')->with(compact('user','roles'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\User  $user
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, User $user)
	{
		// dd($request->all());
		Validator::make($request->all(), [
			'name' => 'required|string|min:2',
			'email' => 'required|email|max:45|unique:users,email,'.$user['id'],
			'username' => 'nullable|string|min:6|max:20|unique:users,username,'.$user['id'],
			'password' => 'nullable|string|min:6|max:20|confirmed',
			'roles' => 'nullable|array',
			'roles.*' => 'nullable|exists:roles,id',
		])->validate();
		$user->update(Arr::only($request->all(),['name','email','username']));
		$user->password=Hash::make($request['password']);
		$user->save();

		$user->roles()->sync($request['roles']);
		return redirect()->back()->with(['success'=>'تغییرات ثبت شد']);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\User  $user
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(User $user)
	{
		$user->delete();
		return redirect()->back()->with(['success'=>'کاربر حذف شد']);
	}

	public function profile() {
		$user=Auth::user();

		$user->load('roles');

		return view('profile')->with(compact('user'));
	}

	public function updateProfile(Request $request) {
		$user=Auth::user();

		Validator::make($request->all(),[
			'name' => 'required|string|min:2',
			'email' => 'required|email|max:45|unique:users,email',
			'username' => 'nullable|string|min:6|max:20|unique:users,username',
			'password' => 'nullable|string|min:6|max:20|confirmed',
		]);

		$user->update(Arr::only($request->all(),['name','email','username']));
		$user->password=Hash::make($request['password']);
		$user->save();

		return redirect()->back()->with(['success'=>'اطلاعات ثبت شد']);
	}
}
