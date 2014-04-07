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
class BootstrapCode extends CrudCode
{
	public function generateActiveRow($modelClass, $column)
	{
		if ($column->type === 'boolean') {
			return "\$form->checkBoxRow(\$model,'{$column->name}')";
		} else if (stripos($column->dbType, 'text') !== false) {
			return "\$form->textAreaRow(\$model,'{$column->name}',array('rows'=>6, 'cols'=>50, 'class'=>'span8'))";
		} else {
			if (preg_match('/^(password|pass|passwd|passcode)$/i', $column->name)) {
				$inputField = 'passwordFieldRow';
			} else {
				$inputField = 'textFieldRow';
			}

			if ($column->type !== 'string' || $column->size === null) {
				if($column->dbType == 'date') {
					return "\$form->datepickerRow(\$model,'{$column->name}',array('options'=>array(),'htmlOptions'=>array('class'=>'span5')),array('prepend'=>'<i class=\"icon-calendar\"></i>','append'=>'Click on Month/Year at top to select a different year or type in (mm/dd/yyyy).'))";
				} else {
					return "\$form->{$inputField}(\$model,'{$column->name}',array('class'=>'span5'))";
				}
			} else {
				if (strpos ( $column->dbType, 'enum(' ) !== false) {
					$temp = $column->dbType;
					$temp = str_replace ( 'enum', 'array', $temp );
					eval ( '$options = ' . $temp . ';' );
					$dropdown_options = "array(";
					foreach ( $options as $option ) {
						$dropdown_options .= "\"$option\"=>\"$option\",";
					}
					$dropdown_options .= ")";
					return "\$form->dropDownListRow(\$model,'{$column->name}',{$dropdown_options},array('class'=>'input-large'))";
				} else {
					return "\$form->{$inputField}(\$model,'{$column->name}',array('class'=>'span5','maxlength'=>$column->size))";
				}
			}
		}
	}
}
