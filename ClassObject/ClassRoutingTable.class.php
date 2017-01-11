<?php

class ClassRoutingTable {
	protected $table;
	public function __construct($table){
		$this->table = $table;
	}

	public function getFileName($class){
		if (isset($this->table[$class])){
			return $this->table[$class];
		}
		return false;
	}
}
