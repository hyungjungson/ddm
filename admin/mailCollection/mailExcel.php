<?php
header( "Content-type: application/vnd.ms-excel" );
header( "Content-type: application/vnd.ms-excel; charset=utf-8");
header( "Content-Disposition: attachment; filename = mailCollection.xls" );
header( "Content-Description: PHP4 Generated Data" );
define('ROOT_PATH', $_SERVER['DOCUMENT_ROOT']."/");

require_once(ROOT_PATH."admin/session.php");
require_once(ROOT_PATH."config/global_config.php");
require_once(ROOT_PATH."lib/DB.php");
require_once(ROOT_PATH."lib/function.php");
require_once(ROOT_PATH."admin/session_permission.php");

$sql = "SELECT * FROM email_collection GROUP BY email ORDER BY idx DESC";
$res_sql = $db->get_results($sql);

// 테이블 상단 만들기
$EXCEL_STR = "
<table border='1'>
<tr>
   <td>No</td>
   <td>E-mail</td>
   <td>IP</td>
   <td>등록일</td>
</tr>";

if ($res_sql) {
    $i = 0;
    foreach ($res_sql as $data) {
        $idx = $data->idx;
        $email = $data->email;
        $ip = $data->ip;
        $regdate = $data->createdt;
        $regdate = substr($regdate,0,10);

        $EXCEL_STR .= "
            <tr>
                <td>".(count($res_sql)-$i)."</td>
                <td>".$email."</td>
                <td>".$ip."</td>
                <td>".$regdate."</td>
            </tr>
        ";
   $i++;
   }
} else {
    echo 2;
}

$EXCEL_STR .= "</table>";

echo "<meta content=\"application/vnd.ms-excel; charset=UTF-8\" name=\"Content-type\"> ";
echo $EXCEL_STR;
?>
