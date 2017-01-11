<?php


class ClassObjectGetter {
	/**
	 * @param $class_name
	 * @return false of class object
	 */
	public function getClassObjectByClassName($class_name){
		if ( !class_exists($class_name) ){
			return false;
		}
		return new $class_name();
	}

	/**
	 * @param $class_name
	 * @param $method_name
	 * @return false or class object
	 */
	public function getClassObjectByClassAndMethodName($class_name, $method_name){

		$obj = $this->getClassObjectByClassName($class_name);

		if ( !method_exists($obj, $method_name) ){
			return false;
		}
		return $obj;
	}
}
