<?php
/**
 * 
 */

/**
 * 
 * @author amrbedair
 * @since v.4.0.0
 */
abstract class TbWidget extends CWidget {

	const CTX_DEFAULT = 'default';
	const CTX_PRIMARY = 'primary';
	const CTX_SUCCESS = 'success';
	const CTX_INFO = 'info';
	const CTX_WARNING = 'warning';
	const CTX_DANGER = 'danger';
	
	const CTX_DEFAULT_CLASS = 'default';
	const CTX_PRIMARY_CLASS = 'primary';
	const CTX_SUCCESS_CLASS = 'success';
	const CTX_INFO_CLASS = 'info';
	const CTX_WARNING_CLASS = 'warning';
	const CTX_DANGER_CLASS = 'danger';
	
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
		
		if (empty($class))
			return;
	
		if (isset($htmlOptions['class']))
			$htmlOptions['class'] .= ' ' . $class;
		else 
			$htmlOptions['class'] = $class;
	}

	/**
	 * 
	 * @param string $context
	 */
	protected function isValidContext($cotext = false) {
		if($cotext)
			return defined(get_called_class().'::CTX_'.strtoupper($context));
		else
			return defined(get_called_class().'::CTX_'.strtoupper($this->context));
	}
	
	/**
	 * 
	 * @param string $context
	 */
	protected function getContextClass($context = false) {
		if($context)
			return constant(get_called_class().'::CTX_'.strtoupper($context).'_CLASS');
		else
			return constant(get_called_class().'::CTX_'.strtoupper($this->context).'_CLASS');
	}
}