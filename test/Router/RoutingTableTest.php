<?php
/**
 * Created by PhpStorm.
 * User: takeoh
 * Date: 2017/01/11
 * Time: 20:28
 */
require_once __DIR__ . '/../../Router/RoutingTable.class.php';

class RoutingTableTest extends PHPUnit_Framework_TestCase {
	public function test_getFileName(){

		$obj = new RoutingTable(
			array(
				'search'=>'SearchClass',
				'edit'=>'EditClass'
			)
		);

		$expected = false;
		$actual = $obj->getFileName('undefined');
		$this->assertEquals($expected, $actual, __CLASS__. "::" . __METHOD__ . ": line " . __LINE__);

		$expected = 'SearchClass';
		$actual = $obj->getFileName('search');
		$this->assertEquals($expected, $actual, __CLASS__. "::" . __METHOD__ . ": line " . __LINE__);

		$expected = 'EditClass';
		$actual = $obj->getFileName('edit');
		$this->assertEquals($expected, $actual, __CLASS__. "::" . __METHOD__ . ": line " . __LINE__);
	}
}
