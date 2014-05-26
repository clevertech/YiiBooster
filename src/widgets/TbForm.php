<?php
/**
 * YiiBooster project.
 * @license [New BSD License](http://www.opensource.org/licenses/bsd-license.php)
 */

/**
 * TbForm is adaptation of CFrom class for fast form building with bootstrap.
 * Its public interface does not differs from original CFrom class.
 * Please refer to {@link CFrom} for further information.
 *
 * @see CForm
 */
class TbForm extends CForm {
	
	/**
	 * The name of the class for representing a form input element. Defaults to 'TbFormInputElement'.
	 * @var string
	 * @see TbFormInputElement
	 */
	public $inputElementClass = 'TbFormInputElement';

	/**
	 * The name of the class for representing a form button element. Defaults to 'TbFormButtonElement'.
	 * @var string
	 * @see TbFormButtonElement
	 */
	public $buttonElementClass = 'TbFormButtonElement';

	/**
	 * The configuration used to create the active form widget.
	 * The widget will be used to render the form tag and the error messages.
	 * The 'class' option is required, which specifies the class of the widget.
	 * The rest of the options will be passed to {@link CBaseController::beginWidget()} call.
	 * Defaults to array('class'=>'TbActiveForm').
	 * @var array
	 * @see TbActiveForm
	 */
	public $activeForm = array('class' => 'TbActiveForm');

	/**
	 * Renders the {@link buttons} in this form.
	 * @return string The rendering result.
	 */
	public function renderButtons() {
		
		$output = '';
		foreach ($this->getButtons() as $button) {
			$output .= $this->renderElement($button);
		}

		if ($output !== '' && $this->activeFormWidget->type !== TbActiveForm::TYPE_INLINE) {
			$output = "<div class=\"form-actions\">\n" . $output . "</div>\n";
		}

		return $output;
	}

	/**
	 * Renders the open tag of the form. The default implementation will render the open form tag.
	 * @return string The rendering result.
	 */
	public function renderBegin() {
		
		if (!($this->getParent() instanceof self) and !isset($this->activeForm['class'])) {
			$this->activeForm['class'] = 'TbActiveForm';
		}

		return parent::renderBegin();
	}

	/**
	 * Renders a single element which could be an input element, a sub-form, a string, or a button.
	 * @param mixed $element The form element to be rendered. This can be either a {@link CFormElement} instance
	 * or a string representing the name of the form element.
	 * @return string The rendering result.
	 */
	public function renderElement($element) {
		
		if (is_string($element)) {
			if (($e = $this[$element]) === null && ($e = $this->getButtons()->itemAt($element)) === null)
				return $element;
			else
				$element = $e;
		}

		if ($element->getVisible()) {
			if ($element instanceof TbFormInputElement) {
				if ($element->type === 'hidden') {
					return "<div style=\"visibility:hidden\">\n" . $element->render() . "</div>\n";
				} else {
					return $element->render();
				}
			} elseif ($element instanceof TbFormButtonElement) {
				return $element->render() . "\n";
			} else {
				return $element->render();
			}
		}
		return '';
	}
}
