<?php
/**
 * YiiBooster project.
 * @license [New BSD License](http://www.opensource.org/licenses/bsd-license.php)
 */

/**
 * This class is extended version of {@link CActiveForm}, that allows you fully take advantage of bootstrap forms.
 * Basically form consists of rows with label, field, error info, hint text and other useful stuff.
 * TbActiveForm brings together all of these things to quickly build custom forms even with non-standard fields.
 *
 * Each field method has $rowOptions for customizing rendering appearance.
 * <ul>
 * <li>'label' - Custom label text</li>
 * <li>'labelOptions' - HTML options for label tag or passed to {@link CActiveForm::labelEx} call if 'label' is not set</li>
 * <li>'errorOptions' - HTML options for {@link CActiveForm::error} call</li>
 * <li>'prepend' - Custom text/HTML-code rendered before field</li>
 * <li>'prependOptions' - HTML options for prepend wrapper tag</li>
 * <li>'append' - Custom text/HTML-code rendered after field</li>
 * <li>'appendOptions' - HTML options for append wrapper tag</li>
 * <li>'hint' - Hint text rendered below the field</li>
 * <li>'hintOptions' - HTML options for hint wrapper tag</li>
 * <li>'enableAjaxValidation' - passed to {@link CActiveForm::error} call</li>
 * <li>'enableClientValidation' - passed to {@link CActiveForm::error} call</li>
 * </ul>
 *
 * Here's simple example how to build login form using this class:
 * <pre>
 * <?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
 *     'type' => 'horizontal',
 *     'htmlOptions' => array('class' => 'well'),
 * )); ?>
 *
 * <?php echo $form->errorSummary($model); ?>
 *
 * <?php echo $form->textFieldRow($model, 'username'); ?>
 * <?php echo $form->passwordFieldRow($model, 'password', array(), array(
 *     'hint' => 'Check keyboard layout'
 * )); ?>
 * <?php echo $form->checkBoxRow($model, 'rememberMe'); ?>

 * <div class="form-actions">
 *     <?php echo CHtml::submitButton('Login', array('class'=>'btn')); ?>
 * </div>
 *
 * <?php $this->endWidget(); ?>
 * </pre>
 *
 * Additionally this class provides two additional ways to render custom widget or field or even everything you want
 * with {@link TbActiveForm::widgetRow} and {@link TbActiveForm::customFieldRow}.
 * Examples are simply clear:
 * <code>
 * $form->widgetRow(
 *     'my.super.cool.widget',
 *     array('model' => $model, 'attribute' => $attribute, 'data' => $mydata),
 *     array('hint' => 'Hint text here!')
 * );
 *
 * // suppose that field is rendered via SomeClass::someMethod($model, $attribute) call.
 * $form->customFieldRow(
 *     array(array('SomeClass', 'someMethod'), array($model, $attribute)),
 *     $mode,
 *     $attribute,
 *     array(...)
 * );
 * </code>
 *
 * @see http://getbootstrap.com/2.3.2/base-css.html#forms
 * @see CActiveForm
 */
class TbActiveForm extends CActiveForm
{
	// Allowed form types.
	const TYPE_VERTICAL = 'vertical';
	const TYPE_INLINE = 'inline';
	const TYPE_HORIZONTAL = 'horizontal';
	const TYPE_SEARCH = 'search';

	/**
	 * The form type. Allowed types are in `TYPE_*` constants.
	 * @var string
	 */
	public $type = self::TYPE_VERTICAL;

	/**
	 * Whether to render errors inline.
	 * @var bool
	 */
	public $inlineErrors;

	/**
	 * Prepend wrapper CSS class.
	 * @var string
	 */
	public $prependCssClass = 'input-prepend';

	/**
	 * Append wrapper CSS class.
	 * @var string
	 */
	public $appendCssClass = 'input-append';

	/**
	 * Add-on CSS class.
	 * @var string
	 */
	public $addOnCssClass = 'add-on';

	/**
	 * Add-on wrapper tag.
	 * @var string
	 */
	public $addOnTag = 'span';

	/**
	 * Tag for wrapping field with prepended and/or appended data.
	 * @var string
	 */
	public $addOnWrapperTag = 'div';

	/**
	 * Hint CSS class.
	 * @var string
	 */
	public $hintCssClass = 'help-block';

	/**
	 * Hint wrapper tag.
	 * @var string
	 */
	public $hintTag = 'p';

	/**
	 * Whether to render field error after input. Only for vertical and horizontal types.
	 * @var bool
	 */
	public $showErrors = true;

	/**
	 * Initializes the widget.
	 * This renders the form open tag.
	 */
	public function init()
	{
		self::addCssClass($this->htmlOptions, 'form-' . $this->type);

		if (!isset($this->inlineErrors)) {
			$this->inlineErrors = $this->type === self::TYPE_HORIZONTAL;
		}

		if (!isset($this->errorMessageCssClass)) {
			if ($this->inlineErrors) {
				$this->errorMessageCssClass = 'help-inline error';
			} else {
				$this->errorMessageCssClass = 'help-block error';
			}
		}

		if ($this->type == self::TYPE_HORIZONTAL && !isset($this->clientOptions['inputContainer']))
			$this->clientOptions['inputContainer'] = 'div.control-group';

		parent::init();
	}

	/**
	 * Displays a summary of validation errors for one or several models.
	 *
	 * This method is a wrapper for {@link CActiveForm::errorSummary}.
	 *
	 * @param mixed $models The models whose input errors are to be displayed. This can be either a single model or an array of models.
	 * @param string $header A piece of HTML code that appears in front of the errors
	 * @param string $footer A piece of HTML code that appears at the end of the errors
	 * @param array $htmlOptions Additional HTML attributes to be rendered in the container div tag.
	 * @return string The error summary. Empty if no errors are found.
	 * @see CActiveForm::errorSummary
	 */
	public function errorSummary($models, $header = null, $footer = null, $htmlOptions = array())
	{
		if (!isset($htmlOptions['class'])) {
			$htmlOptions['class'] = 'alert alert-block alert-error';
		}

		return parent::errorSummary($models, $header, $footer, $htmlOptions);
	}

	/**
	 * Generates a url field row for a model attribute.
	 *
	 * This method is a wrapper for {@link CActiveForm::urlField} and {@link customFieldRow}.
	 * Please check {@link CActiveForm::urlField} for detailed information about $htmlOptions argument.
	 * About $rowOptions argument parameters see {@link TbActiveForm} documentation.
	 *
	 * @param CModel $model The data model.
	 * @param string $attribute The attribute.
	 * @param array $htmlOptions Additional HTML attributes.
	 * @param array $rowOptions Row attributes.
	 * @return string The generated url field row.
	 * @see CActiveForm::urlField
	 * @see customFieldRow
	 */
	public function urlFieldRow($model, $attribute, $htmlOptions = array(), $rowOptions = array())
	{
		$this->initRowOptions($rowOptions);

		$fieldData = array(array($this, 'urlField'), array($model, $attribute, $htmlOptions));

		return $this->customFieldRowInternal($fieldData, $model, $attribute, $rowOptions);
	}

	/**
	 * Generates an email field row for a model attribute.
	 *
	 * This method is a wrapper for {@link CActiveForm::emailField} and {@link customFieldRow}.
	 * Please check {@link CActiveForm::emailField} for detailed information about $htmlOptions argument.
	 * About $rowOptions argument parameters see {@link TbActiveForm} documentation.
	 *
	 * @param CModel $model The data model.
	 * @param string $attribute The attribute.
	 * @param array $htmlOptions Additional HTML attributes.
	 * @param array $rowOptions Row attributes.
	 * @return string the generated email field row.
	 * @see CActiveForm::emailField
	 * @see customFieldRow
	 */
	public function emailFieldRow($model, $attribute, $htmlOptions = array(), $rowOptions = array())
	{
		$this->initRowOptions($rowOptions);

		$fieldData = array(array($this, 'emailField'), array($model, $attribute, $htmlOptions));

		return $this->customFieldRowInternal($fieldData, $model, $attribute, $rowOptions);
	}

	/**
	 * Generates a number field row for a model attribute.
	 *
	 * This method is a wrapper for {@link CActiveForm::numberField} and {@link customFieldRow}.
	 * Please check {@link CActiveForm::numberField} for detailed information about $htmlOptions argument.
	 * About $rowOptions argument parameters see {@link TbActiveForm} documentation.
	 *
	 * @param CModel $model The data model.
	 * @param string $attribute The attribute.
	 * @param array $htmlOptions Additional HTML attributes.
	 * @param array $rowOptions Row attributes.
	 * @return string The generated number filed row.
	 * @see CActiveForm::numberField
	 * @see customFieldRow
	 */
	public function numberFieldRow($model, $attribute, $htmlOptions = array(), $rowOptions = array())
	{
		$this->initRowOptions($rowOptions);

		$fieldData = array(array($this, 'numberField'), array($model, $attribute, $htmlOptions));

		return $this->customFieldRowInternal($fieldData, $model, $attribute, $rowOptions);
	}

	/**
	 * Generates a range field row for a model attribute.
	 *
	 * This method is a wrapper for {@link CActiveForm::rangeField} and {@link customFieldRow}.
	 * Please check {@link CActiveForm::rangeField} for detailed information about $htmlOptions argument.
	 * About $rowOptions argument parameters see {@link TbActiveForm} documentation.
	 *
	 * @param CModel $model The data model.
	 * @param string $attribute The attribute.
	 * @param array $htmlOptions Additional HTML attributes.
	 * @param array $rowOptions Row attributes.
	 * @return string The generated range field row.
	 * @see CActiveForm::rangeField
	 * @see customFieldRow
	 */
	public function rangeFieldRow($model, $attribute, $htmlOptions = array(), $rowOptions = array())
	{
		$this->initRowOptions($rowOptions);

		$fieldData = array(array($this, 'rangeField'), array($model, $attribute, $htmlOptions));

		return $this->customFieldRowInternal($fieldData, $model, $attribute, $rowOptions);
	}

	/**
	 * Generates a date field row for a model attribute.
	 *
	 * This method is a wrapper for {@link CActiveForm::dateField} and {@link customFieldRow}.
	 * Please check {@link CActiveForm::dateField} for detailed information about $htmlOptions argument.
	 * About $rowOptions argument parameters see {@link TbActiveForm} documentation.
	 *
	 * @param CModel $model The data model.
	 * @param string $attribute The attribute.
	 * @param array $htmlOptions Additional HTML attributes.
	 * @param array $rowOptions Row attributes.
	 * @return string The generated date field row.
	 * @see CActiveForm::dateField
	 * @see customFieldRow
	 */
	public function dateFieldRow($model, $attribute, $htmlOptions = array(), $rowOptions = array())
	{
		$this->initRowOptions($rowOptions);

		$fieldData = array(array($this, 'dateField'), array($model, $attribute, $htmlOptions));

		return $this->customFieldRowInternal($fieldData, $model, $attribute, $rowOptions);
	}

	/**
	 * Generates a time field row for a model attribute.
	 *
	 * This method is a wrapper for {@link CActiveForm::timeField} and {@link customFieldRow}.
	 * Please check {@link CActiveForm::timeField} for detailed information about $htmlOptions argument.
	 * About $rowOptions argument parameters see {@link TbActiveForm} documentation.
	 *
	 * @param CModel $model The data model.
	 * @param string $attribute The attribute.
	 * @param array $htmlOptions Additional HTML attributes.
	 * @param array $rowOptions Row attributes.
	 * @return string The generated date field row.
	 * @see CActiveForm::timeField
	 * @see customFieldRow
	 */
	public function timeFieldRow($model, $attribute, $htmlOptions = array(), $rowOptions = array())
	{
		$this->initRowOptions($rowOptions);

		$fieldData = array(array($this, 'timeField'), array($model, $attribute, $htmlOptions));

		return $this->customFieldRowInternal($fieldData, $model, $attribute, $rowOptions);
	}

	/**
	 * Generates a tel field row for a model attribute.
	 *
	 * This method is a wrapper for {@link CActiveForm::telField} and {@link customFieldRow}.
	 * Please check {@link CActiveForm::telField} for detailed information about $htmlOptions argument.
	 * About $rowOptions argument parameters see {@link TbActiveForm} documentation.
	 *
	 * @param CModel $model The data model.
	 * @param string $attribute The attribute.
	 * @param array $htmlOptions Additional HTML attributes.
	 * @param array $rowOptions Row attributes.
	 * @return string The generated date field row.
	 * @see CActiveForm::telField
	 * @see customFieldRow
	 */
	public function telFieldRow($model, $attribute, $htmlOptions = array(), $rowOptions = array())
	{
		$this->initRowOptions($rowOptions);

		$fieldData = array(array($this, 'telField'), array($model, $attribute, $htmlOptions));

		return $this->customFieldRowInternal($fieldData, $model, $attribute, $rowOptions);
	}

	/**
	 * Generates a text field row for a model attribute.
	 *
	 * This method is a wrapper for {@link CActiveForm::textField} and {@link customFieldRow}.
	 * Please check {@link CActiveForm::textField} for detailed information about $htmlOptions argument.
	 * About $rowOptions argument parameters see {@link TbActiveForm} documentation.
	 *
	 * @param CModel $model The data model.
	 * @param string $attribute The attribute.
	 * @param array $htmlOptions Additional HTML attributes.
	 * @param array $rowOptions Row attributes.
	 * @return string The generated text field row.
	 * @see CActiveForm::textField
	 * @see customFieldRow
	 */
	public function textFieldRow($model, $attribute, $htmlOptions = array(), $rowOptions = array())
	{
		$this->initRowOptions($rowOptions);

		$fieldData = array(array($this, 'textField'), array($model, $attribute, $htmlOptions));

		return $this->customFieldRowInternal($fieldData, $model, $attribute, $rowOptions);
	}

	/**
	 * Generates a search field row for a model attribute.
	 *
	 * This method is a wrapper for {@link CActiveForm::searchField} and {@link customFieldRow}.
	 * Please check {@link CActiveForm::searchField} for detailed information about $htmlOptions argument.
	 * About $rowOptions argument parameters see {@link TbActiveForm} documentation.
	 *
	 * @param CModel $model The data model.
	 * @param string $attribute The attribute.
	 * @param array $htmlOptions Additional HTML attributes.
	 * @param array $rowOptions Row attributes.
	 * @return string The generated text field row.
	 * @see CActiveForm::searchField
	 * @see customFieldRow
	 */
	public function searchFieldRow($model, $attribute, $htmlOptions = array(), $rowOptions = array())
	{
		$this->initRowOptions($rowOptions);

		if ($this->type == self::TYPE_SEARCH) {
			self::addCssClass($htmlOptions, 'search-query');
		}

		$fieldData = array(array($this, 'searchField'), array($model, $attribute, $htmlOptions));

		return $this->customFieldRowInternal($fieldData, $model, $attribute, $rowOptions);
	}

	/**
	 * Generates a password field row for a model attribute.
	 *
	 * This method is a wrapper for {@link CActiveForm::passwordField} and {@link customFieldRow}.
	 * Please check {@link CActiveForm::passwordField} for detailed information about $htmlOptions argument.
	 * About $rowOptions argument parameters see {@link TbActiveForm} documentation.
	 *
	 * @param CModel $model The data model.
	 * @param string $attribute The attribute.
	 * @param array $htmlOptions Additional HTML attributes.
	 * @param array $rowOptions Row attributes.
	 * @return string The generated password field row.
	 * @see CActiveForm::passwordField
	 * @see customFieldRow
	 */
	public function passwordFieldRow($model, $attribute, $htmlOptions = array(), $rowOptions = array())
	{
		$this->initRowOptions($rowOptions);

		$fieldData = array(array($this, 'passwordField'), array($model, $attribute, $htmlOptions));

		return $this->customFieldRowInternal($fieldData, $model, $attribute, $rowOptions);
	}

	/**
	 * Generates a text area row for a model attribute.
	 *
	 * This method is a wrapper for {@link CActiveForm::textArea} and {@link customFieldRow}.
	 * Please check {@link CActiveForm::textArea} for detailed information about $htmlOptions argument.
	 * About $rowOptions argument parameters see {@link TbActiveForm} documentation.
	 *
	 * @param CModel $model The data model.
	 * @param string $attribute The attribute.
	 * @param array $htmlOptions Additional HTML attributes.
	 * @param array $rowOptions Row attributes.
	 * @return string The generated text area row.
	 * @see CActiveForm::textArea
	 * @see customFieldRow
	 */
	public function textAreaRow($model, $attribute, $htmlOptions = array(), $rowOptions = array())
	{
		$this->initRowOptions($rowOptions);

		$fieldData = array(array($this, 'textArea'), array($model, $attribute, $htmlOptions));

		return $this->customFieldRowInternal($fieldData, $model, $attribute, $rowOptions);
	}

	/**
	 * Generates a file field row for a model attribute.
	 *
	 * This method is a wrapper for {@link CActiveForm::fileField} and {@link customFieldRow}.
	 * Please check {@link CActiveForm::fileField} for detailed information about $htmlOptions argument.
	 * About $rowOptions argument parameters see {@link TbActiveForm} documentation.
	 *
	 * @param CModel $model The data model.
	 * @param string $attribute The attribute.
	 * @param array $htmlOptions Additional HTML attributes.
	 * @param array $rowOptions Row attributes.
	 * @return string The generated file field row.
	 * @see CActiveForm::fileField
	 * @see customFieldRow
	 */
	public function fileFieldRow($model, $attribute, $htmlOptions = array(), $rowOptions = array())
	{
		$this->initRowOptions($rowOptions);

		$fieldData = array(array($this, 'fileField'), array($model, $attribute, $htmlOptions));

		return $this->customFieldRowInternal($fieldData, $model, $attribute, $rowOptions);
	}

	/**
	 * Generates a radio button row for a model attribute.
	 *
	 * This method is a wrapper for {@link CActiveForm::radioButton} and {@link customFieldRow}.
	 * Please check {@link CActiveForm::radioButton} for detailed information about $htmlOptions argument.
	 * About $rowOptions argument parameters see {@link TbActiveForm} documentation.
	 *
	 * @param CModel $model The data model.
	 * @param string $attribute The attribute.
	 * @param array $htmlOptions Additional HTML attributes.
	 * @param array $rowOptions Row attributes.
	 * @return string The generated radio button row.
	 * @see CActiveForm::radioButton
	 * @see customFieldRow
	 */
	public function radioButtonRow($model, $attribute, $htmlOptions = array(), $rowOptions = array())
	{
		$this->initRowOptions($rowOptions);

		self::addCssClass($rowOptions['labelOptions'], 'radio');
		if ($this->type == self::TYPE_INLINE)
			self::addCssClass($rowOptions['labelOptions'], 'inline');

		$field = $this->radioButton($model, $attribute, $htmlOptions);
		if ((!array_key_exists('uncheckValue', $htmlOptions) || isset($htmlOptions['uncheckValue']))
			&& preg_match('/\<input.*?type="hidden".*?\>/', $field, $matches)
		) {
			$hiddenField = $matches[0];
			$field = str_replace($hiddenField, '', $field);
		}

		$realAttribute = $attribute;
		CHtml::resolveName($model, $realAttribute);

		ob_start();
		if (isset($hiddenField)) echo $hiddenField;
		echo CHtml::tag('label', $rowOptions['labelOptions'], false, false);
		echo $field;
		echo $model->getAttributeLabel($realAttribute);
		echo CHtml::closeTag('label');
		$fieldData = ob_get_clean();

		$rowOptions['label'] = '';

		return $this->customFieldRowInternal($fieldData, $model, $attribute, $rowOptions);
	}

	/**
	 * Generates a checkbox row for a model attribute.
	 *
	 * This method is a wrapper for {@link CActiveForm::checkBox} and {@link customFieldRow}.
	 * Please check {@link CActiveForm::checkBox} for detailed information about $htmlOptions argument.
	 * About $rowOptions argument parameters see {@link TbActiveForm} documentation.
	 *
	 * @param CModel $model The data model.
	 * @param string $attribute The attribute.
	 * @param array $htmlOptions Additional HTML attributes.
	 * @param array $rowOptions Row attributes.
	 * @return string The generated checkbox row.
	 * @see CActiveForm::checkBox
	 * @see customFieldRow
	 */
	public function checkBoxRow($model, $attribute, $htmlOptions = array(), $rowOptions = array())
	{
		$this->initRowOptions($rowOptions);

		self::addCssClass($rowOptions['labelOptions'], 'checkbox');
		if ($this->type == self::TYPE_INLINE)
			self::addCssClass($rowOptions['labelOptions'], 'inline');

		$field = $this->checkBox($model, $attribute, $htmlOptions);
		if ((!array_key_exists('uncheckValue', $htmlOptions) || isset($htmlOptions['uncheckValue']))
			&& preg_match('/\<input.*?type="hidden".*?\>/', $field, $matches)
		) {
			$hiddenField = $matches[0];
			$field = str_replace($hiddenField, '', $field);
		}

		$realAttribute = $attribute;
		CHtml::resolveName($model, $realAttribute);

		ob_start();
		if (isset($hiddenField)) echo $hiddenField;
		echo CHtml::tag('label', $rowOptions['labelOptions'], false, false);
		echo $field;
		echo $model->getAttributeLabel($realAttribute);
		echo CHtml::closeTag('label');
		$fieldData = ob_get_clean();

		$rowOptions['label'] = '';

		return $this->customFieldRowInternal($fieldData, $model, $attribute, $rowOptions);
	}

	/**
	 * Generates a dropdown list row for a model attribute.
	 *
	 * This method is a wrapper for {@link CActiveForm::dropDownList} and {@link customFieldRow}.
	 * Please check {@link CActiveForm::dropDownList} for detailed information about $htmlOptions argument.
	 * About $rowOptions argument parameters see {@link TbActiveForm} documentation.
	 *
	 * @param CModel $model The data model.
	 * @param string $attribute The attribute.
	 * @param array $data Data for generating the list options (value=>display).
	 * @param array $htmlOptions Additional HTML attributes.
	 * @param array $rowOptions Row attributes.
	 * @return string The generated drop down list row.
	 * @see CActiveForm::dropDownList
	 * @see customFieldRow
	 */
	public function dropDownListRow($model, $attribute, $data, $htmlOptions = array(), $rowOptions = array())
	{
		$this->initRowOptions($rowOptions);

		$fieldData = array(array($this, 'dropDownList'), array($model, $attribute, $data, $htmlOptions));

		return $this->customFieldRowInternal($fieldData, $model, $attribute, $rowOptions);
	}

	/**
	 * Generates a list box row for a model attribute.
	 *
	 * This method is a wrapper for {@link CActiveForm::listBox} and {@link customFieldRow}.
	 * Please check {@link CActiveForm::listBox} for detailed information about $htmlOptions argument.
	 * About $rowOptions argument parameters see {@link TbActiveForm} documentation.
	 *
	 * @param CModel $model The data model.
	 * @param string $attribute The attribute.
	 * @param array $data
	 * @param array $htmlOptions Additional HTML attributes.
	 * @param array $rowOptions Row attributes.
	 * @return string The generated list box row.
	 * @see CActiveForm::listBox
	 * @see customFieldRow
	 */
	public function listBoxRow($model, $attribute, $data, $htmlOptions = array(), $rowOptions = array())
	{
		$this->initRowOptions($rowOptions);

		$fieldData = array(array($this, 'listBox'), array($model, $attribute, $data, $htmlOptions));

		return $this->customFieldRowInternal($fieldData, $model, $attribute, $rowOptions);
	}

	/**
	 * Generates a checkbox list row for a model attribute.
	 *
	 * This method is a wrapper for {@link CActiveForm::checkBoxList} and {@link customFieldRow}.
	 * Please check {@link CActiveForm::checkBoxList} for detailed information about $htmlOptions argument.
	 * About $rowOptions argument parameters see {@link TbActiveForm} documentation.
	 *
	 * @param CModel $model The data model.
	 * @param string $attribute The attribute.
	 * @param array $data Value-label pairs used to generate the check box list.
	 * @param array $htmlOptions Additional HTML attributes.
	 * @param array $rowOptions Row attributes.
	 * @return string The generated checkbox list row.
	 * @see CActiveForm::checkBoxList
	 * @see customFieldRow
	 */
	public function checkBoxListRow($model, $attribute, $data, $htmlOptions = array(), $rowOptions = array())
	{
		$this->initRowOptions($rowOptions);

		if (!isset($htmlOptions['labelOptions']['class']))
			$htmlOptions['labelOptions']['class'] = 'checkbox';

		if (!isset($htmlOptions['template']))
			$htmlOptions['template'] = '{beginLabel}{input}{labelTitle}{endLabel}';

		if (!isset($htmlOptions['separator']))
			$htmlOptions['separator'] = "\n";

		$fieldData = array(array($this, 'checkBoxList'), array($model, $attribute, $data, $htmlOptions));

		return $this->customFieldRowInternal($fieldData, $model, $attribute, $rowOptions);
	}

	/**
	 * Generates a radio button list row for a model attribute.
	 *
	 * This method is a wrapper for {@link CActiveForm::radioButtonList} and {@link customFieldRow}.
	 * Please check {@link CActiveForm::radioButtonList} for detailed information about $htmlOptions argument.
	 * About $rowOptions argument parameters see {@link TbActiveForm} documentation.
	 *
	 * @param CModel $model The data model.
	 * @param string $attribute The attribute.
	 * @param array $data Value-label pairs used to generate the radio button list.
	 * @param array $htmlOptions Additional HTML attributes.
	 * @param array $rowOptions Row attributes.
	 * @return string The generated radio button list row.
	 * @see CActiveForm::radioButtonList
	 * @see customFieldRow
	 */
	public function radioButtonListRow($model, $attribute, $data, $htmlOptions = array(), $rowOptions = array())
	{
		$this->initRowOptions($rowOptions);

		if (!isset($htmlOptions['labelOptions']['class']))
			$htmlOptions['labelOptions']['class'] = 'radio';

		if (!isset($htmlOptions['template']))
			$htmlOptions['template'] = '{beginLabel}{input}{labelTitle}{endLabel}';

		if (!isset($htmlOptions['separator']))
			$htmlOptions['separator'] = "\n";

		$fieldData = array(array($this, 'radioButtonList'), array($model, $attribute, $data, $htmlOptions));

		return $this->customFieldRowInternal($fieldData, $model, $attribute, $rowOptions);
	}

	//public function buttonGroupRow($model, $attribute, $widgetOptions, $rowOptions = array())
	//{
	//	// TODO: this is future replacement for checkBoxGroupsList and radioButtonGroupsList
	//	// TODO: but need to rewrite TbButtonGroup for field support
	//}

	/**
	 * Generates a toggle button row for a model attribute.
	 *
	 * This method is a wrapper for {@link TbToggleButton} widget and {@link customFieldRow}.
	 * Please check {@link TbToggleButton} documentation for detailed information about $widgetOptions.
	 * About $rowOptions argument parameters see {@link TbActiveForm} documentation.
	 *
	 * @param CModel $model The data model.
	 * @param string $attribute The attribute.
	 * @param array $widgetOptions List of initial property values for the widget (Property Name => Property Value).
	 * @param array $rowOptions Row attributes.
	 * @return string The generated toggle button row.
	 * @see TbToggleButton
	 * @see customFieldRow
	 */
	public function toggleButtonRow($model, $attribute, $widgetOptions = array(), $rowOptions = array())
	{
		return $this->widgetRowInternal('bootstrap.widgets.TbToggleButton', $model, $attribute, $widgetOptions, $rowOptions);
	}

	/**
	 * Generates a date picker row for a model attribute.
	 *
	 * This method is a wrapper for {@link TbDatePicker} widget and {@link customFieldRow}.
	 * Please check {@link TbDatePicker} documentation for detailed information about $widgetOptions.
	 * About $rowOptions argument parameters see {@link TbActiveForm} documentation.
	 *
	 * @param CModel $model The data model.
	 * @param string $attribute The attribute.
	 * @param array $widgetOptions List of initial property values for the widget (Property Name => Property Value).
	 * @param array $rowOptions Row attributes.
	 * @return string The generated date picker row.
	 * @see TbDatePicker
	 * @see customFieldRow
	 */
	public function datePickerRow($model, $attribute, $widgetOptions = array(), $rowOptions = array())
	{
		return $this->widgetRowInternal('bootstrap.widgets.TbDatePicker', $model, $attribute, $widgetOptions, $rowOptions);
	}

	/**
	 * Generates a date range picker row for a model attribute.
	 *
	 * This method is a wrapper for {@link TbDateRangePicker} widget and {@link customFieldRow}.
	 * Please check {@link TbDateRangePicker} documentation for detailed information about $widgetOptions.
	 * About $rowOptions argument parameters see {@link TbActiveForm} documentation.
	 *
	 * @param CModel $model The data model.
	 * @param string $attribute The attribute.
	 * @param array $widgetOptions List of initial property values for the widget (Property Name => Property Value).
	 * @param array $rowOptions Row attributes.
	 * @return string The generated date range picker row.
	 * @see TbDateRangePicker
	 * @see customFieldRow
	 */
	public function dateRangeRow($model, $attribute, $widgetOptions = array(), $rowOptions = array())
	{
		return $this->widgetRowInternal('bootstrap.widgets.TbDateRangePicker', $model, $attribute, $widgetOptions, $rowOptions);
	}

	/**
	 * Generates a time picker row for a model attribute.
	 *
	 * This method is a wrapper for {@link TbTimePicker} widget and {@link customFieldRow}.
	 * Please check {@link TbTimePicker} documentation for detailed information about $widgetOptions.
	 * About $rowOptions argument parameters see {@link TbActiveForm} documentation.
	 *
	 * @param CModel $model The data model.
	 * @param string $attribute The attribute.
	 * @param array $widgetOptions List of initial property values for the widget (Property Name => Property Value).
	 * @param array $rowOptions Row attributes.
	 * @return string The generated time picker row.
	 * @see TbTimePicker
	 * @see customFieldRow
	 */
	public function timePickerRow($model, $attribute, $widgetOptions = array(), $rowOptions = array())
	{
		return $this->widgetRowInternal('bootstrap.widgets.TbTimePicker', $model, $attribute, $widgetOptions, $rowOptions);
	}

	/**
	 * Generates a date-time picker row for a model attribute.
	 *
	 * This method is a wrapper for {@link TbDateTimePicker} widget and {@link customFieldRow}.
	 * Please check {@link TbDateTimePicker} documentation for detailed information about $widgetOptions.
	 * About $rowOptions argument parameters see {@link TbActiveForm} documentation.
	 *
	 * @param CModel $model The data model.
	 * @param string $attribute The attribute.
	 * @param array $widgetOptions List of initial property values for the widget (Property Name => Property Value).
	 * @param array $rowOptions Row attributes.
	 * @return string The generated date-time picker row.
	 * @see TbDateTimePicker
	 * @see customFieldRow
	 */
	public function dateTimePickerRow($model, $attribute, $widgetOptions = array(), $rowOptions = array())
	{
		return $this->widgetRowInternal('bootstrap.widgets.TbDateTimePicker', $model, $attribute, $widgetOptions, $rowOptions);
	}

	/**
	 * Generates a select2 row for a model attribute.
	 *
	 * This method is a wrapper for {@link TbSelect2} widget and {@link customFieldRow}.
	 * Please check {@link TbSelect2} documentation for detailed information about $widgetOptions.
	 * About $rowOptions argument parameters see {@link TbActiveForm} documentation.
	 *
	 * @param CModel $model The data model.
	 * @param string $attribute The attribute.
	 * @param array $widgetOptions List of initial property values for the widget (Property Name => Property Value).
	 * @param array $rowOptions Row attributes.
	 * @return string The generated select2 row.
	 * @see TbSelect2
	 * @see customFieldRow
	 */
	public function select2Row($model, $attribute, $widgetOptions = array(), $rowOptions = array())
	{
		return $this->widgetRowInternal('bootstrap.widgets.TbSelect2', $model, $attribute, $widgetOptions, $rowOptions);
	}

	/**
	 * Generates a redactor editor row for a model attribute.
	 *
	 * This method is a wrapper for {@link TbRedactorJs} widget and {@link customFieldRow}.
	 * Please check {@link TbRedactorJs} documentation for detailed information about $widgetOptions.
	 * About $rowOptions argument parameters see {@link TbActiveForm} documentation.
	 *
	 * @param CModel $model The data model.
	 * @param string $attribute The attribute.
	 * @param array $widgetOptions List of initial property values for the widget (Property Name => Property Value).
	 * @param array $rowOptions Row attributes.
	 * @return string The generated redactor editor row.
	 * @see TbRedactorJs
	 * @see customFieldRow
	 */
	public function redactorRow($model, $attribute, $widgetOptions = array(), $rowOptions = array())
	{
		return $this->widgetRowInternal('bootstrap.widgets.TbRedactorJs', $model, $attribute, $widgetOptions, $rowOptions);
	}

	/**
	 * Generates a html5 editor row for a model attribute.
	 *
	 * This method is a wrapper for {@link TbHtml5Editor} widget and {@link customFieldRow}.
	 * Please check {@link TbHtml5Editor} documentation for detailed information about $widgetOptions.
	 * About $rowOptions argument parameters see {@link TbActiveForm} documentation.
	 *
	 * @param CModel $model The data model.
	 * @param string $attribute The attribute.
	 * @param array $widgetOptions List of initial property values for the widget (Property Name => Property Value).
	 * @param array $rowOptions Row attributes.
	 * @return string The generated html5 editor row.
	 * @see TbHtml5Editor
	 * @see customFieldRow
	 */
	public function html5EditorRow($model, $attribute, $widgetOptions = array(), $rowOptions = array())
	{
		return $this->widgetRowInternal('bootstrap.widgets.TbHtml5Editor', $model, $attribute, $widgetOptions, $rowOptions);
	}

	/**
	 * Generates a markdown editor row for a model attribute.
	 *
	 * This method is a wrapper for {@link TbMarkdownEditorJs} widget and {@link customFieldRow}.
	 * Please check {@link TbMarkdownEditorJs} documentation for detailed information about $widgetOptions.
	 * About $rowOptions argument parameters see {@link TbActiveForm} documentation.
	 *
	 * @param CModel $model The data model.
	 * @param string $attribute The attribute.
	 * @param array $widgetOptions List of initial property values for the widget (Property Name => Property Value).
	 * @param array $rowOptions Row attributes.
	 * @return string The generated markdown editor row.
	 * @see TbMarkdownEditorJs
	 * @see customFieldRow
	 */
	public function markdownEditorRow($model, $attribute, $widgetOptions = array(), $rowOptions = array())
	{
		$this->initRowOptions($rowOptions);
		$widgetOptions['model'] = $model;
		$widgetOptions['attribute'] = $attribute;

		// TODO: rewrite TbMarkdownEditorJs and this method!
		$fieldData = '<div class="wmd-panel">';
		$fieldData .= '<div id="wmd-button-bar" class="btn-toolbar"></div>';
		$fieldData .= $this->owner->widget('bootstrap.widgets.TbMarkdownEditorJs', $widgetOptions, true);
		$fieldData .= '<div id="wmd-preview" class="wmd-panel wmd-preview" style="width:100%"></div>';
		$fieldData .= '</div>'; // wmd-panel

		return $this->customFieldRowInternal($fieldData, $model, $attribute, $rowOptions);
	}

	/**
	 * Generates a CKEditor row for a model attribute.
	 *
	 * This method is a wrapper for {@link TbCKEditor} widget and {@link customFieldRow}.
	 * Please check {@link TbCKEditor} documentation for detailed information about $widgetOptions.
	 * About $rowOptions argument parameters see {@link TbActiveForm} documentation.
	 *
	 * @param CModel $model The data model.
	 * @param string $attribute The attribute.
	 * @param array $widgetOptions List of initial property values for the widget (Property Name => Property Value).
	 * @param array $rowOptions Row attributes.
	 * @return string The generated CKEditor row.
	 * @see TbCKEditor
	 * @see customFieldRow
	 */
	public function ckEditorRow($model, $attribute, $widgetOptions = array(), $rowOptions = array())
	{
		return $this->widgetRowInternal('bootstrap.widgets.TbCKEditor', $model, $attribute, $widgetOptions, $rowOptions);
	}

	/**
	 * Generates a type-ahead row for a model attribute.
	 *
	 * This method is a wrapper for {@link TbTypeahead} widget and {@link customFieldRow}.
	 * Please check {@link TbTypeahead} documentation for detailed information about $widgetOptions.
	 * About $rowOptions argument parameters see {@link TbActiveForm} documentation.
	 *
	 * @param CModel $model The data model.
	 * @param string $attribute The attribute.
	 * @param array $widgetOptions List of initial property values for the widget (Property Name => Property Value).
	 * @param array $rowOptions Row attributes.
	 * @return string The generated type-ahead row.
	 * @see TbTypeahead
	 * @see customFieldRow
	 */
	public function typeAheadRow($model, $attribute, $widgetOptions = array(), $rowOptions = array())
	{
		return $this->widgetRowInternal('bootstrap.widgets.TbTypeahead', $model, $attribute, $widgetOptions, $rowOptions);
	}

	/**
	 * Generates a masked text field row for a model attribute.
	 *
	 * This method is a wrapper for {@link CMaskedTextField} widget and {@link customFieldRow}.
	 * Please check {@link CMaskedTextField} documentation for detailed information about $widgetOptions.
	 * About $rowOptions argument parameters see {@link TbActiveForm} documentation.
	 *
	 * @param CModel $model The data model.
	 * @param string $attribute The attribute.
	 * @param array $widgetOptions List of initial property values for the widget (Property Name => Property Value).
	 * @param array $rowOptions Row attributes.
	 * @return string The generated masked text field row.
	 * @see CMaskedTextField
	 * @see customFieldRow
	 */
	public function maskedTextFieldRow($model, $attribute, $widgetOptions = array(), $rowOptions = array())
	{
		return $this->widgetRowInternal('CMaskedTextField', $model, $attribute, $widgetOptions, $rowOptions);
	}

	/**
	 * Generates a color picker field row for a model attribute.
	 *
	 * This method is a wrapper for {@link TbColorPicker} widget and {@link customFieldRow}.
	 * Please check {@link TbColorPicker} documentation for detailed information about $widgetOptions.
	 * About $rowOptions argument parameters see {@link TbActiveForm} documentation.
	 *
	 * @param CModel $model The data model.
	 * @param string $attribute The attribute.
	 * @param array $widgetOptions List of initial property values for the widget (Property Name => Property Value).
	 * @param array $rowOptions Row attributes.
	 * @return string The generated color picker row.
	 * @see TbColorPicker
	 * @see customFieldRow
	 */
	public function colorPickerRow($model, $attribute, $widgetOptions = array(), $rowOptions = array())
	{
		return $this->widgetRowInternal('bootstrap.widgets.TbColorPicker', $model, $attribute, $widgetOptions, $rowOptions);
	}

	/**
	 * Generates a color picker field row for a model attribute.
	 *
	 * This method is a wrapper for {@link CCaptcha} widget, {@link textField} and {@link customFieldRow}.
	 * Please check {@link CCaptcha} documentation for detailed information about $widgetOptions.
	 * Read detailed information about $htmlOptions in {@link CActiveForm::textField} method.
	 * About $rowOptions argument parameters see {@link TbActiveForm} documentation.
	 *
	 * @param CModel $model The data model.
	 * @param string $attribute The attribute.
	 * @param array $htmlOptions Additional HTML attributes for captcha text field.
	 * @param array $widgetOptions List of initial property values for the CCaptcha widget (Property Name => Property Value).
	 * @param array $rowOptions Row attributes.
	 * @return string The generated color picker row.
	 * @see CCaptcha
	 * @see CActiveForm::textField
	 * @see customFieldRow
	 */
	public function captchaRow($model, $attribute, $htmlOptions = array(), $widgetOptions = array(), $rowOptions = array())
	{
		$this->initRowOptions($rowOptions);

		$fieldData = $this->textField($model, $attribute, $htmlOptions);
		$fieldData .= '<div class="captcha">' . $this->owner->widget('CCaptcha', $widgetOptions, true) . '</div>';

		return $this->customFieldRowInternal($fieldData, $model, $attribute, $rowOptions);
	}

	/**
	 * Generates a Pass*Field row for a model attribute.
	 *
	 * This method is a wrapper for {@link TbPassfield} widget and {@link customFieldRow}.
	 * Please check {@link TbPassfield} documentation for detailed information about $widgetOptions.
	 * About $rowOptions argument parameters see {@link TbActiveForm} documentation.
	 *
	 * @param CModel $model The data model.
	 * @param string $attribute The attribute.
	 * @param array $widgetOptions List of initial property values for the widget (Property Name => Property Value).
	 * @param array $rowOptions Row attributes.
	 * @return string The generated color picker row.
	 * @see TbPassfield
	 * @see customFieldRow
	 */
	public function passFieldRow($model, $attribute, $widgetOptions = array(), $rowOptions = array())
	{
		return $this->widgetRowInternal('bootstrap.widgets.TbPassfield', $model, $attribute, $widgetOptions, $rowOptions);
	}

	/**
	 * Generates a custom field row for a model attribute.
	 * About $rowOptions argument parameters see {@link TbActiveForm} documentation.
	 *
	 * @param array|string $fieldData Pre-rendered field as string or array of arguments for call_user_func_array()
	 * function.
	 * @param CModel $model The data model.
	 * @param string $attribute The attribute.
	 * @param array $rowOptions Row attributes.
	 * @return string The generated custom filed row.
	 * @see call_user_func_array
	 */
	public function customFieldRow($fieldData, $model, $attribute, $rowOptions = array())
	{
		$this->initRowOptions($rowOptions);

		return $this->customFieldRowInternal($fieldData, $model, $attribute, $rowOptions);
	}

	/**
	 * Generates a widget row for a model attribute.
	 *
	 * This method is a wrapper for {@link CBaseController::widget} and {@link customFieldRow}.
	 * Read detailed information about $widgetOptions in $properties argument of {@link CBaseController::widget} method.
	 * About $rowOptions argument parameters see {@link TbActiveForm} documentation.
	 * This method relies that widget have $model and $attribute properties.
	 *
	 * @param string $className The widget class name or class in dot syntax (e.g. application.widgets.MyWidget).
	 * @param array $widgetOptions List of initial property values for the widget (Property Name => Property Value).
	 * @param array $rowOptions Row attributes.
	 * @return string The generated widget row.
	 * @see CBaseController::widget
	 * @see customFieldRow
	 */
	public function widgetRow($className, $widgetOptions = array(), $rowOptions = array())
	{
		$this->initRowOptions($rowOptions);

		$fieldData = array(array($this->owner, 'widget'), array($className, $widgetOptions, true));

		return $this->customFieldRowInternal($fieldData, $widgetOptions['model'], $widgetOptions['attribute'], $rowOptions);
	}

	/**
	 * This is a intermediate method for widget-based row methods.
	 *
	 * @param string $className The widget class name or class in dot syntax (e.g. application.widgets.MyWidget).
	 * @param CModel $model The data model.
	 * @param string $attribute The attribute.
	 * @param array $widgetOptions List of initial property values for the widget (Property Name => Property Value).
	 * @param array $rowOptions Row attributes.
	 * @return string The generated widget row.
	 */
	protected function widgetRowInternal($className, &$model, &$attribute, &$widgetOptions, &$rowOptions)
	{
		$this->initRowOptions($rowOptions);
		$widgetOptions['model'] = $model;
		$widgetOptions['attribute'] = $attribute;

		$fieldData = array(array($this->owner, 'widget'), array($className, $widgetOptions, true));

		return $this->customFieldRowInternal($fieldData, $model, $attribute, $rowOptions);
	}

	/**
	 * Generates a custom field row for a model attribute.
	 *
	 * It's base function for generating row with field.
	 *
	 * @param array|string $fieldData Pre-rendered field as string or array of arguments for call_user_func_array() function.
	 * @param CModel $model The data model.
	 * @param string $attribute The attribute.
	 * @param array $rowOptions Row attributes.
	 * @return string The generated custom filed row.
	 * @throws CException Raised on invalid form type.
	 */
	protected function customFieldRowInternal(&$fieldData, &$model, &$attribute, &$rowOptions)
	{
		ob_start();
		switch ($this->type) {
			case self::TYPE_HORIZONTAL:
				$this->horizontalFieldRow($fieldData, $model, $attribute, $rowOptions);
				break;

			case self::TYPE_VERTICAL:
				$this->verticalFieldRow($fieldData, $model, $attribute, $rowOptions);
				break;

			case self::TYPE_INLINE:
			case self::TYPE_SEARCH:
				$this->inlineFieldRow($fieldData, $model, $attribute, $rowOptions);
				break;

			default:
				throw new CException('Invalid form type');
		}

		return ob_get_clean();
	}

	/**
	 * Renders a horizontal custom field row for a model attribute.
	 *
	 * @param array|string $fieldData Pre-rendered field as string or array of arguments for call_user_func_array() function.
	 * @param CModel $model The data model.
	 * @param string $attribute The attribute.
	 * @param array $rowOptions Row options.
	 */
	protected function horizontalFieldRow(&$fieldData, &$model, &$attribute, &$rowOptions)
	{
		$controlGroupHtmlOptions = array('class' => 'control-group');
		if ($model->hasErrors($attribute)) {
			self::addCssClass($controlGroupHtmlOptions, CHtml::$errorCss);
		}
		echo CHtml::openTag('div', $controlGroupHtmlOptions);

		self::addCssClass($rowOptions['labelOptions'], 'control-label');
		if (isset($rowOptions['label'])) {
			if (!empty($rowOptions['label'])) {
				echo CHtml::label($rowOptions['label'], CHtml::activeId($model, $attribute), $rowOptions['labelOptions']);
			}
		} else {
			echo $this->labelEx($model, $attribute, $rowOptions['labelOptions']);
		}

		echo '<div class="controls">';

		if (!empty($rowOptions['prepend']) || !empty($rowOptions['append'])) {
			$this->renderAddOnBegin($rowOptions['prepend'], $rowOptions['append'], $rowOptions['prependOptions']);
		}

		if (is_array($fieldData)) {
			echo call_user_func_array($fieldData[0], $fieldData[1]);
		} else {
			echo $fieldData;
		}

		if (!empty($rowOptions['prepend']) || !empty($rowOptions['append'])) {
			$this->renderAddOnEnd($rowOptions['append'], $rowOptions['appendOptions']);
		}

		if ($this->showErrors && $rowOptions['errorOptions'] !== false) {
			echo $this->error($model, $attribute, $rowOptions['errorOptions'], $rowOptions['enableAjaxValidation'], $rowOptions['enableClientValidation']);
		}

		if (isset($rowOptions['hint'])) {
			self::addCssClass($rowOptions['hintOptions'], $this->hintCssClass);
			echo CHtml::tag($this->hintTag, $rowOptions['hintOptions'], $rowOptions['hint']);
		}

		echo '</div></div>'; // controls, control-group
	}

	/**
	 * Renders a vertical custom field row for a model attribute.
	 *
	 * @param array|string $fieldData Pre-rendered field as string or array of arguments for call_user_func_array() function.
	 * @param CModel $model The data model.
	 * @param string $attribute The attribute.
	 * @param array $rowOptions Row options.
	 */
	protected function verticalFieldRow(&$fieldData, &$model, &$attribute, &$rowOptions)
	{
		if (isset($rowOptions['label'])) {
			if (!empty($rowOptions['label'])) {
				echo CHtml::label($rowOptions['label'], CHtml::activeId($model, $attribute), $rowOptions['labelOptions']);
			}
		} else {
			echo $this->labelEx($model, $attribute, $rowOptions['labelOptions']);
		}

		if (!empty($rowOptions['prepend']) || !empty($rowOptions['append'])) {
			$this->renderAddOnBegin($rowOptions['prepend'], $rowOptions['append'], $rowOptions['prependOptions']);
		}

		if (is_array($fieldData)) {
			echo call_user_func_array($fieldData[0], $fieldData[1]);
		} else {
			echo $fieldData;
		}

		if (!empty($rowOptions['prepend']) || !empty($rowOptions['append'])) {
			$this->renderAddOnEnd($rowOptions['append'], $rowOptions['appendOptions']);
		}

		if ($this->showErrors && $rowOptions['errorOptions'] !== false) {
			echo $this->error($model, $attribute, $rowOptions['errorOptions'], $rowOptions['enableAjaxValidation'], $rowOptions['enableClientValidation']);
		}

		if (isset($rowOptions['hint'])) {
			self::addCssClass($rowOptions['hintOptions'], $this->hintCssClass);
			echo CHtml::tag($this->hintTag, $rowOptions['hintOptions'], $rowOptions['hint']);
		}
	}

	/**
	 * Renders a inline custom field row for a model attribute.
	 *
	 * @param array|string $fieldData Pre-rendered field as string or array of arguments for call_user_func_array() function.
	 * @param CModel $model The data model.
	 * @param string $attribute The attribute.
	 * @param array $rowOptions Row options.
	 */
	protected function inlineFieldRow(&$fieldData, &$model, &$attribute, &$rowOptions)
	{
        echo '<div class="controls-inline">';

		if (!empty($rowOptions['prepend']) || !empty($rowOptions['append']))
			$this->renderAddOnBegin($rowOptions['prepend'], $rowOptions['append'], $rowOptions['prependOptions']);

		if (is_array($fieldData)) {
			echo call_user_func_array($fieldData[0], $fieldData[1]);
		} else {
			echo $fieldData;
		}

		if (!empty($rowOptions['prepend']) || !empty($rowOptions['append']))
			$this->renderAddOnEnd($rowOptions['append'], $rowOptions['appendOptions']);

        if ($this->showErrors && $rowOptions['errorOptions'] !== false) {
            echo $this->error($model, $attribute, $rowOptions['errorOptions'], $rowOptions['enableAjaxValidation'], $rowOptions['enableClientValidation']);
        }

        echo '</div>';
	}

	/**
	 * Renders add-on begin.
	 *
	 * @param string $prependText Prepended text.
	 * @param string $appendText Appended text.
	 * @param array $prependOptions Prepend options.
	 */
	protected function renderAddOnBegin($prependText, $appendText, $prependOptions)
	{
		$wrapperCssClass = array();
		if (!empty($prependText))
			$wrapperCssClass[] = $this->prependCssClass;
		if (!empty($appendText))
			$wrapperCssClass[] = $this->appendCssClass;

		echo CHtml::tag($this->addOnWrapperTag, array('class' => implode(' ', $wrapperCssClass)), false, false);
		if (!empty($prependText)) {
			if (isset($prependOptions['isRaw']) && $prependOptions['isRaw']) {
				echo $prependText;
			} else {
				self::addCssClass($prependOptions, $this->addOnCssClass);
				echo CHtml::tag($this->addOnTag, $prependOptions, $prependText);
			}
		}
	}

	/**
	 * Renders add-on end.
	 *
	 * @param string $appendText Appended text.
	 * @param array $appendOptions Append options.
	 */
	protected function renderAddOnEnd($appendText, $appendOptions)
	{
		if (!empty($appendText)) {
			if (isset($appendOptions['isRaw']) && $appendOptions['isRaw']) {
				echo $appendText;
			} else {
				self::addCssClass($appendOptions, $this->addOnCssClass);
				echo CHtml::tag($this->addOnTag, $appendOptions, $appendText);
			}
		}

		echo CHtml::closeTag($this->addOnWrapperTag);
	}

	/**
	 * @param array $options Row options.
	 */
	protected function initRowOptions(&$options)
	{
		if (!isset($options['labelOptions']))
			$options['labelOptions'] = array();

		if (!isset($options['errorOptions']))
			$options['errorOptions'] = array();

		if (!isset($options['prependOptions']))
			$options['prependOptions'] = array();

		if (!isset($options['prepend']))
			$options['prepend'] = null;

		if (!isset($options['appendOptions']))
			$options['appendOptions'] = array();

		if (!isset($options['append']))
			$options['append'] = null;

		if(!isset($options['enableAjaxValidation']))
			$options['enableAjaxValidation'] = true;

		if(!isset($options['enableClientValidation']))
			$options['enableClientValidation'] = true;
	}

	/**
	 * Utility function for appending class names for a generic $htmlOptions array.
	 *
	 * @param array $htmlOptions
	 * @param string $class
	 */
	protected static function addCssClass(&$htmlOptions, $class)
	{
		if (empty($class)) {
			return;
		}

		if (isset($htmlOptions['class'])) {
			$htmlOptions['class'] .= ' ' . $class;
		} else {
			$htmlOptions['class'] = $class;
		}
	}
}
