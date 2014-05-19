var bootstrapButton, bootstrapTooltip;

(function ($) {
    bootstrapButton = $.fn.button;
    bootstrapTooltip = $.fn.tooltip;
    
    /* fix for #811 based on suggested solution at https://github.com/twbs/bootstrap/issues/4550 */
	$('.dropdown a').click(function(e) {
		e.preventDefault();
		setTimeout($.proxy(function() {
			if ('ontouchstart' in document.documentElement) {
				$(this).siblings('.dropdown-backdrop').off().remove();
			}
		}, this), 0);
	});

})(jQuery);