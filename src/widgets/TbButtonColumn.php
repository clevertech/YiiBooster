<?php
/**
 *##  TbButtonColumn class file.
 *
 * @author Christoffer Niska <ChristofferNiska@gmail.com>
 * @copyright  Copyright &copy; Christoffer Niska 2011-
 * @license [New BSD License](http://www.opensource.org/licenses/bsd-license.php)
 * @since 0.9.8
 */

Yii::import('zii.widgets.grid.CButtonColumn');
Yii::import('booster.helpers.TbHtml');

/**
 *## Bootstrap button column widget.
 *
 * Used to set buttons to use Glyphicons instead of the defaults images.
 *
 * @package booster.widgets.grids.columns
 */
class TbButtonColumn extends CButtonColumn {
	
	/**
	 * @var string the view button icon (defaults to 'eye-open').
	 */
	public $viewButtonIcon = 'eye-open';

	/**
	 * @var string the update button icon (defaults to 'pencil').
	 */
	public $updateButtonIcon = 'pencil';

	/**
	 * @var string the delete button icon (defaults to 'trash').
	 */
	public $deleteButtonIcon = 'trash';

	/**
	 *### .initDefaultButtons()
	 *
	 * Initializes the default buttons (view, update and delete).
	 */
	protected function initDefaultButtons() {
		parent::initDefaultButtons();

		if ($this->viewButtonIcon !== false && !isset($this->buttons['view']['icon'])) {
			$this->buttons['view']['icon'] = $this->viewButtonIcon;
		}
		if ($this->updateButtonIcon !== false && !isset($this->buttons['update']['icon'])) {
			$this->buttons['update']['icon'] = $this->updateButtonIcon;
		}
		if ($this->deleteButtonIcon !== false && !isset($this->buttons['delete']['icon'])) {
			$this->buttons['delete']['icon'] = $this->deleteButtonIcon;
            $this->buttons['delete']['options']['data-ajax-request'] = true;
            $this->buttons['delete']['click'] = null;
            if (is_string($this->deleteConfirmation))
                $this->buttons['delete']['options']['data-confirm'] = $this->deleteConfirmation;
		}

        foreach ($this->buttons as $type => $value) {
            if ($value['refresh'] === true) {
                $this->buttons[$type]['options']['data-ajax-request'] = true;
            }
        }

        if (Yii::app()->request->enableCsrfValidation) {
            $csrfTokenName = Yii::app()->request->csrfTokenName;
            $csrfToken = Yii::app()->request->csrfToken;
            $csrf = "\n\t\tdata:{ '$csrfTokenName':'$csrfToken' },";
        } else
            $csrf = '';

        $script = <<<EOD
jQuery(document).on('click', '#{$this->grid->id} a[data-ajax-request="1"]', function(e) {
    if (jQuery(this).data('confirm')) {
        if (!confirm(jQuery(this).data('confirm'))) { e.preventDefault(); e.stopPropagation(); return false; }
    }
    var grid = jQuery(this).closest(".grid-view"); 
    grid.yiiGridView('update', {
        type: 'POST',
        url: jQuery(this).attr('href'),$csrf
        success: function(data) {
            var response = jQuery.parseJSON(data);
            if (jQuery.isPlainObject(response) && jQuery.type(response.noty) == "string") {
                noty({type: 'success', text: response.noty});
            }
            grid.yiiGridView('update');
        }
    });
    return false;
});
EOD;

        Yii::app()->clientScript->registerScript(__CLASS__ . '#ajaxrequest#' . $this->id, $script);


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

		if (isset($button['icon']) && $button['icon']) {
			echo CHtml::link(TbHtml::icon($button['icon']), $url, $options);
		} else if (isset($button['imageUrl']) && is_string($button['imageUrl'])) {
			echo CHtml::link(CHtml::image($button['imageUrl'], $label), $url, $options);
		} else {
			echo CHtml::link($label, $url, $options);
		}
	}
}
