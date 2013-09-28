<?php
/**
 * TbActiveForm class file.
 * @license [New BSD License](http://www.opensource.org/licenses/bsd-license.php)
 */

/**
 * For available attributes and values read {@link TbButton} documentation.
 * @see TbButton
 */
class TbFormButtonElement extends CFormElement
{
	/**
	 * Name of this button.
	 * @var string
	 */
	public $name;

	private $_on;

	/**
	 * Returns a value indicating under which scenarios this button is visible.
	 * If the value is empty, it means the button is visible under all scenarios.
	 * Otherwise, only when the model is in the scenario whose name can be found in
	 * this value, will the button be visible. See {@link CModel::scenario} for more
	 * information about model scenarios.
	 * @return string scenario names separated by commas. Defaults to null.
	 */
	public function getOn()
	{
		return $this->_on;
	}

	/**
	 * @param string $value scenario names separated by commas.
	 */
	public function setOn($value)
	{
		$this->_on = preg_split('/[\s,]+/', $value, -1, PREG_SPLIT_NO_EMPTY);
	}

	/**
	 * @return string The rendered button.
	 */
	public function render()
	{
		$attributes = $this->attributes;
		$attributes['htmlOptions']['name'] = $this->name;

		return $this->getParent()->getOwner()->widget('TbButton', $attributes, true);
	}

	/**
	 * Evaluates the visibility of this element.
	 * This method will check the {@link on} property to see if
	 * the model is in a scenario that should have this string displayed.
	 * @return boolean whether this element is visible.
	 */
	protected function evaluateVisible()
	{
		return empty($this->_on) || in_array($this->getParent()->getModel()->getScenario(), $this->_on);
	}
}
