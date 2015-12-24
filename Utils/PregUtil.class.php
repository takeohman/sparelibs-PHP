<?php


class PregUtil{

	/**
	 * @param string $str
	 * @return bool
	 */
	public static function checkMySQLDateFormat($str){
		$pat = "/^2[0-9]{3,3}-[0-1][0-9]-[0-3][0-9] [0-2][0-9]:[0-5][0-9]:[0-5][0-9]/";
		return !!preg_match($pat,$str);
	}

	public static function checkDateFormatEN($str){
		$pat = '/^2[0-9]{3,3}\/[0-1][0-9]\/[0-3][0-9] [0-2][0-9]:[0-5][0-9]:[0-5][0-9]/';
		return !!preg_match($pat,$str);
	}
}