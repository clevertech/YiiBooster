<?php
/**
 * Class FakeAssetsRegistry
 *
 * Test double for CClientScript functionality.
 *
 * It just saves the scripts in private array and provides a method to get them by ID.
 */
class FakeAssetsRegistry {

	private $scripts = array();


	public function registerScript($id, $contents)
	{
		$this->scripts[$id] = $contents;
	}

	public function getFirstScript()
	{
		return reset($this->scripts);
	}

	public function getAllScripts()
	{
		return $this->scripts;
	}
}