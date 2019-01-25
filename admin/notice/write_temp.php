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

	$title_ko = $row->title_ko;
	$content_ko = $row->content_ko;

	$title_en = $row->title_en;
	$content_en = $row->content_en;

	$title_cn = $row->title_cn;

	$content_cn = $row->content_cn;

	$title_jp = $row->title_jp;
	$content_jp = $row->content_jp;

	if(!$row) error("삭제되거나 존재하지 않는 게시물입니다.");

}



?>
<script type="text/javascript" src="/lib/nEditer/js/HuskyEZCreator.js" charset="utf-8"></script>
<h1><?=$mode_txt?></h1>

<form action="proc.php" name="frm" id="frm" method="post" enctype="multipart/form-data" onsubmit="submitContents(this);">
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
        <th>타이틀(한국어)</th>
        <td>
            <input type="text" class="tbl_wrt_text" style="width:95%;" name="title_ko" id="title_ko" value="<?=$title_ko?>" />

        </td>
    </tr>

    <tr>
        <th>내용(한국어)</th>
        <td>
        	<textarea class="textarea" style="width:95%; height:350px;" id="ir_ko" name="content_ko"><?=$content_ko?></textarea>
        </td>
    </tr>

	<tr>
        <th>타이틀(영어)</th>
        <td>
            <input type="text" class="tbl_wrt_text" style="width:95%;" name="title_en" id="title_en" value="<?=$title_en?>" />

        </td>
    </tr>

    <tr>
        <th>내용(영어)</th>
        <td>
        	<textarea class="textarea" style="width:95%; height:350px;" id="ir_en" name="content_en"><?=$content_en?></textarea>
        </td>
    </tr>

	<tr>
        <th>타이틀(중국어)</th>
        <td>
            <input type="text" class="tbl_wrt_text" style="width:95%;" name="title_cn" id="title_cn" value="<?=$title_cn?>" />

        </td>
    </tr>

    <tr>
        <th>내용(중국어)</th>
        <td>
        	<textarea class="textarea" style="width:95%; height:350px;" id="ir_cn" name="content_cn"><?=$content_cn?></textarea>
        </td>
    </tr>

	<tr>
        <th>타이틀(일어)</th>
        <td>
            <input type="text" class="tbl_wrt_text" style="width:95%;" name="title_jp" id="title_jp" value="<?=$title_jp?>" />

        </td>
    </tr>

    <tr>
        <th>내용(일어)</th>
        <td>
        	<textarea class="textarea" style="width:95%; height:350px;" id="ir_jp" name="content_jp"><?=$content_jp?></textarea>
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
	elPlaceHolder: "ir_ko",
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

nhn.husky.EZCreator.createInIFrame({
	oAppRef: oEditors,
	elPlaceHolder: "ir_en",
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


nhn.husky.EZCreator.createInIFrame({
	oAppRef: oEditors,
	elPlaceHolder: "ir_cn",
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


nhn.husky.EZCreator.createInIFrame({
	oAppRef: oEditors,
	elPlaceHolder: "ir_jp",
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
	oEditors.getById["ir_ko"].exec("UPDATE_CONTENTS_FIELD", []);	// 에디터의 내용이 textarea에 적용됩니다.
	oEditors.getById["ir_en"].exec("UPDATE_CONTENTS_FIELD", []);	// 에디터의 내용이 textarea에 적용됩니다.
	oEditors.getById["ir_cn"].exec("UPDATE_CONTENTS_FIELD", []);	// 에디터의 내용이 textarea에 적용됩니다.
	oEditors.getById["ir_jp"].exec("UPDATE_CONTENTS_FIELD", []);	// 에디터의 내용이 textarea에 적용됩니다.
	// 에디터의 내용에 대한 값 검증은 이곳에서 document.getElementById("ir1").value를 이용해서 처리하면 됩니다.


	try {
		elClickedObj.form.submit();
	} catch(e) {}
}

</script>
<?php include $_SERVER['DOCUMENT_ROOT']."/admin/footer.php";?>
