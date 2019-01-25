 function getXmlHttpRequest(){
  var xmlhttp = false;
  // Mozilla/Safari
  if (window.xmlhttpuest) {
    xmlhttp = new xmlhttpuest();
  }
  // IE
  else if (window.ActiveXObject) {
    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
  }
  return xmlhttp;
 }
 function access_list(){
  var xmlhttp = getXmlHttpRequest();
  var url = "/ajax_user.php";
  
  if(url){
   xmlhttp.open("GET", url, true);
   xmlhttp.onreadystatechange = function() {
    if(xmlhttp.readyState == 4) {
     if(xmlhttp.status == 200) {
      var respTxt = xmlhttp.responseText;
      document.getElementById("access_list").innerHTML = respTxt;
     } else {
      //alert("Error loading "+url+", "+xmlhttp.status+"("+xmlhttp.statusText+")");
     }
    }
   }
   xmlhttp.send(null);
  }
  setTimeout("access_list()", 3000);//3초 마다 서버와 통신함
  return false;
 }
 
 access_list(); //맨처음 실행 해준다.
 
 function include_exit(msg) { 
  var xmlhttp = getXmlHttpRequest();
  var url = 'user_exit.jsp?msg='+msg;
  
  if(url){
   xmlhttp.open("GET", url, true);
   xmlhttp.onreadystatechange = function() {
    if(xmlhttp.readyState == 4) {
     if(xmlhttp.status == 200) {
      var respTxt = xmlhttp.responseText;
     } else {
      //alert("Error loading "+url+", "+xmlhttp.status+"("+xmlhttp.statusText+")");
     }
    }
   }
   xmlhttp.send(null);
  }
  return false;
 } 
 
 function Exit() { 
  if (self.screenTop > 9000) { 
   // 브라우저종료
   include_exit('브라우저종료');
  } else { 
   if(document.readyState == "complete") { 
    // 새로고침 
    include_exit('새로고침');
   } else if(document.readyState == "loading") { 
    // 다른사이트이동 
    include_exit('페이지이동');
   } 
  } 
 } 

