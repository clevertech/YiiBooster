<?php
/**
 * TbBox widget class
 * 
 * Based on TBox widget class by
 * @author: antonio ramirez <antonio@clevertech.biz>
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 * @package YiiBooster bootstrap.widgets
 *
 * Changelog
 * @author: Thiago Otaviani Vidal <thiagovidal@gmail.com>
 * - Added suport for widget types
 * - Changed @string headerIcon to icon
 * - Changed @array headerButtons to buttons
 */
class TbBox extends CWidget
{
	public $id;

	// Widget types.
	const TYPE_PRIMARY = 'primary';
	const TYPE_INFO = 'info';
	const TYPE_SUCCESS = 'success';
	const TYPE_WARNING = 'warning';
	const TYPE_DANGER = 'danger';
	const TYPE_INVERSE = 'inverse';

	/**
	 * @var string the widget type.
	 * Valid values are 'primary', 'info', 'success', 'warning', 'danger' and 'inverse'.
	 */
	public $type;

	/**
	 * Box title
	 * If set to false, a box with no title is rendered
	 * @var mixed
	 */
	public $title = '';

	/**
	 * The class icon to display in the header title of the box.
	 * @see http://twitter.github.com/bootstrap/base-css.html#icon
	 * @var string
	 */
	public $icon;

	/**
	 * Box Content
	 * optional, the content of this attribute is echoed as the box content
	 * @var string
	 */
	public $content = '';

	/**
	 * box HTML additional attributes
	 * @var array
	 */
	public $htmlOptions = array();

	/**
	 * box header HTML additional attributes
	 * @var array
	 */
	public $htmlHeaderOptions = array();

	/**
	 * box content HTML additional attributes
	 * @var array
	 */
	public $htmlContentOptions = array();

	/**
	 * @var array the configuration for additional header buttons. Each array element specifies a single button
	 * which has the following format:
	 * <pre>
	 *     array(
	 *        array(
	 *          'class' => 'bootstrap.widgets.TbButton',
	 *          'label' => '...',
	 *          'size' => '...',
	 *          ...
	 *        ),
	 *      array(
	 *          'class' => 'bootstrap.widgets.TbButtonGroup',
	 *          'buttons' => array( ... ),
	 *          'size' => '...',
	 *        ),
	 *      ...
	 * )
	 * </pre>
	 */
	public $buttons = array();

	/**
	 * Widget initialization
	 */
	public function init()
	{
		$classes = array('widget');

		$validTypes = array(self::TYPE_PRIMARY, self::TYPE_INFO, self::TYPE_SUCCESS, self::TYPE_WARNING, self::TYPE_DANGER, self::TYPE_INVERSE);

		if (isset($this->type) && in_array($this->type, $validTypes))
			$classes[] = 'widget-'.$this->type;		

		if (!empty($classes))
		{
			$classes = implode(' ', $classes);
			if (isset($this->htmlOptions['class']))
				$this->htmlOptions['class'] .= ' '.$classes;
			else
				$this->htmlOptions['class'] = $classes;
		}

		if (!isset($this->id))
			$this->htmlOptions['id'] = $this->getId();
		else
			$this->htmlOptions['id'] = $this->id;

		if (isset($this->htmlContentOptions['class']))
			$this->htmlContentOptions['class'] = 'widget-content ' . $this->htmlContentOptions['class'];
		else
			$this->htmlContentOptions['class'] = 'widget-content';

		/*if (!isset($this->htmlContentOptions['id']))
			$this->htmlContentOptions['id'] = $this->getId();*/

		if (isset($this->htmlHeaderOptions['class']))
			$this->htmlHeaderOptions['class'] = 'widget-header ' . $this->htmlHeaderOptions['class'];
		else
			$this->htmlHeaderOptions['class'] = 'widget-header';

		echo CHtml::openTag('div', $this->htmlOptions);

		$this->registerClientScript();
		$this->renderHeader();
		$this->renderContentBegin();
	}

	/**
	 * Widget run - used for closing procedures
	 */
	public function run()
	{
		$this->renderContentEnd();
		echo CHtml::closeTag('div') . "\n";
	}

	/**
	 * Renders the header of the box with the header control (button to show/hide the box)
	 */
	public function renderHeader()
	{
		if ($this->title !== false || $this->headerCtrl !== false)
		{
			echo CHtml::openTag('div', $this->htmlHeaderOptions);
			if ($this->title)
			{
				if (isset($this->icon))
				{
					if (strpos($this->icon, 'icon') === false)
						$this->icon = 'icon-'.implode(' icon-', explode(' ', $this->icon));

					$this->title = '<h3><i class="' . $this->icon . '"></i> ' . $this->title . '</h3>';
				} else {
					$this->title = '<h3>' . $this->title . '</h3>';
				}

				echo $this->title;
				$this->renderButtons();
			}

			echo CHtml::closeTag('div');
		}
	}

	/**
	 * Renders a header buttons to display the configured actions
	 */
	public function renderButtons()
	{
		if (empty($this->buttons))
			return;

		echo '<div class="widget-toolbar pull-right">';

		if(!empty($this->buttons) && is_array($this->buttons))
		{
			foreach($this->buttons as $button)
			{
				$options = $button;
				$button = $options['class'];
				unset($options['class']);

				if(strpos($button, 'TbButton') === false)
					throw new CException('message');

				if(!isset($options['htmlOptions']))
					$options['htmlOptions'] = array();

				$class = isset($options['htmlOptions']['class']) ? $options['htmlOptions']['class'] : '';
				//$options['htmlOptions']['class'] = $class .' pull-right';

				$this->controller->widget($button, $options);
			}
		}

		echo '</div>';
	}

	/*
	  * Renders the opening of the content element and the optional content
	  */
	public function renderContentBegin()
	{
		echo CHtml::openTag('div', $this->htmlContentOptions);
		if (!empty($this->content))
			echo $this->content;
	}

	/*
	 * Closes the content element
	 */
	public function renderContentEnd()
	{
		echo CHtml::closeTag('div');
	}

	/**
	 * Registers required script files (CSS in this case)
	 */
	public function registerClientScript()
	{
		Yii::app()->registerAssetCss('box.css');
	}
}