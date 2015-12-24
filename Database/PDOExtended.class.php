<?php
require_once __DIR__ . '/PDOResponse.class.php';
require_once __DIR__ . '/PDOConfig.class.php';

/**
 * Class PDOExtended
 */
class PDOExtended extends PDO{

	/**
	 * @param PDOConfig $pdoConfig
	 */
    public function __construct($pdoConfig){
        parent::__construct(
            $pdoConfig->getDNS(),
            $pdoConfig->getUserName(),
            $pdoConfig->getPassword(),
            $pdoConfig->getOptions()
        );
    }

	/**
	 * @param string $sql
	 * @param array $params
	 * @return bool|PDOResponse
	 */
    public function prepAndExec($sql, $params){
        $st = $this->prepare($sql);
        $st->execute($params);
		return new PDOResponse($st);
    }
}

