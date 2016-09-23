<?php
/**
 * Class Session
 */
class Session {
	static protected $_session_started = false;
	static protected $_session_object = null;
	
	public static function createSessionObject(){
		if (self::$_session_object === null){
			self::$_session_object = new Session();
		}
		return self::$_session_object;
	}

	/**
	 * @return bool
	 */
	public function start(){
		if (self::$_session_started === false){
			self::$_session_started = session_start();
		}
		return self::$_session_started;
	}

	public function regenerate($delete_old_session = false){
		return session_regenerate_id($delete_old_session);
	}

	/**
	 *
	 */
	public function clear(){
		$_SESSION = array();
	}

	/**
	 * @return bool
	 */
	public function destroy(){
		if(session_destroy()){
			self::$_session_started = false;
			return true;
		}
		return false;
	}

	/**
	 * @param $name
	 * @param $value
	 */
	public function set($name, $value)
	{
		$_SESSION[$name] = $value;
	}
	
	/**
	 * 
	 * @param mixed $name
	 * @param mixed $default ( default value is null )
	 * @return array or false
	 */
	public function get($name, $default = null)
	{
		if (isset($_SESSION[$name])){
			return $_SESSION[$name];
		}
		return $default;
	}

	/**
	 * @param $name
	 */
	public function remove($name){
		unset($_SESSION[$name]);
	}
}