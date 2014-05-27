<?php
/**
 *## TbPickerColumn class file
 *
 * @author: amr bedair <amr.bedair@gmail.com>
 * @copyright Copyright &copy; Clevertech 2014-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 */

Yii::import('booster.widgets.TbDataColumn');

/**
 *## Class TbPickerColumn
 *
 * The TbPickerColumn works with TbJsonGridView and allows you to create a column that will display a picker element
 * The picker is a special plugin that renders a dropdown on click, which contents can be dynamically updated.
 *
 * @see <http://getbootstrap.com/javascript/#popovers>
 * 
 * @todo
 * Known Issues:
 * - setting the content to a "js:finction(){ return 'Some Content!'; }" is not working
 * -
 * 
 * @package booster.widgets.grids.columns
 */
class TbPopoverColumn extends TbDataColumn {
	
	/**
	 * @var array $pickerOptions the javascript options for the picker bootstrap plugin. The picker bootstrap plugin
	 * extends from the tooltip plugin.
	 *
	 * Note that picker has also a 'width' just in case we display AJAX'ed content.
	 *
	 * @see http://getbootstrap.com/javascript/#popovers
	 */
	public $options = array();

	/**
	 * Renders a data cell content, wrapping the value with the link that will activate the picker
	 *
	 * @param int $row
	 * @param mixed $data
	 */
	public function renderDataCellContent($row, $data) {
		
		$value = '';
		if ($this->value !== null) {
			$value = $this->evaluateExpression($this->value, array('data' => $data, 'row' => $row));
		} else if ($this->name !== null) {
			$value = CHtml::value($data, $this->name);
		}

		$htmlOptions = array('data-toggle' => 'popover');
		foreach ($this->options as $key => $val) {
			if($this->isAValidOption($key)) {
				if ((!$val instanceof CJavaScriptExpression) && strpos($val, 'js:') === 0)
					$val = new CJavaScriptExpression($val);
				$htmlOptions['data-'.$key] = $val;
			}
		}
		
		echo CHtml::link($value, "#", $htmlOptions);
	}
	
	protected function isAValidOption($option) {
		return in_array($option, array(
			'animation', 'html', 'placement', 'selector', 'trigger', 'title', 'content', 'delay', 'container'
		));
	}
}
