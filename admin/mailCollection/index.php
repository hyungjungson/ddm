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

$table = "email_collection";

# Getting Parameter And Default Variable Setting ##############################
$page_num = $_REQUEST['page_num'];
$page_row = $_REQUEST['page_row'];
$page_now = $_REQUEST['page_now'];
$sort   = $_REQUEST['sort'];
$sorter = $_REQUEST['sorter'];

# Parameter to Query Processing ###############################################
if (!$sort) $sort = "idx";
if (!$sorter) $sorter = "desc";

# List SQL Query ##############################################################
$page_num   = 10;
$page_row   = $page_row != null ? $page_row : 20;
$page_now   = $page_now != null ? $page_now : 0;
$start_page = $page_now * $page_row;

$lst_sql    = " SELECT * FROM {$table} a GROUP BY email ";
$total_row  = $db->query($lst_sql);
$lst_sql .= " ORDER BY $sort $sorter ";
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


	<div class="content mt-3">
		<div class="col-xl-12">
			<div class="card">
				<div class="card-body">
					<div class="row">
						<div class="col-sm-4">
							<h4 class="card-title mb-0">이메일 수집</h4>
						</div>
						<!--/.col-->
						<div class="col-sm-8 hidden-sm-down">
							<button type="button" class="btn btn-info float-right bg-flat-color-2 mx-2" onClick="location.href='./mailExcel'"><i class="fa fa-download"></i></button>
						</div><!--/.col-->
					</div><!--/.row-->
					<div class="chart-wrapper mt-4" >
						<table class="table">
							<thead>
								<tr>
									<th scope="col">No</th>
									<th scope="col">이메일</th>
									<th scope="col">IP</th>
                                    <th scope="col">등록일</th>
								</tr>
							</thead>
							<tbody>
								<?php
								    if ($res_sql) {
								        $i = 0;
								        foreach ($res_sql as $data) {
								            $idx = $data->idx;
											$email = $data->email;
											$ip = $data->ip;
                                            $regdate = $data->createdt;
											$regdate = substr($regdate,0,10);
								?>
								<tr>
									<th scope="row"><?=$virtualnum-$i?></th>
									<td><?=$email?></td>
									<td><?=$ip?></td>
                                    <td><?=$regdate?></td>
								</tr>
								<?php
										$i++;
								        }
								    } else {
								?>
								<tr>
								    <td colspan="4">수집된 이메일이 없습니다.</td>
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
