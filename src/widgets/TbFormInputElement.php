<?php


class TbFormInputElement extends CFormElement {
	
	/**
	 * Input types (alias => TbActiveForm method name).
	 * @var array
	 */
	public static $inputTypes = array(
		// standard fields
		'text' => 'textFieldGroup',
		'hidden' => 'hiddenField',
		'password' => 'passwordFieldGroup',
		'textarea' => 'textAreaGroup',
		'file' => 'fileFieldGroup',
		'radio' => 'radioButtonGroup',
		'checkbox' => 'checkBoxGroup',
		'listbox' => 'listBoxGroup',
		'dropdownlist' => 'dropDownListGroup',
		'checkboxlist' => 'checkBoxListGroup',
		'radiolist' => 'radioButtonListGroup',
		'url' => 'urlFieldGroup',
		'email' => 'emailFieldGroup',
		'number' => 'numberFieldGroup',
		'range' => 'rangeFieldGroup',
		'date' => 'dateFieldGroup',
		'time' => 'timeFieldGroup',
		'tel' => 'telFieldGroup',
		'search' => 'searchFieldGroup',
		// extended fields
		'switch' => 'switchGroup',
		'datepicker' => 'datePickerGroup',
		'daterange' => 'dateRangeGroup',
		'timepicker' => 'timePickerGroup',
		'datetimepicker' => 'dateTimePickerGroup',
		'select2' => 'select2Group',
		'redactor' => 'redactorGroup',
		'html5editor' => 'html5EditorGroup',
		'markdowneditor' => 'markdownEditorGroup',
		'ckeditor' => 'ckEditorGroup',
		'typeahead' => 'typeAheadGroup',
		'maskedtext' => 'maskedTextFieldGroup',
		'colorpicker' => 'colorPickerGroup',
		//'captcha' => 'captchaGroup',
		'pass' => 'passFieldGroup'
	);
	
	public $widgetOptions = array();

	/**
	 * The type of this input. This can be a widget class name, a path alias of a widget class name,
	 * or an input type alias (text, hidden, password, textarea, file, etc.).
	 * If a widget class, it must extend from {@link CInputWidget} or (@link CJuiInputWidget).
	 * @var string
	 */
	public $type;

	/**
	 * @var string Name of this input.
	 */
	public $name;

	/**
	 * Label for this input.
	 * @var string
	 */
	public $label;

	/**
	 * The options used when rendering label part. This property will be passed to the {@link CActiveForm::labelEx}
	 * or {@link CHtml::label} if $label is defined, method call as its $htmlOptions parameter.
	 * @var array
	 * @see CActiveForm::labelEx
	 * @see CHtml::label
	 */
	public $labelOptions;

	/**
	 * Hint text of this input.
	 * @var string
	 */
	public $hint;

	/**
	 * The options used when rendering hint part.
	 * This property will be passed as $htmlOptions parameter for hint wrapper tag.
	 * @var array
	 */
	public $hintOptions;

	/**
	 * Text/html prepended to input field.
	 * @var string
	 */
	public $prepend;

	/**
	 * The options used when rendering prepend part.
	 * This property will be passed as $htmlOptions parameter for prepend wrapper tag.
	 * @var array
	 */
	public $prependOptions;

	/**
	 * Text/html appended to input field.
	 * @var string
	 */
	public $append;

	/**
	 * The options used when rendering append part.
	 * This property will be passed as $htmlOptions parameter for append wrapper tag.
	 * @var array
	 */
	public $appendOptions;

	/**
	 * The options for this input when it is a list box, drop-down list, check box list, or radio button list.
	 * Please see {@link CHtml::listData} for details of generating this property value.
	 * @var array
	 */
	public $items = array();

	/**
	 * The options used when rendering the error part. This property will be passed
	 * to the {@link CActiveForm::error} method call as its $htmlOptions parameter.
	 * @var array
	 * @see CActiveForm::error
	 */
	public $errorOptions = array();

	/**
	 * Whether to allow AJAX-based validation for this input. Note that in order to use
	 * AJAX-based validation, {@link CForm::activeForm} must be configured with 'enableAjaxValidation'=>true.
	 * This property allows turning on or off  AJAX-based validation for individual input fields.
	 * Defaults to true.
	 * @var boolean
	 */
	public $enableAjaxValidation = true;

	/**
	 * Whether to allow client-side validation for this input. Note that in order to use
	 * client-side validation, {@link CForm::activeForm} must be configured with 'enableClientValidation'=>true.
	 * This property allows turning on or off  client-side validation for individual input fields.
	 * Defaults to true.
	 * @var boolean
	 */
	public $enableClientValidation = true;

	/**
	 * Generates row options array from this class properties.
	 * @return array The row options.
	 */
	protected function generateGroupOptions() {
		
		$options = array();
		$fields = array('widgetOptions, label', 'labelOptions', 'errorOptions', 'hint', 'hintOptions', 'prepend', 'prependOptions',
			'append', 'appendOptions', 'enableAjaxValidation', 'enableClientValidation');

		foreach ($fields as $prop) {
			if (isset($this->$prop)) {
				$options[$prop] = $this->$prop;
			}
		}
		
		$options['widgetOptions']['data'] = $this->items;

		return $options;
	}

	/**
	 * Render this element.
	 * @return string The rendered element.
	 */
	public function render() {
		
		$model = $this->getParent()->getModel();
		$attribute = $this->name;
		$options = $this->generateGroupOptions();

		if (isset(self::$inputTypes[$this->type])) {
			$method = self::$inputTypes[$this->type];
			// FIXME ... why we are passing $this->attributes ... most all TbActiveForm method only require $options 
			return $this->getParent()->getActiveFormWidget()->$method($model, $attribute, $this->attributes, $options);
			/* no need for this as now data goes inside $options['widgetOptions']['data']
			switch ($method) {
				case 'listBoxGroup':
				case 'dropDownListGroup':
				case 'checkBoxListGroup':
				case 'radioButtonListGroup': 
					return $this->getParent()->getActiveFormWidget()->$method($model, $attribute, $this->attributes, $this->items, $options);

				default:
					return $this->getParent()->getActiveFormWidget()->$method($model, $attribute, $this->attributes, $options);
			}
			*/
		} else {
			$attributes = $this->attributes;
			$attributes['model'] = $this->getParent()->getModel();
			$attributes['attribute'] = $this->name;

			return $this->getParent()->getActiveFormWidget()->customFieldGroup(
				array(array($this->getParent()->getOwner(), 'widget'), array($this->type, $attributes, true)),
				$model,
				$attribute,
				$options
			);
		}
	}

	/**
	 * Evaluates the visibility of this element. This method will check if the attribute associated with this
	 * input is safe for the current model scenario.
	 * @return bool Whether this element is visible.
	 */
	protected function evaluateVisible() {
		
		return $this->getParent()->getModel()->isAttributeSafe($this->name);
	}
}