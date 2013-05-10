/**
 * jQuery radio button group
 * Date: 09.05.13 11:01
 */
(function($){
    $.fn.radioButtonGroupUnchek = function(o){
        return this.each(function(){
            var el = $(this),
                hfId;

            if(o.hiddenFieldId === undefined)
            {
                hfId = el.attr('data-hfId');
            }
            else
            {
                hfId = o.hiddenFieldId;
            }
            $('button', el).on('click', function(){
                var value = $(this).val(),
                    hfEl = $('#' + hfId),
                    hfVal = hfEl.val();
                if(hfVal != '' && hfVal == value)
                {
                    $(this).removeClass('active');
                    hfEl.val('').trigger('change');
                    return false;
                }
                else
                {
                    hfEl.val(value).trigger('change');
                }
            });
        });
    };
})(jQuery);

$(function(){
    $('.rbgluncheck').radioButtonGroupUnchek({
    });
});
