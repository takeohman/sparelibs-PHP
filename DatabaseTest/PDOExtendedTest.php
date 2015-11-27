<?php

require_once __DIR__ . '/../Database/PDOExtended.class.php';
require_once __DIR__ . '/_PDOExtendedForTest.moc.php';

/**
 * Created by PhpStorm.
 * User: takeoh
 * Date: 15/11/27
 * Time: 11:55
 */

class PDOExtendedTest extends PHPUnit_Framework_TestCase {

	/**
	 * @covers PDOExtended::__construct
	 * @covers PDOExtended::prepAndExec
	 */
	public function test(){
		$config = new PDOConfig(
			array(

			)
		);
		$pdo = new _PDOExtendedForTest($config);

		$sql = "SELECT * FROM TEST_TABLE";
		$params = array(
			'field'=>'value'
		);

		$response = $pdo->prepAndExec($sql, $params);

		$actual		= $response->getErrorCode();
		$expected	= 'SELECT * FROM TEST_TABLE';
		$this->assertEquals($expected, $actual, __CLASS__. "::" . __METHOD__ . ": line " . __LINE__);

		$actual		= $response->getErrorInfo();
		$expected	= $params;
		$this->assertEquals($expected, $actual, __CLASS__. "::" . __METHOD__ . ": line " . __LINE__);
	}
}


