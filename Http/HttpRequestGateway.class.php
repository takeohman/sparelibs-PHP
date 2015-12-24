<?php
/**
 * Created by PhpStorm.
 * User: takeoh
 * Date: 15/12/24
 * Time: 20:04
 */

class HttpRequestGateway {
	public function getParam($key){
		if (isset($_GET[$key])){
			return $_GET[$key];
		}
		return false;
	}

	public function postParam($key){
		if (isset($_POST[$key])){
			return $_POST[$key];
		}
		return false;
	}
}