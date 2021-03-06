<?php
require_once __DIR__ . '/../../Database/BindParamGenerator.class.php';

/**
 * Created by PhpStorm.
 * User: takeoh
 * Date: 15/11/27
 * Time: 1:46
 */

class BindParamGeneratorTest extends PHPUnit_Framework_TestCase {

	/**
	 * @covers BindParamGenerator::generate
	 * @covers BindParamGenerator::__construct
	 */
	public function test_generate(){


		$gen = new BindParamGenerator();
		$actual = $gen->generate();
		$expected = new BindParam(array(),"");
		$this->assertEquals($expected, $actual);


		$gen = new BindParamGenerator();
		$gen->equal_('field_name','value');
		$actual = $gen->generate();
		$expected = new BindParam(array('field_name_0'=>'value'),"field_name=:field_name_0");
		$this->assertEquals($expected, $actual);

	}

	/**
	 * @covers BindParamGenerator::equal_
	 * @covers BindParamGenerator::_addParam
	 */
	public function test_equal_(){
		$gen = new BindParamGenerator();
		$gen->equal_('field_name','value');

		$param = $gen->generate();
		$actual = $param->getConditionStr();
		$expected = "field_name=:field_name_0";
		$this->assertEquals($expected, $actual);

		$actual = $param->getParamArray();
		$expected = array('field_name_0'=>'value');
		$this->assertEquals($expected, $actual);
	}

	/**
	 * @covers BindParamGenerator::not_equal_
	 * @covers BindParamGenerator::_addParam
	 */
	public function test_not_equal_(){
		$gen = new BindParamGenerator();
		$gen->not_equal_('field_name','value');

		$param = $gen->generate();
		$actual = $param->getConditionStr();
		$expected = "field_name!=:field_name_0";
		$this->assertEquals($expected, $actual);

		$actual = $param->getParamArray();
		$expected = array('field_name_0'=>'value');
		$this->assertEquals($expected, $actual);
	}

	/**
	 * @covers BindParamGenerator::and_
	 */
	public function test_and_(){
		$gen = new BindParamGenerator();
		$gen->equal_('field1','value1')->and_()->equal_('field2','value2');

		$param = $gen->generate();
		$actual = $param->getConditionStr();
		$expected = "field1=:field1_0 AND field2=:field2_1";
		$this->assertEquals($expected, $actual);

		$actual = $param->getParamArray();
		$expected = array('field1_0'=>'value1','field2_1'=>'value2');
		$this->assertEquals($expected, $actual);
	}

	/**
	 * @covers BindParamGenerator::or_
	 */
	public function test_or_(){
		$gen = new BindParamGenerator();
		$gen->equal_('field1','value1')->or_()->equal_('field2','value2');

		$param = $gen->generate();
		$actual = $param->getConditionStr();
		$expected = "field1=:field1_0 OR field2=:field2_1";
		$this->assertEquals($expected, $actual);

		$actual = $param->getParamArray();
		$expected = array('field1_0'=>'value1','field2_1'=>'value2');
		$this->assertEquals($expected, $actual);
	}

	/**
	 * @covers BindParamGenerator::orderBy
	 */
	public function test_orderBy(){
		$gen = new BindParamGenerator();
		$gen->equal_('field1','value1')->or_()->equal_('field2','value2')->orderBy(array('field1'=>'ASC', 'field2'=>'DESC'));

		$param = $gen->generate();
		$actual = $param->getConditionStr();
		$expected = "field1=:field1_0 OR field2=:field2_1 ORDER BY field1 ASC,field2 DESC";
		$this->assertEquals($expected, $actual);

		$actual = $param->getParamArray();
		$expected = array('field1_0'=>'value1','field2_1'=>'value2');
		$this->assertEquals($expected, $actual);
	}


	/**
	 * @covers BindParamGenerator::in_
	 * @covers BindParamGenerator::_addWhereInParams
	 */
	public function test_in_(){
		$gen = new BindParamGenerator();
		$gen->in_('field',array(1,2,3,4,"5"));

		$param = $gen->generate();
		$actual = $param->getConditionStr();
		$expected = "field IN (:field_0,:field_1,:field_2,:field_3,:field_4)";
		$this->assertEquals($expected, $actual);
	}

	/**
	 * @covers BindParamGenerator::bgnBkt
	 */
	public function test_bgnBkt(){
		$gen = new BindParamGenerator();
		$gen->bgnBkt();

		$param = $gen->generate();
		$actual = $param->getConditionStr();
		$expected = "(";
		$this->assertEquals($expected, $actual);

		$actual = $param->getParamArray();
		$expected = array();
		$this->assertEquals($expected, $actual);
	}

	/**
	 * @covers BindParamGenerator::endBkt
	 */
	public function test_endBkt(){
		$gen = new BindParamGenerator();
		$gen->endBkt();

		$param = $gen->generate();
		$actual = $param->getConditionStr();
		$expected = ")";
		$this->assertEquals($expected, $actual);

		$actual = $param->getParamArray();
		$expected = array();
		$this->assertEquals($expected, $actual);
	}

	/**
	 * @covers BindParamGenerator::insert_values
	 */
	public function test_insert_values(){
		$gen = new BindParamGenerator();
		$gen->insert_values(
			array(
				'field1'=>'value1',
				'field2'=>'value2',
				'field3'=>'value3',
			)
		);
		$param = $gen->generate();
		$actual = $param->getPhraseStr();
		$expected = "(field1,field2,field3) VALUES (:field1_0,:field2_1,:field3_2)";
		$this->assertEquals($expected, $actual);

		$actual = $param->getParamArray();
		$expected = array(
			'field1_0'=>'value1',
			'field2_1'=>'value2',
			'field3_2'=>'value3',
		);
		$this->assertEquals($expected, $actual);
	}

	/**
	 * @covers BindParamGenerator::on_duplicate_key_update
	 * @covers BindParamGenerator::generate
	 */
	public function test_on_duplicate_key_update(){
		$gen = new BindParamGenerator();
		$gen->insert_values(
			array(
				'field1'=>'value1',
				'field2'=>'value2',
				'field3'=>'value3',
			)
		)->on_duplicate_key_update(array());
		$param = $gen->generate();
		$actual = $param->getPhraseStr();
		$expected = "(field1,field2,field3) VALUES (:field1_0,:field2_1,:field3_2)";
		$this->assertEquals($expected, $actual);


		$gen = new BindParamGenerator();
		$gen->insert_values(
			array(
				'ID'	=>'2',
				'field1'=>'value1',
				'field2'=>'value2',
				'field3'=>'value3',
			)
		)->on_duplicate_key_update(array('field2'=>'value2_duplicate'));
		$param = $gen->generate();
		$actual = $param->getPhraseStr();
		$expected = "(ID,field1,field2,field3) VALUES (:ID_0,:field1_1,:field2_2,:field3_3) ON DUPLICATE KEY UPDATE field2=:field2_4";
		$this->assertEquals($expected, $actual);

		$actual = $param->getParamArray();
		$expected = array(
			'ID_0'	=> 2,
			'field1_1'=>'value1',
			'field2_2'=>'value2',
			'field3_3'=>'value3',
			'field2_4'=>'value2_duplicate',
		);
		$this->assertEquals($expected, $actual);
	}

	/**
	 * @covers BindParamGenerator::update_set_values
	 */
	public function test_update_set_values(){
		$gen = new BindParamGenerator();
		$gen->update_set_values(
			array(
				'field1'=>'value1',
				'field2'=>'value2',
				'field3'=>'value3',
			)
		);
		$param = $gen->generate();
		$actual = $param->getPhraseStr();
		$expected = "field1=:field1_0,field2=:field2_1,field3=:field3_2";
		$this->assertEquals($expected, $actual);

		$actual = $param->getParamArray();
		$expected = array(
			'field1_0'=>'value1',
			'field2_1'=>'value2',
			'field3_2'=>'value3',
		);
		$this->assertEquals($expected, $actual);
	}

	public function test_limit(){

		#
		# invalid value
		#
		$gen = new BindParamGenerator();
		$gen->limit(null);

		$param = $gen->generate();
		$actual = $param->getConditionStr();
		$expected = "";
		$this->assertEquals($expected, $actual);

		$actual = $param->getParamArray();
		$expected = array();
		$this->assertEquals($expected, $actual);


		#
		# one parameter
		#
		$gen = new BindParamGenerator();
		$gen->limit(1);

		$param = $gen->generate();
		$actual = $param->getConditionStr();
		$expected = " LIMIT 1";
		$this->assertEquals($expected, $actual);

		$actual = $param->getParamArray();
		$expected = array();
		$this->assertEquals($expected, $actual);


		#
		# two parameters
		#
		$gen = new BindParamGenerator();
		$gen->limit(0,3);

		$param = $gen->generate();
		$actual = $param->getConditionStr();
		$expected = " LIMIT 0,3";
		$this->assertEquals($expected, $actual);

		$actual = $param->getParamArray();
		$expected = array();
		$this->assertEquals($expected, $actual);
	}
}
