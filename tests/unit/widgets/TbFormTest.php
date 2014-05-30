<?php
/**
 * YiiBooster project.
 * @license [New BSD License](http://www.opensource.org/licenses/bsd-license.php)
 */

require_once(__DIR__ . '/../../../src/widgets/TbForm.php');
require_once(__DIR__ . '/../../../src/widgets/TbFormInputElement.php');
require_once(__DIR__ . '/../../../src/widgets/TbFormButtonElement.php');
require_once(__DIR__ . '/../../../src/widgets/TbButton.php');

class TbFormTest extends PHPUnit_Framework_TestCase {
	
	/**
	 * Test for whole TbForm class.
	 * Just ensure that class works fine.
	 */
	public function testCommon() {
		
		$model = new FakeTbFormModel;

		$form = new TbForm(array(
			'title' => 'Form builder test form',
			'showErrorSummary' => true,
			'activeForm' => array(
				'type' => 'horizontal',
				'htmlOptions' => array('class' => 'well', 'style' => 'width:500px')
			),
			'elements' => array(
				'text' => array('type' => 'text'),
				'hidden' => array('type' => 'hidden'),
				'password' => array('type' => 'password'),
				'textarea' => array('type' => 'textarea'),
				'file' => array('type' => 'file'),
				'radio' => array('type' => 'radio'),
				'checkbox' => array('type' => 'checkbox'),
				'listbox' => array('type' => 'listbox'),
				'dropdownlist' => array('type' => 'dropdownlist'),
				'checkboxlist' => array('type' => 'checkboxlist'),
				'radiolist' => array('type' => 'radiolist'),
				'url' => array('type' => 'url'),
				'email' => array('type' => 'email'),
				'number' => array('type' => 'number'),
				'range' => array('type' => 'range'),
				'date' => array('type' => 'date'),
				'time' => array('type' => 'time'),
				'tel' => array('type' => 'tel'),
				'search' => array('type' => 'search'),
				// extended fields
				'switch' => array('type' => 'switch'),
				'datepicker' => array('type' => 'datepicker'),
				'daterange' => array('type' => 'daterange'),
				'timepicker' => array('type' => 'timepicker'),
				'datetimepicker' => array('type' => 'datetimepicker'),
				'select2' => array('type' => 'select2'),
				'redactor' => array('type' => 'redactor'),
				'html5editor' => array('type' => 'html5editor'),
				'markdowneditor' => array('type' => 'markdowneditor'),
				'ckeditor' => array('type' => 'ckeditor'),
				'typeahead' => array('type' => 'typeahead'),
				'maskedtext' => array(
					'type' => 'maskedtext',
					'attributes' => array('widgetOptions'=>array('mask' => 'DD/DD/DDDD')), // this is a hack ... needs a fix @see TbFormInputElement@184
				),
				'colorpicker' => array('type' => 'colorpicker'),
				//'captcha' => array('type' => 'captcha'),
				'pass' => array('type' => 'pass'),
			),
			'buttons' => array(
				'submit' => array(
					'context' => 'primary',
					'buttonType' => 'submit',
					'label' => 'Submit',
				),
				'reset' => array(
					'buttonType' => 'reset',
					'label' => 'Reset',
				),
			),
		), $model);

		$form->render();
	}
}

class FakeTbFormModel extends CFormModel
{
	public $text;
	public $hidden;
	public $password;
	public $textarea;
	public $file;
	public $radio;
	public $checkbox;
	public $listbox;
	public $dropdownlist;
	public $checkboxlist;
	public $radiolist;
	public $url;
	public $email;
	public $number;
	public $range;
	public $date;
	public $time;
	public $tel;
	public $search;
	public $toggle;
	public $datepicker;
	public $daterange;
	public $timepicker;
	public $datetimepicker;
	public $select2;
	public $redactor;
	public $html5editor;
	public $markdowneditor;
	public $ckeditor;
	public $typeahead;
	public $maskedtext;
	public $colorpicker;
	//public $captcha;
	public $pass;

	public function rules()
	{
		return array(
			array(
				'text,hidden,password,textarea,file,radio,checkbox,listbox,dropdownlist,checkboxlist,radiolist,url'
				.',email,number,range,date,time,tel,search,toggle,datepicker,daterange,timepicker,datetimepicker'
				.',select2,redactor,html5editor,markdowneditor,ckeditor,typeahead,maskedtext,colorpicker,pass','safe'
			)
		);
	}

}