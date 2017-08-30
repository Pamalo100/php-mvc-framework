<?php

namespace Kernel;

class View{
	public function render($path, $params){
		$filePath = str_replace("\kernel", null, __DIR__) . $path . ".php";
		if(file_exists($filePath)){
			extract($params);
			ob_start();
			include($filePath);
			$view = ob_get_clean();
			$view = render($view);
			eval("?> ". $view . "<?php");
		}else{
			error("View ".$filePath. " not found");
		}
	}
}