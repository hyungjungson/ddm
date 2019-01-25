<?php
    header('Content-Type: text/html; charset=UTF-8');
    define("ROOT_PATH", $_SERVER["DOCUMENT_ROOT"]."/");
	require_once(ROOT_PATH."admin/session.php");
    require_once(ROOT_PATH."config/global_config.php");
    require_once(ROOT_PATH."lib/DB.php");
    require_once(ROOT_PATH."lib/function.php");	
?>
