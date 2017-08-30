<?php

namespace Kernel;

class Router{
	private $routes;

	public function __construct(){
		$this->routes = [];
	}

	public function get($url, $action, $param = []){
		$this->add("get", $url, $action, $param);
	}

	public function post($url, $action, $param = []){
		$this->add('post', $url, $action, $param);
	}

	public function add($method, $url, $action){
		$action = explode('@',$action);
		$controller = $action[0];
		$function = $action[1];
		$method = strtoupper($method);
		$url = $url[0] === "/" ? $url : "/" . $url;

		$key = $method . "@" . $url;
		$this->routes[$key] = [	
			"method" => $method,
			"controller" => $controller,
			"function" => $function 
		];
	}
	
	public function init(){
		$prefix = ACTIVE_ROUTE;
		$method = REQUEST_METHOD;
		$params = [];

		$UrlKey = $method . "@" . $prefix;
		$RouteKey = array_keys($this->routes);
		$index = -1;


		$UrlKey = explode("/",$UrlKey);
		foreach($RouteKey as $key=>$route){
			$route = explode("/",$route);
			$match = 1;
			if(count($route) === count($UrlKey)){
				$values = preg_grep("/{(\w+)}/", $route);
				foreach($route as $key1 => $route1){
					if($route1 !== $UrlKey[$key1] && !array_key_exists($key1, $values)) $match *= 0;
				}
			}else{
				$match = 0;
			}
			if($match){
				$index = $key;
				break;
			}
		}

		if($index != -1){
			$data = $this->routes[array_keys($this->routes)[$index]];
			$controllerName = $data['controller'];
			$controller = "\App\\Controllers\\".$controllerName;
			$param = [];
			foreach($values as $key => $value){
				$param[substr($value,1,-1)] = $UrlKey[$key];
			}

			if(class_exists($controller)){
				$controller = $this->resolve($controller);
				$function = $data['function'];
				if(method_exists($controller, $function)){
					$controller->$function($param);
				}else{
					error("Method ".$function. " not found in ". $controllerName);
				}
			}else{
				error("Controller ".$controllerName. " not found");
			}
		}else{
			error("Route not found");
		}
	}

	public function resolve($class){
		$reflectionClass = new \ReflectionClass($class);
		$constructor = $reflectionClass->getConstructor();
		$params = $constructor->getParameters();

		if(!$constructor || count($params) === 0) return new $class;

		foreach($params as $param){
			$dependencies[] = $this->resolve($param->getClass()->getName());
		}

		return $reflectionClass->newInstanceArgs($dependencies);
	}
}