<?php
namespace Kernel;

class Session{
	public function __construct(){

	}
	public static function has($session){
		return isset($_SESSION[$session]);
	}
	public static function get($session){
		return $_SESSION[$session];
	}
	public static function forget($session){
		unset($_SESSION[$session]);
	}
	public static function set($name, $session){
		$_SESSION[$name] = $session;
	}
	public static function flash($name, $session = null){
		if(!isset($_SESSION[$name])){
			$_SESSION[$name] = $session;
		}else{
			$session = $_SESSION[$name];
			unset($_SESSION[$name]);
			return $session;
		}
	}
}