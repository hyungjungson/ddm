<?php include $_SERVER['DOCUMENT_ROOT']."/admin/header.php";?>
<?php
if($sess_lev != 10){
	if($sess_id != "app"){
		error("해당 메뉴의 접근 권한이 없습니다.",$sess_url);
		exit();
	}
}

$table = "notice";

# Getting Parameter And Default Variable Setting ##############################
$page_num = $_REQUEST['page_num'];
$page_row = $_REQUEST['page_row'];
$page_now = $_REQUEST['page_now'];
$sort   = $_REQUEST['sort'];
$sorter = $_REQUEST['sorter'];

//alert($sch_date_e);
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

$lst_sql    = "
SELECT * FROM
{$table} a
WHERE 1 = 1
".$SRCH_SQL;

$total_row  = $db->query($lst_sql);

$lst_sql .= " ORDER BY $sort $sorter";
$lst_sql .= " LIMIT ".($page_now * $page_row).", ".$page_row;



$total_page = (int)($total_row / $page_row) + (($total_row % $page_row) == 0 ? 0 : 1);

$res_sql = $db->get_results($lst_sql);

$virtualnum = $total_row - ($page_row * $page_now);

//echo $total_row;

?>
<script>
$(function(){
    $('#all_chk').click(function(){
		if ($("#all_chk").is(":checked")) {
			$('.check_input:not(checked)').attr("checked", true);
		} else {
			$('.check_input:checked').attr("checked", false);
		}
	});

});

function sorter_submit(sorter){
	$("#page_now").val(0);
	$("#sorter").val(sorter);
	$("#frm").submit();
}


function item_func(mode){
	if(mode == 'pw'){
		var msg = "해당 회원의 비밀번호를 변경 하시겠습니까?";
	}
if(confirm(msg)){
		var FormObj = document.frm;
		$("#func_type").val(mode);
		var idx = $(this).attr("idx");
		$("#idx").val(idx);
		FormObj.target = "func" ; // 팝업윈도우 객체
		FormObj.action = "proc.php"; //
		FormObj.submit();

		FormObj.target = "_self" ; // 팝업윈도우 객체
		FormObj.action = "<?=$_SERVER['PHP_SELF']?>"; //

	}
}

function chk_func(mode){
	if(mode == 'del'){
		var msg = "선택된 항목을 삭제하시겠습니까?";
	} else if(mode == 'level_all'){
		var msg = "선택된 회원의 레벨을 일괄 변경하시겠습니까?";
	}
	var count = $("input:checkbox[name='chk[]']:checked").length;
	if(count < 1){
		alert("선택된 항목이 없습니다.");
	} else {
		if(confirm(msg)){
			var FormObj = document.frm;
			$("#func_type").val(mode);
            FormObj.target = "func" ; // 팝업윈도우 객체
			FormObj.action = "proc.php"; //
            FormObj.submit();

			FormObj.target = "_self" ; // 팝업윈도우 객체
			FormObj.action = "<?=$_SERVER['PHP_SELF']?>"; //

		}
	}
}
function go_search(){
	$("#page_now").val(0);
	$("#frm").submit();
}

</script>
<h1>Notice</h1>
<form name="frm" action="<?=$_SERVER['PHP_SELF']?>" method="get" class="frm" id="frm">
<input type="hidden" name="page_now" id="page_now" value="<?=$page_now?>" />
<input type="hidden" name="page_row" value="<?=$page_row?>"/>
<input type="hidden" name="sort" id="sort" value="<?=$sort?>"/>
<input type="hidden" name="sorter" id="sorter" value="<?=$sorter?>"/>
<input type="hidden" name="idx" id="idx" value=""/>
<input type="hidden" name="func_type" id="func_type" value=""/>
<input type="hidden" name="table" id="table" value="<?=$table?>"/>
<!-- s:검색 섹션
<table cellpadding="0" cellspacing="0" border="0" class="tbl_wrt" style='width:100%'>
<colgroup>
<col width="100"/><col /><col width='100'/><col /><col width="150"/>
</colgroup>

<tr>
<th>검색</th>
<td>

    <select name="search_type">
    	<option value="title" <?=select("title",$search_type)?> >제목</option>
        <option value="content" <?=select("content",$search_type)?> >내용</option>
    </select>
    <input type='text' name='search_text' id='search_text' class='tbl_wrt_text' value='<?=$search_text?>' style=''/>
    <span class="button"><button type="button" onclick="go_search();">검색</button></span>
</td>
</tr>
</table>
<div class="margin-top10"></div>
    <!-- e:검색 섹션 -->
<table cellpadding="0" cellspacing="0" border="0" class="tbl_list">
<colgroup>
<col width='30'/><col width='50' /><col width='180' /><col /><col />
<col /><col /><col /><col /><col />
<col />
</colgroup>
<thead>
<tr>
<th><input type="checkbox" id="all_chk" name="all_chk" value="all"></th>
<th>No.</th>
<th var="regdate">등록일</th>
<th var="id">제목</th>
<th>비고</th>
</tr>
</thead>
<tbody>
<?php
    if ($res_sql)
    {
        $i = 0;
        foreach ($res_sql as $data)
        {
            $idx = $data->idx;
			$title = $data->title_ko;
			$regdate = $data->regdate;

			$regdate = substr($regdate,0,10);

?>
<tr>
    <td><input type="checkbox" class="check_input" name="chk[]" value="<?=$idx?>"></td>
    <td><?=$virtualnum-$i?></td>
    <td><?=$regdate?></td>
    <td><?=$title?></td>
    <td>
    <span class="button"><input type="button" onclick="location.href='write.php?table=<?=$table?>&idx=<?=$idx?>&page_now=<?=$page_now?>'" value="수정하기" /></span>
    </td>
</tr>
<!-- s:data area -->
<?php
		$i++;
        }
    } else {
?>
<tr>
    <td colspan="26" align="center">검색된 데이터가 없습니다.</td>
</tr>

<?php } ?>
<!-- e:data area -->
</tbody>
</table>
<!-- s:목록 섹션 -->
<div class="btn_right" style="width:500px">
    <span class="button"><button type="button" onclick="chk_func('del');">선택삭제</button></span>
    <span class="button blue"><button type="button" onclick="location.href='write.php?table=<?=$table?>'">등록하기</button></span>
    <!--<span class="button"><button type="button" onclick="chk_func('del');">엑셀저장</button></span>-->

</div>
<?php include $_SERVER['DOCUMENT_ROOT']."/lib/paginate_temp.php";?>

</form>
<?php include $_SERVER['DOCUMENT_ROOT']."/admin/footer.php";?>
