<!-- Header -->
<?php include "../common/header.php"; ?>
<!-- Header -->

<!-- Left Panel -->
<?php include "../common/left_panel.php"; ?>
<!-- Left Panel -->

<?php
if($sess_lev < 5){
	error("해당 메뉴의 접근 권한이 없습니다.",$sess_url);
	exit();
}

$search_type = $_REQUEST['search_type'];
if (!$search_type) $search_type = "P";
$lst_sql = "SELECT * from member WHERE mem_type = '".$search_type."' ORDER BY sort";
$res_sql = $db->get_results($lst_sql);

?>

<!-- Right Panel -->
<div id="right-panel" class="right-panel">

	<!-- Header-->
	<?php include "../common/mem_header.php"; ?>
	<!-- /header -->

	<script>
		function goDel(idx){
			if(confirm("삭제하시겠습니까?")){
				$("#frm").attr("action","proc.php");
				$("#func_type").val("del");
				$("#idx").val(idx);
				$("#frm").submit();
			}
		}

        function del_img(){
        	if(confirm("이미지를 삭제하시겠습니까?")){
        		$("#oldImg").hide();
        		$("#newImg").show();
        	}
        }
	</script>

	<style>
		.card-img{
			height: 230px;
			background-repeat : no-repeat !important;
			background-position: 0px !important;
			background-size: 100% !important;
		}
	</style>

	<form name="frm" action="<?=$_SERVER['PHP_SELF']?>" method="get" class="frm" id="frm">
		<input type="hidden" name="idx" id="idx" value=""/>
		<input type="hidden" name="func_type" id="func_type" value=""/>
	</form>

	<div class="content mt-3">
		<div class="col-xl-12">
			<div class="card">
				<div class="card-body">

					<div class="row">
						<!--/.col-->
						<div class="col-sm-8 hidden-sm-down">
							<button type="button" class="btn btn-outline-info float-right" onClick="location.href='write.php?table=<?=$table?>';"><i class="fa fa-download"></i> 추가</button>
						</div><!--/.col-->
					</div><!--/.row-->

					<nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link <?php echo $search_type == "P" ? "active" : "" ;?>" id="nav-p-tab" href="/admin/member" aria-selected="<?php echo $search_type == "P" ? "true" : "false" ;?>">Our Team</a>
                            <a class="nav-item nav-link <?php echo $search_type == "A" ? "active" : "" ;?>" id="nav-a-tab" href="/admin/member/?search_type=A"  aria-selected="<?php echo $search_type == "A" ? "true" : "false" ;?>">Trusted Advisors</a>
                        </div>
                    </nav>

					<div class="chart-wrapper mt-4" >

						<?php
							if ($res_sql) {
								foreach ($res_sql as $data) {
									$idx = $data->idx;
									$name_ko = $data->name_ko;
									$name_en = $data->name_en;
									$name_cn = $data->name_cn;
									$name_jp = $data->name_jp;
									$job_ko = $data->job_ko;
									$job_en = $data->job_en;
									$job_cn = $data->job_cn;
									$job_jp = $data->job_jp;
									$img = $data->img;
						?>

						<div class="col-xl-2 col-lg-6">
			                <section class="card">
			                    <div class="twt-feed blue-bg card-img" style="background-image:url('<?=$img?>');">
									<div class="corner-ribon black-ribon" style="cursor:pointer;" >
										<i class="fa fa-check-square" onClick="alert('저장');"></i>
			                            <i class="fa fa-minus-square" onClick="alert('삭제');"></i>
			                        </div>
			                    </div>
			                    <div class="twt-write col-sm-12 ">
									<div class="form-group">
										<label for="name_ko" class="control-label mb-1">국문</label>
										<input id="name_ko" name="name_ko" type="text" class="form-control" value="<?=$name_ko?>" placeholder="이름" />
										<input id="job_ko" name="job_ko" type="text" class="form-control" value="<?=$job_ko?>" placeholder="직위" />
									</div>
									<div class="form-group">
										<label for="name_en" class="control-label mb-1">영문</label>
										<input id="name_en" name="name_en" type="text" class="form-control" value="<?=$name_en?>" placeholder="이름" />
										<input id="job_en" name="job_en" type="text" class="form-control" value="<?=$job_en?>" placeholder="직위" />
									</div>
									<div class="form-group">
										<label for="name_cn" class="control-label mb-1">중문</label>
										<input id="name_cn" name="name_cn" type="text" class="form-control" value="<?=$name_cn?>" placeholder="이름" />
										<input id="job_cn" name="job_cn" type="text" class="form-control" value="<?=$job_cn?>" placeholder="직위" />
									</div>
									<div class="form-group">
										<label for="name_jp" class="control-label mb-1">일문</label>
										<input id="name_jp" name="name_jp" type="text" class="form-control" value="<?=$name_jp?>" placeholder="이름" />
										<input id="job_jp" name="job_jp" type="text" class="form-control" value="<?=$job_jp?>" placeholder="직위" />
									</div>
			                    </div>
			                </section>
			            </div>
						<?php
							}}
						?>
					</div>
				</div>
			</div>
		</div>

	</div> <!-- .content -->
</div><!-- /#right-panel -->

<!-- Right Panel -->

<!-- footer -->
<?php include "../common/footer.php"; ?>
<!-- footer -->
