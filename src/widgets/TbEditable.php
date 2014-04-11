<?php

class TbEditable extends CWidget
{

    /**
     * @var string type of editable widget. Can be `text`, `textarea`, `select`, `date`, `checklist`, etc.
     * @see x-editable
     */
    public $type = null;

    /**
     * @var string url to submit value. Can be string or array containing Yii route, e.g. `array('site/updateUser')`
     * @see x-editable
     */
    public $url = null;

    /**
     * @var mixed primary key
     * @see x-editable
     */
    public $pk = null;

    /**
     * @var string name of field
     * @see x-editable
     */
    public $name = null;

    /**
     * @var array additional params to send on server
     * @see x-editable
     */
    public $params = null;

    /**
     * @var string mode of input: `inline` | `popup`. If not set - default X-editable value is used: `popup`.
     * @see x-editable
     */
    public $mode = 'popup';

    /**
     * @var string placement of popup. Can be `left`, `top`, `right`, `bottom`.
     * If `null` - default X-editable value is used: `top`
     * @see x-editable
     */
    public $placement = 'top';

    /**
     * @var boolean will editable be initially disabled. It means editable plugin will be applied to element,
     * but you should call `.editable('enable')` method to activate it.
     * To totally disable applying 'editable' to element use **apply** option.
     * @see x-editable
     */
    public $disabled = false;

    /**
     * @var boolean whether to apply 'editable' js plugin to element.
     * Only **safe** attributes become editable.
     */
    public $apply = true;


    /**
     * @var string text shown on empty field.
     * If `null` - default X-editable value is used: `Empty`
     * @see x-editable
     */
    public $emptytext = 'Empty';

    /**
     * @var string text to be shown as element content
     */
    public $text = null;

    /**
     * @var mixed initial value. If not set - will be taken from text
     * @see x-editable
     */
    public $value = null;

    /**
     * @var array HTML options of element
     */
    public $htmlOptions = array();

    /**
     * @var array all config options of x-editable.
     * See full list <a href="http://vitalets.github.com/x-editable/docs.html#editable">here</a>.
     */
    public $options = array();

    /**
     * @var boolean whether to HTML encode text on output
     */
    public $encode = true;

    /**
     * @var string title of popup. If `null` - will be generated automatically from attribute label.
     * Can have token {label} inside that will be replaced with actual attribute label.
     */
    public $title = null;

    /**
     * @var mixed source data for **select**, **checklist**. Can be string (url) or array in format:
     * array( array("value" => 1, "text" => "abc"), ...)
     *
     * @package list
     * @see x-editable
     */
    public $source = null;

    /**
     * @var string format to send date on server. If `null` - default X-editable value is used: `yyyy-mm-dd`.
     *
     * @package date
     * @see x-editable
     */
    public $format = null;

    /**
     * @var string format to display date in element. If `null` - equals to **format** option.
     *
     * @package date
     * @see x-editable
     */
    public $viewformat = null;

    /**
     * @var string template for **combodate** input. For details see http://vitalets.github.com/x-editable/docs.html#combodate.
     *
     * @package combodate
     * @see x-editable
     */
    public $template = null;

    /**
     * @var array full config for **combodate** input. For details see http://vitalets.github.com/combodate/#docs
     *
     * @package combodate
     * @see x-editable
     */
    public $combodate = null;

    /**
     * @var string separator used to display tags.
     *
     * @package select2
     * @see x-editable
     */
    public $viewseparator = null;

    /**
     * @var array full config for **select2** input. For details see http://ivaynberg.github.com/select2
     *
     * @package select2
     * @see x-editable
     */
    public $select2 = null;

    /**
     * @var string HTML ID of the parent element, to restrict application of the plugin
     *
     * @deprecated 3.0.0 Why it is even exists? This widget is to make a singular editable field anyway,
     * we should generate direct ID selectors, not a[rel=:rel] ones! This property will be removed
     * from the next backwards-incompatible release.
     */
    public $parentid = null;

    /**
     * @var string css class of input. If `null` - default X-editable value is used: `input-medium`
     * @see x-editable
     */
    public $inputclass = 'input-medium';

    //methods
    /**
     * A javascript function that will be invoked to validate value.
     * Example:
     * <pre>
     * 'validate' => 'js: function(value) {
     *     if ($.trim(value) == "") return "This field is required";
     * }'
     * </pre>
     *
     * @var string
     * @package callback
     * @see x-editable
     * @example
     */
    public $validate = null;

    /**
     * A javascript function that will be invoked to process successful server response.
     * Example:
     * <pre>
     * 'success' => 'js: function(response, newValue) {
     *     if (!response.success) return response.msg;
     * }'
     * </pre>
     *
     * @var string
     * @package callback
     * @see x-editable
     */
    public $success = null;

    /**
     * A javascript function that will be invoked to custom display value.
     * Example:
     * <pre>
     * 'display' => 'js: function(value, sourceData) {
     *      var escapedValue = $("&lt;div&gt;").text(value).html();
     *      $(this).html("&lt;b&gt;"+escapedValue+"&lt;/b&gt;");
     * }'
     * </pre>
     *
     * @var string
     * @package callback
     * @see x-editable
     */
    public $display = null;

    // --- X-editable events ---
    /**
     * A javascript function that will be invoked when editable element is initialized.
     *
     * @var string
     * @package event
     * @see x-editable
     */
    public $onInit;

    /**
     * A javascript function that will be invoked when editable form is shown
     * Example:
     * <pre>
     * 'onShown' => 'js: function() {
     *     var $tip = $(this).data("editableContainer").tip();
     *     $tip.find("input").val("overwriting value of input.");
     * }'
     * </pre>
     *
     * @var string
     * @package event
     * @see x-editable
     */
    public $onShown;

    /**
     * A javascript function that will be invoked when new value is saved
     * Example:
     * <pre>
     * 'onSave' => 'js: function(e, params) {
     *     alert("Saved value: " + params.newValue);
     * }'
     * </pre>
     *
     * @var string
     * @package event
     * @see x-editable
     */
    public $onSave;

    /**
     * A javascript function that will be invoked when editable form is hidden
     * Example:
     * <pre>
     * 'onHidden' => 'js: function(e, reason) {
     *    if (reason === "save" || reason === "cancel") {
     *        //auto-open next editable
     *        $(this).closest("tr").next().find(".editable").editable("show");
     *    }
     * }'
     * </pre>
     *
     * @var string
     * @package event
     * @see x-editable
     */
    public $onHidden;

    /** @var bool */
    private $_prepareToAutoText = false;

    public function init()
    {
        parent::init();

        if (!$this->name) {
            throw new CException('Parameter "name" should be provided for Editable widget');
        }

        /**
         * If set this flag to true --> element content will stay empty and value will
         * be rendered to data-value attribute to apply autotext.
         */
        $this->setPrepareToAutoText(
            (!isset($this->options['autotext']) || $this->options['autotext'] !== 'never')
            && in_array($this->type, array('select', 'checklist', 'date', 'dateui', 'combodate', 'select2'))
        );

        /**
         * For `date` and `datetime` we need format to be on php side to make conversions.
         * But we can not set default format as datepicker and combodate has different formats.
         * So do it here:
         */
        if (!$this->format && $this->type == 'date') {
            $this->format = 'yyyy-mm-dd';
        }
    }

    /**
     * @return bool
     */
    public function getPrepareToAutoText()
    {
        return $this->_prepareToAutoText;
    }

    /**
     * @param bool $value
     */
    protected function setPrepareToAutoText($value)
    {
        $this->_prepareToAutoText = $value;
    }

    public function getClientScript($unique = true)
    {
    	$selector = $this->getSelector($unique);
        // target the specific field if parent ID is specified
        $rel = $unique ? "rel=$selector" : "rel^=$selector";
        if ($this->parentid) {
            $script = "$('#{$this->parentid} a[$rel]')";
        } else {
            $script = "$('a[$rel]')";
        }

        //attach events
        foreach (array('init', 'shown', 'save', 'hidden') as $event) {
            $eventName = 'on' . ucfirst($event);
            if (isset($this->$eventName)) {
                // CJavaScriptExpression appeared only in 1.1.11, will turn to it later
                //$event = ($this->onInit instanceof CJavaScriptExpression) ? $this->onInit : new CJavaScriptExpression($this->onInit);
                $eventJs = (strpos($this->$eventName, 'js:') !== 0 ? 'js:' : '') . $this->$eventName;
                $script .= "\n.on('" . $event . "', " . CJavaScript::encode($eventJs) . ")";
            }
        }

        //apply editable
        $options = CJavaScript::encode($this->options);
        $script .= ".editable($options);";

        return $script;
    }
    
    public function registerClientScript($unique = true)
    {
        $script = $this->getClientScript($unique);

        // unique script ID depending on the parent
        if ($this->parentid) {
            Yii::app()->getClientScript()->registerScript(
                __CLASS__ . '#' . $this->parentid . '-' . $this->id,
                $script
            );
        } else {
            Yii::app()->getClientScript()->registerScript(__CLASS__ . '#' . $this->id, $script);
        }

        return $script;
    }

    /**
     *
     */
    protected function setDataPk()
    {
        //set data-pk only for existing records
        if ($this->pk !== null) {
            $this->htmlOptions = CMap::mergeArray($this->htmlOptions, array(
                'data-pk' => is_array($this->pk) ? CJSON::encode($this->pk) : $this->pk
            ));
        }
    }

    /**
     * @return string
     */
    public function getSelector($unique = true)
    {
        $pk = $this->pk;
        if($pk === null) {
            $pk = 'new';
        } else {
            //support of composite keys: convert to string: e.g. 'id-1_lang-ru'
            if(is_array($pk)) {
                //below not works in PHP < 5.3, see https://github.com/vitalets/x-editable-yii/issues/39
                //$pk = join('_', array_map(function($k, $v) { return $k.'-'.$v; }, array_keys($pk), $pk));
                $buffer = array();
                foreach($pk as $k => $v) {
                    $buffer[] = $k.'-'.$v;
                }
                $pk = join('_', $buffer);
            }
        }
        return $unique ? $this->name.'_'.$pk : $this->name;
    }

    /**
     *
     */
    protected function generateTitle()
    {
        if ($this->title === null) {
            $titles = array(
                'Select' => array('select', 'date'),
                'Check' => array('checklist')
            );
            $title = Yii::t('TbEditable.editable', 'Enter');
            foreach ($titles as $t => $types) {
                if (in_array($this->type, $types)) {
                    $title = Yii::t('TbEditable.editable', $t);
                }
            }
            $this->title = $title . ' ' . $this->value;
        } else {
            $this->title = strtr($this->title, array('{label}' => $this->value));
        }
    }

    public function buildHtmlOptions()
    {
        //html options
        $htmlOptions = array(
            'href' => '#',
            'rel' => $this->getSelector(),
        );

        //if input type assumes autotext (e.g. select) we define value directly in data-value
        //and do not fill element contents
        if ($this->getPrepareToAutoText()) {
            //for date we use 'format' to put it into value (if text not defined)
            if ($this->type == 'date') {
                //if date comes as object, format it to string
                if ($this->value instanceOf DateTime) {
                    /*
                    * unfortunatly datepicker's format does not match Yii locale dateFormat,
                    * we need replacements below to convert date correctly
                    */
                    $count = 0;
                    $format = str_replace('MM', 'MMMM', $this->format, $count);
                    if (!$count) {
                        $format = str_replace('M', 'MMM', $format, $count);
                    }
                    if (!$count) {
                        $format = str_replace('m', 'M', $format);
                    }

                    $this->value = Yii::app()->dateFormatter->format($format, $this->value->getTimestamp());
                }
            }

            $this->htmlOptions['data-value'] = $this->value;
        }

        //merging options
        $this->htmlOptions = CMap::mergeArray($this->htmlOptions, $htmlOptions);
        $this->setDataPk();
    }

    public function buildJsOptions()
    {
        $this->url = CHtml::normalizeUrl($this->url);

        $this->generateTitle();

        $options = array(
            'type' => $this->type,
            'url' => $this->url,
            'name' => $this->name,
            'title' => CHtml::encode($this->title),
        );

        //simple options set directly from config
        $optionsList = array(
            'mode', 'placement', 'emptytext', 'params', 'inputclass', 'format', 'viewformat',
            'template', 'combodate', 'select2', 'viewseparator',
        );
        foreach ($optionsList as $option) {
            if ($this->$option) {
                $options[$option] = $this->$option;
            }
        }

        if ($this->source) {
            //if source is array --> convert it to x-editable format.
            //Since 1.1.0 source as array with one element is NOT treated as Yii route!
            if (is_array($this->source)) { // array
            	$this->htmlOptions['data-source'] = $this->prepareArray($this->source);
            	unset($options['source']);  
            } elseif (is_callable($this->source)) { // function that return an array 
            	$array = $this->evaluateExpression($this->source, array('model'=>$this->model));
            	if(!is_array($array))
            		throw new CException('Parameter "source" function must return and array');
            	$this->htmlOptions['data-source'] = $this->prepareArray($array);
            	unset($options['source']);
            } else { //source is url
                $options['source'] = $this->source;
            }
        }

        if (!isset($this->options['datepicker']['language'])) {
            $this->options['datepicker']['language'] = substr(Yii::app()->getLanguage(), 0, 2);
        }

        //callbacks
        foreach (array('validate', 'success', 'display') as $method) {
            if (isset($this->$method)) {
                $options[$method] = (strpos($this->$method, 'js:') !== 0 ? 'js:' : '') . $this->$method;
            }
        }

        //merging options
        $this->options = CMap::mergeArray($this->options, $options);
    }

    /**
     * 
     */
    private function prepareArray($array)
    {
    	$ret = array();
    	if (isset($array[0]) && is_array($array[0])) { //if first elem is array assume it's normal x-editable format, so just pass it
    		$ret = $array;
    	} else { //else convert to x-editable source format {value: 1, text: 'abc'}
    		$ret = array();
    		foreach ($array as $value => $text) {
    			$ret[] = array('value' => $value, 'text' => $text);
    		}
    	}
    	return json_encode($ret);
    }
    
    /**
     *
     */
    public function registerAssets()
    {
        $booster = Bootstrap::getBooster();
        $booster->registerPackage('x-editable');

        if ($this->type == 'date' || $this->type == 'combodate') {
            /** @var $widget TbDatePicker */
            $widget = Yii::app()->widgetFactory->createWidget(
                $this->getOwner(),
                'bootstrap.widgets.TbDatePicker',
                array('options' => $this->options['datepicker'])
            );
            $widget->registerLanguageScript();
        }
        elseif ($this->type == 'datetime') {
            $booster->registerPackage('datetimepicker');

            /** @var $widget TbDateTimePicker */
            $widget = Yii::app()->widgetFactory->createWidget(
                $this->getOwner(),
                'bootstrap.widgets.TbDateTimePicker',
                array('options' => $this->options['datetimepicker'])
            );
            $widget->registerLanguageScript();
        }
        //include moment.js if needed
        if ($this->type == 'combodate') {
            $booster->registerPackage('moment');
        } //include select2 if needed
        elseif ($this->type == 'select2') {
            $booster->registerPackage('select2');
        }
    }

    /**
     *
     */
    public function run()
    {
        if ($this->apply === false) {
            $this->renderText();
        } else {
            $this->buildHtmlOptions();
            $this->buildJsOptions();
            $this->registerAssets();
            $this->registerClientScript();
            $this->renderLink();
        }
    }

    /**
     *
     */
    public function renderLink()
    {
        echo CHtml::openTag('a', $this->htmlOptions);
        $this->renderText();
        echo CHtml::closeTag('a');
    }

    /**
     *
     */
    public function renderText()
    {
        $encodedText = $this->encode ? CHtml::encode($this->text) : $this->text;
        if ($this->type == 'textarea') {
            $encodedText = preg_replace('/\r?\n/', '<br>', $encodedText);
        }
        echo $encodedText;
    }
} 