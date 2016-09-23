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
	 * @param int $fetch_style
	 * @param null $fetch_argument
	 * @param array $ctor_args
	 * @return mixed
	 */
    public function fetchAll($fetch_style=PDO::FETCH_ASSOC, $fetch_argument=null){
        return $this->statement->fetchAll($fetch_style);
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
