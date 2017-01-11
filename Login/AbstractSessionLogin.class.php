<?php
require_once __DIR__ . '/../Session/Session.class.php';


abstract class AbstractSessionLogin {
	const SESSION_KEY_LOGIN = '_login_';//field to store hashed password.
	const SESSION_KEY_NAME = '_name_';
	
	protected $session;

	/**
	 * @param Session $session
	 */
    public function __construct($session) {
		$this->session = $session;
		$this->session->start();
	}
	/**
	 * Return a hashed string
     * @param string $pass
	 * @return string
	 */
	abstract protected function _getHashedPassword($pass);
	
	/**
	 * @param string $user
	 * @return array or false
	 */
	abstract protected function _getAccountInfo($user);


    /**
     * @param string $inUser
     * @param string $inPass
     * @return bool
     */
    public function login($inUser, $inPass){
		//DBなどからユーザー・ハッシュ済みパスワードを取得
		$userAccountInfo = $this->_getAccountInfo($inUser, $inPass);
		if ( $userAccountInfo === false){
			return false;
		}

		//入力されたナマのパスワードからハッシュ値を取得
		$hashedPass = $this->_getHashedPassword($inPass);
		
		//ユーザーが存在し、かつパスワードのハッシュ値が一致するか確認
		if($hashedPass != false && 
		   $inUser == $userAccountInfo['user'] && 
		   $hashedPass == $userAccountInfo['pass']){
			
			$this->session->set(self::SESSION_KEY_LOGIN, $hashedPass);
			$this->session->set(self::SESSION_KEY_NAME, $inUser);
			$this->session->regenerate(true);
			return true;
		}

		return false;
	}
	
	/**
	 * Return whether the status is "logged" in or not.
	 * @return boolean
	 */
	public function isLoggedIn(){
		if ($this->session->get(self::SESSION_KEY_LOGIN,'')!= '' &&
			$this->session->get(self::SESSION_KEY_NAME,'') != '')
		{
			return true;
		}
		return false;
	}
	
	/**
	 * Logout
	 * @return bool
	 */
	public function logout(){
		$this->session->regenerate(true);
		return $this->session->destroy();
	}

	public function getSession(){
		return $this->session;
	}
}
