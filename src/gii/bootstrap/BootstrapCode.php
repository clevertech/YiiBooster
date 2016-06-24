<?php
/**
 *## BootstrapCode class file.
 *
 * @author Christoffer Niska <ChristofferNiska@gmail.com>
 * @copyright Copyright &copy; Christoffer Niska 2011-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 */

Yii::import('gii.generators.crud.CrudCode');

/**
 *## Class BootstrapCode
 *
 * @package booster.gii
 */
class BootstrapCode extends CrudCode {
	
	public function generateActiveGroup($modelClass, $column) {
		
		if ($column->type === 'boolean') {
			return "\$form->checkBoxGroup(\$model,'{$column->name}')";
		} else if (stripos($column->dbType, 'tinyint(1)') !== false) {
			return "\$form->checkboxGroup(\$model,'{$column->name}')";
		} else if (stripos($column->dbType, 'double') !== false || stripos($column->dbType, 'int') !== false || stripos($column->dbType, 'float') !== false) {
			return "\$form->numberFieldGroup(\$model,'{$column->name}')";
		} else if (stripos($column->dbType, 'text') !== false) {
			return "\$form->textAreaGroup(\$model,'{$column->name}', array('widgetOptions'=>array('htmlOptions'=>array('rows'=>6, 'cols'=>50))))";
		} else {
			if (preg_match('/^(password|pass|passwd|passcode)$/i', $column->name)) {
				$inputField = 'passwordFieldGroup';
			} else {
				$inputField = 'textFieldGroup';
			}

			if ($column->type !== 'string' || $column->size === null) {
				if($column->dbType == 'date') {
					return "\$form->datePickerGroup(\$model,'{$column->name}',array('widgetOptions'=>array('options'=>array(),'htmlOptions'=>array()), 'prepend'=>'<i class=\"glyphicon glyphicon-calendar\"></i>', 'append'=>'Click on Month/Year to select a different Month/Year.'))";
				} else {
					return "\$form->{$inputField}(\$model,'{$column->name}',array('widgetOptions'=>array('htmlOptions'=>array())))";
				}
			} else {
				if (strpos ( $column->dbType, 'enum(' ) !== false) {
					$matches = '';
					preg_match('/^enum\((.*)\)$/', $column->dbType, $matches);
					$options = array();
					foreach( explode(',', $matches[1]) as $value ) {
						$options[] = trim( $value, "'" );
					}
					$dropdown_options = "array(";
					foreach ( $options as $option ) {
						$dropdown_options .= "\"$option\"=>\"$option\",";
					}
					$dropdown_options .= ")";
					return "\$form->dropDownListGroup(\$model,'{$column->name}', array('widgetOptions'=>array('data'=>{$dropdown_options}, 'htmlOptions'=>array('class'=>'input-large'))))";
				} else {
					return "\$form->{$inputField}(\$model,'{$column->name}',array('widgetOptions'=>array('htmlOptions'=>array('maxlength'=>$column->size))))";
				}
			}
		}
	}
}
