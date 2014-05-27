<?php
/**
 * 
 */

/**
 * 
 * @author amrbedair
 * @since v.4.0.0
 */
class TbWidget extends CWidget {

	const CTX_DEFAULT = 'default';
	const CTX_PRIMARY = 'primary';
	const CTX_SUCCESS = 'success';
	const CTX_INFO = 'info';
	const CTX_WARNING = 'warning';
	const CTX_DANGER = 'danger';
	
	protected static $ctxCssClasses = [
		self::CTX_DEFAULT => 'default',
		self::CTX_PRIMARY => 'primary',
		self::CTX_SUCCESS => 'success',
		self::CTX_INFO => 'info',
		self::CTX_WARNING => 'warning',
		self::CTX_DANGER => 'danger',
	];
	
	/**
	 * easily make a widget more meaningful to a particular context by adding any of the contextual state classes
	 * @var string 
	 */
	public $context = self::CTX_DEFAULT;
	
	/**
	 * Utility function for appending class names for a generic $htmlOptions array.
	 *
	 * @param array $htmlOptions
	 * @param string $class
	 */
	protected static function addCssClass(&$htmlOptions, $class) {
	
		if (empty($class)) {
			return;
		}
	
		if (isset($htmlOptions['class'])) {
			$htmlOptions['class'] .= ' ' . $class;
		} else {
			$htmlOptions['class'] = $class;
		}
	}

	/**
	 * 
	 * @param unknown $context
	 */
	protected static function isValidContext($context) {
		return in_array($context, array(
				self::CTX_DEFAULT,
				self::CTX_PRIMARY,
				self::CTX_SUCCESS,
				self::CTX_INFO,
				self::CTX_WARNING,
				self::CTX_DANGER
		));
	}
}