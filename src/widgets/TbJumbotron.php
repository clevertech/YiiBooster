<?php
/**
 *## TbJumbotron class file.
 *
 * @author Amr Bedair <amr.bedair@gmail.com>
 * @license [New BSD License](http://www.opensource.org/licenses/bsd-license.php)
 * @since 4.0.0
 */

/**
 *## Class TbJumbotron
 *
 * wrapper to the bootstrap Jumbotron component 
 *
 * @package booster.widgets.decoration
 */
class TbJumbotron extends CWidget {
	/**
	 * @var string the heading text.
	 */
	public $heading;

	/**
	 * @var boolean indicates whether to encode the heading.
	 */
	public $encodeHeading = true;

	/**
	 * @var array the HTML attributes for the widget container.
	 */
	public $htmlOptions = array();

	/**
	 * @var array the HTML attributes for the heading element.
	 * @since 1.0.0
	 */
	public $headingOptions = array();

	/**
	 *### .init()
	 *
	 * Initializes the widget.
	 */
	public function init()
	{
		if (isset($this->htmlOptions['class'])) {
			$this->htmlOptions['class'] .= ' jumbotron';
		} else {
			$this->htmlOptions['class'] = 'jumbotron';
		}

		echo CHtml::openTag('div', $this->htmlOptions);

		if ($this->encodeHeading) {
			$this->heading = CHtml::encode($this->heading);
		}

		if (isset($this->heading)) {
			echo CHtml::tag('h1', $this->headingOptions, $this->heading);
		}
	}

	/**
	 *### .run()
	 *
	 * Runs the widget.
	 */
	public function run()
	{
		echo CHtml::closeTag('div');
	}
}
