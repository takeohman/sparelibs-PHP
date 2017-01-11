<?php
/**
 * Created by PhpStorm.
 * User: takeoh
 * Date: 2016/10/08
 * Time: 1:48
 */


class LogWriter {
	protected $log_file_path;
//	protected $flags = (FILE_APPEND|LOCK_EX);
	protected $flags = FILE_APPEND;

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

	public function write_line($line){
		return $this->_write_data($line.PHP_EOL, $this->flags);
	}


	public function write_line_with_Ymd($line){
		$date = @date('Y-m-d h:i:s');
		return $date . " " . $this->write_line($line);
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