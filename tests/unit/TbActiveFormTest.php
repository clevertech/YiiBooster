<?php
/**
 * YiiBooster project.
 * @license [New BSD License](http://www.opensource.org/licenses/bsd-license.php)
 */

require_once(__DIR__ . '/../../src/widgets/TbActiveForm.php');
require_once(__DIR__ . '/../fakes/FakeController.php');

class TbActiveForm2Test extends PHPUnit_Framework_TestCase
{
	const WIDGET_CLASS = 'TbActiveForm';

	public function setUp()
	{
		$_SERVER['REQUEST_URI'] = 'test';
		$controller = new FakeController('fake');
		Yii::app()->setController($controller);
	}

	/**
	 * @return TbActiveForm
	 */
	protected function makeWidget()
	{
		$className = self::WIDGET_CLASS;
		return new $className();
	}

	public function testParentClass()
	{
		$this->assertInstanceOf('CActiveForm', $this->makeWidget());
	}

	public function testAddCssClass()
	{
		$form = $this->makeWidget();
		$method = new ReflectionMethod($form, 'addCssClass');
		$method->setAccessible(true);

		// do nothing on empty class
		$htmlOptions = array();
		$method->invokeArgs(null, array(&$htmlOptions, ''));
		$this->assertArrayNotHasKey('class', $htmlOptions);

		// new class in options
		$htmlOptions = array();
		$method->invokeArgs(null, array(&$htmlOptions, 'foobar'));
		$this->assertArrayHasKey('class', $htmlOptions);
		$this->assertEquals('foobar', $htmlOptions['class']);

		// class already exists and text prepended
		$htmlOptions = array('class' => 'foo');
		$method->invokeArgs(null, array(&$htmlOptions, 'bar'));
		$this->assertArrayHasKey('class', $htmlOptions);
		$this->assertEquals('foo bar', $htmlOptions['class']);
	}

	public function testInitCallParentInit()
	{
		// parent init call
		$form = $this->makeWidget();
		ob_start();
		$form->init();
		$data = ob_get_clean();
		$this->assertStringStartsWith('<form', $data);
	}

	public function testConstantsAndDefaults()
	{
		$className = self::WIDGET_CLASS;

		$this->assertEquals($className::TYPE_HORIZONTAL, 'horizontal');
		$this->assertEquals($className::TYPE_VERTICAL, 'vertical');
		$this->assertEquals($className::TYPE_INLINE, 'inline');
		$this->assertEquals($className::TYPE_SEARCH, 'search');

		$form = $this->makeWidget();
		$this->assertAttributeEquals('vertical', 'type', $form);
		$this->assertAttributeEquals(null, 'inlineErrors', $form);
		$this->assertAttributeEquals('input-prepend', 'prependCssClass', $form);
		$this->assertAttributeEquals('input-append', 'appendCssClass', $form);
		$this->assertAttributeEquals('add-on', 'addOnCssClass', $form);
		$this->assertAttributeEquals('span', 'addOnTag', $form);
		$this->assertAttributeEquals('div', 'addOnWrapperTag', $form);
		$this->assertAttributeEquals('help-block', 'hintCssClass', $form);
		$this->assertAttributeEquals('p', 'hintTag', $form);
	}

	public function testInitFormClass()
	{
		$form = $this->makeWidget();
		$form->type = 'horizontal';
		ob_start();
		$form->init();
		ob_clean();
		$this->assertEquals($form->htmlOptions['class'], 'form-' . $form->type);
	}

	public function testInitInlineErrorsFlag()
	{
		$form = $this->makeWidget();
		$form->type = 'horizontal';
		ob_start();
		$form->init();
		ob_clean();
		$this->assertAttributeEquals(true, 'inlineErrors', $form);

		$form = $this->makeWidget();
		$form->type = 'vertical';
		ob_start();
		$form->init();
		ob_clean();
		$this->assertAttributeEquals(false, 'inlineErrors', $form);

		$form = $this->makeWidget();
		$form->inlineErrors = 999;
		ob_start();
		$form->init();
		ob_clean();
		$this->assertAttributeEquals(999, 'inlineErrors', $form);
	}

	public function testInitErrorMessageCssClass()
	{
		$form = $this->makeWidget();
		$form->inlineErrors = true;
		ob_start();
		$form->init();
		ob_clean();
		$this->assertAttributeEquals('help-inline error', 'errorMessageCssClass', $form);

		$form = $this->makeWidget();
		$form->inlineErrors = false;
		ob_start();
		$form->init();
		ob_clean();
		$this->assertAttributeEquals('help-block error', 'errorMessageCssClass', $form);

		$form = $this->makeWidget();
		$form->errorMessageCssClass = 'foo bar';
		ob_start();
		$form->init();
		ob_clean();
		$this->assertAttributeEquals('foo bar', 'errorMessageCssClass', $form);
	}

	public function testInitClientOptions()
	{
		$form = $this->makeWidget();
		$form->type = 'horizontal';
		ob_start();
		$form->init();
		ob_clean();
		$this->assertEquals('div.control-group', $form->clientOptions['inputContainer']);

		$form = $this->makeWidget();
		$form->type = 'horizontal';
		$form->clientOptions['inputContainer'] = 'foobar';
		ob_start();
		$form->init();
		ob_clean();
		$this->assertEquals('foobar', $form->clientOptions['inputContainer']);

		$form = $this->makeWidget();
		$form->type = 'vertical';
		ob_start();
		$form->init();
		ob_clean();
		$this->assertArrayNotHasKey('inputContainer', $form->clientOptions);
	}

	public function testInitRowOptions()
	{
		$form = $this->makeWidget();
		$form->type = 'inline';
		$method = new ReflectionMethod($form, 'initRowOptions');
		$method->setAccessible(true);

		$options = array();
		$model = new FakeModel();
		$attribute = 'password';

		$method->invokeArgs($form, array(&$options, &$model, &$attribute));
		$this->assertArrayHasKey('labelOptions', $options);
		$this->assertInternalType('array', $options['labelOptions']);
		$this->assertArrayHasKey('errorOptions', $options);
		$this->assertInternalType('array', $options['errorOptions']);
		$this->assertArrayHasKey('prependOptions', $options);
		$this->assertInternalType('array', $options['prependOptions']);
		$this->assertArrayHasKey('prepend', $options);
		$this->assertInternalType('null', $options['prepend']);
		$this->assertArrayHasKey('appendOptions', $options);
		$this->assertInternalType('array', $options['appendOptions']);
		$this->assertArrayHasKey('append', $options);
		$this->assertInternalType('null', $options['append']);
	}

	public function testRenderAddOnBegin()
	{
		$form = $this->makeWidget();
		$method = new ReflectionMethod($form, 'renderAddOnBegin');
		$method->setAccessible(true);

		ob_start();
		$method->invokeArgs($form, array('foo', 'bar', array('class' => 'foobar')));
		$actual = new DOMDocument();
		$actual->loadHTML(ob_get_clean() . "</{$form->addOnWrapperTag}>");
		$addonWrapper = $actual->documentElement->getElementsByTagName($form->addOnWrapperTag)->item(0);
		$this->assertContains($form->prependCssClass, $addonWrapper->attributes->getNamedItem('class')->nodeValue);
		$this->assertContains($form->appendCssClass, $addonWrapper->attributes->getNamedItem('class')->nodeValue);
		$addon = $actual->documentElement->getElementsByTagName($form->addOnTag)->item(0);
		$this->assertEquals('foo', $addon->nodeValue);
		$this->assertContains('add-on', $addon->attributes->getNamedItem('class')->nodeValue);
		$this->assertContains('foobar', $addon->attributes->getNamedItem('class')->nodeValue);

		ob_start();
		$method->invokeArgs($form, array('foobar', '', array('isRaw' => true)));
		$actual = new DOMDocument();
		$actual->loadHTML(ob_get_clean() . "</{$form->addOnWrapperTag}>");
		$addonWrapper = $actual->documentElement->getElementsByTagName($form->addOnWrapperTag)->item(0);
		$this->assertEquals('foobar', $addonWrapper->nodeValue);
	}

	public function testRenderAddOnEnd()
	{
		$form = $this->makeWidget();
		$method = new ReflectionMethod($form, 'renderAddOnEnd');
		$method->setAccessible(true);

		ob_start();
		$method->invokeArgs($form, array('foo', array('class' => 'foobar')));
		$actual = new DOMDocument();
		$actual->loadHTML("<{$form->addOnWrapperTag}>" . ob_get_clean());
		$addon = $actual->documentElement->getElementsByTagName($form->addOnTag)->item(0);
		$this->assertContains('add-on', $addon->attributes->getNamedItem('class')->nodeValue);
		$this->assertContains('foobar', $addon->attributes->getNamedItem('class')->nodeValue);
		$this->assertEquals('foo', $addon->nodeValue);

		ob_start();
		$method->invokeArgs($form, array('foobar', array('isRaw' => true)));
		$actual = new DOMDocument();
		$actual->loadHTML("<{$form->addOnWrapperTag}>" . ob_get_clean());
		$addonWrapper = $actual->documentElement->getElementsByTagName($form->addOnWrapperTag)->item(0);
		$this->assertEquals('foobar', $addonWrapper->nodeValue);
	}

	/**
	 * @dataProvider  dataProviderStandardRows
	 */
	public function testStandardRows($outerMethod, $innerMethod)
	{
		$model = new FakeModel();
		$attribute = 'foobar';

		$mock = $this->getMock(self::WIDGET_CLASS, array($innerMethod));
		$mock->expects($this->once())->method($innerMethod);
		$mock->$outerMethod($model, $attribute, array());
	}

	public function dataProviderStandardRows()
	{
		return array(
			array('urlFieldRow', 'urlField'),
			array('emailFieldRow', 'emailField'),
			array('numberFieldRow', 'numberField'),
			array('rangeFieldRow', 'rangeField'),
			array('dateFieldRow', 'dateField'),
			array('timeFieldRow', 'timeField'),
			array('telFieldRow', 'telField'),
			array('textFieldRow', 'textField'),
			array('searchFieldRow', 'searchField'),
			array('passwordFieldRow', 'passwordField'),
			array('textAreaRow', 'textArea'),
			array('fileFieldRow', 'fileField'),
			array('radioButtonRow', 'radioButton'),
			array('checkBoxRow', 'checkBox'),
			array('dropDownListRow', 'dropDownList'),
			array('listBoxRow', 'listBox'),
			array('checkBoxListRow', 'checkBoxList'),
			array('radioButtonListRow', 'radioButtonList'),
		);
	}

	/**
	 * @dataProvider dataProviderWidgetRows
	 */
	public function testWidgetRows($outerMethod, $className)
	{
		$model = new FakeModel();
		$attribute = 'foobar';

		$mock = $this->getMock(self::WIDGET_CLASS, array('widgetRowInternal'));
		$mock->expects($this->once())->method('widgetRowInternal')->with($className, $this->anything(),
			$this->anything(), $this->anything(), $this->anything());
		$mock->$outerMethod($model, $attribute, array());
	}

	public function dataProviderWidgetRows()
	{
		return array(
			array('toggleButtonRow', 'bootstrap.widgets.TbToggleButton'),
			array('datePickerRow', 'bootstrap.widgets.TbDatePicker'),
			array('dateRangeRow', 'bootstrap.widgets.TbDateRangePicker'),
			array('timePickerRow', 'bootstrap.widgets.TbTimePicker'),
			array('dateTimePickerRow', 'bootstrap.widgets.TbDateTimePicker'),
			array('select2Row', 'bootstrap.widgets.TbSelect2'),
			array('redactorRow', 'bootstrap.widgets.TbRedactorJs'),
			array('html5EditorRow', 'bootstrap.widgets.TbHtml5Editor'),
			//array('markdownEditorRow', 'bootstrap.widgets.TbMarkdownEditorJs'),
			array('ckEditorRow', 'bootstrap.widgets.TbCKEditor'),
			array('typeAheadRow', 'bootstrap.widgets.TbTypeahead'),
			array('maskedTextFieldRow', 'CMaskedTextField'),
			array('colorPickerRow', 'bootstrap.widgets.TbColorPicker'),
			array('passFieldRow', 'bootstrap.widgets.TbPassfield'),
		);
	}

	public function testRadioButtonRow()
	{
		$model = new FakeModel();
		$form = $this->makeWidget();

		$data = $form->radioButtonRow($model, 'login', array('class' => 'foobar'), array('labelOptions' => array('class' => 'foo')));
		$doc = new DOMDocument();
		$doc->loadHTML($data);
		$actual = new DOMXPath($doc);
		$mathches = $actual->query('//input[@type="hidden"]/following-sibling::label[contains(@class, "radio") and contains(@class, "foo")]/input[@type = "radio" and @class = "foobar"]');
		$this->assertEquals(1, $mathches->length);
	}

	public function testCheckBoxRow()
	{
		$model = new FakeModel();
		$form = $this->makeWidget();

		$data = $form->checkBoxRow($model, 'login', array('class' => 'foobar'), array('labelOptions' => array('class' => 'foo')));
		$doc = new DOMDocument();
		$doc->loadHTML($data);
		$actual = new DOMXPath($doc);
		$mathches = $actual->query('//input[@type="hidden"]/following-sibling::label[contains(@class, "checkbox") and contains(@class, "foo")]/input[@type = "checkbox" and @class = "foobar"]');
		$this->assertEquals(1, $mathches->length);
	}

	public function testCaptchaRow()
	{
		$model = new FakeModel();
		$form = $this->makeWidget();
		$data = $form->captchaRow($model, 'login');
		$doc = new DOMDocument();
		$doc->loadHTML($data);
		$actual = new DOMXPath($doc);
		$matches = $actual->query('//input[@type="text"]/following-sibling::div[@class="captcha"]/img');
		$this->assertEquals(1, $matches->length);

	}

	public function testCustomFieldRow()
	{
		$mock = $this->getMock(self::WIDGET_CLASS, array('customFieldRowInternal', 'initRowOptions'));
		$mock->expects($this->once())->method('initRowOptions');
		$mock->expects($this->once())->method('customFieldRowInternal');

		$mock->customFieldRow('field', null, null);
	}

	public function testWidgetRow()
	{
		$mock = $this->getMock(self::WIDGET_CLASS, array('customFieldRowInternal', 'initRowOptions'));
		$mock->expects($this->once())->method('initRowOptions');
		$mock->expects($this->once())->method('customFieldRowInternal');

		$mock->widgetRow('foobar', array('model' => null, 'attribute' => null));
	}

	public function testCustomFieldRowInternal()
	{
		$model = new FakeModel();
		$mock = $this->getMock(self::WIDGET_CLASS, array('horizontalFieldRow', 'verticalFieldRow', 'inlineFieldRow'));

		$mock->type = 'horizontal';
		$mock->expects($this->once())->method('horizontalFieldRow');
		$mock->textFieldRow($model, 'login');

		$mock->type = 'vertical';
		$mock->expects($this->once())->method('verticalFieldRow');
		$mock->textFieldRow($model, 'login');

		$mock->type = 'inline';
		$mock->expects($this->once())->method('inlineFieldRow');
		$mock->textFieldRow($model, 'login');

		$form = $this->makeWidget();
		$form->type = 'foobar';
		$this->setExpectedException('CException');
		$form->textFieldRow($model, 'login');
	}

	public function testHorizontalFieldRow()
	{
		$model = new FakeModel();
		$fieldData = 'here_will_be_field';
		$attribute = 'login';
		$model->addError($attribute, 'simple error text');
		$form = $this->makeWidget();
		$method = new ReflectionMethod($form, 'horizontalFieldRow');
		$method->setAccessible(true);

		$rowOptions = array(
			'labelOptions' => array('class' => 'foo'),
			'prepend' => 'before',
			'prependOptions' => array('class' => 'bar'),
			'append' => 'after',
			'appendOptions' => array('class' => 'apple'),
			'errorOptions' => array('class' => 'i-am-a-banana'),
			'hint' => 'blah',
			'hintOptions' => array('class' => 'codemonkey'),
			'enableAjaxValidation' => true,
			'enableClientValidation' => true
		);

		ob_start();
		$method->invokeArgs($form, array(&$fieldData, &$model, &$attribute, &$rowOptions));
		$data = ob_get_clean();
		$doc = new DOMDocument();
		$doc->loadHTML($data);
		$actual = new DOMXPath($doc);
		$matches = $actual->query(
			'//div[contains(@class, "control-group") and contains(@class, "' . CHtml::$errorCss . '")]'
			. '/label[contains(@class, "control-label") and contains(@class, "' . $rowOptions['labelOptions']['class'] . '")]'
			. '/following-sibling::div[@class="controls"]'
			. '/div[contains(@class, "input-prepend") and contains(@class, "input-append")  and text()="' . $fieldData . '"]'
			. '/span[contains(@class,"add-on") and contains(@class, "' . $rowOptions['prependOptions']['class'] . '") and text()="' . $rowOptions['prepend'] . '"]'
			. '/following-sibling::span[contains(@class,"add-on") and contains(@class, "' . $rowOptions['appendOptions']['class'] . '") and text()="' . $rowOptions['append'] . '"]'
			. '/following::div[@class="' . $rowOptions['errorOptions']['class'] . '"]'
			. '/following-sibling::p[contains(@class,"' . $rowOptions['hintOptions']['class'] . '") and text()="' . $rowOptions['hint'] . '"]'
		);
		$this->assertEquals(1, $matches->length);
	}

	public function testVerticalFieldRow()
	{
		$model = new FakeModel();
		$fieldData = 'here_will_be_field';
		$attribute = 'login';
		$model->addError($attribute, 'simple error text');
		$form = $this->makeWidget();
		$method = new ReflectionMethod($form, 'verticalFieldRow');
		$method->setAccessible(true);

		$rowOptions = array(
			'labelOptions' => array('class' => 'foo'),
			'prepend' => 'before',
			'prependOptions' => array('class' => 'bar'),
			'append' => 'after',
			'appendOptions' => array('class' => 'apple'),
			'errorOptions' => array('class' => 'i-am-a-banana'),
			'hint' => 'blah',
			'hintOptions' => array('class' => 'codemonkey'),
			'enableAjaxValidation' => true,
			'enableClientValidation' => true
		);

		ob_start();
		$method->invokeArgs($form, array(&$fieldData, &$model, &$attribute, &$rowOptions));
		$data = ob_get_clean();
		$doc = new DOMDocument();
		$doc->loadHTML($data);
		$actual = new DOMXPath($doc);
		$matches = $actual->query(
			'//label[contains(@class, "' . $rowOptions['labelOptions']['class'] . '")]'
			. '/following-sibling::div[contains(@class, "input-prepend") and contains(@class, "input-append")  and text()="' . $fieldData . '"]'
			. '/span[contains(@class,"add-on") and contains(@class, "' . $rowOptions['prependOptions']['class'] . '") and text()="' . $rowOptions['prepend'] . '"]'
			. '/following-sibling::span[contains(@class,"add-on") and contains(@class, "' . $rowOptions['appendOptions']['class'] . '") and text()="' . $rowOptions['append'] . '"]'
			. '/following::div[@class="' . $rowOptions['errorOptions']['class'] . '"]'
			. '/following-sibling::p[contains(@class,"' . $rowOptions['hintOptions']['class'] . '") and text()="' . $rowOptions['hint'] . '"]'
		);
		$this->assertEquals(1, $matches->length);
	}

	public function testInlineFieldRow()
	{
		$model = new FakeModel();
		$fieldData = 'here_will_be_field';
		$attribute = 'login';
		$model->addError($attribute, 'simple error text');
		$form = $this->makeWidget();
		$method = new ReflectionMethod($form, 'inlineFieldRow');
		$method->setAccessible(true);

		$rowOptions = array(
			'prepend' => 'before',
			'prependOptions' => array('class' => 'bar'),
			'append' => 'after',
			'appendOptions' => array('class' => 'apple'),
		);

		ob_start();
		$method->invokeArgs($form, array(&$fieldData, &$model, &$attribute, &$rowOptions));
		$data = ob_get_clean();
		$doc = new DOMDocument();
		$doc->loadHTML($data);
		$actual = new DOMXPath($doc);
		$matches = $actual->query(
			'//div[contains(@class, "input-prepend") and contains(@class, "input-append") and text()="' . $fieldData . '"]'
			. '/span[contains(@class,"add-on") and contains(@class, "' . $rowOptions['prependOptions']['class'] . '") and text()="' . $rowOptions['prepend'] . '"]'
			. '/following-sibling::span[contains(@class,"add-on") and contains(@class, "' . $rowOptions['appendOptions']['class'] . '") and text()="' . $rowOptions['append'] . '"]'
		);
		$this->assertEquals(1, $matches->length);
	}
}

class FakeModel extends CFormModel
{
	/**
	 * @var string
	 */
	public $login;

	/**
	 * @var string
	 */
	public $password;

	/**
	 * @var bool
	 */
	public $remenberMe;

	public function attributeLabels()
	{
		return array(
			'login' => 'Login',
			'password' => 'Password',
			'rememberMe' => 'Remember me'
		);
	}
}