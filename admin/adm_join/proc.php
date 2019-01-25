<?php
include $_SERVER['DOCUMENT_ROOT']."/admin/proc.php";

$table = $_REQUEST['table'];

$func_type = $_REQUEST['func_type'];

if($func_type == "write"){

    $id = $_REQUEST['mem_id'];
    $pwd = $_REQUEST['mem_pw'];
    $password_hash = hash("sha256", $pwd);
    $nm = $_REQUEST['mem_nm'];
    $email = $_REQUEST['mem_email'];
    $ip = $_SERVER['REMOTE_ADDR'];

	/////////////////////////////////////////////////////////////////////////////////////////////////////

    //이미 있는 아이디인지 확인
    $sql = "SELECT count(*) cnt FROM admin WHERE id = '{$id}'";
    $row = $db->get_row($sql);
    if($row->cnt != '0' ) {
        error("사용할 수 없는 아이디입니다.","");
        exit;
    }

	$inSql = "INSERT INTO admin (
	    id, pwd, email, ip, name, level, createdate
	) VALUES (
	    '$id'
	    ,'$password_hash'
	    ,'$email'
        ,'$ip'
	    ,'$nm'
        ,'1'
        ,DATE_SUB(now(), INTERVAL 3 HOUR)
	)
	";
	$res = $db->query($inSql);

	$res_msg = "등록요청되었습니다. 승인이 완료되면 이메일로 알려드리겠습니다.";
	$go_url = "/admin";

}

error($res_msg,$go_url);
?>
