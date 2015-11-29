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
    protected $phraseList = array();

	/**
	 * @var array
	 */
    protected $paramList = array();

	/**
	 *
	 */
    public function __construct(){
		$this->param_id		= 0;
		$this->phraseList= array();
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
        $this->phraseList[] = " AND ";
        return $this;
    }

	/**
	 * @return BindParamGenerator
	 */
    public function or_(){
        $this->phraseList[] = " OR ";
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
	 * @return BindParamGenerator
	 */
	public function bgnBkt(){
		$this->phraseList[] = "(";
		return $this;
	}

	/**
	 * @return BindParamGenerator
	 */
	public function endBkt(){
		$this->phraseList[] = ")";
		return $this;
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
			$this->phraseList[] = " ORDER BY " . $orderByStr;
		}
		return $this;
	}
	/**
	 * @return BindParam
	 */
    public function generate(){
        $str = "";
        foreach($this->phraseList as $item){
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
        $this->phraseList[] = $field . $condition . $this->mark . $fieldName;
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
			$this->phraseList[] = $field . " IN " . "($fieldStr)";
		}
		return $this;
	}

	/**
	 * @param $keyValueList
	 * @return BindParamGenerator
	 * $keyValueList[$key]=$value
	 *
	 * INSERT INTO table ($key1, $key2) VALUES (:$key1, :$key2)
	 */
	public function insert_values($keyValueList){
		$fieldsStr = "";
		$valuesStr = "";
		foreach($keyValueList as $key => $value){
			$fieldName = $key . '_'.$this->param_id;

			if($fieldsStr != ""){
				$fieldsStr .= ',';
				$valuesStr .= ',';
			}

			$fieldsStr .= $key;
			$valuesStr .= $this->mark . $fieldName;
			$this->paramList[$fieldName] = $value;
			$this->param_id++;
		}
		$this->phraseList[] = '(';
		$this->phraseList[] = $fieldsStr;
		$this->phraseList[] = ') VALUES (';
		$this->phraseList[] = $valuesStr;
		$this->phraseList[] = ')';
		return $this;
	}

	public function update_set_values($keyValueList){
		$fieldsStr = "";
		foreach($keyValueList as $key => $value){
			$fieldName = $key . '_'.$this->param_id;

			if($fieldsStr != ""){
				$fieldsStr .= ',';
			}

			$fieldsStr .= $key.'='.$this->mark . $fieldName;
			$this->paramList[$fieldName] = $value;
			$this->param_id++;
		}
		$this->phraseList[] = $fieldsStr;
		return $this;
	}
}
