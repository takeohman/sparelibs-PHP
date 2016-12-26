<?php
/**
 * Created by PhpStorm.
 * User: takeoh
 * Date: 2016/09/26
 * Time: 9:15
 */
require_once __DIR__ . '/../../Router/RequestParser.php';
require_once __DIR__ . '/../../Server/ServerInfo.php';

class RequestParserTest extends PHPUnit_Framework_TestCase {
	const PREFIX_DATA				= 'DATA_';
//	const KEY_HTTP_HOST				= 'HTTP_HOST';
//	const KEY_HTTP_ACCEPT			= 'HTTP_ACCEPT';
//	const KEY_HTTP_ACCEPT_LANGUAGE	= 'HTTP_ACCEPT_LANGUAGE';
//	const KEY_HTTP_USER_AGENT		= 'HTTP_USER_AGENT';
//	const KEY_REMOTE_ADDR			= 'REMOTE_ADDR';
//	const KEY_REQUEST_METHOD		= 'REQUEST_METHOD';
//	const KEY_REQUEST_URI			= 'REQUEST_URI';
//	const KEY_SCRIPT_NAME			= 'SCRIPT_NAME';

	const DATA_QUERY_STRING = 'p1=param1&p2=param2';
	const DATA_REQUEST_URI = '/search/test/index.php?p1=param1&p2=param2';
	const DATA_SCRIPT_NAME = '/index.php';
	static public $test_data1 = array(
		ServerInfo::KEY_HTTP_HOST 				=> self::PREFIX_DATA . ServerInfo::KEY_HTTP_HOST,
		ServerInfo::KEY_HTTP_ACCEPT				=> self::PREFIX_DATA . ServerInfo::KEY_HTTP_ACCEPT,
		ServerInfo::KEY_HTTP_ACCEPT_LANGUAGE	=> self::PREFIX_DATA . ServerInfo::KEY_HTTP_ACCEPT_LANGUAGE,
		ServerInfo::KEY_HTTP_USER_AGENT			=> self::PREFIX_DATA . ServerInfo::KEY_HTTP_USER_AGENT,
		ServerInfo::KEY_REMOTE_ADDR				=> self::PREFIX_DATA . ServerInfo::KEY_REMOTE_ADDR,
		ServerInfo::KEY_REQUEST_METHOD			=> self::PREFIX_DATA . ServerInfo::KEY_REQUEST_METHOD,
		ServerInfo::KEY_REQUEST_URI				=> self::DATA_REQUEST_URI,
		ServerInfo::KEY_SCRIPT_NAME 			=> self::DATA_SCRIPT_NAME
	);
	public function testParse(){
		$serverInfo = new ServerInfo(self::$test_data1);

		$p1 = new RequestParser($serverInfo);
		$expected = array(
			'search',
			'test',
			'index.php?p1=param1&p2=param2'
		);
		$actual = $p1->parse();
		$this->assertEquals($expected, $actual, __CLASS__. "::" . __METHOD__ . ": line " . __LINE__);

	}

	public function testGetParams(){
		$expected = array(
			'script'=> '',
			'params'=> array()
		);
		$actual = RequestParser::getParams('');
		$this->assertEquals($expected, $actual, __CLASS__. "::" . __METHOD__ . ": line " . __LINE__);

		$expected = array(
			'script'=> 'index.php',
			'params'=> array()
		);
		$actual = RequestParser::getParams('index.php');
		$this->assertEquals($expected, $actual, __CLASS__. "::" . __METHOD__ . ": line " . __LINE__);

		$expected = array(
			'script'=> 'index.php',
			'params'=> array()
		);
		$actual = RequestParser::getParams('index.php?');
		$this->assertEquals($expected, $actual, __CLASS__. "::" . __METHOD__ . ": line " . __LINE__);

		$expected = array(
			'script'=> 'index.php',
			'params'=> array()
		);
		$actual = RequestParser::getParams('index.php?p1');
		$this->assertEquals($expected, $actual, __CLASS__. "::" . __METHOD__ . ": line " . __LINE__);

		$expected = array(
			'script'=> 'index.php',
			'params'=> array(
				'p1' => '',
			)
		);
		$actual = RequestParser::getParams('index.php?p1=');
		$this->assertEquals($expected, $actual, __CLASS__. "::" . __METHOD__ . ": line " . __LINE__);

		$expected = array(
			'script'=> '',
			'params'=> array(
				'p1' => 'param1',
				'p2' => 'param2'
			)
		);
		$actual = RequestParser::getParams('?p1=param1&p2=param2');
		$this->assertEquals($expected, $actual, __CLASS__. "::" . __METHOD__ . ": line " . __LINE__);

		$expected = array(
			'script'=> 'index.php',
			'params'=> array(
				'p1' => 'param1',
				'p2' => 'param2'
			)
		);
		$actual = RequestParser::getParams('index.php?p1=param1&p2=param2');
		$this->assertEquals($expected, $actual, __CLASS__. "::" . __METHOD__ . ": line " . __LINE__);
	}
}
