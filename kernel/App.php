<?php

namespace Kernel;

use Kernel\Router;

class App{
	private $router;
	public function init(){
		session_start();

		$router = include("routes/web.php");
		$this->router = $router;
		$this->router->init();
	}
}