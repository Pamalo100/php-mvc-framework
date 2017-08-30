<?php

namespace App\Controllers;

class IndexController{
	public function __construct(){

	}
	public function index(){
		return redirect('place');
	}
}