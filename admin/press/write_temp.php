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
	$content = $row->content;

	$url = $row->url;
	$img = $row->img;

	$lang = $row->lang;

	$regdate = $row->regdate;

	$regdate = substr($regdate,0,10);


	if(!$row) error("삭제되거나 존재하지 않는 게시물입니다.");

}

if($regdate == ""){
	$regdate = date("Y-m-d");
}


?>
<script>
function del_img(table, param){
	if(confirm("이미지를 삭제하시겠습니까?")){
		var FormObj = document.frm;
		$("#func_type").val('del_img');
		$("#param").val(param);
		FormObj.target = "func" ; // 팝업윈도우 객체
		FormObj.action = "proc.php"; //
		FormObj.submit();

		FormObj.target = "_self" ; // 팝업윈도우 객체
	}
}

$(function(){
    $('#regdate').datepicker();


});

</script>
<script type="text/javascript" src="/lib/nEditer/js/HuskyEZCreator.js" charset="utf-8"></script>
<h1><?=$mode_txt?></h1>

<form action="proc.php" name="frm" id="frm" method="post" enctype="multipart/form-data" onsubmit="submitContents(this);">
<input type="hidden" name="func_type" id="func_type" value="<?=$mode?>" />
<input type="hidden" name="idx" id="idx" value="<?=$idx?>" />
<input type="hidden" name="param" id="param" value="<?=$param?>" />
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
            <input type="text" class="tbl_wrt_text" style="width:95%;" name="title" id="title" value="<?=$title?>" />

        </td>
    </tr>
   <tr  class="img_type">
        <th>커버 이미지</th>
        <td>
        <?php
		if($img) {
		?>
        <img src="<?=$img?>" style="max-width:600px;"/>
        <br /><span class="button red"><input type="button" onclick="del_img('<?=$table?>','img')" value="삭제" /></span><br /><br />
        <?php } else {?>

        <input type="file" class="input_text" style="width:600px; padding:2px;" name="img" id="img" />
        <?php } ?>
     	</td>
    </tr>
    <tr>
        <th>내용</th>
        <td>
        	<textarea class="textarea" style="width:95%; height:350px;" id="ir" name="content"><?=$content?></textarea>
        </td>
    </tr>

	<tr>
        <th>원문</th>
        <td>
            <input type="text" class="tbl_wrt_text" style="width:95%;" name="url" id="url" value="<?=$url?>" />

        </td>
    </tr>
   <tr>
        <th>표시언어</th>
        <td>
        	<input type="checkbox" class="i_check" name="lang[]" value="all" id="all" <?=checks('all',$lang)?> /><label class="i_label" for="all">전체</label>
        	<input type="checkbox" class="i_check" name="lang[]" value="ko" id="ko" <?=checks('ko',$lang)?> /><label class="i_label" for="ko">한국어</label>
        	<input type="checkbox" class="i_check" name="lang[]" value="en" id="en" <?=checks('en',$lang)?> /><label class="i_label" for="en">영어</label>
        	<input type="checkbox" class="i_check" name="lang[]" value="cn" id="cn" <?=checks('cn',$lang)?> /><label class="i_label" for="cn">중국어</label>
        	<input type="checkbox" class="i_check" name="lang[]" value="jp" id="jp" <?=checks('jp',$lang)?> /><label class="i_label" for="jp">일본어</label>
        </td>

    </tr>
    <tr>
        <th>등록일</th>
        <td>
            <input type="text" class="tbl_wrt_text" style="width:120px;" name="regdate" id="regdate" value="<?=$regdate?>" />

        </td>
    </tr>

    </tbody>
</table>
<div class="btn_center">
	<span class="button large"><input type="button" onClick="history.back();" value="목록" /></span>
	<span class="button blue large"><input type="submit" value="저장하기" /></span>
</div>
</form>
<script>
var oEditors = [];

// 추가 글꼴 목록
//var aAdditionalFontSet = [["MS UI Gothic", "MS UI Gothic"], ["Comic Sans MS", "Comic Sans MS"],["TEST","TEST"]];

nhn.husky.EZCreator.createInIFrame({
	oAppRef: oEditors,
	elPlaceHolder: "ir",
	sSkinURI: "/lib/nEditer/SmartEditor2Skin.html",
	htParams : {
		bUseToolbar : true,				// 툴바 사용 여부 (true:사용/ false:사용하지 않음)
		bUseVerticalResizer : true,		// 입력창 크기 조절바 사용 여부 (true:사용/ false:사용하지 않음)
		bUseModeChanger : true,			// 모드 탭(Editor | HTML | TEXT) 사용 여부 (true:사용/ false:사용하지 않음)
		//aAdditionalFontList : aAdditionalFontSet,		// 추가 글꼴 목록
		fOnBeforeUnload : function(){
			//alert("완료!");
		}
	}, //boolean
	fOnAppLoad : function(){
		//예제 코드
		//oEditors.getById["ir1"].exec("PASTE_HTML", ["로딩이 완료된 후에 본문에 삽입되는 text입니다."]);
	},
	fCreator: "createSEditor2"
});


function submitContents(elClickedObj) {
	oEditors.getById["ir"].exec("UPDATE_CONTENTS_FIELD", []);	// 에디터의 내용이 textarea에 적용됩니다.
	// 에디터의 내용에 대한 값 검증은 이곳에서 document.getElementById("ir1").value를 이용해서 처리하면 됩니다.


	try {
		elClickedObj.form.submit();
	} catch(e) {}
}

</script>
<?php include $_SERVER['DOCUMENT_ROOT']."/admin/footer.php";?>
