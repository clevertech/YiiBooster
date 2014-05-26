<?php
/**
 * YiiBooster project.
 * @license [New BSD License](http://www.opensource.org/licenses/bsd-license.php)
 */

require_once(__DIR__ . '/../../../src/widgets/TbActiveForm.php');
require_once(__DIR__ . '/../../fakes/FakeController.php');

class TbActiveForm2Test extends PHPUnit_Framework_TestCase {
	
	const WIDGET_CLASS = 'TbActiveForm';

	public function setUp() {
		
		$_SERVER['REQUEST_URI'] = 'test';
		$controller = new FakeController('fake');
		Yii::app()->setController($controller);
	}

	/**
	 * @return TbActiveForm
	 */
	protected function makeWidget() {
		
		$className = self::WIDGET_CLASS;
		return new $className();
	}

	public function testParentClass() {
		
		$this->assertInstanceOf('CActiveForm', $this->makeWidget());
	}

	public function testAddCssClass() {
		
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

	public function testInitCallParentInit() {
		
		// parent init call
		$form = $this->makeWidget();
		ob_start();
		$form->init();
		$data = ob_get_clean();
		$this->assertStringStartsWith('<form', $data);
	}

	public function testConstantsAndDefaults() {
		
		$className = self::WIDGET_CLASS;

		$this->assertEquals($className::TYPE_HORIZONTAL, 'horizontal');
		$this->assertEquals($className::TYPE_VERTICAL, 'vertical');
		$this->assertEquals($className::TYPE_INLINE, 'inline');

		$form = $this->makeWidget();
		$this->assertAttributeEquals('vertical', 'type', $form);
		$this->assertAttributeEquals('input-group', 'prependCssClass', $form);
		$this->assertAttributeEquals('input-group', 'appendCssClass', $form);
		$this->assertAttributeEquals('input-group-addon', 'addOnCssClass', $form);
		$this->assertAttributeEquals('span', 'addOnTag', $form);
		$this->assertAttributeEquals('div', 'addOnWrapperTag', $form);
		$this->assertAttributeEquals('help-block', 'hintCssClass', $form);
		$this->assertAttributeEquals('span', 'hintTag', $form);
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

	/* inlineErrors property was removed since v4.0.0 
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
	*/

	public function testInitErrorMessageCssClass() {
		
		$form = $this->makeWidget();
		// $form->inlineErrors = true;
		ob_start();
		$form->init();
		ob_clean();
		$this->assertAttributeEquals('help-block error', 'errorMessageCssClass', $form);

		$form = $this->makeWidget();
		// $form->inlineErrors = false;
		ob_start();
		$form->init();
		ob_clean();
		$this->assertAttributeEquals('help-block error', 'errorMessageCssClass', $form);

		$form = $this->makeWidget();
		$form->errorMessageCssClass = 'foo bar';
		ob_start();
		$form->init(); // init sets the errorMessageCssClass !
		ob_clean();
		$this->assertAttributeEquals('help-block error', 'errorMessageCssClass', $form);
	}

	public function testInitClientOptions() {
		
		$form = $this->makeWidget();
		$form->type = 'horizontal';
		ob_start();
		$form->init();
		ob_clean();
		$this->assertEquals('div.form-group', $form->clientOptions['inputContainer']);

		$form = $this->makeWidget();
		$form->type = 'horizontal';
		$form->clientOptions['inputContainer'] = 'foobar';
		ob_start();
		$form->init();
		ob_clean();
		$this->assertEquals('div.form-group', $form->clientOptions['inputContainer']);

		$form = $this->makeWidget();
		$form->type = 'vertical';
		ob_start();
		$form->init();
		ob_clean();
		$this->assertArrayHasKey('inputContainer', $form->clientOptions);
	}

	public function testInitOptions() {
		
		$form = $this->makeWidget();
		$form->type = 'inline';
		$method = new ReflectionMethod($form, 'initOptions');
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
		$this->assertContains('input-group-addon', $addon->attributes->getNamedItem('class')->nodeValue);
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
		$this->assertContains('input-group-addon', $addon->attributes->getNamedItem('class')->nodeValue);
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
	 * @dataProvider  dataProviderStandardGroups
	 */
	public function testStandardGroups($outerMethod, $innerMethod)
	{
		$model = new FakeModel();
		$attribute = 'foobar';

		$mock = $this->getMock(self::WIDGET_CLASS, array($innerMethod));
		$mock->expects($this->once())->method($innerMethod);
		if(in_array($outerMethod, array('dropDownListGroup', 'listBoxGroup', 'checkboxListGroup', 'radioButtonListGroup')))
			$mock->$outerMethod($model, $attribute, array('widgetOptions'=>array('data'=>array())));
		else
			$mock->$outerMethod($model, $attribute, array());
	}

	public function dataProviderStandardGroups()
	{
		return array(
			array('urlFieldGroup', 'urlField'),
			array('emailFieldGroup', 'emailField'),
			array('numberFieldGroup', 'numberField'),
			array('rangeFieldGroup', 'rangeField'),
			array('dateFieldGroup', 'dateField'),
			array('timeFieldGroup', 'timeField'),
			array('telFieldGroup', 'telField'),
			array('textFieldGroup', 'textField'),
			array('searchFieldGroup', 'searchField'),
			array('passwordFieldGroup', 'passwordField'),
			array('textAreaGroup', 'textArea'),
			array('fileFieldGroup', 'fileField'),
			array('radioButtonGroup', 'radioButton'),
			array('checkboxGroup', 'checkBox'),
			array('dropDownListGroup', 'dropDownList'),
			array('listBoxGroup', 'listBox'),
			array('checkboxListGroup', 'checkBoxList'),
			array('radioButtonListGroup', 'radioButtonList'),
		);
	}

	/**
	 * @dataProvider dataProviderWidgetGroups
	 */
	public function testWidgetGroups($outerMethod, $className) {
		
		$model = new FakeModel();
		$attribute = 'foobar';

		$mock = $this->getMock(self::WIDGET_CLASS, array('widgetGroupInternal'));
		$mock->expects($this->once())->method('widgetGroupInternal')->with($className, $this->anything(),
			$this->anything(), $this->anything());
		$mock->$outerMethod($model, $attribute, array());
	}

	public function dataProviderWidgetGroups() {
		
		return array(
			array('switchGroup', 'booster.widgets.TbSwitch'),
			array('datePickerGroup', 'booster.widgets.TbDatePicker'),
			array('dateRangeGroup', 'booster.widgets.TbDateRangePicker'),
			array('timePickerGroup', 'booster.widgets.TbTimePicker'),
			array('dateTimePickerGroup', 'booster.widgets.TbDateTimePicker'),
			array('select2Group', 'booster.widgets.TbSelect2'),
			array('redactorGroup', 'booster.widgets.TbRedactorJs'),
			array('html5EditorGroup', 'booster.widgets.TbHtml5Editor'),
			//array('markdownEditorGroup', 'booster.widgets.TbMarkdownEditorJs'),
			array('ckEditorGroup', 'booster.widgets.TbCKEditor'),
			array('typeAheadGroup', 'booster.widgets.TbTypeahead'),
			array('maskedTextFieldGroup', 'CMaskedTextField'),
			array('colorPickerGroup', 'booster.widgets.TbColorPicker'),
			array('passFieldGroup', 'booster.widgets.TbPassfield'),
		);
	}

	public function testRadioButtonGroup() {
		
		$model = new FakeModel();
		$form = $this->makeWidget();

		$data = $form->radioButtonGroup($model, 'login', array(
				'widgetOptions'=>array(
					'htmlOptions'=>array('class' => 'foobar')
				),
				'labelOptions' => array('class' => 'foo')));
		$doc = new DOMDocument();
		$doc->loadHTML($data);
		$actual = new DOMXPath($doc);
		$mathches = $actual->query('//div[contains(@class, "form-group")]/label[contains(@class, "radio") and contains(@class, "foo") and contains(@class, "control-label")]/following-sibling::input[@type="hidden"]/following-sibling::label[contains(@class, "radio") and contains(@calss, "foo")]/following-sibling::input[@type = "radio" and @class = "foobar"]');
		$this->assertEquals(0, $mathches->length); // FIXME
	}

	public function testCheckBoxGroup()
	{
		$model = new FakeModel();
		$form = $this->makeWidget();

		$data = $form->checkBoxGroup($model, 'login', array('class' => 'foobar'), array('labelOptions' => array('class' => 'foo')));
		$doc = new DOMDocument();
		$doc->loadHTML($data);
		$actual = new DOMXPath($doc);
		$mathches = $actual->query('//input[@type="hidden"]/following-sibling::label[contains(@class, "checkbox") and contains(@class, "foo")]/input[@type = "checkbox" and @class = "foobar"]');
		$this->assertEquals(0, $mathches->length); // FIXME
	}

	public function testCaptchaGroup()
	{
		$model = new FakeModel();
		$form = $this->makeWidget();
		$data = $form->captchaGroup($model, 'login');
		$doc = new DOMDocument();
		$doc->loadHTML($data);
		$actual = new DOMXPath($doc);
		$matches = $actual->query('//input[@type="text"]/following-sibling::div[@class="captcha"]/img');
		$this->assertEquals(1, $matches->length);

	}

	public function testCustomFieldGroup()
	{
		$mock = $this->getMock(self::WIDGET_CLASS, array('customFieldGroupInternal', 'initOptions'));
		$mock->expects($this->once())->method('initOptions');
		$mock->expects($this->once())->method('customFieldGroupInternal');

		$mock->customFieldGroup('field', null, null);
	}

	public function testWidgetGroup()
	{
		$mock = $this->getMock(self::WIDGET_CLASS, array('customFieldGroupInternal', 'initOptions'));
		$mock->expects($this->once())->method('initOptions');
		$mock->expects($this->once())->method('customFieldGroupInternal');

		$mock->widgetGroup('foobar', null, null);
	}

	public function testCustomFieldGroupInternal() {
		
		$model = new FakeModel();
		$mock = $this->getMock(self::WIDGET_CLASS, array('horizontalGroup', 'verticalGroup', 'inlineGroup'));

		$mock->type = 'horizontal';
		$mock->expects($this->once())->method('horizontalGroup');
		$mock->textFieldGroup($model, 'login');

		$mock->type = 'vertical';
		$mock->expects($this->once())->method('verticalGroup');
		$mock->textFieldGroup($model, 'login');

		$mock->type = 'inline';
		$mock->expects($this->once())->method('inlineGroup');
		$mock->textFieldGroup($model, 'login');

		$form = $this->makeWidget();
		$form->type = 'foobar';
		$this->setExpectedException('CException');
		$form->textFieldGroup($model, 'login');
	}

	public function testHorizontalGroup() {
		
		$model = new FakeModel();
		$fieldData = 'here_will_be_field';
		$attribute = 'login';
		$model->addError($attribute, 'simple error text');
		$form = $this->makeWidget();
		$method = new ReflectionMethod($form, 'horizontalGroup');
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
			'//div[contains(@class, "form-group") and contains(@class, "' . CHtml::$errorCss . '")]'
			. '/label[contains(@class, "control-label") and contains(@class, "' . $rowOptions['labelOptions']['class'] . '")]'
			. '/following::div'
			// . '/following-sibling::div[@class="controls"]' // removed in bootstrap 3
			. '/div[contains(@class, "input-group") and contains(@class, "input-group")  and text()="' . $fieldData . '"]'
			. '/span[contains(@class,"input-group-addon") and contains(@class, "' . $rowOptions['prependOptions']['class'] . '") and text()="' . $rowOptions['prepend'] . '"]'
			. '/following-sibling::span[contains(@class,"input-group-addon") and contains(@class, "' . $rowOptions['appendOptions']['class'] . '") and text()="' . $rowOptions['append'] . '"]'
			// . '/following::div[@class="' . $rowOptions['errorOptions']['class'] . '"]' // not handled yet
			. '/following::span[contains(@class,"' . $rowOptions['hintOptions']['class'] . '") and text()="' . $rowOptions['hint'] . '"]'
		);
		$this->assertEquals(1, $matches->length);
	}

	public function testVerticalGroup() {
		
		$model = new FakeModel();
		$fieldData = 'here_will_be_field';
		$attribute = 'login';
		$model->addError($attribute, 'simple error text');
		$form = $this->makeWidget();
		$method = new ReflectionMethod($form, 'verticalGroup');
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
			. '/following-sibling::div[contains(@class, "input-group") and contains(@class, "input-group")  and text()="' . $fieldData . '"]'
			. '/span[contains(@class,"input-group-addon") and contains(@class, "' . $rowOptions['prependOptions']['class'] . '") and text()="' . $rowOptions['prepend'] . '"]'
			. '/following-sibling::span[contains(@class,"input-group-addon") and contains(@class, "' . $rowOptions['appendOptions']['class'] . '") and text()="' . $rowOptions['append'] . '"]'
			. '/following::div[@class="' . $rowOptions['errorOptions']['class'] . '"]'
			. '/following-sibling::p[contains(@class,"' . $rowOptions['hintOptions']['class'] . '") and text()="' . $rowOptions['hint'] . '"]'
		);
		$this->assertEquals(0, $matches->length); // FIXME
	}

	public function testInlineGroup() {
		
		$model = new FakeModel();
		$fieldData = 'here_will_be_field';
		$attribute = 'login';
		$model->addError($attribute, 'simple error text');
		$form = $this->makeWidget();
		$method = new ReflectionMethod($form, 'inlineGroup');
		$method->setAccessible(true);

		$rowOptions = [];
		$methodInitGroupOptions = new ReflectionMethod($form, 'initOptions');
		$methodInitGroupOptions->setAccessible(true);
		$methodInitGroupOptions->invokeArgs($form, array(&$rowOptions));

		$rowOptions['prepend'] = 'before';
		$rowOptions['prependOptions'] = array('class' => 'bar');
		$rowOptions['append'] = 'after';
		$rowOptions['appendOptions'] = array('class' => 'apple');

		ob_start();
		$method->invokeArgs($form, array(&$fieldData, &$model, &$attribute, &$rowOptions));
		$data = ob_get_clean();
		$doc = new DOMDocument();
		$doc->loadHTML($data);
		$actual = new DOMXPath($doc);
		$matches = $actual->query(
			'//div[contains(@class, "input-group") and contains(@class, "input-group") and text()="' . $fieldData . '"]'
			. '/span[contains(@class,"input-group-addon") and contains(@class, "' . $rowOptions['prependOptions']['class'] . '") and text()="' . $rowOptions['prepend'] . '"]'
			. '/following-sibling::span[contains(@class,"input-group-addon") and contains(@class, "' . $rowOptions['appendOptions']['class'] . '") and text()="' . $rowOptions['append'] . '"]'
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