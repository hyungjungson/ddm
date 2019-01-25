<?php
include $_SERVER['DOCUMENT_ROOT']."/admin/proc.php";

$func_type = $_REQUEST['func_type'];

if($func_type == "confirm"){

    $idx = $_POST['idx'];

	$inSql = "UPDATE admin SET level = '5' WHERE idx = '$idx'";
	$res = $db->query($inSql);

	$res_msg = "승인하였습니다.";
	$go_url = "/admin/admManager/";

} else if($func_type == "del"){

    $idx = $_POST['idx'];

	$inSql = "UPDATE admin SET level = '0' WHERE idx = '$idx'";
	$res = $db->query($inSql);

	$res_msg = "관리자를 삭제하였습니다.";
	$go_url = "/admin/admManager/";

}

error($res_msg,$go_url);
?>
