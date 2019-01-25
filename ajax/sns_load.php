<?php
include $_SERVER['DOCUMENT_ROOT']."/admin/proc.php";

$lang = $_REQUEST['lang'];

$lst_sql = "SELECT * FROM sns WHERE lang IN ('all','{$lang}') ORDER BY sort";
$res = $db->get_results($lst_sql);

$rtnStr = "";
if($res){
	foreach($res as $data){
		$link = $data->link;
        $rtnStr = $rtnStr.$link.",";
	}
    echo $rtnStr;
}
?>
