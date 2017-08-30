<?php

spl_autoload_register(function($className){
	if(file_exists($className . ".php")){
		include_once($className .".php");
	}else{
		error("Classname ". $className . " not found");
	}
});