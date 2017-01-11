<?php
/**
 * Created by PhpStorm.
 * User: takeoh
 * Date: 2017/01/11
 * Time: 20:28
 */

require_once __DIR__ . '/../../ClassObject/ClassObjectGetter.class.php';

class ClassForClassObjectGetterTest {
	public function test(){
		return "test_value";
	}
}

class ClassObjectGetterTest extends PHPUnit_Framework_TestCase {
	public function test(){
		$class_name = 'ClassForClassObjectGetterTest';
		$method_name = 'test';
		$test_value = 'test_value';

		$expected = false;
		$obj = new ClassObjectGetter();
		$actual = $obj->getClassObjectByClassName('');
		$this->assertEquals($expected, $actual, __CLASS__. "::" . __METHOD__ . ": line " . __LINE__);

		$actual = $obj->getClassObjectByClassName($class_name);
		$this->assertNotEquals($expected, $actual, __CLASS__. "::" . __METHOD__ . ": line " . __LINE__);

		$expected = false;
		$actual = $obj->getClassObjectByClassAndMethodName($class_name, '');
		$this->assertEquals($expected, $actual, __CLASS__. "::" . __METHOD__ . ": line " . __LINE__);

		$actual = $obj->getClassObjectByClassAndMethodName($class_name, $method_name);
		$this->assertNotEquals($expected, $actual, __CLASS__. "::" . __METHOD__ . ": line " . __LINE__);

		$actual_test_value = $actual->$method_name();
		$this->assertEquals($test_value, $actual_test_value, __CLASS__. "::" . __METHOD__ . ": line " . __LINE__);
	}
}
