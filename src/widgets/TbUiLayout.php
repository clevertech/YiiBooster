<?php

/**
 * WARNING!
 * This widget is not ready yet!
 * We strongly recommend not to use it in production.
 * Not all the components inside work as we are expecting.
 *
 * About additional information you can read here:
 * @link http://layout.jquery-dev.net/documentation.cfm
 *
 * @since 2.1.0
 */
class TbUiLayout extends CWidget
{
    public $jsVarName;

    /**
     * @var array the HTML attributes for the widget container.
     */
    public $htmlOptions = array();

    /** @var array widget options */
    public $options = array();

    /**
     * Options for each layouts, you can specify only 'center', 'north', 'south', 'east' and 'west'.
     * @var array
     */
    public $layouts = array();

    /**
     *
     */
    public function init()
    {
        Bootstrap::getBooster()->registerPackage('ui-layout');

        if (!is_array($this->options)) {
            $this->options = array();
        }

        if (!is_array($this->htmlOptions)) {
            $this->htmlOptions = array();
        }
    }

    /**
     *
     */
    public function run()
    {
        /** @var CClientScript $cs */
        $cs = Yii::app()->getClientScript();

        // Javascript var
        if (empty($this->jsVarName)) {
            $this->jsVarName = $this->getId() . 'Layout';
        }

        // Container ID
        if (!isset($this->htmlOptions['id'])) {
            $this->htmlOptions['id'] = $this->getId();
        }

        $id = $this->htmlOptions['id'];

        echo CHtml::openTag('div', $this->htmlOptions);
        $layoutsOptions = $this->renderLayouts();
        echo '</div>';

        // Prepare options
        $options = CMap::mergeArray($this->options, $layoutsOptions);
        $options = empty($options) ? '' : CJavaScript::encode($options);

        // Register global JS var
        $cs->registerScript(__CLASS__ . '#jsVar#' . $this->getId(), 'var '.$this->jsVarName.';', CClientScript::POS_HEAD);
        // Register Layouts init script
        $cs->registerScript(__CLASS__ . '#init#' . $this->getId(), $this->jsVarName.' = $("#'.$id.'").layout('.$options.');', CClientScript::POS_READY);
    }

    /**
     * @return array
     */
    protected function renderLayouts()
    {
        $layoutsOptions = array();
        $availableLayouts = array('center', 'north', 'south', 'east', 'west');

        foreach ($availableLayouts as $layoutName) {
            if (!isset($this->layouts[$layoutName])) {
                continue;
            }
            $layout = $this->layouts[$layoutName];

            // Empty
            if (!is_array($layout) && !isset($layout['content'])) {
                continue;
            }

            // Build content
            $content = $layout['content'];
            if (is_array($content) && !empty($content['class'])) {
                $class = $content['class'];
                unset($content['class']);
                $content = $this->widget($class, $content, true);
            }

            // Options
            if (isset($layout['options']) && is_array($layout['options'])) {
                foreach ($layout['options'] as $key => $value) {
                    if (strpos($key, $layoutName . '__') === false) {
                        $key = $layoutName . '__' . $key;
                    }
                    $layoutsOptions[$key] = $value;
                }
            }

            $htmlOptions = !empty($layout['htmlOptions']) ? $layout['htmlOptions'] : array();

            // Css class
            if (!isset($htmlOptions['class'])) {
                $htmlOptions['class'] = 'ui-layout-' . $layoutName;
            } else {
                $htmlOptions['class'] .= 'ui-layout-' . $layoutName;
            }

            // Print out
            echo CHtml::openTag('div', $htmlOptions);
            echo $content.'</div>';
        }

        return $layoutsOptions;
    }
} 