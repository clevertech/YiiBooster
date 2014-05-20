<?php
/**
 *## TbPager class file.
 *
 * @author Christoffer Niska <ChristofferNiska@gmail.com>
 * @copyright Copyright &copy; Christoffer Niska 2011-
 * @license [New BSD License](http://www.opensource.org/licenses/bsd-license.php)
 */

/**
 *## Bootstrap pager.
 *
 * @see <http://twitter.github.com/bootstrap/components.html#pagination>
 *
 * @package booster.widgets.supplementary
 */
class TbPager extends CLinkPager {
	
	// Pager alignments.
	const ALIGNMENT_CENTER = 'centered';
	const ALIGNMENT_RIGHT = 'right';

	/**
	 * @var string attributes for the pager container tag.
	 */
	public $containerTag = 'div';
	
	/**
	 * @var array HTML attributes for the pager container tag.
	 */
	public $containerHtmlOptions = array();
	
	/**
	 * @var string the pager alignment.
	 * Valid values are 'centered' and 'right'.
	 */
	public $alignment = self::ALIGNMENT_RIGHT;

	/**
	 * @var string the text shown before page buttons.
	 * Defaults to an empty string, meaning that no header will be displayed.
	 */
	public $header = '';
	
	/**
	 * @var string the URL of the CSS file used by this pager.
	 * Defaults to false, meaning that no CSS will be included.
	 */
	public $cssFile = false;

	/**
	 * @var boolean whether to display the first and last items.
	 */
	public $displayFirstAndLast = false;

	/**
	 *### .init()
	 *
	 * Initializes the pager by setting some default property values.
	 */
	public function init() {
		
		if ($this->nextPageLabel === null) {
			$this->nextPageLabel = '&raquo;';
		}

		if ($this->prevPageLabel === null) {
			$this->prevPageLabel = '&laquo;';
		}

		$classes = array('pagination');

		/* TODO: move these to styles files! */
		$style = '';
		$containerStyle = '';
		
		$validAlignments = array(self::ALIGNMENT_CENTER, self::ALIGNMENT_RIGHT);

		if (in_array($this->alignment, $validAlignments)) {
			if($this->alignment == self::ALIGNMENT_RIGHT)
				$classes[] = 'pull-right';
			
			if($this->alignment == self::ALIGNMENT_CENTER) {
				// $style = 'margin-left: auto; margin-right: auto;'; // not needed!
				$containerStyle = 'text-align: center;';
			}
		}

		if (!empty($classes)) {
			$classes = implode(' ', $classes);
			if (isset($this->htmlOptions['class'])) {
				$this->htmlOptions['class'] = ' ' . $classes;
			} else {
				$this->htmlOptions['class'] = $classes;
			}
		}
		
		if(!empty($style)) {
			if(isset($this->htmlOptions['style']) && !empty($this->htmlOptions['style']))
				$this->htmlOptions['style'] .= ' '.$style;
			else 
				$this->htmlOptions['style'] = $style;
		}
		
		if(!empty($containerStyle)) {
			if(isset($this->containerHtmlOptions['style']) && !empty($this->containerHtmlOptions['style']))
				$this->containerHtmlOptions['style'] .= ' '.$containerStyle;
			else
				$this->containerHtmlOptions['style'] = $containerStyle;
		}

		parent::init();
	}
	
	/**
	 * Executes the widget.
	 * This overrides the parent implementation by displaying the generated page buttons.
	 */
	public function run() {
		
		$this->registerClientScript();
		$buttons=$this->createPageButtons();
		if(empty($buttons))
			return;
		echo CHtml::openTag($this->containerTag, $this->containerHtmlOptions);
		echo $this->header;
		echo CHtml::tag('ul',$this->htmlOptions,implode("\n",$buttons));
		echo '<div style="clear: both;"></div>';
		echo $this->footer;
		echo CHtml::closeTag($this->containerTag);
	}

	/**
	 *### .createPageButtons()
	 *
	 * Creates the page buttons.
	 * @return array a list of page buttons (in HTML code).
	 */
	protected function createPageButtons() {

		if (($pageCount = $this->getPageCount()) <= 1) {
			return array();
		}

		list ($beginPage, $endPage) = $this->getPageRange();

		$currentPage = $this->getCurrentPage(false); // currentPage is calculated in getPageRange()

		$buttons = array();

		// first page
		if ($this->displayFirstAndLast) {
			$buttons[] = $this->createPageButton($this->firstPageLabel, 0, 'first', $currentPage <= 0, false);
		}

		// prev page
		if (($page = $currentPage - 1) < 0) {
			$page = 0;
		}

		$buttons[] = $this->createPageButton($this->prevPageLabel, $page, 'previous', $currentPage <= 0, false);

		// internal pages
		for ($i = $beginPage; $i <= $endPage; ++$i) {
			$buttons[] = $this->createPageButton($i + 1, $i, '', false, $i == $currentPage);
		}

		// next page
		if (($page = $currentPage + 1) >= $pageCount - 1) {
			$page = $pageCount - 1;
		}

		$buttons[] = $this->createPageButton(
			$this->nextPageLabel,
			$page,
			'next',
			$currentPage >= ($pageCount - 1),
			false
		);

		// last page
		if ($this->displayFirstAndLast) {
			$buttons[] = $this->createPageButton(
				$this->lastPageLabel,
				$pageCount - 1,
				'last',
				$currentPage >= ($pageCount - 1),
				false
			);
		}

		return $buttons;
	}

	/**
	 *### .createPageButton()
	 *
	 * Creates a page button.
	 * You may override this method to customize the page buttons.
	 *
	 * @param string $label the text label for the button
	 * @param integer $page the page number
	 * @param string $class the CSS class for the page button. This could be 'page', 'first', 'last', 'next' or 'previous'.
	 * @param boolean $hidden whether this page button is visible
	 * @param boolean $selected whether this page button is selected
	 *
	 * @return string the generated button
	 */
	protected function createPageButton($label, $page, $class, $hidden, $selected)
	{
		if ($hidden || $selected) {
			$class .= ' ' . ($hidden ? 'disabled' : 'active');
		}

		return CHtml::tag('li', array('class' => $class), CHtml::link($label, $this->createPageUrl($page)));
	}
}
