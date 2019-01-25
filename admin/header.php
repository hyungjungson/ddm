<?php
header('Content-Type: text/html; charset=UTF-8');
define('ROOT_PATH', $_SERVER['DOCUMENT_ROOT']."/");
require_once(ROOT_PATH."admin/session.php");
require_once(ROOT_PATH."config/global_config.php");
require_once(ROOT_PATH."lib/DB.php");
require_once(ROOT_PATH."lib/function.php");
require_once(ROOT_PATH."admin/session_permission.php");
require_once(ROOT_PATH."config/title.php");


if($sess_lev < 9){
	error("사이트 관리자가 아닙니다.","/admin/");
    exit;	
}

?>
<!DOCTYPE html> 
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
    <title> <?=ADMIN_TITLE?> :: <?=$TITLE?> </title>
    <?php include ROOT_PATH."admin/include.php";?>
</head>
<body>
<div id="wrap">
    <div id="header">
        <?php include ROOT_PATH."admin/lnb.php";?>

        <div class="clear"></div>
    </div>
    <div id="container">
        <!-- <div class="snb">ddd</div> -->
        <div id="content">