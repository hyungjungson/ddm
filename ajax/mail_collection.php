<?php
    include $_SERVER['DOCUMENT_ROOT']."/admin/proc.php";

    $mail = $_POST['mail'];

    if($mail == ""){
            $redirect = 'https://mileageto.com';
            header('HTTP/1.1 301 Moved Permanently');
            header('Location: ' . $redirect);
    }

    $check_email = preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i", $mail);
    if (!$check_email) {
        echo "no email format";
        exit;
    } else {
        //접속 로그
        $sql = "INSERT INTO email_collection ( email, ip, createdt) VALUES ('{$mail}', '". $_SERVER['REMOTE_ADDR'] ."', now())";
        $res = $db->query($sql);
        echo "Thank you!";
    }
?>
