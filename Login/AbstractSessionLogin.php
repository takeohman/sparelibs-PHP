<?php
require_once __DIR__ . '/../Session/Session.php';


abstract class AbstractSessionLogin {
	const SESSION_KEY_LOGIN = '_login_';//field to store hashed password.
	const SESSION_KEY_NAME = '_name_';
	
	protected $mSession;

    /**
     *
     */
    public function __construct() {
		$this->mSession = Session::createSessionObject();
		$this->mSession->start();
	}
	/**
	 * Return a hashed string
     * @param string $inPass
	 * @return string
	 */
	abstract protected function _getHashedPassword($inPass);
	
	/**
	 * @param string $inUser
     * @param string $inPass
	 * @return array or false
	 */
	abstract public function getAccountInfo($inUser, $inPass);


    /**
     * @param string $inUser
     * @param string $inPass
     * @return bool
     */
    public function login($inUser, $inPass){
		//DBなどからユーザー・ハッシュ済みパスワードを取得
		$userAccountInfo = $this->getAccountInfo($inUser, $inPass);
		if ( $userAccountInfo === false){
			return false;
		}

		//入力されたナマのパスワードからハッシュ値を取得
		$hashedPass = $this->_getHashedPassword($inPass);
		
		//ユーザーが存在し、かつパスワードのハッシュ値が一致するか確認
		if($hashedPass != false && 
		   $inUser == $userAccountInfo['user'] && 
		   $hashedPass == $userAccountInfo['pass']){
			
			$this->mSession->set(self::SESSION_KEY_LOGIN, $hashedPass);
			$this->mSession->set(self::SESSION_KEY_NAME, $inUser);
			return true;
		}

		return false;
	}
	
	/**
	 * Return whether the status is "logged" in or not.
	 * @return boolean
	 */
	public function isLoggedIn(){
		if ($this->mSession->get(self::SESSION_KEY_LOGIN,'')!= '' &&
			$this->mSession->get(self::SESSION_KEY_NAME,'') != '')
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
		return $this->mSession->destroy();
	}
}
