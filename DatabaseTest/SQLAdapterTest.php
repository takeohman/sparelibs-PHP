<?php
require_once __DIR__ .'/../Database/SQLAdapter.class.php';
require_once __DIR__ .'/../Database/BindParamGenerator.class.php';
require_once __DIR__ . '/_PDOExtendedForTest.moc.php';

/**
 * Created by PhpStorm.
 * User: takeoh
 * Date: 15/11/27
 * Time: 11:27
 */

class SQLAdapterTest extends PHPUnit_Framework_TestCase {

	public function setUp(){
		$config = new PDOConfig(array(
			'database'  => 'test',
			'pass'      => '',
			//'host'      => 'localhost',
			//'user'      => 'root',
		));
		$pdo 	= new PDOExtended($config);
		$pdo->exec("TRUNCATE TABLE TBL_TEST");

		$sql = "INSERT INTO TBL_TEST(ID,FIELD1,FIELD2,FIELD3)VALUES(1,'f1_1','f1_2','f1_3');";
		$pdo->exec($sql);
		$sql = "INSERT INTO TBL_TEST(ID,FIELD1,FIELD2,FIELD3)VALUES(2,'f2_1','f2_2','f2_3');";
		$pdo->exec($sql);
		$sql = "INSERT INTO TBL_TEST(ID,FIELD1,FIELD2,FIELD3)VALUES(3,'f3_1','f3_2','f3_3');";
		$pdo->exec($sql);
		$sql = "INSERT INTO TBL_TEST(ID,FIELD1,FIELD2,FIELD3)VALUES(4,'f4_1','f4_2','f4_3');";
		$pdo->exec($sql);
	}
	/**
	 * @covers SQLAdapter::__construct
	 * @covers SQLAdapter::selectAll
	 */
	public function test(){
		$config = new PDOConfig(array());
		$pdo = new _PDOExtendedForTest($config);

		$adapter	= new SQLAdapter($pdo);


		$generator	= new BindParamGenerator();
		$generator->equal_('field','value');

		$response	= $adapter->selectAll('table_name','field1',$generator->generate());
		$actual		= $response->getErrorCode();
		$expected	= 'SELECT field1 FROM table_name WHERE field=:field_0';
		$this->assertEquals($expected, $actual, __CLASS__. "::" . __METHOD__ . ": line " . __LINE__);

		$response	= $adapter->selectAll('table_name',array('field1','field2'),$generator->generate());
		$actual		= $response->getErrorCode();
		$expected	= 'SELECT field1,field2 FROM table_name WHERE field=:field_0';
		$this->assertEquals($expected, $actual, __CLASS__. "::" . __METHOD__ . ": line " . __LINE__);

		$actual		= $response->getErrorInfo();
		$expected	= array('field_0'=>'value');
		$this->assertEquals($expected, $actual, __CLASS__. "::" . __METHOD__ . ": line " . __LINE__);

	}

	/**
	 * @covers SQLAdapter::__construct
	 * @covers SQLAdapter::selectAll
	 */
	public function testSelectAll(){
		$config = new PDOConfig(array(

			'database'  => 'test',
			'pass'      => '',
			//'host'      => 'localhost',
			//'user'      => 'root',
		));
		$pdo 	= new PDOExtended($config);


		#
		# Select
		#
		$adapter= new SQLAdapter($pdo);
		$generator	= new BindParamGenerator();
		$generator->equal_('ID','3');
		$response	= $adapter->selectAll('TBL_TEST',array('ID','FIELD1','FIELD3'),$generator->generate());
		$actual = $response->fetchAll();
		$expected = array(
			0 => array(
				'ID'=>'3',
				'FIELD1'=>'f3_1',
				'FIELD3'=>'f3_3',
			)
		);
		$this->assertEquals($expected, $actual, __CLASS__. "::" . __METHOD__ . ": line " . __LINE__);



		#
		# Select with WHERE IN - 1
		#
		$adapter= new SQLAdapter($pdo);
		$generator	= new BindParamGenerator();
		$generator->in_('ID',array(2,4));

		$response	= $adapter->selectAll('TBL_TEST',array('ID','FIELD1','FIELD3'),$generator->generate());
		$actual = $response->fetchAll();
		$expected = array(
			0 => array(
				'ID'=>'2',
				'FIELD1'=>'f2_1',
				'FIELD3'=>'f2_3',
			),
			1 => array(
				'ID'=>'4',
				'FIELD1'=>'f4_1',
				'FIELD3'=>'f4_3',
			)
		);
		$this->assertEquals($expected, $actual, __CLASS__. "::" . __METHOD__ . ": line " . __LINE__);

		#
		# Select with WHERE IN and ORDER BY
		#
		$adapter= new SQLAdapter($pdo);
		$generator	= new BindParamGenerator();
		$generator->in_('FIELD1',array('f2_1','f4_1'))->orderBy(array('ID'=>'DESC'));

		$response	= $adapter->selectAll('TBL_TEST',array('ID','FIELD1','FIELD3'),$generator->generate());
		$actual = $response->fetchAll();
		$expected = array(
			0 => array(
				'ID'=>'4',
				'FIELD1'=>'f4_1',
				'FIELD3'=>'f4_3',
			),
			1 => array(
				'ID'=>'2',
				'FIELD1'=>'f2_1',
				'FIELD3'=>'f2_3',
			),

		);
		$this->assertEquals($expected, $actual, __CLASS__. "::" . __METHOD__ . ": line " . __LINE__);
	}

	/**
	 * @covers SQLAdapter::__construct
	 * @covers SQLAdapter::selectAll
	 * @covers SQLAdapter::insert_values
	 */
	public function test_insert(){
		$config = new PDOConfig(array(

			'database'  => 'test',
			'pass'      => '',
			//'host'      => 'localhost',
			//'user'      => 'root',
		));
		$pdo 	= new PDOExtended($config);


		#
		# Insert
		#
		$adapter= new SQLAdapter($pdo);
		$generator	= new BindParamGenerator();
		$generator->insert_values(array(
			'ID'=>5,
			'FIELD1'=>'f5_1',
			'FIELD2'=>'f5_2',
			'FIELD3'=>'f5_3',
		));
		$response = $adapter->insert('TBL_TEST',$generator->generate());
		$actual = $response->getErrorCode();
		$expected = '00000';
		$this->assertEquals($expected, $actual, __CLASS__. "::" . __METHOD__ . ": line " . __LINE__);
		#
		# Select with WHERE IN and ORDER BY
		#
		$adapter= new SQLAdapter($pdo);
		$generator	= new BindParamGenerator();
		$generator->equal_('ID',5);

		$response	= $adapter->selectAll('TBL_TEST',array('ID','FIELD1','FIELD3'),$generator->generate());
		$actual = $response->fetchAll();
		$expected = array(
			0 => array(
				'ID'=>'5',
				'FIELD1'=>'f5_1',
				'FIELD3'=>'f5_3',
			),
		);
		$this->assertEquals($expected, $actual, __CLASS__. "::" . __METHOD__ . ": line " . __LINE__);
	}

	/**
	 * @covers SQLAdapter::__construct
	 * @covers SQLAdapter::selectAll
	 * @covers SQLAdapter::insert_values
	 */
	public function test_update(){

	}
}
