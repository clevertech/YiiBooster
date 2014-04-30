# ChangeLog
Please update this document each time you close an issue by your commit.

## Special Thanks from original author
I would like to personally thank everyone of you that spend your valuable time helping improving this extension, by pointing out bugs and/or providing solutions that all of us can take advantage with.

Thank you all

Antonio Ramirez.

## YiiBooster latest development alpha  
 -
 
## YiiBooster version 3.0.1
- **(fix)** branch and tag fix - no code changes from 3.0.0

## YiiBooster version 3.0.0
- **(fix)** TbExtendedGridView - TbProgress inside cell css fix - #448
- **(enh)** TbGridView - try to register TbEditableColumn scripts for empty providers - works only with CActiveDataProvider - #526 
- **(fix)** TbDatePicker - noconflicts fix - #531
- **(fix)** TbBox header css fix to overflow its contents - #559 
- **(fix)** TbEditableSaver moved to comonents instead of widgets
- **(fix)** TbButtonColumn not displaying images - #604 
- **(enh)** TbExtendedGridView - with chart categories bindings on xAxis - #608  
- **(enh)** TbActiveForm - custom label support for radioButtonRow and checkBoxRow - #776  
- **(enh)** TbToggleAction - now supports composite key - #668
- **(enh)** TbExtendedGrid - supporting 'sortableRows' with composite key models - #669
- **(enh)** TbTimePicker - update to the latest bootstrap-timepicker - #700
- **(fix)** TbActiveForm - Prevent placeholder rendering as list item - #774 	
- **(fix)** TbInput - fix bug using CHtml::resolveName() in getContainerCssClass() - #775
- **(fix)** TbFormInputElement - fix passing attributes to widget - #773 
- **(fix)** TbTimePicker error on client side validation - #716 
- **(fix)** Fixed keyField for CArrayDataProvider in TbExtendedGridView - #738
- **(fix)** TbRelationalColumn - adding submitData - #741
- **(fix)** packages fix x-editable depends on bootstrap - #742 
- **(enh)** TbEditableColumn now supports CArrayDataProvider as well as CActiveDataProvider - #745 
- **(fix)** TbHtml FontAwesome is now working well- #746
- **(enh)** TbEditable - adding support for the 'source' to be a function that takes the $model as an attribute and returns the proper array 
- **(fix)** TbSelect2 - disabled fix - #752 
- **(fix)** JSON Grid now sorts in both ways - #753 
- **(fix)** TbGroupGridView - fix rows id - #755
- **(fix)** TbFileUpload - allow multi instance in the same page - #756
- **(enh)** TbExtendedGridView - Grid/Chart switcher - fix of chart auto reflow
- **(fix)** TbEditableField - fixed the "model has no getAttribute method" error
- **(enh)** gii - now the generator detects the db types date, and enum and generate the corresponding controls
- **(enh)** TbActiveForm - added the default placeholder in case of Inbut widgets, and CModel to be the attribute label
- **(enh)** TbExtendedGridView - Grid/Chart switcher - added the defaultView property to let the chart be the default view
- **(fix)** TbExtendedGridView - Grid/Chart switcher - fix not working toggle button
- **(fix)** Update x-editable to 1.5.2 and fix setting locale for datepicker, when jQuery UI is loaded on page #770 (Wiseon3)
- **(enh)** TbExtendedGridView remembering selected rows #628 (firsyura)
- **(fix)** Arrow in header of sortable gridview column is now displayed only if the column is sortable (contains sort-link) (kev360)
- **(enh)** New widget `TbEditable` to be able to use `x-editable` without models #729 (fromYukki)

## YiiBooster version 2.1.1
- **(fix)** No more overwrites `CClientScript` by Booster #726 (fromYukki)

## YiiBooster version 2.1.0
- **(fix)** Fix "Maximum call stack size exceeded" inside `TbExtendedGridView` class #430 (fromYukki)
- **(fix)** Fix attributes on `td` after update in classes `TbJsonButtonColumn` and `TbJsonCheckBoxColumn` #350 (fromYukki)
- **(enh)** New attributes `readonly` and `disabled` for `TbSelect2` class #305 (fromYukki)
- **(fix)** Client validation for inline forms using `TbActiveForm` class #242 (fromYukki)
- **(enh)** Basic version of new widget jQuery UI Layout Manager (`TbUiLayout`) #390 (fromYukki)
- **(fix)** Fix tooltip binding for `TbButtonColumn`, `TbButtonGroupColumn` and `TbToggleColumn` #271 (fromYukki)
- **(fix)** Store some Bootstrap widgets in his own variables to prevent conflicts with jQuery UI #228 (fromYukki)
- **(enh)** Using Bootstrap and Font-Awesome icons together, removed "no-icons" css for Bootstrap, changed logic for icons in widgets #706 (fromYukki)
- **(enh)** Font Awesome updated to 4.0.3 including CDN #706 (fromYukki)
- **(fix)** Resolve conflicts between jQuery UI and Bootstrap (fromYukki)
- **(enh)** Tooltip for `TbButton` and `TbButtonGroup` #724 (fromYukki)
- **(fix)** Ability to put any custom css class via htmlOptions attribute for `EditableDetailView` #684 (fromYukki)
- **(fix)** Editable Detail view Date i18n error #686 (fromYukki)
- **(enh)** Bootstrap carousel with links for images #682
- **(fix)** Do not display empty alert messages #721 (fromYukki, amrbedair)
- **(fix)** `TbSelect2` - Multi-select and placeholder lead to empty selection #717 (fromYukki)
- **(enh)** Now bootstrap can be used with modules (fromYukki)
- **(enh)** Inline dropDownList without label (naduvko)
- **(enh)** Date range picker for inline forms (Hrumpa)
- **(enh)** Updated Bootstrap DateTimePicker to 2.2.0 (adeg)
- **(enh)** Updated HighCharts to 3.0.6 (hijarian)
- **(fix)** Now we can use Javascript function definitions in `TbHighCharts` and `TbRedactorJs` options. #696 (hijarian)
- **(enh)** Now the source distribution will hold the user-level documentation for widgets in universal XML format, along with the examples in PHP. #692 (hijarian)
- **(enh)** Updated CKEditor library to version 4.2.1 (hijarian)
- **(enh)** Updated redactor js to version 9.1.5 (kullar84)
- **(enh)** Updated X-Editable assets to version 1.5.0 (hijarian)
- **(enh)** Updated Bootstrap Datepicker assets to version 1.2.0 (hijarian)
- **(fix)** Fixed `TbDatePicker` so it loads locale files from package folder. #688 (hijarian)
- **(fix)** Fix `TbDateTimePicker`, so it loads locale files from the package folder, fix `TbEditableField` to load required scripts for 'datetime' field type (adeg)
- **(fix)** Fix for placeholder overwriting in TbInputInline::maskedTextField and TbInputInline::typeAheadField. #694 (hightman)

## YiiBooster version 2.0.0
- **(enh)** Bootstrap DateRangePicker updated to 1.2, moment.js updated to 2.2.1 (Hrumpa)
- **(fix)** Fixed incorrect spec for `moment.js` library package. #673 #672 (fleuryc)
- **(enh)** Replaced notifier library with Notify.js (see http://notify.js) (hijarian).
- **(enh)** Upgraded BootBox.js library to 3.3.0 version (hijarian)
- **(enh)** No assets are loaded in AJAX calls now. (hijarian)
- **(enh)** Responsive CSS are default now. #556 (hijarian)
- **(enh)** Pass*Field by Antelle (v 1.1.7) widget added #667 (Hrumpa)
- **(cln)** Removed long-broken `TbExtendedTooltip` from codebase #511 (hijarian)
- **(fix)** Checkboxes, selects and radiobuttons in form rows do not generate invalid HTML markup anymore #664 #626 (ZhandosKz)
- **(enh)** Now you can properly extend/modify the rendering of individual alerts in `TbAlert` #619 (hijarian)
- **(enh)** Updated Redactor to version 9 #583 (hijarian)
- **(fix)** Now you can create `TbSelect2` widget without any data and placeholder is being handled correctly for empty dropdowns. #247 (hijarian)
- **(enh)** Now there's no "minifyCss" option. Use the new "minify" option, which does the same thing but means what it really does: whether to minify ALL assets, both CSS and Javascript. (hijarian)
- **(enh)** Updated `TbWizard` assets to newest version #645 (hijarian)
- **(fix)** Now we really can use `CActiveDataProvider.keyAttribute` attribute in `TbRelationalColumn` #659 (coupej)
- **(fix)** `TbActiveForm.radioButtonListRow` validation fixed by adding with id expected by jquery.yiiactiveform.js #652 #653 (timothynott)
- **(enh)** Added new widget `TbJsonToggleColumn` #660 (tamvodopad)
- **(fix)** Now `TbPickerColumn` works again. (hijarian)
- **(fix)** Rather radically fixed the issue with jQuery UI tooltips overriding Twitter Bootstrap tooltips. (hijarian)
- **(fix)** TbExtendedGridView sortable rows updated to work with CSRF token #333 (zvonicek)
- **(fix)** `TbJsonGridView` when enablePagination set to false JavaScript does not throw error "Error: Empty or undefined template passed to $.jqotec" #635 (ZhandosKz)
- **(enh)** `TbJsonGridView` summary data updated after ajax request #635 (ZhandosKz)
- **(enh)** Bootstrap DateTimePicker by S.Malot widget added rev #91 (Hrumpa)
- **(fix)** `TbEditableColumn` updated to support namespaced models #636 (xapon)
- **(enh)** Bootstrap DatePicker updated to 1.1.3 including CDN #631 (Hrumpa)
- **(enh)** Font Awesome updated to 3.2.1 including CDN (miramir)
- **(fix)** Added ID to click action in TbRelationalColumn to avoid conflicts on pages with mulitple TbExtendedGridViews #670 (timothynott)

## YiiBooster version 1.1.0
- **(enh)** Added Italian translation for `TbHtml5Editor` #544 (realtebo)
- **(enh)** Rearranged build script to accommodate Composer installed libraries better. (hijarian)
- **(enh)** Added composer file #566 (gureedo)
- **(enh)** Updated version of Boostrap Datepicker library #585 (soee)
- **(enh)** Following methods are deprecated now in main `Bootstrap` class: `register`, `registerAllCss`, `registerAllScripts`, `registerCoreScripts`, `registerTooltipAndPopover`, `registerCoreCss` and `registerResponsiveCss`. If you have been using them, stop as soon as possible, because most possibly you will end with broken styles in your application. (hijarian)
- **(fix)** Removed LESS files from the codebase, as they are unused (hijarian)
- **(fix)** Now the bootstrap CSS files are being included according to the combination of `enableCdn`, `minify`, `responsiveCss` and `fontAwesomeCss` parameters. #528 #510 (hijarian)
- **(enh)** Added two parameters to Bootstrap component, `ajaxCssLoad` and `ajaxJsLoad`, to control loading CSS and JS assets in AJAX calls #514 (ianare)
- **(fix)** TbBox action buttons now display correcftly with icons (fleuryc)
- **(fix)** Check that `$_SERVER['HTTP_USER_AGENT']` is set when loading MSIE font awesome (ianare)
- **(fix)** Breadcrumbs not visible with default css (naduvko)
- **(enh)** Inline datepicker (naduvko)
- **(fix)** Localization of datepicker not working (naduvko)

## YiiBooster version 1.0.7
- **(fix)** HighCharts now accept data with zero values normally #345 (dheering)
- **(enh)** Added datepicker and date.js to packages.php with enableCdn support (magefad)
- **(fix)** Fixed incorrect margin in accordion header #484 (hijarian)
- **(enh)** Upgraded the jQuery UI / Bootstrap compatibility layer to v. 0.5 (hijarian)
- **(enh)** Fixed the TbBulkAction to accommodate to `selectableRows` #490 (jamesmbowler)
- **(enh)** Added the readme to contributing to GitHub repo, now it should be more visible for collaborators (hijarian)
- **(fix)** Update to Bootstrap 2.3.2 - patch release to address a single bug (see bootstrap issue 7118) related to dropdowns and command/control clicking links in Firefox
- **(enh)** Update bootstrap-datepicker from RC to 1.0.2 final (magefad)
- **(enh)** Update yiistrap compatibility helpers #443 (magefad)
- **(fix)** Fixed the multiple option in `TbFileUpload` #457 (mikspark)
- **(fix)** Removed BOM from all files and converted line endings to Unix `\n` ones #486 #479 (hijarian)
- **(fix)** Fixed use of negative numbers in TbSumOperation (speixoto)
- **(enh)** Added the special properties to set `htmlOptions` on tab content and tabs themselves in `TbTabs` #452 (lloyd966, Antonio Ramirez)
- **(enh)** Added ability to set the id of the dropdown menu #462 (speixoto)
- **(enh)** Added the possibility to render append/prepend without a span wrap #414 (Frostmaind)
- **(enh)** Update x-editable-yii from 1.3.0 to 1.4.0 #413 (magefad)
- **(enh)** Now use Yii clientScript packages functionality with ability to use custom assetsUrl, added option enableCdn (true if YII_DEBUG off, netdna.bootstrapcdn.com CDN used by default) (magefad)
- **(enh)** Added Helpers: TbHtml, TbIcon for compatibility with yiistrap #443 (magefad)
- **(cln)** Remove not bootstrap - jquery editable. Use stable **bootstrap** x-editable instead. (magefad)
- **(cln)** Removed non-working TbJqRangeSlider (magefad)
- **(fix)** Include specific FontAwesome CSS for IE7 #434 (kev360)
- **(enh)** Changed structure of the project directory, now the sources are clearly separated from all other build artifacts like the documentation or tests #263 (hijarian)

## YiiBooster version 1.0.6
- **(fix)** Now it is possible to provide custom 'class' and 'style' htmlOptions for TbProgress #216 (hijarian)
- **(fix)** Fix typo on TbCollapse (tonydspaniard)
- **(fix)** Dropdown in collapse not showing on first attempt (hijarian)
- **(fix)** 2nd header from responsive table overlaps the 1st responsive table header #259 (hijarian)
- **(fix)** datepicker 404 error #189 (tonydspaniard)
- **(fix)** TbExtendedGridView Bulk Actions Bug #155 (tonydspaniard)
- **(enh)** Add option to disable asset publication in debug mode #229 (suralc)
- **(fix)** Fixed the CSS-including behavior of TbHtml5Editor #290 #311 (hijarian)
- **(fix)** Now assets for TbDateRangePicker are being registered with default settings instead of hard-coded POS_HEAD #266 #297 (hijarian)
- **(fix)** Added correct handling of the composite primary keys in the `TbEditableField` #287 (abeel)
- **(enh)** Added masked text field type #281 (tkijewski)
- **(enh)** Added typeahead text field type #296 (tkijewski)
- **(enh)** Added number field type (xt99)
- **(enh)** TbToggleColumn now extends TbDataColumn #303 #323 (kev360)
- **(fix)** Ajax submit button does not force the POST method anymore #284 (yourilima)
- **(fix)** Fixed TimePicker #314 (marsuboss)
- **(fix)** Fixed bootstrap.datepicker.<lang>.js #341 (fdelprete)
- **(fix)** Fixed TbJEditableColumn which could not be edited when value is empty initially #339 (rumal)
- **(fix)** TimePicker did not released focus in Webkit browsers #364 (ciarand)
- **(fix)** DateRangePicker TbActiveForm field row was not closed properly #352 (despro3)
- **(enh)** Added a TbImageGallery widget #335 (magefad)
- **(fix)** Allow to use url parameter in TbTabs #360 (magefad)
- **(enh)** Add option "fontAwesomeCss" for to active Font Awesome CSS (marsuboss)
- **(enh)** Fixed TbEditable - mode(modal|inline); language,support for datepicker, app lang by default (magefad)
- **(fix)** Add option "disabled" on TbEditableField
- **(enh)** Add empty (null) value display for TbToggleColumn ("icon-question-sign" icon with "Not Set" label) (magefad)
- **(fix)** Fixed typeAheadField #396 (magefad)
- **(fix)** StickyTableHeader issue dynamic cell width #338, updated js, added compressed js (magefad)
- **(fix)** Keep document title when HTML5 history API is enabled (nevkontakte)
- **(fix)** Fixed wrong behavior of TbJsonGridView when doing AJAX updates like row deletion when there is pagination (nevkontakte)
- **(enh)** Bootstrap upgrade to 2.3.1 (magefad)
- **(fix)** Added rowHtmlOptionsExpression support for TbExtendedGridView (xt99)
- **(enh)** TbButtonGroup does not accept TbButton.dropdownOptions #149 (russ666)
- **(enh)** Added GridView visual aid on hover for sorting (Wiseon3)
- **(enh)** Updated daterangepicker plugin (magefad)
- **(fix)** CSqlDataprovider support #356 (magefad)
- **(fix)** TbTypeahead - Add attribute autocomplete="off" by default #285
- **(enh)** Update Redactor to 8.2.3 #386 (magefad)
- **(fix)** baseID in checkBoxList and radioButtonList can now be customized via htmlOptions, added container support - yii 1.1.13 (fad)
- **(fix)** Corrected close link (with twitter bootstrap recommendations) bb53
- **(fix)** Fixed label association when input has a user-defined id attribute (fixes bb72)
- **(fix)** Button input, button submit added in TbButton
- **(fix)** Fix missing close tags in TbCarousel
- **(enh)** Added CONTAINER_PREFIX constant for html div container id
- **(fix)** Added class "hide" to modal div
- **(fix)** Add support for non-link brand in TbNavbar


## YiiBooster version 1.0.5
- **(fix)** TbCarousel displayPrevAndNext set to false breaks the page (amosviedo)
- **(enh)** Bootstrap upgrade to 2.2.1 (kazuo)
- **(fix)** TbActiveForm class name is displayed on screen (sorinpohontu)
- **(fix)** TbExtendedGridView Bulk Actions Bug (tonydspaniard)
- **(enh)** Updated jquery-ui LESS (kazuo)
- **(enh)** Bootbox now can be activated/deactived at will (tonydspaniard)
- **(enh)** Added TbExtendedGridFilter widget (tonydspaniard)
- **(enh)** Added JSONStorage component (tonydspaniard)
- **(fix)** Overrided TbBox bug by upgrade (ragazzo)
- **(enh)** Now TbBox can hold multiple types of buttons (dragnet)
- **(enh)** Added bootstrap styles to TbSelect2 widget (DonFelipe)
- **(enh)** Added radioButton group list support (xpoft)
- **(fix)** Hungarian translation corrected (pappfer)
- **(fix)** renderKeys() in TbExtendedGridView generates invalid html (TrueTamTam)
- **(fix)** TbFileUpload - bug in global progressbar (appenshin)
- **(enh)** Added support to TbActiveForm to use TbSelect2 widget (tonydspaniard)
- **(enh)** Added MarkDown Editor (kazuo)
- **(fix)** 2nd header from responsive table overlaps the 1st responsive table header #246 (hijarian)
- **(fix)** Divider symbols in breadcrumbs changed to HTML entities (wkii)
- **(fix)** Divider in active items in breadcrumbs was outside of the `li` tag (wkii)

