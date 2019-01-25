<?php
include $_SERVER['DOCUMENT_ROOT']."/admin/proc.php";


$func_type = $_POST['func_type'];

if($func_type == "edit"){

	$idx = $_POST['idx'];
	$link = $_POST['link'];

	$sql = "UPDATE sns SET link = '$link' WHERE idx = '$idx'";
	$res = $db->query($sql);

	$res_msg = "수정되었습니다.";
	$go_url = "/admin/sns/";

}

error($res_msg,$go_url);


?>
