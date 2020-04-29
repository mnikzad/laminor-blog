<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use App\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Request;
use Illuminate\Auth\Events\Registered;


class RegisterController extends Controller
{
   public function showForm()
   {
      $roleNames = Role::all()->map(function ($role) {
         return $role->name;
      });
      return view('auth.register')->with('roleNames', $roleNames);
   }

   /**
    * Handle a registration request for the application.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
   public function register(Request $request)
   {
      // dd($request);
      Validator::make($request->all(), [
         'name' => 'required|string|min:2',
			'email' => 'required|email|max:45|unique:users,email',
			'username' => 'nullable|string|min:6|max:20|unique:users,username',
			'password' => 'nullable|string|min:6|max:20|confirmed',
      ]);
      $user = $this->create($request->all());
      auth()->login($user);
      return redirect()->route('admin.home');
   }

   /**
    * Create a new user instance after a valid registration.
    *
    * @param  array  $data
    * @return \App\User
    */
   protected function create(array $data)
   {
      $user = (new User)->fill([
         'name' => $data['name'],
         'email' => $data['email'],
         'username' => $data['username'],
		]);
		$user['password']=Hash::make($data['password']);
		$user->save();
      $role = Role::where('name', 'user')->first();
      $user->roles()->save($role);
      return $user;
   }
}
