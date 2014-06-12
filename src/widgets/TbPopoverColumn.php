<?php
/**
 *## TbPopoverColumn class file
 *
 * @author: amr bedair <amr.bedair@gmail.com>
 * @copyright Copyright &copy; Clevertech 2014-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 */

Yii::import('booster.widgets.TbDataColumn');

/**
 *## Class TbPopoverColumn
 *
 * The TbPopoverColumn works with TbJsonGridView and allows you to create a column that will display a picker element
 * The picker is a special plugin that renders a dropdown on click, which contents can be dynamically updated.
 *
 * @see <http://getbootstrap.com/javascript/#popovers>
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

	public function init() {
		
		$this->registerClientScript();
	}
	
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

		$htmlOptions = array('class' => 'bootstrap-popover', 'data-trigger' => 'manual');
		
		echo CHtml::link($value, "#", $htmlOptions);
	}
	
	protected function registerClientScript() {
		
		$gridId = $this->grid->id;
		$options = CJavaScript::encode($this->options);
		
		Yii::app()->clientScript->registerScript(__CLASS__ . '#' . $this->id, "
			$('#$gridId a.bootstrap-popover').popover($options);	
			$('#$gridId a.bootstrap-popover').click(function() {
				$('#$gridId a.bootstrap-popover').not(this).popover('hide');
				$(this).popover('toggle');
				return false;
			});
		", CClientScript::POS_READY);
	}
}
