<?php include $_SERVER['DOCUMENT_ROOT']."/admin/header.php";?>
<?php
$table = $_REQUEST['table'];

$idx = $_REQUEST['idx'];
$page_now = $_REQUEST['page_now'];
$search_text = $_REQUEST['search_text'];
$search_type = $_REQUEST['search_type'];

$mode = "write";
$mode_txt = "등록";

if($idx){
	$mode = "edit";
	$mode_txt = "수정";
	$sql = "SELECT * FROM {$table} WHERE idx = {$idx}";
	$row = $db->get_row($sql);

	$title = $row->title;
	$url = $row->url;
	$img = $row->img;

	if(!$row) error("삭제되거나 존재하지 않는 게시물입니다.");


}



?>
<script>
function del_img(table){
	if(confirm("이미지를 삭제하시겠습니까?")){
		var FormObj = document.frm;
		$("#func_type").val('del_img');
		FormObj.target = "func" ; // 팝업윈도우 객체
		FormObj.action = "proc.php"; //
		FormObj.submit();

		FormObj.target = "_self" ; // 팝업윈도우 객체
	}
}

function del_img_detail(table,idx){
	if(confirm("이미지를 삭제하시겠습니까?")){
		var FormObj = document.frm;
		$("#func_type").val('del_img_detail');
		$("#idx").val(idx);
		FormObj.target = "func" ; // 팝업윈도우 객체
		FormObj.action = "proc.php"; //
		FormObj.submit();

		FormObj.target = "_self" ; // 팝업윈도우 객체
	}
}
</script>
<h1><?=$mode_txt?></h1>

<form action="proc.php" name="frm" id="frm" method="post" enctype="multipart/form-data">
<input type="hidden" name="func_type" id="func_type" value="<?=$mode?>" />
<input type="hidden" name="idx" id="idx" value="<?=$idx?>" />
<input type="hidden" name="page_now" value="<?=$page_now?>" />
<input type="hidden" name="search_text" value="<?=$search_text?>" />
<input type="hidden" name="search_type" value="<?=$search_type?>" />
<input type="hidden" name="table" value="<?=$table?>" />
<table class="tbl_wrt" cellpadding="0" cellspacing="0">
	<thead>
	<colgroup>
    	<col width="200" />
        <col width="" />
    </colgroup>
	</thead>
    <tbody>

   <tr>
        <th>타이틀</th>
        <td>
            <input type="text" class="tbl_wrt_text" style="width:620px;" name="title" id="title" value="<?=$title?>" />

        </td>
    </tr>

	<tr>
        <th>링크주소</th>
        <td>
            <input type="text" class="tbl_wrt_text" style="width:620px;" name="url" id="url" value="<?=$url?>" />

        </td>
    </tr>

    <tr  class="img_type">
        <th>커버이미지</th>
        <td>
        <?php
		if($img) {
		?>
        <img src="<?=$img?>" style="max-width:600px;"/>
        <br /><span class="button red"><input type="button" onclick="del_img('<?=$table?>')" value="삭제" /></span><br /><br />
        <?php } else {?>

        <input type="file" class="input_text" style="width:600px; padding:2px;" name="img" id="img" />
        <?php } ?>
     	</td>
    </tr>

    </tbody>
</table>
<div class="btn_center">
	<span class="button large"><input type="button" onClick="history.back();" value="목록" /></span>
	<span class="button blue large"><input type="submit" value="저장하기" /></span>
</div>
</form>

<?php include $_SERVER['DOCUMENT_ROOT']."/admin/footer.php";?>
