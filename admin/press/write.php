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

		$title = $row->title;
		$content = $row->content;
		$url = $row->url;
		$img = $row->img;
		$lang = $row->lang;
		$regdate = $row->regdate;
		$regdate = substr($regdate,0,10);

		if(!$row) error("삭제되거나 존재하지 않는 게시물입니다.");
	}
?>

<script>
var oEditors = [];

$(document).ready(function(){

	nhn.husky.EZCreator.createInIFrame({
		oAppRef: oEditors,
		elPlaceHolder: "ir",
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
	oEditors.getById["ir"].exec("UPDATE_CONTENTS_FIELD", []);	// 에디터의 내용이 textarea에 적용됩니다.

	if($("#title").val() == "") {
		alert("제목을 입력해주세요.");
		$("#title").focus();
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

var sel_file;
$(document).ready(function(){
	$("#input_img").on("change",handleImgFileSelect);

	$( "#regdate" ).datepicker({
		dateFormat: "yy-mm-dd"
	});
});

function handleImgFileSelect(e){
	var files = e.target.files;
	var filesArr = Array.prototype.slice.call(files);
	filesArr.forEach(function(f){
		if(!f.type.match("image.*")){
			alert("확장자는 이미지 확장자만 가능합니다.");
			return;
		}
		sel_file = f;

		var reader = new FileReader();
		reader.onload = function(e){
			$("#img").attr("src", e.target.result);
		}
		reader.readAsDataURL(f);
	});
}

</script>
<style> textarea.form-control { width: 99%; } </style>

<!-- Right Panel -->
<div id="right-panel" class="right-panel">

	<!-- Header-->
	<?php include "../common/mem_header.php"; ?>
	<!-- /header -->
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<script type="text/javascript" src="/lib/nEditer/js/HuskyEZCreator.js" charset="utf-8"></script>

	<div class="content mt-3">
		<div class="col-xl-12">
		  <div class="card">
			<div class="card-header">
			  <strong>보도자료</strong> <?=$mode_txt?>
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
					<div class="col col-md-2"><label for="title" class=" form-control-label">제목</label></div>
					<div class="col-12 col-md-10">
						<input type="text" name="title" id="title" value="<?=$title?>" placeholder="제목을 입력해주세요." class="form-control"/>
					</div>
				</div>

				<div class="row form-group">
					<div class="col col-md-2"><label for="url" class=" form-control-label">원문링크</label></div>
					<div class="col-12 col-md-10">
						<input type="text" name="url" id="url" value="<?=$url?>" placeholder="원문링크를 입력해주세요." class="form-control"/>
					</div>
				</div>

				<div class="row form-group">
					<div class="col col-md-2"><label for="regdate" class=" form-control-label">등록일</label></div>
					<div class="col-12 col-md-10">
						<div class="input-group">
							<div class="input-group-addon"><i class="fa fa-calendar"></i></div>
							<input type="text" name="regdate" id="regdate" value="<?=$regdate?>" placeholder="등록일을 입력해주세요." class="form-control">
						</div>
					</div>
				</div>

				<div class="row form-group">
					<div class="col col-md-2"><label for="all" class=" form-control-label">표시언어</label></div>
					<div class="col-12 col-md-10">
						<div class="form-check-inline form-check">
							<label for="all" class="form-check-label ">
								<input type="checkbox" id="all" name="lang[]" value="all" class="form-check-input" <?=checks('all',$lang)?> />전체
							</label>
							<label for="ko" class="form-check-label ">
								<input type="checkbox" id="ko" name="lang[]" value="ko" class="form-check-input" <?=checks('ko',$lang)?> />국문
							</label>
							<label for="en" class="form-check-label ">
								<input type="checkbox" id="en" name="lang[]" value="en" class="form-check-input" <?=checks('en',$lang)?> />영문
							</label>
							<label for="cn" class="form-check-label ">
								<input type="checkbox" id="cn" name="lang[]" value="cn" class="form-check-input" <?=checks('cn',$lang)?> />중문
							</label>
							<label for="jp" class="form-check-label ">
								<input type="checkbox" id="jp" name="lang[]" value="jp" class="form-check-input" <?=checks('jp',$lang)?> />일문
							</label>
						</div>
					</div>
				</div>

				<div class="row form-group">
					<div class="col col-md-2"><label for="title_cn" class=" form-control-label">커버이미지</label></div>
					<div class="col-12 col-md-10" id="imgbox">

						<div id="oldImg" <?php if(!$img) { ?>style="display:none;" <?php } ?>>
					        <img src="<?=$img?>" style="max-width:600px;"/>
					        &nbsp;
							<button type="button" class="btn btn-danger btn-sm" onClick="del_img();">
								<i class="fa fa-ban"></i> 삭제
							</button>
						</div>
						<div id="newImg" <?php if($img) { ?>style="display:none;" <?php } ?>>
					        <input type="file" class="input_text" style="width:600px; padding:2px;" name="img" id="input_img" />
							<img id="img" style="max-height:300px;"/>
						</div>
					</div>
				</div>



				<div class="row form-group">
				  <div class="col col-md-2"><label for="ir" class="form-control-label">내용</label></div>
				  <div class="col-12 col-md-10">
					  <textarea id="ir" name="content" rows="9" placeholder="내용" class="form-control"><?=$content?></textarea>
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
