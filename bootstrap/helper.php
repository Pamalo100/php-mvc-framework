<?php

function dd($array){
	echo "<pre>";
	print_r($array);
	echo "</pre>";
}

function url($path){
	return BASE_URL . "/" . ltrim($path, "/");
}

function assets($path){
	return BASE_URL . "/resources/assets/" . ltrim($path, "/");
}

function redirect($path){
	header("location:". BASE_URL. "/" . ltrim($path, "/"));
}

function back($path){
	return redirect(REFERER_URL);
}

function view($path, $params = []){
	$view = new \Kernel\View();
	$path = "/resources/views/". $path;
	$view->render($path, $params);
}

function render($view){
	$view = preg_replace_callback("#{{([^\}\}]*)}}#", function($result){
		return "<?php echo htmlspecialchars(".$result[1].") ?>";
	}, $view);
	$view = preg_replace_callback("#@([^\@]*)@#", function($result){
		return "<?php ".$result[1]." ?>";
	}, $view);

	return $view;
}

function error($msg){
	throw new \Exception($msg);
}

function bcrypt($text){
	return password_hash($text, PASSWORD_DEFAULT);
}

function verify($text, $hash){
	return password_verify($text, $hash);
}

function json($array){
	header("Content-Type:application/json");
	echo json_encode($array);
}