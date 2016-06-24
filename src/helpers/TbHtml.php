<?php
Yii::import('booster.helpers.TbArray');
/**
 * Bootstrap HTML helper.
 */
class TbHtml extends CHtml // required in order to access the protected methods in CHtml
{
    /**
     * Generates an icon.
     * @param string $icon the icon type.
     * @param array $htmlOptions additional HTML attributes.
     * @param string $tagName the icon HTML tag.
     * @return string the generated icon.
     */
    public static function icon($icon, $htmlOptions = array(), $tagName = 'i')
    {
        if (is_string($icon)) {
            if (strpos($icon, 'icon-') === false && strpos($icon, 'glyphicon') === false && strpos($icon, 'fa') === false) {
                $icon = 'glyphicon glyphicon-' . implode(' glyphicon-', explode(' ', $icon));
            }
            self::addCssClass($icon, $htmlOptions);
            return parent::openTag($tagName, $htmlOptions) . parent::closeTag($tagName); // tag won't work in this case
        }
        return '';
    }

    // UTILITIES
    // --------------------------------------------------

    /**
     * Appends new class names to the given options..
     * @param mixed $className the class(es) to append.
     * @param array $htmlOptions the options.
     * @return array the options.
     */
    public static function addCssClass($className, &$htmlOptions)
    {
        // Always operate on arrays
        if (is_string($className)) {
            $className = explode(' ', $className);
        }
        if (isset($htmlOptions['class'])) {
            $classes = array_filter(explode(' ', $htmlOptions['class']));
            foreach ($className as $class) {
                $class = trim($class);
                // Don't add the class if it already exists
                if (array_search($class, $classes) === false) {
                    $classes[] = $class;
                }
            }
            $className = $classes;
        }
        $htmlOptions['class'] = implode(' ', $className);
    }

    /**
     * Appends a CSS style string to the given options.
     * @param string $style the CSS style string.
     * @param array $htmlOptions the options.
     * @return array the options.
     */
    public static function addCssStyle($style, &$htmlOptions)
    {
        if (is_array($style)) {
            $style = implode('; ', $style);
        }
        $style = rtrim($style, ';');
        $htmlOptions['style'] = isset($htmlOptions['style'])
            ? rtrim($htmlOptions['style'], ';') . '; ' . $style
            : $style;
    }

    /**
     * Adds the grid span class to the given options is applicable.
     * @param array $htmlOptions the HTML attributes.
     */
    protected static function addSpanClass(&$htmlOptions)
    {
        $span = TbArray::popValue('span', $htmlOptions);
        if (!empty($span)) {
            self::addCssClass('span' . $span, $htmlOptions);
        }
    }

    /**
     * Adds the pull class to the given options is applicable.
     * @param array $htmlOptions the HTML attributes.
     */
    protected static function addPullClass(&$htmlOptions)
    {
        $pull = TbArray::popValue('pull', $htmlOptions);
        if (!empty($pull)) {
            self::addCssClass('pull-' . $pull, $htmlOptions);
        }
    }

    /**
     * Adds the text align class to the given options if applicable.
     * @param array $htmlOptions the HTML attributes.
     */
    protected static function addTextAlignClass(&$htmlOptions)
    {
        $align = TbArray::popValue('textAlign', $htmlOptions);
        if (!empty($align)) {
            self::addCssClass('text-' . $align, $htmlOptions);
        }
    }
}
