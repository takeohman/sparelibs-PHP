<?php

require_once __DIR__ . '/../Database/BindParam.class.php';
/**
 * Created by PhpStorm.
 * User: takeoh
 * Date: 15/11/27
 * Time: 1:38
 */

class BindParamTest extends PHPUnit_Framework_TestCase {

	/**
	 * @covers BindParam::__construct
	 * @covers BindParam::getPhraseStr
	 * @covers BindParam::getParamArray
	 * @covers BindParam::getConditionStr
	 */
	public function testBindParam(){
		$cond_str = "condition string";
		$phrase_str="phrase string";
		$param_array = array(1,2,"3");

		$param = new BindParam($param_array, $cond_str, $phrase_str);
		$actual = $param->getConditionStr();
		$expected = $cond_str;
		$this->assertEquals($expected, $actual);

		$actual = $param->getParamArray();
		$expected = $param_array;
		$this->assertEquals($expected, $actual);

		$actual = $param->getPhraseStr();
		$expected = $phrase_str;
		$this->assertEquals($expected, $actual);
	}
}
