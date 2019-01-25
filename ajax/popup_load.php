<?php
include $_SERVER['DOCUMENT_ROOT']."/admin/proc.php";

$lang = $_REQUEST['lang'];


$lst_sql = "SELECT idx, title_{$lang} as title, content_{$lang} as content FROM popup WHERE del_yn = 'N' ORDER BY idx DESC LIMIT 1";
$res = $db->get_results($lst_sql);

if($res){
	foreach($res as $data){
		$idx = $data->idx;
		$title = $data->title;
		$content = $data->content;
?>

<div class="pop_info"><h3><?=$title?></h3></div>
<div class="pop_app_content"><?=$content?></div>
<?php
	}
}
?>
