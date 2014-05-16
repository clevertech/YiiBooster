<?php
/**
 *## TbLabel class file.
 *
 * @author Christoffer Niska <ChristofferNiska@gmail.com>
 * @copyright  Copyright &copy; Christoffer Niska 2011-
 * @license [New BSD License](http://www.opensource.org/licenses/bsd-license.php)
 */

/**
 *## Bootstrap label widget.
 *
 * @see <http://twitter.github.com/bootstrap/components.html#labels>
 *
 * @package booster.widgets.decoration
 */
class TbLabel extends CWidget {
	// 'default', 'primary', 'success', 'info', 'warning', 'danger '
	const TYPE_DEFAULT 	= 'default';
	const TYPE_PRIMARY	= 'primary';
	const TYPE_SUCCESS 	= 'success';
	const TYPE_INFO 	= 'info';
	const TYPE_WARNING 	= 'warning';
	const TYPE_DANGER 	= 'danger';

	/**
	 * @var string the label type.
	 *
     * See `TYPE_*` constants for list of allowed types.
	 */
	public $type = self::TYPE_DEFAULT;

	/**
	 * @var string the label text.
	 */
	public $label;

	/**
	 * @var boolean whether to encode the label.
	 */
	public $encodeLabel = true;

	/**
	 * @var array the HTML attributes for the widget container.
	 */
	public $htmlOptions = array();

	/**
	 *### .init()
	 *
     * At the start of widget we collect the attributes for badge tag.
	 */
	public function init() {
		
		$classes = array('label');

		$validTypes = array(
			self::TYPE_DEFAULT,
			self::TYPE_PRIMARY,
			self::TYPE_SUCCESS,
			self::TYPE_INFO,
			self::TYPE_WARNING,
			self::TYPE_DANGER,
		);

		if (isset($this->type) && in_array($this->type, $validTypes)) {
			$classes[] = 'label-' . $this->type;
		}

		if (!empty($classes)) {
			$classes = implode(' ', $classes);
			if (isset($this->htmlOptions['class'])) {
				$this->htmlOptions['class'] .= ' ' . $classes;
			} else {
				$this->htmlOptions['class'] = $classes;
			}
		}

		if ($this->encodeLabel === true) {
			$this->label = CHtml::encode($this->label);
		}
	}

	/**
	 *### .run()
	 *
     * Upon completing the badge we write the span tag with collected attributes to document.
	 */
	public function run() {
		
		echo CHtml::tag('span', $this->htmlOptions, $this->label);
	}
}
