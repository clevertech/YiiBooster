(function($){

  var checkedItems = [];

  /**
   * Init events for Bulk Actions
   * @param id string the ID of the grid view container
   */
  $.fn.yiiGridView.initBulkActions = function (id)
  {
    var grid = $('#'+id);
    $(document).on("click", "#"+id+" input[type=checkbox]", function(){
      if ($(this).val()) {
        if ($(this).is(':checked')) {
          if (checkedItems.indexOf($(this).val())<0) {
            checkedItems.push($(this).val());
          }
        } else {
          checkedItems.pop($(this).val());
        }
      }
      if (checkedItems.length)
      {
        $(".bulk-actions-btn", grid).removeClass("disabled");
        $("div.bulk-actions-blocker",grid).hide();
      }
      else
      {
        $(".bulk-actions-btn", grid).addClass("disabled");
        $("div.bulk-actions-blocker",grid).show();
      }
    });
  };

  /**
   * Updating checkboxes after grid ajax updating
   * @param id string the ID of the grid view container
   */
  $.fn.yiiGridView.afterUpdateGrid = function (id)
  {
    var grid = $('#'+id);
    if (checkedItems.length>0) {
      $(".bulk-actions-btn", grid).removeClass("disabled");
      $("div.bulk-actions-blocker",grid).hide();
      $.each(checkedItems, function(index, item){
        var row = $("input[value="+item+"]", grid);
        if (!row.is(':checked')) {
          row.attr("checked", "checked");
        }
      });
    }
  };

  /**
   * Returns array of checked items ids
   * @returns {Array}
   */
  $.fn.yiiGridView.getCheckedItems = function ()
  {
    return checkedItems;
  }


})(jQuery);