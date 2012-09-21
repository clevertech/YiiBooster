<?php
/**
 * TbRedactorJs class
 *
 * @author: antonio ramirez <antonio@clevertech.biz>
 * @copyright Copyright &copy; Clevertech 2012-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 * @package YiiBooster bootstrap.widgets
 */
class TbRedactorJS extends CInputWidget
{
	/**
	 * Editor language
	 * Supports: de, en, fr, lv, pl, pt_br, ru, ua
	 */
	public $lang = 'en';
	/**
	 * Html options that will be assigned to the text area
	 */
	public $htmlOptions = array();
	/**
	 * Editor options that will be passed to the editor
	 */
	public $editorOptions = array();
	/**
	 * Debug mode
	 * Used to publish full js file instead of min version
	 */
	public $debugMode = false;
	/**
	 * Editor width
	 */
	public $width = '100%';
	/**
	 * Editor height
	 */
	public $height = '400px';

	/**
	 * Display editor
	 */
	public function run()
	{

		list($name, $id) = $this->resolveNameID();

		$this->registerClientScript($id);

		$this->htmlOptions['id'] = $id;

		if (!array_key_exists('style', $this->htmlOptions))
		{
			$this->htmlOptions['style'] = "width:{$this->width};height:{$this->height};";
		}
		// Do we have a model?
		if ($this->hasModel())
		{
			$html = CHtml::activeTextArea($this->model, $this->attribute, $this->htmlOptions);
		} else
		{
			$html = CHtml::textArea($name, $this->value, $this->htmlOptions);
		}
		echo $html;
	}

	/**
	 * Register required script files
	 * @param $id
	 */
	public function registerClientScript($id)
	{
		Yii::app()->bootstrap->registerAssetCss('redactor.css');
		Yii::app()->bootstrap->registerAssetJs('redactor.min.js');

		$options = CJSON::encode(CMap::mergeArray($this->editorOptions, array('lang' => $this->lang)));

		Yii::app()->bootstrap->registerRedactor('#'.$id, $options);
	}
}

?>
