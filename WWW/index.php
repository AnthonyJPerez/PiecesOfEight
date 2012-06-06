<?php

// remove this when not under construction
$PO8_UNDER_CONSTRUCTION = false;
$P08_LIVE = false;



if (!$PO8_UNDER_CONSTRUCTION)
{
	// Development
	if (!$P08_LIVE)
	{
		$yii=dirname(__FILE__).'/../../framework/yii.php';
		$config=dirname(__FILE__).'/../piecesofeight_core/protected/config/live.php';
		
		// remove the following lines when in production mode
		defined('YII_DEBUG') or define('YII_DEBUG',true);
		
		// specify how many levels of call stack should be shown in each log message
		defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);
	}
	else
	{
		// Live website
		define('YII_DEBUG',false);
		$yii = dirname(__FILE__).'/../yii/1.1.10/framework/yii.php';
		$config=dirname(__FILE__).'/../piecesofeight_core/protected/config/live.php';
	}

	require_once($yii);
	Yii::createWebApplication($config)->run();
} 
else 
{
	require_once('under_construction.php');
}
