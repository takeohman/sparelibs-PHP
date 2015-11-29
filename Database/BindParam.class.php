<?php

/**
 * Class BindParam
 */
class BindParam {
	/**
	 * @var string
	 */
    protected $phraseStr = "";

	/**
	 * @var array
	 */
    protected $paramArray   = array();

	/**
	 * @param string $conditionStr
	 * @param array $paramArray
	 */
    public function __construct($conditionStr, $paramArray){
        $this->phraseStr = $conditionStr;
        $this->paramArray   = $paramArray;
    }

	/**
	 * @return string
	 */
	public function getPhraseStr(){
		return $this->phraseStr;
	}

	/**
	 * @return array
	 */
	public function getParamArray(){
		return $this->paramArray;
	}
}
