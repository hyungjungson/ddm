<?php
header('Content-Type: text/html; charset=UTF-8');
require_once($_SERVER["DOCUMENT_ROOT"]."admin/session.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/lib/DB.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/lib/function.php");

$user_id = $_POST['user_id'];
$user_pw = $_POST['user_pw'];

$sql = "SELECT count(*) cnt FROM admin WHERE level in ('5','10') and binary(id) = '{$user_id}'";
$row = $db->get_row($sql);

if($row->cnt == '0' ) {
    error("접근할 수 없습니다.","");
    exit;
} else {
    $pw_hash = hash("sha256", $user_pw);
    $sql2 = "SELECT * FROM admin WHERE level in ('5','10') and binary(id) = '{$user_id}' AND pwd = '{$pw_hash}' ";
	//$sql2 = "SELECT * FROM admin WHERE level in ('5','10') and binary(id) = '{$user_id}'";
	$row2 = $db->get_row($sql2);
	if ($user_id != $row2->id){
        error("접근할 수 없습니다.","");
    	exit;
	} else {
		$sql = "UPDATE admin SET last_login = now() WHERE id = '$user_id'";
		$res = $db->query($sql);

		$user_idx = $row2->idx;
		$user_lev = $row2->level;
		$user_id = $row2->id;

		$_SESSION['sess_idx']     = $user_idx;
		$_SESSION['sess_id']      = $user_id;
		$_SESSION['sess_lev']     = $user_lev;

		if($user_lev == 9){
			error("", $url);
		} else {
			error("", "/admin/notice/");
		}


	}

}
?>
