<?php
include $_SERVER['DOCUMENT_ROOT']."/admin/proc.php";

$func_type = $_REQUEST['func_type'];

if($func_type == "edit"){

    $idx = $_REQUEST['idx'];
    $pwd = $_REQUEST['mem_pw'];
    $password_hash = hash("sha256", $pwd);

	$inSql = "UPDATE admin SET pwd = '$password_hash', pw_change_date = DATE_SUB(now(), INTERVAL 3 HOUR) WHERE idx = '$idx'";
	$res = $db->query($inSql);

	$res_msg = "회원정보를 수정하였습니다.";
	$go_url = "/admin/dashboard";

}

error($res_msg,$go_url);
?>
