<?php
/**
 * This is temporary harness to support current code which is tightly coupled to Yii application object.
 * It should be called once before each test, and instantiates our minimal CApplication object.
 *
 * PLEASE NOTE that you need to supply the real path to your Yii framework installation here for any tests to even run.
*/

define('YII_PATH', '/home/hijarian/systems/yii/framework');

require_once(YII_PATH.'/yii.php');

define('APP_ROOT', __DIR__.'/runtime');

require_once(__DIR__.'/fakes/MinimalApplication.php');

Yii::createApplication(
	'MinimalApplication',
	array(
		'basePath' => realpath(APP_ROOT),
		'runtimePath' => realpath(APP_ROOT.'/runtime'),
		'components' => array(
			'assetManager' => array(
				'basePath' => realpath(APP_ROOT.'/assets')
			)
		)
	)
);
