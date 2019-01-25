/*-----------------------------------------------------------------------------------*/
/* 		Mian Js Start
/*-----------------------------------------------------------------------------------*/
$(document).ready(function($) {
    "use strict"

    
    
    $('.slider').bxSlider({ 
        auto: true, 
        speed: 500, 
        pause: 4000, 
        mode:'horizontal', 
        pager:false,
        controls:false,
        autoHover:true
    });
    
    page_init();
    
    $(window).resize(function (){
        page_init();
    });
    
    function page_init(){
        var ww = $(window).width();
        var item_w = 400;

        if(ww < 1200){
            //console.log("mobile");

            ww = ww - 60;

            item_w = ww;

            var mobileH = 1111 * ww / 630;
            $(".partners-image").height( mobileH );

            mobileH = 630 * ww / 630;
            $(".distribution-image1").height( mobileH );

            mobileH = 733 * ww / 630;
            $(".platform-img").height( mobileH );

            mobileH = 812 * ww / 994;
            $(".blockchain-img").height( mobileH );

            mobileH = 709 * ww / 1001;
            $(".blockchain-img1").height( mobileH );

            $(".nav a").click(function (){
            	$(".navbar-toggler").click();
            	$("#header-wrap").hide();
            });


        } else {
            $(".partners-image").height( 300 );
            $(".distribution-image1").height( 500 );
            $(".platform-img").height( 465 );
            $(".blockchain-img").height( 881 );
            $(".blockchain-img1").height( 709 );
            //console.log("web");
            ww = 1200;
        }
        
        $(".roadmap-list li").width(item_w);
        $(".roadmap-list").width(item_w*10);
        
        $(".roadmap-timeline").scrollLeft(0);
        
        $("#timeline_prev").click(function (){
            var position = $(".roadmap-timeline").scrollLeft();
            if(position > 0){
                $(".roadmap-timeline").stop().animate( { scrollLeft : $(".roadmap-timeline").scrollLeft() - item_w } );
            }

        });

        $("#timeline_next").click(function (){
            var position = $(".roadmap-timeline").scrollLeft();
            if(position < (item_w * 10)){
                $(".roadmap-timeline").stop().animate( { scrollLeft : $(".roadmap-timeline").scrollLeft() + item_w } );
            }

        });


        var youtubeH = 315 * ww / 560;
        $("#whitepager-youtube").height(youtubeH);
    }
    
    
    /*-----------------------------------------------------------------------------------*/
    /* STICKY NAVIGATION
    /*-----------------------------------------------------------------------------------*/
    $(".sticky").sticky({topSpacing:0});
    /*-----------------------------------------------------------------------------------*/
    /* 	LOADER
    /*-----------------------------------------------------------------------------------*/
    $("#loader").delay(500).fadeOut("slow");
    /*-----------------------------------------------------------------------------------*/
    /*  FULL SCREEN
    /*-----------------------------------------------------------------------------------*/
    $('.full-screen').superslides({});
    
    /*-----------------------------------------------------------------------------------*/
    /* 	MagnificPopup
    /*-----------------------------------------------------------------------------------*/
    $('.popup-youtube, .popup-vimeo, .popup-gmaps').magnificPopup({
        disableOn: 700,
        type: 'iframe',
        mainClass: 'mfp-fade',
        removalDelay: 160,
        preloader: false,
        fixedContentPos: true
    });

    
    $(".navbar-toggler").click(function (){
        if( $(this).hasClass("collapsed") ){
            $("#header-wrap").show();
            
            
        } else {
            $("#header-wrap").hide();
        }
    });
   

});



function setListner(){
	var ww = $(window).width();
	var wh = $(window).height();
	
    var $btn = $(".layer_btn");
    $btn.click(function(e){
    	$("#wrap").css("overflow","hidden");
		$("#wrap").on('scroll touchmove mousewheel', function(e){e.preventDefault()});
	    mask();
        
        $("#popup_content").html("");
        
	    var st = $(document).scrollTop();
       
        if(ww > 1200){
            $(".pop_div").css("left",(ww/2)-400);
            $(".pop_div").css("top",(wh*0.02));
            $("#popup_content").css("max-height",(wh*0.75)-60);
        }

        $(".pop_div").css("display","block");

        var num = $(this).data("num");
		
		var url = "./ajax/notice_load.php";
		
        jQuery.ajax({
            url: url+'?idx='+num,
            type: 'GET',
            contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
            dataType: 'html',
            success: function (result) {
            	//console.log(result);
            	var tmp = result.split("||");
            	$("#popup_date").html(tmp[0]);
            	$("#popup_title").html(tmp[1]);
                $("#popup_content").html(tmp[2]);
                $("#content-box").scrollTop(0);
            },
            complete: function () { 
                //$("#popup_content").mCustomScrollbar();
               

            }
        });

    })

  $(".layer_close").click(function(e){
  	
    fncPopClose();
  });

    
}

function mask(){
  var maskW = "100%";
  var maskH = $(document).height();
  $(".pop_layer").css({"width":maskW,"height":maskH});
  $(".pop_layer").show();
}

function fncPopClose() {
	$("#wrap").css("overflow","auto");
	$("#wrap").off('scroll touchmove mousewheel');
  $(".pop_layer").hide();
  $(".pop_div").css("display","none");
}

function mailto(mail){
    location.href="mailto:"+mail;
}

document.addEventListener('DOMContentLoaded', function(){
  var trigger = new ScrollTrigger({
	  addHeight: true
  });
});


function ing(){
    alert("Coming soon.");
    return false;
}



function send_contact(){
	var regExp = /^[0-9a-zA-Z]([-_\.]?[0-9a-zA-Z])*@[0-9a-zA-Z]([-_\.]?[0-9a-zA-Z])*\.[a-zA-Z]{2,3}$/i;
	
	if( $("#name").val() == "" ){
		alert("Input name..");
		$("#name").focus();
		return false;
		
	} else if( $("#email").val() == "" ){
		alert("Input email..");
		$("#email").focus();
		return false;
		
	} else if ( !regExp.test( $("#email").val())) {
            alert("Wrong email..");
			$("#email").focus();
            return false;
    } else if( $("#message").val() == "" ){
		alert("Input message..");
		$("#message").focus();
		return false;
		
	} else {
	
		var params = jQuery("#contact_form").serialize();
		jQuery.ajax({
	        url: '/ajax/send_mail.php',
	        type: 'POST',
	        data: params,
	        contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
	        dataType: 'text',
	        success: function (result) {
	        	alert(result);
	            jQuery("#contact_form")[0].reset();
	
	        }
    	});  
    
		return true;	

	}
}

function notice_load(total,page,page_size){
	
	jQuery.ajax({
        url: '/ajax/noticeList_load.php?page='+page+'&page_size='+page_size,
        type: 'GET',
        contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
        dataType: 'html',
        success: function (result) {
            $("#notice-list").html(result);
            paging(total,page,page_size);
        },
        complete: function(){
        	setListner();
        }
    });
    
}

function paging(total_row,page_now,page_row){
	
	var pagingHtml = "";
	var page = 0, start, end;
	
	if (page_row == "") page_row = 0;
	
	if(total_row > 0)
	{
		pagingHtml += "<a href=\"javascript:notice_load('"+total_row+"','0','"+page_row+"')\" class=\"first\">first</a> ";
		if(page_now >= 1)
		{
			page = Number(page_now) - 1;
			pagingHtml += "<a href=\"javascript:notice_load('"+total_row+"','"+page+"','"+page_row+"')\" class=\"prev\">prev</a>";
		} else {
			pagingHtml += "<a href=\"javascript:notice_load('"+total_row+"','0','"+page_row+"')\" class=\"prev\">prev</a>";
		}
		// 페이지 바로가기 링크
		var buttons = 5;	//페이지 바로가기 링크의 수
		var half_buttons = Math.ceil(buttons / 2);
		var last_page = Math.ceil(Number(total_row) / Number(page_row));
		
		if(last_page < buttons)
		{
			start = 0;
			end = last_page;
		}
		else
		{
			if(page_now <= half_buttons)
			{
				start = 0;
				end = 5;
			}
			else if(page_now > Number(last_page) - Number(half_buttons))
			{
				start = Number(last_page) - Number(buttons) + 1;
			 	end = Number(last_page);
			}
			else
			{
				start = Number(page_now) - Number(half_buttons) + 1;
				end = Number(page_now) + Number(half_buttons);
			}
		}
	
		for(var i = start; i < end; i++)
		{
	        var k = i+1;
	        if(k < 10){
	        	k = "0"+k;	
	        }
			if(i == page_now)
			{
				pagingHtml += "<a class='num current' href=\"javascript:void(0);\">"+k+"</a>";
				
			}
			else
			{
				pagingHtml += " <a class='num' href=\"javascript:notice_load('"+total_row+"','"+i+"','"+page_row+"')\">";
				pagingHtml += k+"</a>";
				
			}
		}
	    if (start >= 1 && end == 1) pagingHtml += "<a class='num current' href=\"javascript:void(0);\">01</a>";
	
	    if (start == 0 && end == 0) pagingHtml += "<a class='num current' href=\"javascript:void(0);\">01</a>";
				
		//다음 페이지 버튼
	    last_page = Number(last_page) - 1;
	    if(page_now < last_page)
		{
			page = Number(page_now) + 1;
		 	pagingHtml += "<a href=\"javascript:notice_load('"+total_row+"','"+page+"','"+page_row+"')\" class=\"next\">next</a>";
		 	
		} else if(page_now == last_page){
			
			pagingHtml += "<a href=\"javascript:notice_load('"+total_row+"','"+last_page+"','"+page_row+"')\" class=\"next\">next</a>";
		}
		pagingHtml += "<a href=\"javascript:notice_load('"+total_row+"','"+last_page+"','"+page_row+"')\" class=\"last\">last</a>";
	    
	}
	else
	{
	    //pagingHtml += "<a href=\"javascript:notice_load('"+total_row+"','0','"+page_row+"')\" class=\"first\">first</a> ";
	    //pagingHtml += "<a href=\"javascript:notice_load('"+total_row+"','0','"+page_row+"')\" class=\"prev\">prev</a>";
	    //pagingHtml += "<a class='num current'>01</a>";
	 	//pagingHtml += "<a href=\"javascript:notice_load('"+total_row+"','0','"+page_row+"')\" class=\"next\">next</a>";
	 	//pagingHtml += "<a href=\"javascript:notice_load('"+total_row+"','0','"+page_row+"')\" class=\"last\">last</a>";
	 	
	}
	
	$("#paging").html(pagingHtml);
	
}