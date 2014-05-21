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
	 * js widget options
	 * @see <http://www.bootstrap-switch.org/> options part
	 * @var array to contain the widget js options
	 */
	public $options = array();

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

		$config = CJavaScript::encode($this->options);
		
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

}
