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

	/** @var SplStack */
	private $css_files;

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

	public function registerCssFile($filename)
	{
		if (!isset($this->css_files))
			$this->css_files = new SplStack();

		$this->css_files->push($filename);
	}

	public function getLastRegisteredCssFile()
	{
		return $this->css_files->pop();
	}
}