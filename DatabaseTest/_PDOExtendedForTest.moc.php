<?php

require_once __DIR__ . '/../Database/PDOExtended.class.php';
require_once __DIR__ . '/_PDOStatementForTest.moc.php';

class _PDOExtendedForTest extends PDOExtended{
	public $path = array();

	public function prepare ($statement, $driver_options = array()) {
		$this->path[] = "prepare : $statement";
		return new _PDOStatementForTest($statement);
	}
}

