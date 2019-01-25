<?php
	require_once($_SERVER['DOCUMENT_ROOT']."/lib/DB/shared/ez_sql_core.php");
	require_once($_SERVER['DOCUMENT_ROOT']."/lib/DB/mysqli/ez_sql_mysqli.php");
	require_once($_SERVER['DOCUMENT_ROOT']."/config/DB_config.php");

	$db = new ezSQL_mysqli(DBUSER,DBPW,DBNAME,DBHOST);
	$dbw = new ezSQL_mysqli(WDBUSER,WDBPW,WDBNAME,WDBHOST);

?>
