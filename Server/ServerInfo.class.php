<?php
/**
 * Created by PhpStorm.
 * User: takeoh
 * Date: 2016/07/25
 * Time: 12:44
 */

class ServerInfo {

	const KEY_HTTP_HOST				= 'HTTP_HOST';
	const KEY_HTTP_ACCEPT			= 'HTTP_ACCEPT';
	const KEY_HTTP_ACCEPT_LANGUAGE	= 'HTTP_ACCEPT_LANGUAGE';
	const KEY_HTTP_USER_AGENT		= 'HTTP_USER_AGENT';
	const KEY_REMOTE_ADDR			= 'REMOTE_ADDR';
	const KEY_REQUEST_METHOD		= 'REQUEST_METHOD';
	const KEY_REQUEST_URI			= 'REQUEST_URI';
	const KEY_SCRIPT_NAME			= 'SCRIPT_NAME';

	const REQUEST_TYPE_POST			= 'POST';
	const REQUEST_TYPE_GET			= 'GET';

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

	protected function init(&$request){
		$this->httpHost				= $request[self::KEY_HTTP_HOST];
		$this->httpAccept			= $request[self::KEY_HTTP_ACCEPT];
		$this->httpUserAgent		= $request[self::KEY_HTTP_USER_AGENT];
		$this->httpAcceptLanguage	= $request[self::KEY_HTTP_ACCEPT_LANGUAGE];
		$this->remoteAddress		= $request[self::KEY_REMOTE_ADDR];
		$this->requestMethod		= $request[self::KEY_REQUEST_METHOD];
		$this->requestURI			= $request[self::KEY_REQUEST_URI];
		$this->scriptName			= $request[self::KEY_SCRIPT_NAME];
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

	public function isPost(){
		return $this->getRequestMethod() == self::REQUEST_TYPE_POST;
	}

	public function isGet(){
		return $this->getRequestMethod() == self::REQUEST_TYPE_GET;
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