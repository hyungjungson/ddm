<?php
    $pw = "1q2w3e4r5t^^";
    $password_hash = hash("sha256", $pw);
    echo "암호화 전 : ".$pw."<br/>";
    echo "암호화 후 : ".$password_hash."<br/>";
?>
