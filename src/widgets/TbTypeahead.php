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

		if (isset($this->datasets['source']))
			$this->datasets = array($this->datasets);

		$datasets_js = array();
		foreach ($this->datasets as $i => $dataset) {
			if (!isset($dataset['source'])) {
				throw new CException('The source for a Typeahead dataset was not set');
			}
			if (isset($dataset['source']['name'])) {
				$name = preg_replace('/[^\da-z]/i', '_', $dataset['source']['name']);
				$bloodhound_id = $this->id .'_bloodhound_'. $name;
				$dataset['source'] = 'js:'. $bloodhound_id .'.ttAdapter()';
			} else {
				$dataset['source'] = 'js:substringMatcher(_'. $this->id .'_source_list_'. $i .')';
			}
			$this->datasets[$i] = $dataset;
			$datasets_js[] = CJavaScript::encode($dataset);
		}
		
		$options = CJavaScript::encode($this->options);
		$datasets = implode(', ', $datasets_js);
		
		Yii::app()->clientScript->registerScript(__CLASS__ . '#' . $id, "jQuery('#{$id}').typeahead({$options}, {$datasets});");
		
	}

	function registerClientScript() {
	
		$booster = Booster::getBooster();
		$booster->registerPackage('typeahead');

		$datasets = $this->datasets;
		if (isset($this->datasets['source']))
			$datasets = array($this->datasets);

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

		if (isset($this->datasets['source']))
			$this->datasets = array($this->datasets);

		foreach ($datasets as $i => $dataset) {
			if (isset($dataset['source']['name'])) {
				$name = preg_replace('/[^\da-z]/i', '_', $dataset['source']['name']);
				$bloodhound_id = $this->id .'_bloodhound_'. $name;
				$bloodhound_config = CJavaScript::encode($dataset['source']);
				Yii::app()->clientScript->registerScript(__CLASS__ .'_'. $bloodhound_id, "
					var $bloodhound_id = new Bloodhound($bloodhound_config);
					$bloodhound_id.initialize();
				", CClientScript::POS_HEAD);
			} else {
				$source_list = CJavaScript::encode($dataset['source']);
				Yii::app()->clientScript->registerScript(__CLASS__ .'#source_list#'. $i, '
					var _'.$this->id.'_source_list_'. $i .' = '.$source_list.';
				', CClientScript::POS_HEAD);
			}
		}
	}
}
