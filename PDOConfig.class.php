<?php

/**
 * Class PDOConfig
 */
class PDOConfig extends PDO {
    const DEFAULT_ENGINE    = 'mysql';
    const KEY_ENGINE        = 'engine';
    const KEY_HOST          = 'host';
    const KEY_DATABASE      = 'database';
    const KEY_USER          = 'user';
    const KEY_PASS          = 'pass';
    const KEY_OPTIONS       = 'options';
    protected $engine;
    protected $host;
    protected $database;
    protected $user;
    protected $pass;
    protected $options;

    public function __construct($config){
        $this->engine   = isset($config[self::KEY_ENGINE])?$config[self::KEY_ENGINE]:self::DEFAULT_ENGINE;
        $this->host     = isset($config[self::KEY_HOST])?$config[self::KEY_HOST]:'';
        $this->database = isset($config[self::KEY_DATABASE])?$config[self::KEY_DATABASE]:'';
        $this->user     = isset($config[self::KEY_USER])?$config[self::KEY_USER]:'';
        $this->pass     = isset($config[self::KEY_PASS])?$config[self::KEY_PASS]:'';
        $this->options  = isset($config[self::KEY_OPTIONS])?
            $config[self::KEY_OPTIONS] : array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\'');


    }

	/**
	 * @return string
	 */
    public function getDNS(){
        return $this->engine.':dbname='.$this->database.";host=".$this->host.";";
    }

	/**
	 * @return string
	 */
    public function getUserName(){
        return $this->user;
    }

	/**
	 * @return string
	 */
    public function getPassword(){
        return $this->pass;
    }

	/**
	 * @return array
	 */
    public function getOptions(){
        return $this->options;
    }
}
