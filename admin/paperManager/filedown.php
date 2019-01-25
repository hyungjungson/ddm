<?php
define('ROOT_PATH', $_SERVER['DOCUMENT_ROOT']."/");
require_once(ROOT_PATH."lib/DB.php");

$idx = $_REQUEST['idx'];
$fileSql = "SELECT file, save_file FROM paper where idx = '{$idx}'";
$fileRst = $db->get_row($fileSql);
$fileStr = $fileRst->file;
$realFileStr = $fileRst->save_file;

$filepath = '../../data/paper/'.$realFileStr;
$filesize = filesize($filepath);
$path_parts = pathinfo($filepath);
$filename = $path_parts['basename'];
$extension = $path_parts['extension'];

if($filesize < 1){
    exit;
}

header("Pragma: public");
header("Expires: 0");
header("Content-Type: application/octet-stream");
header("Content-Disposition: attachment; filename='".$fileStr."'");
header("Content-Transfer-Encoding: binary");
header("Content-Length: $filesize");

ob_clean();
flush();
readfile($filepath);

?>
