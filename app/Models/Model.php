<?php

namespace App\Models;

use Kernel\Database;

class Model extends Database{
	protected $table = '';
	protected $fillable = [];
	protected $hidden = [];
	protected $primaryKey = 'id';
	protected $additional = '';
	public $sql = '';

	public function map($query){
		$arr = [];
		while($row = $query->fetch_assoc()){
			array_push($arr, $row);
		}
		return $arr;
	}

	public function all(){
		$this->sql = 'SELECT * FROM ' . $this->table;
		$query = $this->query($this->sql);
		return $this->map($query);
	}

	public function find($id){
		$this->sql = 'SELECT * FROM ' . $this->table. ' WHERE '.$this->primaryKey . " = ". $id;
		$query = $this->query($this->sql);
		return $this->map($query);
	}

	public function destroy($id){
		$this->sql = 'DELETE FROM '. $this->table . ' WHERE '.$this->primaryKey ." = ". $id;
		$query = $this->query($this->sql);
	}

	public function where($params = []){
		$this->additional = " WHERE 1=1";
		foreach($params as $key=>$value){
			$this->additional .= " && " . $key . " = '$value'";
		}
		return $this;
	}
	public function delete(){
		$this->sql = 'DELETE FROM '. $this->table . $this->additional;
		$query = $this->query($this->sql);
	}
	public function get(){
		$this->sql = 'SELECT * FROM '. $this->table . $this->additional;
		$query = $this->query($this->sql);
		return $this->map($query);
	}
	public function orderBy($param, $method = "ASC"){
		$this->additional .= " ORDER BY ". $param . " ". $method;
		return $this;
	}
	public function groupBy($param){
		$this->additional .= " GROUP BY ". $param;
		return $this;
	}
	public function create($params){
		$this->sql = 'INSERT INTO '. $this->table;
		$this->sql .= ' ('. implode(',', array_keys($params)) .') ';
		$this->sql .= ' values(\''. implode('\',\'', $params) .'\') ;';
		$query = $this->query($this->sql);
		return back();
	}
	public function update($params){
		$this->sql = 'UPDATE '. $this->table .' SET ';
		foreach($params as $key => $param){
			$this->sql .= $key . "=" . "'" . $param . "', ";
		}
		$this->sql = rtrim($this->sql, ", ");
		$this->sql = $this->sql . $this->additional;
		$this->query($this->sql);
		return back();
	}
	public function raw($sql){
		$this->sql = $sql;
		$query = $this->query($this->sql);
		return $this->map($query);
	}
	public function first(){
		return $this->get()[0];
	}
}