<?php

// remove this when not under construction
$PO8_UNDER_CONSTRUCTION = false;




if (!$PO8_UNDER_CONSTRUCTION)
{
	// change the following paths if necessary
	$yii=dirname(__FILE__).'/../framework/yii.php';
	$config=dirname(__FILE__).'/protected/config/main.php';
	
	// remove the following lines when in production mode
	defined('YII_DEBUG') or define('YII_DEBUG',true);
	
	// specify how many levels of call stack should be shown in each log message
	defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);

	require_once($yii);
	Yii::createWebApplication($config)->run();
} 
else 
{
	require_once('under_construction.php');
}
