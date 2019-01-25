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

$table = "press";

# Getting Parameter And Default Variable Setting ##############################
$page_num = $_REQUEST['page_num'];
$page_row = $_REQUEST['page_row'];
$page_now = $_REQUEST['page_now'];
$sort   = $_REQUEST['sort'];
$sorter = $_REQUEST['sorter'];

# Parameter to Query Processing ###############################################
$SRCH_SQL;

$level = $_REQUEST['level'];

$s_date = $_REQUEST['s_date'];
$e_date = $_REQUEST['e_date'];
$search_text = $_REQUEST['search_text'];
$search_type = $_REQUEST['search_type'];

if ($s_date && $e_date) {
	$SRCH_SQL .= " AND regdate > '{$s_date} 00:00:00' AND regdate <= '{$e_date} 23:59:59'";//검색
}
if ($search_type) $SRCH_SQL .= " AND {$search_type} like '%{$search_text}%'";//검색
if (!$sort) $sort = "idx";
if (!$sorter) $sorter = "desc";

# List SQL Query ##############################################################
$page_num   = 10;
$page_row   = $page_row != null ? $page_row : 20;
$page_now   = $page_now != null ? $page_now : 0;
$start_page = $page_now * $page_row;

$lst_sql    = " SELECT * FROM {$table} a WHERE del_yn != 'Y' ".$SRCH_SQL;
$total_row  = $db->query($lst_sql);
$lst_sql .= " ORDER BY $sort $sorter";
$lst_sql .= " LIMIT ".($page_now * $page_row).", ".$page_row;

$total_page = (int)($total_row / $page_row) + (($total_row % $page_row) == 0 ? 0 : 1);
$res_sql = $db->get_results($lst_sql);
$virtualnum = $total_row - ($page_row * $page_now);
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
	</script>

	<form name="frm" action="<?=$_SERVER['PHP_SELF']?>" method="get" class="frm" id="frm">
		<input type="hidden" name="page_now" id="page_now" value="<?=$page_now?>" />
		<input type="hidden" name="page_row" value="<?=$page_row?>"/>
		<input type="hidden" name="sort" id="sort" value="<?=$sort?>"/>
		<input type="hidden" name="sorter" id="sorter" value="<?=$sorter?>"/>
		<input type="hidden" name="idx" id="idx" value=""/>
		<input type="hidden" name="func_type" id="func_type" value=""/>
		<input type="hidden" name="table" id="table" value="<?=$table?>"/>
	</form>

	<div class="content mt-3">
		<div class="col-xl-12">
			<div class="card">
				<div class="card-body">
					<div class="row">
						<div class="col-sm-4">
							<h4 class="card-title mb-0">보도자료</h4>
						</div>
						<!--/.col-->
						<div class="col-sm-8 hidden-sm-down">
							<!--<button type="button" class="btn btn-info float-right bg-flat-color-2 mx-2"><i class="fa fa-download"></i></button>-->
							<button type="button" class="btn btn-outline-info float-right" onClick="location.href='write.php?table=<?=$table?>';"><i class="fa fa-download"></i> 글쓰기</button>
						</div><!--/.col-->
					</div><!--/.row-->
					<div class="chart-wrapper mt-4" >
						<table class="table">
							<thead>
								<tr>
									<th scope="col">No</th>
									<th scope="col">제목</th>
									<th scope="col">등록일</th>
									<th scope="col">삭제</th>
								</tr>
							</thead>
							<tbody>
								<?php
								    if ($res_sql) {
								        $i = 0;
								        foreach ($res_sql as $data) {
								            $idx = $data->idx;
											$title = $data->title;
											$regdate = $data->regdate;
											$regdate = substr($regdate,0,10);
								?>
								<tr>
									<th scope="row"><?=$virtualnum-$i?></th>
									<td>
										<a href="write?table=<?=$table?>&idx=<?=$idx?>&page_now=<?=$page_now?>"><?=$title?></a></td>
									<td><?=$regdate?></td>
									<td>
										<button type="button" class="btn btn-sm btn-danger" onClick="goDel('<?=$idx?>');">
											<i class="fa fa-ban"></i>&nbsp; 삭제
										</button>
									</td>
								</tr>
								<?php
										$i++;
								        }
								    } else {
								?>
								<tr>
								    <td colspan="4">등록된 게시물이 없습니다.</td>
								</tr>
								<?php } ?>
							</tbody>
						</table>

						<?php include $_SERVER['DOCUMENT_ROOT']."/lib/paginate.php";?>

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
