<?php
include $_SERVER['DOCUMENT_ROOT']."/admin/proc.php";

$table = $_REQUEST['table'];
//request();
//echo "<br>";
//insert_query($table);
//echo "<br>";
//update_query($table);

//exit();

$func_type = $_REQUEST['func_type'];

if($func_type == "del"){
	$idx=$_REQUEST["idx"];
	if(!$idx){
		$chk=$_REQUEST["chk"];
		$idx = "";
		for($i=0;$i<count($_REQUEST["chk"]);$i++)
		{
			if($idx) $idx .= ",";
			$idx .= $_REQUEST["chk"][$i];
		}
	}

	//$sql = "DELETE FROM {$table} WHERE idx IN ($idx)";
	$sql = " UPDATE {$table} SET del_yn = 'Y' WHERE idx = '$idx' ";
	$res = $db->query($sql);

	$res_msg = "삭제되었습니다.";
	$go_url = "index";

} else if($func_type == "write"){

	$idx = $_REQUEST['idx'];
	$page_now = $_REQUEST['page_now'];
	$search_text = $_REQUEST['search_text'];
	$search_type = $_REQUEST['search_type'];
	$table = $_REQUEST['table'];
	$title_ko 	= addslashes($_REQUEST['title_ko']);
	$content_ko = addslashes($_REQUEST['content_ko']);
	$title_en 	= addslashes($_REQUEST['title_en']);
	$content_en = addslashes($_REQUEST['content_en']);
	$title_cn 	= addslashes($_REQUEST['title_cn']);
	$content_cn = addslashes($_REQUEST['content_cn']);
	$title_jp 	= addslashes($_REQUEST['title_jp']);
	$content_jp = addslashes($_REQUEST['content_jp']);

	/////////////////////////////////////////////////////////////////////////////////////////////////////

	$sql = "INSERT INTO {$table}
	(
	    title_ko
	    , title_en
	    , title_cn
	    , title_jp
	    , content_ko
	    , content_en
	    , content_cn
	    , content_jp
		, del_yn
	)
	VALUES
	(
	    '$title_ko'
	    ,'$title_en'
	    ,'$title_cn'
	    ,'$title_jp'
	    ,'$content_ko'
	    ,'$content_en'
	    ,'$content_cn'
	    ,'$content_jp'
		,'N'
	)
	";
	//echo $sql;
	$res = $db->query($sql);

	$res_msg = "등록되었습니다.";
	$go_url = "index.php";



} else if($func_type == "edit"){

	$idx = $_REQUEST['idx'];
	$page_now = $_REQUEST['page_now'];
	$search_text = $_REQUEST['search_text'];
	$search_type = $_REQUEST['search_type'];
	$table = $_REQUEST['table'];
	$title_ko 	= addslashes($_REQUEST['title_ko']);
	$content_ko = addslashes($_REQUEST['content_ko']);
	$title_en 	= addslashes($_REQUEST['title_en']);
	$content_en = addslashes($_REQUEST['content_en']);
	$title_cn 	= addslashes($_REQUEST['title_cn']);
	$content_cn = addslashes($_REQUEST['content_cn']);
	$title_jp 	= addslashes($_REQUEST['title_jp']);
	$content_jp = addslashes($_REQUEST['content_jp']);

	/////////////////////////////////////////////////////////////////////////////////////////////////////

	$sql = "UPDATE {$table} SET
	    title_ko = '$title_ko'
	    ,title_en = '$title_en'
	    ,title_cn = '$title_cn'
	    ,title_jp = '$title_jp'
	    ,content_ko = '$content_ko'
	    ,content_en = '$content_en'
	    ,content_cn = '$content_cn'
	    ,content_jp = '$content_jp'
	WHERE idx = '$idx'
	";

	//echo $sql;
	//exit();

	$res = $db->query($sql);

	$res_msg = "수정되었습니다.";
	$go_url = "index.php?page_now=".$page_now."&search_type=".$search_type."&search_text=".$search_text;

}

error($res_msg,$go_url);


?>
