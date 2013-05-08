<?php
/**
 * TbHtml class file.
 * @author Antonio Ramirez <ramirez.cobos@gmail.com>
 * @author Christoffer Niska <christoffer.niska@gmail.com>
 * @copyright Copyright &copy; Christoffer Niska 2013-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 * @package bootstrap.helpers
 */

/**
 * Bootstrap HTML helper.
 */
class TbHtml extends CHtml // required in order to access protected methods
{
    //
    // TYPOGRAPHY
    // --------------------------------------------------

    const TEXT_ALIGN_LEFT = 'left';
    const TEXT_ALIGN_CENTER = 'center';
    const TEXT_ALIGN_RIGHT = 'right';

    const TEXT_COLOR_DEFAULT = '';
    const TEXT_COLOR_WARNING = 'warning';
    const TEXT_COLOR_ERROR = 'error';
    const TEXT_COLOR_INFO = 'info';
    const TEXT_COLOR_SUCCESS = 'success';

    const HELP_TYPE_INLINE = 'inline';
    const HELP_TYPE_BLOCK = 'block';

    //
    // FORM
    // --------------------------------------------------

    const FORM_LAYOUT_VERTICAL = 'vertical';
    const FORM_LAYOUT_HORIZONTAL = 'horizontal';
    const FORM_LAYOUT_INLINE = 'inline';
    const FORM_LAYOUT_SEARCH = 'search';

    const INPUT_TYPE_TEXT = 'textField';
    const INPUT_TYPE_PASSWORD = 'passwordField';
    const INPUT_TYPE_URL = 'urlField';
    const INPUT_TYPE_EMAIL = 'emailField';
    const INPUT_TYPE_NUMBER = 'numberField';
    const INPUT_TYPE_RANGE = 'rangeField';
    const INPUT_TYPE_DATE = 'dateField';
    const INPUT_TYPE_TEXTAREA = 'textArea';
    const INPUT_TYPE_FILE = 'fileField';
    const INPUT_TYPE_RADIOBUTTON = 'radioButton';
    const INPUT_TYPE_CHECKBOX = 'checkBox';
    const INPUT_TYPE_DROPDOWNLIST = 'dropDownList';
    const INPUT_TYPE_LISTBOX = 'listBox';
    const INPUT_TYPE_CHECKBOXLIST = 'checkBoxList';
    const INPUT_TYPE_INLINECHECKBOXLIST = 'inlineCheckBoxList';
    const INPUT_TYPE_RADIOBUTTONLIST = 'radioButtonList';
    const INPUT_TYPE_INLINERADIOBUTTONLIST = 'inlineRadioButtonList';
    const INPUT_TYPE_UNEDITABLE = 'uneditableField';
    const INPUT_TYPE_SEARCH = 'searchQuery';

    const INPUT_SIZE_MINI = 'mini';
    const INPUT_SIZE_SMALL = 'small';
    const INPUT_SIZE_DEFAULT = '';
    const INPUT_SIZE_MEDIUM = 'medium';
    const INPUT_SIZE_LARGE = 'large';
    const INPUT_SIZE_XLARGE = 'xlarge';
    const INPUT_SIZE_XXLARGE = 'xxlarge';

    const INPUT_COLOR_DEFAULT = '';
    const INPUT_COLOR_WARNING = 'warning';
    const INPUT_COLOR_ERROR = 'error';
    const INPUT_COLOR_INFO = 'info';
    const INPUT_COLOR_SUCCESS = 'success';

    //
    // BUTTONS
    // --------------------------------------------------

    const BUTTON_TYPE_LINK = 'link';
    const BUTTON_TYPE_HTML = 'htmlButton';
    const BUTTON_TYPE_SUBMIT = 'submitButton';
    const BUTTON_TYPE_RESET = 'resetButton';
    const BUTTON_TYPE_IMAGE = 'imageButton';
    const BUTTON_TYPE_LINKBUTTON = 'linkButton';
    const BUTTON_TYPE_AJAXLINK = 'ajaxLink';
    const BUTTON_TYPE_AJAXBUTTON = 'ajaxButton';
    const BUTTON_TYPE_INPUTBUTTON = 'inputButton';
    const BUTTON_TYPE_INPUTSUBMIT = 'inputSubmit';

    const BUTTON_COLOR_DEFAULT = '';
    const BUTTON_COLOR_PRIMARY = 'primary';
    const BUTTON_COLOR_INFO = 'info';
    const BUTTON_COLOR_SUCCESS = 'success';
    const BUTTON_COLOR_WARNING = 'warning';
    const BUTTON_COLOR_DANGER = 'danger';
    const BUTTON_COLOR_INVERSE = 'inverse';
    const BUTTON_COLOR_LINK = 'link';

    const BUTTON_SIZE_MINI = 'mini';
    const BUTTON_SIZE_SMALL = 'small';
    const BUTTON_SIZE_DEFAULT = '';
    const BUTTON_SIZE_LARGE = 'large';

    const BUTTON_TOGGLE_CHECKBOX = 'checkbox';
    const BUTTON_TOGGLE_RADIO = 'radio';

    //
    // IMAGES
    // --------------------------------------------------

    const IMAGE_TYPE_ROUNDED = 'rounded';
    const IMAGE_TYPE_CIRCLE = 'circle';
    const IMAGE_TYPE_POLAROID = 'polaroid';

    //
    // NAV
    // --------------------------------------------------

    const NAV_TYPE_NONE = '';
    const NAV_TYPE_TABS = 'tabs';
    const NAV_TYPE_PILLS = 'pills';
    const NAV_TYPE_LIST = 'list';

    const TABS_PLACEMENT_ABOVE = '';
    const TABS_PLACEMENT_BELOW = 'below';
    const TABS_PLACEMENT_LEFT = 'left';
    const TABS_PLACEMENT_RIGHT = 'right';

    //
    // NAVBAR
    // --------------------------------------------------

    const NAVBAR_DISPLAY_NONE = '';
    const NAVBAR_DISPLAY_FIXEDTOP = 'fixed-top';
    const NAVBAR_DISPLAY_FIXEDBOTTOM = 'fixed-bottom';
    const NAVBAR_DISPLAY_STATICTOP = 'static-top';

    const NAVBAR_COLOR_INVERSE = 'inverse';

    //
    // PAGINATION
    // --------------------------------------------------

    const PAGINATION_SIZE_MINI = 'mini';
    const PAGINATION_SIZE_SMALL = 'small';
    const PAGINATION_SIZE_DEFAULT = '';
    const PAGINATION_SIZE_LARGE = 'large';

    const PAGINATION_ALIGN_LEFT = 'left';
    const PAGINATION_ALIGN_CENTER = 'centered';
    const PAGINATION_ALIGN_RIGHT = 'right';

    //
    // LABELS AND BADGES
    // --------------------------------------------------

    const LABEL_COLOR_DEFAULT = '';
    const LABEL_COLOR_SUCCESS = 'success';
    const LABEL_COLOR_WARNING = 'warning';
    const LABEL_COLOR_IMPORTANT = 'important';
    const LABEL_COLOR_INFO = 'info';
    const LABEL_COLOR_INVERSE = 'inverse';

    const BADGE_COLOR_DEFAULT = '';
    const BADGE_COLOR_SUCCESS = 'success';
    const BADGE_COLOR_WARNING = 'warning';
    const BADGE_COLOR_IMPORTANT = 'important';
    const BADGE_COLOR_INFO = 'info';
    const BADGE_COLOR_INVERSE = 'inverse';

    //
    // TOOLTIPS AND POPOVERS
    // --------------------------------------------------

    const TOOLTIP_PLACEMENT_TOP = 'top';
    const TOOLTIP_PLACEMENT_BOTTOM = 'bottom';
    const TOOLTIP_PLACEMENT_LEFT = 'left';
    const TOOLTIP_PLACEMENT_RIGHT = 'right';

    const TOOLTIP_TRIGGER_CLICK = 'click';
    const TOOLTIP_TRIGGER_HOVER = 'hover';
    const TOOLTIP_TRIGGER_FOCUS = 'focus';
    const TOOLTIP_TRIGGER_MANUAL = 'manual';

    const POPOVER_PLACEMENT_TOP = 'top';
    const POPOVER_PLACEMENT_BOTTOM = 'bottom';
    const POPOVER_PLACEMENT_LEFT = 'left';
    const POPOVER_PLACEMENT_RIGHT = 'right';

    const POPOVER_TRIGGER_CLICK = 'click';
    const POPOVER_TRIGGER_HOVER = 'hover';
    const POPOVER_TRIGGER_FOCUS = 'focus';
    const POPOVER_TRIGGER_MANUAL = 'manual';

    //
    // ALERT
    // --------------------------------------------------

    const ALERT_COLOR_DEFAULT = '';
    const ALERT_COLOR_INFO = 'info';
    const ALERT_COLOR_SUCCESS = 'success';
    const ALERT_COLOR_WARNING = 'warning';
    const ALERT_COLOR_ERROR = 'error';
    const ALERT_COLOR_DANGER = 'danger';

    //
    // PROGRESS BARS
    // --------------------------------------------------

    const PROGRESS_COLOR_DEFAULT = '';
    const PROGRESS_COLOR_INFO = 'info';
    const PROGRESS_COLOR_SUCCESS = 'success';
    const PROGRESS_COLOR_WARNING = 'warning';
    const PROGRESS_COLOR_DANGER = 'danger';

    //
    // MISC
    // --------------------------------------------------

    const WELL_SIZE_SMALL = 'small';
    const WELL_SIZE_DEFAULT = '';
    const WELL_SIZE_LARGE = 'large';

    const PULL_LEFT = 'left';
    const PULL_RIGHT = 'right';

    //
    // GRID VIEW
    // --------------------------------------------------

    const GRID_TYPE_STRIPED = 'striped';
    const GRID_TYPE_BORDERED = 'bordered';
    const GRID_TYPE_CONDENSED = 'condensed';
    const GRID_TYPE_HOVER = 'hover';

    //
    // AFFIX
    // --------------------------------------------------

    const AFFIX_POSITION_TOP = 'top';
    const AFFIX_POSITION_BOTTOM = 'bottom';

    //
    // ICON
    // --------------------------------------------------

    const ICON_GLASS = 'icon-glass';
    const ICON_MUSIC = 'icon-music';
    const ICON_SEARCH = 'icon-search';
    const ICON_ENVELOPE = 'icon-envelope';
    const ICON_HEART = 'icon-heart';
    const ICON_STAR = 'icon-star';
    const ICON_STAR_EMPTY = 'icon-star-empty';
    const ICON_USER = 'icon-user';
    const ICON_FILM = 'icon-film';
    const ICON_TH_LARGE = 'icon-th-large';
    const ICON_TH = 'icon-th';
    const ICON_TH_LIST = 'icon-th-list';
    const ICON_OK = 'icon-ok';
    const ICON_REMOVE = 'icon-remove';
    const ICON_ZOOM_IN = 'icon-zoom-in';
    const ICON_ZOOM_OUT = 'icon-zoom-out';
    const ICON_OFF = 'icon-off';
    const ICON_SIGNAL =  'icon-signal';
    const ICON_COG = 'icon-cog';
    const ICON_TRASH = 'icon-trash';
    const ICON_HOME = 'icon-home';
    const ICON_FILE = 'icon-file';
    const ICON_TIME = 'icon-time';
    const ICON_ROAD = 'icon-road';
    const ICON_DOWNLOAD_ALT = 'icon-download-alt';
    const ICON_DOWNLOAD = 'icon-download';
    const ICON_UPLOAD = 'icon-upload';
    const ICON_INBOX = 'icon-inbox';
    const ICON_PLAY_CIRCLE = 'icon-play-circle';
    const ICON_REPEAT = 'icon-repeat';
    const ICON_REFRESH = 'icon-refresh';
    const ICON_LIST_ALT = 'icon-list-alt';
    const ICON_LOCK = 'icon-lock';
    const ICON_FLAG = 'icon-flag';
    const ICON_HEADPHONES = 'icon-headphones';
    const ICON_VOLUME_OFF = 'icon-volume-off';
    const ICON_VOLUME_DOWN = 'icon-volume-down';
    const ICON_VOLUME_UP = 'icon-volume-up';
    const ICON_QRCODE = 'icon-qrcode';
    const ICON_BARCODE = 'icon-barcode';
    const ICON_TAG = 'icon-tag';
    const ICON_TAGS = 'icon-tags';
    const ICON_BOOK = 'icon-book';
    const ICON_BOOKMARK = 'icon-bookmark';
    const ICON_PRINT = 'icon-print';
    const ICON_CAMERA = 'icon-camera';
    const ICON_FONT = 'icon-font';
    const ICON_BOLD = 'icon-bold';
    const ICON_ITALIC = 'icon-italic';
    const ICON_TEXT_HEIGHT = 'icon-text-height';
    const ICON_TEXT_WIDTH = 'icon-text-width';
    const ICON_ALIGN_LEFT = 'icon-align-left';
    const ICON_ALIGN_CENTER = 'icon-align-center';
    const ICON_ALIGN_RIGHT = 'icon-align-right';
    const ICON_ALIGN_JUSTIFY = 'icon-align-justify';
    const ICON_LIST = 'icon-list';
    const ICON_INDENT_LEFT = 'icon-indent-left';
    const ICON_INDENT_RIGHT = 'icon-indent-right';
    const ICON_FACETIME_VIDEO = 'icon-facetime-video';
    const ICON_PICTURE = 'icon-picture';
    const ICON_PENCIL = 'icon-pencil';
    const ICON_MAP_MARKER = 'icon-map-marker';
    const ICON_ADJUST = 'icon-adjust';
    const ICON_TINT = 'icon-tint';
    const ICON_EDIT = 'icon-edit';
    const ICON_SHARE = 'icon-share';
    const ICON_CHECK = 'icon-check';
    const ICON_MOVE = 'icon-move';
    const ICON_STEP_BACKWARD = 'icon-step-backward';
    const ICON_FAST_BACKWARD = 'icon-fast-backward';
    const ICON_BACKWARD = 'icon-backward';
    const ICON_PLAY = 'icon-play';
    const ICON_PAUSE = 'icon-pause';
    const ICON_STOP = 'icon-pause';
    const ICON_FORWARD = 'icon-forward';
    const ICON_FAST_FORWARD = 'icon-fast-forward';
    const ICON_STEP_FORWARD = 'icon-step-forward';
    const ICON_EJECT = 'icon-eject';
    const ICON_CHEVRON_LEFT = 'icon-chevron-left';
    const ICON_CHEVRON_RIGHT = 'icon-chevron-right';
    const ICON_PLUS_SIGN = 'icon-plus-sign';
    const ICON_MINUS_SIGN = 'icon-minus-sign';
    const ICON_REMOVE_SIGN = 'icon-remove-sign';
    const ICON_OK_SIGN = 'icon-ok-sign';
    const ICON_QUESTION_SIGN = 'icon-question-sign';
    const ICON_INFO_SIGN = 'icon-info-sign';
    const ICON_SCREENSHOT = 'icon-screenshot';
    const ICON_REMOVE_CIRCLE = 'icon-remove-circle';
    const ICON_OK_CIRCLE = 'icon-ok-circle';
    const ICON_BAN_CIRCLE = 'icon-ban-circle';
    const ICON_ARROW_LEFT = 'icon-arrow-left';
    const ICON_ARROW_RIGHT = 'icon-arrow-right';
    const ICON_ARROW_UP = 'icon-arrow-up';
    const ICON_ARROW_DOWN = 'icon-arrow-down';
    const ICON_SHARE_ALT = 'icon-share-alt';
    const ICON_RESIZE_FULL = 'icon-resize-full';
    const ICON_RESIZE_SMALL = 'icon-resize-small';
    const ICON_PLUS = 'icon-plus';
    const ICON_MINUS = 'icon-minus';
    const ICON_ASTERISK = 'icon-asterisk';
    const ICON_EXCLAMATION_SIGN = 'icon-exclamation-sign';
    const ICON_GIFT = 'icon-gift';
    const ICON_LEAF = 'icon-leaf';
    const ICON_FIRE = 'icon-fire';
    const ICON_EYE_OPEN = 'icon-eye-open';
    const ICON_EYE_CLOSE = 'icon-eye-close';
    const ICON_WARNING_SIGN = 'icon-warning-sign';
    const ICON_PLANE = 'icon-plane';
    const ICON_CALENDAR = 'icon-calendar';
    const ICON_RANDOM =  'icon-random';
    const ICON_COMMENT = 'icon-comment';
    const ICON_MAGNET = 'icon-magnet';
    const ICON_CHEVRON_UP = 'icon-chevron-up';
    const ICON_CHEVRON_DOWN = 'icon-chevron-down';
    const ICON_RETWEET = 'icon-retweet';
    const ICON_SHOPPING_CART = 'icon-shopping-cart';
    const ICON_FOLDER_CLOSE = 'icon-folder-close';
    const ICON_FOLDER_OPEN = 'icon-folder-open';
    const ICON_RESIZE_VERTICAL = 'icon-resize-vertical';
    const ICON_RESIZE_HORIZONTAL = 'icon-resize-horizontal';
    const ICON_HDD = 'icon-hdd';
    const ICON_BULLHORN = 'icon-bullhorn';
    const ICON_BELL = 'icon-bell';
    const ICON_CERTFICATE = 'icon-certificate';
    const ICON_THUMBS_UP = 'icon-thumbs-up';
    const ICON_THUMBS_DOWN = 'icon-thumbs-down';
    const ICON_HAND_RIGHT = 'icon-hand-right';
    const ICON_HAND_LEFT = 'icon-hand-left';
    const ICON_HAND_UP = 'icon-hand-up';
    const ICON_HAND_DOWN = 'icon-hand-down';
    const ICON_CIRCLE_ARROW_RIGHT = 'icon-circle-arrow-right';
    const ICON_CIRCLE_ARROW_LEFT = 'icon-circle-arrow-left';
    const ICON_CIRCLE_ARROW_UP   = 'icon-circle-arrow-up';
    const ICON_CIRCLE_ARROW_DOWN = 'icon-circle-arrow-down';
    const ICON_GLOBE = 'icon-globe';
    const ICON_WRENCH = 'icon-wrench';
    const ICON_TASKS = 'icon-tasks';
    const ICON_FILTER = 'icon-filter';
    const ICON_BRIEFCASE = 'icon-briefcase';
    const ICON_FULLSCREEN = 'icon-fullscreen';

    // Default close text.
    const CLOSE_TEXT = '&times;';

    //
    // BASE CSS
    // --------------------------------------------------

    // Typography
    // http://twitter.github.com/bootstrap/base-css.html#typography
    // --------------------------------------------------

    /**
     * Generates a paragraph that stands out.
     * @param string $text the lead text.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated paragraph.
     */
    public static function lead($text, $htmlOptions = array())
    {
        $htmlOptions = self::addClassName('lead', $htmlOptions);
        return self::tag('p', $htmlOptions, $text);
    }

    /**
     * Generates small text.
     * @param string $text the text to style.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated text.
     */
    public static function small($text, $htmlOptions = array())
    {
        return self::tag('small', $htmlOptions, $text);
    }

    /**
     * Generates bold text.
     * @param string $text the text to style.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated text.
     */
    public static function b($text, $htmlOptions = array())
    {
        return self::tag('strong', $htmlOptions, $text);
    }

    /**
     * Generates italic text.
     * @param string $text the text to style.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated text.
     */
    public static function i($text, $htmlOptions = array())
    {
        return self::tag('em', $htmlOptions, $text);
    }

    /**
     * Generates an emphasized text.
     * @param string $style the text style.
     * @param string $text the text to emphasize.
     * @param array $htmlOptions additional HTML attributes.
     * @param string $tag the HTML tag.
     * @return string the generated text.
     */
    public static function em($style, $text, $htmlOptions = array(), $tag = 'p')
    {
        $htmlOptions = self::addClassName('text-' . $style, $htmlOptions);
        return self::tag($tag, $htmlOptions, $text);
    }

    /**
     * Generates a muted text block.
     * @param string $text the text.
     * @param array $htmlOptions additional HTML attributes.
     * @param string $tag the HTML tag.
     * @return string the generated text block.
     */
    public static function muted($text, $htmlOptions = array(), $tag = 'p')
    {
        if (self::popOption('muted', $htmlOptions, false))
            $htmlOptions = self::addClassName('muted', $htmlOptions);
        return self::tag($tag, $htmlOptions, $text);
    }

    /**
     * Generates a muted span.
     * @param string $text the text.
     * @param array $htmlOptions additional HTML attributes.
     * @param string $tag the HTML tag.
     * @return string the generated span.
     */
    public static function mutedSpan($text, $htmlOptions = array())
    {
        return self::muted($text, $htmlOptions, 'span');
    }

    /**
     * Generates an abbreviation with a help text.
     * @param string $text the abbreviation.
     * @param string $word the word the abbreviation is for.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated abbreviation.
     */
    public static function abbr($text, $word, $htmlOptions = array())
    {
        if (self::popOption('small', $htmlOptions, false))
            $htmlOptions = self::addClassName('initialism', $htmlOptions);
        $htmlOptions['title'] = $word;
        return self::tag('abbr', $htmlOptions, $text);
    }

    /**
     * Generates a small abbreviation with a help text.
     * @param string $text the abbreviation.
     * @param string $word the word the abbreviation is for.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated abbreviation.
     */
    public static function smallAbbr($text, $word, $htmlOptions = array())
    {
        $htmlOptions['small'] = true;
        return self::abbr($text, $word, $htmlOptions);
    }

    /**
     * Generates an address block.
     * @param string $quote the address text.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated block.
     */
    public static function address($text, $htmlOptions = array())
    {
        return self::tag('address', $htmlOptions, $text);
    }

    /**
     * Generates a quote.
     * @param string $text the quoted text.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated quote.
     */
    public static function quote($text, $htmlOptions = array())
    {
        $paragraphOptions = self::popOption('paragraphOptions', $htmlOptions, array());
        $source = self::popOption('source', $htmlOptions);
        $sourceOptions = self::popOption('sourceOptions', $htmlOptions, array());
        $cite = self::popOption('cite', $htmlOptions);
        $citeOptions = self::popOption('citeOptions', $htmlOptions, array());
        $cite = isset($cite) ? self::tag('cite', $citeOptions, $cite) : '';
        $source = isset($source) ? self::tag('small', $sourceOptions, $source . ' ' . $cite) : '';
        $text = self::tag('p', $paragraphOptions, $text) . $source;
        return self::tag('blockquote', $htmlOptions, $text);
    }

    /**
     * Generates a help text.
     * @param string $text the help text.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated text.
     */
    public static function help($text, $htmlOptions = array())
    {
        $htmlOptions = self::addClassName('help-inline', $htmlOptions);
        return self::tag('span', $htmlOptions, $text);
    }

    /**
     * Generates a help block.
     * @param string $text the help text.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated block.
     */
    public static function helpBlock($text, $htmlOptions = array())
    {
        $htmlOptions = self::addClassName('help-block', $htmlOptions);
        return self::tag('p', $htmlOptions, $text);
    }

    // Code
    // http://twitter.github.com/bootstrap/base-css.html#code
    // --------------------------------------------------

    /**
     * Generates inline code.
     * @param string $code the code.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated code.
     */
    public static function code($code, $htmlOptions = array())
    {
        return self::tag('code', $htmlOptions, $code);
    }

    /**
     * Generates a code block.
     * @param string $code the code.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated block.
     */
    public static function codeBlock($code, $htmlOptions = array())
    {
        return self::tag('pre', $htmlOptions, $code);
    }

    /**
     * Generates an HTML element.
     * @param string $tag the tag name.
     * @param array $htmlOptions the element attributes.
     * @param mixed $content the content to be enclosed between open and close element tags.
     * @param boolean $closeTag whether to generate the close tag.
     * @return string the generated HTML element tag.
     */
    public static function tag($tag, $htmlOptions = array(), $content = false, $closeTag = true)
    {
        self::addSpanClass($htmlOptions);
        $align = self::popOption('align', $htmlOptions);
        if (isset($align))
            $htmlOptions = self::addClassName('text-' . $align, $htmlOptions);
        $pull = self::popOption('pull', $htmlOptions);
        if (isset($pull))
            $htmlOptions = self::addClassName('pull-' . $pull, $htmlOptions);
        return CHtml::tag($tag, $htmlOptions, $content, $closeTag);
    }

    /**
     * Generates an open HTML element.
     * @param string $tag the tag name.
     * @param array $htmlOptions the element attributes.
     * @return string the generated HTML element tag.
     */
    public static function openTag($tag, $htmlOptions = array())
    {
        return self::tag($tag, $htmlOptions);
    }

    // Tables
    // http://twitter.github.com/bootstrap/base-css.html#forms
    // --------------------------------------------------

    // todo: create table methods here.

    // Forms
    // http://twitter.github.com/bootstrap/base-css.html#tables
    // --------------------------------------------------

    /**
     * Generates a form tag.
     * @param string $layout the form layout.
     * @param string $action the form action URL.
     * @param string $method form method (e.g. post, get).
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated tag.
     */
    public static function formTb($layout = self::FORM_LAYOUT_VERTICAL, $action = '', $method = 'post', $htmlOptions = array())
    {
        return self::beginFormTb($layout, $action, $method, $htmlOptions);
    }

    /**
     * Generates an open form tag.
     * @param string $layout the form layout.
     * @param string $action the form action URL.
     * @param string $method form method (e.g. post, get).
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated tag.
     */
    public static function beginFormTb($layout = self::FORM_LAYOUT_VERTICAL, $action = '', $method = 'post', $htmlOptions = array())
    {
        $htmlOptions = self::addClassName('form-' . $layout, $htmlOptions);
        return CHtml::beginForm($action, $method, $htmlOptions);
    }

    /**
     * Generates a stateful form tag.
     * @param mixed $action the form action URL.
     * @param string $method form method (e.g. post, get).
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated form tag.
     */
    public static function statefulFormTb($layout = self::FORM_LAYOUT_VERTICAL, $action = '', $method = 'post', $htmlOptions = array())
    {
        return self::formTb($layout, $action, $method, $htmlOptions)
            . self::tag('div', array('style' => 'display:none'), CHtml::pageStateField(''));
    }

    /**
     * Generates a text field input.
     * @param string $name the input name.
     * @param string $value the input value.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated input field.
     * @see TbHtml::textInputField
     */
    public static function textField($name, $value = '', $htmlOptions = array())
    {
        return self::textInputField('text', $name, $value, $htmlOptions);
    }

    /**
     * Generates a password field input.
     * @param string $name the input name.
     * @param string $value the input value.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated input field.
     * @see TbHtml::textInputField
     */
    public static function passwordField($name, $value = '', $htmlOptions = array())
    {
        CHtml::clientChange('change', $htmlOptions);
        return self::textInputField('password', $name, $value, $htmlOptions);
    }

    /**
     * Generates an url field input.
     * @param string $name the input name.
     * @param string $value the input value.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated input field.
     * @see TbHtml::textInputField
     */
    public static function urlField($name, $value = '', $htmlOptions = array())
    {
        return self::textInputField('url', $name, $value, $htmlOptions);
    }

    /**
     * Generates an email field input.
     * @param string $name the input name.
     * @param string $value the input value.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated input field.
     * @see TbHtml::textInputField
     */
    public static function emailField($name, $value = '', $htmlOptions = array())
    {
        return self::textInputField('email', $name, $value, $htmlOptions);
    }

    /**
     * Generates a number field input.
     * @param string $name the input name.
     * @param string $value the input value.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated input field.
     * @see TbHtml::textInputField
     */
    public static function numberField($name, $value = '', $htmlOptions = array())
    {
        return self::textInputField('number', $name, $value, $htmlOptions);
    }

    /**
     * Generates a range field input.
     * @param string $name the input name.
     * @param string $value the input value.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated input field.
     * @see TbHtml::textInputField
     */
    public static function rangeField($name, $value = '', $htmlOptions = array())
    {
        return self::textInputField('range', $name, $value, $htmlOptions);
    }

    /**
     * Generates a date field input.
     * @param string $name the input name.
     * @param string $value the input value.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated input field.
     * @see TbHtml::textInputField
     */
    public static function dateField($name, $value = '', $htmlOptions = array())
    {
        return self::textInputField('date', $name, $value, $htmlOptions);
    }

    /**
     * Generates a text area input.
     * @param string $name the input name.
     * @param string $value the input value.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated text area.
     */
    public static function textArea($name, $value = '', $htmlOptions = array())
    {
        $htmlOptions = self::normalizeInputOptions($htmlOptions);
        return CHtml::textArea($name, $value, $htmlOptions);
    }

    /**
     * Generates a radio button.
     * @param string $name the input name.
     * @param boolean $checked whether the radio button is checked.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated radio button.
     */
    public static function radioButton($name, $checked = false, $htmlOptions = array())
    {
        $label = self::popOption('label', $htmlOptions, false);
        $labelOptions = self::popOption('labelOptions', $htmlOptions, array());
        $radioButton = CHtml::radioButton($name, $checked, $htmlOptions);
        if ($label !== false)
        {
            $labelOptions = self::addClassName('radio', $labelOptions);
            ob_start();
            echo self::tag('label', $labelOptions, $radioButton . $label);
            return ob_get_clean();
        }
        else
            return $radioButton;
    }

    /**
     * Generates a check box.
     * @param string $name the input name.
     * @param boolean $checked whether the check box is checked.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated check box.
     */
    public static function checkBox($name, $checked = false, $htmlOptions = array())
    {
        $label = self::popOption('label', $htmlOptions, false);
        $labelOptions = self::popOption('labelOptions', $htmlOptions, array());
        $checkBox = CHtml::checkBox($name, $checked, $htmlOptions);
        if ($label !== false)
        {
            $labelOptions = self::addClassName('checkbox', $labelOptions);
            ob_start();
            echo self::tag('label', $labelOptions, $checkBox . $label);
            return ob_get_clean();
        }
        else
            return $checkBox;
    }

    /**
     * Generates a drop down list.
     * @param string $name the input name.
     * @param string $select the selected value.
     * @param array $data data for generating the list options (value=>display).
     * @return string the generated drop down list.
     */
    public static function dropDownList($name, $select, $data, $htmlOptions = array())
    {
        $htmlOptions = self::normalizeInputOptions($htmlOptions);
        return CHtml::dropDownList($name, $select, $data, $htmlOptions);
    }

    /**
     * Generates a list box.
     * @param string $name the input name.
     * @param mixed $select the selected value(s).
     * @param array $data data for generating the list options (value=>display).
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated list box
     */
    public static function listBox($name, $select, $data, $htmlOptions = array())
    {
        $htmlOptions = self::defaultOption('size', 4, $htmlOptions);
        if (isset($htmlOptions['multiple']))
        {
            if (substr($name, -2) !== '[]')
                $name .= '[]';
        }
        return self::dropDownList($name, $select, $data, $htmlOptions);
    }

    /**
     * Generates a radio button list.
     * @param string $name name of the radio button list.
     * @param mixed $select selection of the radio buttons.
     * @param array $data $data value-label pairs used to generate the radio button list.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated list.
     */
    public static function radioButtonList($name, $select, $data, $htmlOptions = array())
    {
        $inline = self::popOption('inline', $htmlOptions, false);
        $separator = self::popOption('separator', $htmlOptions, ' ');
        $container = self::popOption('container', $htmlOptions);
        $containerOptions = self::popOption('containerOptions', $htmlOptions, array());

        $labelOptions = self::popOption('labelOptions', $htmlOptions, array());
        if ($inline)
            $labelOptions = self::addClassName('inline', $labelOptions);

        $items  = array();
        $baseID = $containerOptions['id'] = self::popOption('baseID', $htmlOptions, CHtml::getIdByName($name));

        $id = 0;
        foreach ($data as $value => $label)
        {
            $checked  = !strcmp($value, $select);
            $htmlOptions['value'] = $value;
            $htmlOptions['id'] = $baseID . '_' . $id++;
            if ($inline)
            {
                $htmlOptions['label'] = $label;
                $htmlOptions['labelOptions'] = $labelOptions;
                $items[] = self::radioButton($name, $checked, $htmlOptions);
            }
            else
            {
                $option = self::radioButton($name, $checked, $htmlOptions);
                $items[] = self::label($option . ' ' . $label, false, $labelOptions);
            }
        }

        $inputs = implode($separator, $items);
        return !empty($container) ? self::tag($container, $containerOptions, $inputs) : $inputs;
    }

    /**
     * Generates an inline radio button list.
     * @param string $name name of the radio button list.
     * @param mixed $select selection of the radio buttons.
     * @param array $data $data value-label pairs used to generate the radio button list.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated list.
     */
    public static function inlineRadioButtonList($name, $select, $data, $htmlOptions = array())
    {
        $htmlOptions['inline'] = true;
        return self::radioButtonList($name, $select, $data, $htmlOptions);
    }

    /**
     * Generates a check box list.
     * @param string $name name of the check box list.
     * @param mixed $select selection of the check boxes.
     * @param array $data $data value-label pairs used to generate the check box list.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated list.
     */
    public static function checkBoxList($name, $select, $data, $htmlOptions = array())
    {
        $inline = self::popOption('inline', $htmlOptions, false);
        $separator = self::popOption('separator', $htmlOptions, ' ');
        $container = self::popOption('container', $htmlOptions);
        $containerOptions = self::popOption('containerOptions', $htmlOptions, array());

        if (substr($name, -2) !== '[]')
            $name .= '[]';

        $checkAllLabel = self::popOption('checkAll', $htmlOptions);
        $checkAllLast = self::popOption('checkAllLast', $htmlOptions);

        $labelOptions = self::popOption('labelOptions', $htmlOptions, array());
        if ($inline)
            $labelOptions = self::addClassName('inline', $labelOptions);

        $items  = array();
        $baseID = $containerOptions['id'] = self::popOption('baseID', $htmlOptions, CHtml::getIdByName($name));
        $id = 0;
        $checkAll = true;

        foreach ($data as $value => $label)
        {
            $checked = !is_array($select) && !strcmp($value, $select) || is_array($select) && in_array($value, $select);
            $checkAll = $checkAll && $checked;
            $htmlOptions['value'] = $value;
            $htmlOptions['id'] = $baseID . '_' . $id++;
            if ($inline)
            {
                $htmlOptions['label'] = $label;
                $htmlOptions['labelOptions'] = $labelOptions;
                $items[] = self::checkBox($name, $checked, $htmlOptions);
            }
            else
            {
                $option = self::checkBox($name, $checked, $htmlOptions);
                $items[] = self::label($option . ' ' . $label, false, $labelOptions);
            }
        }

        if (isset($checkAllLabel))
        {
            $htmlOptions['value'] = 1;
            $htmlOptions['id'] = $id = $baseID . '_all';
            $option = self::checkBox($id, $checkAll, $htmlOptions);
            $label = self::label($checkAllLabel, '', $labelOptions);
            $item = self::label($option . ' ' . $label, '', $labelOptions);
            if ($checkAllLast)
                $items[] = $item;
            else
                array_unshift($items, $item);
            $name = strtr($name, array('[' => '\\[', ']' => '\\]'));
            $js = <<<EOD
jQuery('#$id').click(function() {
	jQuery("input[name='$name']").prop('checked', this.checked);
});
jQuery("input[name='$name']").click(function() {
	jQuery('#$id').prop('checked', !jQuery("input[name='$name']:not(:checked)").length);
});
jQuery('#$id').prop('checked', !jQuery("input[name='$name']:not(:checked)").length);
EOD;
            $cs = Yii::app()->getClientScript();
            $cs->registerCoreScript('jquery');
            $cs->registerScript($id, $js);
        }

        $inputs = implode($separator, $items);
        return !empty($container) ? self::tag($container, $containerOptions, $inputs) : $inputs;
    }

    /**
     * Generates an inline check box list.
     * @param string $name name of the check box list.
     * @param mixed $select selection of the check boxes.
     * @param array $data $data value-label pairs used to generate the check box list.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated list.
     */
    public static function inlineCheckBoxList($name, $select, $data, $htmlOptions = array())
    {
        $htmlOptions['inline'] = true;
        return self::checkBoxList($name, $select, $data, $htmlOptions);
    }

    /**
     * Generates an uneditable input.
     * @param string $value the value.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated input.
     */
    public static function uneditableField($value = '', $htmlOptions = array())
    {
        $size = self::popOption('size', $htmlOptions);
        if (!self::addSpanClass($htmlOptions))
        {
            if (isset($size))
                $htmlOptions = self::addClassName('input-' . $size, $htmlOptions);
            else if (isset($htmlOptions['block']))
                $htmlOptions = self::addClassName('input-block-level', $htmlOptions);
        }
        $htmlOptions = self::addClassName('uneditable-input', $htmlOptions);
        return self::tag('span', $htmlOptions, $value);
    }

    /**
     * Generates a search query input.
     * @param string $name the input name.
     * @param string $value the input value.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated input.
     */
    public static function searchQuery($name, $value = '', $htmlOptions = array())
    {
        $htmlOptions = self::addClassName('search-query', $htmlOptions);
        return self::textField($name, $value, $htmlOptions);
    }

    /**
     * Generates a text field input row.
     * @param string $name the input name.
     * @param string $value the input value.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated row.
     * @see TbHtml::row
     */
    public static function textFieldRow($name, $value = '', $htmlOptions = array())
    {
        return self::row(self::INPUT_TYPE_TEXT, $name, $value, $htmlOptions);
    }

    /**
     * Generates a password field input row.
     * @param string $name the input name.
     * @param string $value the input value.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated row.
     * @see TbHtml::textInputField
     */
    public static function passwordFieldRow($name, $value = '', $htmlOptions = array())
    {
        return self::row(self::INPUT_TYPE_PASSWORD, $name, $value, $htmlOptions);
    }

    /**
     * Generates an url field input row.
     * @param string $name the input name.
     * @param string $value the input value.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated row.
     * @see TbHtml::row
     */
    public static function urlFieldRow($name, $value = '', $htmlOptions = array())
    {
        return self::row(self::INPUT_TYPE_URL, $name, $value, $htmlOptions);
    }

    /**
     * Generates an email field input row.
     * @param string $name the input name.
     * @param string $value the input value.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated row.
     * @see TbHtml::row
     */
    public static function emailFieldRow($name, $value = '', $htmlOptions = array())
    {
        return self::row(self::INPUT_TYPE_EMAIL, $name, $value, $htmlOptions);
    }

    /**
     * Generates a number field input row.
     * @param string $name the input name.
     * @param string $value the input value.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated row.
     * @see TbHtml::textInputField
     */
    public static function numberFieldRow($name, $value = '', $htmlOptions = array())
    {
        return self::row(self::INPUT_TYPE_NUMBER, $name, $value, $htmlOptions);
    }

    /**
     * Generates a range field input row.
     * @param string $name the input name
     * @param string $value the input value
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated row.
     * @see TbHtml::row
     */
    public static function rangeFieldRow($name, $value = '', $htmlOptions = array())
    {
        return self::row(self::INPUT_TYPE_RANGE, $name, $value, $htmlOptions);
    }

    /**
     * Generates a date field input row.
     * @param string $name the input name.
     * @param string $value the input value.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated row.
     * @see TbHtml::row
     */
    public static function dateFieldRow($name, $value = '', $htmlOptions = array())
    {
        return self::row(self::INPUT_TYPE_DATE, $name, $value, $htmlOptions);
    }

    /**
     * Generates a text area input row.
     * @param string $name the input name.
     * @param string $value the input value.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated row.
     * @see TbHtml::row
     */
    public static function textAreaRow($name, $value = '', $htmlOptions = array())
    {
        return self::row(self::INPUT_TYPE_TEXTAREA, $name, $value, $htmlOptions);
    }

    /**
     * Generates a file input row.
     * @param string $name the input name.
     * @param string $value the input value.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated row.
     * @see TbHtml::row
     */
    public static function fileFieldRow($name, $value = '', $htmlOptions = array())
    {
        return self::row(self::INPUT_TYPE_FILE, $name, $value, $htmlOptions);
    }

    /**
     * Generates a radio button row.
     * @param string $name the input name.
     * @param string $checked whether the radio button is checked.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated row.
     * @see TbHtml::row
     */
    public static function radioButtonRow($name, $checked = false, $htmlOptions = array())
    {
        return self::row(self::INPUT_TYPE_RADIOBUTTON, $name, $checked, $htmlOptions);
    }

    /**
     * Generates a check box row.
     * @param string $name the input name.
     * @param string $checked whether the check box is checked.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated row.
     * @see TbHtml::row
     */
    public static function checkBoxRow($name, $checked = false, $htmlOptions = array())
    {
        return self::row(self::INPUT_TYPE_CHECKBOX, $name, $checked, $htmlOptions);
    }

    /**
     * Generates a drop down list row.
     * @param string $name the input name.
     * @param string $select the selected value.
     * @param array $data data for generating the list options (value=>display).
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated row.
     * @see TbHtml::row
     */
    public static function dropDownListRow($name, $select = '', $data = array(), $htmlOptions = array())
    {
        return self::row(self::INPUT_TYPE_DROPDOWNLIST, $name, $select, $htmlOptions, $data);
    }

    /**
     * Generates a list box row.
     * @param string $name the input name.
     * @param string $select the selected value.
     * @param array $data data for generating the list options (value=>display).
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated row.
     * @see TbHtml::row
     */
    public static function listBoxRow($name, $select = '', $data = array(), $htmlOptions = array())
    {
        return self::row(self::INPUT_TYPE_LISTBOX, $name, $select, $htmlOptions, $data);
    }

    /**
     * Generates a radio button list row.
     * @param string $name the input name.
     * @param string $select the selected value.
     * @param array $data data for generating the list options (value=>display).
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated row.
     * @see TbHtml::row
     */
    public static function radioButtonListRow($name, $select = '', $data = array(), $htmlOptions = array())
    {
        return self::row(self::INPUT_TYPE_RADIOBUTTONLIST, $name, $select, $htmlOptions, $data);
    }

    /**
     * Generates an inline radio button list row.
     * @param string $name the input name.
     * @param string $select the selected value.
     * @param array $data data for generating the list options (value=>display).
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated row.
     * @see TbHtml::row
     */
    public static function inlineRadioButtonListRow($name, $select = '', $data = array(), $htmlOptions = array())
    {
        return self::row(self::INPUT_TYPE_INLINERADIOBUTTONLIST, $name, $select, $htmlOptions, $data);
    }

    /**
     * Generates a check box list row.
     * @param string $name the input name.
     * @param string $select the selected value.
     * @param array $data data for generating the list options (value=>display).
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated row.
     * @see TbHtml::row
     */
    public static function checkBoxListRow($name, $select = '', $data = array(), $htmlOptions = array())
    {
        return self::row(self::INPUT_TYPE_CHECKBOXLIST, $name, $select, $htmlOptions, $data);
    }

    /**
     * Generates an inline check box list row.
     * @param string $name the input name.
     * @param string $select the selected value.
     * @param array $data data for generating the list options (value=>display).
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated row.
     * @see TbHtml::row
     */
    public static function inlineCheckBoxListRow($name, $select = '', $data = array(), $htmlOptions = array())
    {
        return self::row(self::INPUT_TYPE_INLINECHECKBOXLIST, $name, $select, $htmlOptions, $data);
    }

    /**
     * Generates a uneditable field row.
     * @param string $select the input value.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated row.
     * @see TbHtml::row
     */
    public static function unediableFieldRow($value = '', $htmlOptions = array())
    {
        return self::row(self::INPUT_TYPE_UNEDITABLE, '', $value, $htmlOptions);
    }

    /**
     * Generates search query row.
     * @param string $name the input name.
     * @param string $select the input value.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated row.
     * @see TbHtml::row
     */
    public static function searchQueryRow($name, $value = '', $htmlOptions = array())
    {
        return self::row(self::INPUT_TYPE_SEARCH, $name, $value, $htmlOptions);
    }

    /**
     * Generates a form row.
     * @param string $type the input type.
     * @param string $name the input name.
     * @param string $value the input value.
     * @param array $htmlOptions additional HTML attributes.
     * @param array $data data for multiple select inputs.
     * @return string the generated row.
     */
    public static function row($type, $name, $value, $htmlOptions = array(), $data = array())
    {
        $wrap = self::popOption('wrap', $htmlOptions, false);
        $label = self::popOption('label', $htmlOptions, false);
        $color = self::popOption('color', $htmlOptions);
        $groupOptions = self::popOption('groupOptions', $htmlOptions, array());
        $labelOptions = self::popOption('labelOptions', $htmlOptions, array());
        $controlOptions = self::popOption('controlOptions', $htmlOptions, array());

        if (in_array($type, array(self::INPUT_TYPE_CHECKBOX, self::INPUT_TYPE_RADIOBUTTON)))
        {
            $htmlOptions['label'] = $label;
            $htmlOptions['labelOptions'] = $labelOptions;
            $label = false;
        }

        $help = self::popOption('help', $htmlOptions, '');
        $helpOptions = self::popOption('helpOptions', $htmlOptions, array());
        if (!empty($help))
            $help = self::inputHelp($help, $helpOptions);
        $input = self::createInput($type, $name, $value, $htmlOptions, $data);

        if ($wrap)
        {
            $groupOptions = self::addClassName('control-group', $groupOptions);
            if (isset($color))
                $groupOptions = self::addClassName($color, $groupOptions);
            $labelOptions = self::addClassName('control-label', $labelOptions);
            ob_start();
            echo self::openTag('div', $groupOptions);
            if ($label !== false)
                echo CHtml::label($label, $name, $labelOptions);
            echo self::formControls($input . $help, $controlOptions);
            echo '</div>';
            return ob_get_clean();
        }
        else
        {
            ob_start();
            if ($label !== false)
                echo CHtml::label($label, $name, $labelOptions);
            echo $input . $help;
            return ob_get_clean();
        }
    }

    /**
     * Generates a wrapped form row.
     * @param string $type the input type.
     * @param string $name the input name.
     * @param string $value the input value.
     * @param array $htmlOptions additional HTML attributes.
     * @param array $data data for multiple select inputs.
     * @return string the generated row.
     */
    public static function wrappedRow($type, $name, $value, $htmlOptions = array(), $data = array())
    {
        $htmlOptions['wrap'] = true;
        return self::row($type, $name, $value, $htmlOptions, $data);
    }

    /**
     * Creates a form input of the given type.
     * @param string $type the input type.
     * @param string $name the input name.
     * @param string $value the input value.
     * @param array $htmlOptions additional HTML attributes.
     * @param array $data data for multiple select inputs.
     * @return string the input.
     * @throws CException if the input type is invalid.
     */
    protected static function createInput($type, $name, $value, $htmlOptions = array(), $data = array())
    {
        switch ($type)
        {
            case self::INPUT_TYPE_URL: return self::urlField($name, $value, $htmlOptions);
            case self::INPUT_TYPE_EMAIL: return self::emailField($name, $value, $htmlOptions);
            case self::INPUT_TYPE_NUMBER: return self::numberField($name, $value, $htmlOptions);
            case self::INPUT_TYPE_RANGE: return self::rangeField($name, $value, $htmlOptions);
            case self::INPUT_TYPE_DATE: return self::dateField($name, $value, $htmlOptions);
            case self::INPUT_TYPE_TEXT: return self::textField($name, $value, $htmlOptions);
            case self::INPUT_TYPE_PASSWORD: return self::passwordField($name, $value, $htmlOptions);
            case self::INPUT_TYPE_TEXTAREA: return self::textArea($name, $value, $htmlOptions);
            case self::INPUT_TYPE_FILE: return self::fileField($name, $value, $htmlOptions);
            case self::INPUT_TYPE_RADIOBUTTON: return self::radioButton($name, $value, $htmlOptions);
            case self::INPUT_TYPE_CHECKBOX: return self::checkBox($name, $value, $htmlOptions);
            case self::INPUT_TYPE_DROPDOWNLIST: return self::dropDownList($name, $value, $data, $htmlOptions);
            case self::INPUT_TYPE_LISTBOX: return self::listBox($name, $value, $data, $htmlOptions);
            case self::INPUT_TYPE_CHECKBOXLIST: return self::checkBoxList($name, $value, $data, $htmlOptions);
            case self::INPUT_TYPE_INLINECHECKBOXLIST: return self::inlineCheckBoxList($name, $value, $data, $htmlOptions);
            case self::INPUT_TYPE_RADIOBUTTONLIST: return self::radioButtonList($name, $value, $data, $htmlOptions);
            case self::INPUT_TYPE_INLINERADIOBUTTONLIST: return self::inlineRadioButtonList($name, $value, $data, $htmlOptions);
            case self::INPUT_TYPE_UNEDITABLE: return self::uneditableField($value, $htmlOptions);
            case self::INPUT_TYPE_SEARCH: return self::searchQuery($name, $value, $htmlOptions);
            default: throw new CException('Invalid input type "' . $type . '".');
        }
    }

    /**
     * Generates an input HTML tag.
     * This method generates an input HTML tag based on the given input name and value.
     * @param string $type the input type.
     * @param string $name the input name.
     * @param string $value the input value.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated input tag.
     */
    protected static function textInputField($type, $name, $value, $htmlOptions)
    {
        CHtml::clientChange('change', $htmlOptions);

        $htmlOptions = self::normalizeInputOptions($htmlOptions);

        $addOnClasses = self::getAddOnClasses($htmlOptions);
        $addOnOptions = self::popOption('addOnOptions', $htmlOptions, array());
        $addOnOptions = self::addClassName($addOnClasses, $addOnOptions);

        $prepend = self::popOption('prepend', $htmlOptions, '');
        $prependOptions = self::popOption('prependOptions', $htmlOptions, array());
        if (!empty($prepend))
            $prepend = self::inputAddOn($prepend, $prependOptions);

        $append = self::popOption('append', $htmlOptions, '');
        $appendOptions = self::popOption('appendOptions', $htmlOptions, array());
        if (!empty($append))
            $append = self::inputAddOn($append, $appendOptions);

        ob_start();
        if (!empty($addOnClasses))
            echo self::openTag('div', $addOnOptions);
        echo $prepend . CHtml::inputField($type, $name, $value, $htmlOptions) . $append;
        if (!empty($addOnClasses))
            echo '</div>';
        return ob_get_clean();
    }

    /**
     * Generates a text field input for a model attribute.
     * @param CModel $model the data model.
     * @param string $attribute the attribute.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated input field.
     * @see TbHtml::activeTextInputField
     */
    public static function activeTextField($model, $attribute, $htmlOptions = array())
    {
        return self::activeTextInputField('text', $model, $attribute, $htmlOptions);
    }

    /**
     * Generates a password field input for a model attribute.
     * @param CModel $model the data model.
     * @param string $attribute the attribute.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated input field.
     * @see TbHtml::activeTextInputField
     */
    public static function activePasswordField($model, $attribute, $htmlOptions = array())
    {
        return self::activeTextInputField('password', $model, $attribute, $htmlOptions);
    }

    /**
     * Generates an url field input for a model attribute.
     * @param CModel $model the data model.
     * @param string $attribute the attribute.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated input field.
     * @see TbHtml::activeTextInputField
     */
    public static function activeUrlField($model, $attribute, $htmlOptions = array())
    {
        return self::activeTextInputField('url', $model, $attribute, $htmlOptions);
    }

    /**
     * Generates an email field input for a model attribute.
     * @param CModel $model the data model.
     * @param string $attribute the attribute.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated input field.
     * @see TbHtml::activeTextInputField
     */
    public static function activeEmailField($model, $attribute, $htmlOptions = array())
    {
        return self::activeTextInputField('email', $model, $attribute, $htmlOptions);
    }

    /**
     * Generates a number field input for a model attribute.
     * @param CModel $model the data model.
     * @param string $attribute the attribute.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated input field.
     * @see TbHtml::activeTextInputField
     */
    public static function activeNumberField($model, $attribute, $htmlOptions = array())
    {
        return self::activeTextInputField('number', $model, $attribute, $htmlOptions);
    }

    /**
     * Generates a range field input for a model attribute.
     * @param CModel $model the data model.
     * @param string $attribute the attribute.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated input field.
     * @see TbHtml::activeTextInputField
     */
    public static function activeRangeField($model, $attribute, $htmlOptions = array())
    {
        return self::activeTextInputField('range', $model, $attribute, $htmlOptions);
    }

    /**
     * Generates a date field input for a model attribute.
     * @param CModel $model the data model.
     * @param string $attribute the attribute.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated input field.
     * @see TbHtml::activeTextInputField
     */
    public static function activeDateField($model, $attribute, $htmlOptions = array())
    {
        return self::activeTextInputField('date', $model, $attribute, $htmlOptions);
    }

    /**
     * Generates a text area input for a model attribute.
     * @param CModel $model the data model.
     * @param string $attribute the attribute.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated text area.
     */
    public static function activeTextArea($model, $attribute, $htmlOptions = array())
    {
        $htmlOptions = self::normalizeInputOptions($htmlOptions);
        return CHtml::activeTextArea($model, $attribute, $htmlOptions);
    }

    /**
     * Generates a radio button for a model attribute.
     * @param CModel $model the data model.
     * @param string $attribute the attribute.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated radio button.
     */
    public static function activeRadioButton($model, $attribute, $htmlOptions = array())
    {
        $label = self::popOption('label', $htmlOptions, false);
        $labelOptions = self::popOption('labelOptions', $htmlOptions, array());
        $radioButton = CHtml::activeRadioButton($model, $attribute, $htmlOptions);
        if ($label !== false)
        {
            $labelOptions = self::addClassName('radio', $labelOptions);
            ob_start();
            echo self::tag('label', $labelOptions, $radioButton . $label);
            return ob_get_clean();
        }
        else
            return $radioButton;
    }

    /**
     * Generates a check box for a model attribute.
     * @param CModel $model the data model.
     * @param string $attribute the attribute.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated check box.
     */
    public static function activeCheckBox($model, $attribute, $htmlOptions = array())
    {
        $label = self::popOption('label', $htmlOptions);
        $labelOptions = self::popOption('labelOptions', $htmlOptions, array());
        $radioButton = CHtml::activeCheckBox($model, $attribute, $htmlOptions);
        if ($label !== false)
        {
            $labelOptions = self::addClassName('checkbox', $labelOptions);
            ob_start();
            echo self::tag('label', $labelOptions, $radioButton . $label);
            return ob_get_clean();
        }
        else
            return $radioButton;
    }

    /**
     * Generates a drop down list for a model attribute.
     * @param CModel $model the data model.
     * @param string $attribute the attribute.
     * @param array $data data for generating the list options (value=>display).
     * @return string the generated drop down list.
     */
    public static function activeDropDownList($model, $attribute, $data, $htmlOptions = array())
    {
        $htmlOptions = self::normalizeInputOptions($htmlOptions);
        return CHtml::activeDropDownList($model, $attribute, $data, $htmlOptions);
    }

    /**
     * Generates a list box for a model attribute.
     * @param CModel $model the data model.
     * @param string $attribute the attribute.
     * @param array $data data for generating the list options (value=>display).
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated list box
     */
    public static function activeListBox($model, $attribute, $data, $htmlOptions = array())
    {
        $htmlOptions = self::defaultOption('size', 4, $htmlOptions);
        return self::activeDropDownList($model, $attribute, $data, $htmlOptions);
    }

    /**
     * Generates a radio button list for a model attribute.
     * @param CModel $model the data model.
     * @param string $attribute the attribute.
     * @param array $data $data value-label pairs used to generate the radio button list.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated list.
     */
    public static function activeRadioButtonList($model, $attribute, $data, $htmlOptions = array())
    {
        CHtml::resolveNameID($model, $attribute, $htmlOptions);
        $selection = CHtml::resolveValue($model, $attribute);
        if ($model->hasErrors($attribute))
            CHtml::addErrorCss($htmlOptions);
        $name = self::popOption('name', $htmlOptions);
        $unCheck = self::popOption('uncheckValue', $htmlOptions, '');
        $hiddenOptions = isset($htmlOptions['id']) ? array('id' => CHtml::ID_PREFIX . $htmlOptions['id']) : array('id' => false);
        $hidden = $unCheck !== null ? CHtml::hiddenField($name, $unCheck, $hiddenOptions) : '';
        return $hidden . self::radioButtonList($name, $selection, $data, $htmlOptions);
    }

    /**
     * Generates an inline radio button list for a model attribute.
     * @param CModel $model the data model.
     * @param string $attribute the attribute.
     * @param array $data $data value-label pairs used to generate the radio button list.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated list.
     */
    public static function activeInlineRadioButtonList($model, $attribute, $data, $htmlOptions = array())
    {
        $htmlOptions['inline'] = true;
        return self::activeRadioButtonList($model, $attribute, $data, $htmlOptions);
    }

    /**
     * Generates a check box list for a model attribute.
     * @param CModel $model the data model.
     * @param string $attribute the attribute.
     * @param array $data $data value-label pairs used to generate the check box list.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated list.
     */
    public static function activeCheckBoxList($model,$attribute,$data,$htmlOptions=array())
    {
        CHtml::resolveNameID($model, $attribute, $htmlOptions);
        $selection = CHtml::resolveValue($model, $attribute);
        if ($model->hasErrors($attribute))
            CHtml::addErrorCss($htmlOptions);
        $name = self::popOption('name', $htmlOptions);
        $unCheck = self::popOption('uncheckValue', $htmlOptions, '');
        $hiddenOptions = isset($htmlOptions['id']) ? array('id' => CHtml::ID_PREFIX . $htmlOptions['id']) : array('id' => false);
        $hidden = $unCheck !== null ? CHtml::hiddenField($name, $unCheck, $hiddenOptions) : '';
        return $hidden . self::checkBoxList($name, $selection, $data, $htmlOptions);
    }

    /**
     * Generates an inline check box list for a model attribute.
     * @param CModel $model the data model.
     * @param string $attribute the attribute.
     * @param array $data $data value-label pairs used to generate the check box list.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated list.
     */
    public static function activeInlineCheckBoxList($model, $attribute, $data, $htmlOptions = array())
    {
        $htmlOptions['inline'] = true;
        return self::activeCheckBoxList($model, $attribute, $data, $htmlOptions);
    }

    /**
     * Generates an uneditable input for a model attribute.
     * @param CModel $model the data model.
     * @param string $attribute the attribute.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated input.
     */
    public static function activeUneditableField($model, $attribute, $htmlOptions = array())
    {
        CHtml::resolveNameID($model, $attribute, $htmlOptions);
        $value = CHtml::resolveValue($model, $attribute);
        return self::uneditableField($value, $htmlOptions);
    }

    /**
     * Generates a search query input for a model attribute.
     * @param CModel $model the data model.
     * @param string $attribute the attribute.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated input.
     */
    public static function activeSearchQuery($model, $attribute, $htmlOptions = array())
    {
        $htmlOptions = self::addClassName('search-query', $htmlOptions);
        return self::activeTextField($model, $attribute, $htmlOptions);
    }

    /**
     * Generates a text field input row for a model attribute.
     * @param CModel $model the data model.
     * @param string $attribute the attribute.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated row.
     * @see TbHtml::row
     */
    public static function activeTextFieldRow($model, $attribute, $htmlOptions = array())
    {
        return self::activeRow(self::INPUT_TYPE_TEXT, $model, $attribute, $htmlOptions);
    }

    /**
     * Generates a password field input row for a model attribute.
     * @param CModel $model the data model.
     * @param string $attribute the attribute.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated row.
     * @see TbHtml::textInputField
     */
    public static function activePasswordFieldRow($model, $attribute, $htmlOptions = array())
    {
        return self::activeRow(self::INPUT_TYPE_PASSWORD, $model, $attribute, $htmlOptions);
    }

    /**
     * Generates an url field input row for a model attribute.
     * @param CModel $model the data model.
     * @param string $attribute the attribute.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated row.
     * @see TbHtml::row
     */
    public static function activeUrlFieldRow($model, $attribute, $htmlOptions = array())
    {
        return self::activeRow(self::INPUT_TYPE_URL, $model, $attribute, $htmlOptions);
    }

    /**
     * Generates an email field input row for a model attribute.
     * @param CModel $model the data model.
     * @param string $attribute the attribute.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated row.
     * @see TbHtml::row
     */
    public static function activeEmailFieldRow($name, $value = '', $htmlOptions = array())
    {
        return self::activeRow(self::INPUT_TYPE_EMAIL, $name, $value, $htmlOptions);
    }

    /**
     * Generates a number field input row for a model attribute.
     * @param CModel $model the data model.
     * @param string $attribute the attribute.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated row.
     * @see TbHtml::textInputField
     */
    public static function activeNumberFieldRow($model, $attribute, $htmlOptions = array())
    {
        return self::activeRow(self::INPUT_TYPE_NUMBER, $model, $attribute, $htmlOptions);
    }

    /**
     * Generates a range field input row for a model attribute.
     * @param CModel $model the data model.
     * @param string $attribute the attribute.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated row.
     * @see TbHtml::row
     */
    public static function activeRangeFieldRow($name, $value = '', $htmlOptions = array())
    {
        return self::row(self::INPUT_TYPE_RANGE, $name, $value, $htmlOptions);
    }

    /**
     * Generates a date field input row for a model attribute.
     * @param CModel $model the data model.
     * @param string $attribute the attribute.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated row.
     * @see TbHtml::row
     */
    public static function activeDateFieldRow($name, $value = '', $htmlOptions = array())
    {
        return self::activeRow(self::INPUT_TYPE_DATE, $name, $value, $htmlOptions);
    }

    /**
     * Generates a text area input row for a model attribute.
     * @param CModel $model the data model.
     * @param string $attribute the attribute.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated row.
     * @see TbHtml::row
     */
    public static function activeTextAreaRow($model, $attribute, $htmlOptions = array())
    {
        return self::activeRow(self::INPUT_TYPE_TEXTAREA, $model, $attribute, $htmlOptions);
    }

    /**
     * Generates a file input row for a model attribute.
     * @param CModel $model the data model.
     * @param string $attribute the attribute.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated row.
     * @see TbHtml::row
     */
    public static function activeFileFieldRow($model, $attribute, $htmlOptions = array())
    {
        return self::activeRow(self::INPUT_TYPE_FILE, $model, $attribute, $htmlOptions);
    }

    /**
     * Generates a radio button row for a model attribute.
     * @param CModel $model the data model.
     * @param string $attribute the attribute.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated row.
     * @see TbHtml::row
     */
    public static function activeRadioButtonRow($model, $attribute, $htmlOptions = array())
    {
        return self::activeRow(self::INPUT_TYPE_RADIOBUTTON, $model, $attribute, $htmlOptions);
    }

    /**
     * Generates a check box row for a model attribute.
     * @param string $name the input name.
     * @param string $checked whether the check box is checked.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated row.
     * @see TbHtml::row
     */
    public static function activeCheckBoxRow($model, $attribute, $htmlOptions = array())
    {
        return self::activeRow(self::INPUT_TYPE_CHECKBOX, $model, $attribute, $htmlOptions);
    }

    /**
     * Generates a drop down list row for a model attribute.
     * @param CModel $model the data model.
     * @param string $attribute the attribute.
     * @param array $data data for generating the list options (value=>display).
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated row.
     * @see TbHtml::row
     */
    public static function activeDropDownListRow($model, $attribute, $data = array(), $htmlOptions = array())
    {
        return self::activeRow(self::INPUT_TYPE_DROPDOWNLIST, $model, $attribute, $htmlOptions, $data);
    }

    /**
     * Generates a list box row for a model attribute.
     * @param string $name the input name.
     * @param string $select the selected value.
     * @param array $data data for generating the list options (value=>display).
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated row.
     * @see TbHtml::row
     */
    public static function activeListBoxRow($model, $attribute, $data = array(), $htmlOptions = array())
    {
        return self::activeRow(self::INPUT_TYPE_LISTBOX, $model, $attribute, $htmlOptions, $data);
    }

    /**
     * Generates a radio button list row for a model attribute.
     * @param CModel $model the data model.
     * @param string $attribute the attribute.
     * @param array $data data for generating the list options (value=>display).
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated row.
     * @see TbHtml::row
     */
    public static function activeRadioButtonListRow($model, $attribute, $data = array(), $htmlOptions = array())
    {
        return self::activeRow(self::INPUT_TYPE_RADIOBUTTONLIST, $model, $attribute, $htmlOptions, $data);
    }

    /**
     * Generates an inline radio button list row for a model attribute.
     * @param string $name the input name.
     * @param string $select the selected value.
     * @param array $data data for generating the list options (value=>display).
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated row.
     * @see TbHtml::row
     */
    public static function activeInlineRadioButtonListRow($model, $attribute, $data = array(), $htmlOptions = array())
    {
        return self::activeRow(self::INPUT_TYPE_INLINERADIOBUTTONLIST, $model, $attribute, $htmlOptions, $data);
    }

    /**
     * Generates a check box list row for a model attribute.
     * @param CModel $model the data model.
     * @param string $attribute the attribute.
     * @param array $data data for generating the list options (value=>display).
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated row.
     * @see TbHtml::row
     */
    public static function activeCheckBoxListRow($model, $attribute, $data = array(), $htmlOptions = array())
    {
        return self::activeRow(self::INPUT_TYPE_CHECKBOXLIST, $model, $attribute, $htmlOptions, $data);
    }

    /**
     * Generates an inline check box list row for a model attribute.
     * @param CModel $model the data model.
     * @param string $attribute the attribute.
     * @param array $data data for generating the list options (value=>display).
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated row.
     * @see TbHtml::row
     */
    public static function activeInlineCheckBoxListRow($model, $attribute, $data = array(), $htmlOptions = array())
    {
        return self::activeRow(self::INPUT_TYPE_INLINECHECKBOXLIST, $model, $attribute, $htmlOptions, $data);
    }

    /**
     * Generates a uneditable field row for a model attribute.
     * @param CModel $model the data model.
     * @param string $attribute the attribute.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated row.
     * @see TbHtml::row
     */
    public static function activeUnediableFieldRow($model, $attribute, $htmlOptions = array())
    {
        return self::activeRow(self::INPUT_TYPE_UNEDITABLE, $model, $attribute, $htmlOptions);
    }

    /**
     * Generates search query row for a model attribute.
     * @param CModel $model the data model.
     * @param string $attribute the attribute.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated row.
     * @see TbHtml::row
     */
    public static function activeSearchQueryRow($model, $attribute, $htmlOptions = array())
    {
        return self::activeRow(self::INPUT_TYPE_SEARCH, $model, $attribute, $htmlOptions);
    }

    /**
     * Generates an active form row.
     * @param string $type the input type.
     * @param CModel $model the data model.
     * @param string $attribute the attribute.
     * @param array $htmlOptions additional HTML attributes.
     * @param array $data data for multiple select inputs.
     * @return string the generated row.
     */
    public static function activeRow($type, $model, $attribute, $htmlOptions = array(), $data = array())
    {
        $wrap = self::popOption('wrap', $htmlOptions, false);
        $label = self::popOption('label', $htmlOptions);
        $color = self::popOption('color', $htmlOptions);
        $groupOptions = self::popOption('groupOptions', $htmlOptions, array());
        $labelOptions = self::popOption('labelOptions', $htmlOptions, array());
        $controlOptions = self::popOption('controlOptions', $htmlOptions, array());

        if (in_array($type, array(self::INPUT_TYPE_CHECKBOX, self::INPUT_TYPE_RADIOBUTTON)))
        {
            $htmlOptions = self::defaultOption('label', $model->getAttributeLabel($attribute), $htmlOptions);
            $htmlOptions['labelOptions'] = $labelOptions;
            $label = false;
        }

        $help = self::popOption('help', $htmlOptions, '');
        $helpOptions = self::popOption('helpOptions', $htmlOptions, array());
        if (!empty($help))
            $help = self::inputHelp($help, $helpOptions);
        $error = self::popOption('error', $htmlOptions, '');
        $input = self::createActiveInput($type, $model, $attribute, $htmlOptions, $data);

        if ($wrap)
        {
            $groupOptions = self::addClassName('control-group', $groupOptions);
            if (isset($color))
                $groupOptions = self::addClassName($color, $groupOptions);
            $labelOptions = self::addClassName('control-label', $labelOptions);
            ob_start();
            echo self::openTag('div', $groupOptions);
            if ($label !== false)
                echo CHtml::activeLabelEx($model, $attribute, $labelOptions);
            echo self::formControls($input . $error . $help, $controlOptions);
            echo '</div>';
            return ob_get_clean();
        }
        else
        {
            ob_start();
            if ($label !== false)
                echo CHtml::activeLabelEx($model, $attribute, $labelOptions);
            echo $input . $error . $help;
            return ob_get_clean();
        }
    }

    /**
     * Generates a wrapped active form row.
     * @param string $type the input type.
     * @param CModel $model the data model.
     * @param string $attribute the attribute.
     * @param array $htmlOptions additional HTML attributes.
     * @param array $data data for multiple select inputs.
     * @return string the generated row.
     */
    public static function wrappedActiveRow($type, $model, $attribute, $htmlOptions = array(), $data = array())
    {
        $htmlOptions['wrap'] = true;
        return self::activeRow($type, $model, $attribute, $htmlOptions, $data);
    }

    /**
     * Creates an active form input of the given type.
     * @param string $type the input type.
     * @param CModel $model the model instance.
     * @param string $attribute the attribute name.
     * @param array $htmlOptions additional HTML attributes.
     * @param array $data data for multiple select inputs.
     * @return string the input.
     * @throws CException if the input type is invalid.
     */
    protected static function createActiveInput($type, $model, $attribute, $htmlOptions = array(), $data = array())
    {
        switch ($type)
        {
            case self::INPUT_TYPE_URL: return self::activeUrlField($model, $attribute, $htmlOptions);
            case self::INPUT_TYPE_EMAIL: return self::activeEmailField($model, $attribute, $htmlOptions);
            case self::INPUT_TYPE_NUMBER: return self::activeNumberField($model, $attribute, $htmlOptions);
            case self::INPUT_TYPE_RANGE: return self::activeRangeField($model, $attribute, $htmlOptions);
            case self::INPUT_TYPE_DATE: return self::activeDateField($model, $attribute, $htmlOptions);
            case self::INPUT_TYPE_TEXT: return self::activeTextField($model, $attribute, $htmlOptions);
            case self::INPUT_TYPE_PASSWORD: return self::activePasswordField($model, $attribute, $htmlOptions);
            case self::INPUT_TYPE_TEXTAREA: return self::activeTextArea($model, $attribute, $htmlOptions);
            case self::INPUT_TYPE_FILE: return self::activeFileField($model, $attribute, $htmlOptions);
            case self::INPUT_TYPE_RADIOBUTTON: return self::activeRadioButton($model, $attribute, $htmlOptions);
            case self::INPUT_TYPE_CHECKBOX: return self::activeCheckBox($model, $attribute, $htmlOptions);
            case self::INPUT_TYPE_DROPDOWNLIST: return self::activeDropDownList($model, $attribute, $data, $htmlOptions);
            case self::INPUT_TYPE_LISTBOX: return self::activeListBox($model, $attribute, $data, $htmlOptions);
            case self::INPUT_TYPE_CHECKBOXLIST: return self::activeCheckBoxList($model, $attribute, $data, $htmlOptions);
            case self::INPUT_TYPE_INLINECHECKBOXLIST: return self::activeInlineCheckBoxList($model, $attribute, $data, $htmlOptions);
            case self::INPUT_TYPE_RADIOBUTTONLIST: return self::activeRadioButtonList($model, $attribute, $data, $htmlOptions);
            case self::INPUT_TYPE_INLINERADIOBUTTONLIST: return self::activeInlineRadioButtonList($model, $attribute, $data, $htmlOptions);
            case self::INPUT_TYPE_UNEDITABLE: return self::activeUneditableField($model, $attribute, $htmlOptions);
            case self::INPUT_TYPE_SEARCH: return self::activeSearchQuery($model, $attribute, $htmlOptions);
            default: throw new CException('Invalid input type "' . $type . '".');
        }
    }

    /**
     * Displays a summary of validation errors for one or several models.
     * @param mixed $model the models whose input errors are to be displayed.
     * @param string $header a piece of HTML code that appears in front of the errors.
     * @param string $footer a piece of HTML code that appears at the end of the errors.
     * @param array $htmlOptions additional HTML attributes to be rendered in the container div tag.
     * @return string the error summary. Empty if no errors are found.
     */
    public static function errorSummary($model, $header = null, $footer = null, $htmlOptions = array())
    {
        // kind of a quick fix but it will do for now.
        $htmlOptions = self::addClassName('alert alert-block alert-error', $htmlOptions);
        return CHtml::errorSummary($model, $header, $footer, $htmlOptions);
    }

    /**
     * Displays the first validation error for a model attribute.
     * @param CModel $model the data model.
     * @param string $attribute the attribute name.
     * @param array $htmlOptions additional HTML attributes to be rendered in the container tag.
     * @return string the error display. Empty if no errors are found.
     */
    public static function error($model, $attribute, $htmlOptions = array())
    {
        CHtml::resolveName($model, $attribute); // turn [a][b]attr into attr
        $error = $model->getError($attribute);
        return !empty($error) ? self::help($error, $htmlOptions) : '';
    }

    /**
     * Generates an input HTML tag  for a model attribute.
     * This method generates an input HTML tag based on the given input name and value.
     * @param string $type the input type.
     * @param CModel $model the data model.
     * @param string $attribute the attribute.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated input tag.
     */
    protected static function activeTextInputField($type, $model, $attribute, $htmlOptions)
    {
        CHtml::resolveNameID($model, $attribute, $htmlOptions);
        CHtml::clientChange('change', $htmlOptions);

        $htmlOptions = self::normalizeInputOptions($htmlOptions);

        $addOnClasses = self::getAddOnClasses($htmlOptions);
        $addOnOptions = self::popOption('addOnOptions', $htmlOptions, array());
        $addOnOptions = self::addClassName($addOnClasses, $addOnOptions);

        $prepend = self::popOption('prepend', $htmlOptions, '');
        $prependOptions = self::popOption('prependOptions', $htmlOptions, array());
        if (!empty($prepend))
            $prepend = self::inputAddOn($prepend, $prependOptions);

        $append = self::popOption('append', $htmlOptions, '');
        $appendOptions = self::popOption('appendOptions', $htmlOptions, array());
        if (!empty($append))
            $append = self::inputAddOn($append, $appendOptions);

        ob_start();
        if (!empty($addOnClasses))
            echo self::openTag('div', $addOnOptions);
        echo $prepend . CHtml::activeInputField($type, $model, $attribute, $htmlOptions) . $append;
        if (!empty($addOnClasses))
            echo '</div>';
        return ob_get_clean();
    }

    /**
     * Returns the add-on classes based on the given options.
     * @param array $htmlOptions the options.
     * @return string the classes.
     */
    protected static function getAddOnClasses($htmlOptions)
    {
        $classes = array();
        if (self::getOption('append', $htmlOptions))
            $classes[] = 'input-append';
        if (self::getOption('prepend', $htmlOptions))
            $classes[] = 'input-prepend';
        return !empty($classes) ? implode(' ', $classes) : $classes;
    }

    /**
     * Generates an add-on for an input field.
     * @param string $addOn the add-on.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated add-on.
     */
    protected static function inputAddOn($addOn, $htmlOptions)
    {
        $addOnOptions = self::popOption('addOnOptions', $htmlOptions, array());
        $addOnOptions = self::addClassName('add-on', $addOnOptions);
        return strpos($addOn, 'btn') === false // buttons should not be wrapped in a span
            ? self::tag('span', $addOnOptions, $addOn)
            : $addOn;
    }

    /**
     * Normalizes input options.
     * @param array $options the options.
     * @return array the normalized options.
     */
    protected static function normalizeInputOptions($options)
    {
        $size = self::popOption('size', $options);
        if (!self::addSpanClass($options))
        {
            if (isset($size))
                $options = self::addClassName('input-' . $size, $options);
            else if (isset($options['block']))
                $options = self::addClassName('input-block-level', $options);
        }
        return $options;
    }

    /**
     * Generates a help text for an input field.
     * @param string $help the help text.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated help text.
     */
    protected static function inputHelp($help, $htmlOptions)
    {
        $type = self::popOption('type', $htmlOptions, self::HELP_TYPE_INLINE);
        return $type === self::HELP_TYPE_INLINE
            ? self::help($help, $htmlOptions)
            : self::helpBlock($help, $htmlOptions);
    }

    /**
     * Generates form controls.
     * @param mixed $controls the controls.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated controls.
     */
    public static function formControls($controls, $htmlOptions = array())
    {
        $htmlOptions = self::addClassName('controls', $htmlOptions);
        if (isset($htmlOptions['row']) && $htmlOptions['row'] === true)
            $htmlOptions = self::addClassName('controls-row', $htmlOptions);
        $before = self::popOption('before', $htmlOptions, '');
        $after = self::popOption('after', $htmlOptions, '');
        if (is_array($controls))
            $controls = implode(' ', $controls);
        ob_start();
        echo self::openTag('div', $htmlOptions);
        echo $before . $controls . $after;
        echo '</div>';
        return ob_get_clean();
    }

    /**
     * Generates form controls row.
     * @param mixed $controls the controls.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated controls.
     */
    public static function formControlsRow($controls, $htmlOptions = array())
    {
        $htmlOptions['row'] = true;
        return self::formControls($controls, $htmlOptions);
    }

    /**
     * Generates form actions.
     * @param mixed $actions the actions.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated actions.
     */
    public static function formActions($actions, $htmlOptions = array())
    {
        $htmlOptions = self::addClassName('form-actions', $htmlOptions);
        if (is_array($actions))
            $actions = implode(' ', $actions);
        ob_start();
        echo self::openTag('div', $htmlOptions);
        echo $actions;
        echo '</div>';
        return ob_get_clean();
    }

    /**
     * Generates a search form.
     * @param mixed $action the form action URL.
     * @param string $method form method (e.g. post, get).
     * @param array $htmlOptions additional HTML options.
     * @return string the generated form.
     */
    public static function searchForm($action, $method = 'post', $htmlOptions = array())
    {
        $htmlOptions = self::addClassName('form-search', $htmlOptions);
        $inputOptions = self::popOption('inputOptions', $htmlOptions, array());
        $inputOptions = self::mergeOptions(array('type' => 'text', 'placeholder' => 'Search'), $inputOptions);
        $buttonOptions = self::popOption('buttonOptions', $htmlOptions, array());
        $buttonLabel = self::popOption('label', $buttonOptions, self::icon('search'));
        $name = self::popOption('name', $inputOptions, 'search');
        $value = self::popOption('value', $inputOptions, '');
        $addon = self::popOption('addon', $htmlOptions);
        if (isset($addon))
            $inputOptions[$addon] = self::htmlButton($buttonLabel, $buttonOptions);
        ob_start();
        echo CHtml::beginForm($action, $method, $htmlOptions);
        echo self::searchQuery($name, $value, $inputOptions);
        echo CHtml::endForm();
        return ob_get_clean();
    }

    /**
     * Generates a navbar form.
     * @param mixed $action the form action URL.
     * @param string $method form method (e.g. post, get).
     * @param array $htmlOptions additional HTML attributes
     * @return string the generated form.
     */
    public static function navbarForm($action, $method = 'post', $htmlOptions = array())
    {
        $htmlOptions = self::addClassName('navbar-form', $htmlOptions);
        return CHtml::form($action, $method, $htmlOptions);
    }

    /**
     * Generates a navbar search form.
     * @param mixed $action the form action URL.
     * @param string $method form method (e.g. post, get).
     * @param array $htmlOptions additional HTML attributes
     * @return string the generated form.
     */
    public static function navbarSearchForm($action, $method = 'post', $htmlOptions = array())
    {
        $htmlOptions = self::addClassName('navbar-search', $htmlOptions);
        return self::searchForm($action, $method, $htmlOptions);
    }

    // Buttons
    // http://twitter.github.com/bootstrap/base-css.html#buttons
    // --------------------------------------------------

    /**
     * Generates a hyperlink tag.
     * @param string $text link body. It will NOT be HTML-encoded.
     * @param mixed $url a URL or an action route that can be used to create a URL.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated hyperlink
     */
    public static function link($text, $url = '#', $htmlOptions = array())
    {
        $htmlOptions = self::defaultOption('href', CHtml::normalizeUrl($url), $htmlOptions);
        self::clientChange('click', $htmlOptions);
        return self::tag('a', $htmlOptions, $text);
    }

    /**
     * Generates an button.
     * @param string $label the button label text.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated button.
     */
    public static function button($label = 'Button', $htmlOptions = array())
    {
        return self::htmlButton($label, $htmlOptions);
    }

    /**
     * Generates an image submit button.
     * @param string $src the image URL
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated button.
     */
    public static function htmlButton($label = 'Button', $htmlOptions = array())
    {
        return self::btn(self::BUTTON_TYPE_HTML, $label, $htmlOptions);
    }

    /**
     * Generates a submit button.
     * @param string $label the button label
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated button.
     */
    public static function submitButton($label = 'Submit', $htmlOptions = array())
    {
        return self::btn(self::BUTTON_TYPE_SUBMIT, $label, $htmlOptions);
    }

    /**
     * Generates a reset button.
     * @param string $label the button label
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated button.
     */
    public static function resetButton($label = 'Reset', $htmlOptions = array())
    {
        return self::btn(self::BUTTON_TYPE_RESET, $label, $htmlOptions);
    }

    /**
     * Generates an image submit button.
     * @param string $src the image URL
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated button.
     */
    public static function imageButton($src, $htmlOptions = array())
    {
        $htmlOptions['src'] = $src;
        return self::btn(self::BUTTON_TYPE_IMAGE, 'Submit', $htmlOptions);
    }

    /**
     * Generates a link submit button.
     * @param string $label the button label.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated button tag.
     */
    public static function linkButton($label = 'Submit', $htmlOptions = array())
    {
        return self::btn(self::BUTTON_TYPE_LINKBUTTON, $label, $htmlOptions);
    }

    /**
     * Generates a link that can initiate AJAX requests.
     * @param string $text the link body (it will NOT be HTML-encoded.)
     * @param mixed $url the URL for the AJAX request.
     * @param array $ajaxOptions AJAX options.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated link.
     */
    public static function ajaxLink($text, $url, $ajaxOptions = array(), $htmlOptions = array())
    {
        $htmlOptions['url'] = $url;
        $htmlOptions['ajaxOptions'] = $ajaxOptions;
        return self::btn(self::BUTTON_TYPE_AJAXLINK, $text, $htmlOptions);
    }

    /**
     * Generates a push button that can initiate AJAX requests.
     * @param string $label the button label.
     * @param mixed $url the URL for the AJAX request.
     * @param array $ajaxOptions AJAX options.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated button.
     */
    public static function ajaxButton($label, $url, $ajaxOptions = array(), $htmlOptions = array())
    {
        $ajaxOptions['url']  = $url;
        $htmlOptions['ajax'] = $ajaxOptions;
        return self::btn(self::BUTTON_TYPE_AJAXBUTTON, $label, $htmlOptions);
    }

    /**
     * Generates a push button that can submit the current form in POST method.
     * @param string $label the button label
     * @param mixed $url the URL for the AJAX request.
     * @param array $ajaxOptions AJAX options.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated button.
     */
    public static function ajaxSubmitButton($label, $url, $ajaxOptions = array(), $htmlOptions = array())
    {
        $ajaxOptions['type'] = 'POST';
        $htmlOptions['type'] = 'submit';
        return self::ajaxButton($label, $url, $ajaxOptions, $htmlOptions);
    }

    /**
     * Generates a button.
     * @param string $type the button type.
     * @param string $label the button label text.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated button.
     */
    public static function btn($type, $label, $htmlOptions = array())
    {
        self::addSpanClass($htmlOptions);
        $htmlOptions = self::addClassName('btn', $htmlOptions);
        $color = self::popOption('color', $htmlOptions);
        if (isset($color))
            $htmlOptions = self::addClassName('btn-' . $color, $htmlOptions);
        $size = self::popOption('size', $htmlOptions);
        if (isset($size))
            $htmlOptions = self::addClassName('btn-' . $size, $htmlOptions);
        if (self::popOption('block', $htmlOptions, false))
            $htmlOptions = self::addClassName('btn-block', $htmlOptions);
        if (self::popOption('disabled', $htmlOptions, false))
            $htmlOptions = self::addClassName('disabled', $htmlOptions);
        $loading = self::popOption('loading', $htmlOptions);
        if (!empty($loading))
            $htmlOptions['data-loading-text'] = $loading;
        if (self::popOption('toggle', $htmlOptions, false))
            $htmlOptions['data-toggle'] = 'button';
        $items = strpos($type, 'input') === false ? self::popOption('items', $htmlOptions, array()) : array();
        if (strpos($type, 'input') === false) // inputs cannot have icons
        {
            $icon = self::popOption('icon', $htmlOptions);
            if (isset($icon))
                $label = self::icon($icon) . '&nbsp;' . $label;
        }
        $dropdownOptions = $htmlOptions;
        self::removeOptions($htmlOptions, array('groupOptions', 'menuOptions', 'dropup'));
        return count($items) > 0
            ? self::btnDropdown($type, $label, $items, $dropdownOptions)
            : self::createButton($type, $label, $htmlOptions);
    }

    /**
     * Generates a button dropdown.
     * $type the button type.
     * @param string $label the button label text.
     * @param array $items the menu items.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated button.
     */
    protected static function btnDropdown($type, $label, $items, $htmlOptions)
    {
        $menuOptions = self::popOption('menuOptions', $htmlOptions, array());
        $groupOptions = self::popOption('groupOptions', $htmlOptions, array());
        $groupOptions = self::addClassName('btn-group', $groupOptions);
        if (self::popOption('dropup', $htmlOptions, false))
            $groupOptions = self::addClassName('dropup', $groupOptions);
        ob_start();
        echo self::openTag('div', $groupOptions);
        if (self::popOption('split', $htmlOptions, false))
        {
            echo self::createButton($type, $label, $htmlOptions);
            echo self::dropdownToggleButton('', $htmlOptions);
        }
        else
            echo self::dropdownToggleLink($label, $htmlOptions);
        echo self::dropdown($items, $menuOptions);
        echo '</div>';
        return ob_get_clean();
    }

    /**
     * Creates a button the of given type.
     * @param string $type the button type.
     * @param string $label the button label.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the button.
     */
    protected static function createButton($type, $label, $htmlOptions)
    {
        $url = self::popOption('url', $htmlOptions, '#');
        $ajaxOptions = self::popOption('ajaxOptions', $htmlOptions, array());
        switch ($type)
        {
            case self::BUTTON_TYPE_HTML:
                return CHtml::htmlButton($label, $htmlOptions);

            case self::BUTTON_TYPE_SUBMIT:
                $htmlOptions['type'] = 'submit';
                return CHtml::htmlButton($label, $htmlOptions);

            case self::BUTTON_TYPE_RESET:
                $htmlOptions['type'] = 'reset';
                return CHtml::htmlButton($label, $htmlOptions);

            case self::BUTTON_TYPE_IMAGE:
                $htmlOptions['type'] = 'image';
                return CHtml::htmlButton($label, $htmlOptions);

            case self::BUTTON_TYPE_LINKBUTTON:
                return CHtml::linkButton($label, $htmlOptions);

            case self::BUTTON_TYPE_AJAXLINK:
                return CHtml::ajaxLink($label, $url, $ajaxOptions, $htmlOptions);

            case self::BUTTON_TYPE_AJAXBUTTON:
                $ajaxOptions['url'] = $url;
                $htmlOptions['ajax'] = $ajaxOptions;
                return CHtml::htmlButton($label, $htmlOptions);

            case self::BUTTON_TYPE_INPUTBUTTON:
                return CHtml::button($label, $htmlOptions);

            case self::BUTTON_TYPE_INPUTSUBMIT:
                $htmlOptions['type'] = 'submit';
                return CHtml::button($label, $htmlOptions);

            case self::BUTTON_TYPE_LINK:
                return self::link($label, $url, $htmlOptions);

            default:
                throw new CException('Invalid button type "' . $type . '".');
        }
    }

    // Images
    // http://twitter.github.com/bootstrap/base-css.html#images
    // --------------------------------------------------

    /**
     * Generates an image tag with rounded corners.
     * @param string $src the image URL.
     * @param string $alt the alternative text display.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated image tag.
     */
    public static function imageRounded($src, $alt = '', $htmlOptions = array())
    {
        $htmlOptions['type'] = self::IMAGE_TYPE_ROUNDED;
        return self::image($src, $alt, $htmlOptions);
    }

    /**
     * Generates an image tag with circle.
     * @param string $src the image URL.
     * @param string $alt the alternative text display.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated image tag.
     */
    public static function imageCircle($src, $alt = '', $htmlOptions = array())
    {
        $htmlOptions['type'] = self::IMAGE_TYPE_CIRCLE;
        return self::image($src, $alt, $htmlOptions);
    }

    /**
     * Generates an image tag within polaroid frame.
     * @param string $src the image URL.
     * @param string $alt the alternative text display.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated image tag.
     */
    public static function imagePolaroid($src, $alt = '', $htmlOptions = array())
    {
        $htmlOptions['type'] = self::IMAGE_TYPE_POLAROID;
        return self::image($src, $alt, $htmlOptions);
    }

    /**
     * Generates an image tag.
     * @param string $src the image URL.
     * @param string $alt the alternative text display.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated image tag.
     */
    public static function image($src, $alt = '', $htmlOptions = array())
    {
        $type = self::popOption('type', $htmlOptions);
        if (isset($type))
            $htmlOptions = self::addClassName('img-' . $type, $htmlOptions);
        return CHtml::image($src, $alt, $htmlOptions);
    }

    // Icons by Glyphicons
    // http://twitter.github.com/bootstrap/base-css.html#icons
    // --------------------------------------------------

    /**
     * Generates an icon.
     * @param string $icon the icon type.
     * @param array $htmlOptions additional HTML attributes.
     * @param string $tagName the icon HTML tag.
     * @return string the generated icon.
     */
    public static function icon($icon, $htmlOptions = array(), $tagName = 'i')
    {
        if (is_string($icon))
        {
            if (strpos($icon, 'icon') === false)
                $icon = 'icon-' . implode(' icon-', explode(' ', $icon));
            $htmlOptions = self::addClassName($icon, $htmlOptions);
            return self::openTag($tagName, $htmlOptions) . CHtml::closeTag($tagName); // tag won't work in this case
        }
        return '';
    }

    //
    // COMPONENTS
    // --------------------------------------------------

    // Dropdowns
    // http://twitter.github.com/bootstrap/components.html#dropdowns
    // --------------------------------------------------

    /**
     * Generates a dropdown menu.
     * @param array $items the menu items.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated menu.
     */
    public static function dropdown($items, $htmlOptions = array())
    {
        // todo: think about how to apply this, now it applies to all depths while it should only apply for the first.
        //$htmlOptions = self::setDefaultValue('role', 'menu', $htmlOptions);
        $htmlOptions = self::addClassName('dropdown-menu', $htmlOptions);
        ob_start();
        echo self::menu($items, $htmlOptions);
        return ob_get_clean();
    }

    /**
     * Generates a dropdown toggle link.
     * @param string $label the link label text.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated link.
     */
    public static function dropdownToggleLink($label, $htmlOptions = array())
    {
        return self::dropdownToggle(self::BUTTON_TYPE_LINK, $label, $htmlOptions);
    }

    /**
     * Generates a dropdown toggle button.
     * @param string $label the button label text.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated button.
     */
    public static function dropdownToggleButton($label = '', $htmlOptions = array())
    {
        return self::dropdownToggle(self::BUTTON_TYPE_HTML, $label, $htmlOptions);
    }

    /**
     * Generates a dropdown toggle element.
     * @param string $tag the HTML tag.
     * @param string $label the element text.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated element.
     */
    public static function dropdownToggle($type, $label, $htmlOptions)
    {
        $htmlOptions = self::addClassName('dropdown-toggle', $htmlOptions);
        $htmlOptions = self::defaultOption('data-toggle', 'dropdown', $htmlOptions);
        $label .= ' <b class="caret"></b>';
        return self::btn($type, $label, $htmlOptions);
    }

    /**
     * Generates a dropdown toggle menu item.
     * @param string $label the menu item text.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated menu item.
     */
    public static function dropdownToggleMenuLink($label, $htmlOptions = array())
    {
        $htmlOptions = self::addClassName('dropdown-toggle', $htmlOptions);
        $htmlOptions = self::defaultOption('data-toggle', 'dropdown', $htmlOptions);
        $label .= ' <b class="caret"></b>';
        return self::link($label, '#', $htmlOptions);
    }

    // Button groups
    // http://twitter.github.com/bootstrap/components.html#buttonGroups
    // --------------------------------------------------

    /**
     * Generates a button group.
     * @param array $buttons the button configurations.
     * @param array $htmlOptions additional HTML options.
     * @return string the generated button group.
     */
    public static function buttonGroup($buttons, $htmlOptions = array())
    {
        if (is_array($buttons) && !empty($buttons))
        {
            $htmlOptions = self::addClassName('btn-group', $htmlOptions);
            if (self::popOption('vertical', $htmlOptions, false))
                $htmlOptions = self::addClassName('btn-group-vertical', $htmlOptions);
            $toggle = self::popOption('toggle', $htmlOptions);
            if (!empty($toggle))
                $htmlOptions['data-toggle'] = 'buttons-' . $toggle;
            $parentOptions = array(
                'color' => self::popOption('color', $htmlOptions),
                'size' => self::popOption('size', $htmlOptions),
                'disabled' => self::popOption('disabled', $htmlOptions)
            );
            ob_start();
            echo self::openTag('div', $htmlOptions);
            foreach ($buttons as $buttonOptions)
            {
                $options = self::popOption('htmlOptions', $buttonOptions, array());
                if (!empty($options))
                    $buttonOptions = self::mergeOptions($options, $buttonOptions);
                $buttonLabel = self::popOption('label', $buttonOptions, '');
                $buttonOptions = self::copyOptions(array('color', 'size', 'disabled'), $parentOptions, $buttonOptions);
                if (isset($buttonOptions['items']))
                {
                    $items = self::popOption('items', $buttonOptions);
                    echo self::buttonDropdown($buttonLabel, $items, $buttonOptions);
                }
                else
                    echo self::linkButton($buttonLabel, $buttonOptions);
            }
            echo '</div>';
            return ob_get_clean();
        }
        return '';
    }

    /**
     * Generates a button toolbar.
     * @param array $groups the button group configurations.
     * @param array $htmlOptions additional HTML options.
     * @return string the generated button toolbar.
     */
    public static function buttonToolbar($groups, $htmlOptions = array())
    {
        if (is_array($groups) && !empty($groups))
        {
            $htmlOptions = self::addClassName('btn-toolbar', $htmlOptions);
            $parentOptions = array(
                'color' => self::popOption('color', $htmlOptions),
                'size' => self::popOption('size', $htmlOptions),
                'disabled' => self::popOption('disabled', $htmlOptions)
            );
            ob_start();
            echo self::openTag('div', $htmlOptions);
            foreach ($groups as $groupOptions)
            {
                $items = self::popOption('items', $groupOptions, array());
                if (empty($items))
                    continue;
                $options = self::popOption('htmlOptions', $groupOptions, array());
                if (!empty($options))
                    $groupOptions = self::mergeOptions($options, $groupOptions);
                $groupOptions = self::copyOptions(array('color', 'size', 'disabled'), $parentOptions, $groupOptions);
                echo self::buttonGroup($items, $groupOptions);
            }
            echo '</div>';
            return ob_get_clean();
        }
        return '';
    }

    // Button dropdowns
    // http://twitter.github.com/bootstrap/components.html#buttonDropdowns
    // --------------------------------------------------

    /**
     * Generates a button with a dropdown menu.
     * @param string $label the button label text.
     * @param array $items the menu items.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated button.
     */
    public static function buttonDropdown($label, $items, $htmlOptions = array())
    {
        $htmlOptions['items'] = $items;
        $type = self::popOption('type', $htmlOptions, self::BUTTON_TYPE_LINKBUTTON);
        return self::btn($type, $label, $htmlOptions);
    }

    /**
     * Generates a button with a split dropdown menu.
     * @param string $label the button label text.
     * @param array $items the menu items.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated button.
     */
    public static function splitButtonDropdown($label, $items, $htmlOptions = array())
    {
        $htmlOptions['split'] = true;
        return self::buttonDropdown($label, $items, $htmlOptions);
    }

    // Navs
    // http://twitter.github.com/bootstrap/components.html#navs
    // --------------------------------------------------

    /**
     * Generates a tab navigation.
     * @param array $items the menu items.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated menu.
     */
    public static function tabs($items, $htmlOptions = array())
    {
        return self::nav(self::NAV_TYPE_TABS, $items, $htmlOptions);
    }

    /**
     * Generates a stacked tab navigation.
     * @param array $items the menu items.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated menu.
     */
    public static function stackedTabs($items, $htmlOptions = array())
    {
        $htmlOptions['stacked'] = true;
        return self::tabs($items, $htmlOptions);
    }

    /**
     * Generates a pills navigation.
     * @param array $items the menu items.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated menu.
     */
    public static function pills($items, $htmlOptions = array())
    {
        return self::nav(self::NAV_TYPE_PILLS, $items, $htmlOptions);
    }

    /**
     * Generates a stacked pills navigation.
     * @param array $items the menu items.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated menu.
     */
    public static function stackedPills($items, $htmlOptions = array())
    {
        $htmlOptions['stacked'] = true;
        return self::tabs($items, $htmlOptions);
    }

    /**
     * Generates a list navigation.
     * @param array $items the menu items.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated menu.
     */
    public static function navList($items, $htmlOptions = array())
    {
        return self::nav(self::NAV_TYPE_LIST, $items, $htmlOptions);
    }

    /**
     * Generates a navigation menu.
     * @param string $type the menu type.
     * @param array $items the menu items.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated menu.
     */
    public static function nav($type, $items, $htmlOptions = array())
    {
        $htmlOptions = self::addClassName('nav', $htmlOptions);
        $htmlOptions = self::addClassName('nav-' . $type, $htmlOptions);
        if ($type !== self::NAV_TYPE_LIST && self::popOption('stacked', $htmlOptions, false))
            $htmlOptions = self::addClassName('nav-stacked', $htmlOptions);
        ob_start();
        echo self::menu($items, $htmlOptions);
        return ob_get_clean();
    }

    /**
     * Generates a menu.
     * @param array $items the menu items.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated menu.
     */
    public static function menu($items, $htmlOptions = array())
    {
        ob_start();
        echo self::openTag('ul', $htmlOptions);
        foreach ($items as $itemOptions)
        {
            if (is_string($itemOptions))
                echo $itemOptions;
            else
            {
                $options = self::popOption('itemOptions', $itemOptions, array());
                if (!empty($options))
                    $itemOptions = self::mergeOptions($options, $itemOptions);
                // todo: I'm not quite happy with the logic below but it will have to do for now.
                $label = self::popOption('label', $itemOptions, '');
                if (self::popOption('active', $itemOptions, false))
                    $itemOptions = self::addClassName('active', $itemOptions);
                if (self::popOption('disabled', $itemOptions, false))
                    $itemOptions = self::addClassName('disabled', $itemOptions);
                if (self::popOption('header', $itemOptions, false))
                    echo self::menuHeader($label, $itemOptions);
                else
                {
                    $itemOptions['linkOptions'] = self::getOption('linkOptions', $itemOptions, array());
                    $icon = self::popOption('icon', $itemOptions);
                    if (isset($icon))
                        $label = self::icon($icon) . ' ' . $label;
                    $items = self::popOption('items', $itemOptions, array());
                    if (empty($items))
                    {
                        $url = self::popOption('url', $itemOptions, false);
                        echo self::menuLink($label, $url, $itemOptions);
                    }
                    else
                        echo self::menuDropdown($label, $items, $itemOptions);
                }
            }
        }
        echo '</ul>';
        return ob_get_clean();
    }

    /**
     * Generates a menu link.
     * @param string $label the link label.
     * @param array $url the link url.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated menu item.
     */
    public static function menuLink($label, $url, $htmlOptions = array())
    {
        $linkOptions = self::popOption('linkOptions', $htmlOptions, array());
        ob_start();
        echo self::openTag('li', $htmlOptions);
        echo self::link($label, $url, $linkOptions);
        echo '</li>';
        return ob_get_clean();
    }

    /**
     * Generates a menu dropdown.
     * @param string $label the link label.
     * @param array $items the menu configuration.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated dropdown.
     */
    public static function menuDropdown($label, $items, $htmlOptions)
    {
        $htmlOptions = self::addClassName('dropdown', $htmlOptions);
        $linkOptions = self::popOption('linkOptions', $htmlOptions, array());
        $menuOptions = self::popOption('menuOptions', $htmlOptions, array());
        $menuOptions = self::addClassName('dropdown-menu', $menuOptions);
        if (self::popOption('active', $htmlOptions, false))
            $htmlOptions = self::addClassName('active', $htmlOptions);
        ob_start();
        echo self::openTag('li', $htmlOptions);
        echo self::dropdownToggleMenuLink($label, $linkOptions);
        echo self::menu($items, $menuOptions);
        echo '</li>';
        return ob_get_clean();
    }

    /**
     * Generates a menu header.
     * @param string $label the header text.
     * @param array $htmlOptions additional HTML options.
     * @return string the generated header.
     */
    public static function menuHeader($label, $htmlOptions = array())
    {
        $htmlOptions = self::addClassName('nav-header', $htmlOptions);
        return self::tag('li', $htmlOptions, $label);
    }

    /**
     * Generates a menu divider.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated menu item.
     */
    public static function menuDivider($htmlOptions = array())
    {
        $htmlOptions = self::addClassName('divider', $htmlOptions);
        return self::tag('li', $htmlOptions);
    }

    /**
     * Generates a tabbable menu.
     * @param array $tabs the tab configurations.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated menu.
     */
    public static function tabbable($tabs, $htmlOptions = array())
    {
        $htmlOptions = self::addClassName('tabbable', $htmlOptions);
        $placement = self::popOption('placement', $htmlOptions);
        if (!empty($placement))
            $htmlOptions = self::addClassName('tabs-' . $placement, $htmlOptions);
        $menuOptions = self::popOption('menuOptions', $htmlOptions, array());
        $contentOptions = self::popOption('contentOptions', $htmlOptions, array());
        $contentOptions = self::addClassName('tab-content', $contentOptions);
        $menuItems = array();
        foreach ($tabs as $i => &$tabOptions)
        {
            $icon = self::popOption('icon', $tabOptions);
            $label = self::popOption('label', $tabOptions, '');
            $id = $tabOptions['id'] = self::popOption('id', $tabOptions, 'tab_' . ($i + 1));
            $active = self::getOption('active', $tabOptions, false);
            $disabled = self::popOption('disabled', $tabOptions, false);
            $linkOptions = self::popOption('linkOptions', $tabOptions, array());
            $linkOptions['data-toggle'] = 'tab';
            $itemOptions = self::popOption('itemOptions', $tabOptions, array());
            $items = self::popOption('items', $tabOptions, array());
            $menuItem = array(
                'icon' => $icon,
                'label' => $label,
                'url' => '#' . $id,
                'active' => $active,
                'disabled' => $disabled,
                'itemOptions' => $itemOptions,
                'linkOptions' => $linkOptions,
                'items' => $items,
            );
            $menuItems[] = $menuItem;
        }
        ob_start();
        echo TbHtml::openTag('div', $htmlOptions);
        echo TbHtml::tabs($menuItems, $menuOptions);
        echo TbHtml::openTag('div', $contentOptions);
        foreach ($tabs as &$tabOptions)
        {
            if (self::popOption('active', $tabOptions, false))
                $tabOptions = self::addClassName('active', $tabOptions);
            $tabContent = self::popOption('content', $tabOptions, '');
            $tabOptions = self::addClassName('tab-pane', $tabOptions);
            echo TbHtml::tag('div', $tabOptions, $tabContent);
        }
        echo '</div></div>';
        return ob_get_clean();
    }

    // Navbar
    // http://twitter.github.com/bootstrap/components.html#navbar
    // --------------------------------------------------

    /**
     * Generates a navbar.
     * @param string $content the navbar content.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated navbar.
     */
    public static function navbar($content, $htmlOptions = array())
    {
        $htmlOptions = self::addClassName('navbar', $htmlOptions);
        $display = self::popOption('display', $htmlOptions);
        if (isset($display) )
            $htmlOptions = self::addClassName('navbar-' . $display, $htmlOptions);
        $color = self::popOption('color', $htmlOptions);
        if (isset($color))
            $htmlOptions = self::addClassName('navbar-' . $color, $htmlOptions);
        $innerOptions = self::popOption('innerOptions', $htmlOptions, array());
        $innerOptions = self::addClassName('navbar-inner', $innerOptions);
        ob_start();
        echo self::openTag('div', $htmlOptions);
        echo self::tag('div', $innerOptions, $content);
        echo '</div>';
        return ob_get_clean();
    }

    /**
     * Generates a brand link for the navbar.
     * @param string $label the link label text.
     * @param string $url the link url.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated link.
     */
    public static function navbarBrandLink($label, $url, $htmlOptions = array())
    {
        $htmlOptions = self::addClassName('brand', $htmlOptions);
        return self::link($label, $url, $htmlOptions);
    }

    /**
     * Generates a text for the navbar.
     * @param string $text the text.
     * @param array $htmlOptions additional HTML attributes.
     * @param string $tag the HTML tag.
     * @return string the generated text block.
     */
    public static function navbarText($text, $htmlOptions = array(), $tag = 'p')
    {
        $htmlOptions = self::addClassName('navbar-text', $htmlOptions);
        return self::tag($tag, $htmlOptions, $text);
    }

    /**
     * Generates a menu divider for the navbar.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated divider.
     */
    public static function navbarMenuDivider($htmlOptions = array())
    {
        $htmlOptions = self::addClassName('divider-vertical', $htmlOptions);
        return self::tag('li', $htmlOptions);
    }

    // Breadcrumbs
    // http://twitter.github.com/bootstrap/components.html#breadcrumbs
    // --------------------------------------------------

    /**
     * Generates a breadcrumb menu.
     * @param array $links the breadcrumb links.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated breadcrumb.
     */
    public static function breadcrumbs($links, $htmlOptions = array())
    {
        $divider = self::popOption('divider', $htmlOptions, '/');
        $htmlOptions = self::addClassName('breadcrumb', $htmlOptions);
        ob_start();
        echo self::openTag('ul', $htmlOptions);
        foreach ($links as $label => $url)
        {
            if (is_string($label))
            {
                echo self::openTag('li');
                echo self::link($label, $url);
                echo self::tag('span', array('class' => 'divider'), $divider);
                echo '</li>';
            }
            else
                echo self::tag('li', array('class' => 'active'), $url);
        }
        echo '</ul>';
        return ob_get_clean();
    }

    // Pagination
    // http://twitter.github.com/bootstrap/components.html#pagination
    // --------------------------------------------------

    /**
     * Generates a pagination.
     * @param array $links the pagination buttons.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated pagination.
     */
    public static function pagination($links, $htmlOptions = array())
    {
        if (is_array($links) && !empty($links))
        {
            $htmlOptions = self::addClassName('pagination', $htmlOptions);
            $size = self::popOption('size', $htmlOptions);
            if (isset($size))
                $htmlOptions = self::addClassName('pagination-' . $size, $htmlOptions);
            $align = self::popOption('align', $htmlOptions);
            if (isset($align))
                $htmlOptions = self::addClassName('pagination-' . $align, $htmlOptions);
            $listOptions = self::popOption('listOptions', $htmlOptions, array());
            ob_start();
            echo self::openTag('div', $htmlOptions);
            echo self::openTag('ul', $listOptions);
            foreach ($links as $itemOptions)
            {
                $options = self::popOption('htmlOptions', $itemOptions, array());
                if (!empty($options))
                    $itemOptions = self::mergeOptions($options, $itemOptions);
                $label = self::popOption('label', $itemOptions, '');
                $url = self::popOption('url', $itemOptions, false);
                echo self::paginationLink($label, $url, $itemOptions);
            }
            echo '</ul>' . '</div>';
            return ob_get_clean();
        }
        return '';
    }

    /**
     * Generates a pagination link.
     * @param string $label the link label text.
     * @param mixed $url the link url.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated link.
     */
    public static function paginationLink($label, $url, $htmlOptions = array())
    {
        $active = self::popOption('active', $htmlOptions);
        $disabled = self::popOption('disabled', $htmlOptions);
        if ($active)
            $htmlOptions = self::addClassName('active', $htmlOptions);
        else if ($disabled)
            $htmlOptions = self::addClassName('disabled', $htmlOptions);
        $linkOptions = self::popOption('linkOptions', $itemOptions, array());
        ob_start();
        echo self::openTag('li', $htmlOptions);
        echo self::link($label, $url, $linkOptions);
        echo '</li>';
        return ob_get_clean();
    }

    /**
     * Generates a pager.
     * @param array $links the pager buttons.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated pager.
     */
    public static function pager($links, $htmlOptions = array())
    {
        if (is_array($links) && !empty($links))
        {
            $htmlOptions = self::addClassName('pager', $htmlOptions);
            ob_start();
            echo self::openTag('ul', $htmlOptions);
            foreach ($links as $itemOptions)
            {
                $options = self::popOption('htmlOptions', $itemOptions, array());
                if (!empty($options))
                    $itemOptions = self::mergeOptions($options, $itemOptions);
                $label = self::popOption('label', $itemOptions, '');
                $url = self::popOption('url', $itemOptions, false);
                echo self::pagerLink($label, $url, $itemOptions);
            }
            echo '</ul>';
            return ob_get_clean();
        }
        return '';
    }

    /**
     * Generates a pager link.
     * @param string $label the link label text.
     * @param mixed $url the link url.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated link.
     */
    public static function pagerLink($label, $url, $htmlOptions = array())
    {
        $previous = self::popOption('previous', $htmlOptions);
        $next = self::popOption('next', $htmlOptions);
        if ($previous)
            $htmlOptions = self::addClassName('previous', $htmlOptions);
        else if ($next)
            $htmlOptions = self::addClassName('next', $htmlOptions);
        if (self::popOption('disabled', $htmlOptions, false))
            $htmlOptions = self::addClassName('disabled', $htmlOptions);
        $linkOptions = self::popOption('linkOptions', $itemOptions, array());
        ob_start();
        echo self::openTag('li', $htmlOptions);
        echo self::link($label, $url, $linkOptions);
        echo '</li>';
        return ob_get_clean();
    }

    // Labels and badges
    // http://twitter.github.com/bootstrap/components.html#labels-badges
    // --------------------------------------------------

    /**
     * Generates a label span.
     * @param string $label the label text.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated span.
     */
    public static function labelTb($label, $htmlOptions = array())
    {
        return self::labelBadge('label', $label, $htmlOptions);
    }

    /**
     * Generates a badge span.
     * @param string $label the badge text.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated span.
     *
     */
    public static function badge($label, $htmlOptions = array())
    {
        return self::labelBadge('badge', $label, $htmlOptions);
    }

    /**
     * Generates a label or badge span.
     * @param string $type the span type.
     * @param string $label the label text.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated span.
     */
    public static function labelBadge($type, $label, $htmlOptions = array())
    {
        $htmlOptions = self::addClassName($type, $htmlOptions);
        $color = self::popOption('color', $htmlOptions);
        if (isset($color))
            $htmlOptions = self::addClassName($type . '-' . $color, $htmlOptions);
        return self::tag('span', $htmlOptions, $label);
    }

    // Typography
    // http://twitter.github.com/bootstrap/components.html#typography
    // --------------------------------------------------

    /**
     * Generates a hero unit.
     * @param string $heading the heading text.
     * @param string $content the content text.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated hero unit.
     */
    public static function heroUnit($heading, $content, $htmlOptions = array())
    {
        $htmlOptions = self::addClassName('hero-unit', $htmlOptions);
        $headingOptions = self::popOption('headingOptions', $htmlOptions, array());
        ob_start();
        echo self::tag('div', $htmlOptions);
        echo self::tag('h1', $headingOptions, $heading);
        echo $content;
        echo '</div>';
        return ob_get_clean();
    }

    /**
     * Generates a pager header.
     * @param string $heading the heading text.
     * @param string $subtext the subtext.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated pager header.
     */
    public static function pageHeader($heading, $subtext, $htmlOptions = array())
    {
        // todo: we may have to set an empty array() as default value
        $htmlOptions = self::addClassName('page-header', $htmlOptions);
        $headerOptions = self::popOption('headerOptions', $htmlOptions, array());
        $subtextOptions = self::popOption('subtextOptions', $htmlOptions, array());
        ob_start();
        echo self::openTag('div', $htmlOptions);
        echo self::openTag('h1', $headerOptions);
        echo CHtml::encode($heading) . ' ' . self::tag('small', $subtextOptions, $subtext);
        echo '</h1>';
        echo '</div>';
        return ob_get_clean();
    }

    // Thumbnails
    // http://twitter.github.com/bootstrap/components.html#thumbnails
    // --------------------------------------------------

    /**
     * Generates a list of thumbnails.
     * @param array $thumbnails the list configuration.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated thumbnails.
     */
    public static function thumbnails($thumbnails, $htmlOptions = array())
    {
        if (is_array($thumbnails) && !empty($thumbnails))
        {
            /* todo: we may have to set an empty array() as default value */
            $htmlOptions = self::addClassName('thumbnails', $htmlOptions);
            $defaultSpan = self::popOption('span', $htmlOptions, 3);
            ob_start();
            echo self::openTag('ul', $htmlOptions);
            foreach ($thumbnails as $thumbnailOptions)
            {
                $options = self::popOption('htmlOptions', $thumbnailOptions, array());
                if (!empty($options))
                    $thumbnailOptions = self::mergeOptions($options, $thumbnailOptions);
                $span = self::popOption('span', $thumbnailOptions, $defaultSpan);
                $caption = self::popOption('caption', $thumbnailOptions, '');
                $captionOptions = self::popOption('captionOptions', $thumbnailOptions, array());
                $captionOptions = self::addClassName('caption', $captionOptions);
                if (isset($thumbnailOptions['label']))
                {
                    $label = self::popOption('label', $thumbnailOptions);
                    $labelOptions = self::popOption('labelOptions', $thumbnailOptions, array());
                    $caption = self::tag('h3', $labelOptions, $label) . $caption;
                }
                $content = !empty($caption) ? self::tag('div', $captionOptions, $caption) : '';
                if (isset($thumbnailOptions['image']))
                {
                    $image = self::popOption('image', $thumbnailOptions);
                    $imageOptions = self::popOption('imageOptions', $thumbnailOptions, array());
                    $alt = self::popOption('alt', $imageOptions, '');
                    $content = CHtml::image($image, $alt, $imageOptions) . $content;
                }
                $url = self::popOption('url', $thumbnailOptions, false);
                echo $url !== false
                    ? self::thumbnailLink($span, $content, $url, $thumbnailOptions)
                    : self::thumbnail($span, $content, $thumbnailOptions);
            }
            echo '</ul>';
            return ob_get_clean();
        }
        return '';
    }

    /**
     * Generates a thumbnail.
     * @param integer $span the number of grid columns that the thumbnail spans over.
     * @param string $content the thumbnail content.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated thumbnail.
     */
    public static function thumbnail($span, $content, $htmlOptions = array())
    {
        $itemOptions = self::popOption('itemOptions', $htmlOptions, array());
        $itemOptions = self::addClassName('span' . $span, $itemOptions);
        $htmlOptions = self::addClassName('thumbnail', $htmlOptions);
        ob_start();
        echo self::openTag('li', $itemOptions);
        echo self::openTag('div', $htmlOptions);
        echo $content;
        echo '</div>';
        echo '</li>';
        return ob_get_clean();
    }

    /**
     * Generates a link thumbnail.
     * @param integer $span the number of grid columns that the thumbnail spans over.
     * @param string $content the thumbnail content.
     * @param mixed $url the url that the thumbnail links to.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated thumbnail.
     */
    public static function thumbnailLink($span, $content, $url, $htmlOptions = array())
    {
        $itemOptions = self::popOption('itemOptions', $htmlOptions, array());
        $itemOptions = self::addClassName('span' . $span, $itemOptions);
        $htmlOptions = self::addClassName('thumbnail', $htmlOptions);
        ob_start();
        echo self::openTag('li', $itemOptions);
        echo self::link($content, $url, $htmlOptions);
        echo '</li>';
        return ob_get_clean();
    }

    // Alerts
    // http://twitter.github.com/bootstrap/components.html#alerts
    // --------------------------------------------------

    /**
     * Generates an alert.
     * @param string $color the style of the alert.
     * @param string $message the message to display.
     * @param array $htmlOptions additional HTML options.
     * @param string the generated alert.
     */
    public static function alert($color, $message, $htmlOptions = array())
    {
        $htmlOptions = self::addClassName('alert', $htmlOptions);
        if (isset($color))
            $htmlOptions = self::addClassName('alert-' . $color, $htmlOptions);
        if (self::popOption('in', $htmlOptions, true))
            $htmlOptions = self::addClassName('in', $htmlOptions);
        if (self::popOption('block', $htmlOptions, false))
            $htmlOptions = self::addClassName('alert-block', $htmlOptions);
        if (self::popOption('fade', $htmlOptions, true))
            $htmlOptions = self::addClassName('fade', $htmlOptions);
        $closeText = self::popOption('closeText', $htmlOptions, self::CLOSE_TEXT);
        $closeOptions = self::popOption('closeOptions', $htmlOptions, array());
        ob_start();
        echo self::openTag('div', $htmlOptions);
        echo $closeText !== false ? self::closeLink($closeText, $closeOptions) : '';
        echo $message;
        echo '</div>';
        return ob_get_clean();
    }

    /**
     * Generates an alert block.
     * @param string $style the style of the alert.
     * @param string $message the message to display.
     * @param array $htmlOptions additional HTML options.
     * @return string the generated alert.
     */
    public static function blockAlert($style, $message, $htmlOptions = array())
    {
        $htmlOptions['block'] = true;
        return self::alert($style, $message, $htmlOptions);
    }

    // Progress bars
    // http://twitter.github.com/bootstrap/components.html#progress
    // --------------------------------------------------

    /**
     * Generates a progress bar.
     * @param integer $width the progress in percent.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated progress bar.
     */
    public static function progressBar($width = 0, $htmlOptions = array())
    {
        $htmlOptions = self::addClassName('progress', $htmlOptions);
        $color = self::popOption('color', $htmlOptions);
        if (isset($color))
            $htmlOptions = self::addClassName('progress-' . $color, $htmlOptions);
        if (self::popOption('striped', $htmlOptions, false))
        {
            $htmlOptions = self::addClassName('progress-striped', $htmlOptions);
            if (self::popOption('animated', $htmlOptions, false))
                $htmlOptions = self::addClassName('active', $htmlOptions);
        }
        $barOptions = self::popOption('barOptions', $htmlOptions, array());
        $content = self::popOption('content', $htmlOptions, '');
        $barOptions = self::defaultOption('content', $content, $barOptions);
        ob_start();
        echo self::openTag('div', $htmlOptions);
        echo self::bar($width, $barOptions);
        echo '</div>';
        return ob_get_clean();
    }

    /**
     * Generates a striped progress bar.
     * @param integer $width the progress in percent.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated progress bar.
     */
    public static function stripedProgressBar($width = 0, $htmlOptions = array())
    {
        $htmlOptions['striped'] = true;
        return self::progressBar($width, $htmlOptions);
    }

    /**
     * Generates an animated progress bar.
     * @param integer $width the progress in percent.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated progress bar.
     */
    public static function animatedProgressBar($width = 0, $htmlOptions = array())
    {
        $htmlOptions['animated'] = true;
        return self::stripedProgressBar($width, $htmlOptions);
    }

    /**
     * Generates a stacked progress bar.
     * @param array $bars the bar configurations.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated progress bar.
     */
    public static function stackedProgressBar($bars, $htmlOptions = array())
    {
        if (is_array($bars) && !empty($bars))
        {
            $htmlOptions = self::addClassName('progress', $htmlOptions);
            ob_start();
            echo self::openTag('div', $htmlOptions);
            foreach ($bars as $barOptions)
            {
                $options = self::popOption('htmlOptions', $barOptions, array());
                if (!empty($options))
                    $barOptions = self::mergeOptions($options, $barOptions);
                $width = self::popOption('width', $barOptions, 0);
                echo self::bar($width, $barOptions);
            }
            echo '</div>';
            return ob_get_clean();
        }
        return '';
    }

    /**
     * Generates a progress bar.
     * @param integer $width the progress in percent.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated bar.
     */
    public static function bar($width = 0, $htmlOptions = array())
    {
        $htmlOptions = self::addClassName('bar', $htmlOptions);
        $color = self::popOption('color', $htmlOptions);
        if (isset($color))
            $htmlOptions = self::addClassName('bar-' . $color, $htmlOptions);
        if ($width < 0)
            $width = 0;
        if ($width > 100)
            $width = 100;
        $htmlOptions = self::addStyles("width: {$width}%;", $htmlOptions);
        $content = self::popOption('content', $htmlOptions, '');
        return self::tag('div', $htmlOptions, $content);
    }

    // Media objects
    // http://twitter.github.com/bootstrap/components.html#media
    // --------------------------------------------------

    /**
     * Generates a list of media objects.
     * @param array $mediaObjects media object configurations.
     * @return string generated list.
     */
    public static function mediaObjects($mediaObjects)
    {
        if ($mediaObjects !== null && is_array($mediaObjects))
        {
            ob_start();
            foreach ($mediaObjects as $mediaObjectOptions)
            {
                $image = self::getOption('image', $mediaObjectOptions);
                $heading = self::getOption('heading', $mediaObjectOptions, '');
                $content = self::getOption('content', $mediaObjectOptions, '');
                $itemOptions = self::getOption('htmlOptions', $mediaObjectOptions, array());
                $itemOptions['items'] = self::popOption('items', $mediaObjectOptions, array());
                echo self::mediaObject($image, $heading, $content, $itemOptions);
            }
            return ob_get_clean();
        }
        return '';
    }

    /**
     * Generates a single media object.
     * @param string $image the image url.
     * @param string $title the title text.
     * @param string $content the content text.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the media object.
     */
    public static function mediaObject($image, $heading, $content, $htmlOptions = array())
    {
        $htmlOptions = self::addClassName('media', $htmlOptions);
        $linkOptions = self::popOption('linkOptions', $htmlOptions, array());
        $linkOptions = self::defaultOption('pull', self::PULL_LEFT, $linkOptions);
        $imageOptions = self::popOption('imageOptions', $htmlOptions, array());
        $imageOptions = self::addClassName('media-object', $imageOptions);
        $contentOptions = self::popOption('contentOptions', $htmlOptions, array());
        $contentOptions = self::addClassName('media-body', $contentOptions);
        $headingOptions = self::popOption('headingOptions', $htmlOptions, array());
        $headingOptions = self::addClassName('media-heading', $headingOptions);
        $items = self::popOption('items', $htmlOptions);

        ob_start();
        echo self::openTag('div', $htmlOptions);
        $alt = self::popOption('alt', $imageOptions, '');
        $href = self::popOption('href', $linkOptions, '#');
        if (!empty($image))
            echo self::link(CHtml::image($image, $alt, $imageOptions), $href, $linkOptions);
        echo self::openTag('div', $contentOptions);
        echo self::tag('h4', $headingOptions, $heading);
        echo $content;
        if (!empty($items))
            echo self::mediaObjects($items);
        echo '</div></div>';
        return ob_get_clean();
    }

    // Misc
    // http://twitter.github.com/bootstrap/components.html#misc
    // --------------------------------------------------

    /**
     * Generates a well element.
     * @param string $content the well content.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated well.
     */
    public static function well($content, $htmlOptions = array())
    {
        $htmlOptions = self::addClassName('well', $htmlOptions);
        $size = self::popOption('size', $htmlOptions);
        if (isset($size))
            $htmlOptions = self::addClassName('well-' . $size, $htmlOptions);
        ob_start();
        echo self::tag('div', $htmlOptions, $content);
        return ob_get_clean();
    }

    /**
     * Generates a close link.
     * @param string $label the link label text.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated link.
     */
    public static function closeLink($label = self::CLOSE_TEXT, $htmlOptions = array())
    {
        $htmlOptions = self::defaultOption('href', '#', $htmlOptions);
        return self::closeIcon('a', $label, $htmlOptions);
    }

    /**
     * Generates a close button.
     * @param string $label the button label text.
     * @param array $htmlOptions the HTML options for the button.
     * @return string the generated button.
     */
    public static function closeButton($label = self::CLOSE_TEXT, $htmlOptions = array())
    {
        return self::closeIcon('button', $label, $htmlOptions);
    }

    /**
     * Generates a close element.
     * @param string $label the element label text.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated element.
     */
    public static function closeIcon($tag, $label, $htmlOptions = array())
    {
        $htmlOptions = self::addClassName('close', $htmlOptions);
        $htmlOptions = self::defaultOption('data-dismiss', 'alert', $htmlOptions);
        return self::tag($tag, $htmlOptions, $label);
    }

    /**
     * Generates a collapse link.
     * @param string $label the link label.
     * @param string $target the CSS selector.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated link.
     */
    public static function collapseLink($label, $target, $htmlOptions = array())
    {
        $htmlOptions['data-toggle'] = 'collapse';
        return self::link($label, $target, $htmlOptions);
    }

    /**
     * Generates a collapse icon.
     * @param string $target the CSS selector for the target element.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated icon.
     */
    public static function collapseIcon($target, $htmlOptions = array())
    {
        $htmlOptions = self::addClassName('btn btn-navbar', $htmlOptions);
        $htmlOptions = self::defaultOptions($htmlOptions, array(
                'data-toggle' => 'collapse',
                'data-target' => $target,
            ));
        ob_start();
        echo self::openTag('a', $htmlOptions);
        echo '<span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>';
        echo '</a>';
        return ob_get_clean();
    }

    //
    // JAVASCRIPT
    // --------------------------------------------------

    // Tooltips and Popovers
    // http://twitter.github.com/bootstrap/javascript.html#tooltips
    // http://twitter.github.com/bootstrap/javascript.html#popovers
    // --------------------------------------------------

    /**
     * Generates a tooltip.
     * @param string $label the tooltip link label text.
     * @param mixed $url the link url.
     * @param string $content the tooltip content text.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated tooltip.
     */
    public static function tooltip($label, $url, $content, $htmlOptions = array())
    {
        $htmlOptions['rel'] = 'tooltip';
        return self::tooltipPopover($label, $url, $content, $htmlOptions);
    }

    /**
     * Generates a popover.
     * @param string $label the popover link label text.
     * @param string $title the popover title text.
     * @param string $content the popover content text.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated popover.
     */
    public static function popover($label, $title, $content, $htmlOptions = array())
    {
        $htmlOptions['rel'] = 'popover';
        $htmlOptions['data-content'] = $content;
        $htmlOptions['data-toggle'] = 'popover';
        return self::tooltipPopover($label, '#', $title, $htmlOptions);
    }

    /**
     * Generates a base tooltip.
     * @param string $label the tooltip link label text.
     * @param mixed $url the link url.
     * @param string $title the tooltip title text.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated tooltip.
     */
    protected static function tooltipPopover($label, $url, $title, $htmlOptions)
    {
        $htmlOptions = self::defaultOption('title', $title, $htmlOptions);
        if (self::popOption('animation', $htmlOptions))
            $htmlOptions = self::defaultOption('data-animation', true, $htmlOptions);
        if (self::popOption('html', $htmlOptions))
            $htmlOptions = self::defaultOption('data-html', true, $htmlOptions);
        $placement = self::popOption('placement', $htmlOptions);
        if (isset($placement))
            $htmlOptions = self::defaultOption('data-placement', $placement, $htmlOptions);
        if (self::popOption('selector', $htmlOptions))
            $htmlOptions = self::defaultOption('data-selector', true, $htmlOptions);
        $trigger = self::popOption('trigger', $htmlOptions);
        if (isset($trigger))
            $htmlOptions = self::defaultOption('data-trigger', $trigger, $htmlOptions);
        if (($delay = self::popOption('delay', $htmlOptions)) !== null)
            $htmlOptions = self::defaultOption('data-delay', $delay, $htmlOptions);
        return self::link($label, $url, $htmlOptions);
    }

    // Carousel
    // http://twitter.github.com/bootstrap/javascript.html#carousel
    // --------------------------------------------------

    /**
     * Generates an image carousel.
     * @param array $items the item configurations.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated carousel.
     */
    public static function carousel($items, $htmlOptions = array())
    {
        if (is_array($items) && !empty($items))
        {
            $id = self::getOption('id', $htmlOptions, CHtml::ID_PREFIX . CHtml::$count++);
            $htmlOptions = self::defaultOption('id', $id, $htmlOptions);
            $selector = '#' . $id;
            $htmlOptions = self::addClassName('carousel', $htmlOptions);
            if (self::popOption('slide', $htmlOptions, true))
                $htmlOptions = self::addClassName('slide', $htmlOptions);
            $interval = self::popOption('data-interval', $htmlOptions);
            if ($interval)
                $htmlOptions = self::defaultOption('data-interval', $interval, $htmlOptions);
            $pause = self::popOption('data-interval', $htmlOptions);
            if ($pause) // todo: add attribute validation if seen necessary.
                $htmlOptions = self::defaultOption('data-pause', $pause, $htmlOptions);
            $indicatorOptions = self::popOption('indicatorOptions', $htmlOptions, array());
            $innerOptions = self::popOption('innerOptions', $htmlOptions, array());
            $innerOptions = self::addClassName('carousel-inner', $innerOptions);
            $prevOptions = self::popOption('prevOptions', $htmlOptions, array());
            $prevLabel = self::popOption('label', $prevOptions, '&lsaquo;');
            $nextOptions = self::popOption('nextOptions', $htmlOptions, array());
            $nextLabel = self::popOption('label', $nextOptions, '&rsaquo;');
            ob_start();
            echo self::openTag('div', $htmlOptions);
            echo self::carouselIndicators($selector, count($items), $indicatorOptions);
            echo self::openTag('div', $innerOptions);
            foreach ($items as $i => $itemOptions)
            {
                $itemOptions = self::addClassName('item', $itemOptions);
                if ($i === 0) // first item should be active
                    $itemOptions = self::addClassName('active', $itemOptions);
                $image = self::popOption('image', $itemOptions, '');
                $label = self::popOption('label', $itemOptions);
                $caption = self::popOption('caption', $itemOptions);
                echo self::carouselItem($image, $label, $caption, $itemOptions);
            }
            echo '</div>';
            echo self::carouselPrevLink($prevLabel, $selector, $prevOptions);
            echo self::carouselNextLink($nextLabel, $selector, $nextOptions);
            echo '</div>';
            return ob_get_clean();
        }
        return '';
    }

    /**
     * Generates a carousel item.
     * @param string $image the image url.
     * @param string $label the item label text.
     * @param string $caption the item caption text.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated item.
     */
    public static function carouselItem($image, $label, $caption, $htmlOptions = array())
    {
        $alt = self::popOption('alt', $htmlOptions, '');
        $imageOptions = self::popOption('imageOptions', $htmlOptions, array());
        $overlayOptions = self::popOption('overlayOptions', $htmlOptions, array());
        $overlayOptions = self::addClassName('carousel-caption', $overlayOptions);
        $labelOptions = self::popOption('labelOptions', $htmlOptions, array());
        $captionOptions = self::popOption('captionOptions', $htmlOptions, array());
        ob_start();
        echo self::openTag('div', $htmlOptions);
        echo CHtml::image($image, $alt, $imageOptions);
        if (isset($label) || isset($caption))
        {
            echo self::openTag('div', $overlayOptions);
            if ($label)
                echo self::tag('h4', $labelOptions, $label);
            if ($caption)
                echo self::tag('p', $captionOptions, $caption);
            echo '</div>';
        }
        echo '</div>';
        return ob_get_clean();
    }

    /**
     * Generates a previous link for the carousel.
     * @param string $label the link label text.
     * @param mixed $url the link url.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated link.
     */
    public static function carouselPrevLink($label, $url, $htmlOptions = array())
    {
        $htmlOptions['data-slide'] = 'prev';
        $htmlOptions = self::addClassName('carousel-control left', $htmlOptions);
        return self::link($label, $url, $htmlOptions);
    }

    /**
     * Generates a next link for the carousel.
     * @param string $label the link label text.
     * @param mixed $url the link url.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated link.
     */
    public static function carouselNextLink($label, $url, $htmlOptions = array())
    {
        $htmlOptions['data-slide'] = 'next';
        $htmlOptions = self::addClassName('carousel-control right', $htmlOptions);
        return self::link($label, $url, $htmlOptions);
    }

    /**
     * Generates an indicator for the carousel.
     * @param string $target the CSS selector for the target element.
     * @param integer $numSlides the number of slides.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated indicators.
     */
    public static function carouselIndicators($target, $numSlides, $htmlOptions = array())
    {
        $htmlOptions = self::addClassName('carousel-indicators', $htmlOptions);
        ob_start();
        echo self::openTag('ol', $htmlOptions);
        for ($i = 0; $i < $numSlides; $i++)
        {
            $itemOptions = array('data-target' => $target, 'data-slide-to' => $i);
            if ($i === 0)
                $itemOptions['class'] = 'active';
            echo self::tag('li', $itemOptions);
        }
        echo '</ol>';
        return ob_get_clean();
    }

    // UTILITIES
    // --------------------------------------------------

    /**
     * Appends new class names to the named index "class" at the `$htmlOptions` parameter.
     * @param mixed $className the class(es) to append to `$htmlOptions`
     * @param array $htmlOptions the HTML tag attributes to modify
     * @return array the options.
     */
    public static function addClassName($className, $htmlOptions)
    {
        if (is_array($className))
            $className = implode(' ', $className);
        $htmlOptions['class'] = isset($htmlOptions['class']) ? $htmlOptions['class'] . ' ' . $className : $className;
        return $htmlOptions;
    }

    /**
     * Appends a CSS style string to the given options.
     * @param string $styles the CSS style string.
     * @param array $htmlOptions the options.
     * @return array the options.
     */
    public static function addStyles($styles, $htmlOptions)
    {
        $htmlOptions['style'] = isset($htmlOptions['style']) ? $htmlOptions['style'] . ' ' . $styles : $styles;
        return $htmlOptions;
    }

    /**
     * Copies the option values from one option array to another.
     * @param array $names the option names to copy.
     * @param array $fromOptions the options to copy from.
     * @param array $options the options to copy to.
     * @return array the options.
     */
    public static function copyOptions($names, $fromOptions, $options)
    {
        if (is_array($fromOptions) && is_array($options))
        {
            foreach ($names as $key)
            {
                if (isset($fromOptions[$key]) && !isset($options[$key]))
                    $options[$key] = self::getOption($key, $fromOptions);
            }
        }
        return $options;
    }

    /**
     * Moves the option values from one option array to another.
     * @param array $names the option names to move.
     * @param array $fromOptions the options to move from.
     * @param array $options the options to move to.
     * @return array the options.
     */
    public static function moveOptions($names, $fromOptions, $options)
    {
        if (is_array($fromOptions) && is_array($options))
        {
            foreach ($names as $key)
            {
                if (isset($fromOptions[$key]) && !isset($options[$key]))
                    $options[$key] = self::popOption($key, $fromOptions);
            }
        }
        return $options;
    }

    /**
     * Sets multiple default options for the given options array.
     * @param array $options the options to set defaults for.
     * @param array $defaults the default options.
     * @return array the options with default values.
     */
    public static function defaultOptions($options, $defaults)
    {
        if (is_array($defaults) && is_array($options))
        {
            foreach ($defaults as $name => $value)
                $options = self::defaultOption($name, $value, $options);
        }
        return $options;
    }

    /**
     * Merges two options arrays.
     * @param array $a options to be merged to
     * @param array $b options to be merged from
     * @return array the merged options.
     */
    public static function mergeOptions($a, $b)
    {
        return CMap::mergeArray($a, $b); // yeah I know but we might want to change this to be something else later
    }

    /**
     * Returns an item from the given options or the default value if it's not set.
     * @param string $name the name of the item.
     * @param array $options the options to get from.
     * @param mixed $defaultValue the default value.
     * @return mixed the value.
     */
    public static function getOption($name, $options, $defaultValue = null)
    {
        return (is_array($options) && isset($options[$name])) ? $options[$name] : $defaultValue;
    }

    /**
     * Removes an item from the given options and returns the value.
     * @param string $name the name of the item.
     * @param array $options the options to remove the item from.
     * @param mixed $defaultValue the default value.
     * @return mixed the value.
     */
    public static function popOption($name, &$options, $defaultValue = null)
    {
        if (is_array($options))
        {
            $value = self::getOption($name, $options, $defaultValue);
            unset($options[$name]);
            return $value;
        }
        else
            return $defaultValue;
    }

    /**
     * Sets the default value for an item in the given options.
     * @param string $name the name of the item.
     * @param mixed $value the default value.
     * @param array $options the options.
     * @return mixed
     */
    public static function defaultOption($name, $value, $options)
    {
        if (is_array($options) && !isset($options[$name]))
            $options[$name] = $value;
        return $options;
    }

    /**
     * Removes the option values from the given options.
     * @param array $options the options to remove from.
     * @param array $names names to remove from the options.
     * @return array the options.
     */
    public static function removeOptions($options, $names)
    {
        return array_diff_key($options, array_flip($names));
    }

    /**
     * Adds the grid span class to the given options is applicable.
     * @param array $htmlOptions the HTML attributes.
     * @return boolean whether the span class was added.
     */
    protected static function addSpanClass(&$htmlOptions)
    {
        $span = self::popOption('span', $htmlOptions);
        if (isset($span))
        {
            $htmlOptions = self::addClassName('span' . $span, $htmlOptions);
            return true;
        }
        else
            return false;
    }
}
