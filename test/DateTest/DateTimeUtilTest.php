<?php
/**
 * Created by PhpStorm.
 * User: takeoh
 * Date: 15/12/02
 * Time: 18:42
 */

require_once __DIR__ . '/../../Date/DateTimeUtil.class.php';
require_once __DIR__ . '/../../Utils/PregUtil.class.php';

class DateTimeUtilTest extends PHPUnit_Framework_TestCase {

	/**
	 * @covers DateTimeUtil::getDateMySql
	 */
	public function testGetDateMySql(){

		date_default_timezone_set("Asia/Tokyo");
		$obj 		= new DateTimeUtil();
		$val 		= 1448400000;
		$actual 	= $obj->getDateMySql($val);
		$expected	= '2015-11-25 06:20:00';
		$this->assertEquals($expected, $actual, __CLASS__. "::" . __METHOD__ . ": line " . __LINE__);

		$date		= $obj->getDateMySql();
		$actual 	= PregUtil::checkMySQLDateFormat($date);
		$expected	= true;
		$this->assertEquals($expected, $actual, __CLASS__. "::" . __METHOD__ . ": line " . __LINE__);
	}

	/**
	 * @covers DateTimeUtil::getYmd
	 */
	public function testGetYmd(){
		$obj 		= new DateTimeUtil();
		$val 		= 1448400000;
		$actual 	= $obj->getYmd($val);
		$expected	= '2015-11-25';
		$this->assertEquals($expected, $actual, __CLASS__. "::" . __METHOD__ . ": line " . __LINE__);
	}

	/**
	 * @covers DateTimeUtil::getHis
	 */
	public function testGetHis(){
		$obj 		= new DateTimeUtil();
		$val 		= 1448400000;
		$actual 	= $obj->getHis($val);
		$expected	= '06:20:00';
		$this->assertEquals($expected, $actual, __CLASS__. "::" . __METHOD__ . ": line " . __LINE__);
	}
}
