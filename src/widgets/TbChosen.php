<?php
/**
 *##  TbChosen class file.
 *
 * @author Yaroslav Molchan <yaroslav.molchan@gmail.com>
 */

/**
 *## Chosen wrapper widget
 *
 * @see http://harvesthq.github.com/chosen
 *
 * @package booster.widgets.forms.inputs
 */
class TbChosen extends CInputWidget {
	
	/**
	 * @var TbActiveForm when created via TbActiveForm.
	 * This attribute is set to the form that renders the widget
	 * @see TbActionForm->inputRow
	 */
	public $form;
	/**
	 * @var array @param data for generating the list options (value=>display)
	 */
	public $data = array();

	/**
	 * @var
	 */
	public $options;

	/**
	 *### .init()
	 *
	 * Initializes the widget.
	 */
	public function init()
	{
            $this->normalizeData();

            $this->normalizeOptions();

            $this->addEmptyItemIfPlaceholderDefined();

            $this->setDefaultWidthIfEmpty();
	}

	/**
	 *### .run()
	 *
	 * Runs the widget.
	 */
	public function run()
	{
            list($name, $id) = $this->resolveNameID();

            if ($this->hasModel()) {
                    if ($this->form) {
                            echo $this->form->dropDownList($this->model, $this->attribute, $this->data, $this->htmlOptions);
                    } else {
                            echo CHtml::activeDropDownList($this->model, $this->attribute, $this->data, $this->htmlOptions);
                    }
            } else {
                    echo CHtml::dropDownList($name, $this->value, $this->data, $this->htmlOptions);
            }

            $this->registerClientScript($id);
	}

	/**
	 *### .registerClientScript()
	 *
	 * Registers required client script for chosen. It is not used through bootstrap->registerPlugin
	 * in order to attach events if any
	 */
	public function registerClientScript($id) {
		
        Booster::getBooster()->registerPackage('chosen');

		$options = !empty($this->options) ? CJavaScript::encode($this->options) : '';

                ob_start();
		echo "$('#{$id}').chosen({$options})";

		Yii::app()->getClientScript()->registerScript(__CLASS__ . '#' . $this->getId(), ob_get_clean() . ';');
	}

	private function setDefaultWidthIfEmpty()
	{
		if (empty($this->options['width'])) {
			$this->options['width'] = '100%';
		}
	}

	private function normalizeData()
	{
		if (!$this->data)
			$this->data = array();
	}

	private function addEmptyItemIfPlaceholderDefined()
	{
		if (!empty($this->htmlOptions['placeholder']))
			$this->options['placeholder'] = $this->htmlOptions['placeholder'];

		if (!empty($this->options['placeholder']) && empty($this->htmlOptions['multiple']))
			$this->prependDataWithEmptyItem();
	}

	private function normalizeOptions()
	{
		if (empty($this->options)) {
			$this->options = array();
		}
	}

	private function prependDataWithEmptyItem()
	{
		$this->data = array('' => '') + $this->data;
	}
}
