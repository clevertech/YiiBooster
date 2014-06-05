/* =========================================================
 * rewritten by Amr Bedair <amr.bedair@gmail.com>
 * @since booster v4.0.0-beta-2
 *  
 * ========================================================= */

(function($){

  var checkedItems = [];

  /**
   * Init events for Bulk Actions
   * @param id string the ID of the grid view container
   */
  $.fn.yiiGridView.initBulkActions = function (id) {
	  
    $(document).on("click change", "#"+id+" input[type=checkbox]", function() {
    	
    	var grid = $('#'+id);
    	
    	if ($("#"+id+' tbody input[type=checkbox]:checked').length) {
    	  
        $(".bulk-actions-btn", grid).removeClass("disabled");
        $("div.bulk-actions-blocker", grid).hide();
      } else {
    	  
        $(".bulk-actions-btn", grid).addClass("disabled");
        $("div.bulk-actions-blocker", grid).show();
      }
    });
  };

  /**
   * Updating checkboxes after grid ajax updating
   * @param id string the ID of the grid view container
   */
  $.fn.yiiGridView.afterUpdateGrid = function (id) {
    
    if ($("#"+id+' tbody input[type=checkbox]:checked').length) {
    	
      var grid = $('#'+id);
    	
      $(".bulk-actions-btn", grid).removeClass("disabled");
      $("div.bulk-actions-blocker", grid).hide();
      $.each($("#"+id+' tbody input[type=checkbox]:checked'), function(index, item) {
        var row = $("input[value="+item+"]", grid);
        if (!row.is(':checked'))
          row.attr("checked", "checked");
      });
    }
  };

  /**
   * Returns array of checked items ids
   * @returns {Array}
   */
  $.fn.yiiGridView.getCheckedRowsIds = function (id) {
	return $("#"+id+' tbody input[type=checkbox]:checked').map(function() { return $(this).val(); }).get();
  }


})(jQuery);