<?php
include $_SERVER['DOCUMENT_ROOT']."/admin/proc.php";

$lang = $_REQUEST['lang'];

$page = $_REQUEST['page'];

$page_sql = "";

if($page){
	$page = $page - 1;
	$page_sql = "LIMIT ".($page * 4).", 4";	
}


//$lst_sql = "SELECT img_{$lang} as img, title_{$lang} as title, cover_{$lang} as cover, idx, regdate FROM webtoon WHERE del_yn = 'N'  ORDER BY idx DESC {$page_sql}";
$lst_sql = "SELECT img_{$lang} as img, title_{$lang} as title, cover_{$lang} as cover, idx, regdate FROM webtoon WHERE del_yn = 'N'  ORDER BY idx {$page_sql}";
$res = $db->get_results($lst_sql);

$cnt = 0;

if($res){
	foreach($res as $data){
		$idx = $data->idx;
		$title = $data->title;
		$cover = $data->cover;
		$regdate = $data->regdate;
		$regdate = substr($regdate,0,10);
		$cnt++;

?>
<a href="#." class="layer_btn" data-num="<?=$idx?>"  data-type="webtoon">
    <li class="list_item">
        <div class="picture">
            <img src="<?=$cover?>" id="webtoonImg" alt="webtoon image" />
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
