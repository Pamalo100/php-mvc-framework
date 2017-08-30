<?php

namespace Kernel;

class Database extends \MySQLi{
	private $config;
	public function __construct(){
		$this->config = include("config/database.php");

		parent::__construct(
			$this->config["host"],
			$this->config["username"],
			$this->config["password"],
			$this->config["database"]
		);
	}
}