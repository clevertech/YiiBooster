<?php
/**
 *## TbSortableAction class file
 *
 * @author ruslan fadeev <fadeevr@gmail.com>
 */

/**
 *## TbSortableAction CAction Component
 *
 * It is a component that works in conjunction of TbExtendedGridView widget with sortableRows true. Just attach to the controller you wish to
 * make the calls to.
 *
 * @package booster.actions
 */
class TbSortableAction extends CAction
{
	/**
	 * @var string the name of the model we are going to toggle values to
	 */
	public $modelName;

	/**
	 * Widgets run function
	 * @throws CHttpException
	 */
	public function run()
	{
		if (!$this->isValidRequest())
			throw new CHttpException(400, Yii::t('yii', 'Your request is invalid.'));

		$sortableAttribute = Yii::app()->request->getQuery('sortableAttribute');

		/** @var $model CActiveRecord */
		$model = new $this->modelName;
		if (!$model->hasAttribute($sortableAttribute)) {
			throw new CHttpException(400, Yii::t(
				'yii',
				'{attribute} "{value}" is invalid.',
				array('{attribute}' => 'sortableAttribute', '{value}' => $sortableAttribute)
			));
		}

		$sortOrderData = $_POST['sortOrder'];

		$this->update($model, $sortableAttribute, $sortOrderData);
	}

	private function isValidRequest()
	{
		return Yii::app()->request->isPostRequest
			&& Yii::app()->request->isAjaxRequest
			&& isset($_POST['sortOrder']);
	}

	/**
	 * @param $model
	 * @param $sortableAttribute
	 * @param $sortOrderData
	 *
	 * @return string
	 */
	private function update($model, $sortableAttribute, $sortOrderData)
	{
		$pk = $model->tableSchema->primaryKey;
		$pk_array = array();
		if(is_array($pk)) { // composite key
			$string_ids = array_keys($sortOrderData);
			
			$array_ids = array();
			foreach ($string_ids as $string_id)
				$array_ids[] = explode(',', $string_id);
			
			foreach ($array_ids as $array_id)
				$pk_array[] = array_combine($pk, $array_id);
		} else { // normal key
			$pk_array = array_keys($sortOrderData);
		}
		
		$models = $model->model()->findAllByPk($pk_array);
		$transaction = Yii::app()->db->beginTransaction();
		try {
			foreach ($models as $model) {
				$_key = is_array($pk) ? implode(',', array_values($model->primaryKey)) : $model->primaryKey;
				$model->{$sortableAttribute} = $sortOrderData[$_key];
				$model->save();
			}
			$transaction->commit();
		}
		catch(Exception $e) { // an exception is raised if a query fails
			$transaction->rollback();
		}
	}
}
