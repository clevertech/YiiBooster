<?php
/**
 * Built-in client script packages.
 *
 * Please see {@link CClientScript::packages} for explanation of the structure
 * of the returned array.
 *
 * @author Ruslan Fadeev <fadeevr@gmail.com>
 *
 * @var Bootstrap $this
 */
return array(

	'font-awesome' => array(
		'baseUrl' => $this->enableCdn ? '//netdna.bootstrapcdn.com/font-awesome/3.0.2/' : $this->getAssetsUrl(),
		'css' => array($this->minifyCss ? 'css/font-awesome.min.css' : 'css/font-awesome.css'),
	),
	'font-awesome-ie7' => array(
		'baseUrl' => $this->enableCdn ? '//netdna.bootstrapcdn.com/font-awesome/3.0.2/' : $this->getAssetsUrl(),
		'css' => array('css/font-awesome-ie7.min.css'),
		// only minified version exists in our assets and CDN serves minified version anyway
	),
	'bootstrap.js' => array(
		'baseUrl' => $this->enableCdn ? '//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/' : $this->getAssetsUrl() . '/bootstrap/',
		'js' => array($this->minifyCss ? 'js/bootstrap.min.js' : 'js/bootstrap.js'),
		'depends' => array('jquery'),
	),
	'bootstrap-yii' => array(
		'baseUrl' => $this->getAssetsUrl(),
		'css' => array('css/bootstrap-yii.css'),
	),
	'jquery-css' => array(
		'baseUrl' => $this->getAssetsUrl(),
		'css' => array('css/jquery-ui-bootstrap.css'),
	),
	'bootbox' => array(
		'baseUrl' => $this->getAssetsUrl(),
		'js' => array('js/bootstrap.bootbox.min.js'),
	),
	'notify' => array(
		'baseUrl' => $this->getAssetsUrl(),
		'css' => array('css/bootstrap-notify.css'),
		'js' => array('js/bootstrap.notify.js')
	),

	//widgets start
	'datepicker' => array(
		'depends' => array('jquery'),
		'baseUrl' => $this->enableCdn ? '//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.0.2/' : $this->getAssetsUrl(),
		'css' => array($this->minifyCss ? 'css/bootstrap-datepicker.min.css' : 'css/bootstrap-datepicker.css'),
		'js' => array($this->minifyCss ? 'js/bootstrap-datepicker.min.js' : 'js/bootstrap-datepicker.js')
	),
	'date' => array(
		'baseUrl' => $this->enableCdn ? '//cdnjs.cloudflare.com/ajax/libs/datejs/1.0/' : $this->getAssetsUrl() . '/js/',
		'js' => array('date.min.js')
	),
	'x-editable' => array(
		'baseUrl' => $this->getAssetsUrl(),
		'css' => array($this->minifyCss ? 'css/bootstrap-editable.min.css' : 'css/bootstrap-editable.css'),
		'js' => array($this->minifyCss ? 'js/bootstrap-editable.min.js' : 'js/bootstrap-editable.js'),
		'depends' => array('jquery')
	),
	'moment' => array(
		'baseUrl' => $this->getAssetsUrl(),
		'js' => 'moment.min.js',
	),
	'select2' => array(
		'baseUrl' => $this->getAssetsUrl(),
		'js' => array($this->minifyCss ? 'js/select.min.js' : 'js/select.js'),
		'css' => array('css/select.css'),
		'depends' => array('jquery'),
	)
);
