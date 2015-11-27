<?php

/**
 * Class BindParam
 */
class BindParam {
	/**
	 * @var string
	 */
    protected $conditionStr = "";

	/**
	 * @var array
	 */
    protected $paramArray   = array();

	/**
	 * @param string $conditionStr
	 * @param array $paramArray
	 */
    public function __construct($conditionStr, $paramArray){
        $this->conditionStr = $conditionStr;
        $this->paramArray   = $paramArray;
    }

	/**
	 * @return string
	 */
	public function getConditionStr(){
		return $this->conditionStr;
	}

	/**
	 * @return array
	 */
	public function getParamArray(){
		return $this->paramArray;
	}
}
