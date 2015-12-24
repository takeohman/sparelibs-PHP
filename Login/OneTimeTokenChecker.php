<?php
require_once __DIR__ . '/../Session/Session.php';

class OneTimeTokenChecker{
	protected $mSessionKey;
	protected $mSession;

    /**
     * @param string $inSessionKey
     */
    public function __construct($inSessionKey = '_input_check') {
		$this->mSessionKey = $inSessionKey;
		$this->mSession = Session::createSessionObject();
		$this->mSession->start();
	}
	
	/**
	 * 
	 */
	public function setOneTimeValue(){
		$generatedValue = $this->_generateOneTimeValue();
		$this->mSession->set($this->mSessionKey, $generatedValue);
		return $generatedValue;
	}
	
	/**
	 * @param string $inRequestedValue
	 * @return boolean
	 */
	public function check($inRequestedValue){
		$checkResult = false;
		$value = $this->mSession->get($this->mSessionKey);
		if ($inRequestedValue === $value)
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