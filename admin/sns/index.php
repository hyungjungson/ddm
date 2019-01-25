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

$groupSql = "SELECT idx, sns_name from sns group by sns_name ORDER BY sort";
$res_sql = $db->get_results($groupSql);

?>

<!-- Right Panel -->
<div id="right-panel" class="right-panel">

	<!-- Header-->
	<?php include "../common/mem_header.php"; ?>
	<!-- /header -->

	<script>
		function goSave(sname, lang, idx){
			if(confirm("링크를 수정하시겠습니까?")){
				$("#func_type").val("edit");
				$("#idx").val(idx);
				$("#link").val($("#link_"+sname+"_"+lang).val());
				$("#frm").submit();
			}
		}
	</script>

	<form name="frm" action="proc" method="post" class="frm" id="frm">
		<input type="hidden" name="idx" id="idx" value=""/>
		<input type="hidden" name="link" id="link" value=""/>
		<input type="hidden" name="func_type" id="func_type" value=""/>
	</form>

	<div class="content mt-3">
		<div class="col-xl-12">
			<div class="card">
				<div class="card-body">
					<div class="row">
						<div class="col-sm-4">
							<h4 class="card-title mb-0">SNS</h4>
						</div>
						<!--/.col-->
						<div class="col-sm-8 hidden-sm-down">
							<!--<button type="button" class="btn btn-outline-info float-right" onClick="location.href='write.php?table=<?=$table?>';"><i class="fa fa-download"></i> 추가</button>-->
						</div><!--/.col-->
					</div><!--/.row-->
					<div class="chart-wrapper mt-4" >
						<table class="table">
                            <colgroup>
                                <col style="width:10%;"/>
                                <col style="width:10%;"/>
                                <col style="width:30%;"/>
                                <col style="width:10%;"/>
                                <col style="width:20%;"/>
                            </colgroup>
							<thead>
								<tr>
									<th class="text-center" scope="col ">SNS</th>
									<th class="text-center" scope="col">이미지</th>
									<th class="text-center" scope="col">링크</th>
                                    <th class="text-center" scope="col">언어</th>
									<th class="text-center" scope="col">저장</th>
								</tr>
							</thead>
							<tbody>
								<?php
								    if ($res_sql) {
								        foreach ($res_sql as $data) {
								            $idx = $data->idx;
                                            $sns_name = $data->sns_name;

                                            $listSql = "SELECT * from sns where sns_name = '".$sns_name."' ORDER BY lang";
                                            $listRst = $db->get_results($listSql);
                                            foreach ($listRst as $data2) {
                                                $link = $data2->link;
                                                $img = $data2->img;
                                                $lang = $data2->lang;
                                                $sort = $data2->sort;
								?>
								<tr>
									<td class="text-center"><?=$sns_name?></td>
                                    <td class="text-center">
            					        <img src="<?=$img?>" style="max-width:600px;"/>
                                    </td>
                                    <td class="text-center">
										<input type="text" value="<?=$link?>" name="link_<?=$sns_name?>_<?=$lang?>" id="link_<?=$sns_name?>_<?=$lang?>" style="width:100%;" />
									</td>
									<td class="text-center">
										<?php if( $lang == "all" ){?>
											전체
										<?php } else if( $lang == "ko" ){?>
											국문
										<?php } else if( $lang == "en" ){?>
											영문
										<?php } else if( $lang == "cn" ){?>
											중문
										<?php } else if( $lang == "jp" ){?>
											일문
										<?php }?>
                                    </td>
									<td class="text-center">
                                        <button type="button" class="btn btn-sm btn-primary" onClick="goSave('<?=$sns_name?>','<?=$lang?>','<?=$idx?>');">
											<i class="fa fa-ban"></i>&nbsp; 저장
										</button>
									</td>
								</tr>
								<?php
                                            }
								        }
								    }
								?>
							</tbody>
						</table>

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
