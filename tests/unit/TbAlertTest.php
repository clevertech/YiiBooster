<?php
/**
 * Created by JetBrains PhpStorm.
 * User: hijarian
 * Date: 08.04.13
 * Time: 10:02
 * To change this template use File | Settings | File Templates.
 */

require_once(__DIR__.'/../../src/widgets/TbAlert.php');

class TbAlertTest extends PHPUnit_Framework_TestCase {

	private function makeWidget()
	{
		return new TbAlert();
	}

	/**
	 * @test
	 */
	public function onInitWhenNoExplicitIdSetDefault()
	{
		$widget = $this->makeWidget();

		$widget->init();

		$this->assertRegExp('/yw\d+/', $widget->htmlOptions['id']);
	}

	/**
	 * @test
	 */
	public function onInitWhenAlertsStringMakeArray()
	{
		$widget = $this->makeWidget();
		$widget->alerts = 'some_alert_type';

		$widget->init();

		$this->assertInternalType('array', $widget->alerts);
	}

	/**
	 * @test
	 */
	public function onInitWhenNoAlertsSetAllDefined()
	{
		$widget = $this->makeWidget();
		$widget->init();

		$this->assertSame(
			array(
				TbAlert::TYPE_SUCCESS,
				TbAlert::TYPE_INFO,
				TbAlert::TYPE_WARNING,
				TbAlert::TYPE_ERROR,
				TbAlert::TYPE_DANGER
			),
			$widget->alerts
		);
	}
}
