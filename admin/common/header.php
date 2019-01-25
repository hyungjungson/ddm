<?php
header('Content-Type: text/html; charset=UTF-8');
define('ROOT_PATH', $_SERVER['DOCUMENT_ROOT']."/");

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
if( $_SERVER['REMOTE_ADDR'] != "14.52.204.59" && $_SERVER['REMOTE_ADDR'] != "125.129.24.198" && $_SERVER['REMOTE_ADDR'] != "58.233.237.57") {
    Header("Location:/");
}
*/
require_once(ROOT_PATH."admin/session.php");
require_once(ROOT_PATH."config/global_config.php");
require_once(ROOT_PATH."lib/DB.php");
require_once(ROOT_PATH."lib/function.php");
require_once(ROOT_PATH."admin/session_permission.php");

if( $_SERVER["REQUEST_URI"] != "/admin/adm_join/" ){
	if($sess_lev < 5){
		error("사이트 관리자가 아닙니다.","/");
		exit;
	}
}

?>

<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>TAC Global</title>
    <meta name="description" content="TAC Global">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="favicon.ico">

    <link rel="stylesheet" href="../assets/css/normalize.css">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="../assets/css/themify-icons.css">
    <link rel="stylesheet" href="../assets/css/flag-icon.min.css">
    <link rel="stylesheet" href="../assets/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="../assets/scss/style.css">
    <link href="../assets/css/lib/vector-map/jqvmap.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

	<style>
		.page-item.active .page-link{background-color: #63c2de; border-color: #63c2de;}
		.page-link{color:#63c2de;}
		.page-link:focus, .page-link:hover{color:#63c2de;}
	</style>
</head>
<body>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
