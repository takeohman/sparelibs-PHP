<?php
require_once __DIR__ . '/../Database/SQLAdapter.class.php';
require_once __DIR__ . '/../Database/BindParamGenerator.class.php';


$config = array(
//     'host'      => 'localhost',
    'database'  => 'test',
//     'user'      => 'root',
    'pass'      => ''
);

$pdoConfig =  new PDOConfig($config);

try{
	$db = new PDOExtended($pdoConfig);
	$adapter = new SQLAdapter($db);
	$gen = new BindParamGenerator();
	$gen->equal_('id',1)->or_()->not_equal_('id','2')->or_()->in_('id',array("1",2,3))->orderBy(array("id"=>"desc","value"=>"asc"));

	var_dump($gen->generate()->getConditionStr());
	var_dump($gen->generate()->getParamArray());
	$response = $adapter->selectAll("convert_task", array('id', 'account_id'), $gen->generate());
//	var_dump($response->getErrorInfo());
} catch (Exception $ex){
	var_dump($ex);
}

