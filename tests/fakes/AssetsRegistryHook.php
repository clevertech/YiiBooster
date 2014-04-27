<?php
/**
 * YiiBooster project.
 * @license [New BSD License](http://www.opensource.org/licenses/bsd-license.php)
 */

/**
 * Test double for CClientScript functionality.
 * It just saves the scripts in private array and provides a method to get them by ID.
 */
class AssetsRegistryHook extends CClientScript
{
	/**
	 * @return bool
	 */
	public function hasScripts()
	{
		return !empty($this->scripts);
	}

	/**
	 * @param string $script script code block.
	 * @return bool
	 */
	public function hasRegisteredScript($script)
	{
		foreach ($this->scripts as $s) {
			if (reset($s) == $script) {
				return true;
			}
		}

		return false;
	}

	/**
	 * @param string $url package name.
	 * @return bool
	 */
	public function hasRegisteredCssFile($url)
	{
		if (array_key_exists($url, $this->cssFiles)) {
			return true;
		}

		foreach ($this->coreScripts as $package) {
			$_url = $url;
			if (isset($package['baseUrl'])) {
				if (strpos($_url, $package['baseUrl']) !== 0) {
					continue;
				}
				$_url = substr($_url, strlen($package['baseUrl']));
			}
			if (isset($package['css']) && in_array($_url, $package['css'])) {
				return true;
			}
		}

		return false;
	}
}