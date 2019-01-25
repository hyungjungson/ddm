<!-- Header -->
<?php include "../common/header.php"; ?>
<!-- Header -->

<!-- Left Panel -->
<?php include "../common/left_panel.php"; ?>
<!-- Left Panel -->

<?php
	$mode = "edit";
	$sql = "SELECT * FROM admin WHERE idx = {$sess_idx}";
	$row = $db->get_row($sql);

	$id = $row->id;
    $name = $row->name;
    $last_login = $row->last_login;
    $email = $row->email;
	$ip = $row->ip;

	if(!$row) error("삭제되거나 존재하지 않는 게시물입니다.");
?>

<script>

var idChk = /^[a-zA-Z0-9]{4,12}$/ // 아이디가 적합한지 검사할 정규식
var pwChk = /^[a-zA-Z0-9]{6,20}$/ // 패스워드가 적합한지 검사할 정규식

	function submitContents() {

		if($("#mem_pw").val() == "") {
			alert("패스워드를 입력해주세요.");
			$("#mem_pw").focus();
			return false;
		}

		if(!pwChk.test($("#mem_pw").val())) {
			alert("패스워드는 6자이상 20자 이하로 설정해주세요.");
            return false;
        }

		if($("#mem_pw").val() != $("#mem_pwc").val()) {
			alert("패스워드를 확인해주세요.");
			$("#mem_pwc").focus();
			return false;
		}

		$("#frm").submit();
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
			  <strong>My Profile</strong>
			</div>
			<div class="card-body card-block">
				<form action="proc.php" name="frm" id="frm" method="post" enctype="multipart/form-data" class="form-horizontal">
				<input type="hidden" name="func_type" id="func_type" value="<?=$mode?>" />
				<input type="hidden" name="idx" id="idx" value="<?=$sess_idx?>" />

				<div class="row form-group">
					<div class="col col-md-2"><label for="title_ko" class=" form-control-label">아이디</label></div>
					<div class="col-12 col-md-10"><?=$id?></div>
				</div>

				<div class="row form-group">
					<div class="col col-md-2"><label for="title_en" class=" form-control-label">이름</label></div>
					<div class="col-12 col-md-10"><?=$name?></div>
				</div>

				<div class="row form-group">
					<div class="col col-md-2"><label for="title_cn" class=" form-control-label">이메일</label></div>
					<div class="col-12 col-md-10"><?=$email?>@mileage.com</div>
				</div>

				<div class="row form-group">
					<div class="col col-md-2"><label for="title_jp" class=" form-control-label">아이피</label></div>
					<div class="col-12 col-md-10"><?=$ip?></div>
				</div>

				<div class="row form-group">
					<div class="col col-md-2"><label for="title_jp" class=" form-control-label">마지막 로그인 일시</label></div>
					<div class="col-12 col-md-10"><?=$last_login?></div>
				</div>

				<div class="row form-group">
					<div class="col col-md-2"><label for="mem_pw" class=" form-control-label">비밀번호</label></div>
					<div class="col-12 col-md-10">
						<input type="password" name="mem_pw" id="mem_pw" placeholder="6자 이상 입력해주세요." maxlength="20" class="form-control"/>
					</div>
				</div>

				<div class="row form-group">
					<div class="col col-md-2"><label for="mem_pwc" class=" form-control-label">비밀번호 확인</label></div>
					<div class="col-12 col-md-10">
						<input type="password" name="mem_pwc" id="mem_pwc" placeholder="입력하신 비밀번호를 다시한번 입력해주세요." maxlength="20" class="form-control"/>
					</div>
				</div>

			  </form>
			</div>
			<div class="card-footer">
			  <button type="submit" class="btn btn-primary btn-sm" onClick="submitContents();">
				<i class="fa fa-dot-circle-o"></i> 저장
			  </button>
			</div>
		  </div>
		</div>
	</div> <!-- .content -->
</div><!-- /#right-panel -->
<!-- Right Panel -->

<!-- footer -->
<?php include "../common/footer.php"; ?>
<!-- footer -->
