<?php

require_once __DIR__ . '/../Database/PDOConfig.class.php';
/**
 * Created by PhpStorm.
 * User: takeoh
 * Date: 15/11/27
 * Time: 10:47
 */

class PDOConfigTest extends PHPUnit_Framework_TestCase {
	public function test(){
		$config = array(
			PDOConfig::KEY_HOST		=> 'localhost',
			PDOConfig::KEY_DATABASE => 'database_name',
			PDOConfig::KEY_ENGINE	=> 'mysql_engine',
			PDOConfig::KEY_USER		=> 'user_name',
			PDOConfig::KEY_PASS		=> 'password',
		);
		$pdoConfig = new PDOConfig($config);

		#
		# DNS
		#
		$actual = $pdoConfig->getDNS();
		$expected = "mysql_engine:dbname=database_name;host=localhost;";
		$this->assertEquals($expected, $actual);


		#
		# UserName
		#
		$actual = $pdoConfig->getUserName();
		$expected = 'user_name';
		$this->assertEquals($expected, $actual, __CLASS__. "::" . __METHOD__ . ": line " . __LINE__);

		#
		# Password
		#
		$actual = $pdoConfig->getPassword();
		$expected = 'password';
		$this->assertEquals($expected, $actual, __CLASS__. "::" . __METHOD__ . ": line " . __LINE__);


		#
		# Options (default)
		#
		$actual = $pdoConfig->getOptions();
		$expected = array(
			PDO::MYSQL_ATTR_INIT_COMMAND=>'SET NAMES \'UTF8\''
		);
		$this->assertEquals($expected, $actual, __CLASS__. "::" . __METHOD__ . ": line " . __LINE__);

		$config = array(
			PDOConfig::KEY_HOST		=> 'localhost',
			PDOConfig::KEY_DATABASE => 'database_name',
			PDOConfig::KEY_ENGINE	=> 'mysql_engine',
			PDOConfig::KEY_USER		=> 'user_name',
			PDOConfig::KEY_PASS		=> 'password',
			PDOConfig::KEY_OPTIONS	=> array(
				'option1'=>'option value1'
			)
		);

		#
		# Options
		#
		$pdoConfig = new PDOConfig($config);
		$actual = $pdoConfig->getOptions();
		$expected = array(
			'option1'=>'option value1'
		);
		$this->assertEquals($expected, $actual, __CLASS__. "::" . __METHOD__ . ": line " . __LINE__);
	}
}
