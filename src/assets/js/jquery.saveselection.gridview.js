(function($){

  var checkedItems = [];

  /**
   * Init events for Bulk Actions
   * @param id string the ID of the grid view container
   */
  $.fn.yiiGridView.initBulkActions = function (id) {
    
    $(document).on("click change", "#"+id+" input[type=checkbox]", function() {
    	
    	var grid = $('#'+id);
    	if ($(this).val()) {
			if ($(this).is(':checked')) {
				if (this.id==id+'_c0_all'){
					$("#"+id+' tbody input[type=checkbox]:checked').each(function() {
							if (checkedItems.indexOf($(this).val())<0) {
								checkedItems.push($(this).val());
							}
						})
				}else{
					if (checkedItems.indexOf($(this).val())<0) {
						checkedItems.push($(this).val());
					}
				}
			} else {
				if (this.id==id+'_c0_all'){
					$("#"+id+' tbody input[type=checkbox]').each(function() {
						if (checkedItems.indexOf($(this).val())>0) {
								console.log($(this).val())
								
								checkedItems.splice( $.inArray($(this).val(), checkedItems), 1 );
						}	
						})
				}else{
					
					checkedItems.pop($(this).val());
				}
			}
		}
		if (checkedItems.length)
		{

	        $(".bulk-actions-btn", grid).removeClass("disabled");
	        $("div.bulk-actions-blocker",grid).hide();
    	} else {
    		$(".bulk-actions-btn", grid).addClass("disabled");
    		$("div.bulk-actions-blocker",grid).show();
    	}
    });
  };

  /**
   * Updating checkboxes after grid ajax updating
   * @param id string the ID of the grid view container
   */
  $.fn.yiiGridView.afterUpdateGrid = function (id) {
	  
    if (checkedItems.length>0) {
    	
    	var grid = $('#'+id);
    	 
    	$(".bulk-actions-btn", grid).removeClass("disabled");
    	$("div.bulk-actions-blocker",grid).hide();
    	$.each(checkedItems, function(index, item) {
        var row = $("input[value="+item.replace(/[\-\[\]\/\{\}\(\)\*\+\?\.\\\^\$\|]/g, "\\$&")+"]", grid);
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
  $.fn.yiiGridView.getCheckedItems = function (id) {
	  
	  //return $("#"+id+' tbody input[type=checkbox]:checked').map(function() { return $(this).val(); }).get();
	  return checkedItems;
  }
	
	/**
   * Returns array of checked items ids
   * @returns {Array}
   */
  $.fn.yiiGridView.getPageCheckedItems = function (id) {
	  
	  return $("#"+id+' tbody input[type=checkbox]:checked').map(function() { return $(this).val(); }).get();
	  
  }

  


})(jQuery);
