<?php
/**
 * TbEditableColumn class file.
 *
 * @author Vitaliy Potapov <noginsk@rambler.ru>
 * @link https://github.com/vitalets/x-editable-yii
 * @copyright Copyright &copy; Vitaliy Potapov 2012
 * @version 1.3.1
 */

Yii::import('booster.widgets.TbEditable');
Yii::import('booster.widgets.TbEditableField');
Yii::import('zii.widgets.grid.CDataColumn');

/**
 * TbEditableColumn widget makes editable one column in CGridView.
 *
 * @package widgets
 */
class TbEditableColumn extends CDataColumn
{
    /**
    * @var array editable config options.
    * @see TbEditableField config
    */
    public $editable = array();

    public function init()
    {
        if (!$this->name) {
            throw new CException('You should provide name for TbEditableColumn');
        }

        parent::init();

        //need to attach ajaxUpdate handler to refresh editables on pagination and sort
        TbEditable::attachAjaxUpdateEvent($this->grid);
    }
   
    //protected was removed due to https://github.com/vitalets/x-editable-yii/issues/63
    public function renderDataCellContent($row, $data)
    {
        $isModel = $data instanceOf CModel;
        
        if($isModel) {
            $widgetClass = 'TbEditableField';
            $options = array(
                'model'        => $data,
                'attribute'    => empty($this->editable['attribute']) ? $this->name : $this->editable['attribute'],
            );
            
            //if value defined in column config --> we should evaluate it 
            //and pass to widget via `text` option: set flag `passText` = true 
            $passText = !empty($this->value);     
        } else {
            $widgetClass = 'TbEditable';
            $options = array(
                'pk'           => $data[$this->grid->dataProvider->keyField],
                'name'         => empty($this->editable['name']) ? $this->name : $this->editable['name'],
            );
            
            $passText = true;
            //if autotext will be applied, do not pass `text` option (pass `value` instead)
            if(empty($this->value) && TbEditable::isAutotext($this->editable, isset($this->editable['type']) ? $this->editable['type'] : '')) {
               $options['value'] = $data[$this->name]; 
               $passText = false;
            } 
        }
        
        //for live update
        $options['liveTarget'] = $this->grid->id;
        
        $options = CMap::mergeArray($this->editable, $options);

        //if value defined for column --> use it as element text
        if($passText) {
            ob_start();
            parent::renderDataCellContent($row, $data);
            $text = ob_get_clean();
            $options['text'] = $text;
            $options['encode'] = false;
        }
        
        //apply may be a string expression, see https://github.com/vitalets/x-editable-yii/issues/33
        if (isset($options['apply']) && is_string($options['apply'])) {
            $options['apply'] = $this->evaluateExpression($options['apply'], array('data'=>$data, 'row'=>$row));
        }

        //evaluate htmlOptions inside editable config as they can depend on $data
        //see https://github.com/vitalets/x-editable-yii/issues/40
        if (isset($options['htmlOptions']) && is_array($options['htmlOptions'])) {
            foreach($options['htmlOptions'] as $k => $v) {
                if(is_string($v) && (strpos($v, '$data') !== false || strpos($v, '$row') !== false)) {
                    $options['htmlOptions'][$k] = $this->evaluateExpression($v, array('data'=>$data, 'row'=>$row));
                }
            }
        }           
        
        $this->grid->controller->widget($widgetClass, $options);
    }
    
    /*
    Require this overwrite to show bootstrap sort icons
    */
    protected function renderHeaderCellContent()
    {
        /* TODO 
         if(yii::app()->editable->form != 'bootstrap') {
            parent::renderHeaderCellContent();
            return;
        } */
        
        if ($this->grid->enableSorting && $this->sortable && $this->name !== null)
        {
            $sort = $this->grid->dataProvider->getSort();
            $label = isset($this->header) ? $this->header : $sort->resolveLabel($this->name);

            if ($sort->resolveAttribute($this->name) !== false)
                $label .= '<span class="caret"></span>';

            echo $sort->link($this->name, $label, array('class'=>'sort-link'));
        }
        else
        {
            if ($this->name !== null && $this->header === null)
            {
                if ($this->grid->dataProvider instanceof CActiveDataProvider)
                    echo CHtml::encode($this->grid->dataProvider->model->getAttributeLabel($this->name));
                else
                    echo CHtml::encode($this->name);
            }
            else
                parent::renderHeaderCellContent();
        }
    } 
    
    /*
    Require this overwrite to show bootstrap filter field
    */    
    public function renderFilterCell()
    {
        /* TODO
        if(yii::app()->editable->form != 'bootstrap') {
            parent::renderFilterCell();
            return;
        } */
                
        echo '<td><div class="filter-container">';
        $this->renderFilterCellContent();
        echo '</div></td>';
    }       
}
