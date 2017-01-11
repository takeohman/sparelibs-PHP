<?php
/**
 * Created by PhpStorm.
 * User: takeoh
 * Date: 2016/10/08
 * Time: 2:54
 */

require_once __DIR__ . '/../../Log/LogWriter.class.php';

class LogWriterForTest extends LogWriter{
	public function protected_write_data($data, $flags=FILE_APPEND){
		return $this->_write_data($data, $flags);
	}
}


class LogWriterTest extends PHPUnit_Framework_TestCase {
	protected $file_name = "LogWriterTest.log";
	protected $temp_dir = '/tmp';
	protected $test_log_file_path = "";
	protected $test_data = "ABCDEFG";

	public function setup(){
		# delete the output file if it exists.
		$this->test_log_file_path = $this->temp_dir."/". $this->file_name;
		if ( file_exists($this->test_log_file_path) ){
			unlink($this->test_log_file_path);
		}
	}

	public function test_protected_write_data(){

		$writer = new LogWriterForTest($this->test_log_file_path);
		$expected = $this->test_data;
		$writer->protected_write_data($this->test_data);
		$actual = file_get_contents($this->test_log_file_path);
		$this->assertEquals($expected, $actual);

		# Append
		$expected = $this->test_data.$this->test_data;
		$writer->protected_write_data($this->test_data);
		$actual = file_get_contents($this->test_log_file_path);
		$this->assertEquals($expected, $actual);
	}

	public function test_write_data(){

		$writer = new LogWriterForTest($this->test_log_file_path);
		$expected = $this->test_data;
		$writer->write_data($this->test_data);
		$actual = file_get_contents($this->test_log_file_path);
		$this->assertEquals($expected, $actual);

		# Append
		$expected = $this->test_data.$this->test_data;
		$writer->write_data($this->test_data);
		$actual = file_get_contents($this->test_log_file_path);
		$this->assertEquals($expected, $actual);
	}
}

