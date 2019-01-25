<?php
header('Content-Type: text/html; charset=UTF-8');
include $_SERVER['DOCUMENT_ROOT']."/admin/proc.php";

$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];
$check_email = preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i", $email);

if( $email != "" && $check_email ){
	//if( send_mail($email, $name, "taccoinbene@gmail.com","TAC Global 문의입니다.", $message) ){	
	if( send_mail($email, $name, "kyowon@mileageto.com","TAC Global 문의입니다.", $message) ){	
		echo "Mail send to TAC manager";
	} else {
		echo "Mail send fail";
	}
}
?>
