<?php
/**
 * TbImageColumn widget class
 *
 * @author: antonio ramirez <antonio@clevertech.biz>
 * @copyright Copyright &copy; Clevertech 2012-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 * @package YiiBooster bootstrap.widgets
 */
Yii::import('zii.widgets.grid.CGridColumn');

class TbImageColumn extends CGridColumn
{
	/**
	 * @var array the HTML options of the image tag
	 */
	public $imageOptions = array();

	/**
	 * @var string $imagePathExpression is evaluated in every data cell and
	 * is used as the path of the image. The expression will have:
	 * <code>$row</code> the row number
	 * <code>$data</code> the data model of the row
	 * <code>$this</code> the column object
	 */
	public $imagePathExpression;

	/**
	 * @var string $emptyText renders if  $imagePathExpression is null
	 */
	public $emptyText = '';

	/**
	 * @var bool $userPlaceHoldIt whether to use a bogus image from placehold.it or not. If true, will render an image
	 * from placehold.it according to the size set at $placeHoldItSize
	 */
	public $usePlaceHoldIt = true;

	/**
	 * @var string $placeHoldItSize the size of the image to render if $imagePathExpression is null and $userPlaceHoldIt
	 * is set to true
	 */
	public $placeHoldItSize = '48x48';

	/**
	 * Renders the data cell content
	 * @param int $row the row number (zero based)
	 * @param mixed $data teh data associated with the row
	 */
	protected function renderDataCellContent($row, $data)
	{
		$content = $this->emptyText;
		if ($this->imagePathExpression && $imagePath = $this->evaluateExpression($this->imagePathExpression, array('row' => $row, 'data' => $data)))
		{
			$this->imageOptions['src'] = $imagePath;
			$content = CHtml::tag('img', $this->imageOptions);
		} elseif ($this->usePlaceHoldIt)
		{
			$content = CHtml::tag('img', array('src'=>'http://placehold.it/' . $this->placeHoldItSize));
		}
		echo $content;
	}
}
