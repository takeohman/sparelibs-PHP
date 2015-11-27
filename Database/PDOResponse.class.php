<?php

/**
 * Class PDOResponse
 */
class PDOResponse {
	/**
	 * @var PDOStatement
	 */
    protected $statement;

	/**
	 * @param PDOStatement $statement
	 */
    public function __construct($statement){
        $this->statement = $statement;
    }

	/**
	 * @return mixed
	 */
    public function fetchAll(){
        return $this->statement->fetchAll(PDO::FETCH_ASSOC);
    }

	/**
	 * @return string
	 */
	public function getErrorCode(){
		return $this->statement->errorCode();
	}

	/**
	 * @return array
	 */
	public function getErrorInfo(){
		return $this->statement->errorInfo();
	}
}
