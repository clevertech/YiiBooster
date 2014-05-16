<?php
/**
 * TbEditableField class file.
 *
 * @author Vitaliy Potapov <noginsk@rambler.ru>
 * @link https://github.com/vitalets/x-editable-yii
 * @copyright Copyright &copy; Vitaliy Potapov 2012
 * @version 1.3.1
 */

Yii::import('booster.widgets.TbEditable');

/**
 * TbEditableField widget makes editable single attribute of model.
 *
 * @package widgets
 */
class TbEditableField extends TbEditable
{
    /**
    * @var CActiveRecord ActiveRecord to be updated.
    */
    public $model = null;
    /**
    * @var string attribute name.
    */
    public $attribute = null;
   
    /**
    * @var instance of model that is created always:
    * E.g. if related model does not exist, it will be `newed` to be able to get Attribute label, etc
    * for live update. 
    */
    private $staticModel = null;
    
    /**
    * initialization of widget
    *
    */
    public function init()
    {
        if (!$this->model) {
            throw new CException('Parameter "model" should be provided for TbEditableField');
        }

        if (!$this->attribute) {
            throw new CException('Parameter "attribute" should be provided for TbEditableField');
        }

        $originalModel = $this->model;
        $originalAttribute = $this->attribute;
        $originalText = strlen($this->text) ? $this->text : CHtml::value($this->model, $this->attribute);

        //if apply set manually to false --> just render text, no js plugin applied
        if($this->apply === false) {
            $this->text = $originalText;
        } else {
            $this->apply = true;
        }

        //try to resolve related model (if attribute contains '.')
        $resolved = $this->resolveModels($this->model, $this->attribute);
        $this->model = $resolved['model'];
        $this->attribute = $resolved['attribute'];
        $this->staticModel = $resolved['staticModel'];
        $staticModel = $this->staticModel;
        $isMongo = $resolved['isMongo'];
        $isFormModel = $this->model instanceOf CFormModel;
        
        //if real (related) model not exists --> just print text
        if(!$this->model) {
        	$this->apply = false;
        	$this->text = $originalText;
		}
        
        
        //for security reason only safe attributes can be editable (e.g. defined in rules of model)
        //just print text (see 'run' method)
        if (!$staticModel->isAttributeSafe($this->attribute)) {
            $this->apply = false;
            $this->text = $originalText;
        }
        
        /*
         try to detect type from metadata if not set
        */
        if ($this->type === null) {
            $this->type = 'text';
            if (!$isMongo && !$isFormModel && array_key_exists($this->attribute, $staticModel->tableSchema->columns)) {
                $dbType = $staticModel->tableSchema->columns[$this->attribute]->dbType;
                if($dbType == 'date') {
                    $this->type = 'date';
                }
                if($dbType == 'datetime') {
                    $this->type = 'datetime';
                }
                if(stripos($dbType, 'text') !== false) {
                    $this->type = 'textarea';
                }
            }
        }

        //name
        if(empty($this->name)) {
            $this->name = $isMongo ? $originalAttribute : $this->attribute;
        }
        
        //pk (for mongo takes pk from parent!)
        $pkModel = $isMongo ? $originalModel : $this->model; 
        if(!$isFormModel) {
            if($pkModel && !$pkModel->isNewRecord) {
                $this->pk = $pkModel->primaryKey;
            }
        } else {
            //formModel does not have pk, so set `send` option to `always` (send without pk)
            if(empty($this->send) && empty($this->options['send'])) {
                $this->send = 'always';
            }
        }      
        
        parent::init();        
        
        /*
         If text not defined, generate it from model attribute for types except lists ('select', 'checklist' etc)
         For lists keep it empty to apply autotext.
         $this->_prepareToAutotext calculated in parent class TbEditable.php
        */
        if (!strlen($this->text) && !$this->_prepareToAutotext) {
            $this->text = $originalText;
        }
        
        //set value directly for autotext generation
        if($this->model && $this->_prepareToAutotext) {
            $this->value = CHtml::value($this->model, $this->attribute); 
        }
        
        //generate title from attribute label
        if ($this->title === null) {
            $titles = array(
              'Select' => array('select', 'date'),
              'Check' => array('checklist')
            );
            $title = Yii::t('TbEditableField.editable', 'Enter');
            foreach($titles as $t => $types) {
                if(in_array($this->type, $types)) {
                   $title = Yii::t('TbEditableField.editable', $t);
                }
            }
            $this->title = $title . ' ' . $staticModel->getAttributeLabel($this->attribute);
        } else {
            $this->title = strtr($this->title, array('{label}' => $staticModel->getAttributeLabel($this->attribute)));
        }
        
        //scenario
        if($pkModel && !isset($this->params['scenario'])) {
            $this->params['scenario'] = $pkModel->getScenario(); 
        }        
    }

    public function getSelector()
    {
        return str_replace('\\', '_', get_class($this->staticModel)).'_'.parent::getSelector();
    }
    
    
    /**
    * Checks is model is instance of mongo model
    * see: http://www.yiiframework.com/extension/yiimongodbsuite
    * 
    * @param mixed $model
    * @return bool
    */
    public static function isMongo($model) 
    {   
    	return in_array('EMongoEmbeddedDocument', class_parents($model, false));
	}
	
    /**
    * Resolves model and returns array of values:
    * - staticModel: static class of model, need for checki safety of attribute
    * - real model: containing attribute. Can be null
    * - attribute: it will be without dots for activerecords 
    * 
    * @param mixed $model
    * @param mixed $attribute
    */
    public static function resolveModels($model, $attribute) 
    {
    	//attribute contains dot: related model, trying to resolve
        $explode = explode('.', $attribute);
        $len = count($explode);
        
        $isMongo = self::isMongo($model);
		         		
        if($len > 1) {
            $attribute = $explode[$len-1];
            //try to resolve model instance  
            $resolved = true;
            for($i = 0; $i < $len-1; $i++) {
                $name = $explode[$i];
                if($model->$name instanceof CModel) {
                    $model = $model->$name;
                } else {
                    //related model not exist! Render text only.
                    //$this->apply = false;
                    $resolved = false;
                    //$this->text = $originalText;
                    break;
                }
            }
            
            if($resolved) {
                $staticModel = $model;
            } else { //related model not resolved: maybe not exists
                $relationName = $explode[$len-2];
                if($model instanceof CActiveRecord) {
                    $className = $model->getActiveRelation($relationName)->className;
				} elseif($isMongo) {
					$embedded = $model->embeddedDocuments();
					if(isset($embedded[$relationName])) {
						$className = $embedded[$relationName];
					} else {
						throw new CException('Embedded relation not found');
					}
				} else {
					throw new CException('Unsupported model class '.$relationName);
				}
                $staticModel = new $className();
                $model = null;                
            }
        } else {
            $staticModel = $model;  
        }
        
        return array(
        	'model' 		=> $model,
        	'staticModel'   => $staticModel,
        	'attribute'     => $attribute,
        	'isMongo'       => $isMongo
        );
	}
}
