<?php
/**
 *## TbTypeahead class file.
 *
 * @author Amr Bedair <amr.bedair@gmail.com>
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 * @since v4.0.0
 * 
 * @todo add support of bloodhound datasets, and remote ajax 
 * @see <https://github.com/twitter/typeahead.js/blob/master/doc/jquery_typeahead.md#bloodhound-integration>
 */

/**
 *## Twitter typeahead widget.
 *
 * @see https://github.com/twitter/typeahead.js
 *
 * @since 4.0.0
 * @package booster.widgets.forms.inputs
 */

Yii::import('booster.widgets.TbBaseInputWidget');

class TbTypeahead extends TbBaseInputWidget {
	
	/**
	 * @var array the options for the twitter typeahead widget
	 * @see <https://github.com/twitter/typeahead.js/blob/master/doc/jquery_typeahead.md#options>
	 */
	public $options = array();
	
	/**
	 * @var array the datasets for the twitter typeahead widget 
	 * @see <https://github.com/twitter/typeahead.js/blob/master/doc/jquery_typeahead.md#datasets>
	 */
	public $datasets = array();

	/**
	 * Initializes the widget.
	 */
	public function init() {
		
		if(!isset($this->datasets['source']))
			$this->datasets['source'] = array();
		
		// @todo: which one is more correct? 
		// if(!isset($this->datasets['source']) || empty($this->datasets['source']))
			// throw new CException('you must provide datasets["source"] option');
		
		if(empty($this->options))
			$this->options['minLength'] = 1;
		$this->registerClientScript();
		
		if(!isset($this->htmlOptions['class']) || empty($this->htmlOptions['class']))
			$this->htmlOptions['class'] = 'typeahead';
		else
			$this->htmlOptions['class'] .= ' typeahead';
		
		parent::init();
	}

	/**
	 * Runs the widget.
	 */
	public function run() {
		// print_r($this->htmlOptions); //typeahead
		list($name, $id) = $this->resolveNameID();

		if (isset($this->htmlOptions['id'])) {
			$id = $this->htmlOptions['id'];
		} else {
			$this->htmlOptions['id'] = $id;
		}

		if (isset($this->htmlOptions['name'])) {
			$name = $this->htmlOptions['name'];
		}

		if ($this->hasModel()) {
			echo CHtml::activeTextField($this->model, $this->attribute, $this->htmlOptions);
		} else {
			echo CHtml::textField($name, $this->value, $this->htmlOptions);
		}

		$this->datasets['source'] = 'js:substringMatcher(_'.$this->id.'_source_list)';
		
		$options = CJavaScript::encode($this->options);
		$datasets = CJavaScript::encode($this->datasets);
		
		Yii::app()->clientScript->registerScript(__CLASS__ . '#' . $id, "jQuery('#{$id}').typeahead({$options}, {$datasets});");
		
	}

	/**
	 * 
	 * @param unknown $id
	 */
	function registerClientScript() {
	
		$booster = Booster::getBooster();
		$booster->registerPackage('typeahead');
		
		if(empty($this->datasets) || !isset($this->datasets['source']) || !is_array($this->datasets['source']))
			return;
		
		Yii::app()->clientScript->registerScript(__CLASS__ . '#substringMatcher', '
			var substringMatcher = function(strs) {
				return function findMatches(q, cb) {
					var matches, substringRegex;
					 
					// an array that will be populated with substring matches
					matches = [];
					 
					// regex used to determine if a string contains the substring `q`
					substrRegex = new RegExp(q, "i");
					 
					// iterate through the pool of strings and for any string that
					// contains the substring `q`, add it to the `matches` array
					$.each(strs, function(i, str) {
						if (substrRegex.test(str)) {
							// the typeahead jQuery plugin expects suggestions to a
							// JavaScript object, refer to typeahead docs for more info
							matches.push({ value: str });
						}
					});
					 
					cb(matches);
				};
			};
		', CClientScript::POS_HEAD);
		
		$source_list = !empty($this->options) ? CJavaScript::encode($this->datasets['source']) : '';
		Yii::app()->clientScript->registerScript(__CLASS__ . '#source_list#'.$this->id, '
			var _'.$this->id.'_source_list = '.$source_list.';
		', CClientScript::POS_HEAD);
	}
}
