<?php

function _joinpath($dir1, $dir2) {
    return realpath($dir1 . '/' . $dir2);
}

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.

// Define a path alias
//Yii::setPathOfAlias('product-images','/images/product-images/');

$debug = true;
if (!defined('YII_DEBUG') || constant('YII_DEBUG') == false)
{
	$debug = false;
}

$homePath      = dirname(__FILE__) . '/../..';
$protectedPath = _joinpath($homePath, 'protected');
$runtimePath   = _joinpath($homePath, 'runtime');


$config = array();
$config['basePath'] = $protectedPath;
$config['runtimePath'] = $runtimePath;
$config['defaultController'] = 'site';

$config['name'] = 'Handmade Pirate Costumes and Renaissance Clothing | Pieces of Eight Costumes';
if ($debug) 
{
	$config['name'] = 'DEBUG Mode | ' . $config['name'];
}

// preloading 'log' component
$config['preload'] = array('log');

// autoloading model and component classes
$config['import'] = array(
	'application.models.*',
	'application.components.*',
	'ext.giix-components.*', 	// giix components
);

// Load modules
$config['modules'] = array();
if ($debug)
{
	$config['modules']['gii'] = array(
		'class'=>'system.gii.GiiModule',
		'generatorPaths' => array(
			'ext.giix-core', // giix generators
		),
		'password'=>'294992',
		// If removed, Gii defaults to localhost only. Edit carefully to taste.
		'ipFilters'=>array('127.0.0.1','::1'),
	);
}


//
// Components
//
$config['components'] = array();

$config['components']['session'] = array(
	'sessionName' => 'PiecesOfEight_Session',
	'cookieMode' => 'only',
);

$config['components']['user'] = array(
	
);

$config['components']['urlManager'] = array(
	'urlFormat'=>'path',
	'showScriptName' => false,
	'rules'=>array(
		// Custom rules go first
		'' => 'site/index',
		'custom-order' => 'product/custom',
		'<action:(comments|events|contact)>/<pid:\d+>' => 'site/<action>',
		'<action:(comments|events|contact|newsletter)>' => 'site/<action>',
				
		'admin/<action:(login|logout)>' => 'site/<action>',
		'admin/gallery' => 'product/gallery',
		'admin/product/<id:\d+>' => 'product/create',
		'admin/product' => 'product/create',
		
				
		'<action:(lookbook)>' => 'product/<action>',
		'product/bingProductFeed.txt' => 'product/bingProductFeed',
		'product/<id:\d+>/<name>' => 'product/view',
		'product/<id:\d+>' => 'product/view',
		'products/<category>' => 'product/list',
		'products' => 'product/list',
		'product/getProductCustomForm/<id:\d+>/<form_id:\d+>' => 'product/getProductCustomForm',
		'cart' => 'cart/view',			
				
		// Default controller url setup
		'<controller:\w+>/<id:\d+>' => '<controller>/view',
		'<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
		// Defaults to a site page if not above
		'<view:[a-zA-Z0-9-]+>/' => 'site/page',
		'<controller:\w+>/<action:\w+>' => '<controller>/<action>',
	),
);

$config['components']['YImage'] = array(
	'class' => 'application.extensions.YImage.CImageComponent',
	'driver' => 'GD',
);


$config['components']['db'] = 
	($debug) 
	?
		// Debug mode
		array(
			'connectionString' => 'mysql:host=localhost;dbname=piecesofeight',
			'emulatePrepare' => true,
			'enableProfiling' => true,
			'enableParamLogging' => true,
			'username' => 'brixican',
			'password' => 'brixican',
			'charset' => 'utf8',
		)
	:
		// Production mode
		array(
			'connectionString' => 'mysql:host=localhost;dbname=sperez8_piecesofeight',
			'emulatePrepare' => true,
			'enableProfiling' => true,
			'enableParamLogging' => true,
			'username' => 'sperez8_admin',
			'password' => 'a:JPz042488',
			'charset' => 'utf8',
		);
		

$config['components']['errorHandler'] = array(
	// use 'site/error' action to display errors
	'errorAction' => 'site/error'
);

// log component

$config['components']['log'] = array(
	'class' => 'CLogRouter',
	'routes' => array(
		array(
			'class' => 'CFileLogRoute',
			'levels'=>'error, warning',
		),
	)
);
if ($debug)
{
	array_push($config['components']['log']['routes'], array('class'=>'CWebLogRoute'));
}

$config['params'] = array(
	// this is used in contact page
	'adminEmail'=> ($debug) ? 'holy.crap.its.aj@gmail.com' : 'piecesof8costumes@comcast.net',
	'webmasterEmail'=>'piecesof8costumes@gmail.com',
);

return $config;