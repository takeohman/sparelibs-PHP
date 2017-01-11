<?php
/**
 * Created by PhpStorm.
 * User: takeoh
 * Date: 2016/07/27
 * Time: 20:27
 */

require_once __DIR__ . '/../../Server/ServerInfo.class.php';

class ServerInfoTest extends PHPUnit_Framework_TestCase {

	const PREFIX_DATA				= 'DATA_';

	static public $test_data1 = array(
		ServerInfo::KEY_HTTP_HOST 			=> self::PREFIX_DATA . ServerInfo::KEY_HTTP_HOST,
		ServerInfo::KEY_HTTP_ACCEPT			=> self::PREFIX_DATA . ServerInfo::KEY_HTTP_ACCEPT,
		ServerInfo::KEY_HTTP_ACCEPT_LANGUAGE	=> self::PREFIX_DATA . ServerInfo::KEY_HTTP_ACCEPT_LANGUAGE,
		ServerInfo::KEY_HTTP_USER_AGENT		=> self::PREFIX_DATA . ServerInfo::KEY_HTTP_USER_AGENT,
		ServerInfo::KEY_REMOTE_ADDR			=> self::PREFIX_DATA . ServerInfo::KEY_REMOTE_ADDR,
		ServerInfo::KEY_REQUEST_METHOD		=> self::PREFIX_DATA . ServerInfo::KEY_REQUEST_METHOD,
		ServerInfo::KEY_REQUEST_URI			=> self::PREFIX_DATA . ServerInfo::KEY_REQUEST_URI,
		ServerInfo::KEY_SCRIPT_NAME 			=> self::PREFIX_DATA . ServerInfo::KEY_SCRIPT_NAME
	);

	public function testGetHost(){

		$info = new ServerInfo(self::$test_data1);

		$expected = self::PREFIX_DATA . ServerInfo::KEY_HTTP_HOST;
		$actual		= $info->getHttpHost();
		$this->assertEquals($expected, $actual, __CLASS__. "::" . __METHOD__ . ": line " . __LINE__);
	}
	public function testGetHttpAccept(){

		$info = new ServerInfo(self::$test_data1);

		$expected = self::PREFIX_DATA . ServerInfo::KEY_HTTP_ACCEPT;
		$actual		= $info->getHttpAccept();
		$this->assertEquals($expected, $actual, __CLASS__. "::" . __METHOD__ . ": line " . __LINE__);
	}

	public function testGetHttpUserAgent(){

		$info = new ServerInfo(self::$test_data1);

		$expected = self::PREFIX_DATA . ServerInfo::KEY_HTTP_USER_AGENT;
		$actual		= $info->getHttpUserAgent();
		$this->assertEquals($expected, $actual, __CLASS__. "::" . __METHOD__ . ": line " . __LINE__);
	}

	public function testGetHttpAcceptLanguage(){

		$info = new ServerInfo(self::$test_data1);

		$expected = self::PREFIX_DATA . ServerInfo::KEY_HTTP_ACCEPT_LANGUAGE;
		$actual		= $info->getHttpAcceptLanguage();
		$this->assertEquals($expected, $actual, __CLASS__. "::" . __METHOD__ . ": line " . __LINE__);
	}
	public function testGetRemoteAddr(){

		$info = new ServerInfo(self::$test_data1);

		$expected = self::PREFIX_DATA . ServerInfo::KEY_REMOTE_ADDR;
		$actual		= $info->getRemoteAddr();
		$this->assertEquals($expected, $actual, __CLASS__. "::" . __METHOD__ . ": line " . __LINE__);
	}

	public function testGetRequestMethod(){

		$info = new ServerInfo(self::$test_data1);

		$expected = self::PREFIX_DATA . ServerInfo::KEY_REQUEST_METHOD;
		$actual		= $info->getRequestMethod();
		$this->assertEquals($expected, $actual, __CLASS__. "::" . __METHOD__ . ": line " . __LINE__);
	}

	public function testGetRequestURI(){

		$info = new ServerInfo(self::$test_data1);

		$expected = self::PREFIX_DATA . ServerInfo::KEY_REQUEST_URI;
		$actual		= $info->getRequestURI();
		$this->assertEquals($expected, $actual, __CLASS__. "::" . __METHOD__ . ": line " . __LINE__);
	}

	public function testGetScriptName(){

		$info = new ServerInfo(self::$test_data1);

		$expected = self::PREFIX_DATA . ServerInfo::KEY_SCRIPT_NAME;
		$actual		= $info->getScriptName();
		$this->assertEquals($expected, $actual, __CLASS__. "::" . __METHOD__ . ": line " . __LINE__);
	}
	public function testIsPost(){

		$sv = self::$test_data1;
		$sv[ServerInfo::KEY_REQUEST_METHOD] = ServerInfo::REQUEST_TYPE_POST;
		$info = new ServerInfo($sv);
		$expected	= true;
		$actual		= $info->isPost();
		$this->assertEquals($expected, $actual, __CLASS__. "::" . __METHOD__ . ": line " . __LINE__);

		$sv[ServerInfo::KEY_REQUEST_METHOD] = ServerInfo::REQUEST_TYPE_GET;
		$info = new ServerInfo($sv);
		$expected	= false;
		$actual		= $info->isPost();
		$this->assertEquals($expected, $actual, __CLASS__. "::" . __METHOD__ . ": line " . __LINE__);
	}

	public function testIsGet(){

		$sv = self::$test_data1;
		$sv[ServerInfo::KEY_REQUEST_METHOD] = ServerInfo::REQUEST_TYPE_GET;
		$info = new ServerInfo($sv);
		$expected	= true;
		$actual		= $info->isGet();
		$this->assertEquals($expected, $actual, __CLASS__. "::" . __METHOD__ . ": line " . __LINE__);

		$sv[ServerInfo::KEY_REQUEST_METHOD] = ServerInfo::REQUEST_TYPE_POST;
		$info = new ServerInfo($sv);
		$expected	= false;
		$actual		= $info->isGet();
		$this->assertEquals($expected, $actual, __CLASS__. "::" . __METHOD__ . ": line " . __LINE__);
	}
}
