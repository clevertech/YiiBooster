(function($){
    var originalPos = null;

    var fixHelperDimensions = function(e, tr) {
        originalPos = tr.prevAll().length;
        var $originals = tr.children();
        var $helper = tr.clone();
        $helper.children().each(function(index)
        {
            $(this).width($originals.eq(index).width()+1).height($originals.eq(index).height())
                .css({
                    "border-bottom":"1px solid #ddd"
                });
        });
        return $helper.css("border-right","1px solid #ddd");
    };

    /**
     * Returns the key values of the currently checked rows.
     * @param id string the ID of the grid view container
     * @param column_id string the ID of the column
     * @return array the key values of the currently checked rows.
     */
    $.fn.yiiGridView.sortable = function (id, callback)
    {
        var grid = $('#'+id) ;
        $("tbody", grid).sortable({
            helper: fixHelperDimensions,
            update: function(e,ui){
                // update keys
                var pos = $(ui.item).prevAll().length;
                if(originalPos !== null && originalPos != pos)
                {
                    var keys = grid.children(".keys").children("span");
                    var key = keys.eq(originalPos);

                    if(originalPos < pos)
                    {
                        keys.eq(pos).after(key);
                    }
                    if(originalPos > pos)
                    {
                        keys.eq(pos).before(key);
                    }
                    originalPos = null;
                }
                if($.isFunction(callback))
                {
                    callback(key.text(),pos);
                }
            }
        }).disableSelection();
    };


})(jQuery);