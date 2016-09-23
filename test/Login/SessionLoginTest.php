<?php
/**
 * Created by PhpStorm.
 * User: takeoh
 * Date: 2016/09/14
 * Time: 2:07
 */

require_once('../../Login/SessionLogin.php');

class SessionLoginTest extends PHPUnit_Framework_TestCase {
	public function testCheckLengthOfUserAndPass(){

		$session = new _SessionForTest();
		$login = new _SessionLoginForTest($session);

		$expected = true;
		$actual		= $login->checkLengthOfUserAndPass("123456789","12345678");
		$this->assertEquals($expected, $actual, __CLASS__. "::" . __METHOD__ . ": line " . __LINE__);

		$expected = false;
		$actual		= $login->checkLengthOfUserAndPass("123","12345678");
		$this->assertEquals($expected, $actual, __CLASS__. "::" . __METHOD__ . ": line " . __LINE__);

		$expected = false;
		$actual		= $login->checkLengthOfUserAndPass("123456789","1234567");
		$this->assertEquals($expected, $actual, __CLASS__. "::" . __METHOD__ . ": line " . __LINE__);

		$expected = false;
		$actual		= $login->checkLengthOfUserAndPass("123","1234567");
		$this->assertEquals($expected, $actual, __CLASS__. "::" . __METHOD__ . ": line " . __LINE__);
	}

	public function test_getHashedPassword(){
		$token = "abcde";
		$session = new _SessionForTest();
		$login = new _SessionLoginForTest($session, $token);

		# too short password
		$expected = false;
		$actual = $login->getHashedPassword("1234567");
		$this->assertEquals($expected, $actual, __CLASS__. "::" . __METHOD__ . ": line " . __LINE__);

		$pass = "12345678";
		$expected = md5($token.$pass);
		$actual = $login->getHashedPassword($pass);
		$this->assertEquals($expected, $actual, __CLASS__. "::" . __METHOD__ . ": line " . __LINE__);
	}

	public function test_getAccountInfo(){
		$token = "abcde";
		$session = new _SessionForTest();
		$login = new _SessionLoginForTest($session, $token);

		$expected = false;
		$actual = $login->getAccountInfo('');
		$this->assertEquals($expected, $actual, __CLASS__. "::" . __METHOD__ . ": line " . __LINE__);

		$pass = 'adminpass';
		$expected = array('user'=>'admin', 'pass'=>md5($token.$pass));
		$actual = $login->getAccountInfo('admin');
		$this->assertEquals($expected, $actual, __CLASS__. "::" . __METHOD__ . ": line " . __LINE__);
	}
}


class _SessionForTest extends Session {

	public $session = array();
	/**
	 * @return bool
	 */
	public function start(){
		return true;
	}

	/**
	 *
	 */
	public function clear(){

	}

	/**
	 * @return bool
	 */
	public function destroy(){
		return true;
	}

	/**
	 * @param $name
	 * @param $value
	 */
	public function set($name, $value)
	{
		$this->session[$name] = $value;
	}

	/**
	 *
	 * @param mixed $name
	 * @param mixed $default ( default value is null )
	 * @return array or false
	 */
	public function get($name, $default = null)
	{
		if (isset($this->session[$name])){
			return $this->session[$name];
		}
		return $default;
	}

	/**
	 * @param $name
	 */
	public function remove($name){
		unset($this->session[$name]);
	}
}

class _SessionLoginForTest extends SessionLogin{
	public function getHashedPassword($pass){
		return $this->_getHashedPassword($pass);
	}

	public function getAccountInfo($user){
		return $this->_getAccountInfo($user);
	}
}