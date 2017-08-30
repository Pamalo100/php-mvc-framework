<?php

namespace App\Controllers;

use Kernel\Session;
use Kernel\Auth;

class AuthController{
	public function __construct(){
		
	}
	public function login(){
		return view('login');
	}
	public function postLogin(){
		$credentials = $_REQUEST;
		$attempt = Auth::attempt($credentials);
		if($attempt){
			Session::flash("success", "Hi, ". strtoupper(Auth::user()['username']));
			return redirect(Auth::getClosure());
		}else{
			Session::flash("error","Credentials Error");
			return back();
		}
	}
	public function logout(){
		Auth::unset();
		return redirect('/');
	}
}