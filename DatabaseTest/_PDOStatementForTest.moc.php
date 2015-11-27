<?php

class _PDOStatementForTest extends PDOStatement{
	public $execParam = null;
	public $sql			= null;
	public function __construct($value = null){
		$this->sql = $value;
	}
	public function errorCode(){
		if($this->sql){
			return $this->sql;
		}
		return "errorCode";
	}

	public function errorInfo(){
		if ($this->execParam){
			return $this->execParam;
		}
		return "errorInfo";
	}

	public function fetchAll($fetch_style = null, $fetch_argument = null, $ctor_args = 'array()'){
		return "fetchAll";
	}

	public function execute ($input_parameters = null) {
		$this->execParam = $input_parameters;
	}
}