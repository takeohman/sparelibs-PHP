<?php
class LocalFileListGetter{
	public $debug;
	const OPT_NOOPTION  = 0;
	const OPT_RECURSIVE = 1;
	const OPT_ONLYFILE  = 2;
	const OPT_ONLYDIR   = 4;

	protected $optionFlag;
	protected $isRecursive;
	protected $isOnlyFileNeeded;
	protected $fileNameRegexp;
	protected $userFunc;

	public function __construct(){
		$this->debug = false;
		$this->setOption(self::OPT_NOOPTION);
		$this->setFileNameRegexp('');
		$this->userFunc = '';
	}
	public function getOption($option){
		if(is_int($option)){
			return $this->optionFlag & $option?true:false;
		}
		return false;
	}
	public function setOption($option,$isUnset=false){
		if($isUnset===false){
			$this->optionFlag |= $option;
		}else{
			$this->optionFlag &= ~$option;
		}
		if($this->debug) echo "option flag = {$this->optionFlag}".PHP_EOL;
		return $this->getOption($option);
	}
	public function setFileNameRegexp($regexp=''){
		$this->fileNameRegexp = $regexp;
	}
	public function getFileNameRegexp(){
		return $this->fileNameRegexp; 
	}
	public function getFileList($dir){
		if($dir == ''){
			return false;
		}else{
			$resultFileList= '';
			$this->_getFileList($dir,$resultFileList);
			return $resultFileList;
		}
		
	}
	protected function _getFileList($dir,&$ioFileList){
		if(!is_array($ioFileList)){
			$ioFileList=array();
		}
		if (is_dir($dir)) {
			if (substr($dir,-1) != '/'){
				$dir .= '/';
			}
			if ($dh = opendir($dir)) {
				while (($file = readdir($dh)) !== false) {
					if($file == "." || $file == ".."){
						continue;
					}
					$filePath = $dir.$file;
					if(is_dir($filePath)){
						//ディレクトリを返すかどうかの判断
						if(!$this->getOption(self::OPT_ONLYFILE) || $this->getOption(self::OPT_ONLYDIR)){

							if($this->fileNameRegexp == '' || ($this->fileNameRegexp != '' && preg_match($this->fileNameRegexp,$file))){
								if($this->userFunc == ''){
									array_push($ioFileList,$dir.$file);
								}else{
									$userResult = call_user_func($this->userFunc,$dir.$file);
									if($userResult != ''){
										array_push($ioFileList,$userResult);
									}
								}
							}	
						}
						if($this->getOption(self::OPT_RECURSIVE)){
							$this->_getFileList($filePath.'/',$ioFileList);
						}
					}else{
						if($this->fileNameRegexp != '' && !preg_match($this->fileNameRegexp,$file)){
							continue;
						}

						if($this->getOption(self::OPT_ONLYFILE) || !$this->getOption(self::OPT_ONLYDIR)){
							if($this->userFunc == ''){
								array_push($ioFileList,$dir.$file);
							}else{
								$userResult = call_user_func($this->userFunc,$dir.$file);
								if($userResult != ''){
									array_push($ioFileList,$userResult);
								}
							}
						}
					}
//					echo "filename: $file".PHP_EOL;
//					echo "filetype: " . filetype($dir . $file) . PHP_EOL;
				}
				closedir($dh);
			}
		}
	}
	function ll($dir){
		$list = $this->getFileList($dir);
		var_dump($list);

	}
	function setUserFunc($inUserFunctionName = ''){
		if($inUserFunctionName != '' && function_exists($inUserFunctionName)){
			$this->userFunc = $inUserFunctionName;
			return true;
		}else{
			$this->userFunc = '';
		}
		return false;
	}
}
 ?>
