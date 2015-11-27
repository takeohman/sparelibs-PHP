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
	 * @covers BindParam::getConditionStr
	 * @covers BindParam::getParamArray
	 */
	public function testBindParam(){
		$cond_str = "condition string";
		$param_array = array(1,2,"3");

		$param = new BindParam($cond_str, $param_array);
		$actual = $param->getConditionStr();
		$expected = $cond_str;
		$this->assertEquals($expected, $actual);

		$actual = $param->getParamArray();
		$expected = $param_array;
		$this->assertEquals($expected, $actual);
	}
}
