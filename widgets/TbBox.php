<?php
/**
 * TbBox widget class
 *
 * @author: antonio ramirez <antonio@clevertech.biz>
 * @copyright Copyright &copy; Clevertech 2012-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 * @package YiiBooster bootstrap.widgets
 */
class TbBox extends CWidget
{
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
	public $headerIcon;


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
	 * @var array the configuration for additional header actions. Each array element specifies a single menu item
	 * which has the following format:
	 * <pre>
	 *     array(
	 *     'label'=>'...',     // text label of the menu
	 *     'url'=>'...',       // link of the menu item
	 *     'icon'=>'...',  // icon of the menu item. If set will be prepended to the label.
	 *     'linkOptions'=>array(...), // HTML options for the menu item link tag
	 * )
	 * </pre>
	 */
	public $headerActions = array();

	/**
	 * @var string $headerButtonActionsLabel sets the label of the button with dropdown actions
	 */
	public $headerButtonActionsLabel = 'Actions';

	/**
	 * Widget initialization
	 */
	public function init()
	{
		if (isset($this->htmlOptions['class']))
			$this->htmlOptions['class'] = 'bootstrap-widget ' . $this->htmlOptions['class'];
		else
			$this->htmlOptions['class'] = 'bootstrap-widget';

		if (isset($this->htmlContentOptions['class']))
			$this->htmlContentOptions['class'] = 'bootstrap-widget-content ' . $this->htmlContentOptions['class'];
		else
			$this->htmlContentOptions['class'] = 'bootstrap-widget-content';

		if (!isset($this->htmlContentOptions['id']))
			$this->htmlContentOptions['id'] = $this->getId();

		if (isset($this->htmlHeaderOptions['class']))
			$this->htmlHeaderOptions['class'] = 'bootstrap-widget-header ' . $this->htmlHeaderOptions['class'];
		else
			$this->htmlHeaderOptions['class'] = 'bootstrap-widget-header';

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
		if ($this->title !== false)
		{
			echo CHtml::openTag('div', $this->htmlHeaderOptions);
			if ($this->title)
			{
				$this->title = '<h3>' . $this->title . '</h3>';

				if ($this->headerIcon)
				{
					$this->title = '<i class="' . $this->headerIcon . '"></i>' . $this->title;
				}

				echo $this->title;
				$this->renderActions();
			}

			echo CHtml::closeTag('div');
		}
	}

	/**
	 * Renders a small button dropdown box to display the configured actions
	 */
	public function renderActions()
	{
		if (empty($this->headerActions))
			return;

		echo '<div class="bootstrap-toolbar pull-right">';

		$this->controller->widget('bootstrap.widgets.TbButtonGroup',
			array(
				'type' => '',
				'size' => 'mini',
				'buttons' => array(
					array(
						'label' => $this->headerButtonActionsLabel,
						'url' => '#'),
					array(
						'items' => $this->headerActions
					))
			));
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
		Yii::app()->bootstrap->registerAssetCss('bootstrap-box.css');

	}
}