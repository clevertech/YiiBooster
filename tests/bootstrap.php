<?php
/**
 * This is temporary harness to support current code which is tightly coupled to Yii application object.
 * It should be called once before each test, and instantiates our minimal CApplication object.
 */

// Included the Yii
define('YII_PATH', realpath(__DIR__ . '/../vendor/yiisoft/yii/framework'));

// disable Yii error handling logic
defined('YII_ENABLE_EXCEPTION_HANDLER') or define('YII_ENABLE_EXCEPTION_HANDLER', false);
defined('YII_ENABLE_ERROR_HANDLER') or define('YII_ENABLE_ERROR_HANDLER', false);

// Set up the shorthands for test app paths
define('APP_ROOT', realpath(__DIR__ . '/runtime'));
define('APP_RUNTIME', realpath(APP_ROOT . '/runtime'));
define('APP_ASSETS', realpath(APP_ROOT . '/assets'));

require_once(YII_PATH . '/YiiBase.php');
require_once(__DIR__ . '/fakes/Yii.php');

Yii::setPathOfAlias('bootstrap', __DIR__ . '/../src');

// Instantiated the test app
require_once(__DIR__ . '/fakes/MinimalApplication.php');

Yii::createApplication(
	'MinimalApplication',
	array(
		'basePath' => APP_ROOT,
		'runtimePath' => APP_RUNTIME,
		'components' => array(
			'assetManager' => array(
				'basePath' => APP_ASSETS // do not forget to clean this folder sometimes
			),
			'bootstrap' => array(
				'class' => 'bootstrap.components.Bootstrap'
			),
		)
	)
);

// See the `Boostrap.init()` method for explanation why it is needed
define('IS_IN_TESTS', true);
