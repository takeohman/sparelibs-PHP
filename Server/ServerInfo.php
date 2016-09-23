<?php
/**
 * Created by PhpStorm.
 * User: takeoh
 * Date: 2016/07/25
 * Time: 12:44
 */

class ServerInfo {
	protected $httpHost;
	protected $httpAccept;
	protected $httpUserAgent;
	protected $httpAcceptLanguage;
	protected $remoteAddress;
	protected $requestMethod;

	protected $requestURI;
	protected $scriptName;

	public function __construct($inServerInfo=null){

		if( is_null ($inServerInfo) ){
			$serverInfo = $_SERVER;
		} else {
			$serverInfo = $inServerInfo;
		}

		$this->init($serverInfo);
	}

	protected function init(&$inRequest){
		$this->httpHost				= $inRequest['HTTP_HOST'];
		$this->httpAccept			= $inRequest['HTTP_ACCEPT'];
		$this->httpUserAgent		= $inRequest['HTTP_USER_AGENT'];
		$this->httpAcceptLanguage	= $inRequest['HTTP_ACCEPT_LANGUAGE'];
		$this->remoteAddress		= $inRequest['REMOTE_ADDR'];
		$this->requestMethod		= $inRequest['REQUEST_METHOD'];
		$this->requestURI			= $inRequest['REQUEST_URI'];
		$this->scriptName			= $inRequest['SCRIPT_NAME'];
	}

	public function getHttpHost(){
		return $this->httpHost;
	}

	public function getHttpAccept(){
		return $this->httpAccept;
	}

	public function getHttpUserAgent(){
		return $this->httpUserAgent;
	}

	public function getHttpAcceptLanguage(){
		return $this->httpAcceptLanguage;
	}

	public function getRemoteAddr(){
		return $this->remoteAddress;
	}

	public function getRequestMethod(){
		return $this->requestMethod;
	}

	public function getRequestURI(){
		return $this->requestURI;
	}

	public function getScriptName(){
		return $this->scriptName;
	}
	public function show(){

		echo "HTTP_HOST            : " . $this->getHttpHost() . "<BR>";
		echo "HTTP_ACCEPT          : " . $this->getHttpAccept() . "<BR>";
		echo "HTTP_USER_AGENT      : " . $this->getHttpUserAgent() . "<BR>";
		echo "HTTP_ACCEPT_LANGUAGE : " . $this->getHttpAcceptLanguage() . "<BR>";
		echo "REMOTE_ADDR          : " . $this->getRemoteAddr() . "<BR>";
		echo "REQUEST_METHOD       : " . $this->getRequestMethod() . "<BR>";
		echo "ScriptName           : " . $this->getScriptName() . "<BR>";
		echo "RequestURI           : " . $this->getRequestURI(). "<BR>";
	}
}