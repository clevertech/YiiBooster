<?php

/**
 * TbColorPicker widget class
 *
 * @author: yiqing95 <yiqing_95@qq.com>
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 * @package YiiBooster bootstrap.widgets
 * ------------------------------------------------------------------------
 *   in yii  use this to register the necessary js and css files :
 *   <?php  $this->widget('bootstrap.widgets.TbColorPicker', array( )); ?>
 *   and the rest usage you'd better refer the original plugin
 *
 * @see http://www.eyecon.ro/bootstrap-colorpicker/
 * ------------------------------------------------------------------------
 */
class TbColorPicker extends CWidget
{


    /**
     * @var \CClientScript
     */
    protected $cs;

    /**
     * @var array|string
     * -------------------------
     * the options will be passed to the underlying plugin
     *   eg:  js:{key:val,k2:v2...}
     *   array('key'=>$val,'k'=>v2);
     * -------------------------
     */
    public $options = array();


    /**
     * @var string
     */
    public $selector;


    /**
     * @var Bootstrap
     */
    protected $bootstrap ;

    /**
     * @return mixed
     */
    public function init()
    {
        parent::init();

        $this->cs = Yii::app()->getClientScript();
        // register necessary js file and css files
        $this->cs->registerCoreScript('jquery');
        $this->bootstrap = Yii::app()->bootstrap ;
        // register  bootstrap css
        $this->bootstrap->registerCoreCss();
        $this->bootstrap->registerAssetJs('bootstrap.colorpicker.js', CClientScript::POS_HEAD);
        $this->bootstrap->registerAssetCss('bootstrap-colorpicker.css');

        if (empty($this->selector)) {
            //just register the necessary css and js files ; you want use it manually
            return;
        }

        $options = empty($this->options) ? '' : CJavaScript::encode($this->options);

        $jsSetup = <<<JS_INIT
         $("{$this->selector}").colorpicker({$options});
JS_INIT;
        $this->cs->registerScript(__CLASS__ . '#' . $this->getId(), $jsSetup, CClientScript::POS_READY);

    }


    /**
     * @param string $name
     * @param mixed $value
     */
    public function __set($name, $value)
    {
        try {
            //shouldn't swallow the parent ' __set operation
            parent::__set($name, $value);
        } catch (Exception $e) {
            $this->options[$name] = $value;
        }
    }

}
