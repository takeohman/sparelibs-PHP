<?php
require_once __DIR__ . '/../Database/BindParamGenerator.class.php';

/**
 * Created by PhpStorm.
 * User: takeoh
 * Date: 15/11/27
 * Time: 1:46
 */

class BindParamGeneratorTest extends PHPUnit_Framework_TestCase {

	/**
	 * @covers BindParamGenerator::generate
	 */
	public function test_generate(){


		$gen = new BindParamGenerator();
		$actual = $gen->generate();
		$expected = new BindParam("",array());
		$this->assertEquals($expected, $actual);


		$gen = new BindParamGenerator();
		$gen->equal_('field_name','value');
		$actual = $gen->generate();
		$expected = new BindParam("field_name=:field_name_0",array('field_name_0'=>'value'));
		$this->assertEquals($expected, $actual);

	}

	/**
	 * @covers BindParamGenerator::equal_
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
}
