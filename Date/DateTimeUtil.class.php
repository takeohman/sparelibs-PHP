<?php


class DateTimeUtil {
	const FORMAT_DATE_MYSQL			='Y-m-d H:i:s';
	const FORMAT_S_DATE_MYSQL		='%04d-%02d-%02d %02d:%02d:%02d';
	const KEY_SECOND	='seconds';	//秒
	const KEY_MINUTES	='minutes';	//
	const KEY_HOURS		='hours';	//
	const KEY_MDAY		='mday';	//
	const KEY_WDAY		='wday';	//
	const KEY_MONTH		='mon';		//
	const KEY_YEAR		='year';	//
	const KEY_YDAY		='yday';	//
	const KEY_WEEKDAY	='weekday';	//
	const KEY_MONTH_NAME='month';	//
	const KEY_UNIX_SEC	='0';		//

	/**
	 * @param int|null $inTime
	 * @return bool|string
	 */
	public function getDateMySql($inTime=null){
		$current_time= time();
		if($inTime != null && intval($inTime)){
			$current_time = $inTime;
		}
		return $this->_date(self::FORMAT_DATE_MYSQL,$current_time);
	}

	/**
	 *
	 * @param string $inSeparator
	 * @param int $inTime
	 * @return string
	 */
	public function getHis($inTime=null,$inSeparator=':'){
		$current_time= time();
		$format = sprintf('H%si%ss',$inSeparator,$inSeparator);
		if($inTime != null && intval($inTime)){
			$current_time = $inTime;
		}
		return $this->_date($format,$current_time);
	}
	/**
	 *
 	 * @param int $inTime
	 * @param string $inSeparator
	 * @return string
	 */
	public function getYmd($inTime=null,$inSeparator='-'){
		$current_time= time();
		$format = sprintf('Y%sm%sd',$inSeparator,$inSeparator);
		if($inTime != null && intval($inTime)){
			$current_time = $inTime;
		}
		return $this->_date($format,$current_time);//@date($format,$current_time);
	}

	/**
	 * @param $inFormat
	 * @param $inTime
	 * @return bool|string
	 */
	protected function _date($inFormat, $inTime){
		return @date($inFormat,$inTime);
	}
}


