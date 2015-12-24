<?php

class HttpDownloadProvider {

	protected $headers		= array();
	protected $dataString	= "";
	protected $fileName		= "";
	protected $transfer_type= "";
	protected $content_type = "";

	/**
	 *
	 */
	public function __construct(){
		$this->transfer_type	= "binary";
		$this->content_type		= 'application/octet-stream';
	}

	/**
	 * @param string $type
	 */
	public function sendEncoding($type){
		$this->transfer_type = $type;
	}

	/**
	 * @param string $dataString
	 */
	public function setDataString($dataString){
		$this->dataString = $dataString;
	}

	/**
	 * @param string $fileName
	 */
	public function setFileName($fileName){
		$this->fileName = $fileName;
	}

	/**
	 *
	 */
	protected function _gatherHeaders(){
		if($this->content_type){
			array_push($this->headers,'Content-Type: ' . $this->content_type);
		}

		if($this->transfer_type){
			array_push($this->headers, 'Content-Transfer-Encoding: ' . $this->transfer_type);
		}

		if($this->fileName){
			array_push($this->headers, 'Content-Disposition:attachment; filename=' . $this->fileName);
		}

		if($this->dataString){
			array_push($this->headers, 'Content-Length: '.strlen($this->dataString));
		}
	}

	/**
	 *
	 */
	public function output(){
		$this->_gatherHeaders();

		foreach ($this->headers as $h){
			header($h);
		}
		if($this->dataString){
			echo $this->dataString;
		}
	}
}
