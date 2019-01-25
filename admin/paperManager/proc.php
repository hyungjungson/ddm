<?php
include $_SERVER['DOCUMENT_ROOT']."/admin/proc.php";

    $idx = $_REQUEST['idx'];
	$del_yn = $_REQUEST['del_yn_'.$idx];
	$dirRoot = $_SERVER["DOCUMENT_ROOT"];
    //echo "idx : ".$idx."<br/>";
    //echo "del_yn : ".$del_yn."<br/>";

	////////////////////////////////////////////////////////////////////////////////////////////////
	$upfileformname = "file_".$idx;
    $img_name = "";


	if (isset($_FILES[$upfileformname]) && !$_FILES[$upfileformname]['error']) {
		// 허용할 파일 종류
		$fileKind = array ('application/pdf');

		if (in_array($_FILES[$upfileformname]['type'], $fileKind)) {
			$img_name = $_FILES[$upfileformname]['name'];
            //echo "img_name : ".$img_name."<br/>";
			$img_size = $_FILES[$upfileformname]['size'];
            //echo "img_size : ".$img_size."<br/>";
			$ext=substr(strrchr($_FILES[$upfileformname]['name'],'.'),1);
			$new_img = time()."_paper.".$ext;
            //echo "new_img : ".$new_img."<br/>";

			if (move_uploaded_file ($_FILES[$upfileformname]['tmp_name'], "../../data/paper/{$new_img}")) {
				$img = "/data/paper/".$new_img;
			}

		} else { // 3-3.허용된 이미지 타입이 아닌경우
			error('[오류] PDF파일만 업로드 가능합니다.',"");
			exit();
		}//if , inarray
	} //if , isset

	// 임시파일이 존재하는 경우 삭제
	if (file_exists ($_FILES[$upfileformname]['tmp_name']) && is_file($_FILES[$upfileformname]['tmp_name']) ) {
		unlink ($_FILES[$upfileformname]['tmp_name']);
	}

	/////////////////////////////////////////////////////////////////////////////////////////////////////

	$sql = "UPDATE paper SET
     del_yn = '$del_yn' ";
    if($img_name != "") {
        $sql = $sql." ,file = '$img_name', save_file = '$new_img'";
    }
    $sql = $sql." WHERE idx = '$idx'";
    $res = $db->query($sql);

	$res_msg = "수정되었습니다.";
	$go_url = "/admin/paperManager/";

    error($res_msg,$go_url);
?>
