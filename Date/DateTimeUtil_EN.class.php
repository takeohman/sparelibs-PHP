<?php

require_once __DIR__ . '/DateTimeUtil.class.php';


class DateTimeUtil_EN extends DateTimeUtil{

	const FORMAT_DATE_DEFAULT	='Y/m/d H:i:s';
	static protected $st_format_date = self::FORMAT_DATE_DEFAULT;

	protected $dateInfoArray = array();
	static protected $nameOfhDays = array(
		'Monday'	=>array('full'=>'Monday'	,'abbr'=>'Mon.'),
		'Tuesday'	=>array('full'=>'Tuesday'	,'abbr'=>'Tue.'),
		'Wednesday'	=>array('full'=>'Wednesday'	,'abbr'=>'Wed.'),
		'Thursday'	=>array('full'=>'Thursday'	,'abbr'=>'Thu.'),
		'Friday'	=>array('full'=>'Friday'	,'abbr'=>'Fri.'),
		'Saturday'	=>array('full'=>'Saturday'	,'abbr'=>'Sat.'),
		'Sunday'	=>array('full'=>'Sunday'	,'abbr'=>'Sun.')
	);

	/**
	 * @param bool $inFullName
	 * @return mixed
	 */
	public function getWhatDay($inFullName=true){
		$typeKey = 'full';
		if($inFullName != true){
			$typeKey = 'abbr';
		}

		$this->dateInfoArray = @getDate();
		$weekday = $this->dateInfoArray[self::KEY_WEEKDAY];//曜日

		return static::$nameOfhDays[$weekday][$typeKey];
	}

	/**
	 * @param int|null $inTime
	 * @return bool|string
	 */
	public function getDate($inTime=null){
		$curtime= time();
		if($inTime != null && intval($inTime)){
			$curtime = $inTime;
		}
		$format = static::$st_format_date;
		return $this->_date($format,$curtime);
	}
}
