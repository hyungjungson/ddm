<?php
include $_SERVER['DOCUMENT_ROOT']."/admin/proc.php";

$lang = $_REQUEST['lang'];
$page = $_REQUEST['page'];

$page_sql = "";

if($page){
	$page = $page - 1;
	$page_sql = "LIMIT ".($page * 4).", 4";	
}


$lst_sql = "SELECT * FROM press WHERE (lang LIKE '%all%' OR lang LIKE '%{$lang}%' ) AND del_yn = 'N' ORDER BY regdate DESC {$page_sql}";
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

<li>
<a href="#">
<div class="photo"><img src="http://placehold.it/380x215?text=placehold.it+rocks! "
	alt="blog_photo_img" /></div>
<p class="date">208-07-30</p>
<p class="text">CEO 인터뷰</p>
</a>
</li>

<?php

	}
}
?>
||<?=$cnt?>
