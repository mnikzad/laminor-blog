<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Auth;
use Illuminate\Support\MessageBag;
use Symfony\Component\HttpFoundation\Request;

class LoginController extends Controller
{
   public function showForm()
   {
      return view('auth.login');
   }
   public function login(Request $request)
   {
      //dd($request);
      if (Auth::attempt(['email' => $request['email'], 'password' => $request['password']])) {
         return redirect()->intended(route('admin.home'));
      } else {
			$request->flash();
			return redirect()->back()->withErrors(new MessageBag(['email' => 'ایمیل یا کلمه عبور اشتباه است']));
         //return view // error!!
      }
   }

   public function logout()
   {
      auth()->logout();
      return redirect()->route('home');
   }
}
