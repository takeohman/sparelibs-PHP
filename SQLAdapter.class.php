<?php

require_once __DIR__ . '/PDOExtended.class.php';
/**
 * Created by PhpStorm.
 * User: takeoh
 * Date: 15/11/25
 * Time: 20:09
 */

class SQLAdapter{

	/**
	 * @var PDOExtended
	 */
	protected $pdo;
	/**
	 * @param PDOExtended $pdo
	 */
	public function __construct($pdo){
		$this->pdo = $pdo;
	}


	/**
	 * @param $table
	 * @param $fields
	 * @param BindParam $params
	 * @return bool|PDOResponse
	 */
	public function selectAll($table, $fields, $params = null){

		if(is_array($fields)){
			$field = implode(',',$fields);
		} else {
			$field = $fields;
		}
		$sql = "SELECT $field FROM $table";


		return $this->_exec($sql, $params);
	}

	/**
	 * @param string $sql
	 * @param BindParam $params
	 * @return bool|PDOResponse
	 */
	public function _exec($sql, $params){
		$paramArray = array();
		if($params){
			$condition = $params->getConditionStr();
			$paramArray= $params->getParamArray();

			if($condition != ""){
				$sql .= " WHERE " . $condition;
			}
		}

		return $this->pdo->prepAndExec($sql, $paramArray);
	}
}
