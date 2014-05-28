<?php
/**
 * YiiBooster project.
 * @license [New BSD License](http://www.opensource.org/licenses/bsd-license.php)
 */

/**
 * This class is extended version of {@link CActiveForm}, that allows you fully take advantage of bootstrap forms.
 * Basically form consists of control groups with label, field, error info, hint text and other useful stuff.
 * TbActiveForm brings together all of these things to quickly build custom forms even with non-standard fields.
 *
 * Each field method has $options for customizing rendering appearance.
 * <ul>
 * <li>'label' - Custom label text</li>
 * <li>'labelOptions' - options for label tag or passed to {@link CActiveForm::labelEx} call if 'label' is not set</li>
 * <li>'widgetOption' - options that will be passed to the contained widget</li>
 * <li>'errorOptions' - options for {@link CActiveForm::error} call</li>
 * <li>'prepend' - Custom text/HTML-code rendered before field</li>
 * <li>'prependOptions' - contains either isRaw => true , or HTML options for prepend wrapper tag</li>
 * <li>'append' - Custom text/HTML-code rendered after field</li>
 * <li>'appendOptions' - contains either isRaw => true , or HTML options for append wrapper tag</li>
 * <li>'hint' - Hint text rendered below the field</li>
 * <li>'hintOptions' - HTML options for hint wrapper tag</li>
 * <li>'enableAjaxValidation' - passed to {@link CActiveForm::error} call</li>
 * <li>'enableClientValidation' - passed to {@link CActiveForm::error} call</li>
 * </ul>
 *
 * Here's simple example how to build login form using this class:
 * <pre>
 * <?php $form = $this->beginWidget('booster.widgets.TbActiveForm', array(
 *     'type' => 'horizontal',
 *     'htmlOptions' => array('class' => 'well'),
 * )); ?>
 *
 * <?php echo $form->errorSummary($model); ?>
 *
 * <?php echo $form->textFieldGroup($model, 'username'); ?>
 * <?php echo $form->passwordFieldGroup($model, 'password', array(), array(
 *     'hint' => 'Check keyboard layout'
 * )); ?>
 * <?php echo $form->checkboxGroup($model, 'rememberMe'); ?>

 * <div class="form-actions">
 *     <?php echo CHtml::submitButton('Login', array('class'=>'btn')); ?>
 * </div>
 *
 * <?php $this->endWidget(); ?>
 * </pre>
 *
 * Additionally this class provides two additional ways to render custom widget or field or even everything you want
 * with {@link TbActiveForm::widgetGroup} and {@link TbActiveForm::customFieldGroup}.
 * Examples are simply clear:
 * <code>
 * $form->widgetGroup(
 *     'my.super.cool.widget',
 *     array('model' => $model, 'attribute' => $attribute, 'data' => $mydata),
 *     array('hint' => 'Hint text here!')
 * );
 *
 * // suppose that field is rendered via SomeClass::someMethod($model, $attribute) call.
 * $form->customFieldGroup(
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
class TbActiveForm extends CActiveForm {
	
	// Allowed form types.
	const TYPE_VERTICAL = 'vertical';
	const TYPE_INLINE = 'inline';
	const TYPE_HORIZONTAL = 'horizontal';
	
	protected static $typeClasses = array (
		self::TYPE_VERTICAL => '',
		self::TYPE_INLINE => '-inline',
		self::TYPE_HORIZONTAL => '-horizontal',
	);
	/**
	 * The form type. Allowed types are in `TYPE_*` constants.
	 * @var string
	 */
	public $type = self::TYPE_VERTICAL;

	/**
	 * Prepend wrapper CSS class.
	 * @var string
	 */
	public $prependCssClass = 'input-group';

	/**
	 * Append wrapper CSS class.
	 * @var string
	 */
	public $appendCssClass = 'input-group';

	/**
	 * Add-on CSS class.
	 * @var string
	 */
	public $addOnCssClass = 'input-group-addon';

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
	public $hintTag = 'span';

	/**
	 * Whether to render field error after input. Only for vertical and horizontal types.
	 * @var bool
	 */
	public $showErrors = true;

	/**
	 * Initializes the widget.
	 * This renders the form open tag.
	 */
	public function init() {
		
		self::addCssClass($this->htmlOptions, 'form' . self::$typeClasses[$this->type]);
		
		$this->errorMessageCssClass = 'help-block error';

		$this->clientOptions['errorCssClass'] = 'has-error';
		$this->clientOptions['successCssClass'] = 'has-success';
		$this->clientOptions['inputContainer'] = 'div.form-group';

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
	public function errorSummary($models, $header = null, $footer = null, $htmlOptions = array()) {
		
		if (!isset($htmlOptions['class'])) {
			$htmlOptions['class'] = 'alert alert-block alert-danger';
		}

		return parent::errorSummary($models, $header, $footer, $htmlOptions);
	}

	/**
	 * Generates a url field group for a model attribute.
	 *
	 * This method is a wrapper for {@link CActiveForm::urlField} and {@link customFieldGroup}.
	 * Please check {@link CActiveForm::urlField} for detailed information about $htmlOptions argument.
	 * About $options argument parameters see {@link TbActiveForm} documentation.
	 *
	 * @param CModel $model The data model.
	 * @param string $attribute The attribute.
	 * @param array $htmlOptions Additional HTML attributes.
	 * @param array $options Group attributes.
	 * @return string The generated url field group.
	 * @see CActiveForm::urlField
	 * @see customFieldGroup
	 */
	public function urlFieldGroup($model, $attribute, $options = array()) {
		
		$this->initOptions($options);
		$widgetOptions = $options['widgetOptions'];

		$this->addCssClass($widgetOptions['htmlOptions'], 'form-control');

		$fieldData = array(array($this, 'urlField'), array($model, $attribute, $widgetOptions['htmlOptions']));

		return $this->customFieldGroupInternal($fieldData, $model, $attribute, $options);
	}

	/**
	 * Generates an email field group for a model attribute.
	 *
	 * This method is a wrapper for {@link CActiveForm::emailField} and {@link customFieldGroup}.
	 * Please check {@link CActiveForm::emailField} for detailed information about $htmlOptions argument.
	 * About $options argument parameters see {@link TbActiveForm} documentation.
	 *
	 * @param CModel $model The data model.
	 * @param string $attribute The attribute.
	 * @param array $htmlOptions Additional HTML attributes.
	 * @param array $options Group attributes.
	 * @return string the generated email field group.
	 * @see CActiveForm::emailField
	 * @see customFieldGroup
	 */
	public function emailFieldGroup($model, $attribute, $options = array()) {
		
		$this->initOptions($options);
		$widgetOptions = $options['widgetOptions'];

		$this->addCssClass($widgetOptions['htmlOptions'], 'form-control');

		$fieldData = array(array($this, 'emailField'), array($model, $attribute, $widgetOptions['htmlOptions']));

		return $this->customFieldGroupInternal($fieldData, $model, $attribute, $options);
	}

	/**
	 * Generates a number field group for a model attribute.
	 *
	 * This method is a wrapper for {@link CActiveForm::numberField} and {@link customFieldGroup}.
	 * Please check {@link CActiveForm::numberField} for detailed information about $htmlOptions argument.
	 * About $options argument parameters see {@link TbActiveForm} documentation.
	 *
	 * @param CModel $model The data model.
	 * @param string $attribute The attribute.
	 * @param array $htmlOptions Additional HTML attributes.
	 * @param array $options Group attributes.
	 * @return string The generated number filed group.
	 * @see CActiveForm::numberField
	 * @see customFieldGroup
	 */
	public function numberFieldGroup($model, $attribute, $options = array()) {
		
		$this->initOptions($options);
		$widgetOptions = $options['widgetOptions'];

		$this->addCssClass($widgetOptions['htmlOptions'], 'form-control');

		$fieldData = array(array($this, 'numberField'), array($model, $attribute, $widgetOptions['htmlOptions']));

		return $this->customFieldGroupInternal($fieldData, $model, $attribute, $options);
	}

	/**
	 * Generates a range field group for a model attribute.
	 *
	 * This method is a wrapper for {@link CActiveForm::rangeField} and {@link customFieldGroup}.
	 * Please check {@link CActiveForm::rangeField} for detailed information about $htmlOptions argument.
	 * About $options argument parameters see {@link TbActiveForm} documentation.
	 *
	 * @param CModel $model The data model.
	 * @param string $attribute The attribute.
	 * @param array $htmlOptions Additional HTML attributes.
	 * @param array $options Group attributes.
	 * @return string The generated range field group.
	 * @see CActiveForm::rangeField
	 * @see customFieldGroup
	 */
	public function rangeFieldGroup($model, $attribute, $options = array()) {
				
		$this->initOptions($options);
		$widgetOptions = $options['widgetOptions'];

		$this->addCssClass($widgetOptions['htmlOptions'], 'form-control');
		
		$fieldData = array(array($this, 'rangeField'), array($model, $attribute, $widgetOptions['htmlOptions']));

		return $this->customFieldGroupInternal($fieldData, $model, $attribute, $options);
	}

	/**
	 * Generates a date field group for a model attribute.
	 *
	 * This method is a wrapper for {@link CActiveForm::dateField} and {@link customFieldGroup}.
	 * Please check {@link CActiveForm::dateField} for detailed information about $htmlOptions argument.
	 * About $options argument parameters see {@link TbActiveForm} documentation.
	 *
	 * @param CModel $model The data model.
	 * @param string $attribute The attribute.
	 * @param array $htmlOptions Additional HTML attributes.
	 * @param array $options Group attributes.
	 * @return string The generated date field group.
	 * @see CActiveForm::dateField
	 * @see customFieldGroup
	 */
	public function dateFieldGroup($model, $attribute, $options = array()) {
		
		$this->initOptions($options);
		$widgetOptions = $options['widgetOptions'];

		$this->addCssClass($widgetOptions['htmlOptions'], 'form-control');
		
		$fieldData = array(array($this, 'dateField'), array($model, $attribute, $widgetOptions['htmlOptions']));

		return $this->customFieldGroupInternal($fieldData, $model, $attribute, $options);
	}

	/**
	 * Generates a time field group for a model attribute.
	 *
	 * This method is a wrapper for {@link CActiveForm::timeField} and {@link customFieldGroup}.
	 * Please check {@link CActiveForm::timeField} for detailed information about $htmlOptions argument.
	 * About $options argument parameters see {@link TbActiveForm} documentation.
	 *
	 * @param CModel $model The data model.
	 * @param string $attribute The attribute.
	 * @param array $htmlOptions Additional HTML attributes.
	 * @param array $options Group attributes.
	 * @return string The generated date field group.
	 * @see CActiveForm::timeField
	 * @see customFieldGroup
	 */
	public function timeFieldGroup($model, $attribute, $options = array()) {
		
		$this->initOptions($options);
		$widgetOptions = $options['widgetOptions'];

		$this->addCssClass($widgetOptions['htmlOptions'], 'form-control');

		$fieldData = array(array($this, 'timeField'), array($model, $attribute, $widgetOptions['htmlOptions']));

		return $this->customFieldGroupInternal($fieldData, $model, $attribute, $options);
	}

	/**
	 * Generates a tel field group for a model attribute.
	 *
	 * This method is a wrapper for {@link CActiveForm::telField} and {@link customFieldGroup}.
	 * Please check {@link CActiveForm::telField} for detailed information about $htmlOptions argument.
	 * About $options argument parameters see {@link TbActiveForm} documentation.
	 *
	 * @param CModel $model The data model.
	 * @param string $attribute The attribute.
	 * @param array $htmlOptions Additional HTML attributes.
	 * @param array $options Group attributes.
	 * @return string The generated date field group.
	 * @see CActiveForm::telField
	 * @see customFieldGroup
	 */
	public function telFieldGroup($model, $attribute, $options = array()) {
		
		$this->initOptions($options);
		$widgetOptions = $options['widgetOptions'];

		$this->addCssClass($widgetOptions['htmlOptions'], 'form-control');
		
		$fieldData = array(array($this, 'telField'), array($model, $attribute, $widgetOptions['htmlOptions']));

		return $this->customFieldGroupInternal($fieldData, $model, $attribute, $options);
	}

	/**
	 * Generates a text field group for a model attribute.
	 *
	 * This method is a wrapper for {@link CActiveForm::textField} and {@link customFieldGroup}.
	 * Please check {@link CActiveForm::textField} for detailed information about $htmlOptions argument.
	 * About $options argument parameters see {@link TbActiveForm} documentation.
	 *
	 * @param CModel $model The data model.
	 * @param string $attribute The attribute.
	 * @param array $htmlOptions Additional HTML attributes.
	 * @param array $options Group attributes.
	 * @return string The generated text field group.
	 * @see CActiveForm::textField
	 * @see customFieldGroup
	 */
	public function textFieldGroup($model, $attribute, $options = array()) {
		
		$this->initOptions($options);
		$widgetOptions = $options['widgetOptions'];
		
		$this->addCssClass($widgetOptions['htmlOptions'], 'form-control');
		
		$fieldData = array(array($this, 'textField'), array($model, $attribute, $widgetOptions['htmlOptions']));
	
		return $this->customFieldGroupInternal($fieldData, $model, $attribute, $options);
	}
	
	/**
	 * Generates a search field group for a model attribute.
	 *
	 * This method is a wrapper for {@link CActiveForm::searchField} and {@link customFieldGroup}.
	 * Please check {@link CActiveForm::searchField} for detailed information about $htmlOptions argument.
	 * About $options argument parameters see {@link TbActiveForm} documentation.
	 *
	 * @param CModel $model The data model.
	 * @param string $attribute The attribute.
	 * @param array $options Group attributes.
	 * @return string The generated text field group.
	 * @see CActiveForm::searchField
	 * @see customFieldGroup
	 */
	public function searchFieldGroup($model, $attribute, $options = array()) {
		
		$this->initOptions($options);
		$widgetOptions = $options['widgetOptions'];
		
		$this->addCssClass($widgetOptions['htmlOptions'], 'form-control');
		
		$fieldData = array(array($this, 'searchField'), array($model, $attribute, $widgetOptions['htmlOptions']));

		return $this->customFieldGroupInternal($fieldData, $model, $attribute, $options);
	}

	/**
	 * Generates a password field group for a model attribute.
	 *
	 * This method is a wrapper for {@link CActiveForm::passwordField} and {@link customFieldGroup}.
	 * Please check {@link CActiveForm::passwordField} for detailed information about $htmlOptions argument.
	 * About $options argument parameters see {@link TbActiveForm} documentation.
	 *
	 * @param CModel $model The data model.
	 * @param string $attribute The attribute.
	 * @param array $htmlOptions Additional HTML attributes.
	 * @param array $options Group attributes.
	 * @return string The generated password field group.
	 * @see CActiveForm::passwordField
	 * @see customFieldGroup
	 */
	public function passwordFieldGroup($model, $attribute, $options = array()) {
		
		$this->initOptions($options);
		$this->addCssClass($options['widgetOptions']['htmlOptions'], 'form-control');
	
		$fieldData = array(array($this, 'passwordField'), array($model, $attribute, $options['widgetOptions']['htmlOptions']));
	
		return $this->customFieldGroupInternal($fieldData, $model, $attribute, $options);
	}

	/**
	 * Generates a text area group for a model attribute.
	 *
	 * This method is a wrapper for {@link CActiveForm::textArea} and {@link customFieldGroup}.
	 * Please check {@link CActiveForm::textArea} for detailed information about $htmlOptions argument.
	 * About $options argument parameters see {@link TbActiveForm} documentation.
	 *
	 * @param CModel $model The data model.
	 * @param string $attribute The attribute.
	 * @param array $htmlOptions Additional HTML attributes.
	 * @param array $options Group attributes.
	 * @return string The generated text area group.
	 * @see CActiveForm::textArea
	 * @see customFieldGroup
	 */
	public function textAreaGroup($model, $attribute, $options = array()) {
		
		$this->initOptions($options);
		$this->addCssClass($options['widgetOptions']['htmlOptions'], 'form-control');

		$fieldData = array(array($this, 'textArea'), array($model, $attribute, $options['widgetOptions']['htmlOptions']));

		return $this->customFieldGroupInternal($fieldData, $model, $attribute, $options);
	}

	/**
	 * Generates a file field group for a model attribute.
	 *
	 * This method is a wrapper for {@link CActiveForm::fileField} and {@link customFieldGroup}.
	 * Please check {@link CActiveForm::fileField} for detailed information about $htmlOptions argument.
	 * About $options argument parameters see {@link TbActiveForm} documentation.
	 *
	 * @param CModel $model The data model.
	 * @param string $attribute The attribute.
	 * @param array $htmlOptions Additional HTML attributes.
	 * @param array $options Group attributes.
	 * @return string The generated file field group.
	 * @see CActiveForm::fileField
	 * @see customFieldGroup
	 */
	public function fileFieldGroup($model, $attribute, $options = array()) {
		
		$this->initOptions($options);
		$widgetOptions = $options['widgetOptions'];
		
		$this->addCssClass($widgetOptions['htmlOptions'], 'form-control');
		
		$fieldData = array(array($this, 'fileField'), array($model, $attribute, $widgetOptions['htmlOptions']));

		return $this->customFieldGroupInternal($fieldData, $model, $attribute, $options);
	}

	/**
	 * Generates a radio button group for a model attribute.
	 *
	 * This method is a wrapper for {@link CActiveForm::radioButton} and {@link customFieldGroup}.
	 * Please check {@link CActiveForm::radioButton} for detailed information about $htmlOptions argument.
	 * About $options argument parameters see {@link TbActiveForm} documentation.
	 *
	 * @param CModel $model The data model.
	 * @param string $attribute The attribute.
	 * @param array $htmlOptions Additional HTML attributes.
	 * @param array $options Group attributes.
	 * @return string The generated radio button group.
	 * @see CActiveForm::radioButton
	 * @see customFieldGroup
	 */
	public function radioButtonGroup($model, $attribute, $options = array()) {
		
		$this->initOptions($options);
		$widgetOptions = $options['widgetOptions']['htmlOptions'];
		
		self::addCssClass($options['labelOptions'], 'radio');
		if( $this->type == self::TYPE_INLINE || (isset($options['inline']) && $options['inline']) )
			self::addCssClass($options['labelOptions'], 'radio-inline');
		
		$field = $this->radioButton($model, $attribute, $widgetOptions);
		if ((!array_key_exists('uncheckValue', $widgetOptions) || isset($widgetOptions['uncheckValue']))
			&& preg_match('/\<input.*?type="hidden".*?\>/', $field, $matches)
		) {
			$hiddenField = $matches[0];
			$field = str_replace($hiddenField, '', $field);
		}

		$realAttribute = $attribute;
		CHtml::resolveName($model, $realAttribute);

		ob_start();
		if (isset($hiddenField)) echo $hiddenField;
		echo CHtml::tag('label', $options['labelOptions'], false, false);
		echo $field;
		if (isset($options['label'])) {
			if ($options['label'])
				echo $options['label'];
		} else
			echo $model->getAttributeLabel($realAttribute);
		echo CHtml::closeTag('label');
		$fieldData = ob_get_clean();

		$widgetOptions['label'] = '';

		return $this->customFieldGroupInternal($fieldData, $model, $attribute, $options);
	}

	/**
	 * Generates a checkbox group for a model attribute.
	 *
	 * This method is a wrapper for {@link CActiveForm::checkbox} and {@link customFieldGroup}.
	 * Please check {@link CActiveForm::checkbox} for detailed information about $htmlOptions argument.
	 * About $options argument parameters see {@link TbActiveForm} documentation.
	 *
	 * @param CModel $model The data model.
	 * @param string $attribute The attribute.
	 * @param array $htmlOptions Additional HTML attributes.
	 * @param array $options Group attributes.
	 * @return string The generated checkbox group.
	 * @see CActiveForm::checkbox
	 * @see customFieldGroup
	 */
	public function checkboxGroup($model, $attribute, $options = array()) {

		$this->initOptions($options);
	
		if ($this->type == self::TYPE_INLINE)
			self::addCssClass($options['labelOptions'], 'inline');
	
		$field = $this->checkbox($model, $attribute, $options['widgetOptions']['htmlOptions']);
		if ((!array_key_exists('uncheckValue', $options['widgetOptions']) || isset($options['widgetOptions']['uncheckValue']))
		&& preg_match('/\<input.*?type="hidden".*?\>/', $field, $matches)
		) {
			$hiddenField = $matches[0];
			$field = str_replace($hiddenField, '', $field);
		}
	
		$realAttribute = $attribute;
		CHtml::resolveName($model, $realAttribute);
	
		ob_start();
		echo '<div class="checkbox">';
		if (isset($hiddenField)) echo $hiddenField;
		echo CHtml::tag('label', $options['labelOptions'], false, false);
		echo $field;
		if (isset($options['label'])) {
			if ($options['label'])
				echo $options['label'];
		} else
			echo ' '.$model->getAttributeLabel($realAttribute);
		echo CHtml::closeTag('label');
		echo '</div>';
		$fieldData = ob_get_clean();
	
		$options['label'] = '';
	
		return $this->customFieldGroupInternal($fieldData, $model, $attribute, $options);
	}

	/**
	 * Generates a dropdown list group for a model attribute.
	 *
	 * This method is a wrapper for {@link CActiveForm::dropDownList} and {@link customFieldGroup}.
	 * Please check {@link CActiveForm::dropDownList} for detailed information about $htmlOptions argument.
	 * About $options argument parameters see {@link TbActiveForm} documentation.
	 *
	 * @param CModel $model The data model.
	 * @param string $attribute The attribute.
	 * @param array $data Data for generating the list options (value=>display).
	 * @param array $htmlOptions Additional HTML attributes.
	 * @param array $options Group attributes.
	 * @return string The generated drop down list group.
	 * @see CActiveForm::dropDownList
	 * @see customFieldGroup
	 */
	public function dropDownListGroup($model, $attribute, $options = array()) {
		
		$this->initOptions($options, true);
		$widgetOptions = $options['widgetOptions'];
		
		// if(!isset($widgetOptions['data']))
			// throw new CException('$options["widgetOptions"]["data"] must exist');
		
		$this->addCssClass($widgetOptions['htmlOptions'], 'form-control');
		
		$fieldData = array(array($this, 'dropDownList'), array($model, $attribute, $widgetOptions['data'], $widgetOptions['htmlOptions']));

		return $this->customFieldGroupInternal($fieldData, $model, $attribute, $options);
	}

	/**
	 * Generates a list box group for a model attribute.
	 *
	 * This method is a wrapper for {@link CActiveForm::listBox} and {@link customFieldGroup}.
	 * Please check {@link CActiveForm::listBox} for detailed information about $htmlOptions argument.
	 * About $options argument parameters see {@link TbActiveForm} documentation.
	 *
	 * @param CModel $model The data model.
	 * @param string $attribute The attribute.
	 * @param array $data
	 * @param array $htmlOptions Additional HTML attributes.
	 * @param array $options Group attributes.
	 * @return string The generated list box group.
	 * @see CActiveForm::listBox
	 * @see customFieldGroup
	 */
	public function listBoxGroup($model, $attribute, $options = array()) {
		
		$this->initOptions($options, true);
		$widgetOptions = $options['widgetOptions'];
		
		// if(!isset($widgetOptions['data']))
			// throw new CException('$options["widgetOptions"]["data"] must exist');
		
		$this->addCssClass($widgetOptions['htmlOptions'], 'form-control');

		$fieldData = array(array($this, 'listBox'), array($model, $attribute, $widgetOptions['data'], $widgetOptions['htmlOptions']));

		return $this->customFieldGroupInternal($fieldData, $model, $attribute, $options);
	}

	/**
	 * Generates a checkbox list group for a model attribute.
	 *
	 * This method is a wrapper for {@link CActiveForm::checkboxList} and {@link customFieldGroup}.
	 * Please check {@link CActiveForm::checkboxList} for detailed information about $htmlOptions argument.
	 * About $options argument parameters see {@link TbActiveForm} documentation.
	 *
	 * @param CModel $model The data model.
	 * @param string $attribute The attribute.
	 * @param array $data Value-label pairs used to generate the check box list.
	 * @param array $htmlOptions Additional HTML attributes.
	 * @param array $options Group attributes.
	 * @return string The generated checkbox list group.
	 * @see CActiveForm::checkboxList
	 * @see customFieldGroup
	 */
	public function checkboxListGroup($model, $attribute, $options = array()) {
		
		$this->initOptions($options, true);

		$widgetOptions = $options['widgetOptions']['htmlOptions'];
		
		// if(!isset($options['widgetOptions']['data']))
			// throw new CException('$options["widgetOptions"]["data"] must exist');
		
		if (!isset($widgetOptions['labelOptions']['class']))
			$widgetOptions['labelOptions']['class'] = 'checkbox';
		
		if(isset($options['inline']) && $options['inline'])
			$widgetOptions['labelOptions']['class'] = 'checkbox-inline';

		if (!isset($widgetOptions['template']))
			$widgetOptions['template'] = '{beginLabel}{input}{labelTitle}{endLabel}';

		if (!isset($widgetOptions['separator']))
			$widgetOptions['separator'] = "\n";

		$data = $options['widgetOptions']['data'];
		
		$fieldData = array(array($this, 'checkboxList'), array($model, $attribute, $data, $widgetOptions));

		return $this->customFieldGroupInternal($fieldData, $model, $attribute, $options);
	}

	/**
	 * Generates a radio button list group for a model attribute.
	 *
	 * This method is a wrapper for {@link CActiveForm::radioButtonList} and {@link customFieldGroup}.
	 * Please check {@link CActiveForm::radioButtonList} for detailed information about $htmlOptions argument.
	 * About $options argument parameters see {@link TbActiveForm} documentation.
	 *
	 * @param CModel $model The data model.
	 * @param string $attribute The attribute.
	 * @param array $data Value-label pairs used to generate the radio button list.
	 * @param array $htmlOptions Additional HTML attributes.
	 * @param array $options Group attributes.
	 * @return string The generated radio button list group.
	 * @see CActiveForm::radioButtonList
	 * @see customFieldGroup
	 */
	public function radioButtonListGroup($model, $attribute, $options = array()) {
		
		$this->initOptions($options, true);
		
		$widgetOptions = $options['widgetOptions']['htmlOptions'];
		
		// if(!isset($options['widgetOptions']['data']))
			// throw new CException('$options["widgetOptions"]["data"] must exist');
		
		if (!isset($widgetOptions['labelOptions']['class']))
			$widgetOptions['labelOptions']['class'] = 'radio';
		
		if(isset($options['inline']) && $options['inline'])
			$widgetOptions['labelOptions']['class'] = 'checkbox-inline';
		
		if (!isset($widgetOptions['template']))
			$widgetOptions['template'] = '{beginLabel}{input}{labelTitle}{endLabel}';

		if (!isset($widgetOptions['separator']))
			$widgetOptions['separator'] = "\n";
		
		$data = $options['widgetOptions']['data'];

		$fieldData = array(array($this, 'radioButtonList'), array($model, $attribute, $data, $widgetOptions));

		return $this->customFieldGroupInternal($fieldData, $model, $attribute, $options);
	}

	/**
	 * Generates a toggle button group for a model attribute.
	 *
	 * This method is a wrapper for {@link TbToggleButton} widget and {@link customFieldGroup}.
	 * Please check {@link TbToggleButton} documentation for detailed information about $widgetOptions.
	 * About $options argument parameters see {@link TbActiveForm} documentation.
	 *
	 * @param CModel $model The data model.
	 * @param string $attribute The attribute.
	 * @param array $widgetOptions List of initial property values for the widget (Property Name => Property Value).
	 * @param array $options Group attributes.
	 * @return string The generated toggle button group.
	 * @see TbToggleButton
	 * @see customFieldGroup
	 */
	public function switchGroup($model, $attribute, $options = array()) {
		
		return $this->widgetGroupInternal('booster.widgets.TbSwitch', $model, $attribute, $options);
	}

	/**
	 * Generates a date picker group for a model attribute.
	 *
	 * This method is a wrapper for {@link TbDatePicker} widget and {@link customFieldGroup}.
	 * Please check {@link TbDatePicker} documentation for detailed information about $widgetOptions.
	 * About $options argument parameters see {@link TbActiveForm} documentation.
	 *
	 * @param CModel $model The data model.
	 * @param string $attribute The attribute.
	 * @param array $widgetOptions List of initial property values for the widget (Property Name => Property Value).
	 * @param array $options Group attributes.
	 * @return string The generated date picker group.
	 * @see TbDatePicker
	 * @see customFieldGroup
	 */
	public function datePickerGroup($model, $attribute, $options = array()) {
		
		return $this->widgetGroupInternal('booster.widgets.TbDatePicker', $model, $attribute, $options);
	}

	/**
	 * Generates a date range picker group for a model attribute.
	 *
	 * This method is a wrapper for {@link TbDateRangePicker} widget and {@link customFieldGroup}.
	 * Please check {@link TbDateRangePicker} documentation for detailed information about $widgetOptions.
	 * About $options argument parameters see {@link TbActiveForm} documentation.
	 *
	 * @param CModel $model The data model.
	 * @param string $attribute The attribute.
	 * @param array $widgetOptions List of initial property values for the widget (Property Name => Property Value).
	 * @param array $options Group attributes.
	 * @return string The generated date range picker group.
	 * @see TbDateRangePicker
	 * @see customFieldGroup
	 */
	public function dateRangeGroup($model, $attribute, $options = array()) {
		
		return $this->widgetGroupInternal('booster.widgets.TbDateRangePicker', $model, $attribute, $options);
	}

	/**
	 * Generates a time picker group for a model attribute.
	 *
	 * This method is a wrapper for {@link TbTimePicker} widget and {@link customFieldGroup}.
	 * Please check {@link TbTimePicker} documentation for detailed information about $widgetOptions.
	 * About $options argument parameters see {@link TbActiveForm} documentation.
	 *
	 * @param CModel $model The data model.
	 * @param string $attribute The attribute.
	 * @param array $widgetOptions List of initial property values for the widget (Property Name => Property Value).
	 * @param array $options Group attributes.
	 * @return string The generated time picker group.
	 * @see TbTimePicker
	 * @see customFieldGroup
	 */
	public function timePickerGroup($model, $attribute, $options = array()) {
		
		return $this->widgetGroupInternal('booster.widgets.TbTimePicker', $model, $attribute, $options);
	}

	/**
	 * Generates a date-time picker group for a model attribute.
	 *
	 * This method is a wrapper for {@link TbDateTimePicker} widget and {@link customFieldGroup}.
	 * Please check {@link TbDateTimePicker} documentation for detailed information about $widgetOptions.
	 * About $options argument parameters see {@link TbActiveForm} documentation.
	 *
	 * @param CModel $model The data model.
	 * @param string $attribute The attribute.
	 * @param array $widgetOptions List of initial property values for the widget (Property Name => Property Value).
	 * @param array $options Group attributes.
	 * @return string The generated date-time picker group.
	 * @see TbDateTimePicker
	 * @see customFieldGroup
	 */
	public function dateTimePickerGroup($model, $attribute, $options = array()) {
		
		return $this->widgetGroupInternal('booster.widgets.TbDateTimePicker', $model, $attribute, $options);
	}

	/**
	 * Generates a select2 group for a model attribute.
	 *
	 * This method is a wrapper for {@link TbSelect2} widget and {@link customFieldGroup}.
	 * Please check {@link TbSelect2} documentation for detailed information about $widgetOptions.
	 * About $options argument parameters see {@link TbActiveForm} documentation.
	 *
	 * @param CModel $model The data model.
	 * @param string $attribute The attribute.
	 * @param array $widgetOptions List of initial property values for the widget (Property Name => Property Value).
	 * @param array $options Group attributes.
	 * @return string The generated select2 group.
	 * @see TbSelect2
	 * @see customFieldGroup
	 */
	public function select2Group($model, $attribute, $options = array()) {
		
		return $this->widgetGroupInternal('booster.widgets.TbSelect2', $model, $attribute, $options);
	}

	/**
	 * Generates a redactor editor group for a model attribute.
	 *
	 * This method is a wrapper for {@link TbRedactorJs} widget and {@link customFieldGroup}.
	 * Please check {@link TbRedactorJs} documentation for detailed information about $widgetOptions.
	 * About $options argument parameters see {@link TbActiveForm} documentation.
	 *
	 * @param CModel $model The data model.
	 * @param string $attribute The attribute.
	 * @param array $widgetOptions List of initial property values for the widget (Property Name => Property Value).
	 * @param array $options Group attributes.
	 * @return string The generated redactor editor group.
	 * @see TbRedactorJs
	 * @see customFieldGroup
	 */
	public function redactorGroup($model, $attribute, $options = array()) {
		
		return $this->widgetGroupInternal('booster.widgets.TbRedactorJs', $model, $attribute, $options);
	}

	/**
	 * Generates a html5 editor group for a model attribute.
	 *
	 * This method is a wrapper for {@link TbHtml5Editor} widget and {@link customFieldGroup}.
	 * Please check {@link TbHtml5Editor} documentation for detailed information about $widgetOptions.
	 * About $options argument parameters see {@link TbActiveForm} documentation.
	 *
	 * @param CModel $model The data model.
	 * @param string $attribute The attribute.
	 * @param array $widgetOptions List of initial property values for the widget (Property Name => Property Value).
	 * @param array $options Group attributes.
	 * @return string The generated html5 editor group.
	 * @see TbHtml5Editor
	 * @see customFieldGroup
	 */
	public function html5EditorGroup($model, $attribute, $options = array()) {
		
		return $this->widgetGroupInternal('booster.widgets.TbHtml5Editor', $model, $attribute, $options);
	}

	/**
	 * Generates a markdown editor group for a model attribute.
	 *
	 * This method is a wrapper for {@link TbMarkdownEditorJs} widget and {@link customFieldGroup}.
	 * Please check {@link TbMarkdownEditorJs} documentation for detailed information about $widgetOptions.
	 * About $options argument parameters see {@link TbActiveForm} documentation.
	 *
	 * @param CModel $model The data model.
	 * @param string $attribute The attribute.
	 * @param array $widgetOptions List of initial property values for the widget (Property Name => Property Value).
	 * @param array $options Group attributes.
	 * @return string The generated markdown editor group.
	 * @see TbMarkdownEditorJs
	 * @see customFieldGroup
	 */
	public function markdownEditorGroup($model, $attribute, $options = array()) {
		
		return $this->widgetGroupInternal('booster.widgets.TbMarkdownEditor', $model, $attribute, $options);
	}

	/**
	 * Generates a CKEditor group for a model attribute.
	 *
	 * This method is a wrapper for {@link TbCKEditor} widget and {@link customFieldGroup}.
	 * Please check {@link TbCKEditor} documentation for detailed information about $widgetOptions.
	 * About $options argument parameters see {@link TbActiveForm} documentation.
	 *
	 * @param CModel $model The data model.
	 * @param string $attribute The attribute.
	 * @param array $widgetOptions List of initial property values for the widget (Property Name => Property Value).
	 * @param array $options Group attributes.
	 * @return string The generated CKEditor group.
	 * @see TbCKEditor
	 * @see customFieldGroup
	 */
	public function ckEditorGroup($model, $attribute, $options = array()) {
		
		return $this->widgetGroupInternal('booster.widgets.TbCKEditor', $model, $attribute, $options);
	}

	/**
	 * Generates a type-ahead group for a model attribute.
	 *
	 * This method is a wrapper for {@link TbTypeahead} widget and {@link customFieldGroup}.
	 * Please check {@link TbTypeahead} documentation for detailed information about $widgetOptions.
	 * About $options argument parameters see {@link TbActiveForm} documentation.
	 *
	 * @param CModel $model The data model.
	 * @param string $attribute The attribute.
	 * @param array $widgetOptions List of initial property values for the widget (Property Name => Property Value).
	 * @param array $options Group attributes.
	 * @return string The generated type-ahead group.
	 * @see TbTypeahead
	 * @see customFieldGroup
	 */
	public function typeAheadGroup($model, $attribute, $options = array()) {
		
		return $this->widgetGroupInternal('booster.widgets.TbTypeahead', $model, $attribute, $options);
	}

	/**
	 * Generates a masked text field group for a model attribute.
	 *
	 * This method is a wrapper for {@link CMaskedTextField} widget and {@link customFieldGroup}.
	 * Please check {@link CMaskedTextField} documentation for detailed information about $widgetOptions.
	 * About $options argument parameters see {@link TbActiveForm} documentation.
	 *
	 * @param CModel $model The data model.
	 * @param string $attribute The attribute.
	 * @param array $widgetOptions List of initial property values for the widget (Property Name => Property Value).
	 * @param array $options Group attributes.
	 * @return string The generated masked text field group.
	 * @see CMaskedTextField
	 * @see customFieldGroup
	 */
	public function maskedTextFieldGroup($model, $attribute, $options = array()) {
		
		return $this->widgetGroupInternal('CMaskedTextField', $model, $attribute, $options);
	}

	/**
	 * Generates a color picker field group for a model attribute.
	 *
	 * This method is a wrapper for {@link TbColorPicker} widget and {@link customFieldGroup}.
	 * Please check {@link TbColorPicker} documentation for detailed information about $widgetOptions.
	 * About $options argument parameters see {@link TbActiveForm} documentation.
	 *
	 * @param CModel $model The data model.
	 * @param string $attribute The attribute.
	 * @param array $widgetOptions List of initial property values for the widget (Property Name => Property Value).
	 * @param array $options Group attributes.
	 * @return string The generated color picker group.
	 * @see TbColorPicker
	 * @see customFieldGroup
	 */
	public function colorPickerGroup($model, $attribute, $options = array()) {
		
		return $this->widgetGroupInternal('booster.widgets.TbColorPicker', $model, $attribute, $options);
	}

	/**
	 * Generates a color picker field group for a model attribute.
	 *
	 * This method is a wrapper for {@link CCaptcha} widget, {@link textField} and {@link customFieldGroup}.
	 * Please check {@link CCaptcha} documentation for detailed information about $widgetOptions.
	 * Read detailed information about $htmlOptions in {@link CActiveForm::textField} method.
	 * About $options argument parameters see {@link TbActiveForm} documentation.
	 *
	 * @param CModel $model The data model.
	 * @param string $attribute The attribute.
	 * @param array $htmlOptions Additional HTML attributes for captcha text field.
	 * @param array $widgetOptions List of initial property values for the CCaptcha widget (Property Name => Property Value).
	 * @param array $options Group attributes.
	 * @return string The generated color picker group.
	 * @see CCaptcha
	 * @see CActiveForm::textField
	 * @see customFieldGroup
	 */
	public function captchaGroup($model, $attribute, $htmlOptions = array(), $options = array()) {
		
		$this->initOptions($options);
		$widgetOptions = $options['widgetOptions'];
		
		$this->addCssClass($widgetOptions['htmlOptions'], 'form-control');

		$fieldData = $this->textField($model, $attribute, $widgetOptions['htmlOptions']);
		unset($widgetOptions['htmlOptions']);
		$fieldData .= '<div class="captcha">' . $this->owner->widget('CCaptcha', $widgetOptions, true) . '</div>';

		return $this->customFieldGroupInternal($fieldData, $model, $attribute, $options);
	}

	/**
	 * Generates a Pass*Field group for a model attribute.
	 *
	 * This method is a wrapper for {@link TbPassfield} widget and {@link customFieldGroup}.
	 * Please check {@link TbPassfield} documentation for detailed information about $widgetOptions.
	 * About $options argument parameters see {@link TbActiveForm} documentation.
	 *
	 * @param CModel $model The data model.
	 * @param string $attribute The attribute.
	 * @param array $widgetOptions List of initial property values for the widget (Property Name => Property Value).
	 * @param array $options Group attributes.
	 * @return string The generated color picker group.
	 * @see TbPassfield
	 * @see customFieldGroup
	 */
	public function passFieldGroup($model, $attribute, $options = array()) {
		
		return $this->widgetGroupInternal('booster.widgets.TbPassfield', $model, $attribute, $options);
	}

	/**
	 * Generates a custom field group for a model attribute.
	 * About $options argument parameters see {@link TbActiveForm} documentation.
	 *
	 * @param array|string $fieldData Pre-rendered field as string or array of arguments for call_user_func_array()
	 * function.
	 * @param CModel $model The data model.
	 * @param string $attribute The attribute.
	 * @param array $options Group attributes.
	 * @return string The generated custom filed group.
	 * @see call_user_func_array
	 */
	public function customFieldGroup($fieldData, $model, $attribute, $options = array()) {
		
		$this->initOptions($options);

		return $this->customFieldGroupInternal($fieldData, $model, $attribute, $options);
	}

	/**
	 * Generates a widget group for a model attribute.
	 *
	 * This method is a wrapper for {@link CBaseController::widget} and {@link customFieldGroup}.
	 * Read detailed information about $widgetOptions in $properties argument of {@link CBaseController::widget} method.
	 * About $options argument parameters see {@link TbActiveForm} documentation.
	 *
	 * @param string $className The widget class name or class in dot syntax (e.g. application.widgets.MyWidget).
	 * @param CModel $model The data model.
	 * @param string $attribute The attribute.
	 * @param array $options List of initial property values for the group (Property Name => Property Value).
	 * @return string The generated widget group.
	 * @see CBaseController::widget
	 * @see customFieldGroup
	 */
	public function widgetGroup($className, $model, $attribute, $options = array()) {
		
		$this->initOptions($options);
		$widgetOptions = isset($options['widgetOptions']) ? $options['widgetOptions'] : null;
		
		$fieldData = array(array($this->owner, 'widget'), array($className, $widgetOptions, true));

		return $this->customFieldGroupInternal($fieldData, $model, $attribute, $options);
	}

	/**
	 * This is a intermediate method for widget-based group methods.
	 *
	 * @param string $className The widget class name or class in dot syntax (e.g. application.widgets.MyWidget).
	 * @param CModel $model The data model.
	 * @param string $attribute The attribute.
	 * @param array $widgetOptions List of initial property values for the widget (Property Name => Property Value).
	 * @param array $options Group attributes.
	 * @return string The generated widget group.
	 */
	protected function widgetGroupInternal($className, &$model, &$attribute, &$options) {
		// if(empty($options['widgetOptions']['mask'])) exit;
		$this->initOptions($options);
		$widgetOptions = $options['widgetOptions'];
		$widgetOptions['model'] = $model;
		$widgetOptions['attribute'] = $attribute;
		
		$this->addCssClass($widgetOptions['htmlOptions'], 'form-control');
		
		$fieldData = array(array($this->owner, 'widget'), array($className, $widgetOptions, true));

		return $this->customFieldGroupInternal($fieldData, $model, $attribute, $options);
	}

	/**
	 * Generates a custom field group for a model attribute.
	 *
	 * It's base function for generating group with field.
	 *
	 * @param array|string $fieldData Pre-rendered field as string or array of arguments for call_user_func_array() function.
	 * @param CModel $model The data model.
	 * @param string $attribute The attribute.
	 * @param array $options Group attributes.
	 * @return string The generated custom filed group.
	 * @throws CException Raised on invalid form type.
	 */
	protected function customFieldGroupInternal(&$fieldData, &$model, &$attribute, &$options) {
		
		$this->setDefaultPlaceholder($fieldData);

		ob_start();
		switch ($this->type) {
			case self::TYPE_HORIZONTAL:
				$this->horizontalGroup($fieldData, $model, $attribute, $options);
				break;

			case self::TYPE_VERTICAL:
				$this->verticalGroup($fieldData, $model, $attribute, $options);
				break;

			case self::TYPE_INLINE:
				$this->inlineGroup($fieldData, $model, $attribute, $options);
				break;

			default:
				throw new CException('Invalid form type');
		}

		return ob_get_clean();
	}
	
	/**
	 * Sets default placeholder value in case of CModel attribute depending on attribute label
	 *  
	  * @param array|string $fieldData Pre-rendered field as string or array of arguments for call_user_func_array() function.
	 */
	protected function setDefaultPlaceholder(&$fieldData) {
		
		if(!is_array($fieldData) 
			|| empty($fieldData[0][1]) /* 'textField' */
			|| !is_array($fieldData[1]) /* ($model, $attribute, $htmlOptions) */
		)
			return;
			
		$model = $fieldData[1][0];
		if(!$model instanceof CModel)
			return;
		
		$attribute = $fieldData[1][1];
		if(!empty($fieldData[1][3]) && is_array($fieldData[1][3])) {
			/* ($model, $attribute, $data, $htmlOptions) */
			$htmlOptions = &$fieldData[1][3];
		} else {
			/* ($model, $attribute, $htmlOptions) */
			$htmlOptions = &$fieldData[1][2];
		}
		if (!isset($htmlOptions['placeholder'])) {
			$htmlOptions['placeholder'] = $model->getAttributeLabel($attribute);
		}
		
	}

	/**
	 * Renders a horizontal custom field group for a model attribute.
	 *
	 * @param array|string $fieldData Pre-rendered field as string or array of arguments for call_user_func_array() function.
	 * @param CModel $model The data model.
	 * @param string $attribute The attribute.
	 * @param array $options Row options.
	 */
	protected function horizontalGroup(&$fieldData, &$model, &$attribute, &$options) {
		
		$groupOptions = isset($options['groupOptions']) ? $options['groupOptions']: array(); // array('class' => 'form-group');
		self::addCssClass($groupOptions, 'form-group');
		
		if ($model->hasErrors($attribute))
			self::addCssClass($groupOptions, 'has-error');
		
		echo CHtml::openTag('div', $groupOptions);

		self::addCssClass($options['labelOptions'], 'col-sm-3 control-label');
		if (isset($options['label'])) {
			if (!empty($options['label'])) {
				echo CHtml::label($options['label'], CHtml::activeId($model, $attribute), $options['labelOptions']);
			} else {
				echo '<span class="col-sm-3"></span>';
			}
		} else {
			echo $this->labelEx($model, $attribute, $options['labelOptions']);
		}
		
		// TODO: is this good to be applied in vertical and inline?
		if(isset($options['wrapperHtmlOptions']) && !empty($options['wrapperHtmlOptions']))
			$wrapperHtmlOptions = $options['wrapperHtmlOptions'];
		else 
			$wrapperHtmlOptions = $options['wrapperHtmlOptions'] = array();
		$this->addCssClass($wrapperHtmlOptions, 'col-sm-9');
		echo CHtml::openTag('div', $wrapperHtmlOptions);

		if (!empty($options['prepend']) || !empty($options['append'])) {
			$this->renderAddOnBegin($options['prepend'], $options['append'], $options['prependOptions']);
		}

		if (is_array($fieldData)) {
			echo call_user_func_array($fieldData[0], $fieldData[1]);
		} else {
			echo $fieldData;
		}

		if (!empty($options['prepend']) || !empty($options['append'])) {
			$this->renderAddOnEnd($options['append'], $options['appendOptions']);
		}

		if ($this->showErrors && $options['errorOptions'] !== false) {
			echo $this->error($model, $attribute, $options['errorOptions'], $options['enableAjaxValidation'], $options['enableClientValidation']);
		}

		if (isset($options['hint'])) {
			self::addCssClass($options['hintOptions'], $this->hintCssClass);
			echo CHtml::tag($this->hintTag, $options['hintOptions'], $options['hint']);
		}

		echo '</div></div>'; // controls, form-group
	}

	/**
	 * Renders a vertical custom field group for a model attribute.
	 *
	 * @param array|string $fieldData Pre-rendered field as string or array of arguments for call_user_func_array() function.
	 * @param CModel $model The data model.
	 * @param string $attribute The attribute.
	 * @param array $options Row options.
	 * 
	 */
	protected function verticalGroup(&$fieldData, &$model, &$attribute, &$options) {
		
		$groupOptions = isset($options['groupOptions']) ? $options['groupOptions']: array();
		self::addCssClass($groupOptions, 'form-group');
		
		if ($model->hasErrors($attribute))
			self::addCssClass($groupOptions, 'has-error');
		
		echo CHtml::openTag('div', $groupOptions);
		
		self::addCssClass($options['labelOptions'], 'control-label');
		if (isset($options['label'])) {
			if (!empty($options['label'])) {
				echo CHtml::label($options['label'], CHtml::activeId($model, $attribute), $options['labelOptions']);
			}
		} else {
			echo $this->labelEx($model, $attribute, $options['labelOptions']);
		}
	
		if (!empty($options['prepend']) || !empty($options['append'])) {
			$this->renderAddOnBegin($options['prepend'], $options['append'], $options['prependOptions']);
		}
		
		if (is_array($fieldData)) {
			echo call_user_func_array($fieldData[0], $fieldData[1]);
		} else {
			echo $fieldData;
		}
		
		if (!empty($options['prepend']) || !empty($options['append'])) {
			$this->renderAddOnEnd($options['append'], $options['appendOptions']);
		}
		
		if ($this->showErrors && $options['errorOptions'] !== false) {
			echo $this->error($model, $attribute, $options['errorOptions'], $options['enableAjaxValidation'], $options['enableClientValidation']);
		}
	
		if (isset($options['hint'])) {
			self::addCssClass($options['hintOptions'], $this->hintCssClass);
			echo CHtml::tag($this->hintTag, $options['hintOptions'], $options['hint']);
		}
		
		echo '</div>';
	}

	/**
	 * Renders a inline custom field group for a model attribute.
	 *
	 * @param array|string $fieldData Pre-rendered field as string or array of arguments for call_user_func_array() function.
	 * @param CModel $model The data model.
	 * @param string $attribute The attribute.
	 * @param array $options Row options.
	 */
	protected function inlineGroup(&$fieldData, &$model, &$attribute, &$options) {
		
        echo '<div class="form-group">';

		if (!empty($options['prepend']) || !empty($options['append']))
			$this->renderAddOnBegin($options['prepend'], $options['append'], $options['prependOptions']);

		if (is_array($fieldData)) {
			echo call_user_func_array($fieldData[0], $fieldData[1]);
		} else {
			echo $fieldData;
		}

		if (!empty($options['prepend']) || !empty($options['append']))
			$this->renderAddOnEnd($options['append'], $options['appendOptions']);

        if ($this->showErrors && $options['errorOptions'] !== false) {
            echo $this->error($model, $attribute, $options['errorOptions'], $options['enableAjaxValidation'], $options['enableClientValidation']);
        }

        echo "</div>\r\n"; 
	}

	/**
	 * Renders add-on begin.
	 *
	 * @param string $prependText Prepended text.
	 * @param string $appendText Appended text.
	 * @param array $prependOptions Prepend options.
	 */
	protected function renderAddOnBegin($prependText, $appendText, $prependOptions) {
		
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
	protected function renderAddOnEnd($appendText, $appendOptions) {
		
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
	 * @param array $options
	 */
	protected function initOptions(&$options, $initData = false) {
		
		if (!isset($options['groupOptions']))
			$options['groupOptions'] = array();
		
		if (!isset($options['labelOptions']))
			$options['labelOptions'] = array();
		
		if (!isset($options['widgetOptions']))
			$options['widgetOptions'] = array();
		
		if (!isset($options['widgetOptions']['htmlOptions']))
			$options['widgetOptions']['htmlOptions'] = array();
		
		if($initData && !isset($options['widgetOptions']['data']))
			$options['widgetOptions']['data'] = array();
		
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
	protected static function addCssClass(&$htmlOptions, $class) {
		
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
