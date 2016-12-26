<?php
/**
 * Created by PhpStorm.
 * User: takeoh
 * Date: 2016/12/16
 * Time: 9:03
 */

require_once __DIR__ . '/../../File/LocalFileListGetter.php';

class LocalFileListGetterTest extends PHPUnit_Framework_TestCase {

	public function test_getFileList(){

		#
		#	OPT_ONLYFILE
		#
		$obj = new LocalFileListGetter();
		$obj->setOption(LocalFileListGetter::OPT_ONLYFILE);
		$actual = $obj->getFileList("./test_dir1");
		$expected = array(
			"./test_dir1/file1.txt",
			"./test_dir1/file2.txt"
		);
		$this->assertEquals($expected, $actual);

		#
		#	OPT_ONLYDIR
		#
		$obj = new LocalFileListGetter();
		$obj->setOption(LocalFileListGetter::OPT_ONLYDIR);
		$actual = $obj->getFileList("./test_dir1");
		$expected = array(
			"./test_dir1/dir1",
			"./test_dir1/dir2"
		);
		$this->assertEquals($expected, $actual);

		#
		#	OPT_NOOPTION
		#
		$obj = new LocalFileListGetter();
		$actual = $obj->getFileList("./test_dir1");
		$expected = array(
			"./test_dir1/dir1",
			"./test_dir1/dir2",
			"./test_dir1/file1.txt",
			"./test_dir1/file2.txt",
		);
		$this->assertEquals($expected, $actual);

		#
		#	OPT_RECURSIVE
		#
		$obj = new LocalFileListGetter();
		$obj->setOption(LocalFileListGetter::OPT_RECURSIVE);
		$actual = $obj->getFileList("./test_dir1");
		$expected = array(
			"./test_dir1/dir1",
			"./test_dir1/dir2",
			"./test_dir1/dir2/file3.txt",
			"./test_dir1/file1.txt",
			"./test_dir1/file2.txt",
		);
		$this->assertEquals($expected, $actual);

		#
		#	OPT_RECURSIVE + /^f.*/
		#
		$obj = new LocalFileListGetter();
		$obj->setOption(LocalFileListGetter::OPT_RECURSIVE);
		$obj->setFileNameRegexp('/^f.*/');
		$actual = $obj->getFileList("./test_dir1");
		$expected = array(
			"./test_dir1/dir2/file3.txt",
			"./test_dir1/file1.txt",
			"./test_dir1/file2.txt",
		);
		$this->assertEquals($expected, $actual);

		#
		#	OPT_RECURSIVE + /^.*2.*/
		#
		$obj = new LocalFileListGetter();
		$obj->setOption(LocalFileListGetter::OPT_RECURSIVE);
		$obj->setFileNameRegexp('/^.*2.*/');
		$actual = $obj->getFileList("./test_dir1");
		$expected = array(
			"./test_dir1/dir2",
			"./test_dir1/file2.txt",
		);
		$this->assertEquals($expected, $actual);
	}
}






