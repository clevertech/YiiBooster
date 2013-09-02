<?php
require_once(__DIR__.'/../fakes/SelectableControlModel.php');
require_once(__DIR__.'/../fakes/FakeController.php');
require_once(__DIR__.'/../../src/widgets/TbActiveForm.php');

class TbActiveFormSelectableControlsTest extends PHPUnit_Framework_TestCase
{
	private $_model;
	public function setUp()
	{
		$controller = new FakeController('fake');
		Yii::app()->setController($controller);

		$this->_model = new SelectableControlModel();
	}

	private function _makeWidget($type)
	{
		$widget = new TbActiveForm();
		$widget->type = $type;
		return $widget;
	}


	public function testSelectableInputs()
	{
		/**
		 * Vertical form
		 */
		$formVertical = $this->_makeWidget(TbActiveForm::TYPE_VERTICAL);

		// Checkbox row with hidden field
		$checkbox = $formVertical->checkBoxRow($this->_model, 'selectableField');

		$actualHtml = new DOMDocument();
		$actualHtml->loadHTML($checkbox);
		$expectedHtml = new DOMDocument();
		$expectedHtml->loadHTML('<input id="ytSelectableControlModel_selectableField" type="hidden" value="0" name="SelectableControlModel[selectableField]" />'.PHP_EOL.'<label class="checkbox" for="SelectableControlModel_selectableField"><input name="SelectableControlModel[selectableField]" id="SelectableControlModel_selectableField" value="1" type="checkbox" />'.PHP_EOL.'Selectable Field</label>');
		$this->assertEquals($expectedHtml, $actualHtml);

		// RadioButton row with hidden field
		$radioButton = $formVertical->radioButtonRow($this->_model, 'selectableField');

		$actualHtml = new DOMDocument();
		$actualHtml->loadHTML($radioButton);
		$expectedHtml = new DOMDocument();
		$expectedHtml->loadHTML('<input id="ytSelectableControlModel_selectableField" type="hidden" value="0" name="SelectableControlModel[selectableField]" />'.PHP_EOL.'<label class="radio" for="SelectableControlModel_selectableField"><input name="SelectableControlModel[selectableField]" id="SelectableControlModel_selectableField" value="1" type="radio" />'.PHP_EOL.'Selectable Field</label>');
		$this->assertEquals($expectedHtml, $actualHtml);

		// Checkbox row without hidden field
		$checkbox = $formVertical->checkBoxRow($this->_model, 'selectableField', array('uncheckValue' => null));

		$actualHtml = new DOMDocument();
		$actualHtml->loadHTML($checkbox);
		$expectedHtml = new DOMDocument();
		$expectedHtml->loadHTML('<label class="checkbox" for="SelectableControlModel_selectableField"><input name="SelectableControlModel[selectableField]" id="SelectableControlModel_selectableField" value="1" type="checkbox" />'.PHP_EOL.'Selectable Field</label>');
		$this->assertEquals($expectedHtml, $actualHtml);

		// RadioButton row without hidden field
		$radioButton = $formVertical->radioButtonRow($this->_model, 'selectableField', array('uncheckValue' => null));

		$actualHtml = new DOMDocument();
		$actualHtml->loadHTML($radioButton);
		$expectedHtml = new DOMDocument();
		$expectedHtml->loadHTML('<label class="radio" for="SelectableControlModel_selectableField"><input name="SelectableControlModel[selectableField]" id="SelectableControlModel_selectableField" value="1" type="radio" />'.PHP_EOL.'Selectable Field</label>');
		$this->assertEquals($expectedHtml, $actualHtml);

		/**
		 * Horizontal form
		 */
		$formHorizontal = $this->_makeWidget(TbActiveForm::TYPE_HORIZONTAL);

		// Checkbox row with hidden field
		$checkbox = $formHorizontal->checkBoxRow($this->_model, 'selectableField');

		$actualHtml = new DOMDocument();
		$actualHtml->loadHTML($checkbox);
		$expectedHtml = new DOMDocument();
		$expectedHtml->loadHTML('<div class="control-group "><div class="controls"><input id="ytSelectableControlModel_selectableField" type="hidden" value="0" name="SelectableControlModel[selectableField]" />'.PHP_EOL.'<label class="checkbox" for="SelectableControlModel_selectableField"><input name="SelectableControlModel[selectableField]" id="SelectableControlModel_selectableField" value="1" type="checkbox" />'.PHP_EOL.'Selectable Field</label></div></div>');
		$this->assertEquals($expectedHtml, $actualHtml);

		// RadioButton row with hidden field
		$radioButton = $formHorizontal->radioButtonRow($this->_model, 'selectableField');

		$actualHtml = new DOMDocument();
		$actualHtml->loadHTML($radioButton);
		$expectedHtml = new DOMDocument();
		$expectedHtml->loadHTML('<div class="control-group "><div class="controls"><input id="ytSelectableControlModel_selectableField" type="hidden" value="0" name="SelectableControlModel[selectableField]" />'.PHP_EOL.'<label class="radio" for="SelectableControlModel_selectableField"><input name="SelectableControlModel[selectableField]" id="SelectableControlModel_selectableField" value="1" type="radio" />'.PHP_EOL.'Selectable Field</label></div></div>');
		$this->assertEquals($expectedHtml, $actualHtml);

		// Checkbox row without hidden field
		$control = $formHorizontal->checkBoxRow($this->_model, 'selectableField', array('uncheckValue' => null));

		$actualHtml = new DOMDocument();
		$actualHtml->loadHTML($control);
		$expectedHtml = new DOMDocument();
		$expectedHtml->loadHTML('<div class="control-group "><div class="controls"><label class="checkbox" for="SelectableControlModel_selectableField"><input name="SelectableControlModel[selectableField]" id="SelectableControlModel_selectableField" value="1" type="checkbox" />'.PHP_EOL.'Selectable Field</label></div></div>');
		$this->assertEquals($expectedHtml, $actualHtml);

		// RadioButton row without hidden field
		$radioButton = $formHorizontal->radioButtonRow($this->_model, 'selectableField', array('uncheckValue' => null));

		$actualHtml = new DOMDocument();
		$actualHtml->loadHTML($radioButton);
		$expectedHtml = new DOMDocument();
		$expectedHtml->loadHTML('<div class="control-group "><div class="controls"><label class="radio" for="SelectableControlModel_selectableField"><input name="SelectableControlModel[selectableField]" id="SelectableControlModel_selectableField" value="1" type="radio" />'.PHP_EOL.'Selectable Field</label></div></div>');
		$this->assertEquals($expectedHtml, $actualHtml);
	}
}