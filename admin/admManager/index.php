<!-- Header -->
<?php include "../common/header.php"; ?>
<!-- Header -->

<!-- Left Panel -->
<?php include "../common/left_panel.php"; ?>
<!-- Left Panel -->

<?php
if($sess_lev != 10){
	error("해당 메뉴의 접근 권한이 없습니다.","/admin");
	exit();
}

$table = "admin";

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
	$SRCH_SQL .= " AND createdate > '{$s_date} 00:00:00' AND createdate <= '{$e_date} 23:59:59'";//검색
}
if ($search_type) $SRCH_SQL .= " AND {$search_type} like '%{$search_text}%'";//검색
if (!$sort) $sort = "idx";
if (!$sorter) $sorter = "desc";

# List SQL Query ##############################################################
$page_num   = 10;
$page_row   = $page_row != null ? $page_row : 20;
$page_now   = $page_now != null ? $page_now : 0;
$start_page = $page_now * $page_row;

$lst_sql    = " SELECT * FROM {$table} a WHERE level > 0 ".$SRCH_SQL;
$total_row  = $db->query($lst_sql);
$lst_sql .= " ORDER BY $sort $sorter";
$lst_sql .= " LIMIT ".($page_now * $page_row).", ".$page_row;

$total_page = (int)($total_row / $page_row) + (($total_row % $page_row) == 0 ? 0 : 1);
$res_sql = $db->get_results($lst_sql);
$virtualnum = $total_row - ($page_row * $page_now);
?>

<script>
    function goConfirm(idx){
        if(confirm("관리자 요청을 승인하시겠습니까?")){
            $("#func_type").val("confirm");
            $("#idx").val(idx);
            $("#frm").attr("action","proc");
            $("#frm").attr("method","post");
            $("#frm").submit();
        }
    }

    function goDel(idx){
        if(confirm("관리자를 삭제하시겠습니까?")){
            $("#func_type").val("del");
            $("#idx").val(idx);
            $("#frm").attr("action","proc");
            $("#frm").attr("method","post");
            $("#frm").submit();
        }
    }
</script>

<!-- Right Panel -->
<div id="right-panel" class="right-panel">

	<!-- Header-->
	<?php include "../common/mem_header.php"; ?>
	<!-- /header -->

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
							<h4 class="card-title mb-0">관리자</h4>
						</div>
						<!--/.col-->
						<div class="col-sm-8 hidden-sm-down">
						</div><!--/.col-->
					</div><!--/.row-->
					<div class="chart-wrapper mt-4" >
						<table class="table">
							<thead>
								<tr>
									<th class="text-center" scope="col">No</th>
									<th class="text-center" scope="col">아이디</th>
									<th class="text-center" scope="col">이름</th>
                                    <th class="text-center" scope="col">이메일</th>
                                    <th class="text-center" scope="col">아이피</th>
                                    <th class="text-center" scope="col">가입일</th>
									<th class="text-center" scope="col">마지막 로그인 일자</th>
                                    <th class="text-center" scope="col">승인여부</th>
								</tr>
							</thead>
							<tbody>
								<?php
								    if ($res_sql) {
								        $i = 0;
								        foreach ($res_sql as $data) {
								            $idx = $data->idx;
                                            $id = $data->id;
                                            $ip = $data->ip;
                                            $name = $data->name;
                                            $level = $data->level;
											$email = $data->email;
											$last_login = $data->last_login;
											$last_login = substr($last_login,0,10);
                                            $createdate = $data->createdate;
											$createdate = substr($createdate,0,10);
								?>
								<tr>
									<th class="text-center" scope="row"><?=$virtualnum-$i?></th>
									<td class="text-center"><?=$id?></td>
                                    <td class="text-center"><?=$name?></td>
                                    <td class="text-center"><?=$email?>@mileage.com</td>
                                    <td class="text-center"><?=$ip?></td>
                                    <td class="text-center"><?=$createdate?></td>
									<td class="text-center"><?=$last_login?></td>
                                    <td class="text-center">
                                        <?php if($level == '1'){?>
                                            <button type="button" class="btn btn-sm btn-primary" onClick="goConfirm('<?=$idx?>');">
                                                <i class="fa fa-ban"></i>&nbsp; 승인
                                            </button>
                                        <?php } ?>
                                        <?php if($level < '10'){?>
                                            <button type="button" class="btn btn-sm btn-danger" onClick="goDel('<?=$idx?>');">
                                                <i class="fa fa-ban"></i>&nbsp; 삭제
                                            </button>
                                        <?php } ?>
                                    </td>
								</tr>
								<?php
										$i++;
								        }
								    } else {
								?>
								<tr>
								    <td colspan="8">조회된 관리자 데이터가 없습니다.</td>
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
