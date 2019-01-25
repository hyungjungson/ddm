<?php include "../common/header.php"; ?>

<script>

var idChk = /^[a-zA-Z0-9]{4,12}$/ // 아이디가 적합한지 검사할 정규식
var pwChk = /^[a-zA-Z0-9]{6,20}$/ // 패스워드가 적합한지 검사할 정규식

	function submitContents() {
		if($("#mem_id").val() == "") {
			alert("아이디를 입력해주세요.");
			$("#mem_id").focus();
			return false;
		}

		if(!idChk.test($("#mem_id").val())) {
			alert("아이디는 4자이상 12자 이하로 설정해주세요.");
            return false;
        }



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

		if($("#mem_nm").val() == "") {
			alert("이름을 입력해주세요.");
			$("#mem_nm").focus();
			return false;
		}

		if($("#mem_email").val() == "") {
			alert("이메일 아이디를 입력해주세요.");
			$("#mem_email").focus();
			return false;
		}

		$("#frm").submit();
	}

	function goBack(){
		if( confirm("입력된 정보는 저장되지 않습니다.") ){
			location.href = "/admin";
		}
	}
</script>

<!-- Right Panel -->
<div id="right-panel" class="right-panel">

	<div class="content mt-3">
		<div class="col-6 col-xl-12">
		  <div class="card">
			<div class="card-header">
			  <strong>관리자 등록요청</strong>
			</div>
			<div class="card-body card-block">
				<form action="proc" name="frm" id="frm" method="post" enctype="multipart/form-data" class="form-horizontal">
				<input type="hidden" name="func_type" id="func_type" value="write" />

				<div class="row form-group">
					<div class="col col-md-2"><label for="mem_id" class=" form-control-label">아이디</label></div>
					<div class="col-12 col-md-10">
						<input type="text" name="mem_id" id="mem_id" placeholder="4자이상 12자 이하로 입력해주세요." maxlength="12" class="form-control"/>
					</div>
				</div>

				<div class="row form-group">
					<div class="col col-md-2"><label for="mem_nm" class=" form-control-label">이름</label></div>
					<div class="col-12 col-md-10">
						<input type="text" name="mem_nm" id="mem_nm" placeholder="관리자 승인 시 필요한 정보입니다. 실명을 입력해주세요." class="form-control"/>
					</div>
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

				<div class="row form-group">
					<div class="col col-md-2"><label for="mem_email" class=" form-control-label">이메일</label></div>
					<div class="col-12 col-md-10">
						<input type="text" name="mem_email" id="mem_email" placeholder="비즈메카에서 사용중인 이메일아이디를 입력해주세요." style="width:50%; float:left;" maxlength="30"  class="form-control"/>
						<span style="line-height: 30px;">&nbsp; @mileageto.com</span>
					</div>
				</div>
			  </form>
			</div>
			<div class="card-footer">
				<button type="reset" class="btn btn-danger btn-sm mx-1" onClick="goBack();">
  				  <i class="fa fa-ban"></i> 취소
  			  </button>
  				<button type="submit" class="btn btn-primary btn-sm mx-1" onClick="submitContents();">
  					<i class="fa fa-dot-circle-o"></i> 등록요청
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
