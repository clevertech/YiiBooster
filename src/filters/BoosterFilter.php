<?php
/**
 *## BoosterFilter class file
 *
 * @author Amr Bedair <amr.bedair@gmail.com>
 * @since v4.0.0
 */


/**
 *## Class BoosterFilter
 *
 * Filter to load Booster on specific actions.
 * Then in a controller, add the new booster filter:
 * <code>public function filters()
 * {
 *     return array(
 *         'accessControl',
 *         'postOnly + delete',
 *         array('ext.booster.filters.BoosterFilter - delete')
 *     );
 * }</code>
 *
 * @package booster.filters
 */
class BoosterFilter extends CFilter {
	
	protected function preFilter($filterChain) {
		
		Yii::app()->getComponent("booster");
		return true;
	}
}
