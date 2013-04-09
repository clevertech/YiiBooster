<?php
/**
 * Built-in client script packages.
 *
 * Please see {@link CClientScript::packages} for explanation of the structure
 * of the returned array.
 *
 * @author Ruslan Fadeev <fadeevr@gmail.com>
 */
 return array(
     'bootstrap'     => array(
         'baseUrl' => $this->enableCdn ? '//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.1/' : $this->getAssetsUrl(),
         'css'     => array(YII_DEBUG ? 'css/bootstrap.css' : 'css/bootstrap.min.css'),
     ),
     'bootstrap.js'  => array(
         'baseUrl' => $this->enableCdn ? '//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.1/' : $this->getAssetsUrl(),
         'js'      => array(YII_DEBUG ? 'js/bootstrap.js' : 'js/bootstrap.min.js'),
         'depends' => array('jquery'),
     ),
     'responsive'    => array(
         'baseUrl' => $this->enableCdn ? '//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.1/css/' : $this->getAssetsUrl(),
         'css'     => array(YII_DEBUG ? 'bootstrap-responsive.css' : 'bootstrap-responsive.min.css'),
         'depends' => array('bootstrap')
     ),
     'font-awesome'  => array(
         'baseUrl' => $this->enableCdn ? '//netdna.bootstrapcdn.com/font-awesome/3.0.2/css/' : $this->getAssetsUrl(),
         'css'     => array(YII_DEBUG ? 'font-awesome.css' : 'font-awesome.min.css'),
     ),
     'font-awesome-ie7'  => array(
         'baseUrl' => $this->enableCdn ? '//netdna.bootstrapcdn.com/font-awesome/3.0.2/css/' : $this->getAssetsUrl(),
         'css'     => array('font-awesome-ie7.min.css'), // only minified version exists in our assets and CDN serves minified version anyway
     ),
     'full.css'      => array(
         'baseUrl' => $this->enableCdn ? '//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.1/' : $this->getAssetsUrl(),
         'css'     => array(YII_DEBUG ? 'css/bootstrap-combined.no-icons.css' : 'css/bootstrap-combined.no-icons.min.css'),
     ),
     'bootstrap-yii' => array(
         'baseUrl' => $this->getAssetsUrl(),
         'css'     => array('css/bootstrap-yii.css'),
     ),
     'jquery-css'    => array(
         'baseUrl' => $this->getAssetsUrl(),
         'css'     => array('css/jquery-ui-bootstrap.css'),
     ),
     'bootbox'    => array(
         'baseUrl' => $this->getAssetsUrl(),
         'js'      => array('js/bootstrap.bootbox.min.js'),
     ),
     'notify'    => array(
         'baseUrl' => $this->getAssetsUrl(),
         'css'     => array('css/bootstrap-notify.css'),
         'js'      => array('bootstrap.notify.js')
     ),
 );
