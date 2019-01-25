<?php
session_start();
session_destroy();

$sess_id = "";
$sess_name = "";
$sess_idx = "";
$sess_lev = "";

echo "<script>location.href='/admin/'</script>";
?>