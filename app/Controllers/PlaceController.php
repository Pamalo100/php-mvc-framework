<?php

namespace App\Controllers;

use App\Models\Place;
use App\Models\Schedule;
use Kernel\Auth;
use Kernel\Request;
use Kernel\Session;

class PlaceController{
	public function __construct(Schedule $schedule, Place $place){
		$this->schedules = $schedule;
		$this->places = $place;
	}
	public function auth(){
		if(!Auth::check()){
			Auth::setClosure(ACTIVE_ROUTE);
			return redirect('login');
		}
	}
	public function all(){
		$this->auth();
		$place = $this->places->all();
		return view("index",[
			'datas' => $place
		]);	
	}

	public function find($param){
		$this->auth();
		$id = $params['id'];
		$place = $this->places->find($id);
		return view("index",[
			'datas' => $place
		]);
	}

	public function store(){
		$params = Request::all();
		$this->auth();
		$this->places->create($params);
		return back();
	}

	public function test($params){
		$this->auth();
		$place = $this->places->orderBy('name', 'DESC')->get();
		return view("index",[
			'datas' => $place
		]);	
	}
	public function update($param){
		$params = Request::all();
		$this->places->where(['id'=>$param['id']])->update($params);
	}
	public function place($params){
		
	}
}