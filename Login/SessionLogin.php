<?php

require_once __DIR__.'/AbstractSessionLogin.php';

class SessionLogin extends AbstractSessionLogin{
	const TOKEN_PASS = '7js3a6Jw';
	protected $token;

	const DEFAULT_MIN_PASS_LEN = 8;
	const DEFAULT_MIN_USER_LEN = 4;
	protected $minPassLen = self::DEFAULT_MIN_PASS_LEN;
	protected $minUserLen = self::DEFAULT_MIN_USER_LEN;
	
	/**
	 *
	 * @param Session $session
	 * @param string $token
	 */
	public function __construct($session, $token=null) {
		parent::__construct($session);
		
		$this->token = self::TOKEN_PASS;
		if( $token != null ){
			$this->token =$token;
		}
	}
	
	/**
	 * 
	 * @param string $pass
	 * @return boolean
	 */
	protected function _getHashedPassword($pass){
		if (strlen($pass) >= $this->minPassLen){
			return md5($this->token.$pass);
		}
		return false;
	}

	/**
	 * @param $user
	 * @param $pass
	 * @return bool
	 */
	public function checkLengthOfUserAndPass($user, $pass){
		if (strlen($user) < $this->minUserLen || strlen($pass) < $this->minPassLen){
			return false;
		}
		return true;
	}

	/**
	 * @param $user
	 * @return array|bool
	 */
	protected function _getAccountInfo($user){
		// Data For Test
		$users['user1'] = 'b79dfc838f2e27ed3386ac228dbaa4fe';//user1pass
		$users['admin'] = '1f4a278cbc8758204f5c4a94ab41820d';//adminpass (token=abcde)

		if (isset($users[$user])){
			$val = array('user'=>$user, 'pass'=>$users[$user]);
			return $val;
		}
		return false;
	}
}




