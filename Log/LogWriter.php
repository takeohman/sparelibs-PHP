<?php
/**
 * Created by PhpStorm.
 * User: takeoh
 * Date: 2016/10/08
 * Time: 1:48
 */


class LogWriter {
	protected $log_file_path;
	protected $flags = FILE_APPEND | LOCK_EX;

	/**
	 * @param string $file_path
	 * @param int $flags
	 */
	public function __construct($file_path, $flags = FILE_APPEND){
		if($flags){
			$this->flags = $flags;
		}
		$this->log_file_path = $file_path;
	}

	/**
	 * @param $data
	 * @return int
	 */
	public function write_data($data){
		return $this->_write_data($data, $this->flags);
	}

	/**
	 * @param $data
	 * @param int $flags
	 * @return int
	 */
	protected function _write_data($data, $flags=FILE_APPEND){
		return file_put_contents($this->log_file_path, $data, $flags);
	}
}