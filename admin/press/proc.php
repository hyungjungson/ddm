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

} else if($func_type == "del_img"){

	$idx = $_POST['idx'];
	$param = $_POST['param'];

	$sql = "UPDATE {$table} SET
	    {$param} = ''
	WHERE idx = '$idx'
	";

	//echo $sql;
	$res = $db->query($sql);

	$res_msg = "삭제되었습니다.";
	$go_url = "iframe";

} else if($func_type == "write"){

	$idx = $_REQUEST['idx'];
	$page_now = $_REQUEST['page_now'];
	$search_text = $_REQUEST['search_text'];
	$search_type = $_REQUEST['search_type'];
	$table = $_REQUEST['table'];
	$title 	= addslashes($_REQUEST['title']);
	$content = addslashes($_REQUEST['content']);
	$url = $_REQUEST['url'];
	$regdate = $_REQUEST['regdate'];

	$lang = "";
	for($i=0;$i<count($_REQUEST["lang"]);$i++)
	{
		if($lang) $lang .= "|";
		$lang .= $_REQUEST["lang"][$i];
	}


	$dirRoot = $_SERVER["DOCUMENT_ROOT"];
	////////////////////////////////////////////////////////////////////////////////////////////////
	$upfileformname = "img";

	if (isset($_FILES[$upfileformname]) && !$_FILES[$upfileformname]['error']) {
		// 허용할 이미지 종류
		//echo "2";
		$imageKind = array ('image/pjpeg', 'image/jpeg', 'image/JPG', 'image/GIF', 'image/gif', 'image/X-PNG', 'image/PNG', 'image/png', 'image/x-png');

		if (in_array($_FILES[$upfileformname]['type'], $imageKind)) {

			$img_name = $_FILES[$upfileformname]['name'];

			$img_size = $_FILES[$upfileformname]['size'];

			$ext=substr(strrchr($_FILES[$upfileformname]['name'],'.'),1);

			$new_img = time()."_img.".$ext;

			if (move_uploaded_file ($_FILES[$upfileformname]['tmp_name'], "../../data/{$table}/{$new_img}")) {
				$img = "/data/{$table}/".$new_img;

			}


		} else { // 3-3.허용된 이미지 타입이 아닌경우

			error('[오류] 이미지(jpg,gif,png)만 업로드 가능합니다.',"");
			exit();
		}//if , inarray
	} //if , isset

	// 임시파일이 존재하는 경우 삭제
	if (file_exists ($_FILES[$upfileformname]['tmp_name']) && is_file($_FILES[$upfileformname]['tmp_name']) ) {
		unlink ($_FILES[$upfileformname]['tmp_name']);
	}

	/////////////////////////////////////////////////////////////////////////////////////////////////////

	$sql = "INSERT INTO {$table}
	(
	    title
	    , url
	    , img
	    , content
	    , lang
	    , regdate
		, del_yn
	)
	VALUES
	(
	    '$title'
	    ,'$url'
	    ,'$img'
	    ,'$content'
	    ,'$lang'
	    ,'$regdate'
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
	$title 	= addslashes($_REQUEST['title']);
	$content = addslashes($_REQUEST['content']);
	$url = $_REQUEST['url'];
	$regdate = $_REQUEST['regdate'];


	$lang = "";
	for($i=0;$i<count($_REQUEST["lang"]);$i++)
	{
		if($lang) $lang .= "|";
		$lang .= $_REQUEST["lang"][$i];
	}


	$dirRoot = $_SERVER["DOCUMENT_ROOT"];
	////////////////////////////////////////////////////////////////////////////////////////////////
	$upfileformname = "img";

	if (isset($_FILES[$upfileformname]) && !$_FILES[$upfileformname]['error']) {
		// 허용할 이미지 종류
		//echo "2";
		$imageKind = array ('image/pjpeg', 'image/jpeg', 'image/JPG', 'image/GIF', 'image/gif', 'image/X-PNG', 'image/PNG', 'image/png', 'image/x-png');

		if (in_array($_FILES[$upfileformname]['type'], $imageKind)) {

			$img_name = $_FILES[$upfileformname]['name'];

			$img_size = $_FILES[$upfileformname]['size'];

			$ext=substr(strrchr($_FILES[$upfileformname]['name'],'.'),1);

			$new_img = time()."_img.".$ext;

			if (move_uploaded_file ($_FILES[$upfileformname]['tmp_name'], "../../data/{$table}/{$new_img}")) {
				$img = "/data/{$table}/".$new_img;

			}


		} else { // 3-3.허용된 이미지 타입이 아닌경우

			error('[오류] 이미지(jpg,gif,png)만 업로드 가능합니다.',"");
			exit();
		}//if , inarray
	} //if , isset

	// 임시파일이 존재하는 경우 삭제
	if (file_exists ($_FILES[$upfileformname]['tmp_name']) && is_file($_FILES[$upfileformname]['tmp_name']) ) {
		unlink ($_FILES[$upfileformname]['tmp_name']);
	}

	/////////////////////////////////////////////////////////////////////////////////////////////////////

	$sql = "UPDATE {$table} SET
	     title = '$title'
	    ,url = '$url'
	    ";
		if($img){
			$sql .= ",img = '$img'";
		}
	$sql .= "
	    ,content = '$content'
	    ,lang = '$lang'
	    ,regdate = '$regdate'
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
