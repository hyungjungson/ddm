<?php
define("ROOT_PATH", $_SERVER['DOCUMENT_ROOT']."/");
if (!(isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] == 'on' || 
   $_SERVER['HTTPS'] == 1) ||  
   isset($_SERVER['HTTP_X_FORWARDED_PROTO']) &&   
   $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https'))
{
   $redirect = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
   header('HTTP/1.1 301 Moved Permanently');
   header('Location: ' . $redirect);
   exit();
}
/*
//아이피 체크
// 수정작업으로 인한 작업자 IP 추가
//if( $_SERVER['REMOTE_ADDR'] != "14.52.204.59" && $_SERVER['REMOTE_ADDR'] != "125.129.24.198") {
if( $_SERVER['REMOTE_ADDR'] != "14.52.204.59" && $_SERVER['REMOTE_ADDR'] != "125.129.24.198" && $_SERVER['REMOTE_ADDR'] != "54.169.107.114") {
    Header("Location:/");
}
*/
require_once(ROOT_PATH."admin/session.php");
require_once(ROOT_PATH."config/global_config.php");
require_once(ROOT_PATH."lib/function.php");
require_once(ROOT_PATH."lib/DB.php");
require_once(ROOT_PATH."admin/session_permission.php");

if($sess_lev == 10){
?>
<script>location.href='/admin/notice/'</script>
<?php } else { ?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<title>관리자로그인</title>
<?php include(ROOT_PATH."admin/include.php")?>
<style>
#login_middle{position:relative;width:100%; height:100%;}
#login_bg{position:relative; padding:13% 0; width:255px; margin:0 auto; }
.login_box div{position:relative;margin-bottom:10px}
.input_box{width:255px; height:30px; border:1px #ddd solid; line-height:30px; font-size:14px; text-indent:10px;}
.login_btn{width:255px; height:40px; line-height:40px; font-size:14px; background:#007383; color:#fff; border:0px;}
.login_logo{background: url('/images/logo_admin1.png') center no-repeat; background-size:contain; width:100%; height:160px; margin-bottom:30px;}
</style>
</head>
<body style="background:#fff">
<script>
$(document).ready(function(){
	$("#user_id").focus();
});
function login(){
	var user_id = $("#user_id");
	var user_pw = $("#user_pw");
	if(!user_id.val() ){
		alert("아이디를 입력하세요");
		user_id.focus();
	} else if(!user_pw.val() ){
		alert("비밀번호를 입력하세요");
		user_pw.focus();
	} else {
		$("#frm").submit();
	}
}

function joinBtn(){
	location.href = "/admin/adm_join";
}
</script>
<form action="login_proc" method="post" name="frm" id="frm">
<div id="login_middle">
    <div id="login_bg">
    	<div class="login_logo"></div>
        <div class="login_box">
        	<div><input type="text" class="input_box" name="user_id" id="user_id" value="<?=$user_id?>" style="ime-mode:disabled;" placeholder="아이디를 입력하세요" /></div>
            <div><input type="password" class="input_box" name="user_pw" id="user_pw" placeholder="비밀번호를 입력하세요" /></div>
			<div><input type="submit" class="login_btn" onclick="login();return false;" value="로그인" /></div>
            <div><input type="button" class="login_btn" onclick="joinBtn();return false;" value="회원가입" /></div>
        </div>
    </div>
</div>
</form>
</body>
</html>
<?php } ?>
