jQuery(function($){
	// Menu
	$(".menu").hover(function(e) {
		$(".menu").removeClass("menu_on");
		$(this).addClass("menu_on");
        $(".sub_menu").hide();
		var sub_menu = $(this).attr("target");
		$("#"+sub_menu).show();
    });
	//$(".sub_menu").hide();
	var th_arr = new Array();
	var id_arr = new Array();
	
	var now_sort = $("#sort").val();
	var now_sorter = $("#sorter").val();
	
	var idx = id_arr.indexOf(now_sort);
	//alert(th_arr[idx]);
	
	$(".tbl_list > thead > tr > th").each(function(index) {
		var txt = $(this).html();
		var id = $(this).attr("var");
		var th = $(this);
		if(id){
			th_arr.push(txt);
			id_arr.push(id);
			if(id == now_sort){
				th.addClass("sort pointer " + now_sorter);
			} else {
				th.addClass("sort pointer");
			}
		}
	});	
	
	$(".sort").click(function(e) {
		var id = $(this).attr("var");
		$("#sort").val(id);
        if( $(this).hasClass("desc") ){
			$("#sorter").val("asc");
		} else if( $(this).hasClass("asc") ){
			$("#sorter").val("desc");
		}
		$("#frm").submit();
		
    });
	
	$(".popup").popup({
		width: 840,
		height: 680,
		titlebar: false,
		status: false,
		resizable: true,
		toolbar: false,
		scrollbars: true,
		menubar: false
		
	});
});


function cur_menu(idx){
	$("#main"+idx).addClass("menu_on");
	$("#sub"+idx).show();
}

jQuery(function () {
    if (!("placeholder" in document.createElement("input"))) { 
        jQuery(":input[placeholder]").each(function () {
            var $this = jQuery(this);
            var pos = $this.offset();
            if (!this.id) this.id = "jQueryVirtual_" + this.name;
            if (this.id) {
                if (jQuery.browser.version  < 8) {
                    $this.after("<label for='" + this.id + 
                        "' id='jQueryVirtual_label_" + this.id + 
                        "' class='absolute'>" + $this.attr("placeholder") + 
                        "</label>");
                    $("#jQueryVirtual_label_" + this.id).
                        css({"left":(pos.left+5), "margin-top":3, 
                        "width":$this.width()});
                }
                else {
                    $this.after("<label for='" + this.id + 
                    "' id='jQueryVirtual_label_" + this.id + 
                    "' style='left:" + (pos.left+5) + 
                    "px;margin-top:2px' class='absolute'>" + 
                    $this.attr("placeholder") + "</label>");
                }
            }
        }).focus(function () {
            var $this = jQuery(this);
            $this.addClass("focusbox");
            jQuery("#jQueryVirtual_label_" + $this.attr("id")).hide();
        }).blur(function () {
            var $this = jQuery(this);
            $this.removeClass("focusbox");
            if(!jQuery.trim($this.val())) 
                jQuery("#jQueryVirtual_label_" + $this.attr("id")).show();
            else jQuery("#jQueryVirtual_label_" + $this.attr("id")).hide();
        }).trigger("blur");
    }
}); 


function go_search(){
	$("#page_now").val(0);
	$("#frm").submit();
}
