<?php
/*##  TbButtonColumn class file.
 *
 * @author Konstantin Popov <popovconstantine@gmail.com>
 * @copyright  Copyright &copy; Konstantin Popov 2013-
 * @license [New BSD License](http://www.opensource.org/licenses/bsd-license.php) 
 * @package bootstrap.widgets
 * @since 0.9.8
 */

Yii::import('bootstrap.widgets.TbToggleColumn');

/**
 * Bootstrap button column widget.
 * Used to set buttons to use Glyphicons instead of the defaults images.
 */
class TbJsonToggleColumn extends TbToggleColumn
{
	
	/**
	 * Renders|returns the data cell
	 *
	 * @param int $row
	 *
	 * @return array|void
	 */
	public function renderDataCell($row)
	{
		if ($this->grid->json) {
			$data = $this->grid->dataProvider->data[$row];
			$col = array();
			ob_start();
			$this->renderDataCellContent($row, $data);
			$col['content'] = ob_get_contents();
			ob_end_clean();
			$col['attrs'] = '';
		//	print_r($col);
			return $col;
			//parent::renderDataCell($row);
		}

		parent::renderDataCell($row);
	}

	/**
	 * Initializes the default buttons (view, update and delete).
	 */
	protected function initButton()
	{
		parent::initButton();
		/**
		 * add custom with msgbox instead
		 */
		$this->button['click'] = strtr(
			$this->button['click'],
			array('yiiGridView' => 'yiiJsonGridView')
		);
	}
	
}
