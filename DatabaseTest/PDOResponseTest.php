<?php

require_once __DIR__ . '/../Database/PDOResponse.class.php';
require_once __DIR__ . '/_PDOStatementForTest.moc.php';
/**
 * Created by PhpStorm.
 * User: takeoh
 * Date: 15/11/27
 * Time: 11:02
 */

class PDOResponseTest extends PHPUnit_Framework_TestCase {

	/**
	 * @covers PDOResponse::getErrorCode
	 * @covers PDOResponse::getErrorInfo
	 * @covers PDOResponse::fetchAll
	 */
	public function test(){
		$statement = new _PDOStatementForTest();
		$response = new PDOResponse($statement);

		$actual = $response->getErrorCode();
		$expected = "errorCode";
		$this->assertEquals($expected, $actual, __CLASS__. "::" . __METHOD__ . ": line " . __LINE__);

		$actual = $response->getErrorInfo();
		$expected = "errorInfo";
		$this->assertEquals($expected, $actual, __CLASS__. "::" . __METHOD__ . ": line " . __LINE__);

		$actual = $response->fetchAll();
		$expected = "fetchAll";
		$this->assertEquals($expected, $actual, __CLASS__. "::" . __METHOD__ . ": line " . __LINE__);
	}
}

