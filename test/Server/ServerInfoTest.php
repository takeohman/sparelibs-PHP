<?php
/**
 * Created by PhpStorm.
 * User: takeoh
 * Date: 2016/07/27
 * Time: 20:27
 */

require_once __DIR__ . '/../../Server/ServerInfo.php';

class ServerInfoTest extends PHPUnit_Framework_TestCase {

	const PREFIX_DATA				= 'DATA_';
	const KEY_HTTP_HOST				= 'HTTP_HOST';
	const KEY_HTTP_ACCEPT			= 'HTTP_ACCEPT';
	const KEY_HTTP_ACCEPT_LANGUAGE	= 'HTTP_ACCEPT_LANGUAGE';
	const KEY_HTTP_USER_AGENT		= 'HTTP_USER_AGENT';
	const KEY_REMOTE_ADDR			= 'REMOTE_ADDR';
	const KEY_REQUEST_METHOD		= 'REQUEST_METHOD';
	const KEY_REQUEST_URI			= 'REQUEST_URI';
	const KEY_SCRIPT_NAME			= 'SCRIPT_NAME';
	public function testGetHttpHost(){

		$server[self::KEY_HTTP_HOST] 			= self::PREFIX_DATA . self::KEY_HTTP_HOST;
		$server[self::KEY_HTTP_ACCEPT] 			= self::PREFIX_DATA . self::KEY_HTTP_ACCEPT;
		$server[self::KEY_HTTP_ACCEPT_LANGUAGE] = self::PREFIX_DATA . self::KEY_HTTP_ACCEPT_LANGUAGE;
		$server[self::KEY_HTTP_USER_AGENT]		= self::PREFIX_DATA	. self::KEY_HTTP_USER_AGENT;
		$server[self::KEY_REMOTE_ADDR] 			= self::PREFIX_DATA . self::KEY_REMOTE_ADDR;
		$server[self::KEY_REQUEST_METHOD]		= self::PREFIX_DATA . self::KEY_REQUEST_METHOD;
		$server[self::KEY_REQUEST_URI]			= self::PREFIX_DATA . self::KEY_REQUEST_URI;
		$server[self::KEY_SCRIPT_NAME] 			= self::PREFIX_DATA . self::KEY_SCRIPT_NAME;
		$info = new ServerInfo($server);

		$expected = self::PREFIX_DATA . self::KEY_HTTP_ACCEPT;
		$actual		= $info->getHttpAccept();
		$this->assertEquals($expected, $actual, __CLASS__. "::" . __METHOD__ . ": line " . __LINE__);
	}
}
