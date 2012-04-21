<?php

function _joinpath($dir1, $dir2) {
    return realpath($dir1 . '/' . $dir2);
}

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.

// Define a path alias
//Yii::setPathOfAlias('product-images','/images/product-images/');
 
$homePath      = dirname(__FILE__) . '/../..';
$protectedPath = _joinpath($homePath, 'protected');
$runtimePath   = _joinpath($homePath, 'runtime');

return array(
	'basePath' => $protectedPath,
	'runtimePath' => $runtimePath,
	
	'defaultController' => 'site',
	'name'=>'DEBUG Mode | Handmade Pirate Costumes and Renaissance Clothing | Pieces of Eight Costumes',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'ext.giix-components.*', // giix components
	),

	'modules'=>array(		
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'generatorPaths' => array(
				'ext.giix-core', // giix generators
			),
			'password'=>'294992',
		 	// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
	),

	// application components
	'components'=>array(
		'session' => array(
			'sessionName' => 'PiecesOfEight_Session',
			'cookieMode' => 'only',
		),
		'user'=>array(
			// enable cookie-based authentication
			//'allowAutoLogin'=>true,
		),
		// uncomment the following to enable URLs in path-format
		
		/*'urlManager'=>array(
			'urlFormat'=>'path',
			'showScriptName' => false,
			'rules'=>array(
				'' => 'site/index',
				
				'<action:\w+>' => 'cart/view',
				'<action:(comments|events|contact)>' => 'site/<action>', // turns site/:action into /:action
				
				'<view:\w+>' => 'site/page', // turns site/page?view=whatever to /whatever
				'<controller:\w+>/<action:\w+>/<category:\w+>'=>'<controller>/<action>', // turns product/list?category=??? to product/list/???
				
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
				
				
			),
		),*/
		
		'YImage' => array(
			'class' => 'application.extensions.YImage.CImageComponent',
			'driver' => 'GD',
		),
		
		
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=piecesofeight',
			'emulatePrepare' => true,
			'enableProfiling' => true,
			'enableParamLogging' => true,
			'username' => 'brixican',
			'password' => 'brixican',
			'charset' => 'utf8',
		),
		
		'errorHandler'=>array(
			// use 'site/error' action to display errors
            'errorAction'=>'site/error',
        ),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				
				array(
					'class'=>'CWebLogRoute',
				),
				
			),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'holy.crap.its.aj@gmail.com',
		//'adminEmail'=>'piecesof8costumes@comcast.net',
	),
);