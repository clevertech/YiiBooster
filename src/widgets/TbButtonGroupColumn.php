<?php
/**
 *##  TbButtonGroupColumn class file.
 *
 * @author Topher Kanyuga <kanjoti@gmail.com>
 * @copyright  
 * @license [New BSD License](http://www.opensource.org/licenses/bsd-license.php)
 */

Yii::import('booster.widgets.TbButtonColumn');

/**
 *## Enhanced bootstrap button column widget.
 *
 * Renders the buttons as a button group
 *
 * @package booster.widgets.grids.columns
 */
class TbButtonGroupColumn extends TbButtonColumn {

	/**
	 * @var string the button size ('mini','small','normal','large')
	 */
	public $buttonSize = 'mini';

	/**
	 * @var string the view button context ('info','primary','warning','danger','success' defaults to 'info').
	 */
	public $viewButtonContext = 'info';

	/**
	 * @var string the update button context ('info','primary','warning','danger','success' defaults to 'warning').
	 */
	public $updateButtonContext = 'warning';

	/**
	 * @var string the delete button context ('info','primary','warning','danger','success' defaults to 'danger')
	 */
	public $deleteButtonContext = 'danger';

	/**
	 *### .initDefaultButtons()
	 *
	 * Initializes the default buttons (view, update and delete).
	 */
	protected function initDefaultButtons() {
		
		parent::initDefaultButtons();

		if ($this->viewButtonContext !== false && !isset($this->buttons['view']['context'])) {
			$this->buttons['view']['context'] = $this->viewButtonContext;
		}
		if ($this->updateButtonContext !== false && !isset($this->buttons['update']['context'])) {
			$this->buttons['update']['context'] = $this->updateButtonContext;
		}
		if ($this->deleteButtonContext !== false && !isset($this->buttons['delete']['context'])) {
			$this->buttons['delete']['context'] = $this->deleteButtonContext;
		}
	}


	/**
	 *### .renderButton()
	 *
	 * Renders a link button.
	 *
	 * @param string $id the ID of the button
	 * @param array $button the button configuration which may contain 'label', 'url', 'imageUrl' and 'options' elements.
	 * @param integer $row the row number (zero-based)
	 * @param mixed $data the data object associated with the row
	 */
	protected function renderButton($id, $button, $row, $data) {
		
		if (isset($button['visible']) && !$this->evaluateExpression(
			$button['visible'],
			array('row' => $row, 'data' => $data)
		)
		) {
			return;
		}

		$label = isset($button['label']) ? $button['label'] : $id;
		$url = isset($button['url']) ? $this->evaluateExpression($button['url'], array('data' => $data, 'row' => $row))
			: '#';
		$options = isset($button['options']) ? $button['options'] : array();

		if (!isset($options['title'])) {
			$options['title'] = $label;
		}

		if (!isset($options['data-toggle'])) {
			$options['data-toggle'] = 'tooltip';
		}

		if (!isset($options['class'])) {
			$options['class'] = '';
		}
		$options['class'] .= ' btn btn-' . $this->buttonSize;
		if (isset($button['context'])) {
			$options['class'] .= ' btn-' . $button['context'];
		}

		if (isset($button['icon'])) {
			if (strpos($button['icon'], 'icon') === false && strpos($button['icon'], 'fa') === false) {
				$button['icon'] = 'icon-' . implode(' icon-', explode(' ', $button['icon']));
			}

			echo CHtml::link('<i class="' . $button['icon'] . '"></i>', $url, $options);
		} else if (isset($button['imageUrl']) && is_string($button['imageUrl'])) {
			echo CHtml::link(CHtml::image($button['imageUrl'], $label), $url, $options);
		} else {
			echo CHtml::link($label, $url, $options);
		}
	}

	/**
	 *### .renderDataCellContent()
	 *
	 * Renders the data cell content.
	 * This method renders the view, update and delete buttons in the data cell.
	 *
	 * @param integer $row the row number (zero-based)
	 * @param mixed $data the data associated with the row
	 */
	protected function renderDataCellContent($row, $data)
	{
		$tr = array();
		ob_start();
		foreach ($this->buttons as $id => $button) {
			$this->renderButton($id, $button, $row, $data);
			$tr['{' . $id . '}'] = ob_get_contents();
			ob_clean();
		}
		ob_end_clean();
		echo "<div class='btn-group'>" . strtr($this->template, $tr) . "</div>";
	}
}
