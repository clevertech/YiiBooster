<?php
/**
 *## Booster class file.
 *
 * @author Christoffer Niska <ChristofferNiska@gmail.com>
 * @copyright Copyright &copy; Christoffer Niska 2011-2012
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 * @version 1.0.0
 *
 * Modified for YiiBooster
 * @author Antonio Ramirez <antonio@clevertech.biz>
 * @version 1.0.7
 *
 * Maintenance
 * @author Mark Safronov <hijarian@gmail.com>
 * @version 2.0.0
 *
 * Maintenance
 * @author Maksim Naumov <fromyukki@gmail.com>
 * @version 2.1.0
 * 
 * Maintenance
 * @author Amr Bedair <amr.bedair@gmail.com>
 * @version 3.0.1
 * 
 * Bootstrap 3.1.1
 * @author Amr Bedair <amr.bedair@gmail.com>
 * @version 4.0.0
 * 
 */

/**
 *## Booster application component.
 *
 * This is the main YiiBooster component which you should attach to your Yii CWebApplication instance.
 *
 * Almost all configuration options are meaningful only at the initialization time,
 * changing them after `Booster` was attached to application will have no effect.
 *
 * @package booster.components
 */
class Booster extends CApplicationComponent {
	
	/**
	 * @var boolean Whether to use CDN server URLs for assets.
	 * Note that not all assets will be served from CDN and we are using several public CDN servers,
	 * not some single private one.
	 *
	 * Consult with the packages configuration to discover precisely which assets will be served from CDN.
	 */
	public $enableCdn = false;

	/**
	 * @var boolean Whether to register any CSS at all.
	 * Defaults to true.
	 */
	public $coreCss = true;

	/**
	 * @var boolean Whether to register the Bootstrap core CSS (bootstrap.min.css).
	 * Defaults to true.
	 */
	public $bootstrapCss = true;

	/**
	 * @var boolean whether to register the Bootstrap responsive CSS (bootstrap-responsive.min.css).
	 * Defaults to false.
	 */
	public $responsiveCss = true;
	
	/**
	 * @var boolean whether to disable zooming capabilities on mobile devices
	 * Defaults to false
	 * @since 4.0.0
	 */
	public $disableZooming = false;

	/**
	 * @var boolean Whether to register the Font Awesome CSS (font-awesome.min.css).
	 * Defaults to false.
	 *
	 * Note that FontAwesome does not include some of the Twitter Bootstrap built-in icons!
	 */
	public $fontAwesomeCss = false;

	/**
	 * @var bool Whether to use minified CSS and Javascript files. Default to true.
	 */
	public $minify = true;

	/**
	 * @var boolean Whether to register YiiBooster custom CSS overrides
	 * providing compatibility between various parts of the system.
	 *
	 * @since 0.9.12
	 */
	public $yiiCss = true;

	/**
	 * @var boolean Whether to register the JQuery-specific CSS missing from Bootstrap.
	 */
	public $jqueryCss = true;

	/**
	 * @var boolean Whether to register jQuery and the Bootstrap JavaScript.
	 * @since 0.9.10
	 */
	public $enableJS = true;

	/**
	 * @var bool Whether to enable bootbox messages or not. Default value is true.
	 * @since 1.0.5
	 */
	public $enableBootboxJS = true;

	/**
	 * @var bool Whether to enable bootstrap notifier.
	 * Defaults to true.
	 *
	 * @see https://github.com/Nijikokun/bootstrap-notify
	 */
	public $enableNotifierJS = true;

	/**
	 * @var boolean to register Bootstrap CSS files in AJAX requests
	 * Defaults to false and you probably have no reason to set it to true.
	 */
	public $ajaxCssLoad = false;

	/**
	 * @var boolean to register the Bootstrap JavaScript files in AJAX requests
	 * Defaults to false and you probably have no reason to set it to true.
	 */
	public $ajaxJsLoad = false;

	/**
	 * @var bool|null Whether to republish assets on each request.
	 * If set to true, all YiiBooster assets will be republished on each request.
	 * Passing null to this option restores the default handling of CAssetManager of YiiBooster assets.
	 *
	 * @since YiiBooster 1.0.6
	 */
	public $forceCopyAssets = false;
	
	public $enablePopover = true;
	
	public $enableTooltip = true;

	/**
	 * @var string Default popover target CSS selector.
	 *
	 * @since 0.10.0
	 * @since 1.1.0 NOTE: this parameter changed its logic completely!
	 * Previously it was the selector from which to start delegating the popovers.
	 * Now the popovers are always being bound to specific elements.
	 * According to the documentation: http://twitter.github.io/bootstrap/javascript.html#popovers
	 */
	public $popoverSelector = '[data-toggle=popover]';

	/**
	 * @var string default tooltip CSS selector.
	 * @since 0.10.0
	 * @since 1.1.0 NOTE: this parameter changed its logic completely!
	 * Previously it was the selector from which to start delegating the tooltips.
	 * Now the tooltips always start spreading from `body`, and this parameter controls
	 * what elements will actually receive the tooltip behavior.
	 * According to the documentation: http://twitter.github.io/bootstrap/javascript.html#tooltips
	 * previously it was the direct selector to which to apply the `tooltip` plugin,
	 * now it is the value for `selector` plugin option.
	 */
	public $tooltipSelector = '[data-toggle=tooltip]';

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
	 * @var CClientScript Something which can register assets for later inclusion on page.
	 * For now it's just the `Yii::app()->clientScript`
	 */
	public $cs;

	/**
	 * @var string handles the assets folder path.
	 */
	public $_assetsUrl;

    /**
     * @var Booster
     */
    private static $_instance;

	/**
	 * Initializes the component.
	 */
	public function init() {
		
		// Prevents the extension from registering scripts and publishing assets when ran from the command line.
		if ($this->isInConsoleMode() && !$this->isInTests())
			return;

        self::setBooster($this);

        $this->setRootAliasIfUndefined();

		$this->setAssetsRegistryIfNotDefined();

		$this->includeAssets();

		parent::init();
	}

	/** @return bool */
	protected function isInConsoleMode() {
		
		return Yii::app() instanceof CConsoleApplication || PHP_SAPI == 'cli';
	}

	/** @return bool */
	protected function isInTests() {
		
		return defined('IS_IN_TESTS') && IS_IN_TESTS;
	}

	/**
	 * 
	 */
	protected function setRootAliasIfUndefined() {
		
		if (Yii::getPathOfAlias('booster') === false) {
			Yii::setPathOfAlias('booster', realpath(dirname(__FILE__) . '/..'));
		}
	}

	/**
	 *
	 */
	protected function includeAssets() {
		
		$this->appendUserSuppliedPackagesToOurs();

		$this->addOurPackagesToYii();

		$this->registerCssPackagesIfEnabled();

		$this->registerJsPackagesIfEnabled();
	}

	/**
	 *
	 */
	protected function appendUserSuppliedPackagesToOurs() {
		
		$bootstrapPackages = require(Yii::getPathOfAlias('booster.components') . '/packages.php');
		$bootstrapPackages += $this->createBootstrapCssPackage();
		$bootstrapPackages += $this->createSelect2Package();

		$this->packages = CMap::mergeArray(
			$bootstrapPackages,
			$this->packages
		);
	}

	/**
	 *
	 */
	protected function addOurPackagesToYii() {
		
		foreach ($this->packages as $name => $definition) {
			$this->cs->addPackage($name, $definition);
		}
        $this->cs->scriptMap['jquery-ui.min.js'] = $this->getAssetsUrl() . '/js/jquery-ui-no-conflict.min.js';
	}

	/**
	 * If we did not disabled registering CSS packages, register them.
	 */
	protected function registerCssPackagesIfEnabled() {
		
		if (!$this->coreCss)
			return;

		if (!$this->ajaxCssLoad && Yii::app()->request->isAjaxRequest)
			return;

		if ($this->bootstrapCss)
			$this->registerBootstrapCss();

		if ($this->fontAwesomeCss)
			$this->registerFontAwesomeCss();

		if ($this->responsiveCss)
			$this->registerMetadataForResponsive();

		if ($this->yiiCss !== false)
			$this->registerYiiCss();

		if ($this->jqueryCss !== false)
			$this->registerJQueryCss();
	}

	/**
	 * Register our overrides for jQuery UI + Twitter Bootstrap 2.3 combo
	 *
	 * @since 0.9.11
	 */
	public function registerYiiCss() {
		
		$this->registerPackage('bootstrap-yii');
	}

	/**
	 * Register the compatibility layer for jQuery UI + Twitter Bootstrap 2.3 combo
	 */
	public function registerJQueryCss() {
		
		$this->registerPackage('jquery-css')->scriptMap['jquery-ui.css'] = $this->getAssetsUrl(
		) . '/css/jquery-ui-bootstrap.css';
	}

	/**
	 * If `enableJS` is not `false`, register our Javascript packages
	 */
	protected function registerJsPackagesIfEnabled() {
		
		if (!$this->enableJS)
			return;

		if (!$this->ajaxJsLoad && Yii::app()->request->isAjaxRequest)
			return;

		$this->registerPackage('bootstrap.js');
        $this->registerPackage('bootstrap-noconflict');

		if ($this->enableBootboxJS)
			$this->registerPackage('bootbox');

		if ($this->enableNotifierJS)
			$this->registerPackage('notify');
		
		if($this->enablePopover)
			$this->registerPopoverJs();
		
		if($this->enableTooltip)
			$this->registerTooltipJs();
	}


	/**
	 * Returns the extension version number.
	 * @return string the version
	 */
	public function getVersion() {
		
		return '4.0.1';
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
	public function registerPackage($name) {
		
		return $this->cs->registerPackage($name);
	}

	/**
	 * Registers a CSS file in the asset's css folder
	 *
	 * @param string $name the css file name to register
	 * @param string $media media that the CSS file should be applied to. If empty, it means all media types.
	 *
	 * @see CClientScript::registerCssFile
	 */
	public function registerAssetCss($name, $media = '') {
		
		$this->cs->registerCssFile($this->getAssetsUrl() . "/css/{$name}", $media);
	}

	/**
	 * Register a javascript file in the asset's js folder
	 *
	 * @param string $name the js file name to register
	 * @param int $position the position of the JavaScript code.
	 *
	 * @see CClientScript::registerScriptFile
	 */
	public function registerAssetJs($name, $position = CClientScript::POS_END) {
		
		$this->cs->registerScriptFile($this->getAssetsUrl() . "/js/{$name}", $position);
	}

	/**
	 * Returns the URL to the published assets folder.
	 * @return string an absolute URL to the published asset
	 */
	public function getAssetsUrl() {
		
		if (isset($this->_assetsUrl)) {
			return $this->_assetsUrl;
		} else {
			return $this->_assetsUrl = Yii::app()->getAssetManager()->publish(Yii::getPathOfAlias('booster.assets'), false, -1, $this->forceCopyAssets);
		}
	}

	protected function setAssetsRegistryIfNotDefined() {
		
		if (!$this->cs) {
            $this->cs = Yii::app()->getClientScript();
        }
	}

	public function registerBootstrapCss() {
		
		$this->cs->registerPackage('bootstrap.css');
	}

	/**
	 * We use the values of $this->responsiveCss, $this->fontAwesomeCss,
	 * $this->minify and $this->enableCdn to construct the proper package definition
	 * and install and register it.
	 * @return array
	 */
	protected function createBootstrapCssPackage() {
		
		return array('bootstrap.css' => array(
			'baseUrl' => $this->enableCdn ? '//netdna.bootstrapcdn.com/bootstrap/3.1.1/' : $this->getAssetsUrl() . '/bootstrap/',
			'css' => array( ($this->minify || $this->enableCdn) ? 'css/bootstrap.min.css' : 'css/bootstrap.css' ),
		));
	}

	/**
	 * Make select2 package definition
	 * @return array
	 */
	protected function createSelect2Package() {
		
		$jsFiles = array($this->minify ? 'select2.min.js' : 'select2.js');

		if (strpos(Yii::app()->language, 'en') !== 0) {
			$locale = 'select2_locale_'. substr(Yii::app()->language, 0, 2). '.js';
			if (@file_exists(Yii::getPathOfAlias('booster.assets.select2') . DIRECTORY_SEPARATOR . $locale )) {
				$jsFiles[] = $locale;
			} else {
				$locale = 'select2_locale_'. Yii::app()->language . '.js';
				if (@file_exists(Yii::getPathOfAlias('booster.assets.select2') . DIRECTORY_SEPARATOR . $locale )) {
					$jsFiles[] = $locale;
				}else{
					$locale = 'select2_locale_'. substr(Yii::app()->language, 0, 2) . '-' . strtoupper(substr(Yii::app()->language, 3, 2)) . '.js';
					if (@file_exists(Yii::getPathOfAlias('booster.assets.select2') . DIRECTORY_SEPARATOR . $locale )) {
						$jsFiles[] = $locale;
					}
				}
			}
		}

		return array('select2' => array(
			'baseUrl' => $this->getAssetsUrl() . '/select2/',
			'js' => $jsFiles,
			'css' => array('select2.css', 'select2-bootstrap.css'),
			'depends' => array('jquery'),
		));
	}

	/**
	 * Required metadata for responsive CSS to work.
	 */
	protected function registerMetadataForResponsive() {
		if($this->disableZooming)
			$this->cs->registerMetaTag('width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no', 'viewport');
		else
			$this->cs->registerMetaTag('width=device-width, initial-scale=1', 'viewport');
	}

	/**
	 * Registers the Font Awesome CSS.
	 * @since 1.0.6
	 */
	public function registerFontAwesomeCss() {
		
        $this->registerPackage('font-awesome');
	}
	
	public function registerPopoverJs() {
		$this->cs->registerScript($this->getUniqueScriptId(), "jQuery('[data-toggle=popover]').popover();");
	}
	
	public function registerTooltipJs() {
		$this->cs->registerScript($this->getUniqueScriptId(), "jQuery('[data-toggle=tooltip]').tooltip();");
	}

	/**
	 * Generates a "somewhat" random id string.
	 * @return string
	 * @since 1.1.0
	 */
	public function getUniqueScriptId() {
		return uniqid(__CLASS__ . '#', true);
	}

	/**
	 * @param $name
	 *
	 * @return mixed
	 */
	protected function tryGetSelectorForPlugin($name) {
		
		return $this->tryGetInfoForPlugin($name, 'selector');
	}

	/**
	 * @param $name
	 * @return mixed
	 */
	protected function tryGetOptionsForPlugin($name) {
		
		return $this->tryGetInfoForPlugin($name, 'options');
	}

    /**
     * @param Bootstrap $value
     * @since 2.1.0
     */
    public static function setBooster($value) {
    	
        if ($value instanceof Booster) {
            self::$_instance = $value;
        }
    }

    /**
     * @return Bootstrap
     * @since 2.1.0
     */
    public static function getBooster() {
    	
        if (null === self::$_instance) {
            // Lets find inside current module
            $module = Yii::app()->getController()->getModule();
            if ($module) {
                if ($module->hasComponent('booster')) {
                    self::$_instance = $module->getComponent('booster');
                }
            }
            // Still nothing?
            if (null === self::$_instance) {
                if (Yii::app()->hasComponent('booster')) {
                    self::$_instance = Yii::app()->getComponent('booster');
                }
            }
        }
        return self::$_instance;
    }
}
