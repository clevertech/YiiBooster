<?php
/**
 * Main tests for initialization of Bootstrap component
*/

require_once(__DIR__.'/../../src/components/Bootstrap.php');
class BootstrapTest extends PHPUnit_Framework_TestCase
{

	public function testInstantiate()
	{
		$component = new Bootstrap();
		$this->assertInstanceOf('Bootstrap', $component);
	}

	public function testInit()
	{
		$component = new Bootstrap();
		$component->init();
	}

}
