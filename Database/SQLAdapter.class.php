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
	 * @param string $table
	 * @param BindParam $params
	 * @param bool $isIgnore
	 * @return bool|PDOResponse
	 */
	public function insert($table, $params, $isIgnore=false){

		$sql = 'INSERT ' . ($isIgnore?'IGNORE':'') . 'INTO ' . "$table ";
		$paramArray = array();

		if($params){
			$phrase = $params->getPhraseStr();		//(field...)VALUES(:field...)
			$paramArray= $params->getParamArray();

			if($phrase != ""){
				$sql .= $phrase;
			}
		}

		return $this->pdo->prepAndExec($sql, $paramArray);
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

		$paramArray = array();

		if($params){
			$phrase = $params->getPhraseStr();
			$paramArray= $params->getParamArray();

			if($phrase != ""){
				$sql .= " WHERE " . $phrase;
			}
		}

		return $this->pdo->prepAndExec($sql, $paramArray);
	}


	/**
	 * @param string $table
	 * @param BindParam $params
	 * @param bool $isIgnore
	 * @return bool|PDOResponse
	 */
	public function update($table, $params){

		$sql = 'UPDATE ' . $table;
		$paramArray = array();

		if($params){
			$phrase = $params->getPhraseStr();		//(field...)VALUES(:field...)
			$paramArray= $params->getParamArray();

			if($phrase != ""){
				$sql .= $phrase;
			}
		}

		return $this->pdo->prepAndExec($sql, $paramArray);
	}
}
