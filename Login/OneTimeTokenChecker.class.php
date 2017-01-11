<?php
require_once __DIR__ . '/../Session/Session.class.php';

class OneTimeTokenChecker{
	protected $sessionKey;
	protected $session;

    /**
	 * @param Session $session
     * @param string $sessionKey
     */
    public function __construct($session, $sessionKey = '_input_check') {
		$this->session = $session;
		$this->sessionKey = $sessionKey;
		$this->session->start();
	}
	
	/**
	 * 
	 */
	public function setOneTimeValue(){
		$generatedValue = $this->_generateOneTimeValue();
		$this->session->set($this->sessionKey, $generatedValue);
		return $generatedValue;
	}
	
	/**
	 * @param string $requestedValue
	 * @return boolean
	 */
	public function check($requestedValue){
		$checkResult = false;
		$value = $this->session->get($this->sessionKey);
		if ($requestedValue === $value)
		{
			$checkResult = true;
		}
		return $checkResult;
	}
	
	/**
	 * 
	 * @return string
	 */
	protected function _generateOneTimeValue(){
		return md5(@date('Y-m-d H:i:s'));
	}
}