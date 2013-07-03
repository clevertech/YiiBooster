<?php
/**
 * Class BootstrapRegisterPluginTest
 *
 * Tests for `Bootstrap.registerPlugin` method
 */
require_once(__DIR__.'/../../src/components/Bootstrap.php');
require_once(__DIR__.'/../fakes/FakeAssetsRegistry.php');
class BootstrapRegisterPluginTest extends PHPUnit_Framework_TestCase
{

	/** @var Bootstrap */
	private $component;

	public function setUp()
	{
		$this->component = new Bootstrap;
		$this->component->assetsRegistry = new FakeAssetsRegistry();
	}

	/**
	 * @expectedException InvalidArgumentException
	 * @expectedExceptionMessage You cannot register a plugin without providing its name!
	 */
	public function testNoNameInvalidArgumentException()
	{
		$this->component->registerPlugin( null );
	}

	public function testHasNameAndSelectorAndOptions_RegistersScript()
	{
		$this->component->registerPlugin(
			'name',
			'.selector',
			array('option1' => 'value1', 'option2' => 'value2')
		);

		$this->assertEquals(
			"jQuery('.selector').name({\"option1\":\"value1\",\"option2\":\"value2\"});",
			$this->getFirstRegisteredScript()
		);
	}

	public function testHasNameAndSelectorAndNoOptions_RegistersScript()
	{
		$this->component->registerPlugin(
			'name',
			'.selector'
		);

		$this->assertEquals(
			"jQuery('.selector').name();",
			$this->getFirstRegisteredScript()
		);
	}

	public function testHasPluginRegistered_GetsItsConfig()
	{
		$this->component->plugins['name'] = array(
			'selector' => '.myselector',
			'options' => array('myoption' => 'myvalue')
		);

		$this->component->registerPlugin('name');

		$this->assertEquals(
			"jQuery('.myselector').name({\"myoption\":\"myvalue\"});",
			$this->getFirstRegisteredScript()
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

		$this->assertEquals(
			"jQuery('.theirselector').name({\"theiroption\":\"theirvalue\"});",
			$this->getFirstRegisteredScript()
		);
	}

	public function testNoSelector_NoScript()
	{
		$this->component->registerPlugin('noselector');

		$this->assertEmpty($this->getAllRegisteredScripts());
	}

	public function testNoSelectorKnownPlugin_RegisterKnownPlugin()
	{
		$this->component->plugins['name'] = array(
			'selector' => '.selector',
		);

		$this->component->registerPlugin('name');

		$this->assertEquals(
			"jQuery('.selector').name();",
			$this->getFirstRegisteredScript()
		);
	}

	/** @return mixed */
	private function getFirstRegisteredScript()
	{
		return $this->component->assetsRegistry->getFirstScript();
	}

	/** @return array */
	private function getAllRegisteredScripts()
	{
		return $this->component->assetsRegistry->getAllScripts();
	}
}
