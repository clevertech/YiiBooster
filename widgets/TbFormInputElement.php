<?php
/**
 * TbFormInputElement class file.
 *
 * The inputElementClass for TbForm
 *
 * Support for Yii formbuilder
 *
 * @author Joe Blocher <yii@myticket.at>
 * @copyright Copyright &copy; Joe Blocher 2012-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 * @package bootstrap.widgets
 */

class TbFormInputElement extends CFormInputElement
{
    /**
     * Map element->type to TbActiveForm method
     * @var array this->type => TbActiveForm::method
     */
    public static $tbActiveFormMethods=array(
        'text'=>'textFieldRow',
        'password'=>'passwordFieldRow',
        'textarea'=>'textAreaRow',
        'file'=>'fileFieldRow',
        'radio'=>'radioButtonRow',
        'checkbox'=>'checkBoxRow',
        'listbox'=>'dropDownListRow',
        'dropdownlist'=>'dropDownListRow',
        'checkboxlist'=>'checkBoxListRow',
        'radiolist'=>'radioButtonListRow',

        //HTML5 types not supported in YiiBooster yet: render as textField
        'url'=>'textFieldRow',
        'email'=>'textFieldRow',
        'number'=>'textFieldRow',

        //'range'=>'activeRangeField', not supported yet
        'date'=>'datepickerRow',

        //new YiiBooster types
        'captcha'=>'captchaRow',
        'daterange'=>'dateRangeRow',
        'redactor'=>'redactorRow',
        'uneditable'=>'uneditableRow',
        'radiolistinline'=>'radioButtonListInlineRow',
        'checkboxlistinline'=>'checkBoxListInlineRow',
    );

    /**
     * @var array map the htmlOptions input type: not supported by YiiBooster yet
     */
    public static $htmlOptionTypes=array(
        'url'=>'url',
        'email'=>'email',
        'number'=>'number',
    );

    /**
     * Get the TbActiveForm instance
     * @return bool
     */
    protected function getActiveFormWidget()
    {
        return $this->getParent()->getActiveFormWidget();
    }

    /**
     * Prepare the htmlOptions before calling the TbActiveForm method
     *
     * @param $options
     * @return mixed
     */
    protected function prepareHtmlOptions($options)
    {
        if(!empty($this->hint)) //restore hint from config as attribute
           $options['hint'] = $this->hint;

        //HTML5 types not supported in YiiBooster yet
        //should be possible to set type="email", ... in the htmlOptions
        if(array_key_exists($this->type,self::$htmlOptionTypes))
            $options['type'] = self::$htmlOptionTypes[$this->type];

        return $options;
    }

    /**
     * Render this element using the mapped method from $tbActiveFormMethods
     */
    public function render()
    {
        if(!empty(self::$tbActiveFormMethods[$this->type]))
       {
           $method = self::$tbActiveFormMethods[$this->type];
           $model=$this->getParent()->getModel();
           $attribute=$this->name;
           $htmlOptions = $this->prepareHtmlOptions($this->attributes);

           switch($method)
           {
               case 'checkBoxListRow':
               case 'radioButtonListRow':
               case 'dropDownListRow':
               case 'radioButtonListInlineRow':
               case 'checkBoxListInlineRow':
                   return $this->getActiveFormWidget()->$method($model,$attribute,$this->items,$htmlOptions);

               default:
                   return $this->getActiveFormWidget()->$method($model,$attribute,$htmlOptions);
           }
       }


       return parent::render();
    }

}