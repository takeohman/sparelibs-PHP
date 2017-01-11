<?php

require_once __DIR__ . '/../Server/ServerInfo.class.php';

class RequestParser {
	protected $serverInfo;
	protected $requestURI;
	protected $scriptName;
	/**
	 * @param ServerInfo $serverInfo
	 */
	public function __construct($serverInfo){
		$this->serverInfo = $serverInfo;
		$this->requestURI = $this->serverInfo->getRequestURI();
		$this->scriptName = $this->serverInfo->getScriptName();

	}

	public function parse(){
		$requestURI = explode('/',$this->requestURI);
		$scriptName = explode('/',$this->scriptName);

		for($i = 0;$i < sizeof($scriptName);$i++)
		{
			if ($requestURI[$i] == $scriptName[$i])
			{
				unset($requestURI[$i]);
			}
		}
		return array_values($requestURI);
	}

	/**
	 * @param $query_str
	 * @return array
	 *
	 *
	 */
	static public function getParams($query_str){

		$sep_by_q = explode('?',$query_str);
		$ret = array(
			'script'=>$sep_by_q[0],
			'params'=>array()
		);

		if (count($sep_by_q) > 1) {
			$sep_by_a = explode('&',$sep_by_q[1]);
			$params_to_ret = [];

			foreach ($sep_by_a as $param ){
				$sep_by_eq = explode('=', $param);

				if (count($sep_by_eq)==2 && $sep_by_eq[0] != ''){
					$params_to_ret[$sep_by_eq[0]] = $sep_by_eq[1];
				}
			}
			$ret['params'] = $params_to_ret;
		}
		return $ret;
	}
}
