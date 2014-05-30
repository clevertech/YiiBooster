<?php
/**
 *##  TbButtonGroup class file.
 *
 * @author Christoffer Niska <ChristofferNiska@gmail.com>
 * @copyright Copyright &copy; Christoffer Niska 2011-
 * @license [New BSD License](http://www.opensource.org/licenses/bsd-license.php) 
 * @since 0.9.10
 * 
 * @author Amr Bedair <amr.bedair@gmail.com>
 * @since v4.0.0 - upgraded to bootstrap 3.1.1
 */

Yii::import('booster.widgets.TbButton');

/**
 *## Bootstrap button group widget.
 *
 * @see <http://twitter.github.com/bootstrap/components.html#buttonGroups>
 *
 * @package booster.widgets.forms.buttons
 */
class TbButtonGroup extends CWidget {
	
	// Toggle options.
	const TOGGLE_CHECKBOX = 'checkbox';
	const TOGGLE_RADIO = 'radio';

	/**
	 * @var string the button callback type.
	 * @see BootButton::buttonType
	 */
	public $buttonType = TbButton::BUTTON_BUTTON;

	/**
	 * @var string the button type.
	 * @see BootButton::type
	 */
	public $context = TbButton::CTX_DEFAULT;
	
	/**
	 * @var boolean indicates whether to use justified button groups
	 */
	public $justified = false;

	/**
	 * @var string the button size.
	 * @see BootButton::size
	 */
	public $size;

	/**
	 * @var boolean indicates whether to encode the button labels.
	 */
	public $encodeLabel = true;

	/**
	 * @var array the HTML attributes for the widget container.
	 */
	public $htmlOptions = array();

	/**
	 * @var array the button configuration.
	 */
	public $buttons = array();

	/**
	 * @var boolean indicates whether to enable button toggling.
	 */
	public $toggle;

	/**
	 * @var boolean indicates whether the button group appears vertically stacked. Defaults to 'false'.
	 */
	public $stacked = false;

	/**
	 * @var boolean indicates whether dropdowns should be dropups instead. Defaults to 'false'.
	 */
	public $dropup = false;
	/**
	 * @var boolean indicates whether button is disabled or not. Defaults to 'false'.
	 */
	public $disabled = false;

	/**
	 *### .init()
	 *
	 * Initializes the widget.
	 */
	public function init() {
		
		$classes = [];
		
		if ($this->stacked === true) {
			$classes[] = 'btn-group-vertical';
		} else {
			$classes[] = 'btn-group';
		}

		if ($this->dropup === true) {
			$classes[] = 'dropup';
		}
		
		if ($this->justified === true) {
			$classes[] = 'btn-group-justified';
		}

		if (!empty($classes)) {
			$classes = implode(' ', $classes);
			if (isset($this->htmlOptions['class'])) {
				$this->htmlOptions['class'] .= ' ' . $classes;
			} else {
				$this->htmlOptions['class'] = $classes;
			}
		}

		$validToggles = array(self::TOGGLE_CHECKBOX, self::TOGGLE_RADIO);

		if (isset($this->toggle) && in_array($this->toggle, $validToggles)) {
			$this->htmlOptions['data-toggle'] = 'buttons';
		}
	}

	/**
	 *### .run()
	 *
	 * Runs the widget.
	 */
	public function run() {
		
		echo CHtml::openTag('div', $this->htmlOptions);

		foreach ($this->buttons as $button) {
			if (isset($button['visible']) && $button['visible'] === false) {
				continue;
			}
			
			$validToggles = array(self::TOGGLE_CHECKBOX, self::TOGGLE_RADIO);
			if (isset($this->toggle) && in_array($this->toggle, $validToggles)) {
				$this->buttonType = $this->toggle;
			}
			
			$justifiedNotLink = $this->justified && $this->buttonType !== TbButton::BUTTON_LINK;
			if($justifiedNotLink)
				echo '<div class="btn-group">';
			
			$this->controller->widget(
				'booster.widgets.TbButton',
				array(
					'buttonType' => isset($button['buttonType']) ? $button['buttonType'] : $this->buttonType,
					'context' => isset($button['context']) ? $button['context'] : $this->context,
					'size' => $this->size, // all buttons in a group cannot vary in size
					'icon' => isset($button['icon']) ? $button['icon'] : null,
					'label' => isset($button['label']) ? $button['label'] : null,
					'url' => isset($button['url']) ? $button['url'] : null,
					'active' => isset($button['active']) ? $button['active'] : false,
					'disabled' => isset($button['disabled']) ? $button['disabled'] : false,
					'items' => isset($button['items']) ? $button['items'] : array(),
					'ajaxOptions' => isset($button['ajaxOptions']) ? $button['ajaxOptions'] : array(),
					'htmlOptions' => isset($button['htmlOptions']) ? $button['htmlOptions'] : array(),
					'dropdownOptions' => isset($button['dropdownOptions']) ? $button['dropdownOptions'] : array(),
					'encodeLabel' => isset($button['encodeLabel']) ? $button['encodeLabel'] : $this->encodeLabel,
                    'tooltip' => isset($button['tooltip']) ? $button['tooltip'] : false,
                    'tooltipOptions' => isset($button['tooltipOptions']) ? $button['tooltipOptions'] : array(),
				)
			);
			
			if($justifiedNotLink)
				echo '</div>';
		}
		echo '</div>';
	}
}
