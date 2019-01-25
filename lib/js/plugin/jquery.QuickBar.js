/*
 * Martian Wabbit Productions's QuickBar
 * A cool browser notice bar.
 * -Version 1 (1/01/2009)
 * +Version 1.1 (21/06/2010)
 *
 * Examples at: http://seich.martianwabbit.com
 * Copyright (c) 2006 - 2010 Martian Wabbit Productions
*Licensed under the GNU license:
*http://www.gnu.org/copyleft/gpl.html
 *
 * @example
 *
* var options = {	bgcolor: "#ffff80",
*    			 bordercolor: 30,
*    			 height: 30,
*			 speed : "slow",
*			 align : "center",
*			 top : 5,
*		     }
*
*
*	$('#quickbar').QuickBar(options);
@params
*	bgcolor
*	bordercolor
*	height
*	speed
*	align
*	
 *	
 *
*/
jQuery.fn.QuickBar = function(options) {
	if($('#quickbar_quit_button').length != 0) return;
 //Settings
 settings = jQuery.extend({
     bgcolor: "#EBE9ED",
	 bordercolor: "#cacaca",
     height: 30,
//	 width : $(window).width(),
     width : 100,
	 speed : "normal",
	 top : 5,
	 align : "left",
	 button : '<input id="quickbar_quit_button" type="submit" value="Close" />'
  }, options);
  
 //add px
	var top_padding = settings['top'] + "px";
	
 //add close button to the bar
 jQuery(this).append(settings['button']);
 
 //format the bar 
 jQuery(this).css("position", "fixed")
		.css("top", "0px")
		.css("left", "0px")
		.css("z-index", "2")
		.css("margin-top", "0px")
		.css("padding-top", "5px")
		.css("padding-bottom", "3px")
		.css("padding-left", "20px")
		.css("padding-right", "20px")
		.css("text-align", settings['align'])
		.css("width", settings['width'])
		.css("background-color", settings['bgcolor'])
		.css("border-bottom", "1px solid " + settings['bordercolor'])
		.css("border-left", "1px solid " + settings['bordercolor'])
		.css("border-right", "1px solid " + settings['bordercolor'])
		.css("height", settings['height']);
		
		// Apply Absolute Positioning For IE. 
		if(jQuery.browser.msie){
			jQuery(this).css("position", "absolute")
						.css('top', jQuery(window).scrollTop() + "px");
			
			jQuery(window).scroll(function() {
				jQuery("#quickbar_quit_button").parent().css('top', jQuery(this).scrollTop() + "px");
			});
		}
				
		//format the button
		 jQuery("#quickbar_quit_button").css("position", "absolute")
										.css("left", "90%");
		
	//slide the bar
	jQuery(this).slideDown(settings['speed']);
  
 //OnClick, hide the bar
 jQuery("#quickbar_quit_button").click(function(){
			jQuery(this).parent().slideUp(settings['speed']);
			jQuery("#quickbar_quit_button").remove();
	 });
}
// QuickBar Close function
jQuery.fn.QuickBarClose = function(speed) {
	jQuery(this).slideUp(speed);
	jQuery("#quickbar_quit_button").remove();
}