<?php
require_once __DIR__ . '/BindParam.class.php';

/**
 * Class BindParamGenerator
 */
class BindParamGenerator {
	/**
	 * @var int
	 */
    protected $param_id = 0;

	/**
	 * @var string
	 */
    protected $mark = ":";

	/**
	 * @var array|string
	 */
    protected $conditionList = array();

	/**
	 * @var array
	 */
    protected $paramList = array();

	/**
	 *
	 */
    public function __construct(){
		$this->param_id		= 0;
		$this->conditionList= array();
		$this->paramList	= array();
    }

	/**
	 * @param string $field
	 * @param string $value
	 * @return BindParamGenerator
	 */
    public function equal_($field, $value){
        return $this->_addParam($field, $value, "=");
    }

	/**
	 * @param string $field
	 * @param string $value
	 * @return BindParamGenerator
	 */
    public function not_equal_($field, $value){
        return $this->_addParam($field, $value, "!=");
    }

	/**
	 * @return BindParamGenerator
	 */
    public function and_(){
        $this->conditionList[] = " AND ";
        return $this;
    }

	/**
	 * @return BindParamGenerator
	 */
    public function or_(){
        $this->conditionList[] = " OR ";
        return $this;
    }

	/**
	 * @param string $field
	 * @param array $valueList
	 * @return BindParamGenerator
	 */
	public function in_($field, $valueList){
		return $this->_addWhereInParams($field, $valueList);
	}

	/**
	 * @param $fieldList
	 * @return BindParamGenerator
	 */
	public function orderBy($fieldList){
		$orderByStr = "";
		foreach($fieldList as $field => $order){
			if ($orderByStr != ""){
				$orderByStr .= ',';
			}
			$orderByStr .= $field . ' ' .  $order;
		}

		if($orderByStr != ""){
			$this->conditionList[] = " ORDER BY " . $orderByStr;
		}
		return $this;
	}
	/**
	 * @return BindParam
	 */
    public function generate(){
        $str = "";
        foreach($this->conditionList as $item){
            $str .= $item;
        }

        return new BindParam(
            $str,
            $this->paramList
        );
    }

	/**
	 * @param string $field
	 * @param string $value
	 * @param string $condition
	 * @return BindParamGenerator
	 */
    protected function _addParam($field, $value, $condition){
        $fieldName = $field . '_'.$this->param_id;
        $this->conditionList[] = $field . $condition . $this->mark . $fieldName;
        $this->paramList[$fieldName] = $value;
        $this->param_id++;
        return $this;
    }

	/**
	 * @param string $field
	 * @param array $valueList
	 * @return BindParamGenerator
	 */
	protected function _addWhereInParams($field, $valueList){
		$fieldStr = "";
		foreach((array)$valueList as $value){
			$fieldName = $field . '_'.$this->param_id;
			if($fieldStr != ""){
				$fieldStr .= ',';
			}
			$fieldStr .= $this->mark . $fieldName;
			$this->paramList[$fieldName] = $value;
			$this->param_id++;
		}
		if($fieldStr != ""){
			$this->conditionList[] = $field . " IN " . "($fieldStr)";
		}
		return $this;
	}
}
