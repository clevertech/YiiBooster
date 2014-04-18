<?php


class TbFormInputElement extends CFormElement
{
	/**
	 * Input types (alias => TbActiveForm method name).
	 * @var array
	 */
	public static $inputTypes = array(
		// standard fields
		'text' => 'textFieldRow',
		'hidden' => 'hiddenField',
		'password' => 'passwordFieldRow',
		'textarea' => 'textAreaRow',
		'file' => 'fileFieldRow',
		'radio' => 'radioButtonRow',
		'checkbox' => 'checkBoxRow',
		'listbox' => 'listBoxRow',
		'dropdownlist' => 'dropDownListRow',
		'checkboxlist' => 'checkBoxListRow',
		'radiolist' => 'radioButtonListRow',
		'url' => 'urlFieldRow',
		'email' => 'emailFieldRow',
		'number' => 'numberFieldRow',
		'range' => 'rangeFieldRow',
		'date' => 'dateFieldRow',
		'time' => 'timeFieldRow',
		'tel' => 'telFieldRow',
		'search' => 'searchFieldRow',
		// extended fields
		'toggle' => 'toggleButtonRow',
		'datepicker' => 'datePickerRow',
		'daterange' => 'dateRangeRow',
		'timepicker' => 'timePickerRow',
		'datetimepicker' => 'dateTimePickerRow',
		'select2' => 'select2Row',
		'redactor' => 'redactorRow',
		'html5editor' => 'html5EditorRow',
		'markdowneditor' => 'markdownEditorRow',
		'ckeditor' => 'ckEditorRow',
		'typeahead' => 'typeAheadRow',
		'maskedtext' => 'maskedTextFieldRow',
		'colorpicker' => 'colorPickerRow',
		//'captcha' => 'captchaRow',
		'pass' => 'passFieldRow'
	);

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
	protected function generateRowOptions()
	{
		$rowOptions = array();
		$fields = array('label', 'labelOptions', 'errorOptions', 'hint', 'hintOptions', 'prepend', 'prependOptions',
			'append', 'appendOptions', 'enableAjaxValidation', 'enableClientValidation');

		foreach ($fields as $prop) {
			if (isset($this->$prop)) {
				$rowOptions[$prop] = $this->$prop;
			}
		}

		return $rowOptions;
	}

	/**
	 * Render this element.
	 * @return string The rendered element.
	 */
	public function render()
	{
		$model = $this->getParent()->getModel();
		$attribute = $this->name;
		$rowOptions = $this->generateRowOptions();

		if (isset(self::$inputTypes[$this->type])) {
			$method = self::$inputTypes[$this->type];

			switch ($method) {
				case 'listBoxRow':
				case 'dropDownListRow':
				case 'checkBoxListRow':
				case 'radioButtonListRow':
					return $this->getParent()->getActiveFormWidget()->$method($model, $attribute, $this->items, $this->attributes, $rowOptions);

				default:
					return $this->getParent()->getActiveFormWidget()->$method($model, $attribute, $this->attributes, $rowOptions);
			}
		} else {
			$attributes = $this->attributes;
			$attributes['model'] = $this->getParent()->getModel();
			$attributes['attribute'] = $this->name;

			return $this->getParent()->getActiveFormWidget()->customFieldRow(
				array(array($this->getParent()->getOwner(), 'widget'), array($this->type, $attributes, true)),
				$model,
				$attribute,
				$rowOptions
			);
		}
	}

	/**
	 * Evaluates the visibility of this element. This method will check if the attribute associated with this
	 * input is safe for the current model scenario.
	 * @return bool Whether this element is visible.
	 */
	protected function evaluateVisible()
	{
		return $this->getParent()->getModel()->isAttributeSafe($this->name);
	}
}