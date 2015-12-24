<?php

require_once __DIR__.'/AbstractSessionLogin.php';

class SessionLogin extends AbstractSessionLogin{
	const TOKEN_PASS = '7js3a6Jw';
	protected $mToken;

	const DEFAULT_MIN_PASS_LEN = 8;
	const DEFAULT_MIN_USER_LEN = 4;
	protected $mMinPassLen = self::DEFAULT_MIN_PASS_LEN;
	protected $mMinUserLen = self::DEFAULT_MIN_USER_LEN;
	
	/**
	 * 
	 * @param string $inToken
	 */
	public function __construct($inToken=null) {
		
		parent::__construct();
		
		$this->mToken = self::TOKEN_PASS;
		if( $inToken != null ){
			$this->mToken =$inToken;
		}
	}
	
	/**
	 * 
	 * @param string $inPass
	 * @return boolean
	 */
	protected function _getHashedPassword($inPass){
		if (strlen($inPass) >= $this->mMinPassLen){
			return md5($this->mToken.$inPass);
		}
		return false;
	}

	
	/**
	 * 
	 * @param string $inUser
	 * @param string $inPass
	 * @return boolean|string
	 */
	public function getAccountInfo($inUser, $inPass){
		if (strlen($inUser) <= $this->mMinUserLen || strlen($inPass) <= $this->mMinPassLen){
			return false;
		}
		$user['user1'] = 'b79dfc838f2e27ed3386ac228dbaa4fe';//user1pass
		$user['admin'] = '987b4af679d276e860091462e393abeb';//adminpass
		
		if (isset($user[$inUser])){
			$val = array('user'=>$inUser,'pass'=>$user[$inUser]);
			return $val;
		}
		return false;
	}
}




