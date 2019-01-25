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

$groupSql = "SELECT * FROM paper ORDER BY p_type DESC, sort ASC";
$res_sql = $db->get_results($groupSql);

?>

<!-- Right Panel -->
<div id="right-panel" class="right-panel">

	<!-- Header-->
	<?php include "../common/mem_header.php"; ?>
	<!-- /header -->

	<script>
		function goSave(idx){
			if(confirm("저장하시겠습니까?")){
				$("#idx").val(idx);
				$("#frm").submit();
			}
		}

        function openFile(idx){
            window.open("filedown?idx="+idx, "", "");
        }

	</script>

		<div class="content mt-3">
			<div class="col-xl-12">
				<div class="card">
					<div class="card-body">
						<div class="row">
							<div class="col-sm-4">
								<h4 class="card-title mb-0">백서 &amp; 럭키페이퍼</h4>
							</div>
						</div><!--/.row-->
						<div class="chart-wrapper mt-4 col-10" >
							<form action="proc.php" name="frm" id="frm" method="post" enctype="multipart/form-data" class="form-horizontal">
								<input type="hidden" name="idx" id="idx" value=""/>
								<input type="hidden" name="func_type" id="func_type" value="edit"/>

								<table class="table">
		                            <colgroup>
		                                <col style="width:10%;"/>
		                                <col style="width:10%;"/>
		                                <col style="width:30%;"/>
		                                <col style="width:10%;"/>
		                                <col style="width:10%;"/>
		                            </colgroup>
									<thead>
										<tr>
											<th class="text-center" scope="col ">구분</th>
											<th class="text-center" scope="col">언어</th>
											<th class="text-center" scope="col">파일</th>
		                                    <th class="text-center" scope="col">표시여부</th>
											<th class="text-center" scope="col">저장</th>
										</tr>
									</thead>
									<tbody>
										<?php
										    if ($res_sql) {
										        foreach ($res_sql as $data) {
										            $idx = $data->idx;
		                                            $p_type = $data->p_type;
		                                            $lang = $data->lang;
													$file = $data->file;
		                                            $save_file = $data->save_file;
		                                            $del_yn = $data->del_yn;
										?>
										<tr>
		                                    <td class="text-center"><?=$p_type == "W" ? "백서" : "럭키페이퍼"?></td>
											<td class="text-center"><?=$lang?></td>
		                                    <td>
		                                        <?php if( $del_yn != 'Y' ) {?>
		                                        <button type="button" class="btn btn-secondary btn-sm" style="float:left;" onClick="openFile('<?=$idx?>');">
													<i class="fa fa-download"></i>&nbsp; <?=$file?>
												</button>
		                                        <?php } ?>
		                					    <input type="file" class="input_text" style="margin-left:10px;" name="file_<?=$idx?>" id="file_<?=$idx?>" />
		                                    </td>
		                                    <td class="text-center">
		                                        <select name="del_yn_<?=$idx?>" class="form-control-sm form-control">
		                                            <option value="N" <?=$del_yn == 'Y' ? "" : ""?>>표시</option>
		                                            <option value="Y" <?=$del_yn == 'Y' ? "selected" : ""?>>미표시</option>
		                                        </select>
		                                    </td>
											<td class="text-center">
		                                        <button type="button" class="btn btn-sm btn-primary" onClick="goSave('<?=$idx?>');">
													<i class="fa fa-check"></i>&nbsp; 저장
												</button>
											</td>
										</tr>
										<?php
										        }
										    }
										?>
									</tbody>
								</table>
							</form>
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
