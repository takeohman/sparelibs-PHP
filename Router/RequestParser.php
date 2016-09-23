<?php

require_once __DIR__ . '/../Server/ServerInfo.php';

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
}
