<?php

/**
 * TbColorPicker widget class
 *
 * @author: yiqing95 <yiqing_95@qq.com>
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 * @package YiiBooster bootstrap.widgets
 *
 * ------------------------------------------------------------------------
 * @see http://www.eyecon.ro/bootstrap-colorpicker/
 * ------------------------------------------------------------------------
 */
class TbColorPicker extends CWidget
{
    /**
     * @static
     * @return string
     * return this widget assetsUrl
     */
    public static function getAssetsUrl()
    {
        return Yii::app()->bootstrap->getAssetsUrl();
    }


    /**
     * @var string
     */
    public $baseUrl;


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
     * @return BootColorPicker
     */
    public function publishAssets()
    {
        $this->baseUrl = self::getAssetsUrl() . '/bootcolorpicker';
        return $this;
    }


    /**
     * @return mixed
     */
    public function init()
    {

        parent::init();

        $this->cs = Yii::app()->getClientScript();
        // publish assets and register css/js files
        $this->publishAssets();
        // register necessary js file and css files
        $this->cs->registerCoreScript('jquery');
        // register  bootstrap css
        Yii::app()->bootstrap->registerCoreCss();

        $this->registerScriptFile('js/bootstrap-colorpicker.js', CClientScript::POS_HEAD);

        $this->registerCssFile('css/colorpicker.css');

        if (empty($this->selector)) {
            //just register the nessisary css and js files ; you want use it manually
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

    /**
     * @param $fileName
     * @param int $position
     * @return \TbColorPicker
     * @throws InvalidArgumentException
     */
    protected function registerScriptFile($fileName, $position = CClientScript::POS_END)
    {
        if (is_string($fileName)) {
            $jsFiles = explode(',', $fileName);
        } elseif (is_array($fileName)) {
            $jsFiles = $fileName;
        } else {
            throw new InvalidArgumentException('you must give a string or array as first argument , but now you give' . var_export($fileName, true));
        }
        foreach ($jsFiles as $jsFile) {
            $jsFile = trim($jsFile);
            $this->cs->registerScriptFile($this->baseUrl . '/' . ltrim($jsFile, '/'), $position);
        }
        return $this;
    }

    /**
     * @param $fileName
     * @return \TbColorPicker
     * @throws InvalidArgumentException
     */
    protected function registerCssFile($fileName)
    {
        $cssFiles = func_get_args();
        foreach ($cssFiles as $cssFile) {
            if (is_string($cssFile)) {
                $cssFiles2 = explode(',', $cssFile);
            } elseif (is_array($cssFile)) {
                $cssFiles2 = $cssFile;
            } else {
                throw new InvalidArgumentException('you must give a string or array as first argument , but now you give' . var_export($cssFiles, true));
            }
            foreach ($cssFiles2 as $css) {
                $this->cs->registerCssFile($this->baseUrl . '/' . ltrim($css, '/'));
            }
        }
        return $this;
    }


}
