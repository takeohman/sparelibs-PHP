<?php
/**
 * Created by PhpStorm.
 * User: takeoh
 * Date: 15/12/03
 * Time: 9:22
 */

require_once __DIR__ . '/../../Utils/PregUtil.class.php';

class PregUtilTest extends PHPUnit_Framework_TestCase {
	public function testCheckMySQLDateFormat(){

		#
		# OK Patterns
		#
		$str = "2015-12-03 09:05:46";
		$actual = PregUtil::checkMySQLDateFormat($str);
		$expected = true;
		$this->assertEquals($expected, $actual, __CLASS__. "::" . __METHOD__ . ": line " . __LINE__);

		$str = "2015-01-01 01:00:00";
		$actual = PregUtil::checkMySQLDateFormat($str);
		$expected = true;
		$this->assertEquals($expected, $actual, __CLASS__. "::" . __METHOD__ . ": line " . __LINE__);

		$str = "2015-12-31 23:59:59";
		$actual = PregUtil::checkMySQLDateFormat($str);
		$expected = true;
		$this->assertEquals($expected, $actual, __CLASS__. "::" . __METHOD__ . ": line " . __LINE__);

		#
		# NG Patterns
		#
		$str = "3015-12-31 23:59:59";
		$actual = PregUtil::checkMySQLDateFormat($str);
		$expected = false;
		$this->assertEquals($expected, $actual, __CLASS__. "::" . __METHOD__ . ": line " . __LINE__);

		$str = "2015-22-31 23:59:59";
		$actual = PregUtil::checkMySQLDateFormat($str);
		$expected = false;
		$this->assertEquals($expected, $actual, __CLASS__. "::" . __METHOD__ . ": line " . __LINE__);

		$str = "2015-12-41 23:59:59";
		$actual = PregUtil::checkMySQLDateFormat($str);
		$expected = false;
		$this->assertEquals($expected, $actual, __CLASS__. "::" . __METHOD__ . ": line " . __LINE__);

		$str = "2015-12-31 23:69:59";
		$actual = PregUtil::checkMySQLDateFormat($str);
		$expected = false;
		$this->assertEquals($expected, $actual, __CLASS__. "::" . __METHOD__ . ": line " . __LINE__);

		$str = "2015-12-31 23:59:69";
		$actual = PregUtil::checkMySQLDateFormat($str);
		$expected = false;
		$this->assertEquals($expected, $actual, __CLASS__. "::" . __METHOD__ . ": line " . __LINE__);
	}


	public function testCheckDateFormatEN(){

		#
		# OK Patterns
		#
		$str = "2015/12/03 09:05:46";
		$actual = PregUtil::checkDateFormatEN($str);
		$expected = true;
		$this->assertEquals($expected, $actual, __CLASS__. "::" . __METHOD__ . ": line " . __LINE__);

		$str = "2015/01/01 01:00:00";
		$actual = PregUtil::checkDateFormatEN($str);
		$expected = true;
		$this->assertEquals($expected, $actual, __CLASS__. "::" . __METHOD__ . ": line " . __LINE__);

		$str = "2015/12/31 23:59:59";
		$actual = PregUtil::checkDateFormatEN($str);
		$expected = true;
		$this->assertEquals($expected, $actual, __CLASS__. "::" . __METHOD__ . ": line " . __LINE__);

		#
		# NG Patterns
		#
		$str = "3015/12/31 23:59:59";
		$actual = PregUtil::checkDateFormatEN($str);
		$expected = false;
		$this->assertEquals($expected, $actual, __CLASS__. "::" . __METHOD__ . ": line " . __LINE__);

		$str = "2015/22/31 23:59:59";
		$actual = PregUtil::checkDateFormatEN($str);
		$expected = false;
		$this->assertEquals($expected, $actual, __CLASS__. "::" . __METHOD__ . ": line " . __LINE__);

		$str = "2015/12/41 23:59:59";
		$actual = PregUtil::checkDateFormatEN($str);
		$expected = false;
		$this->assertEquals($expected, $actual, __CLASS__. "::" . __METHOD__ . ": line " . __LINE__);

		$str = "2015/12/31 23:69:59";
		$actual = PregUtil::checkDateFormatEN($str);
		$expected = false;
		$this->assertEquals($expected, $actual, __CLASS__. "::" . __METHOD__ . ": line " . __LINE__);

		$str = "2015/12/31 23:59:69";
		$actual = PregUtil::checkDateFormatEN($str);
		$expected = false;
		$this->assertEquals($expected, $actual, __CLASS__. "::" . __METHOD__ . ": line " . __LINE__);
	}
}
