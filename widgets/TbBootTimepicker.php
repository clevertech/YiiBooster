<?php
/**
 * TbBootDatepicker class file.
 * @author Sam Stenvall <sam.stenvall@arcada.fi>
 * @author Christoffer Niska <ChristofferNiska@gmail.com>
 * @copyright Copyright &copy; Christoffer Niska 2012-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 * @package bootstrap.widgets
 * @since 0.10.0
 */

/**
 * TbBootstrap datepicker widget.
 */
class TbBootTimepicker extends CInputWidget
{
	public $form;

	/**
	 * @var array the options for the Bootstrap JavaScript plugin.
	 */
	public $options = array();

	/**
	 * @var string[] the JavaScript event handlers.
	 */
	public $events = array();

	/**
	 * @var array the HTML attributes for the widget container.
	 */
	public $htmlOptions = array();

	/**
	 * Initializes the widget.
	 */
	public function init()
	{
		$this->htmlOptions['type'] = 'text';

		if (!isset($this->options['template']))
			$this->options['template'] = 'dropdown';

		Yii::app()->bootstrap->registerTimepicker();
	}

	/**
	 * Runs the widget.
	 */
	public function run()
	{
		list($name, $id) = $this->resolveNameID();

		if ($this->hasModel())
		{
			echo $this->form->textField($this->model, $this->attribute, $this->htmlOptions);
		} else
			echo CHtml::textField($name, $this->value, $this->htmlOptions);

		$options = !empty($this->options) ? CJavaScript::encode($this->options) : '';

		ob_start();

		echo "jQuery('#{$id}').timepicker({$options})";
		foreach ($this->events as $event => $handler)
			echo ".on('{$event}', " . CJavaScript::encode($handler) . ")";

		Yii::app()->getClientScript()->registerScript(__CLASS__ . '#' . $id, ob_get_clean() . ';');
	}
}