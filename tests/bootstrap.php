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
define('APP_RUNTIME', APP_ROOT . '/runtime');
define('APP_ASSETS', APP_ROOT . '/assets');

is_dir(APP_RUNTIME) or mkdir(APP_RUNTIME);
is_dir(APP_ASSETS) or mkdir(APP_ASSETS);

// composer autoloader
require_once(__DIR__ . '/../vendor/autoload.php');

require_once(YII_PATH . '/YiiBase.php');
require_once(__DIR__ . '/fakes/Yii.php');

YiiBase::$enableIncludePath = false;

// Instantiated the test app
require_once(__DIR__ . '/fakes/MinimalApplication.php');

Yii::createApplication(
	'MinimalApplication',
	array(
		'basePath' => APP_ROOT,
		'runtimePath' => APP_RUNTIME,
		'aliases' => [
			'fakes' => realpath(__DIR__ . '/fakes'),
			'bootstrap' => realpath(__DIR__ . '/../src'),
		],
		'components' => array(
			'assetManager' => array(
				'basePath' => APP_ASSETS // do not forget to clean this folder sometimes
			),
			'bootstrap' => array(
				'class' => 'booster.components.Booster'
			),
		)
	)
);

// fix bug in yii's autoloader (https://github.com/yiisoft/yii/issues/1907)
Yii::import('fakes.*');

// See the `Boostrap.init()` method for explanation why it is needed
define('IS_IN_TESTS', true);
