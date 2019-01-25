<?php
include $_SERVER['DOCUMENT_ROOT']."/admin/proc.php";

$lang = $_REQUEST['lang'];

$page = $_REQUEST['page'];

$page_sql = "";

if($page){
	$page = $page - 1;
	$page_sql = "LIMIT ".($page * 4).", 4";	
}

$lst_sql = "SELECT * FROM youtube WHERE del_yn = 'N' ORDER BY idx DESC {$page_sql}";
$res = $db->get_results($lst_sql);

$cnt = 0;

if($res){
	foreach($res as $data){
		$idx = $data->idx;
		$title = $data->title;
		$url = $data->url;
		$img = $data->img;
		$regdate = $data->regdate;
		$regdate = substr($regdate,0,10);
		$langNum = $idx + 10000;

		$cnt++;


?>

<a href="<?=$url?>" target="_blank">
    <li class="list_item">
        <div class="picture">
            <img src="<?=$img?>" />
        </div>
        <div class="text">
            <p class="date"><?=$regdate?></p>
            <p class="title" style="overflow:hidden;white-space:nowrap;text-overflow:ellipsis"><?=$title?></p>
        </div>
    </li>
</a>

<?php

	}
}
?>
||<?=$cnt?>
