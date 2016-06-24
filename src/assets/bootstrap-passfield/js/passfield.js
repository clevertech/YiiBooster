/**
 * @license Pass*Field | (c) 2013 Antelle | https://github.com/antelle/passfield/blob/master/MIT-LICENSE.txt
 */

// Permission is hereby granted, free of charge, to any person obtaining
// a copy of this software and associated documentation files (the
// "Software"), to deal in the Software without restriction, including
// without limitation the rights to use, copy, modify, merge, publish,
// distribute, sublicense, and/or sell copies of the Software, and to
// permit persons to whom the Software is furnished to do so, subject to
// the following conditions:

// The above copyright notice and this permission notice shall be
// included in all copies or substantial portions of the Software.

// THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
// EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
// MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
// NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE
// LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION
// OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION
// WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.

/**
 * Entry point
 * Initializes PassField
 * If jQuery is present, sets jQuery plugin ($.passField)
 */
(function($, document, window, undefined) {
    "use strict";

    // ========================== definitions ==========================

    var PassField = window.PassField = window.PassField || {};

    /**
     * Password char types
     * @readonly
     * @enum {string}
     */
    PassField.CharTypes = {
        DIGIT: "digits",
        LETTER: "letters",
        LETTER_UP: "lettersUp",
        SYMBOL: "symbols",
        UNKNOWN: "unknown"
    };

    /**
     * Password checking mode
     * @readonly
     * @enum {number}
     */
    PassField.CheckModes = {
        /** more user friendly: if a password is better than the pattern (e.g. longer),
         * its strength is increased and it could match even not containing all char types */
        MODERATE: 0,
        /** more strict: it a password is longer than expected length, this makes no difference; all rules must be satisfied */
        STRICT: 1
    };

    // ========================== defaults ==========================

    PassField.Config = {
        defaults: {
            pattern: "abcdef12", // pattern for password (for strength calculation)
            acceptRate: 0.8, // threshold (of strength conformity with pattern) under which the password is considered weak
            allowEmpty: true, // allow empty password (will show validation errors if not)
            isMasked: true, // is the password masked by default
            showToggle: true, // show toggle password masking button
            showGenerate: true, // show generation button
            showWarn: true, // show short password validation warning
            showTip: true, // show password validation tooltips
            tipPopoverStyle: {}, // if tooltip is shown and Twitter Bootstrap is present, this style will be used. null = use own tips, {} = bootstrap tip options
            strengthCheckTimeout: 500, // timeout before automatic strength checking if no key is pressed (in ms; 0 = disable this feature)
            validationCallback: null, // function which will be called when password strength is validated
            blackList: [], // well-known bad passwords (very weak), e.g. qwerty or 12345
            locale: "", // selected locale (null to auto-detect)
            localeMsg: {}, // overriden locale messages
            warnMsgClassName: "help-inline form-control-static", // class name added to the waring control (empty or null to disable the feature)
            errorWrapClassName: "error", // class name added to wrapping control when validation fails (empty or null to disable the feature)
            allowAnyChars: true, // suppress validation errors if password contains characters not from list (chars param)
            checkMode: PassField.CheckModes.MODERATE, // password checking mode (how the strength is calculated)
            chars: {
                // symbol sequences for generation and checking
                digits: "1234567890",
                letters: "abcdefghijklmnopqrstuvwxyzßабвгедёжзийклмнопрстуфхцчшщъыьэюяґєåäâáàãéèêëíìîїóòôõöüúùûýñçøåæþðαβγδεζηθικλμνξοπρσςτυφχψω",
                lettersUp: "ABCDEFGHIJKLMNOPQRSTUVWXYZАБВГЕДЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЪЫЬЭЮЯҐЄÅÄÂÁÀÃÉÈÊËÍÌÎЇÓÒÔÕÖÜÚÙÛÝÑÇØÅÆÞÐΑΒΓΔΕΖΗΘΙΚΛΜΝΞΟΠΡΣΤΥΦΧΨΩ",
                symbols: "@#$%^&*()-_=+[]{};:<>/?!"
            },
            events: {
                generated: null,
                switched: null
            },
            nonMatchField: null, // login field (to compare password with - should not be equal)
            length: { // strict length checking rules
                min: null,
                max: null
            },
            maskBtn : {
                textMasked : "abc",
                textUnmasked: "&bull;&bull;&bull;",
                className: false,
                classMasked: false,
                classUnmasked: false
            }

        },

        locales: PassField.Config ? PassField.Config.locales : {}, // locales are defined in locales.js

        // Passwords in the blacklist shall be lowercase, but the check will be done case insensitive.
        blackList: [
            "password", "123456", "12345678", "abc123", "qwerty", "monkey", "letmein", "dragon", "111111", "baseball",
            "iloveyou", "trustno1", "1234567", "sunshine", "master", "123123", "welcome", "shadow", "ashley", "football",
            "jesus", "michael", "ninja", "mustang", "password1", "p@ssw0rd", "miss", "root", "secret"
        ],

        // The following characters are to be avoided in generated passwords.
        // They look similar in certain lettertypes (especially sans-serif).
        // I,l  0,o,O
        generationChars: {
            digits: "123456789",
            letters: "abcdefghijkmnpqrstuvwxyz",
            lettersUp: "ABCDEFGHJKLMNPQRSTUVWXYZ"
        },

        dataAttr: "PassField.Field"
    };

    // ========================== initialization ==========================

    /**
     * Encapsulates PassField logic
     * @param {HTMLInputElement|string} el - input for which the field is initizlized (or ID of the input)
     * @param {object} [opts] - options to override defaults
     */
    PassField.Field = function(el, opts) {
        var _conf = PassField.Config;
        var _dom = {};
        var _opts = utils.extend({}, _conf.defaults, opts);
        var _isMasked = true;
        var _locale;
        var _id;
        var _validateTimer;
        var _blurTimer;
        var _blurMaskTimer;
        var _warningShown = false;
        var _validationResult = null;
        var _features;
        var _isInputHover = false;
        var _isInputFocused = false;
        var _passHidesGenBtn = false;
        var _passHidesMaskBtn = false;
        var _bootstrapPopoverShownText = false;
        var _tipHtml = null;

        var ELEMENTS_PREFIX = "a_pf-";
        var JQUERY_EVENT_PREFIX = "pass:";
        var BUTTONS_PADDING_RIGHT = 5;
        var KEY_DELETE = 46;
        var KEY_BACKSPACE = 8;
        var BOOTSTRAP_INPUT_GROUP_CLASS = "input-group";

        // exports
        this.toggleMasking = function(isMasked) { toggleMasking(isMasked); };
        this.setPass = setPass;
        this.validatePass = validatePassword;
        this.getPassValidationMessage = getPassValidationMessage;
        this.getPassStrength = getPassStrength;

        init(this);

        /**
         * Initizlizes the password field
         * @param {PassField.Field} _this
         */
        function init(_this) {
            fixErrorsAndFillOptions();
            if (!setMainEl())
                return;
            setLocale();
            defineId();
            detectFeatures();
            createNodes();
            bindEvents();
            toggleMasking(_opts.isMasked, false);
            doAutofocus();
            assignDataObject(PassField.Config.dataAttr, _this);
        }

        // ========================== logic ==========================

        /**
         * Corrects user errors in options
         * Fills blackList
         */
        function fixErrorsAndFillOptions() {
            _opts.blackList = (_opts.blackList || []).concat(PassField.Config.blackList);
        }

        /**
         * Sets mainEl to the actual element (it can be string)
         */
        function setMainEl() {
            if (typeof el === "string") {
                //noinspection JSValidateTypes
                el = document.getElementById(el);
            }
            _dom.mainInput = el;
            return !!_dom.mainInput;
        }

        /**
         * Fills _locale from setting defined in _opts
         * Locale will be merged from default locale and user-defined messages
         */
        function setLocale() {
            var neutralLocale = "en";

            var loc = _opts.locale;
            if (!loc && navigator.language)
                loc = navigator.language.replace(/\-.*/g, "");
            if (loc)
                _locale = _conf.locales[loc];
            if (_locale)
                _locale = utils.extend({}, _conf.locales[neutralLocale], _locale);
            if (!_locale)
                _locale = utils.extend({}, _conf.locales[neutralLocale]);
            if (_opts.localeMsg)
                utils.extend(_locale.msg, _opts.localeMsg);
            if (_locale.blackList)
                _opts.blackList = _opts.blackList.concat(_locale.blackList);
        }

        /**
         * Sets password value in field
         * @param {String} val - value to set
         */
        function setPass(val) {
            _dom.mainInput.value = val;
            if (_dom.clearInput) {
                _dom.clearInput.value = val;
            }
            handleInputKeyup();
        }

        /**
         * Defines _id
         * This will be id of the main input or random id (if main input doesn't have id)
         */
        function defineId() {
            _id = _dom.mainInput.id;
            if (!_id) {
                _id = ("i" + Math.round(Math.random() * 100000));
                _dom.mainInput.id = _id;
            }
        }

        /**
         * Inserts DOM nodes to the tree
         * Fills _dom with created objects
         */
        function createNodes() {
            var mainInputRect = getRect(_dom.mainInput);
            mainInputRect.top += cssFloat(_dom.mainInput, "marginTop");

            setupWrapper();
            setInputAttrs();
            createClearInput();
            createWarnLabel();
            createMaskBtn();
            createGenBtn();
            createTip(mainInputRect);
            createFakePlaceholder(mainInputRect);
            createPassLengthChecker();

            setTimeout(resizeControls, 0);
        }

        /**
         * Assigns necessary properties to wrapper element
         */
        function setupWrapper() {
            _dom.wrapper = _dom.mainInput.parentNode;
            addClass(_dom.wrapper, "wrap");
            if (!_features.hasInlineBlock) {
                addClass(_dom.wrapper, "wrap-no-ib");
            }
            if (css(_dom.wrapper, "position") === "static") {
                _dom.wrapper.style.position = "relative";
            }
        }

        /**
         * Assigns attributes (from options) to the input field
         */
        function setInputAttrs() {
            if (_opts.length && _opts.length.max)
                _dom.mainInput.setAttribute("maxLength", _opts.length.max.toString());
        }

        /**
         * Creates cleartext password field
         */
        function createClearInput() {
            if (!_features.changeType) {
                // IE < 9 don't support input type changing
                _dom.clearInput = newEl("input", { type: "text", id: "txt-clear", className: "txt-clear", value: _dom.mainInput.value },
                    { display: "none" });
                var cls = _dom.mainInput.className;
                if (cls) {
                    addClass(_dom.clearInput, cls, true);
                }
                var inputStyle = _dom.mainInput.style.cssText;
                if (inputStyle) {
                    _dom.clearInput.style.cssText = inputStyle;
                }
                utils.each(["maxLength", "size", "placeholder"], function(attr) {
                    var value = _dom.mainInput.getAttribute(attr);
                    if (value) {
                        _dom.clearInput.setAttribute(attr, value);
                    }
                });
                insertAfter(_dom.mainInput, _dom.clearInput);
            }
            addClass(_dom.mainInput, "txt-pass");
        }

        /**
         * Creates password warning label
         */
        function createWarnLabel() {
            if (_opts.showWarn) {
                _dom.warnMsg = newEl("p", { id: "warn", className: "warn" },
                    { margin: "0 0 0 3px" });
                addClass(_dom.warnMsg, "empty");
                if (_opts.warnMsgClassName)
                    addClass(_dom.warnMsg, _opts.warnMsgClassName, true);
                var insertAfterNode = _dom.clearInput || _dom.mainInput;
                if (hasClass(el.parentNode, BOOTSTRAP_INPUT_GROUP_CLASS, true)) {
                    insertAfterNode = insertAfterNode.parentNode;
                }
                insertAfter(insertAfterNode, _dom.warnMsg);
            }
        }

        /**
         * Creates toggle password masking button
         */
        function createMaskBtn() {
            if (_opts.showToggle) {
                var zIndex = css(_dom.mainInput, "z-index");
                _dom.maskBtn = newEl("div", { id: "btn-mask", className: "btn-mask", title: _locale.msg.showPass },
                    { position: "absolute", margin: "0", padding: "0", "z-index": zIndex ? zIndex + 1 : null });
                addClass(_dom.maskBtn, "btn");
                if (_opts.maskBtn.className) {
                    addClass(_dom.maskBtn, _opts.maskBtn.className, true);
                }
                if (_opts.maskBtn.classMasked) {
                    addClass(_dom.maskBtn, _opts.maskBtn.classMasked, true);
                }
                setHtml(_dom.maskBtn, _opts.maskBtn.textMasked);
                insertBefore(_dom.mainInput, _dom.maskBtn);
            }
        }

        /**
         * Creates password generation button
         */
        function createGenBtn() {
            if (_opts.showGenerate) {
                var zIndex = css(_dom.mainInput, "z-index");
                _dom.genBtn = newEl("div", { id: "btn-gen", className: "btn-gen", title: _locale.msg.genPass },
                    { position: "absolute", margin: "0", padding: "0", "z-index": zIndex ? zIndex + 1 : null });
                addClass(_dom.genBtn, "btn");
                insertBefore(_dom.mainInput, _dom.genBtn);

                _dom.genBtnInner = newEl("div", { id: "btn-gen-i", className: "btn-gen-i", title: _locale.msg.genPass });
                _dom.genBtn.appendChild(_dom.genBtnInner);
            }
        }

        /**
         * Creates password tooltip
         * If Twitter Bootstrap is present, this will be popover; fallback to own popover else
         * @param {Object} mainInputRect - password input element rect
         */
        function createTip(mainInputRect) {
            if (_opts.showTip) {
                if (_opts.tipPopoverStyle && $ && typeof $.fn.popover === "function") {
                    // using Twitter Bootstrap
                    $(_dom.mainInput).popover(utils.extend({
                        // popover defaults (overridable)
                        title: null,
                        placement: _opts.tipPopoverStyle.placement || function(pop, el) {
                            //noinspection JSValidateTypes
                            var top = $(el).position().top - $(window).scrollTop();
                            var spaceBelow = $(window).height() - top;
                            return spaceBelow > 300 || spaceBelow > top ? "bottom" : "top";
                        },
                        animation: false
                    }, _opts.tipPopoverStyle, {
                        // popovers properties (non-overridable)
                        trigger: "manual",
                        html: true,
                        content: function() { return _tipHtml; }
                    }));
                } else {
                    // not using Twitter Bootstrap
                    _dom.tip = newEl("div", { id: "tip", className: "tip" },
                        { position: "absolute", margin: "0", padding: "0", width: mainInputRect.width + "px" });
                    insertBefore(_dom.mainInput, _dom.tip);

                    var arrWrap = newEl("div", { id: "tip-arr-wrap", className: "tip-arr-wrap" });
                    _dom.tip.appendChild(arrWrap);
                    arrWrap.appendChild(newEl("div", { id: "tip-arr", className: "tip-arr" }));
                    arrWrap.appendChild(newEl("div", { id: "tip-arr-in", className: "tip-arr-in" }));

                    _dom.tipBody = newEl("div", { id: "tip-body", className: "tip-body" });
                    _dom.tip.appendChild(_dom.tipBody);
                }
            }
        }

        /**
         * Creates fake placeholders (if there's no support in browser)
         * @param {Object} mainInputRect - password input element rect
         */
        function createFakePlaceholder(mainInputRect) {
            if (!_features.placeholders) {
                var placeholderText = _dom.mainInput.getAttribute("placeholder") || _dom.mainInput.getAttribute("data-placeholder");
                if (placeholderText) {
                    _dom.placeholder = newEl("div", { id: "placeholder", className: "placeholder" },
                        { position: "absolute", margin: "0", padding: "0", height: mainInputRect.height + "px", lineHeight: mainInputRect.height + "px" });
                    setHtml(_dom.placeholder, placeholderText);
                    insertBefore(_dom.mainInput, _dom.placeholder);
                }
            } else if (!_dom.mainInput.getAttribute("placeholder") && _dom.mainInput.getAttribute("data-placeholder")) {
                _dom.mainInput.setAttribute("placeholder", _dom.mainInput.getAttribute("data-placeholder"));
            }
        }

        /**
         * Creates invisible div for measuring password test rect
         */
        function createPassLengthChecker() {
            if (_features.passSymbol) {
                _dom.passLengthChecker = newEl("div", { id: "len" },
                    { position: "absolute", height: css(_dom.mainInput, "height"),
                        top: "-10000px", left: "-10000px", display: "block", color: "transparent", border: "none" });
                insertBefore(_dom.mainInput, _dom.passLengthChecker);
                setTimeout(function() {
                    utils.each(["marginLeft", "fontFamily", "fontSize", "fontWeight", "fontStyle", "fontVariant"], function(attr) {
                        var value = css(_dom.mainInput, attr);
                        if (value) {
                            _dom.passLengthChecker.style[attr] = value;
                        }
                    });
                }, 50);
            }
        }

        /**
         * Resizes controls (for window.onresize event)
         */
        function resizeControls() {
            toggleButtons();
            toggleTip();
            var rect = getRect(getActiveInput());
            var left = getRightBtnPadding();
            if (_dom.maskBtn && _dom.maskBtn.style.display !== "none") {
                left += cssFloat(_dom.maskBtn, "width");
                setRect(_dom.maskBtn, { top: rect.top, left: rect.left + rect.width - left, height: rect.height });
            }
            if (_dom.genBtn && _dom.genBtn.style.display !== "none") {
                left += cssFloat(_dom.genBtn, "width");
                setRect(_dom.genBtn, { top: rect.top, left: rect.left + rect.width - left, height: rect.height });
                _dom.genBtnInner.style.marginTop = Math.max(0, Math.round((rect.height - 19) / 2)) + "px";
            }
            if (_dom.placeholder && _dom.placeholder.style.display !== "none") {
                setRect(_dom.placeholder, { top: rect.top, left: rect.left + 7, height: rect.height });
            }
            if (_dom.tip && _dom.tip.style.display !== "none") {
                setRect(_dom.tip, { left: rect.left, top: rect.top + rect.height, width: rect.width });
            }
        }

        /**
         * Gets padding after right button
         * @returns {number} - padding in px.
         */
        function getRightBtnPadding() {
            var paddingRight = cssFloat(getActiveInput(), "paddingRight");
            return Math.max(BUTTONS_PADDING_RIGHT, paddingRight);
        }

        /**
         * Shows or hides buttons depending on the controls state
         */
        function toggleButtons() {
            if (_dom.genBtn) {
                _dom.genBtn.style.display = _isInputHover || _isInputFocused && !_passHidesGenBtn ? "block" : "none";
            }
            if (_dom.maskBtn) {
                _dom.maskBtn.style.display = _isInputHover || _isInputFocused && !_passHidesMaskBtn ? "block" : "none";
            }
        }

        /**
         * Toggles tip visibility
         */
        function toggleTip() {
            if (!_opts.showTip) {
                return;
            }
            if (_dom.tip) {
                _dom.tip.style.display = (_warningShown && _isInputFocused) ? "block" : "none";
            } else {
                if (_warningShown && _isInputFocused) {
                    if (!_bootstrapPopoverShownText || (_tipHtml !== _bootstrapPopoverShownText)) {
                        var data = $(_dom.mainInput).data("popover") || $(_dom.mainInput).data("bs.popover");
                        var opts = data.options;
                        var animationBackup = opts.animation;
                        if (_bootstrapPopoverShownText)
                            opts.animation = false;
                        // set popover width (Bootstrap popovers doesn't support width setting, so we'll apply a hack)
                        var width = getActiveInput().offsetWidth - 2;
                        var el = data.$tip;
                        if (el) {
                            el.width(width);
                        } else if (data.options.template) {
                            data.options.template = data.options.template.replace("class=\"popover\"", "class=\"popover\" style=\"width: " + width + "px\"");
                        }
                        if (_dom.clearInput) {
                            data.$element = $(getActiveInput());
                        }
                        $(_dom.mainInput).popover("show");
                        _bootstrapPopoverShownText = _tipHtml;
                        opts.animation = animationBackup;
                    }
                } else {
                    if (_bootstrapPopoverShownText) {
                        _bootstrapPopoverShownText = null;
                        $(_dom.mainInput).popover("hide");
                    }
                }
            }
        }

        /**
         * Detects browser features support
         * Fills in _features variable
         */
        function detectFeatures() {
            var supportsPlaceholder = true;
            var changeType = true;
            var test = document.createElement("input");
            if (!("placeholder" in test)) {
                supportsPlaceholder = false;
            }
            test.setAttribute("style", "position:absolute;left:-10000px;top:-10000px;");
            document.body.appendChild(test);
            try {
                test.setAttribute("type", "password");
            } catch (err) {
                changeType = false;
            }
            document.body.removeChild(test);

            var box = document.createElement("div");
            box.setAttribute("style", "display:inline-block");
            box.style.paddingLeft = box.style.width = "1px";
            document.body.appendChild(box);
            var isBoxModel = box.offsetWidth === 2;
            var hasInlineBlock = css(box, "display") === "inline-block";
            document.body.removeChild(box);

            var passSymbol = navigator.userAgent.indexOf("AppleWebKit") >= 0 || navigator.userAgent.indexOf("Opera") >= 0 ||
                navigator.userAgent.indexOf("Firefox") >= 0 && navigator.platform.indexOf("Mac") >= 0 ?
                /*BULLET*/"\u2022" : /*BLACK CIRCLE*/"\u25cf";

            _features = {
                placeholders: supportsPlaceholder,
                changeType: changeType,
                boxModel: isBoxModel,
                hasInlineBlock: hasInlineBlock,
                passSymbol: passSymbol
            };
        }

        /**
         * Gets currently active input
         * @return {HTMLInputElement} - currently active input.
         */
        function getActiveInput() {
            return _isMasked ? _dom.mainInput : _dom.clearInput || _dom.mainInput;
        }

        /**
         * Binds handler events to DOM nodes
         */
        function bindEvents() {
            utils.each(_dom.clearInput ? [_dom.mainInput, _dom.clearInput] : [_dom.mainInput], function (el) {
                utils.attachEvent(el, "onkeyup", handleInputKeyup);
                utils.attachEvent(el, "onfocus", handleInputFocus);
                utils.attachEvent(el, "onblur", handleInputBlur);
                utils.attachEvent(el, "onmouseover", handleMouseEvent);
                utils.attachEvent(el, "onmouseout", handleMouseEvent);
                if (_dom.placeholder) {
                    utils.attachEvent(el, "onkeydown", handleInputKeydown);
                }
            });

            utils.attachEvent(window, "onresize", resizeControls);

            if (_dom.maskBtn) {
                utils.attachEvent(_dom.maskBtn, "onclick", function() { toggleMasking(); });
                utils.attachEvent(_dom.maskBtn, "onmouseover", handleMouseEvent);
                utils.attachEvent(_dom.maskBtn, "onmouseout", handleMouseEvent);
            }

            if (_dom.genBtn) {
                utils.attachEvent(_dom.genBtn, "onclick", function() { generatePassword(); });
                utils.attachEvent(_dom.genBtn, "onmouseover", handleMouseEvent);
                utils.attachEvent(_dom.genBtn, "onmouseout", handleMouseEvent);
            }

            if (_dom.placeholder) {
                utils.attachEvent(_dom.placeholder, "onclick", handlePlaceholderClicked);
            }

            if (_opts.nonMatchField) {
                var el = getEl(_opts.nonMatchField);
                if (el) {
                    utils.attachEvent(el, "onkeyup", handleLoginChanged);
                }
            }
        }

        /**
         * Handles fake placeholder click event
         */
        function handlePlaceholderClicked() {
            getActiveInput().focus();
        }

        /**
         * Handles MouseOver and MouseOut events
         * sets _inputHover state
         * @param {object} e - event
         */
        function handleMouseEvent(e) {
            var isInside = e.type === "mouseover";
            var el = e.relatedTarget ? e.relatedTarget : isInside ? e.fromElement : e.toElement;
            if (el && el.id && (el.id.indexOf(ELEMENTS_PREFIX + "btn") === 0 || el === _dom.mainInput || el === _dom.clearInput))
                return;
            _isInputHover = isInside;
            resizeControls();
        }

        /**
         * Input received keyup
         * @param {Event} [e] - event
         */
        function handleInputKeyup(e) {
            var keyCode = e ? e.which || e.keyCode : null;
            var isDelete = keyCode === KEY_BACKSPACE || keyCode === KEY_DELETE;
            var val;
            if (_dom.clearInput) {
                if (_isMasked) {
                    val = _dom.clearInput.value = _dom.mainInput.value;
                } else {
                    val = _dom.mainInput.value = _dom.clearInput.value;
                }
            } else {
                val = _dom.mainInput.value;
            }
            if (_opts.strengthCheckTimeout > 0 && !_warningShown && !isDelete) {
                if (_validateTimer) {
                    clearTimeout(_validateTimer);
                }
                _validateTimer = setTimeout(validatePassword, _opts.strengthCheckTimeout);
            } else {
                validatePassword();
            }
            if (_dom.placeholder && !val) {
                _dom.placeholder.style.display = "block";
            }
            hideButtonsByPassLength();
        }

        /**
         * Hides buttons if the password is too long
         */
        function hideButtonsByPassLength() {
            if (!_dom.passLengthChecker)
                return;
            var pass = getActiveInput().value;
            if (_isMasked)
                pass = pass.replace(/./g, _features.passSymbol);
            setHtml(_dom.passLengthChecker, pass);
            var passWidth = _dom.passLengthChecker.offsetWidth;
            passWidth += cssFloat(_dom.mainInput, "paddingLeft");
            var maskBtnWidth = 0, genBtnWidth = 0;
            var fieldBounds = getBounds(getActiveInput());
            var fieldWidth = fieldBounds.width;
            var changed = false;
            var btnPadding = getRightBtnPadding();
            if (_dom.maskBtn) {
                maskBtnWidth = cssFloat(_dom.maskBtn, "width");
                var maskBtnLeft = fieldWidth - maskBtnWidth - btnPadding;
                var passHidesMaskBtn = passWidth > maskBtnLeft;
                if (_passHidesMaskBtn !== passHidesMaskBtn) {
                    changed = true;
                    _passHidesMaskBtn = passHidesMaskBtn;
                }
            }
            if (_dom.genBtn) {
                genBtnWidth = cssFloat(_dom.genBtn, "width");
                var genBtnLeft = fieldWidth - maskBtnWidth - genBtnWidth - btnPadding;
                var passHidesGenBtn = passWidth > genBtnLeft;
                if (_passHidesGenBtn !== passHidesGenBtn) {
                    changed = true;
                    _passHidesGenBtn = passHidesGenBtn;
                }
            }
            if (changed) {
                resizeControls();
            }
        }

        /**
         * Input received KeyDown
         */
        function handleInputKeydown() {
            // Here we support old browsers and remove placeholder
            if (_dom.placeholder) {
                _dom.placeholder.style.display = "none";
            }
        }

        /**
         * Input is focused
         */
        function handleInputFocus() {
            if (_blurTimer) {
                clearTimeout(_blurTimer);
                _blurTimer = null;
            }
            if (_blurMaskTimer) {
                clearTimeout(_blurMaskTimer);
                _blurMaskTimer = null;
            }
            _isInputFocused = true;
            resizeControls();
        }

        /**
         * Input is blurred
         */
        function handleInputBlur() {
            _blurTimer = setTimeout(function() {
                _blurTimer = null;
                _isInputFocused = false;
                resizeControls();
                // if the password has not been masked my default, toggle mode after inactivity
                if (_opts.isMasked && !_blurMaskTimer) {
                    _blurMaskTimer = setTimeout(function() {
                        _blurMaskTimer = null;
                        toggleMasking(true, false);
                    }, 1500);
                }
            }, 100);
        }

        /**
         * Login changed in login field
         */
        function handleLoginChanged() {
            if (_warningShown) {
                validatePassword();
            }
        }

        /**
         * Toggles masking state
         * @param  {Boolean} [isMasked] - should we display the password masked (undefined or null = change masking)
         * @param {Boolean} [needFocus] - should we focus the field after changing
         */
        function toggleMasking(isMasked, needFocus) {
            if (needFocus === undefined)
                needFocus = true;

            var eventHappened = isMasked !== _isMasked;
            if (isMasked === undefined)
                isMasked = !_isMasked;
            else
                isMasked = !!isMasked;

            if (_features.changeType) {
                var el = getActiveInput();
                var sel = getSelection(el);
                el.setAttribute("type", isMasked ? "password" : "text");
                if (needFocus) {
                    setSelection(el, sel);
                    el.focus();
                }
            } else {
                var currentDisplayMode = css(getActiveInput(), "display") || "block";
                var currentInput = isMasked ? _dom.clearInput : _dom.mainInput;
                var nextInput = isMasked ? _dom.mainInput : _dom.clearInput;
                if (_isMasked !== isMasked) {
                    // LastPass could insert style attributes here: we'll copy them to clear input (if any)
                    utils.each(["paddingRight", "width", "backgroundImage", "backgroundPosition", "backgroundRepeat", "backgroundAttachment", "border"], function (prop) {
                        var cur = currentInput.style[prop];
                        if (cur) {
                            nextInput.style[prop] = cur;
                        }
                    });
                }
                var selection = getSelection(currentInput);
                nextInput.style.display = currentDisplayMode;
                currentInput.style.display = "none";
                nextInput.value = currentInput.value;
                if (needFocus) {
                    setSelection(nextInput, selection);
                    nextInput.focus();
                }

                // jQuery.validation can insert error label right after our input, so we'll handle it here
                if (_dom.mainInput.nextSibling !== _dom.clearInput) {
                    insertAfter(_dom.mainInput, _dom.clearInput);
                }
            }
            if (_dom.maskBtn) {
                setHtml(_dom.maskBtn, isMasked ? _opts.maskBtn.textMasked : _opts.maskBtn.textUnmasked);
                if (isMasked) {
                    if (_opts.maskBtn.classUnmasked)
                        removeClass(_dom.maskBtn, _opts.maskBtn.classUnmasked, true);
                    if (_opts.maskBtn.classMasked)
                        addClass(_dom.maskBtn, _opts.maskBtn.classMasked, true);
                } else {
                    if (_opts.maskBtn.classMasked)
                        removeClass(_dom.maskBtn, _opts.maskBtn.classMasked, true);
                    if (_opts.maskBtn.classUnmasked)
                        addClass(_dom.maskBtn, _opts.maskBtn.classUnmasked, true);
                }
                _dom.maskBtn.title = isMasked ? _locale.msg.showPass : _locale.msg.hidePass;
            }

            _isMasked = isMasked;
            hideButtonsByPassLength();
            resizeControls();

            if (eventHappened) {
                triggerEvent("switched", _isMasked);
            }
        }

        /**
         * Gets selected text indices in input
         * @param {HTMLInputElement} el - element to get the selection
         * @returns {{ start: Number, end: Number }} - selection.
         */
        function getSelection(el) {
            if (typeof el.selectionStart === "number" && typeof el.selectionEnd === "number") {
                return { start: el.selectionStart, end: el.selectionEnd };
            }
            return null;
        }

        /**
         * Sets selection in input
         * @param {HTMLInputElement} el - element to set the selection
         * @param {{ start: Number, end: Number }} selection - selection.
         */
        function setSelection(el, selection) {
            if (!selection)
                return;
            if (typeof el.selectionStart === "number" && typeof el.selectionEnd === "number") {
                el.selectionStart = selection.start;
                el.selectionEnd = selection.end;
            }
        }

        /**
         * If the element has autofocus attribute, we'll check it and focus if necessary
         */
        function doAutofocus() {
            if (typeof _dom.mainInput.hasAttribute === "function" && _dom.mainInput.hasAttribute("autofocus") || _dom.mainInput.getAttribute("autofocus")) {
                _dom.mainInput.focus();
                handleInputFocus();
            }
        }

        /**
         * Generates random password and inserts it to the field
         */
        function generatePassword() {
            var pass = createRandomPassword();
            _dom.mainInput.value = pass;
            if (_dom.clearInput) {
                _dom.clearInput.value = pass;
            }
            triggerEvent("generated", pass);
            toggleMasking(false);

            if (_validateTimer) {
                clearTimeout(_validateTimer);
                _validateTimer = null;
            }
            validatePassword();

            if (_dom.placeholder) {
                _dom.placeholder.style.display = "none";
            }
        }

        /**
         * Validates the password and shows an alert if need
         * @return {Boolean} - is the password valid.
         */
        function validatePassword() {
            if (_validateTimer) {
                clearTimeout(_validateTimer);
                _validateTimer = null;
            }
            var pass = getActiveInput().value;
            var checkResult = calculateStrength(pass);

            if (pass.length === 0) {
                checkResult = { strength: _opts.allowEmpty ? 0 : null, messages: [_locale.msg.passRequired] };
            } else {
                // check: contains bad chars
                if (!_opts.allowAnyChars && checkResult.charTypes[PassField.CharTypes.UNKNOWN]) {
                    checkResult = { strength: null, messages: [_locale.msg.badChars.replace("{}", checkResult.charTypes[PassField.CharTypes.UNKNOWN])] };
                }
                delete checkResult.charTypes;

                // check: blacklist
                var isInBlackList = false;
                var passLower = pass.toLowerCase();
                utils.each(_opts.blackList, function(el) {
                    if (el === passLower) {
                        isInBlackList = true;
                        return false;
                    }
                    return true;
                });
                if (isInBlackList) {
                    checkResult = { strength: 0, messages: [_locale.msg.inBlackList] };
                }

                // check equal to login
                if (pass && pass === getNonMatchingFieldValue()) {
                    checkResult = { strength: 0, messages: [_locale.msg.equalTo] };
                }
            }
            // check: external (if present)
            if (typeof _opts.validationCallback === "function") {
                var externalResult = _opts.validationCallback(_dom.mainInput, checkResult);
                var returnedMessages;
                var returnedStrength;
                if (externalResult && externalResult.messages && utils.isArray(externalResult.messages)) {
                    returnedMessages = externalResult.messages;
                }
                if (externalResult && Object.prototype.hasOwnProperty.call(externalResult, "strength") &&
                    ((typeof externalResult.strength === "number") || (externalResult.strength === null))) {
                    returnedStrength = externalResult.strength;
                }
                if (returnedMessages && returnedMessages.length) {
                    // both messages and strength are replaced with custom messages
                    checkResult.messages = returnedMessages;
                    checkResult.strength = returnedStrength;
                } else {
                    // no message is provided; strength can only be increased
                    if (returnedStrength && returnedStrength > checkResult.strength) {
                        checkResult.strength = returnedStrength;
                    }
                    // else:
                    //      We have been told: "the password is invalid/weak".
                    //      But why? There's no explanation given (in messages) and we can't guess the reason.
                    //      We'll not show such unknown errors to the user and disregard returned strength.
                }
            }

            if (pass.length === 0 && _opts.allowEmpty) {
                // empty but ok
                hidePasswordWarning();
                _validationResult = { strength: 0 };
                return true;
            } else if (checkResult.strength === null || checkResult.strength < _opts.acceptRate) {
                showPasswordWarning(checkResult.strength, checkResult.messages);
                return false;
            } else { // ok
                hidePasswordWarning();
                _validationResult = { strength: checkResult.strength };
                return true;
            }
        }

        /**
         * Calculates password strength according to pattern
         * @param  {string} pass - password
         * @return {object} - { strength: 0..1 (null for non-valid pass), messages: ["please add numbers"] }.
         */
        function calculateStrength(pass) {
            var charTypesPattern = splitToCharTypes(_opts.pattern, PassField.CharTypes.SYMBOL);
            var charTypesPass = splitToCharTypes(pass, _opts.allowAnyChars ? PassField.CharTypes.SYMBOL : PassField.CharTypes.UNKNOWN);

            var messages = [];

            var charTypesPatternCount = 0;

            utils.each(charTypesPattern, function(charType) {
                charTypesPatternCount++;
                if (!charTypesPass[charType]) {
                    var msg = _locale.msg[charType];
                    if (charType === PassField.CharTypes.SYMBOL) {
                        // we should give example of symbols; for other types this is not required
                        var symbolsCount = 4;
                        var charsExample = _opts.chars[charType];
                        if (charsExample.length > symbolsCount)
                            charsExample = charsExample.substring(0, symbolsCount);
                        msg = msg + " (" + charsExample + ")";
                    }
                    messages.push(msg);
                }
            });
            var strength = 1 - messages.length / charTypesPatternCount;
            if (messages.length) {
                messages = [joinMessagesForCharTypes(messages)];
            }

            if (_opts.checkMode === PassField.CheckModes.MODERATE) {
                var extraCharTypesCount = 0;
                utils.each(charTypesPass, function(charType) {
                    if (!charTypesPattern[charType]) {
                        // cool: the user entered char of type which was not in pattern; +strength!
                        extraCharTypesCount++;
                    }
                });
                strength += extraCharTypesCount / charTypesPatternCount;
            }

            var minPassLength = _opts.pattern.length;
            var lengthRatio = pass.length / minPassLength - 1;
            if (_opts.length && _opts.length.min && pass.length < _opts.length.min) {
                lengthRatio = -10;
                if (_opts.length.min > minPassLength)
                    minPassLength = _opts.length.min;
            }
            if (lengthRatio < 0) {
                strength += lengthRatio;
                messages.push(_locale.msg.passTooShort.replace("{}", minPassLength.toString()));
            } else {
                if (_opts.checkMode === PassField.CheckModes.MODERATE) {
                    strength += lengthRatio / charTypesPatternCount;
                }
            }

            if (pass.length > 2) {
                var firstChar = pass.charAt(0);
                var allEqual = true;
                for (var i = 0; i < pass.length; i++) {
                    if (pass.charAt(i) !== firstChar) {
                        allEqual = false;
                        break;
                    }
                }
                if (allEqual) {
                    strength = 0;
                    messages = [_locale.msg.repeat];
                }
            }

            if (strength < 0) {
                strength = 0;
            }
            // MODERATE checking mode could produce positive results for extra long passwords
            if (strength > 1) {
                strength = 1;
            }

            return { strength: strength, messages: messages, charTypes: charTypesPass };
        }

        /**
         * Joins messages about absesnse of different char types in one message like:
         *      "there are no XXX, YYY and ZZZ in your password"
         * @param messages {string[]} - messages to join.
         * @return {string} - single joined message
         */
        function joinMessagesForCharTypes(messages) {
            var replacement = messages[0];
            for (var i = 1; i < messages.length; i++) {
                if (i === messages.length - 1)
                    replacement += " " + _locale.msg.and + " ";
                else
                    replacement += ", ";
                replacement += messages[i];
            }
            return _locale.msg.noCharType.replace("{}", replacement);
        }

        /**
         * Shows password warning
         * @param  {Number} strength - password strength (null if the password is not valid)
         * @param  {String[]} messages - validation messages
         */
        function showPasswordWarning(strength, messages) {
            var shortErrorText = "";
            var errorText = "";

            if (strength === null) {
                shortErrorText = _locale.msg.invalidPassWarn;
                errorText = messages[0].charAt(0).toUpperCase() + messages[0].substring(1);
            } else {
                shortErrorText = _locale.msg.weakWarn;
                errorText = "";
                if (messages) {
                    for (var i = 0; i < messages.length; i++) {
                        var firstLetter = messages[i].charAt(0);
                        if (i === 0) {
                            errorText += _locale.msg.weakTitle + ": ";
                            if (_locale.lower)
                                firstLetter = firstLetter.toLowerCase();
                        } else {
                            errorText += "<br/>";
                            firstLetter = firstLetter.toUpperCase();
                        }
                        errorText += firstLetter + messages[i].substring(1);
                        if (errorText && (errorText.charAt(errorText.length - 1) !== "."))
                            errorText += ".";
                    }
                }
            }
            if (errorText && (errorText.charAt(errorText.length - 1) !== "."))
                errorText += ".";
            _validationResult = { strength: strength, message: errorText };

            if (_dom.warnMsg) {
                setHtml(_dom.warnMsg, shortErrorText);
                _dom.warnMsg.title = errorText;
                if (_opts.errorWrapClassName) {
                    addClass(_dom.wrapper, _opts.errorWrapClassName, true);
                }
                if (shortErrorText)
                    removeClass(_dom.warnMsg, "empty");
                else
                    addClass(_dom.warnMsg, "empty");
            }
            if (_opts.showTip) {
                var html = errorText;
                if (_dom.genBtn) {
                    html += "<br/>" + _locale.msg.generateMsg.replace("{}", "<div class=\"" + formatClass("btn-gen-help") + "\"></div>");
                }
                _tipHtml = html;
                if (_dom.tipBody) {
                    setHtml(_dom.tipBody, html);
                }
            }

            _warningShown = true;
            resizeControls();
        }

        /**
         * Hides password warning
         */
        function hidePasswordWarning() {
            if (_dom.warnMsg) {
                setHtml(_dom.warnMsg, "");
                _dom.warnMsg.title = "";
                if (_opts.errorWrapClassName) {
                    removeClass(_dom.wrapper, _opts.errorWrapClassName, true);
                }
                addClass(_dom.warnMsg, "empty");
            }
            _tipHtml = null;
            _warningShown = false;
            resizeControls();
        }

        /**
         * Returns the value of field with which the password is compared
         * @return {String} - field value or null if we don't need this
         */
        function getNonMatchingFieldValue() {
            if (!_opts.nonMatchField)
                return null;
            var field = getEl(_opts.nonMatchField);
            if (!field)
                return null;
            return field.value;
        }

        /**
         * Gets message for last password validation
         * @return {String} - last validation message.
         */
        function getPassValidationMessage() {
            return _validationResult ? _validationResult.message : null;
        }

        /**
         * Gets strength measured during last password validation
         * @return {Number|Object} - last measured strength: -1 = not measured; null = pass not valid, Number = strength [0..1].
         */
        function getPassStrength() {
            return _validationResult ? _validationResult.strength : -1;
        }

        /**
         * Creates random sequence by pattern
         * @return {string} - generated password.
         */
         function createRandomPassword() {
            var result = "";
            var charTypes = splitToCharTypes(_opts.pattern, PassField.CharTypes.SYMBOL);
            // We're creating an array of charTypes and shuffling it.
            // In such way, generated password will contain exactly the same number of character types as was defined in pattern
            var charTypesSeq = [];
            utils.each(charTypes, function(charType, chars) {
                for (var j = 0; j < chars.length; j++) {
                    charTypesSeq.push(charType);
                }
            });
            charTypesSeq.sort(function() { return 0.7 - Math.random(); });
            utils.each(charTypesSeq, function(charType) {
                var sequence = _conf.generationChars[charType];
                if (sequence) {
                    if (_opts.chars[charType] && _opts.chars[charType].indexOf(sequence) < 0)
                        sequence = _opts.chars[charType]; // overriden without default letters - ok, generate from given chars
                } else {
                    sequence = _opts.chars[charType];
                }
                result += utils.selectRandom(sequence);
            });
            return result;
        }

        /**
         * Determines character types in string
         * @param  {string} str - input string
         * @param  {string} defaultCharType - default character type (if not found in chars)
         * @return {object} - PassField.CharType => chars.
         */
        function splitToCharTypes(str, defaultCharType) {
            var result = {};
            for (var i = 0; i < str.length; i++) {
                var ch = str.charAt(i);
                var type = defaultCharType;
                utils.each(_opts.chars, function(charType, seq) {
                    if (seq.indexOf(ch) >= 0) {
                        type = charType;
                        return false;
                    }
                    return true;
                });
                result[type] = (result[type] || "") + ch;
            }
            return result;
        }

        // ========================== DOM-related functions ==========================

        /**
         * Formats class for this element by adding common prefix
         * Need to ensure there are no conflicts
         * @param  {string} id - class name or id
         * @return {string} - formatted class name or id.
         */
        function formatId(id) {
            return ELEMENTS_PREFIX + id + "-" + _id;
        }

        /**
         * Formats class for this element by adding common prefix
         * Need to ensure there are no conflicts
         * @param  {string} cls - class name or id
         * @return {string} - formatted class name or id.
         */
        function formatClass(cls) {
            return ELEMENTS_PREFIX + cls;
        }

        /**
         * Invokes utils.newEl but adds common prefixes to class and id
         * @param  {string} tagName - tag name of the inserted element
         * @param  {object} attr - attributes of the inserted element
         * @param  {object} [css] - CSS properties to apply
         * @return {object} - created DOM element.
         */
        function newEl(tagName, attr, css) {
            if (attr.id)
                attr.id = formatId(attr.id);
            if (attr.className)
                attr.className = formatClass(attr.className);
            return utils.newEl(tagName, attr, css);
        }

        /**
         * Gets bound rect safely
         * @param {Object} el - DOM element
         * @return {Object} - rect: { top: Number, left: Number }.
         */
        function getBoundingRect(el) {
            try {
                return el.getBoundingClientRect();
            } catch (err) {
                return { top: 0, left: 0 };
            }
        }

        /**
         * Gets element offset
         * @param {Object} el - DOM element
         * @return {Object} - offset: { top: Number, left: Number }.
         */
        function offset(el) {
            var doc = el.ownerDocument;
            if (!doc) {
                return { top: 0, left: 0 };
            }
            var box = getBoundingRect(el);
            return {
                top: box.top + (window.pageYOffset || 0) - (doc.documentElement.clientTop || 0),
                left: box.left + (window.pageXOffset || 0) - (doc.documentElement.clientLeft || 0)
            };
        }

        /**
         * Gets offset parent for element
         * @param {Object} el - DOM element
         * @return {Function|HTMLElement|Element|Element} - offset parent.
         */
        function offsetParent(el) {
            var op;
            try { op = el.offsetParent; }
            catch (e) { }
            if (!op)
                op = document.documentElement;
            while (op && (op.nodeName.toLowerCase() !== "html") && css(op, "position") === "static") {
                op = op.offsetParent;
            }
            return op || document.documentElement;
        }

        /**
         * Gets element position
         * @param {Object} el - DOM element
         * @return {Object} - offset: { top: Number, left: Number }.
         */
        function position(el) {
            var offs, parentOffset = { top: 0, left: 0 };
            if (css(el, "position") === "fixed") {
                offs = getBoundingRect(el);
            } else {
                var op = offsetParent(el);
                offs = offset(el);
                if (op.nodeName.toLowerCase() !== "html") {
                    parentOffset = offset(op);
                }
                parentOffset.top += cssFloat(op, "borderTopWidth");
                parentOffset.left += cssFloat(op, "borderLeftWidth");
            }
            return {
                top: offs.top - parentOffset.top - cssFloat(el, "marginTop"),
                left: offs.left - parentOffset.left - cssFloat(el, "marginLeft")
            };
        }

        /**
         * Get outer width and height for DOM element
         * @param {Object} el - DOM element
         * @return {Object} - bounds: { width: Number, height: Number }.
         */
        function getBounds(el) {
            return { width: el.offsetWidth, height: el.offsetHeight };
        }

        /**
         * Get bounds and position for DOM element
         * @param {Object} el - DOM element
         * @return {Object} - bounds and offset combined.
         */
        function getRect(el) {
            return utils.extend(offset(el), getBounds(el));
        }

        /**
         * Sets bounds and offset
         * @param {Object} el - DOM element
         * @param {Object} rect - coords to set
         */
        function setRect(el, rect) {
            if (rect.height && !isNaN(rect.height)) {
                el.style.height = rect.height + "px";
                el.style.lineHeight = rect.height + "px";
            }
            if (rect.width && !isNaN(rect.width)) {
                el.style.width = rect.width + "px";
            }
            if (rect.top || rect.left) {
                if (css(el, "display") === "none") {
                    el.style.top = rect.top + "px";
                    el.style.left = rect.left + "px";
                    return;
                }
                var curLeft, curTop, curOffset;

                curOffset = offset(el);
                curTop = css(el, "top") || 0;
                curLeft = css(el, "left") || 0;

                if ((curTop + curLeft + "").indexOf("auto") > -1) {
                    var pos = position(el);
                    curTop = pos.top;
                    curLeft = pos.left;
                } else {
                    curTop = parseFloat(curTop) || 0;
                    curLeft = parseFloat(curLeft) || 0;
                }

                if (rect.top) {
                    el.style.top = ((rect.top - curOffset.top) + curTop) + "px";
                }
                if (rect.left) {
                    el.style.left = ((rect.left - curOffset.left) + curLeft) + "px";
                }
            }
        }

        /**
         * Gets CSS property (including inherited)
         * @param {Object|HTMLElement} el - DOM element
         * @param {String} prop - CSS property name
         * @return {String} - property value.
         */
        function css(el, prop) {
            var st = typeof window.getComputedStyle === "function" ? window.getComputedStyle(el, null) : el.currentStyle;
            return st ? st[prop] : null;
        }

        /**
         * Gets CSS property and parses the value as float
         * @param {Object} el - DOM element
         * @param {String} prop - CSS property name
         * @return {Number} - parsed property value.
         */
        function cssFloat(el, prop) {
            var v = css(el, prop);
            if (!v)
                return 0;
            var parsed = parseFloat(v);
            return isNaN(parsed) ? 0 : parsed;
        }

        /**
         * Inserts DOM node after another
         * @param {Object} target - target node
         * @param {Node} el - new node
         */
        function insertAfter(target, el) {
            if (target.parentNode)
                target.parentNode.insertBefore(el, target.nextSibling);
        }

        /**
         * Inserts DOM node before another
         * @param {Object} target - target node
         * @param {Node} el - new node
         */
        function insertBefore(target, el) {
            if (target.parentNode)
                target.parentNode.insertBefore(el, target);
        }

        /**
         * Sets innerHTML in element
         * @param {Object} el - DOM element
         * @param {String} html - HTML to set
         */
        function setHtml(el, html) {
            try {
                el.innerHTML = html;
            } catch (err) {
                // browser doesn't support innerHTML or it's readonly
                var newNode = document.createElement("c");
                newNode.innerHTML = html;
                while (el.firstChild) {
                    el.removeChild(el.firstChild);
                }
                el.appendChild(newNode);
            }
        }

        /**
         * Gets DOM element my ID or jQuery selector or DOM element
         * @param el {object|string|jQuery} - element
         * @returns {object} - DOM element
         */
        function getEl(el) {
            if (typeof el === "string") {
                return document.getElementById(el);
            }
            if (el.jquery) {
                return el[0];
            }
            return el;
        }

        /**
         * Adds class to element
         * @param {object} el - element
         * @param {string} cls - class name
         * @param {Boolean} [raw=false] - is given class name raw (without prefix)
         */
        function addClass(el, cls, raw) {
            if (hasClass(el, cls, raw))
                return;
            el.className = el.className + (el.className ? " " : "") + (raw === true ? cls : formatClass(cls));
        }

        /**
         * Removes class from element
         * @param  {object} el - element
         * @param  {string} cls - class name
         * @param {Boolean} [raw=false] - is given class name raw (without prefix)
         */
        function removeClass(el, cls, raw) {
            if (!hasClass(el, cls, raw))
                return;
            el.className = (" " + el.className + " ").replace((raw === true ? cls : formatClass(cls)) + " ", "").replace(/^\s+|\s+$/g, "");
        }

        /**
         * Checks whether element has class
         * @param  {object} el - element
         * @param  {string} cls - class name
         * @param {Boolean} [raw=false] - is given class name raw (without prefix)
         * @return {Boolean} - whether the element has the class.
         */
        function hasClass(el, cls, raw) {
            cls = " " + (raw === true ? cls : formatClass(cls)) + " ";
            return (" " + el.className + " ").replace(/[\n\t]/g, " ").indexOf(cls) > -1;
        }

        /**
         * Triggers event
         * Event is searched in opts.events.<event_name> and called if present
         * If jQuery is present, jQuery event (pass:<event_name>) is also triggered
         * @param {string} name - event name
         * @param arg - event argument
         */
        function triggerEvent(name, arg) {
            if ($) {
                try { $(_dom.mainInput).trigger(JQUERY_EVENT_PREFIX + name, arg); }
                catch (err) {}
            }
            if (_opts.events && typeof _opts.events[name] === "function") {
                try { _opts.events[name].call(_dom.mainInput, arg); }
                catch (err) {}
            }
        }

        /**
         * Assigns data attribute for jQuery
         */
        function assignDataObject(prop, obj) {
            if ($) {
                $(_dom.mainInput).data(prop, obj);
            }
        }
    };

    // ========================== utility ==========================

    /**
     * Internal utility functions
     */
    var utils = {};

    /**
     * Almost the same as jQuery extend
     * @return {object} first arg, extended with others.
     */
    utils.extend = function() {
        var arg = arguments;
        for (var i = 1; i < arg.length; i++) {
            utils.each(arg[i], function (key, value) {
                if (utils.isArray(arg[0][key]) || utils.isArray(value)) {
                    arg[0][key] = arg[0][key] ? arg[0][key].concat(value || []) : value;
                } else if (utils.isElement(value)) {
                    arg[0][key] = value;
                } else if (typeof arg[0][key] === "object" && typeof value === "object" && value !== null) {
                    arg[0][key] = utils.extend({}, arg[0][key], value);
                } else if (typeof value === "object" && value !== null) {
                    arg[0][key] = utils.extend({}, value);
                } else {
                    arg[0][key] = value;
                }
            });
        }
        return arg[0];
    };

    /**
     * Creates DOM element
     * @param  {string} tagName - tag name of the inserted element
     * @param  {object} [attr] - attributes of the inserted element
     * @param  {object} [css] - CSS properties to apply
     * @return {object} - created DOM element.
     */
    utils.newEl = function(tagName, attr, css) {
        var el = document.createElement(tagName);
        if (attr) {
            utils.each(attr, function(key, value) {
                if (value)
                    el[key] = value;
            });
        }
        if (css) {
            utils.each(css, function(key, value) {
                if (value)
                    el.style[key] = value;
            });
         }
        return el;
    };

    /**
     * Attaches event to element
     * @param  {object} el - DOM element
     * @param  {string} event - event name
     * @param  {function} handler - handler to attach
     */
    utils.attachEvent = function(el, event, handler) {
        var oldHandler = el[event];
        el[event] = function(e) {
            if (!e)
                e = window.event;
            handler(e);
            if (typeof oldHandler === "function") {
                oldHandler(e);
            }
        };
    };

    /**
     * Iterates the collection or object attrs
     * @param  {object|object[]|string[]} obj - object or collection to iterate
     * @param  {function} fn - function to invoke on each element
     */
    utils.each = function(obj, fn) {
        if (utils.isArray(obj)) {
            for (var i = 0; i < obj.length; i++) {
                if (fn(obj[i]) === false)
                    return;
            }
        } else {
            for (var key in obj) {
                if (Object.prototype.hasOwnProperty.call(obj, key)) {
                    if (fn(key, obj[key]) === false)
                        return;
                }
            }
        }
    };

    /**
     * Check whether the object is array
     * @param  {object}  obj - object to check
     * @return {Boolean} - array or not.
     */
    utils.isArray = function(obj) {
        return Object.prototype.toString.call(obj) === "[object Array]";
    };

    /**
     * Check whether the object is DOM element or jQuery object
     * @param {object} obj - object to check
     * @return {Boolean} - element or not.
     */
    utils.isElement = function(obj) {
        if (!obj)
            return false;
        try {
            return obj instanceof HTMLElement || $ && obj instanceof $;
        }
        catch (err) {
            return typeof obj === "object" && obj.nodeType || obj.jquery;
        }
    };

    /**
     * Selects random element from collection
     * @param  {object} arr - collection
     * @return {object} - random element.
     */
    utils.selectRandom = function(arr) {
        var pos = Math.floor(Math.random() * arr.length);
        return utils.isArray(arr) ? arr[pos] : arr.charAt(pos);
    };

    /**
     * Checks whether array contains item
     * @param  {Array} arr - array
     * @param  {object} item - item to check (strictly)
     * @return {Boolean} - contains or not.
     */
    utils.contains = function(arr, item) {
        if (!arr)
            return false;
        var result = false;
        utils.each(arr, function (el) {
            if (el === item) {
                result = true;
                return false;
            }
            return true;
        });
        return result;
    };

    // ========================== jQuery plugin ==========================

    if ($) {
        /**
         * passField jQuery plugin. Usage: $(selector).passField(options);
         * @param  {object} [opts] - options
         * @return {object} - jQuery object.
         */
        $.fn.passField = function(opts) {
            return this.each(function() {
                new PassField.Field(this, opts);
            });
        };

        /**
         * Toggles masking state
         * @param  {Boolean} [isMasked] - should we display the password masked (undefined or null = change masking)
         * @return {object} - jQuery object.
         */
        $.fn.togglePassMasking = function(isMasked) {
            return this.each(function() {
                var pf = $(this).data(PassField.Config.dataAttr);
                if (pf) {
                    pf.toggleMasking(isMasked);
                }
            });
        };

        /**
         * Sets password value in field
         * @param {String} val - value to set
         * @return {object} - jQuery object.
         */
        $.fn.setPass = function(val) {
            return this.each(function() {
                var pf = $(this).data(PassField.Config.dataAttr);
                if (pf) {
                    pf.setPass(val);
                }
            });
        };

        /**
         * Validates the password
         * @return {Boolean} - is the password valid.
         */
        $.fn.validatePass = function() {
            var isValid = true;
            this.each(function() {
                var pf = $(this).data(PassField.Config.dataAttr);
                if (pf && !pf.validatePass()) {
                    isValid = false;
                }
            });
            return isValid;
        };

        /**
         * Gets message for last password validation
         * @return {String} - last validation message.
         */
        $.fn.getPassValidationMessage = function() {
            var el = this.first();
            if (el) {
                var pf = el.data(PassField.Config.dataAttr);
                if (pf) {
                    return pf.getPassValidationMessage();
                }
            }
            return null;
        };

        /**
         * Gets message for last password validation
         * @return {String} - last validation message.
         */
        $.fn.getPassStrength = function () {
            var el = this.first();
            if (el) {
                var pf = el.data(PassField.Config.dataAttr);
                if (pf) {
                    return pf.getPassStrength();
                }
            }
            return null;
        };
    }

    // ========================== jQuery.Validation plugin ==========================

    if ($ && $.validator) {
        $.validator.addMethod("passfield", function(val, el) {
            return $(el).validatePass(); // this will set validation message
        }, function(val, el) { return $(el).getPassValidationMessage(); });
    }
})(window.jQuery, document, window);
