<?php
/**
 *##  TbSelect2 class file.
 *
 * @author Antonio Ramirez <antonio@clevertech.biz>
 * @copyright Copyright &copy; Clevertech 2012-
 * @license [New BSD License](http://www.opensource.org/licenses/bsd-license.php)
 */

/**
 *## Select2 wrapper widget
 *
 * @see http://ivaynberg.github.io/select2/
 *
 * @package booster.widgets.forms.inputs
 */
class TbSelect2 extends CInputWidget
{
	/**
	 * @var TbActiveForm when created via TbActiveForm.
	 * This attribute is set to the form that renders the widget
	 * @see TbActionForm->inputRow
	 */
	public $form;

	/**
	 * @var array widget options
	 */
	public $widgetOptions= array();

	/**
	 *### .init()
	 *
	 * Initializes the widget.
	 */
	public function init()
	{
		$this->widgetOptions['asDropDownList']= isset($this->widgetOptions['asDropDownList']) ? $this->widgetOptions['asDropDownList'] : true;		
		$this->widgetOptions['data']= isset($this->widgetOptions['data']) ? $this->widgetOptions['data'] : array();
		$this->widgetOptions['options']= isset($this->widgetOptions['options']) ? $this->widgetOptions['options'] : array();				
		$this->widgetOptions['events']= isset($this->widgetOptions['events']) ? $this->widgetOptions['events'] : array();

		if (empty($this->widgetOptions['data']) && $this->widgetOptions['asDropDownList'] === true) {
			throw new CException(Yii::t('zii', '"data" attribute cannot be blank'));
		}

		$this->setDefaultWidthIfEmpty();
	}

	/**
	 *### .run()
	 *
	 * Runs the widget.
	 */
	public function run()
	{
		list($name, $id) = $this->resolveNameID();

		if ($this->hasModel()) {
			if ($this->form) {
				echo $this->widgetOptions['asDropDownList']
					?
					$this->form->dropDownList($this->model, $this->attribute, $this->widgetOptions['data'], $this->htmlOptions)
					:
					$this->form->hiddenField($this->model, $this->attribute, $this->htmlOptions);
			} else {
				echo $this->widgetOptions['asDropDownList']
					?
					CHtml::activeDropDownList($this->model, $this->attribute, $this->widgetOptions['data'], $this->htmlOptions)
					:
					CHtml::activeHiddenField($this->model, $this->attribute, $this->htmlOptions);
			}

		} else {
			echo $this->widgetOptions['asDropDownList']
				?
				CHtml::dropDownList($name, $this->value, $this->widgetOptions['data'], $this->htmlOptions)
				:
				CHtml::hiddenField($name, $this->value, $this->htmlOptions);
		}

		$this->registerClientScript($id);
	}

	/**
	 *### .registerClientScript()
	 *
	 * Registers required client script for bootstrap select2. It is not used through bootstrap->registerPlugin
	 * in order to attach events if any
	 */
	public function registerClientScript($id)
	{
		Yii::app()->bootstrap->registerPackage('select2');

		$options = !empty($this->widgetOptions['options']) ? CJavaScript::encode($this->widgetOptions['options']) : '';

		$defValue = !empty($this->widgetOptions['val']) ? ".select2('val', '$this->widgetOptions['val']')" : '';

		ob_start();
		echo "jQuery('#{$id}').select2({$options})$defValue";
		foreach ($this->widgetOptions['events'] as $event => $handler) {
			echo ".on('{$event}', " . CJavaScript::encode($handler) . ")";
		}

		Yii::app()->getClientScript()->registerScript(__CLASS__ . '#' . $this->getId(), ob_get_clean() . ';');
	}

	private function setDefaultWidthIfEmpty()
	{
		if (!is_array($this->widgetOptions['options'])) {
			$this->options = array();
		}

		if (empty($this->widgetOptions['options']['width'])) {
			$this->widgetOptions['options']['width'] = 'resolve';
		}
	}
}
