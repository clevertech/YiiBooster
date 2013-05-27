<?php
/**
 * Bootstrap class file.
 * @author Christoffer Niska <ChristofferNiska@gmail.com>
 * @copyright Copyright &copy; Christoffer Niska 2011-2012
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 * @version 1.0.0
 *
 * Modified for YiiBooster
 * @author Antonio Ramirez <antonio@clevertech.biz>
 * @version 1.0.7
 */

/**
 * Bootstrap application component.
 */
class Bootstrap extends CApplicationComponent
{
	// Bootstrap plugins.
	const PLUGIN_AFFIX = 'affix';
	const PLUGIN_ALERT = 'alert';
	const PLUGIN_BUTTON = 'button';
	const PLUGIN_CAROUSEL = 'carousel';
	const PLUGIN_COLLAPSE = 'collapse';
	const PLUGIN_DROPDOWN = 'dropdown';
	const PLUGIN_MODAL = 'modal';
	const PLUGIN_MODALMANAGER = 'modalmanager';
	const PLUGIN_POPOVER = 'popover';
	const PLUGIN_SCROLLSPY = 'scrollspy';
	const PLUGIN_TAB = 'tab';
	const PLUGIN_TOOLTIP = 'tooltip';
	const PLUGIN_TRANSITION = 'transition';
	const PLUGIN_TYPEAHEAD = 'typeahead';
	const PLUGIN_DATEPICKER = 'bdatepicker';
	const PLUGIN_REDACTOR = 'redactor';
	const PLUGIN_MARKDOWNEDITOR = 'markdowneditor';
	const PLUGIN_DATERANGEPICKER = 'daterangepicker';
	const PLUGIN_HTML5EDITOR = 'wysihtml5';
	const PLUGIN_COLORPICKER = 'colorpicker';

	/**
	 * @var boolean whether to register the Bootstrap core CSS (bootstrap.min.css).
	 * Defaults to true.
	 */
	public $coreCss = true;

	/**
	 * @var boolean whether to register the Bootstrap responsive CSS (bootstrap-responsive.min.css).
	 * Defaults to false.
	 */
	public $responsiveCss = false;

	/**
	 * @var boolean whether to register the Font Awesome CSS (font-awesome.min.css).
	 * Defaults to false.
	 */
	public $fontAwesomeCss = false;

	/**
	 * @var boolean whether to register the Yii-specific CSS missing from Bootstrap.
	 * @since 0.9.12
	 */
	public $yiiCss = true;

	/**
	 * @var boolean whether to register the JQuery-specific CSS missing from Bootstrap.
	 */
	public $jqueryCss = true;

	/**
	 * @var boolean whether to register jQuery and the Bootstrap JavaScript.
	 * @since 0.9.10
	 */
	public $enableJS = true;

	/**
	 * @var array plugin initial options (name=>options).
	 * Each array key-value pair represents the initial options for a single plugin class,
	 * with the array key being the plugin name, and array value being the initial options array.
	 * @since 0.9.8
	 */
	public $plugins = array();

	/**
	 * @var string default popover CSS selector.
	 * @since 0.10.0
	 */
	public $popoverSelector = 'body';

	/**
	 * @var string default tooltip CSS selector.
	 * @since 0.10.0
	 */
	public $tooltipSelector = 'body';

	/**
	 * @var bool whether to enable bootbox messages or not. Default value is true.
	 * @since YiiBooster 1.0.5
	 */
	public $enableBootboxJS = true;

	/**
	 * @var bool enable bootstrap notifier. Default value is `true`
	 * @see https://github.com/Nijikokun/bootstrap-notify
	 */
	public $enableNotifierJS = true;

	/**
	 * @var boolean|null enable use cdn servers for assets. If null then let YII_DEBUG decide it.
	 */
	public $enableCdn = false;

	/**
	 * @var boolean to register Bootstrap CSS files in AJAX requests
	 * Defaults to true.
	 */
	public $ajaxCssLoad = true;

	/**
	 * @var boolean to register the Bootstrap JavaScript files in AJAX requests
	 * Defaults to true.
	 */
	public $ajaxJsLoad = true;

	/**
	 * @var bool|null Whether to republish assets on each request. Defaults to YII_DEBUG, resulting in a the republication of all YiiBooster-assets
	 * on each request if the application is in debug mode. Passing null to this option restores
	 * the default handling of CAssetManager of YiiBooster assets.
	 * @since YiiBooster 1.0.6
	 */
	public $forceCopyAssets = false;

	/**
	 * @var array list of script packages (name=>package spec).
	 * This property keeps a list of named script packages, each of which can contain
	 * a set of CSS and/or JavaScript script files, and their dependent package names.
	 * By calling {@link registerPackage}, one can register a whole package of client
	 * scripts together with their dependent packages and render them in the HTML output.
	 * @since 1.0.7
	 */
	public $packages = array();

	/**
	 * @var string handles the assets folder path.
	 */
	protected $_assetsUrl;

	/**
	 * @var mixed Something which can register assets for later inclusion on page.
	 * For now it's just the `Yii::app()->clientScript`
	 */
	public $assetsRegistry;

	/**
	 * Initializes the component.
	 */
	public function init()
	{
		// Prevents the extension from registering scripts and publishing assets when ran from the command line.
		if ($this->isInConsoleMode() && !$this->isInTests())
			return;

		$this->setAssetsRegistryIfNotDefined();

		$this->setRootAliasIfUndefined();

		$this->includeAssets();

		parent::init();
	}

	/** @return bool */
	private function isInConsoleMode()
	{
		return Yii::app() instanceof CConsoleApplication || PHP_SAPI == 'cli';
	}

	/** @return bool */
	private function isInTests()
	{
		return defined('IS_IN_TESTS') && IS_IN_TESTS;
	}

	private function setRootAliasIfUndefined()
	{
		if (Yii::getPathOfAlias('bootstrap') === false) {
			Yii::setPathOfAlias('bootstrap', realpath(dirname(__FILE__) . '/..'));
		}
	}

	private function includeAssets()
	{
		$this->setEnableCdn();

		$this->appendUserSuppliedPackagesToOurs();

		$this->addOurPackagesToYii();

		$this->registerCssPackagesIfEnabled();

		$this->registerJsPackagesIfEnabled();
	}

	private function setEnableCdn()
	{
		if ($this->enableCdn === null) {
			// TODO: this is completely untestable as the YII_DEBUG constant gets defined by Yii initialization code
			// and so we cannot re-define it in our tests.
			$this->enableCdn = !YII_DEBUG;
		}
	}

	private function appendUserSuppliedPackagesToOurs()
	{
		$this->packages = CMap::mergeArray(
			require(Yii::getPathOfAlias('bootstrap.components') . '/packages.php'),
			$this->packages
		);
	}

	private function addOurPackagesToYii()
	{
		foreach ($this->packages as $name => $definition) {
			$this->assetsRegistry->addPackage($name, $definition);
		}
	}

	private function registerCssPackagesIfEnabled()
	{
		if (!$this->coreCss)
			return;

		if (!$this->ajaxCssLoad && Yii::app()->request->isAjaxRequest)
			return;

		$this->registerBootstrapCss();

		if ($this->yiiCss !== false)
			$this->registerYiiCss();

		if ($this->jqueryCss !== false)
			$this->registerJQueryCss();
	}



	/**
	 * Registers the Yii-specific CSS missing from Bootstrap.
	 * @since 0.9.11
	 */
	public function registerYiiCss()
	{
		$this->registerPackage('bootstrap-yii');
	}

	/**
	 * Registers the JQuery-specific CSS missing from Bootstrap.
	 */
	public function registerJQueryCss()
	{
		$this->registerPackage('jquery-css')->scriptMap['jquery-ui.css'] = $this->getAssetsUrl(
		) . '/css/jquery-ui-bootstrap.css';
	}


	private function registerJsPackagesIfEnabled()
	{
		if (!$this->enableJS)
			return;

		if (!$this->ajaxJsLoad && Yii::app()->request->isAjaxRequest)
			return;

		$this->registerPackage('bootstrap.js');

		if ($this->enableBootboxJS)
			$this->registerPackage('bootbox');

		if ($this->enableNotifierJS)
			$this->registerPackage('notify');

		$this->registerPopover();
		$this->registerTooltip();
	}

	/**
	 * Registers the Bootstrap popover plugin.
	 *
	 * @param string $selector the CSS selector. If it's null, then the value of `popoverSelector` will be used instead, which is 'body' by default.
	 * @param array $options the plugin options
	 *
	 * @see http://twitter.github.com/bootstrap/javascript.html#popover
	 * @since 0.9.8
	 */
	public function registerPopover($selector = 'body', $options = array())
	{
		if (!isset($options['selector'])) {
			$options['selector'] = '[rel=popover]';
		}

		$this->registerPlugin(self::PLUGIN_POPOVER, $selector, $options, $this->popoverSelector);
	}

	/**
	 * Registers the Bootstrap tooltip plugin.
	 *
	 * @param string $selector the CSS selector. If it's null, then the value of `tooltipSelector` will be used instead, which is 'body' by default.
	 * @param array $options the plugin options
	 *
	 * @see http://twitter.github.com/bootstrap/javascript.html#tooltip
	 * @since 0.9.8
	 */
	public function registerTooltip($selector = 'body', $options = array())
	{
		if (!isset($options['selector'])) {
			$options['selector'] = '[rel=tooltip]';
		}

		$this->registerPlugin(self::PLUGIN_TOOLTIP, $selector, $options, $this->tooltipSelector);
	}

	/**
	 * Registers a Bootstrap plugin using the given selector and options.
	 *
	 * @param string $name the name of the plugin
	 * @param string $selector the CSS selector
	 * @param array $options the JavaScript options for the plugin.
	 * @param string $defaultSelector the default CSS selector
	 *
	 * @since 0.9.8
	 */
	public function registerPlugin($name, $selector = null, $options = array(), $defaultSelector = null)
	{
		if (!isset($selector) && empty($options)) {
			// Initialization from extension configuration.
			$config = isset($this->plugins[$name]) ? $this->plugins[$name] : array();

			if (isset($config['selector'])) {
				$selector = $config['selector'];
			}

			if (isset($config['options'])) {
				$options = $config['options'];
			}

			if (!isset($selector)) {
				$selector = $defaultSelector;
			}
		}

		if (isset($selector)) {
			$options = empty($options) ? '' : CJavaScript::encode($options);
			$this->assetsRegistry->registerScript(
				$this->getUniqueScriptId(),
				"jQuery('{$selector}').{$name}({$options});"
			);
		}
	}

	/**
	 * Generates a "somewhat" random id string.
	 * @return string
	 * @since 1.1.0
	 */
	public function getUniqueScriptId()
	{
		return uniqid(__CLASS__ . '#', true);
	}

	/**
	 * Returns the extension version number.
	 * @return string the version
	 */
	public function getVersion()
	{
		return '1.0.7';
	}

	/**
	 * Registers a script package that is listed in {@link packages}.
	 *
	 * @param string $name the name of the script package.
	 *
	 * @return CClientScript the CClientScript object itself (to support method chaining, available since version 1.1.5).
	 * @see CClientScript::registerPackage
	 * @since 1.0.7
	 */
	public function registerPackage($name)
	{
		return $this->assetsRegistry->registerPackage($name);
	}

	/**
	 * Registers a CSS file in the asset's css folder
	 *
	 * @param string $name the css file name to register
	 * @param string $media media that the CSS file should be applied to. If empty, it means all media types.
	 *
	 * @see CClientScript::registerCssFile
	 */
	public function registerAssetCss($name, $media = '')
	{
		$this->assetsRegistry->registerCssFile($this->getAssetsUrl() . "/css/{$name}", $media);
	}

	/**
	 * Register a javascript file in the asset's js folder
	 *
	 * @param string $name the js file name to register
	 * @param int $position the position of the JavaScript code.
	 *
	 * @see CClientScript::registerScriptFile
	 */
	public function registerAssetJs($name, $position = CClientScript::POS_END)
	{
		$this->assetsRegistry->registerScriptFile($this->getAssetsUrl() . "/js/{$name}", $position);
	}

	/**
	 * Returns the URL to the published assets folder.
	 * @return string an absolute URL to the published asset
	 */
	public function getAssetsUrl()
	{
		if (isset($this->_assetsUrl)) {
			return $this->_assetsUrl;
		} else {
			return $this->_assetsUrl = Yii::app()->getAssetManager()->publish(
				Yii::getPathOfAlias('bootstrap.assets'),
				false,
				-1,
				$this->forceCopyAssets
			);
		}
	}

	private function setAssetsRegistryIfNotDefined()
	{
		if (!$this->assetsRegistry)
			$this->assetsRegistry = Yii::app()->getClientScript();
	}

	//----------------------------------------------------------------------------
	// Bootstrap package variants

	/**
	 * We use the values of $this->responsiveCss, $this->fontAwesomeCss,
	 * $this->minifyCss and $this->enableCdn to construct the proper package definition
	 * and install and register it.
	 */
	private function registerBootstrapCss()
	{
		if ($this->responsiveCss !== false) {
			$this->registerResponsiveNoIconsCss();
		} else {
			$this->registerCoreCss();
		}

		if ($this->fontAwesomeCss !== false) {
			$this->registerFontAwesomeCss();
		}
	}

	private function registerResponsiveNoIconsCss()
	{
		$this->registerPackage('full.css')->registerMetaTag('width=device-width, initial-scale=1.0', 'viewport');
	}

	/**
	 * Registers the Bootstrap CSS.
	 */
	public function registerCoreCss()
	{
		$this->registerPackage('bootstrap');
	}

	/**
	 * Registers the Font Awesome CSS.
	 * @since 1.0.6
	 */
	public function registerFontAwesomeCss()
	{
		if (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE 7.0')) {
			$this->registerPackage('font-awesome')->registerPackage('font-awesome-ie7');
		} else {
			$this->registerPackage('font-awesome');
		}
	}

	/**
	 * Registers the Bootstrap responsive CSS.
	 * @since 0.9.8
	 */
	public function registerResponsiveCss()
	{
		$this->registerPackage('responsive')->registerMetaTag('width=device-width, initial-scale=1.0', 'viewport');
	}

	// Bootstrap package variants end
	//----------------------------------------------------------------------------

	//========================================================================
	// Methods for registering plugins below

	/**
	 * Registers the Bootstrap alert plugin.
	 *
	 * @param string $selector the CSS selector
	 * @param array $options the plugin options
	 *
	 * @see http://twitter.github.com/bootstrap/javascript.html#alerts
	 * @since 0.9.8
	 */
	public function registerAlert($selector = null, $options = array())
	{
		$this->registerPlugin(self::PLUGIN_ALERT, $selector, $options);
	}

	/**
	 * Registers the Bootstrap buttons plugin.
	 *
	 * @param string $selector the CSS selector
	 * @param array $options the plugin options
	 *
	 * @see http://twitter.github.com/bootstrap/javascript.html#buttons
	 * @since 0.9.8
	 */
	public function registerButton($selector = null, $options = array())
	{
		$this->registerPlugin(self::PLUGIN_BUTTON, $selector, $options);
	}

	/**
	 * Registers the Bootstrap carousel plugin.
	 *
	 * @param string $selector the CSS selector
	 * @param array $options the plugin options
	 *
	 * @see http://twitter.github.com/bootstrap/javascript.html#carousel
	 * @since 0.9.8
	 */
	public function registerCarousel($selector = null, $options = array())
	{
		$this->registerPlugin(self::PLUGIN_CAROUSEL, $selector, $options);
	}

	/**
	 * Registers the Bootstrap collapse plugin.
	 *
	 * @param string $selector the CSS selector
	 * @param array $options the plugin options
	 *
	 * @see http://twitter.github.com/bootstrap/javascript.html#collapse
	 * @since 0.9.8
	 */
	public function registerCollapse($selector = null, $options = array())
	{
		$this->registerPlugin(self::PLUGIN_COLLAPSE, $selector, $options, '.collapse');
	}

	/**
	 * Registers the Bootstrap dropdowns plugin.
	 *
	 * @param string $selector the CSS selector
	 * @param array $options the plugin options
	 *
	 * @see http://twitter.github.com/bootstrap/javascript.html#dropdowns
	 * @since 0.9.8
	 */
	public function registerDropdown($selector = null, $options = array())
	{
		$this->registerPlugin(self::PLUGIN_DROPDOWN, $selector, $options, '.dropdown-toggle[data-dropdown="dropdown"]');
	}

	/**
	 * Registers the Bootstrap modal plugin.
	 *
	 * @param string $selector the CSS selector
	 * @param array $options the plugin options
	 *
	 * @see http://twitter.github.com/bootstrap/javascript.html#modal
	 * @since 0.9.8
	 */
	public function registerModal($selector = null, $options = array())
	{
		$this->registerPlugin(self::PLUGIN_MODAL, $selector, $options);
	}

	/**
	 * Registers the Modal manager plugin.
	 *
	 * @param string $selector the CSS selector
	 * @param array $options the plugin options
	 *
	 * @see https://github.com/jschr/bootstrap-modal/
	 * @since 0.9.8
	 */
	public function registerModalManager($selector = null, $options = array())
	{
		$this->registerPlugin(self::PLUGIN_MODALMANAGER, $selector, $options);
	}

	/**
	 * Registers the Bootstrap scrollspy plugin.
	 *
	 * @param string $selector the CSS selector
	 * @param array $options the plugin options
	 *
	 * @see http://twitter.github.com/bootstrap/javascript.html#scrollspy
	 * @since 0.9.8
	 */
	public function registerScrollSpy($selector = null, $options = array())
	{
		$this->registerPlugin(self::PLUGIN_SCROLLSPY, $selector, $options);
	}

	/**
	 * Registers the Bootstrap tabs plugin.
	 *
	 * @param string $selector the CSS selector
	 * @param array $options the plugin options
	 *
	 * @see http://twitter.github.com/bootstrap/javascript.html#tabs
	 * @since 0.9.8
	 */
	public function registerTabs($selector = null, $options = array())
	{
		$this->registerPlugin(self::PLUGIN_TAB, $selector, $options);
	}

	/**
	 * Registers the Bootstrap typeahead plugin.
	 *
	 * @param string $selector the CSS selector
	 * @param array $options the plugin options
	 *
	 * @see http://twitter.github.com/bootstrap/javascript.html#typeahead
	 * @since 0.9.8
	 */
	public function registerTypeahead($selector = null, $options = array())
	{
		$this->registerPlugin(self::PLUGIN_TYPEAHEAD, $selector, $options);
	}

	/**
	 * Register the Bootstrap datepicker plugin.
	 * IMPORTANT: if you register a selector via this method you wont be able to attach events to the plugin.
	 *
	 * @param string $selector the CSS selector
	 * @param array $options the plugin options
	 *
	 * @see http://www.eyecon.ro/bootstrap-datepicker/
	 *
	 */
	public function registerDatePicker($selector = null, $options = array())
	{
		$this->registerPlugin(self::PLUGIN_DATEPICKER, $selector, $options);
	}

	/**
	 * Registers the RedactorJS plugin.
	 *
	 * @param null $selector
	 * @param array $options
	 */
	public function registerRedactor($selector = null, $options = array())
	{
		$this->registerPlugin(self::PLUGIN_REDACTOR, $selector, $options);
	}

	/**
	 * Registers the Bootstrap-whysihtml5 plugin.
	 *
	 * @param null $selector
	 * @param array $options
	 */
	public function registerHtml5Editor($selector = null, $options = array())
	{
		$this->registerPlugin(self::PLUGIN_HTML5EDITOR, $selector, $options);
	}

	/**
	 * Registers the Bootstrap-colorpicker plugin.
	 *
	 * @param null $selector
	 * @param array $options
	 */
	public function registerColorPicker($selector = null, $options = array())
	{
		$this->registerPlugin(self::PLUGIN_COLORPICKER, $selector, $options);
	}

	/**
	 * Registers the affix plugin
	 *
	 * @param null $selector
	 * @param array $options
	 *
	 * @see  http://twitter.github.com/bootstrap/javascript.html#affix
	 */
	public function registerAffix($selector = null, $options = array())
	{
		$this->registerPlugin(self::PLUGIN_AFFIX, $selector, $options);
	}

	/**
	 * Registers the Bootstrap daterange plugin
	 *
	 * @param string $selector the CSS selector
	 * @param array $options the plugin options
	 * @param string $callback the javascript callback function
	 *
	 * @see  http://www.dangrossman.info/2012/08/20/a-date-range-picker-for-twitter-bootstrap/
	 * @since 1.1.0
	 */
	public function registerDateRangePlugin($selector, $options = array(), $callback = null)
	{
		$this->assetsRegistry->registerScript(
			$this->getUniqueScriptId(),
			'$("' . $selector . '").daterangepicker(' . CJavaScript::encode($options) . ($callback
				? ', ' . CJavaScript::encode($callback) : '') . ');'
		);
	}

	// Modules end
	//============================================================================



// ================================================================== DEPRECATED STUFF BELOW

	/**
	 * Registers all assets.
	 * @since 1.0.7
	 * @deprecated 2.0.0 Unused and not recommended to use as it does not respect the `enableCss` and `enableJs` directives
	 */
	public function register()
	{
		$this->registerAllCss();
		$this->registerAllScripts();
	}

	/**
	 * Registers all Bootstrap CSS files.
	 * @since 1.0.7
	 * @deprecated 1.1.0 This wrapper is not needed anymore, so it'll be removed from public API in future.
	 */
	public function registerAllCss()
	{

		if (!$this->ajaxCssLoad && Yii::app()->request->isAjaxRequest) {
			return;
		}

		if ($this->responsiveCss !== false) {
			$this->registerPackage('full.css')->registerMetaTag('width=device-width, initial-scale=1.0', 'viewport');
		} else {
			$this->registerCoreCss();
		}

		if ($this->fontAwesomeCss !== false) {
			$this->registerFontAwesomeCss();
		}

		if ($this->yiiCss !== false) {
			$this->registerYiiCss();
		}

		if ($this->jqueryCss !== false) {
			$this->registerJQueryCss();
		}
	}

	/**
	 * Registers all Bootstrap JavaScript files.
	 * @deprecated 1.1.0 This method is unnecessary in public API, so, removing it.
	 */
	public function registerAllScripts()
	{
		if (!$this->ajaxJsLoad && Yii::app()->request->isAjaxRequest)
			return;

		$this->registerCoreScripts();
		$this->registerTooltipAndPopover();
	}

	/**
	 * Registers the core JavaScript.
	 * @since 0.9.8
	 * @deprecated 1.1.0
	 */
	public function registerCoreScripts()
	{
		$this->registerPackage('bootstrap.js');
		if ($this->enableBootboxJS)
			$this->registerPackage('bootbox');

		if ($this->enableNotifierJS)
			$this->registerPackage('notify');
	}

	/**
	 * Registers the Tooltip and Popover plugins.
	 * @since 1.0.7
	 * @deprecated 1.1.0
	 */
	public function registerTooltipAndPopover()
	{
		$this->registerPopover();
		$this->registerTooltip();
	}



}
