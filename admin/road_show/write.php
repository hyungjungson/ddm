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
		$title_sub = $row->title_sub;
		$url = $row->url;
		$img = $row->img;

		if(!$row) error("삭제되거나 존재하지 않는 게시물입니다.");
	}
?>

<script>
function submitContents() {
	if($("#title").val() == "") {
		alert("제목을 입력해주세요.");
		$("#title").focus();
		return false;
	}
	if($("#title_sub").val() == "") {
		alert("소제목(카테고리)을 입력해주세요.");
		$("#title_sub").focus();
		return false;
	}

	if($("#url").val() == "") {
		alert("유튜브 동영상 링크주소를 입력해주세요.");
		$("#url").focus();
		return false;
	}
	$("#frm").submit();
}

function goList(){
	var pn = "<?=$page_now?>";
	if(pn != ""){
		location.href = "/admin/road_show?page_now="+pn;
	} else {
		location.href = "/admin/road_show";
	}
}

function goDel(){
	if(confirm("삭제하시겠습니까?")){
		$("#func_type").val("del");
		$("#frm").submit();
	}
}

function del_img(){
	if(confirm("이미지를 삭제하시겠습니까?")){
		$("#oldImg").hide();
		$("#newImg").show();
	}
}

var sel_file;
$(document).ready(function(){
	$("#input_img").on("change",handleImgFileSelect);
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
			  <strong>ROAD SHOW</strong> <?=$mode_txt?>
			</div>
			<div class="card-body card-block">
				<form action="proc.php" name="frm" id="frm" method="post" enctype="multipart/form-data" class="form-horizontal">
				<input type="hidden" name="func_type" id="func_type" value="<?=$mode?>" />
				<input type="hidden" name="idx" id="idx" value="<?=$idx?>" />
				<input type="hidden" name="page_now" value="<?=$page_now?>" />
				<input type="hidden" name="search_text" value="<?=$search_text?>" />
				<input type="hidden" name="search_type" value="<?=$search_type?>" />
				<input type="hidden" name="table" value="<?=$table?>" />
				<input type="hidden" name="chk_img" id="chk_img" value="N" />

				<div class="row form-group">
					<div class="col col-md-2"><label for="title" class=" form-control-label">제목</label></div>
					<div class="col-12 col-md-10">
						<input type="text" name="title" id="title" value="<?=$title?>" placeholder="제목을 입력해주세요." class="form-control"/>
					</div>
				</div>
				
				<div class="row form-group">
					<div class="col col-md-2"><label for="title_sub" class=" form-control-label">소제목(카테고리)</label></div>
					<div class="col-12 col-md-10">
						<input type="text" name="title_sub" id="title_sub" value="<?=$title_sub?>" placeholder="소제목(카테고리)을 입력해주세요." class="form-control"/>
					</div>
				</div>

				<div class="row form-group">
					<div class="col col-md-2"><label for="url" class=" form-control-label">링크주소</label></div>
					<div class="col-12 col-md-10">
						<input type="text" name="url" id="url" value="<?=$url?>" placeholder="유튜브 영상 링크주소를 입력해주세요." class="form-control"/>
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
							<img id="img" style="max-height:100px;"/>
						</div>
					</div>
				</div>

			  </form>
			</div>
			<div class="card-footer">
			  <button type="button" class="btn btn-primary btn-sm" onClick="submitContents();">
				<i class="fa fa-dot-circle-o"></i> <?=$mode_txt?>
			  </button>
			  <button type="button" class="btn btn-secondary btn-sm" onClick="goList();">
				<i class="fa fa-list"></i> <?=$mode_ban_txt?>
			  </button>
			  <?php if($idx){?>
			  <button type="button" class="btn btn-danger btn-sm" onClick="goDel();">
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
