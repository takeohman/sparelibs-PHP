<?php
require_once __DIR__ .'/../Database/SQLAdapter.class.php';
require_once __DIR__ .'/../Database/BindParamGenerator.class.php';

//require_once __DIR__ . '/_PDOResponseForTest.moc.php';
require_once __DIR__ . '/_PDOExtendedForTest.moc.php';

/**
 * Created by PhpStorm.
 * User: takeoh
 * Date: 15/11/27
 * Time: 11:27
 */

class SQLAdapterTest extends PHPUnit_Framework_TestCase {

	/**
	 * @covers SQLAdapter::selectAll
	 */
	public function test(){
		$config = new PDOConfig(array());
		$pdo = new _PDOExtendedForTest($config);

		$adapter	= new SQLAdapter($pdo);


		$generator	= new BindParamGenerator();
		$generator->equal_('field','value');

		$response	= $adapter->selectAll('table_name',array('field1','field2'),$generator->generate());
		$actual		= $response->getErrorCode();
		$expected	= 'SELECT field1,field2 FROM table_name WHERE field=:field_0';
		$this->assertEquals($expected, $actual, __CLASS__. "::" . __METHOD__ . ": line " . __LINE__);

		$actual		= $response->getErrorInfo();
		$expected	= array('field_0'=>'value');
		$this->assertEquals($expected, $actual, __CLASS__. "::" . __METHOD__ . ": line " . __LINE__);

	}
}
