<?php
/**
 * YiiBooster project.
 * @license [New BSD License](http://www.opensource.org/licenses/bsd-license.php)
 */

require_once(__DIR__ . '/../../../src/components/Booster.php');

/**
 * Main tests for initialization of Booster component
 */
class BoosterTest extends PHPUnit_Framework_TestCase {

	public function testInstantiate() {
		
		$component = new Booster();
		$this->assertInstanceOf('Booster', $component);
	}

	/**
	 * @test
	 */
	public function CanInitWithoutContext() {
		
		$component = new Booster();
		$component->init();
	}

	public function BootstrapCssFilenames() {
		
		$cdn_url = '//netdna.bootstrapcdn.com/bootstrap/3.1.1';
		$local_url = 'assets'; // make sure it's equal to `assetsUrl` defined in relevant test!
		return array(
			// $cdn, $responsive, $fontawesome, $mincss, $expected_filename

			// Note that CDN hosts only responsive, minified variants.
			// array(true, true, true, true, "{$cdn_url}/css/bootstrap-combined.no-icons.min.css"),
			// array(true, true, true, false, "{$local_url}/bootstrap/css/bootstrap.no-icons.css"),
			// array(true, true, false, true, "{$cdn_url}/css/bootstrap-combined.min.css"),
			// array(true, true, false, false, "{$local_url}/bootstrap/css/bootstrap.css"),

			// CDN does not host non-responsive variants
			// array(true, false, true, true, "{$local_url}/bootstrap/css/bootstrap.no-responsive.no-icons.min.css"),
			// array(true, false, true, false, "{$local_url}/bootstrap/css/bootstrap.no-responsive.no-icons.css"),
			// array(true, false, false, true, "{$local_url}/bootstrap/css/bootstrap.no-responsive.min.css"),
			// array(true, false, false, false, "{$local_url}/bootstrap/css/bootstrap.no-responsive.css"),

			// Local
			// array(false, true, true, true, "{$local_url}/bootstrap/css/bootstrap.no-icons.min.css"),
			// array(false, true, true, false, "{$local_url}/bootstrap/css/bootstrap.no-icons.css"),
			array(true, true, false, true, "{$cdn_url}/css/bootstrap.min.css"),
			array(true, true, false, false, "{$cdn_url}/css/bootstrap.min.css"),
			array(false, true, false, true, "{$local_url}/bootstrap/css/bootstrap.min.css"),
			array(false, true, false, false, "{$local_url}/bootstrap/css/bootstrap.css"),

			// Same as if $enableCdn=true, because CDN does not host non-responsive variants.
			// array(false, false, true, true, "{$local_url}/bootstrap/css/bootstrap.no-responsive.no-icons.min.css"),
			// array(false, false, true, false, "{$local_url}/bootstrap/css/bootstrap.no-responsive.no-icons.css"),
			// array(false, false, false, true, "{$local_url}/bootstrap/css/bootstrap.no-responsive.min.css"),
			// array(false, false, false, false, "{$local_url}/bootstrap/css/bootstrap.no-responsive.css"),
		);
	}

	/**
	 * @test
	 * @dataProvider BootstrapCssFilenames
	 */
	public function UsesBootstrapCssDependingOnSwitches($cdn, $responsive, $fontawesome, $mincss, $expected_filename) {
		
		$component = new Booster();
		$component->_assetsUrl = 'assets';
		$component->cs = new AssetsRegistryHook();

		$component->enableCdn = $cdn;
		$component->responsiveCss = $responsive;
		$component->fontAwesomeCss = $fontawesome;
		$component->minify = $mincss;

		$component->init();
		$component->registerBootstrapCss();

		$this->assertTrue(
			$component->cs->hasRegisteredCssFile($expected_filename)
		);
	}
}
