<?php
/**
 * YiiBooster project.
 * @license [New BSD License](http://www.opensource.org/licenses/bsd-license.php)
 */

require_once(__DIR__ . '/../../../src/components/Bootstrap.php');
require_once(__DIR__ . '/../../fakes/AssetsRegistryHook.php');

/**
 * Tests for `Bootstrap::registerPlugin` method
 */
class BootstrapRegisterPluginTest extends PHPUnit_Framework_TestCase
{
	/** @var Bootstrap */
	private $component;

	/**
	 * @inheritdoc
	 */
	public function setUp()
	{
		$this->component = new Bootstrap();
		$this->component->assetsRegistry = new AssetsRegistryHook();
	}

	/**
	 * @expectedException InvalidArgumentException
	 * @expectedExceptionMessage You cannot register a plugin without providing its name!
	 */
	public function testNoNameInvalidArgumentException()
	{
		$this->component->registerPlugin(null);
	}

	public function testHasNameAndSelectorAndOptions_RegistersScript()
	{
		$this->component->registerPlugin(
			'name',
			'.selector',
			array('option1' => 'value1', 'option2' => 'value2')
		);

		$this->assertTrue(
			$this->component
				->assetsRegistry
				->hasRegisteredScript("jQuery('.selector').name({\"option1\":\"value1\",\"option2\":\"value2\"});")
		);
	}

	public function testHasNameAndSelectorAndNoOptions_RegistersScript()
	{
		$this->component->registerPlugin(
			'name',
			'.selector'
		);

		$this->assertTrue(
			$this->component
				->assetsRegistry
				->hasRegisteredScript("jQuery('.selector').name();")
		);
	}

	public function testHasPluginRegistered_GetsItsConfig()
	{
		$this->component->plugins['name'] = array(
			'selector' => '.myselector',
			'options' => array('myoption' => 'myvalue')
		);

		$this->component->registerPlugin('name');

		$this->assertTrue(
			$this->component
				->assetsRegistry
				->hasRegisteredScript("jQuery('.myselector').name({\"myoption\":\"myvalue\"});")
		);
	}

	public function testHasPluginRegistered_ProvidedConfigOverridesIt()
	{
		$this->component->plugins['name'] = array(
			'selector' => '.myselector',
			'options' => array('myoption' => 'myvalue')
		);

		$this->component->registerPlugin(
			'name',
			'.theirselector',
			array('theiroption' => 'theirvalue')
		);

		$this->assertTrue(
			$this->component
				->assetsRegistry
				->hasRegisteredScript("jQuery('.theirselector').name({\"theiroption\":\"theirvalue\"});")
		);
	}

	public function testNoSelector_NoScript()
	{
		$this->component->registerPlugin('noselector');

		$this->assertFalse($this->component->assetsRegistry->hasScripts());
	}

	public function testNoSelectorKnownPlugin_RegisterKnownPlugin()
	{
		$this->component->plugins['name'] = array(
			'selector' => '.selector',
		);

		$this->component->registerPlugin('name');

		$this->assertTrue(
			$this->component
				->assetsRegistry
				->hasRegisteredScript("jQuery('.selector').name();")
		);
	}
}
