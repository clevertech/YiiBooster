<?php
/**
 *## EditableField class file.
 *
 * @author Vitaliy Potapov <noginsk@rambler.ru>
 * @link https://github.com/vitalets/x-editable-yii
 * @copyright Copyright &copy; Vitaliy Potapov 2012
 * @version 1.1.0
 */

Yii::import('bootstrap.widgets.TbEditable');

/**
 *## EditableField widget makes editable single attribute of model.
 *
 * @package booster.widgets.editable
*/
class TbEditableField extends TbEditable
{
	/**
	 * @var CActiveRecord ActiveRecord to be updated.
	 */
	public $model = null;

	/**
	 * @var string Attribute name.
	 */
	public $attribute = null;

	private $_prepareToAutotext = false;

	/**
	 *### .init()
	 *
	 * initialization of widget
	 *
	 */
	public function init()
	{
		if (!$this->model) {
			throw new CException('Parameter "model" should be provided for EditableField');
		}

		if (!$this->attribute) {
			throw new CException('Parameter "attribute" should be provided for EditableField');
		}

        // set name
        $this->name = $this->attribute;

        parent::init();

        // set value
        $this->value = $this->model->{$this->attribute};

        /**
         * set data-pk only for existing records
         */
        if (!$this->model->isNewRecord) {
            $this->pk = is_array($this->model->primaryKey) ? CJSON::encode($this->model->primaryKey) : $this->model->primaryKey;
        }

		$originalText = strlen($this->text) ? $this->text : CHtml::value($this->model, $this->attribute);

        /**
         * if apply set manually to false --> just render text, no js plugin applied
         */
        if ($this->apply === false) {
			$this->text = $originalText;
			return;
		} else {
			$this->apply = true;
		}

        /**
         * resolve model and attribute for related model
         */
        $resolved = self::resolveModel($this->model, $this->attribute);
		if ($resolved === false) {
			//cannot resolve related model (maybe no related models for this record)
			$this->apply = false;
			$this->text = $originalText;
			return;
		} else {
			list($this->model, $this->attribute) = $resolved;
		}

        /**
         * for security reason only safe attributes can be editable (e.g. defined in rules of model)
         * just print text (see 'run' method)
         */
        if (!$this->model->isAttributeSafe($this->attribute)) {
			$this->apply = false;
			$this->text = $originalText;
			return;
		}

        /**
         * try to detect type from metadata if not set
         */
        if ($this->type === null) {
			$this->type = 'text';
			if (array_key_exists($this->attribute, $this->model->tableSchema->columns)) {
				$dbType = $this->model->tableSchema->columns[$this->attribute]->dbType;
				if ($dbType == 'date' || $dbType == 'datetime') {
					$this->type = 'date';
				}
				if (stripos($dbType, 'text') !== false) {
					$this->type = 'textarea';
				}
			}
		}

		/**
         * If text not defined, generate it from model attribute for types except lists ('select', 'checklist' etc)
         * For lists keep it empty to apply autotext
		 */
		if (!strlen($this->text) && !$this->_prepareToAutotext) {
			$this->text = $originalText;
		}
	}

    /**
     * @return string
     */
    public function getSelector($unique = true)
	{
		if ($this->model->isNewRecord) {
			$pk = 'new';
		} else {
			$pk = $this->model->primaryKey;
			//support of composite keys: convert to string
			if (is_array($pk)) {
				$pk = join(
					'_',
					array_map(
						function ($k, $v) {
							return $k . '-' . $v;
						},
						array_keys($pk),
						$pk
					)
				);
			}
		}
		return $unique ? 
			str_replace('\\', '_', get_class($this->model)) . '_' . $this->attribute . '_' . $pk : 
			str_replace('\\', '_', get_class($this->model)) . '_' . $this->attribute;
	}

    /**
     * check if attribute points to related model and resolve it
     *
     * @param $model
     * @param $attribute
     * @return array|bool
     */
    public static function resolveModel($model, $attribute)
	{
		$explode = explode('.', $attribute);
		if (count($explode) > 1) {
			for ($i = 0; $i < count($explode) - 1; $i++) {
				$name = $explode[$i];
				if ($model->$name instanceof CActiveRecord) {
					$model = $model->$name;
				} else {
					//related model not exist! Better to return false and render as usual not editable field.
					//throw new CException('Property "'.$name.'" is not instance of CActiveRecord!');
					return false;
				}
			}
			$attribute = $explode[$i];
		}
		return array($model, $attribute);
	}
}
