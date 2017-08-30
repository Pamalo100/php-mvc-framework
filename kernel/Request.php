<?php
namespace Kernel;

class Request{
	public function __construct(){

	}
	public static function all(){
		return $_REQUEST;
	}
	public static function only($array = []){
		return array_filter($_REQUEST, function($key) use($array){
			return in_array($key, $array);
		}, ARRAY_FILTER_USE_KEY);
	}
	public static function except($array = []){
		return array_filter($_REQUEST, function($key) use($array){
			return !in_array($key, $array);
		}, ARRAY_FILTER_USE_KEY);
	}
}