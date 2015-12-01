<?php

/**
 * Class BindParam
 */
class BindParam {
	/**
	 * @var array
	 */
	protected $paramArray   = array();

	/**
	 * @var string
	 */
    protected $phraseStr = "";

	/**
	 * @var string
	 */
	protected $conditionStr = "";

	/**
	 * @param array $paramArray
	 * @param string $conditionStr
	 * @param string $phraseStr
	 */
    public function __construct($paramArray,$conditionStr,$phraseStr = ""){
		$this->paramArray   = $paramArray;
		$this->conditionStr	= $conditionStr;
        $this->phraseStr	= $phraseStr;
    }

	/**
	 * @return array
	 */
	public function getParamArray(){
		return $this->paramArray;
	}

	public function getConditionStr(){
		return $this->conditionStr;
	}
	/**
	 * @return string
	 */
	public function getPhraseStr(){
		return $this->phraseStr;
	}
}
