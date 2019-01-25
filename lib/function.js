var ajax = {};
ajax.xhr = {};

ajax.xhr.Request = function(url, params, callback, method){
	this.url = url;
	this.params = params;
	this.callback = callback;
	this.method = method;
	this.send();
}
ajax.xhr.Request.prototype = {
	getXMLHttpRequest:function(){
		if (window.ActiveXObject){
			try{
	    		return new ActiveXObject("Msxml2.XMLHTTP");
			}catch(e){
	    		try{
		        	return new ActiveXObject("Microsoft.XMLHTTP");
	    	    }catch(e1){
	        		return null;
		        }
	    	}
		}else if(window.XMLHttpRequest){
	    	return new XMLHttpRequest();
		}else{
	    	return null;
		}
	},
	send:function(){
		this.req = this.getXMLHttpRequest();

		var httpMethod = this.method ? this.method : 'GET';
		if(httpMethod != 'GET' && httpMethod != 'POST'){
			httpMethod='GET';
		}
		var httpParams = (this.params == null || this.params == '') ? null : this.params;
		var httpUrl = this.url;
		if(httpMethod == 'GET' && httpParams != null){
			httpUrl = httpUrl + "?" + httpParams;
		}
		this.req.open(httpMethod, httpUrl, true);
		this.req.setRequestHeader('Content-Type','application/x-www-form-urlencoded; charset=UTF-8');
		var request = this;
		this.req.onreadystatechange = function(){
			request.onStateChange.call(request);
		}
		this.req.send(httpMethod == "POST" ? httpParams : null);
	},
	onStateChange:function(){
		this.callback(this.req);
	}
}


/**
 * input[type=text]의 text에 있는 커서 이동 및 원하는 만큼 드래그하기.
 * @author Dongkkase (http://eyecandyzero.tistory.com)
 * @param _start: start cursor[Type-int]
 * @param _end: end cursor[Type-int]
 * @example Driectory /lib/demo/func.cursor/
 */
$.fn.selectRange = function(_start, _end){
    return this.each(function(){
        if (this.setSelectionRange)
        {
            this.focus();
            this.setSelectionRange(_start, _end);
        }
        else if (this.createTextRange)
        {
            var range = this.createTextRange();
            range.collapse(true);
            range.moveEnd('character', _end);
            range.moveStart('character', _start);
            range.select();
        }
    });
};
/**/


/**
 * 앵커태그에 명시된 주소로 팝업창 열기.
 * @author Dongkkase (http://eyecandyzero.tistory.com)
 * @param width: int
 * @param height: int
 * @param titlebar: [true/false]
 * @param status: [true/false]
 * @param resizable: [true/false]
 * @param toolbar: [true/false]
 * @param scrollbars: [true/false]
 * @param menubar: [true/false]
 * @example Driectory /lib/demo/func.popup/
 */
jQuery.fn.popup = function(options) {
    var defaults = {
        width: screen.width/2,
        height: screen.height/2,
        titlebar: true,
        status: true,
        resizable: true,
        toolbar: true,
        scrollbars: true,
        menubar: true
    };
    var options = jQuery.extend(defaults, options);
    
    Boolean.prototype.setProperty = function() {
        if (this == true) { return "yes"; } else { return "no"; }
    };
    
    return this.each( function() {
        jQuery(this).click( function() {
            var target = this.target;
            var href = this.href;
            var posY = (parseInt(screen.height/2)) - (parseInt(options.height/2));
            var posX = (parseInt(screen.width/2)) - (parseInt(options.width/2));
            var win = window.open(href, target, 'titlebar=' + options.titlebar.setProperty() + ', screenX='+ posX +', screenY='+ posY +', left='+ posX +', top='+ posY +', status=' + options.status.setProperty() + ', resizable=' + options.resizable.setProperty() + ', toolbar=' + options.toolbar.setProperty() + ', scrollbars=' + options.scrollbars.setProperty() + ', menubar=' + options.menubar.setProperty() + ', width='+ options.width +', height='+ options.height);
            win.focus();
            return false;
        });
    });
};
/**/


/**
* Cookie
* @author Dongkkase (http://eyecandyzero.tistory.com)
*  
* 주어진 키값과 기타 옵션의 매개변수를 사용하여 쿠키를 만든다.
* @example $.cookie('the_cookie', 'the_value');
* @desc Set the value of a cookie.
* @example $.cookie('the_cookie', 'the_value', { expires: 7, path: '/', domain: 'jquery.com', secure: true });
* @desc Create a cookie with all available options.
* @example $.cookie('the_cookie', 'the_value');
* @desc Create a session cookie.
* @example $.cookie('the_cookie', null);
* @desc 값으로 null을 전달하여 쿠키를 삭제한다. 쿠키가 설정 될 때 사용 된 것과 동일한 도메인을 사용할 필요가 있는지 유의.
*
* @param String key The key of the cookie.
* @param String value The value of the cookie.
* @param Object options An object literal containing key/value pairs to provide optional cookie attributes.
* @option Number|Date expires Either an integer specifying the expiration date from now on in days or a Date object.
* 음수(과거 날짜 등)를 지정한 경우 cookie가 삭제 된다.
* null로 설정하거나 생략하면, 쿠키는 브라우저가 종료될때 유지 되지 않는다.
* 
* @option String path The value of the path atribute of the cookie (default: path of page that created the cookie).
* @option String domain The value of the domain attribute of the cookie (default: domain of page that created the cookie).
* @option Boolean secure If true, the secure attribute of the cookie will be set and the cookie transmission will
* require a secure protocol (like HTTPS).
* @type undefined
* 
* 만들어진 쿠키의 값을 가지고 온다.
* @example $.cookie('the_cookie');
* @desc Get the value of a cookie.
*
* @param String key The key of the cookie.
* @return The value of the cookie.
* @type String
* @example Driectory /lib/demo/func.cookie/
*/
(function (factory) {
    if (typeof define === 'function' && define.amd) {
        // AMD. Register as anonymous module.
        define(['jquery'], factory);
    } else {
        // Browser globals.
        factory(jQuery);
    }
}(function ($) {

    var pluses = /\+/g;

    function raw(s) {
        return s;
    }

    function decoded(s) {
        return decodeURIComponent(s.replace(pluses, ' '));
    }

    function converted(s) {
        if (s.indexOf('"') === 0) {
            // This is a quoted cookie as according to RFC2068, unescape
            s = s.slice(1, -1).replace(/\\"/g, '"').replace(/\\\\/g, '\\');
        }
        try {
            return config.json ? JSON.parse(s) : s;
        } catch(er) {}
    }

    var config = $.cookie = function (key, value, options) {

        // write
        if (value !== undefined) {
            options = $.extend({}, config.defaults, options);

            if (typeof options.expires === 'number') {
                var days = options.expires, t = options.expires = new Date();
                t.setDate(t.getDate() + days);
            }

            value = config.json ? JSON.stringify(value) : String(value);

            return (document.cookie = [
                config.raw ? key : encodeURIComponent(key),
                '=',
                config.raw ? value : encodeURIComponent(value),
                options.expires ? '; expires=' + options.expires.toUTCString() : '', // use expires attribute, max-age is not supported by IE
                options.path    ? '; path=' + options.path : '',
                options.domain  ? '; domain=' + options.domain : '',
                options.secure  ? '; secure' : ''
            ].join(''));
        }

        // read
        var decode = config.raw ? raw : decoded;
        var cookies = document.cookie.split('; ');
        var result = key ? undefined : {};
        for (var i = 0, l = cookies.length; i < l; i++) {
            var parts = cookies[i].split('=');
            var name = decode(parts.shift());
            var cookie = decode(parts.join('='));

            if (key && key === name) {
                result = converted(cookie);
                break;
            }

            if (!key) {
                result[name] = converted(cookie);
            }
        }

        return result;
    };

    config.defaults = {};

    $.removeCookie = function (key, options) {
        if ($.cookie(key) !== undefined) {
            $.cookie(key, '', $.extend(options, { expires: -1 }));
            return true;
        }
        return false;
    };

}));

function GetCommaValue(num) {
	
	
	var len, point, str;  
	
	num = num + "";  
	point = num.length % 3  
	len = num.length;  
	
	str = num.substring(0, point);  
	while (point < len) {  
		if (str != "") str += ",";  
		str += num.substring(point, point + 3);  
		point += 3;  
	}  
	return str;  

}
function GetCommaRemove(s) {
    var rtn = parseFloat(s.replace(/,/gi, ""));
    if (isNaN(rtn)) {
        return 0;
    }
    else {
        return rtn;
    }
}

 function NumObj(obj){

   if (event.keyCode >= 48 && event.keyCode <= 57) { //숫자키만 입력

    return true;

   } else {

   event.returnValue = false;

  }
 
 }

function addComma(obj,fLen)
{ 
 
 if(event.keyCode == 37 || event.keyCode == 39 ) 
{ 
return;
}

var fLen = fLen || 2; 


var strValue = obj.value.replace(/,|\s+/g,'');
var strBeforeValue = (strValue.indexOf('.') != -1)? strValue.substring(0,strValue.indexOf('.')) :strValue ;
var strAfterValue = (strValue.indexOf('.') != -1)? strValue.substr(strValue.indexOf('.'),fLen+1) : '' ;


if(isNaN(strValue))
{
alert(strValue.concat(' -> 숫자가 아닙니다.'));
return false;
}


var intLast = strBeforeValue.length-1;


var arrValue = new Array;
var strComma = '';

for(var i=intLast,j=1; i >= 0; i--,j++)
{ 

if( j !=1 && j%3 == 0) 
{ 
strComma = ',';
}
else
{
strComma = '';
}


arrValue[arrValue.length] = strBeforeValue.charAt(i) + strComma ;
}



obj.value= arrValue.reverse().join('') + strAfterValue; 

}

/**/
