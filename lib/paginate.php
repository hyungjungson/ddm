<?php

/**
 * @param $total_row: 검색된 결과의 총 게시물수 (limit 결과 아님.)
 * @param $page_now: 현재 페이지.
 * @param $page_row: 현재 페이지에 표시할 레코드수.
 * */
// $total_row = 10;
?>
<ul class="pagination" style="justify-content: center;">
<?php
if ($page_row=="") $page_row = 0;
//게시물이 1개 이상일 경우
if($total_row > 0) {
	# 이전 페이지 버튼
	$goP = '0';
	if($page_now >= 1) {
		$page = $page_now - 1;
		$goP = $page;
		echo "<li class=\"paginate_button page-item previous\" id=\"bootstrap-data-table_previous\">";
		echo "	<a href=\"javascript:goList('{$goP}')\" class=\"page-link\">";
		echo "		<i class=\"fa fa-angle-double-left\"></i> Previous";
		echo "	</a>";
		echo "</li>";
	}
	// 페이지 바로가기 링크
	$buttons = 5;	//페이지 바로가기 링크의 수
	$half_buttons = @ceil($buttons / 2);
	$last_page = @ceil($total_row / $page_row);

	if($last_page < $buttons) {
		$start = 0;
		$end = $last_page;
	} else {
		if($page_now <= $half_buttons) {
			$start = 0;
			$end = 5;
		} else if($page_now > $last_page - $half_buttons) {
			$start = $last_page - $buttons + 1;
		 	$end = $last_page;
		} else {
			$start = $page_now - $half_buttons + 1;
			$end = $page_now + $half_buttons;
		}
	}

	for($i = $start; $i < $end; $i++) {
        $k = $i+1;
		if($i == $page_now) {
			if($i==1) {
				echo "<li class=\"paginate_button page-item active\">";
				echo "	<a href=\"#none\" class=\"page-link\">{$k}</a>";
				echo "</li>";
			} else {
				echo "<li class=\"paginate_button page-item active\">";
				echo "	<a href=\"#none\" class=\"page-link\">{$k}</a>";
				echo "</li>";
			}
		} else {
			if($i==1) {
				echo "<li class=\"paginate_button page-item active\">";
				echo "	<a href=\"javascript:goList('{$i}');\" class=\"page-link\">{$k}</a>";
				echo "</li>";
			} else {
				echo "<li class=\"paginate_button page-item active\">";
				echo "	<a href=\"javascript:goList('{$i}');\" class=\"page-link\">{$k}</a>";
				echo "</li>";
			}
		}
	}
    if ($start >= 1 && $end == 1) {
		echo "<li class=\"paginate_button page-item active\">";
		echo "	<a href=\"#none\" class=\"page-link\">1</a>";
		echo "</li>";
	}

    if ($start == 0 && $end == 0) {
		echo "<li class=\"paginate_button page-item active\">";
		echo "	<a href=\"#none\" class=\"page-link\">1</a>";
		echo "</li>";
	}

	//다음 페이지 버튼
    $last_page = $last_page - 1;
	$goLp = $page;
    if($page_now < $last_page) {
		$page = $page_now + 1;
		$goLp = $page;
		echo "<li class=\"paginate_button page-item next\" id=\"bootstrap-data-table_next\">";
		echo "	<a href=\"javascript:goList('{$goLp}');\" class=\"page-link\">";
		echo "		<i class=\"fa fa-angle-double-right\"></i> Next";
		echo "	</a>";
		echo "</li>";
	}
} else {
	echo "<li class=\"paginate_button page-item active\">";
	echo "	<a href=\"#\" aria-controls=\"bootstrap-data-table\" class=\"page-link\">1</a>";
	echo "</li>";
}
?>
</ul>
<script type="text/javascript">
function goList(page)
{
    var f=document.frm;
    f.page_now.value=page;
    f.submit();
}
</script>
