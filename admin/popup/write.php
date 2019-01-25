<!-- Header -->
<?php include "../common/header.php"; ?>
<!-- Header -->

<!-- Left Panel -->
<?php include "../common/left_panel.php"; ?>
<!-- Left Panel -->

<?php
	$table = $_REQUEST['table'];
	$idx = $_REQUEST['idx'];
	$page_now = $_REQUEST['page_now'];
	$search_text = $_REQUEST['search_text'];
	$search_type = $_REQUEST['search_type'];

	$mode = "write";
	$mode_txt = "등록";
	$mode_ban_txt = "취소";

	if($idx){
		$mode = "edit";
		$mode_txt = "수정";
		$mode_ban_txt = "목록";
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

<script>
var oEditors = [];

$(document).ready(function(){

	nhn.husky.EZCreator.createInIFrame({
		oAppRef: oEditors,
		elPlaceHolder: "ir_ko",
		sSkinURI: "/lib/nEditer/SmartEditor2Skin.html",
		htParams : {
			bUseToolbar : true,				// 툴바 사용 여부 (true:사용/ false:사용하지 않음)
			bUseVerticalResizer : true,		// 입력창 크기 조절바 사용 여부 (true:사용/ false:사용하지 않음)
			bUseModeChanger : true,			// 모드 탭(Editor | HTML | TEXT) 사용 여부 (true:사용/ false:사용하지 않음)
			fOnBeforeUnload : function(){}
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
			fOnBeforeUnload : function(){}
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
			fOnBeforeUnload : function(){}
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
			fOnBeforeUnload : function(){}
		}, //boolean
		fOnAppLoad : function(){
			//예제 코드
			//oEditors.getById["ir1"].exec("PASTE_HTML", ["로딩이 완료된 후에 본문에 삽입되는 text입니다."]);
		},
		fCreator: "createSEditor2"
	});

});

function submitContents() {
	oEditors.getById["ir_ko"].exec("UPDATE_CONTENTS_FIELD", []);	// 에디터의 내용이 textarea에 적용됩니다.
	oEditors.getById["ir_en"].exec("UPDATE_CONTENTS_FIELD", []);	// 에디터의 내용이 textarea에 적용됩니다.
	oEditors.getById["ir_cn"].exec("UPDATE_CONTENTS_FIELD", []);	// 에디터의 내용이 textarea에 적용됩니다.
	oEditors.getById["ir_jp"].exec("UPDATE_CONTENTS_FIELD", []);	// 에디터의 내용이 textarea에 적용됩니다.
	// 에디터의 내용에 대한 값 검증은 이곳에서 document.getElementById("ir1").value를 이용해서 처리하면 됩니다.

	if($("#title_ko").val() == "") {
		alert("제목을 입력해주세요.");
		$("#title_ko").focus();
		return false;
	}
	$("#frm").submit();
}

function goList(){
	var pn = "<?=$page_now?>";
	if(pn != ""){
		location.href = "/admin/notice?page_now="+pn;
	} else {
		location.href = "/admin/notice";
	}
}

function goDel(){
	if(confirm("삭제하시겠습니까?")){
		$("#func_type").val("del");
		$("#frm").submit();
	}
}

</script>
<style> textarea.form-control { width: 99%; } </style>

<!-- Right Panel -->
<div id="right-panel" class="right-panel">

	<!-- Header-->
	<?php include "../common/mem_header.php"; ?>
	<!-- /header -->
	<script type="text/javascript" src="/lib/nEditer/js/HuskyEZCreator.js" charset="utf-8"></script>

	<div class="content mt-3">
		<div class="col-xl-12">
		  <div class="card">
			<div class="card-header">
			  <strong>팝업</strong> <?=$mode_txt?>
				<?php if($idx){?>
					<button type="reset" class="btn btn-danger btn-sm float-right mx-1" onClick="goDel();">
						<i class="fa fa-ban"></i> 삭제
					</button>
				<?php } ?>
				<button type="reset" class="btn btn-secondary btn-sm float-right mx-1" onClick="goList();">
					<i class="fa fa-list"></i> <?=$mode_ban_txt?>
				</button>
				<button type="submit" class="btn btn-primary btn-sm float-right mx-1" onClick="submitContents();">
					<i class="fa fa-dot-circle-o"></i> <?=$mode_txt?>
				</button>
			</div>
			<div class="card-body card-block">
				<form action="proc.php" name="frm" id="frm" method="post" enctype="multipart/form-data" class="form-horizontal">
				<input type="hidden" name="func_type" id="func_type" value="<?=$mode?>" />
				<input type="hidden" name="idx" id="idx" value="<?=$idx?>" />
				<input type="hidden" name="page_now" value="<?=$page_now?>" />
				<input type="hidden" name="search_text" value="<?=$search_text?>" />
				<input type="hidden" name="search_type" value="<?=$search_type?>" />
				<input type="hidden" name="table" value="<?=$table?>" />

				<div class="row form-group">
					<div class="col col-md-2"><label for="title_ko" class=" form-control-label">제목(국문)</label></div>
					<div class="col-12 col-md-10">
						<input type="text" name="title_ko" id="title_ko" value="<?=$title_ko?>" placeholder="국문 홈페이지에서 표시될 공지사항 제목을 입력해주세요." class="form-control"/>
					</div>
				</div>

				<div class="row form-group">
				  <div class="col col-md-2"><label for="textarea-input" class=" form-control-label">내용(국문)</label></div>
				  <div class="col-12 col-md-10">
					  <textarea id="ir_ko" name="content_ko" rows="9" placeholder="내용(국문)" class="form-control"><?=$content_ko?></textarea>
				  </div>
				</div>

				<div class="row form-group">
					<div class="col col-md-2"><label for="title_en" class=" form-control-label">제목(영문)</label></div>
					<div class="col-12 col-md-10">
						<input type="text" name="title_en" id="title_en" value="<?=$title_en?>" placeholder="영문 홈페이지에서 표시될 공지사항 제목을 입력해주세요." class="form-control"/>
					</div>
				</div>

				<div class="row form-group">
				  <div class="col col-md-2"><label for="ir_en" class=" form-control-label">내용(영문)</label></div>
				  <div class="col-12 col-md-10">
					  <textarea id="ir_en" name="content_en" rows="9" placeholder="내용(영문)" class="form-control"><?=$content_en?></textarea>
				  </div>
				</div>

				<div class="row form-group">
					<div class="col col-md-2"><label for="title_cn" class=" form-control-label">제목(중문)</label></div>
					<div class="col-12 col-md-10">
						<input type="text" name="title_cn" id="title_cn" value="<?=$title_cn?>" placeholder="중문 홈페이지에서 표시될 공지사항 제목을 입력해주세요." class="form-control"/>
					</div>
				</div>

				<div class="row form-group">
				  <div class="col col-md-2"><label for="ir_cn" class=" form-control-label">내용(중문)</label></div>
				  <div class="col-12 col-md-10">
					  <textarea id="ir_cn" name="content_cn" rows="9" placeholder="내용(중문)" class="form-control"><?=$content_cn?></textarea>
				  </div>
				</div>

				<div class="row form-group">
					<div class="col col-md-2"><label for="title_jp" class=" form-control-label">제목(일문)</label></div>
					<div class="col-12 col-md-10">
						<input type="text" name="title_jp" id="title_jp" value="<?=$title_jp?>" placeholder="일문 홈페이지에서 표시될 공지사항 제목을 입력해주세요." class="form-control"/>
					</div>
				</div>

				<div class="row form-group">
				  <div class="col col-md-2"><label for="ir_jp" class=" form-control-label">내용(일문)</label></div>
				  <div class="col-12 col-md-10">
					  <textarea id="ir_jp" name="content_jp" rows="9" placeholder="내용(일문)" class="form-control"><?=$content_jp?></textarea>
				  </div>
				</div>

			  </form>
			</div>
			<div class="card-footer">
			  <button type="submit" class="btn btn-primary btn-sm" onClick="submitContents();">
				<i class="fa fa-dot-circle-o"></i> <?=$mode_txt?>
			  </button>
			  <button type="reset" class="btn btn-secondary btn-sm" onClick="goList();">
				<i class="fa fa-list"></i> <?=$mode_ban_txt?>
			  </button>
			  <?php if($idx){?>
			  <button type="reset" class="btn btn-danger btn-sm" onClick="goDel();">
				<i class="fa fa-ban"></i> 삭제
			  </button>
		  <?php } ?>
			</div>
		  </div>
		</div>
	</div> <!-- .content -->
</div><!-- /#right-panel -->
<!-- Right Panel -->

<!-- footer -->
<?php include "../common/footer.php"; ?>
<!-- footer -->
