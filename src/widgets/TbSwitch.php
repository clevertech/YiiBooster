<?php
/**
 *## TbToggleButton class file
 *
 * @author: amr bedair <amr.bedair@gmail.com>
 */

/**
 *## Class TbToggleButton
 * @see <http://www.bootstrap-switch.org/>
 * @package booster.widgets.forms.buttons
 * 
 * TODO: review all options of this widget
 */
class TbSwitch extends CInputWidget {
	
	/**
	 * @var TbActiveForm when created via TbActiveForm, this attribute is set to the form that renders the widget
	 * @see TbActionForm->inputRow
	 */
	public $form;

	/**
	 * @var array the javascript events
	 *
	 * Example:
	 * <pre>
	 *  'events'=>array(
	 * 		'switchChange'=>'js:function(event, state) {
	 *			console.log(this); // DOM element
	 *			console.log(event); // jQuery event
	 *			console.log(state); // true | false
 	 *		}'
	 *	)
	 * </pre>
	 */
	public $events = array();

	/**
	 * @var int the width of the toggle button
	 */
	public $width = 100;

	/**
	 * @var int the height of the toggle button
	 */
	public $height = 25;

	/**
	 * @var bool whether to use animation or not
	 */
	public $animated = true;

	/**
	 * @var mixed the transition speed (toggle movement)
	 */
	public $transitionSpeed; //accepted values: float or percent [1, 0.5, '150%']

	/**
	 * @var string the label to display on the enabled side
	 */
	public $enabledLabel = 'ON';

	/**
	 * @var string the label to display on the disabled side
	 */
	public $disabledLabel = 'OFF';

	/**
	 * @var string the style of the toggle button enable style
	 * Accepted values ["primary", "danger", "info", "success", "warning"] or nothing
	 */
	public $enabledStyle = 'primary';

	/**
	 * @var string the style of the toggle button disabled style
	 * Accepted values ["primary", "danger", "info", "success", "warning"] or nothing
	 */
	public $disabledStyle = null;

	/**
	 * @var array a custom style for the enabled option. Format
	 * <pre>
	 *  ...
	 *  'customEnabledStyle'=>array(
	 *      'background'=>'#FF00FF',
	 *      'gradient'=>'#D300D3',
	 *      'color'=>'#FFFFFF'
	 *  ),
	 *  ...
	 * </pre>
	 */
	public $customEnabledStyle = array();

	/**
	 * @var array a custom style for the disabled option. Format
	 * <pre>
	 *  ...
	 *  'customDisabledStyle'=>array(
	 *      'background'=>'#FF00FF',
	 *      'gradient'=>'#D300D3',
	 *      'color'=>'#FFFFFF'
	 *  ),
	 *  ...
	 * </pre>
	 */
	public $customDisabledStyle = array();

	/**
	 * Widget's run function
	 */
	public function run() {
		
		list($name, $id) = $this->resolveNameID();

		if ($this->hasModel()) {
			if ($this->form) {
				echo $this->form->checkBox($this->model, $this->attribute, $this->htmlOptions);
			} else {
				echo CHtml::activeCheckBox($this->model, $this->attribute, $this->htmlOptions);
			}
		} else {
			echo CHtml::checkBox($name, $this->value, $this->htmlOptions);
		}

		$this->registerClientScript($id);
	}

	/**
	 * Registers required css and js files
	 *
	 * @param integer $id the id of the toggle button
	 */
	protected function registerClientScript($id) {

        $booster = Booster::getBooster();
        $booster->registerPackage('switch');

		$config = CJavaScript::encode($this->getConfiguration());
		
		ob_start();
		echo "$('#$id').bootstrapSwitch({$config})";
		foreach ($this->events as $event => $handler) {
			$event = $event.'.bootstrapSwitch';
			if (!$handler instanceof CJavaScriptExpression && strpos($handler, 'js:') === 0)
				$handler = new CJavaScriptExpression($handler);
			echo ".on('{$event}', " . $handler . ")";
		}

		Yii::app()->clientScript->registerScript(__CLASS__ . '#' . $this->getId(), ob_get_clean() . ';');
	}

	/**
	 * @return array the configuration of the plugin
	 */
	protected function getConfiguration() {
		
		$config = array(
			'width' => $this->width,
			'height' => $this->height,
			'animated' => $this->animated,
			'transitionSpeed' => $this->transitionSpeed,
			'label' => array(
				'enabled' => $this->enabledLabel,
				'disabled' => $this->disabledLabel
			),
			'style' => array()
		);
		if (!empty($this->enabledStyle)) {
			$config['style']['enabled'] = $this->enabledStyle;
		}
		if (!empty($this->disabledStyle)) {
			$config['style']['disabled'] = $this->disabledStyle;
		}
		if (!empty($this->customEnabledStyle)) {
			$config['style']['custom'] = array('enabled' => $this->customEnabledStyle);
		}
		if (!empty($this->customDisabledStyle)) {
			if (isset($config['style']['custom'])) {
				$config['style']['custom']['disabled'] = $this->customDisabledStyle;
			} else {
				$config['style']['custom'] = array('disabled' => $this->customDisabledStyle);
			}
		}
		foreach ($config as $key => $element) {
			if (empty($element)) {
				unset($config[$key]);
			}
		}
		return $config;
	}
}
