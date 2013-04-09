<?php
/**
 * TbHtml class file.
 * @author Antonio Ramirez <ramirez.cobos@gmail.com>
 * @author Christoffer Niska <christoffer.niska@gmail.com>
 * @copyright Copyright &copy; Christoffer Niska 2013-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 * @package bootstrap.helpers
 */

/**
 * Bootstrap HTML helper.
 */
class TbHtml extends CHtml
{
	// Element styles.
	const STYLE_PRIMARY = 'primary';
	const STYLE_INFO = 'info';
	const STYLE_SUCCESS = 'success';
	const STYLE_WARNING = 'warning';
	const STYLE_ERROR = 'error';
	const STYLE_DANGER = 'danger';
	const STYLE_IMPORTANT = 'important';
	const STYLE_INVERSE = 'inverse';
	const STYLE_LINK = 'link';

	// Element sizes.
	const SIZE_MINI = 'mini';
	const SIZE_SMALL = 'small';
	const SIZE_LARGE = 'large';

	// Navigation menu types.
	const NAV_TABS = 'tabs';
	const NAV_PILLS = 'pills';
	const NAV_LIST = 'list';

	// Position types.
	const POSITION_TOP = 'top';
	const POSITION_BOTTOM = 'bottom';

	// Alignments.
	const ALIGN_CENTER = 'centered';
	const ALIGN_RIGHT = 'right';

	// Progress bar types.
	const PROGRESS_STRIPED = 'striped';
	const PROGRESS_ACTIVE = 'active';

	// Tooltip placements
	const PLACEMENT_TOP = 'top';
	const PLACEMENT_BOTTOM = 'bottom';
	const PLACEMENT_LEFT = 'left';
	const PLACEMENT_RIGHT = 'right';

	// Tabs placements
	const TABS_TOP = 'top';
	const TABS_BELLOW = 'bellow';
	const TABS_LEFT = 'left';
	const TABS_RIGHT = 'right';


	// Tooltip triggers.
	const TRIGGER_CLICK = 'click';
	const TRIGGER_HOVER = 'hover';
	const TRIGGER_FOCUS = 'focus';
	const TRIGGER_MANUAL = 'manual';

	// Addon types.
	const ADDON_PREPEND = 'prepend';
	const ADDON_APPEND = 'append';

	// Default close text.
	const CLOSE_TEXT = '&times;';

	// Help types.
	const HELP_INLINE = 'inline';
	const HELP_BLOCK = 'block';

	// form types
	const FORM_INLINE = 'inline';
	const FORM_HORIZONTAL = 'horizontal';
	const FORM_VERTICAL = 'vertical';

	// field types
	const INPUT_URL = 'urlField';
	const INPUT_EMAIL = 'emailField';
	const INPUT_NUMBER = 'numberField';
	const INPUT_RANGE = 'rangeField';
	const INPUT_DATE = 'dateField';
	const INPUT_TEXT = 'textField';
	const INPUT_PASSWORD = 'passwordField';
	const INPUT_TEXTAREA = 'textArea';
	const INPUT_FILE = 'fileField';
	const INPUT_RADIOBUTTON = 'radioButton';
	const INPUT_CHECKBOX = 'checkBox';
	const INPUT_DROPDOWN = 'dropDownList';
	const INPUT_LISTBOX = 'listBox';
	const INPUT_CHECKBOXLIST = 'inlineCheckBoxList';
	const INPUT_RADIOBUTTONLIST = 'inlineRadioButtonList';

	// grid types
	const GRID_STRIPED = 'striped';
	const GRID_BORDERED = 'bordered';
	const GRID_CONDENSED = 'condensed';
	const GRID_HOVER = 'hover';

	// Scope constants.
	static $inputs = array(self::INPUT_CHECKBOX, self::INPUT_CHECKBOXLIST, self::INPUT_DATE,
		self::INPUT_DROPDOWN, self::INPUT_EMAIL, self::INPUT_FILE, self::INPUT_LISTBOX,
		self::INPUT_NUMBER, self::INPUT_PASSWORD, self::INPUT_RADIOBUTTON, self::INPUT_RANGE,
		self::INPUT_TEXT, self::INPUT_TEXTAREA, self::INPUT_URL, self::INPUT_RADIOBUTTONLIST);
	static $dataInputs = array(self::INPUT_CHECKBOXLIST, self::INPUT_DROPDOWN, self::INPUT_LISTBOX,
		self::INPUT_RADIOBUTTONLIST); // Which one requires data
	static $sizes = array(self::SIZE_LARGE, self::SIZE_SMALL, self::SIZE_MINI);
	static $textStyles = array(self::STYLE_ERROR, self::STYLE_INFO, self::STYLE_SUCCESS, self::STYLE_WARNING);
	static $buttonStyles = array(
		self::STYLE_PRIMARY, self::STYLE_INFO, self::STYLE_SUCCESS, self::STYLE_WARNING,
		self::STYLE_DANGER, self::STYLE_INVERSE, self::STYLE_LINK,
	);
	static $labelBadgeStyles = array(self::STYLE_SUCCESS, self::STYLE_WARNING, self::STYLE_IMPORTANT,
		self::STYLE_INFO, self::STYLE_INVERSE,
	);
	static $navStyles = array(self::NAV_TABS, self::NAV_PILLS, self::NAV_LIST);
	static $navbarStyles = array(self::STYLE_INVERSE);
	static $positions = array(self::POSITION_TOP, self::POSITION_BOTTOM);
	static $alignments = array(self::ALIGN_CENTER, self::ALIGN_RIGHT);
	static $alertStyles = array(self::STYLE_SUCCESS, self::STYLE_INFO, self::STYLE_WARNING, self::STYLE_ERROR);
	static $progressStyles = array(self::STYLE_INFO, self::STYLE_SUCCESS, self::STYLE_WARNING, self::STYLE_DANGER);
	static $placements = array(self::PLACEMENT_TOP, self::PLACEMENT_BOTTOM, self::PLACEMENT_LEFT, self::PLACEMENT_RIGHT);
	static $tabPlacements = array(self::TABS_TOP, self::TABS_BELLOW, self::TABS_LEFT, self::TABS_RIGHT);
	static $triggers = array(self::TRIGGER_CLICK, self::TRIGGER_HOVER, self::TRIGGER_FOCUS, self::TRIGGER_MANUAL);
	static $addons = array(self::ADDON_PREPEND, self::ADDON_APPEND);
	static $grids = array(self::GRID_BORDERED, self::GRID_CONDENSED, self::GRID_HOVER, self::GRID_STRIPED);

	static $errorMessageCss = 'error';

	private static $_counter = 0;

	//
	// BASE CSS
	// --------------------------------------------------

	// Typography
	// http://twitter.github.com/bootstrap/base-css.html#typography
	// --------------------------------------------------

	/**
	 * Generates a paragraph that stands out.
	 * @param string $text the lead text.
	 * @param array $htmlOptions additional HTML attributes.
	 * @return string the generated paragraph.
	 */
	public static function lead($text, $htmlOptions = array())
	{
		$htmlOptions = self::addClassName('lead', $htmlOptions);
		return parent::tag('p', $htmlOptions, $text);
	}

	/**
	 * Generates small text.
	 * @param string $text the text to style.
	 * @param array $htmlOptions additional HTML attributes.
	 * @return string the generated text.
	 */
	public static function small($text, $htmlOptions = array())
	{
		return parent::tag('small', $htmlOptions, $text);
	}

	/**
	 * Generates bold text.
	 * @param string $text the text to style.
	 * @param array $htmlOptions additional HTML attributes.
	 * @return string the generated text.
	 */
	public static function b($text, $htmlOptions = array())
	{
		return parent::tag('strong', $htmlOptions, $text);
	}

	/**
	 * Generates italic text.
	 * @param string $text the text to style.
	 * @param array $htmlOptions additional HTML attributes.
	 * @return string the generated text.
	 */
	public static function i($text, $htmlOptions = array())
	{
		return parent::tag('em', $htmlOptions, $text);
	}

	/**
	 * Generates an emphasized text block.
	 * @param string $text the text to emphasize.
	 * @param array $htmlOptions additional HTML attributes.
	 * @param string $tag the HTML tag.
	 * @return string the generated text block.
	 */
	public static function em($text, $htmlOptions = array(), $tag = 'p')
	{
		$style = self::popOption('style', $htmlOptions);
		if (self::popOption('muted', $htmlOptions, false))
			$htmlOptions = self::addClassName('muted', $htmlOptions);
		else if ($style && in_array($style, self::$textStyles))
			$htmlOptions = self::addClassName('text-' . $style, $htmlOptions);
		return parent::tag($tag, $htmlOptions, $text);
	}

	/**
	 * Generates a muted text block.
	 * @param string $text the text.
	 * @param array $htmlOptions additional HTML attributes.
	 * @param string $tag the HTML tag.
	 * @return string the generated text block.
	 */
	public static function muted($text, $htmlOptions = array(), $tag = 'p')
	{
		$htmlOptions = self::defaultOption('muted', true, $htmlOptions);
		return self::em($text, $htmlOptions, $tag);
	}

	/**
	 * Generates a muted span.
	 * @param string $text the text.
	 * @param array $htmlOptions additional HTML attributes.
	 * @param string $tag the HTML tag.
	 * @return string the generated span.
	 */
	public static function mutedSpan($text, $htmlOptions = array())
	{
		return self::muted($text, $htmlOptions, 'span');
	}

	/**
	 * Generates an abbreviation with a help text.
	 * @param string $text the abbreviation.
	 * @param string $word the word the abbreviation is for.
	 * @param array $htmlOptions additional HTML attributes.
	 * @return string the generated abbreviation.
	 */
	public static function abbr($text, $word, $htmlOptions = array())
	{
		if (self::popOption('smaller', $htmlOptions, false))
			$htmlOptions = self::addClassName('initialism', $htmlOptions);
		$htmlOptions = self::defaultOption('title', $word, $htmlOptions);
		return parent::tag('abbr', $htmlOptions, $text);
	}

	/**
	 * Generates an address block.
	 * @param string $text the address text.
	 * @param array $htmlOptions additional HTML attributes.
	 * @return string the generated block.
	 */
	public static function address($text, $htmlOptions = array())
	{
		return parent::tag('address', $htmlOptions, $text);
	}

	/**
	 * Generates a quote.
	 * @param string $text the quoted text.
	 * @param array $htmlOptions additional HTML attributes.
	 * @return string the generated quote.
	 */
	public static function quote($text, $htmlOptions = array())
	{
		return parent::tag('blockquote', $htmlOptions, $text);
	}

	/**
	 * Generates a help paragraph.
	 * @param string $text the help text.
	 * @param array $htmlOptions additional HTML attributes.
	 * @return string the generated paragraph.
	 */
	public static function help($text, $htmlOptions = array())
	{
		$htmlOptions = self::addClassName('help-block', $htmlOptions);
		return parent::tag('p', $htmlOptions, $text);
	}

	// Code
	// http://twitter.github.com/bootstrap/base-css.html#code
	// --------------------------------------------------

	/**
	 * Generates a code snippet.
	 * @param string $code the code.
	 * @param array $htmlOptions additional HTML attributes.
	 * @return string the generated snippet.
	 */
	public static function snippet($code, $htmlOptions = array())
	{
		return parent::tag('code', $htmlOptions, $code);
	}

	/**
	 * Generates a code block.
	 * @param string $code the code.
	 * @param array $htmlOptions additional HTML attributes.
	 * @return string the generated block.
	 */
	public static function code($code, $htmlOptions = array())
	{
		return parent::tag('pre', $htmlOptions, $code);
	}

	// Tables
	// http://twitter.github.com/bootstrap/base-css.html#forms
	// --------------------------------------------------

	// todo: create table methods here.

	// Forms
	// http://twitter.github.com/bootstrap/base-css.html#tables
	// --------------------------------------------------

	/**
	 * Generates a label tag.
	 * @param string $label label text. Note, you should HTML-encode the text if needed.
	 * @param string $for the ID of the HTML element that this label is associated with.
	 * If this is false, the 'for' attribute for the label tag will not be rendered.
	 * @param array $htmlOptions additional HTML attributes.
	 * The following HTML option is recognized:
	 * <ul>
	 * <li>required: if this is set and is true, the label will be styled
	 * with CSS class 'required' (customizable with CHtml::$requiredCss),
	 * and be decorated with {@link CHtml::beforeRequiredLabel} and
	 * {@link CHtml::afterRequiredLabel}.</li>
	 * </ul>
	 * @return string the generated label tag
	 */
	public static function label($label, $for, $htmlOptions = array())
	{
		$htmlOptions['for'] = $for;
		$formType = self::popOption('formType', $htmlOptions);
		if ($formType == TbHtml::FORM_HORIZONTAL)
			$htmlOptions = self::addClassName('control-label', $htmlOptions);
		return self::tag('label', $htmlOptions, $label);
	}

	/**
	 * Generates a text field input.
	 * @param string $name the input name
	 * @param string $value the input value
	 * @param array $htmlOptions additional HTML attributes. Besides normal HTML attributes, a few special
	 * attributes are also recognized (see {@link getAddOnClasses} {@link getAppend} {@link getPrepend} {@link clientChange} and {@link tag} for more details.)
	 * @return string the generated input field
	 * @see clientChange
	 * @see inputField
	 */
	public static function textField($name, $value = '', $htmlOptions = array())
	{
		parent::clientChange('change', $htmlOptions);
		return self::inputField('text', $name, $value, $htmlOptions);
	}

	/**
	 * Generates a password field input.
	 * @param string $name the input name
	 * @param string $value the input value
	 * @param array $htmlOptions additional HTML attributes. Besides normal HTML attributes, a few special
	 * attributes are also recognized (see {@link clientChange} and {@link tag} for more details.)
	 * @return string the generated input field
	 * @see clientChange
	 * @see inputField
	 */
	public static function passwordField($name, $value = '', $htmlOptions = array())
	{
		parent::clientChange('change', $htmlOptions);
		return self::inputField('password', $name, $value, $htmlOptions);
	}

	/**
	 * Generates a text area input.
	 * @param string $name the input name
	 * @param string $value the input value
	 * @param array $htmlOptions additional HTML attributes. Besides normal HTML attributes, a few special
	 * attributes are also recognized (see {@link clientChange} and {@link tag} for more details.)
	 * @return string the generated text area
	 * @see clientChange
	 * @see inputField
	 */
	public static function textArea($name, $value = '', $htmlOptions = array())
	{
		$help = self::getHelp($htmlOptions);

		ob_start();
		echo parent::textArea($name, $value, $htmlOptions);
		echo $help;
		return ob_get_clean();
	}

	/**
	 * Generates a radio button.
	 * @param string $name the input name
	 * @param boolean $checked whether the radio button is checked
	 * @param array $htmlOptions additional HTML attributes. Besides normal HTML attributes, a few special
	 * attributes are also recognized (see {@link clientChange} {@link getOption} and {@link tag} for more details.)
	 * Since version 1.1.2, a special option named 'uncheckValue' is available that can be used to specify
	 * the value returned when the radio button is not checked. When set, a hidden field is rendered so that
	 * when the radio button is not checked, we can still obtain the posted uncheck value.
	 * If 'uncheckValue' is not set or set to NULL, the hidden field will not be rendered.
	 * The following special options are recognized:
	 * <ul>
	 * <li>labelOptions: array, specifies the additional HTML attributes to be rendered
	 * for every label tag in the list.</li>
	 * </ul>
	 * @return string the generated radio button
	 * @see clientChange
	 * @see inputField
	 */
	public static function radioButton($name, $checked = false, $htmlOptions = array())
	{
		$label = self::getOption('label', $htmlOptions);
		$labelOptions = self::popOption('labelOptions', $htmlOptions, array());
		$radioButton = parent::radioButton($name, $checked, $htmlOptions);

		if ($label)
		{
			$labelOptions = self::addClassName('radio', $labelOptions);

			ob_start();
			echo '<label ' . parent::renderAttributes($labelOptions) . '>';
			echo $radioButton;
			echo $label;
			echo '</label>';
			return ob_get_clean();
		}

		return $radioButton;
	}

	/**
	 * Generates a check box.
	 * @param string $name the input name
	 * @param boolean $checked whether the check box is checked
	 * @param array $htmlOptions additional HTML attributes. Besides normal HTML attributes, a few special
	 * attributes are also recognized (see {@link clientChange} and {@link tag} for more details.)
	 * Since version 1.1.2, a special option named 'uncheckValue' is available that can be used to specify
	 * the value returned when the checkbox is not checked. When set, a hidden field is rendered so that
	 * when the checkbox is not checked, we can still obtain the posted uncheck value.
	 * If 'uncheckValue' is not set or set to NULL, the hidden field will not be rendered.
	 * @return string the generated check box
	 * @see clientChange
	 * @see inputField
	 */
	public static function checkBox($name, $checked = false, $htmlOptions = array())
	{
		$label = self::popOption('label', $htmlOptions, '');
		$labelOptions = self::popOption('labelOptions', $htmlOptions, array());
		$checkBox = parent::checkBox($name, $checked, $htmlOptions);

		if ($label)
		{
			$labelOptions = self::addClassName('checkbox', $labelOptions);

			ob_start();
			echo '<label ' . parent::renderAttributes($labelOptions) . '>';
			echo $checkBox;
			echo $label;
			echo '</label>';
			return ob_get_clean();
		}

		return $checkBox;
	}

	/**
	 * Generates a drop down list.
	 * @param string $name the input name
	 * @param string $select the selected value
	 * @param array $data data for generating the list options (value=>display).
	 * You may use {@link listData} to generate this data.
	 * Please refer to {@link listOptions} on how this data is used to generate the list options.
	 * Note, the values and labels will be automatically HTML-encoded by this method.
	 * @param array $htmlOptions additional HTML attributes. Besides normal HTML attributes, a few special
	 * attributes are recognized. See {@link clientChange} and {@link tag} for more details.
	 * In addition, the following options are also supported specifically for dropdown list:
	 * <ul>
	 * <li>encode: boolean, specifies whether to encode the values. Defaults to true.</li>
	 * <li>prompt: string, specifies the prompt text shown as the first list option. Its value is empty. Note, the prompt text will NOT be HTML-encoded.</li>
	 * <li>empty: string, specifies the text corresponding to empty selection. Its value is empty.
	 * The 'empty' option can also be an array of value-label pairs.
	 * Each pair will be used to render a list option at the beginning. Note, the text label will NOT be HTML-encoded.</li>
	 * <li>options: array, specifies additional attributes for each OPTION tag.
	 *     The array keys must be the option values, and the array values are the extra
	 *     OPTION tag attributes in the name-value pairs. For example,
	 * <pre>
	 *     array(
	 *         'value1'=>array('disabled'=>true, 'label'=>'value 1'),
	 *         'value2'=>array('label'=>'value 2'),
	 *     );
	 * </pre>
	 * </li>
	 * </ul>
	 * @return string the generated drop down list
	 * @see clientChange
	 * @see inputField
	 * @see listData
	 */
	public static function dropDownList($name, $select, $data, $htmlOptions = array())
	{
		$help = self::getHelp($htmlOptions);
		ob_start();
		echo parent::dropDownList($name, $select, $data, $htmlOptions);
		echo $help;
		return ob_get_clean();
	}

	/**
	 * Generates a list box.
	 * @param string $name the input name
	 * @param mixed $select the selected value(s). This can be either a string for single selection or an array for multiple selections.
	 * @param array $data data for generating the list options (value=>display)
	 * You may use {@link listData} to generate this data.
	 * Please refer to {@link listOptions} on how this data is used to generate the list options.
	 * Note, the values and labels will be automatically HTML-encoded by this method.
	 * @param array $htmlOptions additional HTML attributes. Besides normal HTML attributes, a few special
	 * attributes are also recognized. See {@link clientChange} and {@link tag} for more details.
	 * In addition, the following options are also supported specifically for list box:
	 * <ul>
	 * <li>encode: boolean, specifies whether to encode the values. Defaults to true.</li>
	 * <li>prompt: string, specifies the prompt text shown as the first list option. Its value is empty. Note, the prompt text will NOT be HTML-encoded.</li>
	 * <li>empty: string, specifies the text corresponding to empty selection. Its value is empty.
	 * The 'empty' option can also be an array of value-label pairs.
	 * Each pair will be used to render a list option at the beginning. Note, the text label will NOT be HTML-encoded.</li>
	 * <li>options: array, specifies additional attributes for each OPTION tag.
	 *     The array keys must be the option values, and the array values are the extra
	 *     OPTION tag attributes in the name-value pairs. For example,
	 * <pre>
	 *     array(
	 *         'value1'=>array('disabled'=>true, 'label'=>'value 1'),
	 *         'value2'=>array('label'=>'value 2'),
	 *     );
	 * </pre>
	 * </li>
	 * </ul>
	 * @return string the generated list box
	 * @see clientChange
	 * @see inputField
	 * @see listData
	 */
	public static function listBox($name, $select, $data, $htmlOptions = array())
	{
		$help = self::getHelp($htmlOptions);
		ob_start();
		echo parent::listBox($name, $select, $data, $htmlOptions);
		echo $help;
		return ob_get_clean();
	}

	/**
	 * Generates an inline radio button list.
	 * A radio button list is like a {@link checkBoxList check box list}, except that
	 * it only allows single selection.
	 * @param string $name name of the radio button list. You can use this name to retrieve
	 * the selected value(s) once the form is submitted.
	 * @param string $select selection of the radio buttons.
	 * @param array $data value-label pairs used to generate the radio button list.
	 * Note, the values will be automatically HTML-encoded, while the labels will not.
	 * @param array $htmlOptions additional HTML options. The options will be applied to
	 * each radio button input. The following special options are recognized:
	 * <ul>
	 * <li>labelOptions: array, specifies the additional HTML attributes to be rendered
	 * for every label tag in the list.</li>
	 * <li>container: string, specifies the radio buttons enclosing tag. Defaults to 'span'.
	 * If the value is an empty string, no enclosing tag will be generated</li>
	 * </ul>
	 * @return string the generated radio button list
	 */
	public static function inlineRadioButtonList($name, $select, $data, $htmlOptions = array())
	{
		$separator = " ";
		$container = self::popOption('container', $htmlOptions);

		$items = array();
		$baseID = self::getIdByName($name);
		$id = 0;
		foreach ($data as $value => $label)
		{
			$checked = !strcmp($value, $select);
			$htmlOptions['label'] = $label;
			$htmlOptions['labelOptions'] = array('class' => 'inline');
			$htmlOptions['value'] = $value;
			$htmlOptions['id'] = $baseID . '_' . $id++;
			$items[] = self::radioButton($name, $checked, $htmlOptions);
		}

		return empty($container)
			? implode($separator, $items)
			: self::tag($container, array('id' => $baseID), implode($separator, $items));
	}

	/**
	 * Generates a inline check box list.
	 * A check box list allows multiple selection, like {@link listBox}.
	 * As a result, the corresponding POST value is an array.
	 * @param string $name name of the check box list. You can use this name to retrieve
	 * the selected value(s) once the form is submitted.
	 * @param mixed $select selection of the check boxes. This can be either a string
	 * for single selection or an array for multiple selections.
	 * @param array $data value-label pairs used to generate the check box list.
	 * Note, the values will be automatically HTML-encoded, while the labels will not.
	 * @param array $htmlOptions additional HTML options. The options will be applied to
	 * each checkbox input. The following special options are recognized:
	 * <ul>
	 * <li>checkAll: string, specifies the label for the "check all" checkbox.
	 * If this option is specified, a 'check all' checkbox will be displayed. Clicking on
	 * this checkbox will cause all checkboxes checked or unchecked.</li>
	 * <li>checkAllLast: boolean, specifies whether the 'check all' checkbox should be
	 * displayed at the end of the checkbox list. If this option is not set (default)
	 * or is false, the 'check all' checkbox will be displayed at the beginning of
	 * the checkbox list.</li>
	 * <li>labelOptions: array, specifies the additional HTML attributes to be rendered
	 * for every label tag in the list.</li>
	 * <li>container: string, specifies the checkboxes enclosing tag. Defaults to 'span'.
	 * If the value is an empty string, no enclosing tag will be generated</li>
	 * </ul>
	 * @return string the generated check box list
	 */
	public static function inlineCheckBoxList($name, $select, $data, $htmlOptions = array())
	{
		$separator = " ";
		$container = self::popOption('container', $htmlOptions);

		if (substr($name, -2) !== '[]')
			$name .= '[]';

		$checkAllLabel = self::popOption('checkAll', $htmlOptions);
		$checkAllLast = self::popOption('checkAllLast', $htmlOptions);

		$labelOptions = self::popOption('labelOptions', $htmlOptions, array());

		$items = array();
		$baseID = self::getIdByName($name);
		$id = 0;
		$checkAll = true;

		foreach ($data as $value => $label)
		{
			$checked = !is_array($select) && !strcmp($value, $select) || is_array($select) && in_array($value, $select);
			$checkAll = $checkAll && $checked;
			$htmlOptions['label'] = $label;
			$htmlOptions['labelOptions'] = self::addClassName('inline', $labelOptions);
			$htmlOptions['value'] = $value;
			$htmlOptions['id'] = $baseID . '_' . $id++;
			$items[] = self::checkBox($name, $checked, $htmlOptions);
		}

		// todo: refactor to declarative approach.
		if (isset($checkAllLabel))
		{
			$htmlOptions['label'] = $checkAllLabel;
			$htmlOptions['labelOptions'] = self::addClassName('inline', $labelOptions);
			$htmlOptions['value'] = 1;
			$htmlOptions['id'] = $id = $baseID . '_all';
			$option = self::checkBox($id, $checkAll, $htmlOptions);
			$item = $option;
			// todo: $checkAllLast might not be defined here.
			if ($checkAllLast)
				$items[] = $item;
			else
				array_unshift($items, $item);
			$name = strtr($name, array('[' => '\\[', ']' => '\\]'));
			$js = <<<EOD
$('#$id').click(function() {
	$("input[name='$name']").prop('checked', this.checked);
});
$("input[name='$name']").click(function() {
	$('#$id').prop('checked', !$("input[name='$name']:not(:checked)").length);
});
$('#$id').prop('checked', !$("input[name='$name']:not(:checked)").length);
EOD;
			/* @var $cs CClientScript */
			$cs = Yii::app()->getClientScript();
			$cs->registerCoreScript('jquery');
			$cs->registerScript($id, $js);
		}

		return empty($container)
			? implode($separator, $items)
			: self::tag($container, array('id' => $baseID), implode($separator, $items));

	}

	/**
	 * Generates an input HTML tag.
	 * This method generates an input HTML tag based on the given input name and value.
	 * @param string $type the input type (e.g. 'text', 'radio')
	 * @param string $name the input name
	 * @param string $value the input value
	 * @param array $htmlOptions additional HTML attributes for the HTML tag (see {@link tag}). The following special
	 * attributes are supported:
	 * <ul>
	 *    <li>append: string, append addon to the input types: text, password, date</li>
	 *    <li>prepend: string, prepend addon to the input types: text, password, date</li>
	 *    <li>help: array, see {@link getHelp}
	 * </ul>
	 * @return string the generated input tag
	 */
	protected static function inputField($type, $name, $value, $htmlOptions)
	{
		$inputOptions = self::removeOptions($htmlOptions, array('append', 'prepend'));
		$addOnClasses = self::getAddOnClasses($htmlOptions);
		$help = self::getHelp($htmlOptions);

		ob_start();
		if (!empty($addOnClasses))
			echo '<div class="' . $addOnClasses . '">';

		echo self::getPrepend($htmlOptions);
		echo parent::inputField($type, $name, $value, $inputOptions);
		echo self::getAppend($htmlOptions);

		if (!empty($addOnClasses))
			echo '</div>';

		echo $help;

		return ob_get_clean();
	}

	// Active Fields

	/**
	 * Generates a label tag for a model attribute.
	 * The label text is the attribute label and the label is associated with
	 * the input for the attribute (see {@link CModel::getAttributeLabel}.
	 * If the attribute has input error, the label's CSS class will be appended with {@link errorCss}.
	 * @param CModel $model the data model
	 * @param string $attribute the attribute
	 * @param array $htmlOptions additional HTML attributes. The following special options are recognized:
	 * <ul>
	 * <li>required: if this is set and is true, the label will be styled
	 * with CSS class 'required' (customizable with CHtml::$requiredCss),
	 * and be decorated with {@link CHtml::beforeRequiredLabel} and
	 * {@link CHtml::afterRequiredLabel}.</li>
	 * <li>label: this specifies the label to be displayed. If this is not set,
	 * {@link CModel::getAttributeLabel} will be called to get the label for display.
	 * If the label is specified as false, no label will be rendered.</li>
	 * </ul>
	 * @return string the generated label tag
	 */
	public static function activeLabel($model, $attribute, $htmlOptions = array())
	{
		$for = self::popOption('for', $htmlOptions, parent::getIdByName(parent::resolveName($model, $attribute)));
		$label = self::popOption('label', $htmlOptions, $model->getAttributeLabel($attribute));

		if ($model->hasErrors($attribute))
			self::addErrorCss($htmlOptions);

		return self::label($label, $for, $htmlOptions);
	}

	/**
	 * Generates a label tag for a model attribute.
	 * This is an enhanced version of {@link activeLabel}. It will render additional
	 * CSS class and mark when the attribute is required.
	 * In particular, it calls {@link CModel::isAttributeRequired} to determine
	 * if the attribute is required.
	 * If so, it will add a CSS class {@link CHtml::requiredCss} to the label,
	 * and decorate the label with {@link CHtml::beforeRequiredLabel} and
	 * {@link CHtml::afterRequiredLabel}.
	 * @param CModel $model the data model
	 * @param string $attribute the attribute
	 * @param array $htmlOptions additional HTML attributes.
	 * @return string the generated label tag
	 */
	public static function activeLabelEx($model, $attribute, $htmlOptions = array())
	{
		$realAttribute = $attribute;
		self::resolveName($model, $attribute); // strip off square brackets if any
		$htmlOptions['required'] = $model->isAttributeRequired($attribute);
		return self::activeLabel($model, $realAttribute, $htmlOptions);
	}

	/**
	 * Generates a text field input for a model attribute.
	 * If the attribute has input error, the input field's CSS class will
	 * be appended with {@link errorCss}.
	 * @param CModel $model the data model
	 * @param string $attribute the attribute
	 * @param array $htmlOptions additional HTML attributes. Besides normal HTML attributes, a few special
	 * attributes are also recognized (see {@link clientChange} and {@link tag} for more details.)
	 * @return string the generated input field
	 * @see clientChange
	 * @see activeInputField
	 */
	public static function activeTextField($model, $attribute, $htmlOptions = array())
	{
		parent::resolveNameID($model, $attribute, $htmlOptions);
		parent::clientChange('change', $htmlOptions);
		return self::activeInputField('text', $model, $attribute, $htmlOptions);
	}

	/**
	 * Generates a url field input for a model attribute.
	 * If the attribute has input error, the input field's CSS class will
	 * be appended with {@link errorCss}.
	 * @param CModel $model the data model
	 * @param string $attribute the attribute
	 * @param array $htmlOptions additional HTML attributes. Besides normal HTML attributes, a few special
	 * attributes are also recognized (see {@link clientChange} and {@link tag} for more details.)
	 * @return string the generated input field
	 * @see clientChange
	 * @see activeInputField
	 * @since 1.1.11
	 */
	public static function activeUrlField($model, $attribute, $htmlOptions = array())
	{
		parent::resolveNameID($model, $attribute, $htmlOptions);
		parent::clientChange('change', $htmlOptions);
		return self::activeInputField('url', $model, $attribute, $htmlOptions);
	}

	/**
	 * Generates an email field input for a model attribute.
	 * If the attribute has input error, the input field's CSS class will
	 * be appended with {@link errorCss}.
	 * @param CModel $model the data model
	 * @param string $attribute the attribute
	 * @param array $htmlOptions additional HTML attributes. Besides normal HTML attributes, a few special
	 * attributes are also recognized (see {@link clientChange} and {@link tag} for more details.)
	 * @return string the generated input field
	 * @see clientChange
	 * @see activeInputField
	 * @since 1.1.11
	 */
	public static function activeEmailField($model, $attribute, $htmlOptions = array())
	{
		parent::resolveNameID($model, $attribute, $htmlOptions);
		parent::clientChange('change', $htmlOptions);
		return self::activeInputField('email', $model, $attribute, $htmlOptions);
	}

	/**
	 * Generates a number field input for a model attribute.
	 * If the attribute has input error, the input field's CSS class will
	 * be appended with {@link errorCss}.
	 * @param CModel $model the data model
	 * @param string $attribute the attribute
	 * @param array $htmlOptions additional HTML attributes. Besides normal HTML attributes, a few special
	 * attributes are also recognized (see {@link clientChange} and {@link tag} for more details.)
	 * @return string the generated input field
	 * @see clientChange
	 * @see activeInputField
	 * @since 1.1.11
	 */
	public static function activeNumberField($model, $attribute, $htmlOptions = array())
	{
		parent::resolveNameID($model, $attribute, $htmlOptions);
		parent::clientChange('change', $htmlOptions);
		return self::activeInputField('number', $model, $attribute, $htmlOptions);
	}

	/**
	 * Generates a range field input for a model attribute.
	 * If the attribute has input error, the input field's CSS class will
	 * be appended with {@link errorCss}.
	 * @param CModel $model the data model
	 * @param string $attribute the attribute
	 * @param array $htmlOptions additional HTML attributes. Besides normal HTML attributes, a few special
	 * attributes are also recognized (see {@link clientChange} and {@link tag} for more details.)
	 * @return string the generated input field
	 * @see clientChange
	 * @see activeInputField
	 * @since 1.1.11
	 */
	public static function activeRangeField($model, $attribute, $htmlOptions = array())
	{
		parent::resolveNameID($model, $attribute, $htmlOptions);
		parent::clientChange('change', $htmlOptions);
		return self::activeInputField('range', $model, $attribute, $htmlOptions);
	}

	/**
	 * Generates a date field input for a model attribute.
	 * If the attribute has input error, the input field's CSS class will
	 * be appended with {@link errorCss}.
	 * @param CModel $model the data model
	 * @param string $attribute the attribute
	 * @param array $htmlOptions additional HTML attributes. Besides normal HTML attributes, a few special
	 * attributes are also recognized (see {@link clientChange} and {@link tag} for more details.)
	 * @return string the generated input field
	 * @see clientChange
	 * @see activeInputField
	 * @since 1.1.11
	 */
	public static function activeDateField($model, $attribute, $htmlOptions = array())
	{
		parent::resolveNameID($model, $attribute, $htmlOptions);
		parent::clientChange('change', $htmlOptions);
		return self::activeInputField('date', $model, $attribute, $htmlOptions);
	}

	/**
	 * Generates a password field input for a model attribute.
	 * If the attribute has input error, the input field's CSS class will
	 * be appended with {@link errorCss}.
	 * @param CModel $model the data model
	 * @param string $attribute the attribute
	 * @param array $htmlOptions additional HTML attributes. Besides normal HTML attributes, a few special
	 * attributes are also recognized (see {@link clientChange} and {@link tag} for more details.)
	 * @return string the generated input field
	 * @see clientChange
	 * @see activeInputField
	 */
	public static function activePasswordField($model, $attribute, $htmlOptions = array())
	{
		parent::resolveNameID($model, $attribute, $htmlOptions);
		parent::clientChange('change', $htmlOptions);
		return self::activeInputField('password', $model, $attribute, $htmlOptions);
	}

	/**
	 * Generates a text area input for a model attribute.
	 * If the attribute has input error, the input field's CSS class will
	 * be appended with {@link errorCss}.
	 * @param CModel $model the data model
	 * @param string $attribute the attribute
	 * @param array $htmlOptions additional HTML attributes. Besides normal HTML attributes, a few special
	 * attributes are also recognized (see {@link clientChange} and {@link tag} for more details.)
	 * @return string the generated text area
	 * @see clientChange
	 */
	public static function activeTextArea($model, $attribute, $htmlOptions = array())
	{
		parent::resolveNameID($model, $attribute, $htmlOptions);
		parent::clientChange('change', $htmlOptions);
		if ($model->hasErrors($attribute))
			self::addErrorCss($htmlOptions);

		$text = self::popOption('value', $htmlOptions, self::resolveValue($model, $attribute));
		$help = self::getHelp($htmlOptions);

		ob_start();
		echo self::tag('textarea', $htmlOptions, isset($htmlOptions['encode']) && !$htmlOptions['encode'] ? $text : self::encode($text));
		echo $help;
		return ob_get_clean();
	}

	/**
	 * Generates a check box for a model attribute.
	 * The attribute is assumed to take either true or false value.
	 * If the attribute has input error, the input field's CSS class will
	 * be appended with {@link errorCss}.
	 * @param CModel $model the data model
	 * @param string $attribute the attribute
	 * @param array $htmlOptions additional HTML attributes. Besides normal HTML attributes, a few special
	 * attributes are also recognized (see {@link clientChange} and {@link tag} for more details.)
	 * A special option named 'uncheckValue' is available that can be used to specify
	 * the value returned when the checkbox is not checked. By default, this value is '0'.
	 * Internally, a hidden field is rendered so that when the checkbox is not checked,
	 * we can still obtain the posted uncheck value.
	 * If 'uncheckValue' is set as NULL, the hidden field will not be rendered.
	 * @return string the generated check box
	 * @see clientChange
	 * @see activeInputField
	 */
	public static function activeCheckBox($model, $attribute, $htmlOptions = array())
	{
		/* todo: is there another way to extract parents hidden input? */
		self::resolveNameID($model, $attribute, $htmlOptions);

		$htmlOptions = self::defaultOption('value', 1, $htmlOptions);

		if (!isset($htmlOptions['checked']) && self::resolveValue($model, $attribute) == $htmlOptions['value'])
			$htmlOptions['checked'] = 'checked';
		self::clientChange('click', $htmlOptions);

		$unCheck = self::popOption('unCheckValue', $htmlOptions, '0');

		$hiddenOptions = isset($htmlOptions['id']) ? array('id' => self::ID_PREFIX . $htmlOptions['id']) : array('id' => false);
		$hidden = $unCheck !== null ? self::hiddenField($htmlOptions['name'], $unCheck, $hiddenOptions) : '';

		$name = parent::resolveName($model, $attribute);
		$htmlOptions = self::defaultOption('label', $model->getAttributeLabel($attribute), $htmlOptions);

		/* todo: checkbox and radio have different label layout. Test whether this solution works */
		return $hidden . self::checkBox($name, $unCheck, $htmlOptions);
	}

	/**
	 * Generates a radio button for a model attribute.
	 * If the attribute has input error, the input field's CSS class will
	 * be appended with {@link errorCss}.
	 * @param CModel $model the data model
	 * @param string $attribute the attribute
	 * @param array $htmlOptions additional HTML attributes. Besides normal HTML attributes, a few special
	 * attributes are also recognized (see {@link clientChange} and {@link tag} for more details.)
	 * A special option named 'uncheckValue' is available that can be used to specify
	 * the value returned when the radio button is not checked. By default, this value is '0'.
	 * Internally, a hidden field is rendered so that when the radio button is not checked,
	 * we can still obtain the posted uncheck value.
	 * If 'uncheckValue' is set as NULL, the hidden field will not be rendered.
	 * @return string the generated radio button
	 * @see clientChange
	 * @see activeInputField
	 */
	public static function activeRadioButton($model, $attribute, $htmlOptions = array())
	{
		self::resolveNameID($model, $attribute, $htmlOptions);

		$htmlOptions = self::defaultOption('value', 1, $htmlOptions);

		if (!isset($htmlOptions['checked']) && self::resolveValue($model, $attribute) == $htmlOptions['value'])
			$htmlOptions['checked'] = 'checked';

		self::clientChange('click', $htmlOptions);

		$unCheck = self::popOption('uncheckValue', $htmlOptions, '0');

		$hiddenOptions = isset($htmlOptions['id']) ? array('id' => self::ID_PREFIX . $htmlOptions['id']) : array('id' => false);
		$hidden = $unCheck !== null ? self::hiddenField($htmlOptions['name'], $unCheck, $hiddenOptions) : '';

		$name = parent::resolveName($model, $attribute);
		$htmlOptions = self::defaultOption('label', $model->getAttributeLabel($attribute), $htmlOptions);

		/* todo: checkbox and radio have different label layout. Test whether this solution works */
		// add a hidden field so that if the radio button is not selected, it still submits a value
		return $hidden . self::radioButton($name, $unCheck, $htmlOptions);
	}

	/**
	 * Generates a drop down list for a model attribute.
	 * If the attribute has input error, the input field's CSS class will
	 * be appended with {@link errorCss}.
	 * @param CModel $model the data model
	 * @param string $attribute the attribute
	 * @param array $data data for generating the list options (value=>display)
	 * You may use {@link listData} to generate this data.
	 * Please refer to {@link listOptions} on how this data is used to generate the list options.
	 * Note, the values and labels will be automatically HTML-encoded by this method.
	 * @param array $htmlOptions additional HTML attributes. Besides normal HTML attributes, a few special
	 * attributes are recognized. See {@link clientChange} and {@link tag} for more details.
	 * In addition, the following options are also supported:
	 * <ul>
	 * <li>encode: boolean, specifies whether to encode the values. Defaults to true.</li>
	 * <li>prompt: string, specifies the prompt text shown as the first list option. Its value is empty.  Note, the prompt text will NOT be HTML-encoded.</li>
	 * <li>empty: string, specifies the text corresponding to empty selection. Its value is empty.
	 * The 'empty' option can also be an array of value-label pairs.
	 * Each pair will be used to render a list option at the beginning. Note, the text label will NOT be HTML-encoded.</li>
	 * <li>options: array, specifies additional attributes for each OPTION tag.
	 *     The array keys must be the option values, and the array values are the extra
	 *     OPTION tag attributes in the name-value pairs. For example,
	 * <pre>
	 *     array(
	 *         'value1'=>array('disabled'=>true, 'label'=>'value 1'),
	 *         'value2'=>array('label'=>'value 2'),
	 *     );
	 * </pre>
	 * </li>
	 * </ul>
	 * @return string the generated drop down list
	 * @see clientChange
	 * @see listData
	 */
	public static function activeDropDownList($model, $attribute, $data, $htmlOptions = array())
	{
		self::resolveNameID($model, $attribute, $htmlOptions);
		$selection = self::resolveValue($model, $attribute);
		$options = "\n" . self::listOptions($selection, $data, $htmlOptions);
		self::clientChange('change', $htmlOptions);
		if ($model->hasErrors($attribute))
			self::addErrorCss($htmlOptions);
		if (isset($htmlOptions['multiple']))
		{
			if (substr($htmlOptions['name'], -2) !== '[]')
				$htmlOptions['name'] .= '[]';
		}
		$help = self::getHelp($htmlOptions);
		ob_start();
		echo self::tag('select', $htmlOptions, $options);
		echo $help;
		return ob_get_clean();
	}

	/**
	 * Generates a list box for a model attribute.
	 * The model attribute value is used as the selection.
	 * If the attribute has input error, the input field's CSS class will
	 * be appended with {@link errorCss}.
	 * @param CModel $model the data model
	 * @param string $attribute the attribute
	 * @param array $data data for generating the list options (value=>display)
	 * You may use {@link listData} to generate this data.
	 * Please refer to {@link listOptions} on how this data is used to generate the list options.
	 * Note, the values and labels will be automatically HTML-encoded by this method.
	 * @param array $htmlOptions additional HTML attributes. Besides normal HTML attributes, a few special
	 * attributes are recognized. See {@link clientChange} and {@link tag} for more details.
	 * In addition, the following options are also supported:
	 * <ul>
	 * <li>encode: boolean, specifies whether to encode the values. Defaults to true.</li>
	 * <li>prompt: string, specifies the prompt text shown as the first list option. Its value is empty. Note, the prompt text will NOT be HTML-encoded.</li>
	 * <li>empty: string, specifies the text corresponding to empty selection. Its value is empty.
	 * The 'empty' option can also be an array of value-label pairs.
	 * Each pair will be used to render a list option at the beginning. Note, the text label will NOT be HTML-encoded.</li>
	 * <li>options: array, specifies additional attributes for each OPTION tag.
	 *     The array keys must be the option values, and the array values are the extra
	 *     OPTION tag attributes in the name-value pairs. For example,
	 * <pre>
	 *     array(
	 *         'value1'=>array('disabled'=>true, 'label'=>'value 1'),
	 *         'value2'=>array('label'=>'value 2'),
	 *     );
	 * </pre>
	 * </li>
	 * </ul>
	 * @return string the generated list box
	 * @see clientChange
	 * @see listData
	 */
	public static function activeListBox($model, $attribute, $data, $htmlOptions = array())
	{
		$htmlOptions = self::defaultOption('size', 4, $htmlOptions);
		return self::activeDropDownList($model, $attribute, $data, $htmlOptions);
	}

	/**
	 * Generates a file input for a model attribute.
	 * Note, you have to set the enclosing form's 'enctype' attribute to be 'multipart/form-data'.
	 * After the form is submitted, the uploaded file information can be obtained via $_FILES (see
	 * PHP documentation).
	 * @param CModel $model the data model
	 * @param string $attribute the attribute
	 * @param array $htmlOptions additional HTML attributes (see {@link tag}).
	 * @return string the generated input field
	 * @see activeInputField
	 */
	public static function activeFileField($model, $attribute, $htmlOptions = array())
	{
		self::resolveNameID($model, $attribute, $htmlOptions);
		// add a hidden field so that if a model only has a file field, we can
		// still use isset($_POST[$modelClass]) to detect if the input is submitted
		$hiddenOptions = isset($htmlOptions['id']) ? array('id' => self::ID_PREFIX . $htmlOptions['id']) : array('id' => false);
		return self::hiddenField($htmlOptions['name'], '', $hiddenOptions)
			. self::activeInputField('file', $model, $attribute, $htmlOptions);
	}

	/**
	 * Generates a check box list for a model attribute.
	 * The model attribute value is used as the selection.
	 * If the attribute has input error, the input field's CSS class will
	 * be appended with {@link errorCss}.
	 * Note that a check box list allows multiple selection, like {@link listBox}.
	 * As a result, the corresponding POST value is an array. In case no selection
	 * is made, the corresponding POST value is an empty string.
	 * @param CModel $model the data model
	 * @param string $attribute the attribute
	 * @param array $data value-label pairs used to generate the check box list.
	 * Note, the values will be automatically HTML-encoded, while the labels will not.
	 * @param array $htmlOptions addtional HTML options. The options will be applied to
	 * each checkbox input. The following special options are recognized:
	 * <ul>
	 * <li>template: string, specifies how each checkbox is rendered. Defaults
	 * to "{input} {label}", where "{input}" will be replaced by the generated
	 * check box input tag while "{label}" will be replaced by the corresponding check box label.</li>
	 * <li>separator: string, specifies the string that separates the generated check boxes.</li>
	 * <li>checkAll: string, specifies the label for the "check all" checkbox.
	 * If this option is specified, a 'check all' checkbox will be displayed. Clicking on
	 * this checkbox will cause all checkboxes checked or unchecked.</li>
	 * <li>checkAllLast: boolean, specifies whether the 'check all' checkbox should be
	 * displayed at the end of the checkbox list. If this option is not set (default)
	 * or is false, the 'check all' checkbox will be displayed at the beginning of
	 * the checkbox list.</li>
	 * <li>encode: boolean, specifies whether to encode HTML-encode tag attributes and values. Defaults to true.</li>
	 * </ul>
	 * Since 1.1.7, a special option named 'uncheckValue' is available. It can be used to set the value
	 * that will be returned when the checkbox is not checked. By default, this value is ''.
	 * Internally, a hidden field is rendered so when the checkbox is not checked, we can still
	 * obtain the value. If 'uncheckValue' is set to NULL, there will be no hidden field rendered.
	 * @return string the generated check box list
	 * @see checkBoxList
	 */
	public static function activeInlineCheckBoxList($model, $attribute, $data, $htmlOptions = array())
	{
		self::resolveNameID($model, $attribute, $htmlOptions);
		$selection = self::resolveValue($model, $attribute);
		if ($model->hasErrors($attribute))
			self::addErrorCss($htmlOptions);
		$name = self::popOption('name', $htmlOptions);

		$unCheck = self::popOption('uncheckValue', $htmlOptions, '');

		$hiddenOptions = isset($htmlOptions['id']) ? array('id' => self::ID_PREFIX . $htmlOptions['id']) : array('id' => false);
		$hidden = $unCheck !== null ? self::hiddenField($name, $unCheck, $hiddenOptions) : '';

		return $hidden . self::inlineCheckBoxList($name, $selection, $data, $htmlOptions);
	}

	/**
	 * Generates a radio button list for a model attribute.
	 * The model attribute value is used as the selection.
	 * If the attribute has input error, the input field's CSS class will
	 * be appended with {@link errorCss}.
	 * @param CModel $model the data model
	 * @param string $attribute the attribute
	 * @param array $data value-label pairs used to generate the radio button list.
	 * Note, the values will be automatically HTML-encoded, while the labels will not.
	 * @param array $htmlOptions addtional HTML options. The options will be applied to
	 * each radio button input. The following special options are recognized:
	 * <ul>
	 * <li>template: string, specifies how each radio button is rendered. Defaults
	 * to "{input} {label}", where "{input}" will be replaced by the generated
	 * radio button input tag while "{label}" will be replaced by the corresponding radio button label.</li>
	 * <li>separator: string, specifies the string that separates the generated radio buttons. Defaults to new line (<br/>).</li>
	 * <li>encode: boolean, specifies whether to encode HTML-encode tag attributes and values. Defaults to true.</li>
	 * </ul>
	 * Since version 1.1.7, a special option named 'uncheckValue' is available that can be used to specify the value
	 * returned when the radio button is not checked. By default, this value is ''. Internally, a hidden field is
	 * rendered so that when the radio button is not checked, we can still obtain the posted uncheck value.
	 * If 'uncheckValue' is set as NULL, the hidden field will not be rendered.
	 * @return string the generated radio button list
	 * @see radioButtonList
	 */
	public static function activeInlineRadioButtonList($model, $attribute, $data, $htmlOptions = array())
	{
		self::resolveNameID($model, $attribute, $htmlOptions);
		$selection = self::resolveValue($model, $attribute);
		if ($model->hasErrors($attribute))
			self::addErrorCss($htmlOptions);
		$name = self::popOption('name', $htmlOptions);
		$unCheck = self::popOption('uncheckValue', $htmlOptions, '');

		$hiddenOptions = isset($htmlOptions['id']) ? array('id' => self::ID_PREFIX . $htmlOptions['id']) : array('id' => false);
		$hidden = $unCheck !== null ? self::hiddenField($name, $unCheck, $hiddenOptions) : '';

		return $hidden . self::inlineRadioButtonList($name, $selection, $data, $htmlOptions);
	}

	/**
	 * Generates an input HTML tag for a model attribute.
	 * This method generates an input HTML tag based on the given data model and attribute.
	 * If the attribute has input error, the input field's CSS class will
	 * be appended with {@link errorCss}.
	 * This enables highlighting the incorrect input.
	 * @param string $type the input type (e.g. 'text', 'radio')
	 * @param CModel $model the data model
	 * @param string $attribute the attribute
	 * @param array $htmlOptions additional HTML attributes for the HTML tag
	 * @return string the generated input tag
	 */
	protected static function activeInputField($type, $model, $attribute, $htmlOptions)
	{
		$inputOptions = self::removeOptions($htmlOptions, array('append', 'prepend'));
		$addOnClasses = self::getAddOnClasses($htmlOptions);
		$help = self::getHelp($htmlOptions);

		ob_start();
		if (!empty($addOnClasses))
			echo '<div class="' . $addOnClasses . '">';

		echo self::getPrepend($htmlOptions);
		echo parent::activeInputField($type, $model, $attribute, $inputOptions);
		echo self::getAppend($htmlOptions);

		if (!empty($addOnClasses))
			echo '</div>';

		echo $help;

		return ob_get_clean();
	}

	/**
	 * Displays the first validation error for a model attribute.
	 * @param CModel $model the data model
	 * @param string $attribute the attribute name
	 * @param array $htmlOptions additional HTML attributes to be rendered in the container tag.
	 * @return string the error display. Empty if no errors are found.
	 * @see CModel::getErrors
	 * @see errorMessageCss
	 * @see $errorContainerTag
	 */
	public static function error($model, $attribute, $htmlOptions = array())
	{
		self::resolveName($model, $attribute); // turn [a][b]attr into attr
		$error = $model->getError($attribute);
		return $error != ''
			? self::tag('span', self::defaultOption('class', self::$errorMessageCss, $htmlOptions), $error)
			: '';
	}

	/**
	 * Displays a summary of validation errors for one or several models.
	 * @param mixed $model the models whose input errors are to be displayed. This can be either
	 * a single model or an array of models.
	 * @param string $header a piece of HTML code that appears in front of the errors
	 * @param string $footer a piece of HTML code that appears at the end of the errors
	 * @param array $htmlOptions additional HTML attributes to be rendered in the container div tag.
	 * A special option named 'firstError' is recognized, which when set true, will
	 * make the error summary to show only the first error message of each attribute.
	 * If this is not set or is false, all error messages will be displayed.
	 * This option has been available since version 1.1.3.
	 * @return string the error summary. Empty if no errors are found.
	 * @see CModel::getErrors
	 * @see errorSummaryCss
	 */
	public static function errorSummary($model, $header = null, $footer = null, $htmlOptions = array())
	{
		$htmlOptions = TbHtml::addClassName('alert alert-block alert-error', $htmlOptions);

		return parent::errorSummary($model, $header, $footer, $htmlOptions);
	}

	/**
	 * Extracts the help section of htmlOptions if any. The help option is setup as:
	 * <code>
	 *      // ...
	 *         'help'=>array('text'=>'This is help text','type'=>'inline')
	 *         // ...
	 * </code>
	 * @param $htmlOptions
	 * @return mixed|string
	 */
	public static function getHelp(&$htmlOptions)
	{
		$help = self::popOption('help', $htmlOptions);
		if (null !== $help && is_array($help))
		{
			$text = self::popOption('text', $help, 'help');
			$type = self::popOption('type', $help, self::HELP_BLOCK);
			$help = self::tag('span', array('class' => 'help-' . $type, $text));
		}
		return $help;
	}

	/**
	 * Generates a search form.
	 * @param mixed $action the form action URL.
	 * @param string $method form method (e.g. post, get).
	 * @param array $htmlOptions additional HTML options. The following special options are recognized:
	 * <ul>
	 * <li>appendButton: boolean, whether to append or prepend the search button.</li>
	 * <li>inputOptions: array, additional HTML options of the text input field. `type` will always default to `text`.</li>
	 * <li>buttonOptions: array, additional HTML options of the button. It contains special options for the button:
	 * <ul>
	 * <li>label: string, the button label</li>
	 * </ul>
	 * </li>
	 * </ul>
	 * @return string the generated form.
	 * @see http://twitter.github.com/bootstrap/base-css.html#forms
	 */
	public static function searchForm($action, $method = 'post', $htmlOptions = array())
	{
		$htmlOptions = self::addClassName('form-search', $htmlOptions);
		$inputOptions = self::popOption('inputOptions', $htmlOptions, array());
		$inputOptions = self::mergeOptions(array('type' => 'text', 'placeholder' => 'Search'), $inputOptions);
		$inputOptions = self::addClassName('search-query', $inputOptions);

		$buttonOptions = self::popOption('buttonOptions', $htmlOptions, array());
		$buttonLabel = self::popOption('label', $buttonOptions, self::icon('search'));

		ob_start();
		echo self::beginForm($action, $method, $htmlOptions);

		$addon = self::popOption('addon', $htmlOptions);
		if (isset($addon) && in_array($addon, self::$addons))
			$inputOptions[$addon] = self::button($buttonLabel, $buttonOptions);

		echo self::textField(
			self::popOption('name', $inputOptions, 'search'),
			self::popOption('value', $inputOptions, ''),
			$inputOptions
		);

		echo parent::endForm();
		return ob_get_clean();
	}

	/**
	 * Generates a navbar search form.
	 * @param mixed $action the form action URL.
	 * @param string $method form method (e.g. post, get).
	 * @param array $htmlOptions additional HTML attributes
	 * @return string the generated form.
	 */
	public static function navbarSearchForm($action, $method = 'post', $htmlOptions = array())
	{
		$htmlOptions = self::addClassName('navbar-search', $htmlOptions);
		return self::searchForm($action, $method, $htmlOptions);
	}

	/**
	 * Returns the add-on classes if any from `$htmlOptions`.
	 * @param array $htmlOptions the HTML tag options
	 * @return array|string the resulting classes
	 */
	public static function getAddOnClasses($htmlOptions)
	{
		$classes = array();
		if (self::getOption('append', $htmlOptions))
			$classes[] = 'input-append';
		if (self::getOption('prepend', $htmlOptions))
			$classes[] = 'input-prepend';
		return !empty($classes) ? implode(' ', $classes) : $classes;
	}

	/**
	 * Extracts append add-on from `$htmlOptions` if any.
	 * @param array $htmlOptions
	 * @return string
	 */
	public static function getAppend($htmlOptions)
	{
		return self::getAddOn('append', $htmlOptions);
	}

	/**
	 * Extracts prepend add-on from `$htmlOptions` if any.
	 * @param array $htmlOptions
	 * @return string
	 */
	public static function getPrepend($htmlOptions)
	{
		return self::getAddOn('prepend', $htmlOptions);
	}

	/**
	 * Extracs append add-ons from `$htmlOptions` if any.
	 * @param $type
	 * @param array $htmlOptions
	 * @return string
	 */
	public static function getAddOn($type, $htmlOptions)
	{
		$addOn = '';
		if (self::getOption($type, $htmlOptions))
		{
			$addOn = strpos($htmlOptions[$type], 'button')
				? $htmlOptions[$type]
				: CHtml::tag('span', array('class' => 'add-on'), $htmlOptions[$type]);
		}
		return $addOn;
	}

	// Buttons
	// http://twitter.github.com/bootstrap/base-css.html#buttons
	// --------------------------------------------------

	/**
	 * Generates a button.
	 * @param string $label the button label text.
	 * @param array $htmlOptions additional HTML attributes.
	 * @return string the generated button.
	 */
	public static function button($label = 'button', $htmlOptions = array())
	{
		if (!isset($htmlOptions['name']))
			$htmlOptions['name'] = CHtml::ID_PREFIX . CHtml::$count++;
		self::clientChange('click', $htmlOptions);
		return self::btn('button', $label, $htmlOptions);
	}

	/**
	 * Generates a submit button.
	 * @param string $label the button label
	 * @param array $htmlOptions additional HTML attributes. Besides normal HTML attributes, a few special
	 * attributes are also recognized (see {@link clientChange} and {@link tag} for more details.)
	 * @return string the generated button tag
	 * @see clientChange
	 */
	public static function submitButton($label = 'submit', $htmlOptions = array())
	{
		$htmlOptions['type'] = 'submit';
		return self::button($label, $htmlOptions);
	}

	/**
	 * Generates a reset button.
	 * @param string $label the button label
	 * @param array $htmlOptions additional HTML attributes. Besides normal HTML attributes, a few special
	 * attributes are also recognized (see {@link clientChange} and {@link tag} for more details.)
	 * @return string the generated button tag
	 * @see clientChange
	 */
	public static function resetButton($label = 'reset', $htmlOptions = array())
	{
		$htmlOptions['type'] = 'reset';
		return self::button($label, $htmlOptions);
	}

	/**
	 * Generates an image submit button.
	 * @param string $src the image URL
	 * @param array $htmlOptions additional HTML attributes. Besides normal HTML attributes, a few special
	 * attributes are also recognized (see {@link clientChange} and {@link tag} for more details.)
	 * @return string the generated button tag
	 * @see clientChange
	 */
	public static function imageButton($src, $htmlOptions = array())
	{
		$htmlOptions['src'] = $src;
		$htmlOptions['type'] = 'image';
		return self::button('submit', $htmlOptions);
	}

	/**
	 * Generates a link button.
	 * @param string $label the button label text.
	 * @param array $htmlOptions the HTML attributes for the button.
	 * @return string the generated button.
	 */
	public static function linkButton($label = 'submit', $htmlOptions = array())
	{
		$htmlOptions['href'] = self::popOption('url', $htmlOptions, '#');
		$htmlOptions['href'] = parent::normalizeUrl($htmlOptions['href']);
		return self::btn('a', $label, $htmlOptions);
	}

	// todo: add support for ajax buttons and links.

	/**
	 * Generates a button.
	 * @param string $tag the HTML tag.
	 * @param string $label the button label text.
	 * @param array $htmlOptions additional HTML attributes.
	 * @return string the generated button.
	 */
	public static function btn($tag, $label, $htmlOptions = array())
	{
		$htmlOptions = self::addClassName('btn', $htmlOptions);
		$style = self::popOption('style', $htmlOptions);
		if (isset($style) && in_array($style, self::$buttonStyles))
			$htmlOptions = self::addClassName('btn-' . $style, $htmlOptions);
		$size = self::popOption('size', $htmlOptions);
		if (isset($size) && in_array($size, self::$sizes))
			$htmlOptions = self::addClassName('btn-' . $size, $htmlOptions);
		if (self::popOption('block', $htmlOptions, false))
			$htmlOptions = self::addClassName('btn-block', $htmlOptions);
		if (self::popOption('disabled', $htmlOptions, false))
			$htmlOptions = self::addClassName('disabled', $htmlOptions);
		$icon = self::popOption('icon', $htmlOptions);
		if (isset($icon))
			$label = self::icon($icon) . '&nbsp;' . $label;
		return self::tag($tag, $htmlOptions, $label);
	}

	// Images
	// http://twitter.github.com/bootstrap/base-css.html#images
	// --------------------------------------------------

	/**
	 * Generates an image tag with rounded corners.
	 * @param string $src the image URL.
	 * @param string $alt the alternative text display.
	 * @param array $htmlOptions additional HTML attributes.
	 * @return string the generated image tag.
	 */
	public static function imageRounded($src, $alt = '', $htmlOptions = array())
	{
		return parent::image($src, $alt, self::addClassName('img-rounded', $htmlOptions));
	}

	/**
	 * Generates an image tag with circle.
	 * ***Important*** `.img-rounded` and `.img-circle` do not work in IE7-8 due to lack of border-radius support.
	 * @param string $src the image URL.
	 * @param string $alt the alternative text display.
	 * @param array $htmlOptions additional HTML attributes.
	 * @return string the generated image tag.
	 */
	public static function imageCircle($src, $alt = '', $htmlOptions = array())
	{
		return parent::image($src, $alt, self::addClassName('img-circle', $htmlOptions));
	}

	/**
	 * Generates an image tag within polaroid frame.
	 * @param string $src the image URL.
	 * @param string $alt the alternative text display.
	 * @param array $htmlOptions additional HTML attributes.
	 * @return string the generated image tag.
	 */
	public static function imagePolaroid($src, $alt = '', $htmlOptions = array())
	{
		return parent::image($src, $alt, self::addClassName('img-polaroid', $htmlOptions));
	}

	// Icons by Glyphicons
	// http://twitter.github.com/bootstrap/base-css.html#icons
	// --------------------------------------------------

	/**
	 * Generates an icon.
	 * @param string $icon the icon type.
	 * @param array $htmlOptions additional HTML attributes.
	 * @param string $tagName the icon HTML tag.
	 * @return string the generated icon.
	 */
	public static function icon($icon, $htmlOptions = array(), $tagName = 'i')
	{
		if (is_string($icon))
		{
			if (strpos($icon, 'icon') === false)
				$icon = 'icon-' . implode(' icon-', explode(' ', $icon));
			$htmlOptions = self::addClassName($icon, $htmlOptions);
			return parent::openTag($tagName, $htmlOptions) . parent::closeTag($tagName); // tag won't work in this case
		}
		return '';
	}

	//
	// COMPONENTS
	// --------------------------------------------------

	// Dropdowns
	// http://twitter.github.com/bootstrap/components.html#dropdowns
	// --------------------------------------------------

	/**
	 * Generates a dropdown menu.
	 * @param array $items the menu items.
	 * @param array $htmlOptions additional HTML attributes.
	 * @return string the generated menu.
	 */
	public static function dropdown($items, $htmlOptions = array())
	{
		// todo: think about how to apply this, now it applies to all depths while it should only apply for the first.
		//$htmlOptions = self::setDefaultValue('role', 'menu', $htmlOptions);
		$htmlOptions = self::addClassName('dropdown-menu', $htmlOptions);
		if (self::popOption('dropup', $htmlOptions, false))
			$htmlOptions = self::addClassName('dropup', $htmlOptions);
		ob_start();
		echo self::menu($items, $htmlOptions);
		return ob_get_clean();
	}

	/**
	 * Generates a dropdown toggle link.
	 * @param string $label the link label text.
	 * @param array $htmlOptions additional HTML attributes.
	 * @return string the generated link.
	 */
	public static function dropdownToggleLink($label, $htmlOptions = array())
	{
		return self::dropdownToggle('a', $label, $htmlOptions);
	}

	/**
	 * Generates a dropdown toggle button.
	 * @param string $label the button label text.
	 * @param array $htmlOptions additional HTML attributes.
	 * @return string the generated button.
	 */
	public static function dropdownToggleButton($label = '', $htmlOptions = array())
	{
		return self::dropdownToggle('button', $label, $htmlOptions);
	}

	/**
	 * Generates a dropdown toggle element.
	 * @param string $tag the HTML tag.
	 * @param string $label the element text.
	 * @param array $htmlOptions additional HTML attributes.
	 * @return string the generated element.
	 */
	public static function dropdownToggle($tag, $label, $htmlOptions)
	{
		$htmlOptions = self::addClassName('dropdown-toggle', $htmlOptions);
		$htmlOptions = self::defaultOption('data-toggle', 'dropdown', $htmlOptions);
		$label .= ' <b class="caret"></b>';
		return self::btn($tag, $label, $htmlOptions) . PHP_EOL;
	}

	/**
	 * Generates a dropdown toggle menu item.
	 * @param string $label the menu item text.
	 * @param array $htmlOptions additional HTML attributes.
	 * @return string the generated menu item.
	 */
	public static function dropdownToggleMenuLink($label, $htmlOptions = array())
	{
		$htmlOptions = self::addClassName('dropdown-toggle', $htmlOptions);
		$htmlOptions = self::defaultOption('data-toggle', 'dropdown', $htmlOptions);
		$label .= ' <b class="caret"></b>';
		return parent::link($label, '#', $htmlOptions) . PHP_EOL;
	}

	// Button groups
	// http://twitter.github.com/bootstrap/components.html#buttonGroups
	// --------------------------------------------------

	/**
	 * Generates a button group. Example:
	 *
	 * <pre>
	 *     echo TbHtml::buttonGroup(array(
	 *         array('label'=>'testA'),
	 *         array('label'=>'testB')
	 * ));
	 * </pre>
	 *
	 * @param array $buttons the button configurations.
	 * @param array $htmlOptions additional HTML options. The following special options are recognized:
	 * <ul>
	 * <li>
	 *         items: array, the list of buttons to be inserted into the group (see {@link button} function to see available
	 *      config options for buttons.
	 * </li>
	 * <li>
	 *         vertical: string, whether to render the group vertically instead of horizontally.
	 * </li>
	 * </ul>
	 *
	 * @return string the generated button group.
	 */
	public static function buttonGroup($buttons, $htmlOptions = array())
	{
		if (is_array($buttons) && !empty($buttons))
		{
			$htmlOptions = self::addClassName('btn-group', $htmlOptions);
			if (self::popOption('vertical', $htmlOptions, false))
				$htmlOptions = self::addClassName('btn-group-vertical', $htmlOptions);
			$parentOptions = array(
				'style' => self::popOption('style', $htmlOptions),
				'size' => self::popOption('size', $htmlOptions),
				'disabled' => self::popOption('disabled', $htmlOptions)
			);
			ob_start();
			echo parent::openTag('div', $htmlOptions) . PHP_EOL;
			foreach ($buttons as $buttonOptions)
			{
				$options = self::popOption('htmlOptions', $buttonOptions, array());
				if (!empty($options))
					$buttonOptions = self::mergeOptions($options, $buttonOptions);
				$buttonLabel = self::popOption('label', $buttonOptions, '');
				$buttonOptions = self::copyOptions(array('style', 'size', 'disabled'), $parentOptions, $buttonOptions);
				if (isset($buttonOptions['items']))
				{
					$items = self::popOption('items', $buttonOptions);
					echo self::buttonDropdown($buttonLabel, $items, $buttonOptions);
				}
				else
					echo self::linkButton($buttonLabel, $buttonOptions);
			}
			echo '</div>' . PHP_EOL;
			return ob_get_clean();
		}
		return '';
	}

	/**
	 * Generates a button toolbar. Example:
	 *
	 * echo TbHtml::buttonToolbar(array(
	 *     array(
	 *         'items' => array(
	 *             array('label'=>'testA'),
	 *             array('label'=>'testB')
	 *         )
	 *     ),
	 *     array(
	 *         'items' => array(
	 *             array('label'=>'testC')
	 *         )
	 * )));
	 *
	 * @param array $groups the button group configurations.
	 * @param array $htmlOptions additional HTML options.
	 * @return string the generated button toolbar.
	 */
	public static function buttonToolbar($groups, $htmlOptions = array())
	{
		if (is_array($groups) && !empty($groups))
		{
			$htmlOptions = self::addClassName('btn-toolbar', $htmlOptions);
			$parentOptions = array(
				'style' => self::popOption('style', $htmlOptions),
				'size' => self::popOption('size', $htmlOptions),
				'disabled' => self::popOption('disabled', $htmlOptions)
			);
			ob_start();
			echo parent::openTag('div', $htmlOptions) . PHP_EOL;
			foreach ($groups as $groupOptions)
			{
				$items = self::popOption('items', $groupOptions, array());
				if (empty($items))
					continue;
				$options = self::popOption('htmlOptions', $groupOptions, array());
				if (!empty($options))
					$groupOptions = self::mergeOptions($options, $groupOptions);
				$groupOptions = self::copyOptions(array('style', 'size', 'disabled'), $parentOptions, $groupOptions);
				echo self::buttonGroup($items, $groupOptions);
			}
			echo '</div>' . PHP_EOL;
			return ob_get_clean();
		}
		return '';
	}

	// Button dropdowns
	// http://twitter.github.com/bootstrap/components.html#buttonDropdowns
	// --------------------------------------------------

	/**
	 * Generates a button with a dropdown menu.
	 * @param string $label the button label text.
	 * @param array $items the menu items.
	 * @param array $htmlOptions additional HTML attributes.
	 * @return string the generated button.
	 */
	public static function buttonDropdown($label, $items, $htmlOptions = array())
	{
		$menuOptions = self::popOption('menuOptions', $htmlOptions, array());
		$groupOptions = self::popOption('groupOptions', $htmlOptions, array());
		$groupOptions = self::addClassName('btn-group', $groupOptions);
		ob_start();
		echo parent::openTag('div', $groupOptions) . PHP_EOL;
		if (self::popOption('split', $htmlOptions, false))
		{
			echo self::linkButton($label, $htmlOptions);
			echo self::dropdownToggleButton('', $htmlOptions);
		} else
			echo self::dropdownToggleLink($label, $htmlOptions);
		echo self::dropdown($items, $menuOptions);
		echo '</div>' . PHP_EOL;
		return ob_get_clean();
	}

	// Navs
	// http://twitter.github.com/bootstrap/components.html#navs
	// --------------------------------------------------

	/**
	 * Generates a tab navigation.
	 * @param array $items the menu items.
	 * @param array $htmlOptions additional HTML attributes.
	 * @return string the generated menu.
	 */
	public static function tabs($items, $htmlOptions = array())
	{
		return self::nav(self::NAV_TABS, $items, $htmlOptions);
	}

	/**
	 * Generates a pills navigation.
	 * @param array $items the menu items.
	 * @param array $htmlOptions additional HTML attributes.
	 * @return string the generated menu.
	 */
	public static function pills($items, $htmlOptions = array())
	{
		return self::nav(self::NAV_PILLS, $items, $htmlOptions);
	}

	/**
	 * Generates a navigation menu.
	 * @param string $style the menu style.
	 * @param array $items the menu items.
	 * @param array $htmlOptions additional HTML attributes.
	 * @return string the generated menu.
	 */
	public static function nav($style, $items, $htmlOptions = array())
	{
		$htmlOptions = self::addClassName('nav', $htmlOptions);
		if (in_array($style, self::$navStyles))
			$htmlOptions = self::addClassName('nav-' . $style, $htmlOptions);
		if (self::popOption('stacked', $htmlOptions, false))
			$htmlOptions = self::addClassName('nav-stacked', $htmlOptions);
		ob_start();
		echo self::menu($items, $htmlOptions);
		return ob_get_clean();
	}

	/**
	 * Generates a menu.
	 * @param array $items the menu items.
	 * @param array $htmlOptions additional HTML attributes.
	 * @return string the generated menu.
	 */
	public static function menu($items, $htmlOptions = array())
	{
		ob_start();
		echo parent::openTag('ul', $htmlOptions);
		foreach ($items as $itemOptions)
		{
			if (is_string($itemOptions))
				echo $itemOptions;
			else
			{
				$options = self::popOption('itemOptions', $itemOptions, array());
				if (!empty($options))
					$itemOptions = self::mergeOptions($options, $itemOptions);
				// todo: I'm not quite happy with the logic below but it will have to do for now.
				$label = self::popOption('label', $itemOptions, '');
				if (self::popOption('active', $itemOptions, false))
					$itemOptions = self::addClassName('active', $itemOptions);
				if (self::popOption('header', $itemOptions, false))
					echo self::menuHeader($label, $itemOptions);
				else
				{
					$itemOptions['linkOptions'] = self::getOption('linkOptions', $itemOptions, array());
					$icon = self::popOption('icon', $itemOptions);
					if (isset($icon))
						$label = self::icon($icon) . ' ' . $label;
					$items = self::popOption('items', $itemOptions, array());
					if (empty($items))
					{
						$url = self::popOption('url', $itemOptions, false);
						echo self::menuLink($label, $url, $itemOptions);
					} else
						echo self::menuDropdown($label, $items, $itemOptions);
				}
			}
		}
		echo '</ul>' . PHP_EOL;
		return ob_get_clean();
	}

	/**
	 * Generates a menu link.
	 * @param string $label the link label.
	 * @param array $url the link url.
	 * @param array $htmlOptions additional HTML attributes.
	 * @return string the generated menu item.
	 */
	public static function menuLink($label, $url, $htmlOptions = array())
	{
		$linkOptions = self::popOption('linkOptions', $htmlOptions, array());
		ob_start();
		echo parent::openTag('li', $htmlOptions) . PHP_EOL;
		echo parent::link($label, $url, $linkOptions) . PHP_EOL;
		echo '</li>' . PHP_EOL;
		return ob_get_clean();
	}

	/**
	 * Generates a menu dropdown.
	 * @param string $label the link label.
	 * @param array $items the menu configuration.
	 * @param array $htmlOptions additional HTML attributes.
	 * @return string the generated dropdown.
	 */
	public static function menuDropdown($label, $items, $htmlOptions)
	{
		$htmlOptions = self::addClassName('dropdown', $htmlOptions);
		$linkOptions = self::popOption('linkOptions', $htmlOptions, array());
		$menuOptions = self::popOption('menuOptions', $htmlOptions, array());
		$menuOptions = self::addClassName('dropdown-menu', $menuOptions);
		if (self::popOption('active', $htmlOptions, false))
			$htmlOptions = self::addClassName('active', $htmlOptions);
		ob_start();
		echo parent::openTag('li', $htmlOptions) . PHP_EOL;
		echo self::dropdownToggleMenuLink($label, $linkOptions);
		echo self::menu($items, $menuOptions);
		echo '</li>' . PHP_EOL;
		return ob_get_clean();
	}

	/**
	 * Generates a menu header.
	 * @param string $label the header text.
	 * @param array $htmlOptions additional HTML options.
	 * @return string the generated header.
	 */
	public static function menuHeader($label, $htmlOptions = array())
	{
		$htmlOptions = self::addClassName('nav-header', $htmlOptions);
		return parent::tag('li', $htmlOptions, $label) . PHP_EOL;
	}

	/**
	 * Generates a menu divider.
	 * @param array $htmlOptions additional HTML attributes.
	 * @return string the generated menu item.
	 */
	public static function menuDivider($htmlOptions = array())
	{
		$htmlOptions = self::addClassName('divider', $htmlOptions);
		return parent::tag('li', $htmlOptions) . PHP_EOL;
	}

	// Navbar
	// http://twitter.github.com/bootstrap/components.html#navbar
	// --------------------------------------------------

	/**
	 * Generates a navbar.
	 * @param string $content the navbar content.
	 * @param array $htmlOptions additional HTML attributes.
	 * @return string the generated navbar.
	 */
	public static function navbar($content, $htmlOptions = array())
	{
		$htmlOptions = self::addClassName('navbar', $htmlOptions);
		$position = self::popOption('position', $htmlOptions);
		$static = self::popOption('static', $htmlOptions, false);
		if (isset($position) && in_array($position, self::$positions))
			$htmlOptions = self::addClassName('navbar-fixed-' . $position, $htmlOptions);
		else if ($static) // navbar cannot be both fixed and static
			$htmlOptions = self::addClassName('navbar-static-top', $htmlOptions);
		$style = self::popOption('style', $htmlOptions);
		if (isset($style) && in_array($style, self::$navbarStyles))
			$htmlOptions = self::addClassName('navbar-' . $style, $htmlOptions);
		$innerOptions = self::popOption('innerOptions', $htmlOptions, array());
		$innerOptions = self::addClassName('navbar-inner', $innerOptions);
		ob_start();
		echo parent::openTag('div', $htmlOptions) . PHP_EOL;
		echo parent::tag('div', $innerOptions, $content) . PHP_EOL;
		echo '</div>' . PHP_EOL;
		return ob_get_clean();
	}

	/**
	 * Generates a brand link for the navbar.
	 * @param string $label the link label text.
	 * @param string $url the link url.
	 * @param array $htmlOptions additional HTML attributes.
	 * @return string the generated link.
	 */
	public static function navbarBrandLink($label, $url, $htmlOptions = array())
	{
		$htmlOptions = self::addClassName('brand', $htmlOptions);
		return parent::link($label, $url, $htmlOptions);
	}

	/**
	 * Generates a menu divider for the navbar.
	 * @param array $htmlOptions additional HTML attributes.
	 * @return string the generated divider.
	 */
	public static function navbarMenuDivider($htmlOptions = array())
	{
		$htmlOptions = self::addClassName('divider-vertical', $htmlOptions);
		return parent::tag('li', $htmlOptions) . PHP_EOL;
	}

	// Breadcrumbs
	// http://twitter.github.com/bootstrap/components.html#breadcrumbs
	// --------------------------------------------------

	/**
	 * Generates a breadcrumb menu.
	 * @param array $links the breadcrumb links.
	 * @param array $htmlOptions additional HTML attributes.
	 * @return string the generated breadcrumb.
	 */
	public static function breadcrumbs($links, $htmlOptions = array())
	{
		$divider = self::popOption('divider', $htmlOptions, '/');
		$htmlOptions = self::addClassName('breadcrumb', $htmlOptions);
		ob_start();
		echo parent::openTag('ul', $htmlOptions) . PHP_EOL;
		foreach ($links as $label => $url)
		{
			if (is_string($label))
			{
				echo parent::openTag('li');
				echo parent::link($label, parent::normalizeUrl($url));
				echo parent::tag('span', array('class' => 'divider'), $divider);
				echo '</li>' . PHP_EOL;
			} else
				echo parent::tag('li', array('class' => 'active'), $url);
		}
		echo '</ul>' . PHP_EOL;
		return ob_get_clean();
	}

	// Pagination
	// http://twitter.github.com/bootstrap/components.html#pagination
	// --------------------------------------------------

	/**
	 * Generates a pagination.
	 * @param array $links the pagination buttons.
	 * @param array $htmlOptions additional HTML attributes.
	 * @return string the generated pagination.
	 */
	public static function pagination($links, $htmlOptions = array())
	{
		if (is_array($links) && !empty($links))
		{
			$htmlOptions = self::addClassName('pagination', $htmlOptions);
			$size = self::popOption('size', $htmlOptions);
			if (isset($size) && in_array($size, self::$sizes))
				$htmlOptions = self::addClassName('pagination-' . $size, $htmlOptions);
			$align = self::popOption('align', $htmlOptions);
			if (isset($align) && in_array($align, self::$alignments))
				$htmlOptions = self::addClassName('pagination-' . $align, $htmlOptions);
			$listOptions = self::popOption('listOptions', $htmlOptions, array());
			ob_start();
			echo parent::openTag('div', $htmlOptions) . PHP_EOL;
			echo parent::openTag('ul', $listOptions) . PHP_EOL;
			foreach ($links as $itemOptions)
			{
				$options = self::popOption('htmlOptions', $itemOptions, array());
				if (!empty($options))
					$itemOptions = self::mergeOptions($options, $itemOptions);
				$label = self::popOption('label', $itemOptions, '');
				$url = self::popOption('url', $itemOptions, false);
				echo self::paginationLink($label, $url, $itemOptions);
			}
			echo '</ul>' . PHP_EOL . '</div>' . PHP_EOL;
			return ob_get_clean();
		}
		return '';
	}

	/**
	 * Generates a pagination link.
	 * @param string $label the link label text.
	 * @param mixed $url the link url.
	 * @param array $htmlOptions additional HTML attributes.
	 * @return string the generated link.
	 */
	public static function paginationLink($label, $url, $htmlOptions = array())
	{
		$active = self::popOption('active', $htmlOptions);
		$disabled = self::popOption('disabled', $htmlOptions);
		if ($active)
			$htmlOptions = self::addClassName('active', $htmlOptions);
		else if ($disabled)
			$htmlOptions = self::addClassName('disabled', $htmlOptions);
		$linkOptions = self::popOption('linkOptions', $htmlOptions, array());
		ob_start();
		echo parent::openTag('li', $htmlOptions) . PHP_EOL;
		echo parent::link($label, $url, $linkOptions) . PHP_EOL;
		echo '</li>' . PHP_EOL;
		return ob_get_clean();
	}

	/**
	 * Generates a pager.
	 * @param array $links the pager buttons.
	 * @param array $htmlOptions additional HTML attributes.
	 * @return string the generated pager.
	 */
	public static function pager($links, $htmlOptions = array())
	{
		if (is_array($links) && !empty($links))
		{
			$htmlOptions = self::addClassName('pager', $htmlOptions);
			ob_start();
			echo parent::openTag('ul', $htmlOptions) . PHP_EOL;
			foreach ($links as $itemOptions)
			{
				$options = self::popOption('htmlOptions', $itemOptions, array());
				if (!empty($options))
					$itemOptions = self::mergeOptions($options, $itemOptions);
				$label = self::popOption('label', $itemOptions, '');
				$url = self::popOption('url', $itemOptions, false);
				echo self::pagerLink($label, $url, $itemOptions);
			}
			echo '</ul>' . PHP_EOL;
			return ob_get_clean();
		}
		return '';
	}

	/**
	 * Generates a pager link.
	 * @param string $label the link label text.
	 * @param mixed $url the link url.
	 * @param array $htmlOptions additional HTML attributes.
	 * @return string the generated link.
	 */
	public static function pagerLink($label, $url, $htmlOptions = array())
	{
		$previous = self::popOption('previous', $htmlOptions);
		$next = self::popOption('next', $htmlOptions);
		if ($previous)
			$htmlOptions = self::addClassName('previous', $htmlOptions);
		else if ($next)
			$htmlOptions = self::addClassName('next', $htmlOptions);
		if (self::popOption('disabled', $htmlOptions, false))
			$htmlOptions = self::addClassName('disabled', $htmlOptions);
		$linkOptions = self::popOption('linkOptions', $htmlOptions, array());
		ob_start();
		echo parent::openTag('li', $htmlOptions) . PHP_EOL;
		echo parent::link($label, $url, $linkOptions) . PHP_EOL;
		echo '</li>' . PHP_EOL;
		return ob_get_clean();
	}

	// Labels and badges
	// http://twitter.github.com/bootstrap/components.html#labels-badges
	// --------------------------------------------------

	/**
	 * Generates a label span.
	 * @param string $label the label text.
	 * @param array $htmlOptions additional HTML attributes.
	 * @return string the generated span.
	 */
	public static function labelTb($label, $htmlOptions = array())
	{
		return self::labelBadge('label', $label, $htmlOptions);
	}

	/**
	 * Generates a badge span.
	 * @param string $label the badge text.
	 * @param array $htmlOptions additional HTML attributes.
	 * @return string the generated span.
	 *
	 */
	public static function badge($label, $htmlOptions = array())
	{
		return self::labelBadge('badge', $label, $htmlOptions);
	}

	/**
	 * Generates a label or badge span.
	 * @param string $type the span type.
	 * @param string $label the label text.
	 * @param array $htmlOptions additional HTML attributes.
	 * @return string the generated span.
	 */
	public static function labelBadge($type, $label, $htmlOptions = array())
	{
		$htmlOptions = self::addClassName($type, $htmlOptions);
		$style = self::popOption('style', $htmlOptions);
		if (isset($style) && in_array($style, self::$labelBadgeStyles))
			$htmlOptions = self::addClassName($type . '-' . $style, $htmlOptions);
		return self::tag('span', $htmlOptions, $label);
	}

	// Typography
	// http://twitter.github.com/bootstrap/components.html#typography
	// --------------------------------------------------

	/**
	 * Generates a hero unit.
	 * @param string $heading the heading text.
	 * @param string $content the content text.
	 * @param array $htmlOptions additional HTML attributes.
	 * @return string the generated hero unit.
	 */
	public static function heroUnit($heading, $content, $htmlOptions = array())
	{
		$htmlOptions = self::addClassName('hero-unit', $htmlOptions);
		$headingOptions = self::popOption('headingOptions', $htmlOptions, array());
		ob_start();
		echo parent::tag('div', $htmlOptions) . PHP_EOL;
		echo parent::tag('h1', $headingOptions, $heading) . PHP_EOL;
		echo $content;
		echo '</div>' . PHP_EOL;
		return ob_get_clean();
	}

	/**
	 * Generates a pager header.
	 * @param string $heading the heading text.
	 * @param string $subtext the subtext.
	 * @param array $htmlOptions additional HTML attributes.
	 * @return string the generated pager header.
	 */
	public static function pageHeader($heading, $subtext, $htmlOptions = array())
	{
		/* todo: we may have to set an empty array() as default value */
		$htmlOptions = self::addClassName('page-header', $htmlOptions);
		$headerOptions = self::popOption('headerOptions', $htmlOptions, array());
		$subtextOptions = self::popOption('subtextOptions', $htmlOptions, array());
		ob_start();
		echo parent::openTag('div', $htmlOptions) . PHP_EOL;
		echo parent::openTag('h1', $headerOptions);
		echo parent::encode($heading) . ' ' . parent::tag('small', $subtextOptions, $subtext);
		echo '</h1>' . PHP_EOL;
		echo '</div>' . PHP_EOL;
		return ob_get_clean();
	}

	// Thumbnails
	// http://twitter.github.com/bootstrap/components.html#thumbnails
	// --------------------------------------------------

	/**
	 * Generates a list of thumbnails.
	 * @param array $thumbnails the list configuration.
	 * @param array $htmlOptions additional HTML attributes.
	 * @return string the generated thumbnails.
	 */
	public static function thumbnails($thumbnails, $htmlOptions = array())
	{
		if (is_array($thumbnails) && !empty($thumbnails))
		{
			/* todo: we may have to set an empty array() as default value */
			$htmlOptions = self::addClassName('thumbnails', $htmlOptions);
			ob_start();
			echo parent::openTag('ul', $htmlOptions) . PHP_EOL;
			foreach ($thumbnails as $thumbnailOptions)
			{
				$options = self::popOption('htmlOptions', $thumbnailOptions, array());
				if (!empty($options))
					$thumbnailOptions = self::mergeOptions($options, $thumbnailOptions);
				$span = self::popOption('span', $thumbnailOptions, 3);
				$content = self::popOption('content', $thumbnailOptions, '');
				$url = self::popOption('url', $thumbnailOptions, false);
				echo $url !== false
					? self::thumbnailLink($span, $content, $url, $thumbnailOptions)
					: self::thumbnail($span, $content, $thumbnailOptions);
			}
			echo '</ul>' . PHP_EOL;
			return ob_get_clean();
		}
		return '';
	}

	/**
	 * Generates a thumbnail.
	 * @param integer $span the number of grid columns that the thumbnail spans over.
	 * @param string $content the thumbnail content.
	 * @param array $htmlOptions additional HTML attributes.
	 * @return string the generated thumbnail.
	 */
	public static function thumbnail($span, $content, $htmlOptions = array())
	{
		$itemOptions = self::popOption('itemOptions', $htmlOptions, array());
		$itemOptions = self::addClassName('span' . $span, $itemOptions);
		$htmlOptions = self::addClassName('thumbnail', $htmlOptions);
		ob_start();
		echo parent::openTag('li', $itemOptions) . PHP_EOL;
		echo parent::openTag('div', $htmlOptions) . PHP_EOL;
		echo $content . PHP_EOL;
		echo '</div>' . PHP_EOL;
		echo '</li>' . PHP_EOL;
		return ob_get_clean();
	}

	/**
	 * Generates a link thumbnail.
	 * @param integer $span the number of grid columns that the thumbnail spans over.
	 * @param string $content the thumbnail content.
	 * @param mixed $url the url that the thumbnail links to.
	 * @param array $htmlOptions additional HTML attributes.
	 * @return string the generated thumbnail.
	 */
	public static function thumbnailLink($span, $content, $url, $htmlOptions = array())
	{
		$itemOptions = self::popOption('itemOptions', $htmlOptions, array());
		$itemOptions = self::addClassName('span' . $span, $itemOptions);
		$htmlOptions = self::addClassName('thumbnail', $htmlOptions);
		ob_start();
		echo parent::openTag('li', $itemOptions) . PHP_EOL;
		echo parent::link($content, $url, $htmlOptions) . PHP_EOL;
		echo '</li>' . PHP_EOL;
		return ob_get_clean();
	}

	// Alerts
	// http://twitter.github.com/bootstrap/components.html#alerts
	// --------------------------------------------------

	/**
	 * @param string $style the style of the alert.
	 * @param string $message the message to display  within the alert box
	 * @param array $htmlOptions additional HTML options. The following special options are recognized:
	 * <ul>
	 * <li>block: boolean, specifies whether to increase the padding on top and bottom of the alert wrapper.</li>
	 * <li>fade: boolean, specifies whether to have fade in/out effect when showing/hiding the alert.
	 * Defaults to `true`.</li>
	 * <li>closeText: string, the text to use as closing button. If none specified, no close button will be shown.</li>
	 * </ul>
	 * @return string
	 */
	public static function alert($style, $message, $htmlOptions = array())
	{
		$htmlOptions = self::addClassName('alert', $htmlOptions);
		if (isset($style) && in_array($style, self::$alertStyles))
			$htmlOptions = self::addClassName('alert-' . $style, $htmlOptions);
		if (self::popOption('in', $htmlOptions, true))
			$htmlOptions = self::addClassName('in', $htmlOptions);
		if (self::popOption('block', $htmlOptions, false))
			$htmlOptions = self::addClassName('alert-block', $htmlOptions);
		if (self::popOption('fade', $htmlOptions, true))
			$htmlOptions = self::addClassName('fade', $htmlOptions);
		$closeText = self::popOption('closeText', $htmlOptions, self::CLOSE_TEXT);
		$closeOptions = self::popOption('closeOptions', $htmlOptions, array());
		ob_start();
		echo parent::openTag('div', $htmlOptions);
		echo $closeText !== false ? self::closeLink($closeText, $closeOptions) : '';
		echo $message;
		echo '</div>';
		return ob_get_clean();
	}

	// Progress bars
	// http://twitter.github.com/bootstrap/components.html#progress
	// --------------------------------------------------

	/**
	 * Generates a progress bar.
	 * @param integer $width the progress in percent.
	 * @param array $htmlOptions additional HTML attributes.
	 * @return string the generated progress bar.
	 */
	public static function progressBar($width = 0, $htmlOptions = array())
	{
		$htmlOptions = self::addClassName('progress', $htmlOptions);
		$style = self::popOption('style', $htmlOptions);
		if (isset($style) && in_array($style, self::$progressStyles))
			$htmlOptions = self::addClassName('progress-' . $style, $htmlOptions);
		if (self::popOption('striped', $htmlOptions, false))
		{
			$htmlOptions = self::addClassName('progress-striped', $htmlOptions);
			if (self::popOption('animated', $htmlOptions, false))
				$htmlOptions = self::addClassName('active', $htmlOptions);
		}
		$barOptions = self::getOption('barOptions', $htmlOptions, array());
		$barOptions = self::defaultOption('content', self::getOption('content', $htmlOptions, ''), $barOptions);
		ob_start();
		echo parent::openTag('div', $htmlOptions) . PHP_EOL;
		echo self::bar($width, $barOptions);
		echo '</div>' . PHP_EOL;
		return ob_get_clean();
	}

	/**
	 * Generates a striped progress bar.
	 * @param integer $width the progress in percent.
	 * @param array $htmlOptions additional HTML attributes.
	 * @return string the generated progress bar.
	 */
	public static function stripedProgressBar($width = 0, $htmlOptions = array())
	{
		$htmlOptions = self::defaultOption('striped', true, $htmlOptions);
		return self::progressBar($width, $htmlOptions);
	}

	/**
	 * Generates an animated progress bar.
	 * @param integer $width the progress in percent.
	 * @param array $htmlOptions additional HTML attributes.
	 * @return string the generated progress bar.
	 */
	public static function animatedProgressBar($width = 0, $htmlOptions = array())
	{
		$htmlOptions = self::defaultOption('animated', true, $htmlOptions);
		return self::stripedProgressBar($width, $htmlOptions);
	}

	/**
	 * Generates a stacked progress bar.
	 * @param array $bars the bar configurations.
	 * @param array $htmlOptions additional HTML attributes.
	 * @return string the generated progress bar.
	 */
	public static function stackedProgressBar($bars, $htmlOptions = array())
	{
		if (is_array($bars) && !empty($bars))
		{
			$htmlOptions = self::addClassName('progress', $htmlOptions);
			ob_start();
			echo parent::openTag('div', $htmlOptions) . PHP_EOL;
			foreach ($bars as $barOptions)
			{
				$options = self::popOption('htmlOptions', $barOptions, array());
				if (!empty($options))
					$barOptions = self::mergeOptions($options, $barOptions);
				$width = self::popOption('width', $barOptions, 0);
				echo self::bar($width, $barOptions);
			}
			echo '</div>' . PHP_EOL;
			return ob_get_clean();
		}
		return '';
	}

	/**
	 * Generates a progress bar.
	 * @param integer $width the progress in percent.
	 * @param array $htmlOptions additional HTML attributes.
	 * @return string the generated bar.
	 */
	public static function bar($width = 0, $htmlOptions = array())
	{
		$htmlOptions = self::addClassName('bar', $htmlOptions);
		$style = self::popOption('style', $htmlOptions);
		if (isset($style) && in_array($style, self::$progressStyles))
			$htmlOptions = self::addClassName('bar-' . $style, $htmlOptions);
		if ($width < 0)
			$width = 0;
		if ($width > 100)
			$width = 100;
		$htmlOptions = self::addStyles("width: {$width}%;", $htmlOptions);
		$content = self::popOption('content', $htmlOptions, '');
		return parent::tag('div', $htmlOptions, $content) . PHP_EOL;
	}

	// Media objects
	// http://twitter.github.com/bootstrap/components.html#media
	// --------------------------------------------------

	/**
	 * Generates a list of media objects.
	 * @param array $mediaObjects, media objects with the following configuration options:
	 * <ul>
	 *  <li> image: string, url of the image. </li>
	 *  <li> heading: string, the heading of the content. </li>
	 *  <li> content: string, content of the image. </li>
	 *  <li> htmlOptions: array, additional HTML attributes. Factorial attributes see {@link mediaObject}.
	 * </ul>
	 * @return string generated list.
	 */
	public static function mediaObjects($mediaObjects)
	{
		if($mediaObjects !== null && is_array($mediaObjects))
		{
			ob_start();
			foreach ($mediaObjects as $mediaObjectOptions)
			{
				$itemImageUrl = self::getOption('image', $mediaObjectOptions, '#');
				$itemHeading = self::getOption('heading', $mediaObjectOptions, '');
				$itemContent = self::getOption('content', $mediaObjectOptions, '');
				$itemOptions = self::getOption('htmlOptions', $mediaObjectOptions, array());
				echo self::mediaObject($itemImageUrl, $itemHeading, $itemContent, $itemOptions);
			}
			return ob_get_clean();
		}
		return '';
	}

	/**
	 * Generates a single media object. Factorial.
	 * @param $imageUrl string the header of the media object
	 * @param $heading
	 * @param $content
	 * @param array $htmlOptions additional HTML attributes. The following special attributes are supported:
	 * <ul>
	 * 	<li> urlOptions: array(), additional HTML attributes for the url of the media-object header image. The following
	 *       special attributes are supported:
	 *      <ul>
	 * 			<li> href: the url of the link </li>
	 * 		</ul>
	 *  </li>
	 *  <li> imageOptions: array(), additional HTML attributes for the image of the media-object header. The following
	 *  	 special attributes are supported:
	 *       <ul>
	 * 			<li> alt: the alt of the image </li>
	 * 		 </ul>
	 *  </li>
	 *  <li> contentOptions: array(), additional HTML attributes for the media-body content. </li>
	 *  <li> headingOptions: array(), additional HTML attributes for the heading content. </li>
	 *  <li> items: array(), nested media object (childrens) with the following configuration options:
	 *       <ul>
	 *         <li> image: string, url of the image. </li>
	 *         <li> heading: string, the heading of the content. </li>
	 *         <li> content: string, content of the image. </li>
	 *         <li> htmlOptions: array, additional HTML attributes. Factorial attributes see above.
	 *      </ul>
	 * </li>
	 * </ul>
	 * @return string
	 */
	public static function mediaObject($imageUrl, $heading, $content, $htmlOptions = array())
	{
		// extract supported options - brainstorm for better approach --
		$urlOptions = self::popOption('urlOptions', $htmlOptions, array());
		$imageOptions = self::popOption('imageOptions', $htmlOptions, array());
		$contentOptions = self::popOption('contentOptions', $htmlOptions, array());
		$headingOptions = self::popOption('headingOptions', $htmlOptions, array());

		// add required classes
		$urlOptions = self::defaultOption('class', 'pull-left', $urlOptions);
		$imageOptions = self::addClassName('media-object', $imageOptions);
		$contentOptions = self::addClassName('media-body', $contentOptions);
		$headingOptions = self::addClassName('media-heading', $headingOptions);

		// do we have any children?
		$children= self::popOption('items', $htmlOptions);

		ob_start();

		echo parent::openTag('div', self::addClassName('media', $htmlOptions)); // media

		echo parent::link(
			parent::image($imageUrl, self::popOption('alt', $imageOptions, ''), $imageOptions),
			self::popOption('href', $urlOptions, '#'),
			$urlOptions);

		echo parent::openTag('div', $contentOptions); // media-body

		// render heading
		echo parent::tag('h4', $headingOptions, $heading);

		// render content
		echo $content;

		// render children
		echo self::mediaObjects($children);

		echo '</div>'; // media-body
		echo '</div>'; // media

		return ob_get_clean();
	}

	// Misc
	// http://twitter.github.com/bootstrap/components.html#misc
	// --------------------------------------------------

	/**
	 * Generates a well element.
	 * @param string $content the well content.
	 * @param array $htmlOptions additional HTML attributes.
	 * @return string the generated well.
	 */
	public static function well($content, $htmlOptions = array())
	{
		$size = self::popOption('size', $htmlOptions);
		if (isset($size) && in_array($size, self::$sizes))
			$htmlOptions = self::addClassName('well-' . $size, $htmlOptions);
		ob_start();
		echo parent::tag('div', $htmlOptions, $content) . PHP_EOL;
		return ob_get_clean();
	}

	/**
	 * Generates a close link.
	 * @param string $label the link label text.
	 * @param array $htmlOptions additional HTML attributes.
	 * @return string the generated link.
	 */
	public static function closeLink($label = self::CLOSE_TEXT, $htmlOptions = array())
	{
		$htmlOptions = self::defaultOption('href', '#', $htmlOptions);
		return self::closeIcon('a', $label, $htmlOptions);
	}

	/**
	 * Generates a close button.
	 * @param string $label the button label text.
	 * @param array $htmlOptions the HTML options for the button.
	 * @return string the generated button.
	 */
	public static function closeButton($label = self::CLOSE_TEXT, $htmlOptions = array())
	{
		return self::closeIcon('button', $label, $htmlOptions);
	}

	/**
	 * Generates a close element.
	 * @param string $tag the element tag
	 * @param string $label the element label text.
	 * @param array $htmlOptions additional HTML attributes.
	 * @return string the generated element.
	 */
	public static function closeIcon($tag, $label, $htmlOptions = array())
	{
		$htmlOptions = self::addClassName('close', $htmlOptions);
		$htmlOptions = self::defaultOption('data-dismiss', 'alert', $htmlOptions);
		return parent::tag($tag, $htmlOptions, $label) . PHP_EOL;
	}

	/**
	 * Generates a collapse link.
	 * @param string $label the link label.
	 * @param string $target the CSS selector.
	 * @param array $htmlOptions additional HTML attributes.
	 * @return string the generated link.
	 */
	public static function collapseLink($label, $target, $htmlOptions = array())
	{
		$htmlOptions['data-toggle'] = 'collapse';
		return parent::link($label, $target, $htmlOptions);
	}

	/**
	 * Generates a collapse icon.
	 * @param string $target the CSS selector for the target element.
	 * @param array $htmlOptions additional HTML attributes.
	 * @return string the generated icon.
	 */
	public static function collapseIcon($target, $htmlOptions = array())
	{
		$htmlOptions = self::addClassName('btn btn-navbar', $htmlOptions);
		$htmlOptions = self::defaultOptions($htmlOptions, array(
			'data-toggle' => 'collapse',
			'data-target' => $target,
		));
		ob_start();
		echo parent::openTag('a', $htmlOptions);
		echo '<span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>';
		echo '</a>';
		return ob_get_clean();
	}

	//
	// JAVASCRIPT
	// --------------------------------------------------

	// Tooltips and Popovers
	// http://twitter.github.com/bootstrap/javascript.html#tooltips
	// http://twitter.github.com/bootstrap/javascript.html#popovers
	// --------------------------------------------------

	/**
	 * Generates a tooltip.
	 * @param string $label the tooltip link label text.
	 * @param mixed $url the link url.
	 * @param string $content the tooltip content text.
	 * @param array $htmlOptions additional HTML attributes.
	 * @return string the generated tooltip.
	 */
	public static function tooltip($label, $url, $content, $htmlOptions = array())
	{
		$htmlOptions['rel'] = 'tooltip';
		return self::tooltipPopover($label, $url, $content, $htmlOptions);
	}

	/**
	 * Generates a popover.
	 * @param string $label the popover link label text.
	 * @param string $title the popover title text.
	 * @param string $content the popover content text.
	 * @param array $htmlOptions additional HTML attributes.
	 * @return string the generated popover.
	 */
	public static function popover($label, $title, $content, $htmlOptions = array())
	{
		$htmlOptions['rel'] = 'popover';
		$htmlOptions = self::defaultOption('data-content', $content, $htmlOptions);
		return self::tooltipPopover($label, '#', $title, $htmlOptions);
	}

	/**
	 * Generates a base tooltip.
	 * @param string $label the tooltip link label text.
	 * @param mixed $url the link url.
	 * @param string $title the tooltip title text.
	 * @param array $htmlOptions additional HTML attributes.
	 * @return string the generated tooltip.
	 */
	protected static function tooltipPopover($label, $url, $title, $htmlOptions)
	{
		$htmlOptions = self::defaultOption('title', $title, $htmlOptions);
		if (self::popOption('animation', $htmlOptions))
			$htmlOptions = self::defaultOption('data-animation', true, $htmlOptions);
		if (self::popOption('html', $htmlOptions))
			$htmlOptions = self::defaultOption('data-html', true, $htmlOptions);
		$placement = self::popOption('placement', $htmlOptions);
		if (isset($placement) && in_array($placement, self::$placements))
			$htmlOptions = self::defaultOption('data-placement', $placement, $htmlOptions);
		if (self::popOption('selector', $htmlOptions))
			$htmlOptions = self::defaultOption('data-selector', true, $htmlOptions);
		$trigger = self::popOption('trigger', $htmlOptions);
		if (isset($trigger) && in_array($trigger, self::$triggers))
			$htmlOptions = self::defaultOption('data-trigger', $trigger, $htmlOptions);
		if (($delay = self::popOption('delay', $htmlOptions)) !== null)
			$htmlOptions = self::defaultOption('data-delay', $delay, $htmlOptions);
		return parent::link($label, $url, $htmlOptions);
	}

	// Carousel
	// http://twitter.github.com/bootstrap/javascript.html#carousel
	// --------------------------------------------------

	/**
	 * Generates an image carousel.
	 * @param array $items the item configurations.
	 * @param array $htmlOptions additional HTML attributes.
	 * @return string the generated carousel.
	 */
	public static function carousel($items, $htmlOptions = array())
	{
		if (is_array($items) && !empty($items))
		{
			$id = self::getOption('id', $htmlOptions, self::getNextId());
			$htmlOptions = self::defaultOption('id', $id, $htmlOptions);
			$selector = '#' . $id;
			$htmlOptions = self::addClassName('carousel', $htmlOptions);
			if (self::popOption('slide', $htmlOptions, true))
				$htmlOptions = self::addClassName('slide', $htmlOptions);
			$interval = self::popOption('data-interval', $htmlOptions);
			if ($interval)
				$htmlOptions = self::defaultOption('data-interval', $interval, $htmlOptions);
			$pause = self::popOption('data-interval', $htmlOptions);
			if ($pause) // todo: add attribute validation if seen necessary.
				$htmlOptions = self::defaultOption('data-pause', $pause, $htmlOptions);
			$innerOptions = self::popOption('innerOptions', $htmlOptions, array());
			$innerOptions = self::addClassName('carousel-inner', $innerOptions);
			$prevOptions = self::popOption('prevOptions', $htmlOptions, array());
			$prevLabel = self::popOption('label', $prevOptions, '&lsaquo;');
			$nextOptions = self::popOption('nextOptions', $htmlOptions, array());
			$nextLabel = self::popOption('label', $nextOptions, '&rsaquo;');
			ob_start();
			echo parent::openTag('div', $htmlOptions) . PHP_EOL;
			echo parent::openTag('div', $innerOptions) . PHP_EOL;
			foreach ($items as $i => $itemOptions)
			{
				$itemOptions = self::addClassName('item', $itemOptions);
				if ($i === 0) // first item should be active
					$itemOptions = self::addClassName('active', $itemOptions);
				$content = self::popOption('content', $itemOptions, '');
				$label = self::popOption('label', $itemOptions);
				$caption = self::popOption('caption', $itemOptions);
				echo self::carouselItem($content, $label, $caption, $itemOptions);
			}
			echo '</div>' . PHP_EOL;
			echo self::carouselPrevLink($prevLabel, $selector, $prevOptions) . PHP_EOL;
			echo self::carouselNextLink($nextLabel, $selector, $nextOptions) . PHP_EOL;
			echo '</div>' . PHP_EOL;
			return ob_get_clean();
		}
		return '';
	}

	/**
	 * Generates a carousel item.
	 * @param string $content the content.
	 * @param string $label the item label text.
	 * @param string $caption the item caption text.
	 * @param array $htmlOptions additional HTML attributes.
	 * @return string the generated item.
	 */
	public static function carouselItem($content, $label, $caption, $htmlOptions = array())
	{
		$overlayOptions = self::popOption('overlayOptions', $htmlOptions, array());
		$overlayOptions = self::addClassName('carousel-caption', $overlayOptions);
		$labelOptions = self::popOption('labelOptions', $htmlOptions, array());
		$captionOptions = self::popOption('captionOptions', $htmlOptions, array());
		ob_start();
		echo parent::openTag('div', $htmlOptions) . PHP_EOL;
		echo $content . PHP_EOL;
		if (isset($label) || isset($caption))
		{
			echo parent::openTag('div', $overlayOptions) . PHP_EOL;
			if ($label)
				echo parent::tag('h4', $labelOptions, $label);
			if ($caption)
				echo parent::tag('p', $captionOptions, $caption);
			echo '</div>' . PHP_EOL;
		}
		echo '</div>' . PHP_EOL;
		return ob_get_clean();
	}

	/**
	 * Generates a previous link for the carousel.
	 * @param string $label the link label text.
	 * @param mixed $url the link url.
	 * @param array $htmlOptions additional HTML attributes.
	 * @return string the generated link.
	 */
	public static function carouselPrevLink($label, $url, $htmlOptions = array())
	{
		$htmlOptions = self::addClassName('carousel-control left', $htmlOptions);
		$htmlOptions = self::defaultOption('data-slide', 'prev', $htmlOptions);
		return parent::link($label, $url, $htmlOptions);
	}

	/**
	 * Generates a next link for the carousel.
	 * @param string $label the link label text.
	 * @param mixed $url the link url.
	 * @param array $htmlOptions additional HTML attributes.
	 * @return string the generated link.
	 */
	public static function carouselNextLink($label, $url, $htmlOptions = array())
	{
		$htmlOptions = self::addClassName('carousel-control right', $htmlOptions);
		$htmlOptions = self::defaultOption('data-slide', 'next', $htmlOptions);
		return parent::link($label, $url, $htmlOptions);
	}

	// UTILITIES
	// --------------------------------------------------

	/**
	 * Appends new class names to the named index "class" at the `$htmlOptions` parameter.
	 * @param mixed $className the class(es) to append to `$htmlOptions`
	 * @param array $htmlOptions the HTML tag attributes to modify
	 * @return array the options.
	 */
	public static function addClassName($className, $htmlOptions)
	{
		if (is_array($className))
			$className = implode(' ', $className);
		$htmlOptions['class'] = isset($htmlOptions['class']) ? $htmlOptions['class'] . ' ' . $className : $className;
		return $htmlOptions;
	}

	/**
	 * Appends a CSS style string to the given options.
	 * @param string $styles the CSS style string.
	 * @param array $htmlOptions the options.
	 * @return array the options.
	 */
	public static function addStyles($styles, $htmlOptions)
	{
		$htmlOptions['style'] = isset($htmlOptions['style']) ? $htmlOptions['style'] . ' ' . $styles : $styles;
		return $htmlOptions;
	}

	/**
	 * Copies the option values from one option array to another.
	 * @param array $names the option names to copy.
	 * @param array $fromOptions the options to copy from.
	 * @param array $options the options to copy to.
	 * @return array the options.
	 */
	public static function copyOptions($names, $fromOptions, $options)
	{
		if (is_array($fromOptions) && is_array($options))
		{
			foreach ($names as $key)
			{
				if (isset($fromOptions[$key]) && !isset($options[$key]))
					$options[$key] = self::getOption($key, $fromOptions);
			}
		}
		return $options;
	}

	/**
	 * Moves the option values from one option array to another.
	 * @param array $names the option names to move.
	 * @param array $fromOptions the options to move from.
	 * @param array $options the options to move to.
	 * @return array the options.
	 */
	public static function moveOptions($names, $fromOptions, $options)
	{
		if (is_array($fromOptions) && is_array($options))
		{
			foreach ($names as $key)
			{
				if (isset($fromOptions[$key]) && !isset($options[$key]))
					$options[$key] = self::popOption($key, $fromOptions);
			}
		}
		return $options;
	}

	/**
	 * Sets multiple default options for the given options array.
	 * @param array $options the options to set defaults for.
	 * @param array $defaults the default options.
	 * @return array the options with default values.
	 */
	public static function defaultOptions($options, $defaults)
	{
		if (is_array($defaults) && is_array($options))
		{
			foreach ($defaults as $name => $value)
				$options = self::defaultOption($name, $value, $options);
		}
		return $options;
	}

	/**
	 * Merges two options arrays.
	 * @param array $a options to be merged to
	 * @param array $b options to be merged from
	 * @return array the merged options.
	 */
	public static function mergeOptions($a, $b)
	{
		return CMap::mergeArray($a, $b); // yeah I know but we might want to change this to be something else later
	}

	/**
	 * Returns an item from the given options or the default value if it's not set.
	 * @param string $name the name of the item.
	 * @param array $options the options to get from.
	 * @param mixed $defaultValue the default value.
	 * @return mixed the value.
	 */
	public static function getOption($name, $options, $defaultValue = null)
	{
		return (is_array($options) && isset($options[$name])) ? $options[$name] : $defaultValue;
	}

	/**
	 * Removes an item from the given options and returns the value.
	 * @param string $name the name of the item.
	 * @param array $options the options to remove the item from.
	 * @param mixed $defaultValue the default value.
	 * @return mixed the value.
	 */
	public static function popOption($name, &$options, $defaultValue = null)
	{
		if (is_array($options))
		{
			$value = self::getOption($name, $options, $defaultValue);
			unset($options[$name]);
			return $value;
		} else
			return $defaultValue;
	}

	/**
	 * Sets the default value for an item in the given options.
	 * @param string $name the name of the item.
	 * @param mixed $value the default value.
	 * @param array $options the options.
	 * @return mixed
	 */
	public static function defaultOption($name, $value, $options)
	{
		if (is_array($options) && !isset($options[$name]))
			$options[$name] = $value;
		return $options;
	}

	/**
	 * Removes the option values from the given options.
	 * @param array $options the options to remove from.
	 * @param array $names names to remove from the options.
	 * @return array the options.
	 */
	public static function removeOptions($options, $names)
	{
		return array_diff_key($options, array_flip($names));
	}

	/**
	 * Returns the next free id.
	 * @return string the id string.
	 */
	public static function getNextId()
	{
		return 'tb' . self::$_counter++;
	}
}
