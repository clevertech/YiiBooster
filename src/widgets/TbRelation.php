<?php
/*
	 The Relation widget is used in forms, where the User can choose
	 between a selection of model elements, that this models belongs to.

	 It is able to handle BELONGS_TO, HAS_ONE and MANY_MANY Relations. The Relation
	 type is detected automatically from the Model 'relations()' section.

	 The Widget has different styles in which it can render the possible choices.
	 Use the 'style' option to set the appropriate style.

	 The following example shows how to use Relation with a minimal config,
	 assuming we have a Model "Post" and "User", where one User belongs
	 to a Post:

	 <pre>
	 $this->widget('application.components.Relation', array(
	 'model' => 'Post',
	 'relation' => 'user'
	 'fields' => 'username' // show the field "username" of the parent element
	 ));
	 </pre>

	 Results in a drop down list in which the user can choose between
	 all available Users in the Database. The shown field of the
	 Table "User" is "username" in this example.

	 You can choose the Style of your Widget in the 'style' option.
	 Note that a Many_Many Relation always gets rendered as a Listbox,
	 since you can select multiple Elements.

	 'fields' can be an array or an string.
	 If you pass an array to 'fields', the Widget will display every field in
	 this array. If you want to show further sub-relations, separate the values
	 with '.', for example: 'fields' => 'array('parent.grandparent.description')

	 Optional Parameters:

	 You can use 'field' => 'post_userid' if the field in the model
	 that represents the foreign model is called different than in the
	 relation

	 Use 'relatedPk' => 'id_of_user' if the primary Key of the Foreign
	 Model differs from the one given in the relation.

	 Normally you shouldn´t use this fields cause the Widget get the relations
	 automatically from the relation.

	 Use 'allowEmpty' to let the user be able to choose no parent. If you
	 set this to a string, this string will be displayed with the available
	 choices.

	 With 'showAddButton' => 'false' you can disable the 'create new Foreignkey'
	 Button generated beside the Selectbox.

	 Define the AddButtonString with 'addButtonString' => 'Add...'. This string
	 is set default to '+'

	 When using the '+' button you most likely want to return to where you came.
	 To accomplish this, we pass a 'returnTo' parameter by $_GET.
	 The Controller can send the user back to where he came from this way:

	 <pre>
	 if($model->save())
	 if(isset($_GET['returnTo']))
	 $this->redirect(array(urldecode($_GET['returnTo'])));
	 </pre>

	 Using the 'style' option we can configure how our Widget gets rendered.
	 The following styles are available:
	 Selectbox (default), Listbox, Checkbox and in MANY_MANY relations 'twopane'
	 The style is case insensitive so one can use dropdownlist or dropDownList.

Use the option 'createAction' if the action to add additional foreign Model
options differs from 'create'.

With 'parentObjects' you can limit the Parent Elements that are being shown.
It takes an array of elements that could be returned from an scope or
an SQL Query.

The parentObjects can be grouped, for example,  with
'groupParentsBy' => 'city'

Use the option 'htmlOptions' to pass any html Options to the
Selectbox/Listbox form element.

Full Example:
<pre>
$this->widget('application.components.Relation', array(
			'model' => 'Post',
			'field' => 'Userid',
			'style' => 'ListBox',
			'criteria' => new CDBCriteria(array('condition' => 'id_of_user IN (1,8,20)')),
			'parentObjects' => Parentmodel::model()->findAll('userid = 17'),
			'groupParentsBy' => 'city',
			'relation' => 'user',
			'relatedPk' => 'id_of_user',
			'fields' => array( 'username', 'username.group.groupid' ),
			'delimiter' => ' -> ', // default: ' | '
			'returnTo' => 'model/create',
			'addButtonUrl' => 'othercontroller/otheraction', // default: ''
			'showAddButton' => 'click here to add a new User', // default: ''
			'htmlOptions' => array('style' => 'width: 100px;')
			));
</pre>


@author Herbert Maschke <thyseus@gmail.com>
@version 0.97 (after 1.0rc5)
@since 1.1
*/

class Relation extends CWidget
{
    // this Variable holds an instance of the Object
    protected $_model;

    // this Variable holds an instance of the related Object
    protected $_relatedModel;

    // draw the relation of which model?
    public $model;

    // which relation should be rendered?
    public $relation;

    public $field;

    // the Primary Key of the foreign Model
    public $relatedPk;

    // a field or an array of fields that determine which field values
    // should be rendered in the selection
    public $fields;

    // if this is set, the User is able to select no related model
    // if this is set to a string, this string will be presented
    public $allowEmpty = 0;

    // Preselect which items?
    public $preselect = false;

    // disable this to hide the Add Button
    // set this to a string to set the String to be displayed
    public $showAddButton = true;
    public $addButtonUrl = '';
    // url for the action that refreshes the dropdownlist after related
    // object is created
    public $addButtonRefreshUrl = '';

    // criteria for filtering records
    public $criteria = false;

    // How the label of a row should be rendered. {id} will be replaced by the
    // id of the model. You can also insert every field that is available in the
    // parent object.
    // Use {fields} to display all fields delimited by $this->delimiter
    // Use {myFuncName} to evaluate a user-contributed function specified in the
    //  $functions array as 'myFuncName'=>'code to be evaluated'. The code for
    //  these functions are evaluated under the context of the controller
    //  rendering the current Relation widget ($this refers to the controller).
    // Old way, not encouraged anymore: Use {func0} to {funcX} to evaluate user-
    //  contributed functions specified in the $functions array as a keyless
    //  string entry of 'code to be evaluated'.
    // Example of code:
    //
    // 'template' => '#{id} : {fields} ({title}) Allowed other Models: {func0} {func1} {preferredWay}',
    // 'functions' => array(
    //		"CHtml::checkBoxList('parent{id}', '', CHtml::listData(Othermodel::model()->findAll(), 'id', 'title'));",
    //      '$this->funcThatReturnsText();'
    //      'preferredWay' => '$this->instructMe();'
    // ),
    public $template = '{fields}';

    // User-contributed functions, see comment for $template.
    public $functions = array();

    // If true, all the user-contributed functions in $functions will be
    //  substituted in $htmlOptions['template'] as well.
    // If an array of function names, all the listed functions will be
    //  substituted in $htmlOptions['template'] as well.
    public $functionsInHtmlOptionsTemplate = false;

    // how should multiple fields be delimited
    public $delimiter = " | ";

    // style of the selection Widget
    public $style = "dropDownList";
    public $htmlOptions = array();
    public $parentObjects = 0;
    public $orderParentsBy = 0;
    public $groupParentsBy = 0;

    // override this for complicated MANY_MANY relations:
    public $manyManyTable = '';
    public $manyManyTableLeft = '';
    public $manyManyTableRight = '';

    public $num = 1;

    public function init()
    {
        if (!is_object($this->model)) {
            if (!$this->_model = new $this->model) {
                throw new CException(
                    Yii::t('yii', 'Relation widget is not able to instantiate the given Model'));
            }
        }
        else {
            $this->_model = $this->model;
        }

        // Instantiate Model and related Model
        foreach ($this->_model->relations() as $key => $value) {
            if (strcmp($this->relation, $key) == 0) {
                // $key = Name of the Relation
                // $value[0] = Type of the Relation
                // $value[1] = Related Model
                // $value[2] = Related Field or Many_Many Table
                switch ($value[0]) {
                    case 'CBelongsToRelation':
                    case 'CHasOneRelation':
                        $this->_relatedModel = new $value[1];
                        if (!isset($this->field)) {
                            $this->field = $value[2];
                        }
                        break;
                    case 'CManyManyRelation':
                        preg_match_all('/^.*\(/', $value[2], $matches);
                        $this->manyManyTable = substr($matches[0][0], 0, strlen($matches[0][0]) - 1);
                        preg_match_all('/\(.*,/', $value[2], $matches);
                        $this->manyManyTableLeft = substr($matches[0][0], 1, strlen($matches[0][0]) - 2);
                        preg_match_all('/,.*\)/', $value[2], $matches);
                        $this->manyManyTableRight = substr($matches[0][0], 2, strlen($matches[0][0]) - 3);

                        $this->_relatedModel = new $value[1];
                        break;
                }
            }
        }

        if (!is_object($this->_relatedModel)) {
            throw new CException(
                Yii::t('yii', 'Relation widget cannot find the given Relation(' . $this->relation . ')'));
        }

        if (!isset($this->relatedPk) || $this->relatedPk == "") {
            $this->relatedPk = $this->_relatedModel->tableSchema->primaryKey;
        }

        if (!isset($this->fields) || $this->fields == "" || $this->fields == array()) {
            throw new CException(Yii::t('yii', 'Widget "Relation" has been run without fields Option(string or array)'));
        }
    }

    // Check if model-value contains '.' and generate -> directives:
    public function getModelData($model, $field)
    {
        if (strstr($field, '.')) {
            $data = explode('.', $field);
            $value = $model->getRelated($data[0])->$data[1];
        }
        else {
            $value = $model->$field;
        }

        return $value;
    }

    /**
     * This function fetches all needed data of the related Object and returns them
     * in an array that is prepared for use in ListData.
     */
    public function getRelatedData()
    {
        /* At first we determine, if we want to display all parent Objects, or
         * if the User supplied an list of Objects */
        if (is_object($this->parentObjects)) // a single Element
        {
            $parentobjects = array($this->parentObjects);
        }
        else {
            if (is_array($this->parentObjects)) // Only show this elements
            {
                $parentobjects = $this->parentObjects;
            }
            else // Show all Parent elements
            {
                if ($this->criteria === false) {
                    // TODO: reimplement ORDER BY array('order'=>GHelper::guessNameColumn($this->_relatedModel->tableSchema->columns))
                    $parentobjects = CActiveRecord::model(get_class($this->_relatedModel))->findAll();
                }
                else {
                    $parentobjects = CActiveRecord::model(get_class($this->_relatedModel));
                    $parentobjects->setDbCriteria($this->criteria);
                    // TODO: reimplement ORDER BY array('order'=>GHelper::guessNameColumn($this->_relatedModel->tableSchema->columns))
                    $parentobjects = $parentobjects->findAll();
                }
            }
        }

        if ($this->allowEmpty) {
            if (is_string($this->allowEmpty)) {
                $dataArray[''] = $this->allowEmpty;
            }
            else {
                $dataArray[''] = Yii::t('app', 'None');
            }
        }

        foreach ($parentobjects as $obj) {
            if (!is_array($this->fields)) {
                $this->fields = array($this->fields);
            }

            $fields = '';
            $i = 0;
            foreach ($this->fields as $field) {
                $rule = sprintf('{%s}', $field);
                $rules[$rule] = $this->getModelData($obj, $field);

                if ($i++ > 0) {
                    $fields .= $this->delimiter;
                }
                $fields .= $this->getModelData($obj, $field);
            }

            $defaultrules = array(
                '{fields}' => $fields,
                '{id}' => $obj->{$obj->tableSchema->primaryKey});

            // Look for user-contributed functions and evaluate them
            if ($this->functions != array()) {
                foreach ($this->functions as $key => $function) {
                    // If the key is of type string, it's assumed to be a named function,
                    //  used like {myFuncName}.
                    // If the key is an integer, it's assumed to be an unnamed function used
                    //  the old way, {funcX} where X is its index in the functions array.
                    // We keep the integer support mostly for backwards compatibility, the
                    //  new way is encouraged.
                    if (is_string($key)) {
                        $funcrules[sprintf('{%s}', $key)] = $this->controller->evaluateExpression(
                            strtr($function, $defaultrules));
                    }
                    else {
                        $funcrules[sprintf('{func%d}', $key)] = $this->controller->evaluateExpression(
                            strtr($function, $defaultrules));
                    }
                }
            }

            // Merge the evaluated rules, if exist
            if (isset($funcrules)) {
                $rules = array_merge($rules, $funcrules);
            }

            // Merge the default rules into our ruleset
            $rules = array_merge($rules, $defaultrules);

            // Apply the rules to the template
            $value = strtr($this->template, $rules);

            // Apply the user contributed functions to $htmlOptions's template, if requested.
            if (isset($this->htmlOptions['template']) && $this->functionsInHtmlOptionsTemplate !== false && isset($funcrules) && is_array($funcrules)) {
                if (is_array($this->functionsInHtmlOptionsTemplate)) {
                    $funcrulesToUse = array();
                    foreach ($this->functionsInHtmlOptionsTemplate as $functionName) {
                        $functionName = sprintf('{%s}', $functionName);
                        if (isset($funcrules[$functionName])) {
                            $funcrulesToUse[$functionName] = $funcrules[$functionName];
                        }
                    }
                    $this->htmlOptions['template'] = strtr($this->htmlOptions['template'], $funcrulesToUse);
                }
                else {
                    $this->htmlOptions['template'] = strtr($this->htmlOptions['template'], $funcrules);
                }
            }

            if ($this->groupParentsBy != '') {
                $dataArray[$obj->{$this->groupParentsBy}][$obj->{$this->relatedPk}] = $value;
            }
            else {
                $dataArray[$obj->{$this->relatedPk}] = $value;
            }
        }

        if (!isset($dataArray) || !is_array($dataArray)) {
            $dataArray = array();
        }

        return $dataArray;
    }


    /**
     * Retrieves the Assigned Objects of the MANY_MANY related Table
     */
    public function getAssignedObjects()
    {
        if (!$this->_model->{$this->_model->tableSchema->primaryKey}) {
            return array();
        }

        $sql = sprintf("select * from %s where %s = %s",
                       $this->manyManyTable,
                       $this->manyManyTableLeft,
                       $this->_model->{$this->_model->tableSchema->primaryKey});

        $result = $this->_model->getDbConnection()->createCommand($sql)->queryAll();

        foreach ($result as $foreignObject) {
            $id = $foreignObject[$this->manyManyTableRight];
            $objects[$id] = $this->_relatedModel->findByPk($id);
        }

        foreach ($this->_model->{$this->relation} as $relobj)
            $objects[$relobj->{$relobj->tableSchema->primaryKey}] = $relobj;

        return isset($objects) ? $objects : array();
    }

    /**
     * Retrieves the not Assigned Objects of the MANY_MANY related Table
     * This is used in the two-pane style view.
     */
    public function getNotAssignedObjects()
    {
        foreach ($this->getRelatedData() as $key => $value) {
            if (!array_key_exists($key, $this->getAssignedObjects())) {
                $objects[$key] = $this->_relatedModel->findByPk($key);
            }
        }

        return $objects ? $objects : array();
    }

    /**
     * Gets the Values of the given Object or Objects depending on the
     * $this->fields the widget requests
     */
    public function    getObjectValues($objects)
    {
        if (is_array($objects)) {
            foreach ($objects as $object) {
                $attributeValues[$object->primaryKey] = $object->{$this->fields};
            }
        }
        else {
            if (is_object($objects)) {
                $attributeValues[$object->primaryKey] = $objects->{$this->fields};
            }
        }

        return isset($attributeValues) ? $attributeValues : array();
    }

    /*
     * How will the Listbox of the MANY_MANY Assignment be called?
     */
    public function getListBoxName($ajax = false)
    {
        if ($ajax) {
            return sprintf('%s_%s',
                           get_class($this->_model),
                           get_class($this->_relatedModel)
            );
        }
        else {
            return sprintf('%s[%s]',
                           get_class($this->_model),
                           get_class($this->_relatedModel)
            );
        }
    }

    public function renderBelongsToSelection()
    {
        CWidget::render(strtolower($this->style),
                        array(
                             'id' => $this->relation . '_options',
                             'model' => $this->_model,
                             'field' => $this->field,
                             'data' => $this->getRelatedData(),
                             'htmlOptions' => $this->htmlOptions));
    }

    public function renderManyManySelection()
    {
        if (strcasecmp($this->style, 'twopane') == 0) {
            $this->renderTwoPaneSelection();
        }
        else {
            if (strcasecmp($this->style, 'checkbox') == 0) {
                $this->renderCheckBoxListSelection();
            }
            else {
                if (strcasecmp($this->style, 'dropDownList') == 0) {
                    $this->renderManyManyDropDownListSelection();
                }
                else {
                    if (strcasecmp($this->style, 'radiobutton') == 0) {
                        $this->renderManyManyRadioButtonListSelection();
                    }

                    else {
                        $this->renderOnePaneSelection();
                    }
                }
            }
        }
    }

    // when only one of the MANY_MANY related Objects should be choosable
    public function renderManyManyRadioButtonListSelection()
    {
        echo CHtml::RadiobuttonList(
            get_class($this->_model) . '[' . get_class($this->_relatedModel) . '][]',
            $this->_model{$this->relation}[0]->{$this->_model{$this->relation}[0]->tableSchema->primaryKey},
            $this->getRelatedData(),
            $this->htmlOptions);
    }

    /*
     * Renders one dropDownList per selectable related Element.
     * The users can add additional entries with the + and remove entries
     * with the - Button .
     */
    public function renderManyManyDropDownListSelection()
    {
        $uniqueid = $this->_relatedModel->tableSchema->name;

        if ($this->parentObjects != 0) {
            $relatedmodels = $this->parentObjects;
        }
        else {
            $relatedmodels = $this->_relatedModel->findAll();
        }

        $addbutton = sprintf('i' . $this->num . ' = %d; maxi' . $this->num . ' = %d;',
                             count($this->getAssignedObjects()) + 1,
                             count($relatedmodels));
        Yii::app()->clientScript->registerScript(
            'addbutton_' . $uniqueid . '_' . $this->num, $addbutton);

        $i = 0;
        foreach ($relatedmodels as $obj) {
            $i++;
            $isAssigned = $this->isAssigned($obj->id);

            echo CHtml::openTag('div', array(
                                            'id' => sprintf('div_%s_%d', $uniqueid, $i),
                                            'style' => $isAssigned ? '' : 'display:none;',
                                            'class' => 'relation'
                                       ));
            echo CHtml::dropDownList(sprintf('%s[%d]',
                                             $this->getListBoxName(),
                                             $i),
                                     $isAssigned ? $obj->id : 0,
                                     CHtml::listData(
                                         array_merge(
                                             array('0' => $this->allowEmpty), $relatedmodels),
                                         $this->relatedPk,
                                         $this->fields)
            );
            echo CHtml::button('-', array('id' => sprintf('sub_%s_%d',
                                                          $uniqueid,
                                                          $i)));
            echo CHtml::closeTag('div');
            $jsadd = '
					$(\'#add_' . $uniqueid . '\').click(function() {
							$(\'#div_' . $uniqueid . '_\' + i' . $this->num . ').show();
							if(i' . $this->num . ' <= maxi' . $this->num . ') i' . $this->num . '++;
							});
				';

            $jssub = '
					$(\'#sub_' . $uniqueid . '_' . $i . '\').click(function() {
							$(\'#div_' . $uniqueid . '_' . $i . '\').hide();
							$("select[name=\'' . $this->getListBoxName() . '[' . $i . ']\']").val(\'\');
							if(i' . $this->num . ' >= 1) i--;
							});
				';

            Yii::app()->clientScript->registerScript('addbutton_' . $uniqueid, $jsadd);
            Yii::app()->clientScript->registerScript('subbutton_' . $uniqueid, $jssub);
        }
        echo '&nbsp;';
        echo CHtml::button('+', array('id' => sprintf('add_%s', $uniqueid)));


    }

    public function isAssigned($id)
    {
        return in_array($id, array_keys($this->getAssignedObjects()));
    }

    public static function retrieveValues($data)
    {
        $returnArray = array();

        $i = 0;
        foreach ($data as $value) {
            if ($value != 0) {
                $returnArray[(int)$i] = (int)$value;
            }
            $i++;
        }

        return $returnArray;
    }


    public function renderCheckBoxListSelection()
    {
        $keys = array_keys($this->getAssignedObjects());

        if (isset($this->preselect) && $this->preselect != false) {
            $keys = $this->preselect;
        }

        $id = $this->relation . '_options';
        echo CHtml::openTag('div', array('id' => $id, 'class' => 'relation'));
        echo CHtml::CheckBoxList($this->getListBoxName(),
                                 $keys,
                                 $this->getRelatedData(),
                                 $this->htmlOptions);
        echo CHtml::closeTag('div');
    }


    public function renderOnePaneSelection()
    {
        $keys = array_keys($this->getAssignedObjects());

        echo CHtml::ListBox($this->getListBoxName(),
                            $keys,
                            $this->getRelatedData(),
                            array('multiple' => 'multiple'));
    }

    public function handleAjaxRequest($post)
    {
        print_r($post);
    }

    public function renderTwoPaneSelection()
    {
        echo CHtml::ListBox($this->getListBoxName(),
                            array(),
                            $this->getObjectValues($this->getAssignedObjects()),
                            array('multiple' => 'multiple'));

        $ajax =
            array(
                'type' => 'POST',
                'data' => array('yeah'),
                'update' => '#' . $this->getListBoxName(true),
            );

        echo CHtml::ajaxSubmitButton('<<',
                                     array('assign'),
                                     $ajax
        );

        $ajax =
            array(
                'type' => 'POST',
                'update' => '#not_' . $this->getListBoxName(true)
            );

        echo  CHtml::ajaxSubmitButton('>>',
                                      array('assign', 'revoke' => 1),
                                      $ajax);
        //,
        //$data['revoke']);


        echo CHtml::ListBox('not_' . $this->getListBoxName(),
                            array(),
                            $this->getObjectValues($this->getNotAssignedObjects()),
                            array('multiple' => 'multiple'));
    }

    public function run()
    {
        if ($this->manyManyTable != '') {
            $this->renderManyManySelection();
        }
        else {
            $this->renderBelongsToSelection();
        }

    }

    protected function renderAddButton()
    {
        // TODO: reimplement add button
        // if($this->showAddButton)
        //   $this->renderAddButton();
        return;

        $model = strtolower(get_class($this->_model));
        $relatedModel = strtolower(get_class($this->_relatedModel));
        $relations = $this->_model->relations();

        #$controller = GHelper::resolveController($relations[$this->relation]);

        if ($this->addButtonUrl != '') {
            $link = $this->addButtonUrl;
        }
        else {
            $link = $this->controller->createUrl($controller . '/create', array('relation' => $this->relation));
        }

        if ($this->addButtonRefreshUrl == '') {
            $this->addButtonRefreshUrl = $this->controller->createUrl($model . '/getOptions',
                                                                      array(
                                                                           'relation' => $this->relation,
                                                                           'style' => $this->style,
                                                                           'fields' => $this->fields));
        }

        $string = Yii::t('app', 'Add new {model}', array('{model}' => $relatedModel));

        $dialog = 'zii.widgets.jui.CJuiDialog';
        $this->beginWidget($dialog, array(
                                         'id' => $this->relation . '_dialog',
                                         'options' => array('autoOpen' => false,
                                                            'modal' => true,
                                                            'title' => $string,
                                                            'width' => 800,
                                                            'height' => 600)
                                    ));
        $this->endWidget($dialog);

        echo CHtml::AjaxButton(
            is_string($this->showAddButton) ? $this->showAddButton : $string,
            $link,
            array(
                 'success' => "function(html) {
								jQuery('#" . $this->relation . "_dialog').html(html);
								$('#" . $this->relation . "_dialog').dialog('open');
							}"),
            array('id' => $this->relation . '_create')
        );

        // prepare the Submit button that is not loaded into the DOM yet
        Yii::app()->clientScript->registerScript($this->relation . '_submit',
                                                 "jQuery('body').delegate('#submit_" . $this->relation . "','click',function(){
				jQuery.ajax({'url':'" . $link . "',
						'cache':false,
						'type':'POST',
						'data':jQuery(this).parents('form').serialize(),
						'success':function(html){
						jQuery('#" . $this->relation . "_dialog').html(html)}});
			return false;});");

        Yii::app()->clientScript->registerScript($this->relation . '_done',
                                                 "jQuery('body').delegate('#" . $this->relation . "_done','click',function(){
					jQuery.ajax({'url':'" . $this->addButtonRefreshUrl . "',
							'cache':false,
							'success':function(html){
							jQuery('#" . $this->relation . "_options').html(html)}});
						$('#" . $this->relation . "_dialog').dialog('close');
				return false;});");
    }
}
