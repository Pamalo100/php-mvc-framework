<?php

namespace Kernel;

use Kernel\Session;
use App\Models\User;

class Auth{
	public function __construct(){

	}
	public static function attempt($credentials){
		$user = new User();
		$users = $user->where([
			'username'=>$credentials['username'],
		])->get();

		if(count($users)){
			$users = $users[0];
			$password = $users['password'];
			$check = verify($credentials['password'], $password);
			if($check){
				self::set($users);
				return true;
			}
		}
		return false;
	}
	public static function set($user){
		Session::set('user', $user);
	}
	public static function unset(){
		Session::forget('user');
	}
	public static function user(){
		return Session::has('user') ? Session::get('user') : [];
	}
	public static function check(){
		return Session::has('user');
	}
	public static function getClosure(){
		$closure = Session::has('closure') ? Session::get('closure') : '';
		self::unclosure();
		return $closure;
	}
	public static function setClosure($path){
		Session::set('closure', $path);
	}
	public static function unclosure(){
		Session::forget('closure');
	}
}