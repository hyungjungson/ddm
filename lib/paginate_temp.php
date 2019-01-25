<?php

/**
 * @param $total_row: 검색된 결과의 총 게시물수 (limit 결과 아님.)
 * @param $page_now: 현재 페이지.
 * @param $page_row: 현재 페이지에 표시할 레코드수.
 * */
// $total_row = 10;
?>

<div class="paginate_complex">
<?php
if ($page_row=="") $page_row = 0;
if($total_row>0)
{
	# 이전 페이지 버튼
	//echo "<a href=\"javascript:goList('0')\" class=\"direction prev\"><span></span><span></span> Prev End</a> ";
	if($page_now >= 1)
	{
		$page = $page_now - 1;
		echo "<a href=\"javascript:goList('{$page}')\" class=\"direction prev\"><img src='/lib/image/btn_page_prev.png' width=12 height=18 align=absmiddle></a>";
	} else {
		echo "<a href=\"javascript:goList('0')\" class=\"direction prev\"><img src='/lib/image/btn_page_prev.png' width=12 height=18 align=absmiddle></a>";
	}
	// 페이지 바로가기 링크
	$buttons = 5;	//페이지 바로가기 링크의 수
	$half_buttons = @ceil($buttons / 2);
	$last_page = @ceil($total_row / $page_row);

	if($last_page < $buttons)
	{
		$start = 0;
		$end = $last_page;
	}
	else
	{
		if($page_now <= $half_buttons)
		{
			$start = 0;
			$end = 5;
		}
		else if($page_now > $last_page - $half_buttons)
		{
			$start = $last_page - $buttons + 1;
		 	$end = $last_page;
		}
		else
		{
			$start = $page_now - $half_buttons + 1;
			$end = $page_now + $half_buttons;
		}
	}

	for($i = $start; $i < $end; $i++)
	{
        $k = $i+1;
		if($i == $page_now)
		{
			if($i==1)
			{

				echo " <strong>{$k}</strong>";
			}
			else
			{
				echo " <strong>{$k}</strong>";
			}
		}
		else
		{
			if($i==1)
			{
                echo " <a href=\"javascript:goList('{$i}')\">";
				echo "{$k}</a>";
			}
			else
			{
                echo " <a href=\"javascript:goList('{$i}')\">";
				echo "{$k}</a>";
			}
		}
	}
    if ($start >= 1 && $end == 1) echo "<strong>1</strong>";

    if ($start == 0 && $end == 0) echo "<strong>1</strong>";

	//다음 페이지 버튼
    $last_page = $last_page - 1;
    if($page_now < $last_page)
	{
		$page = $page_now + 1;
	 	echo "<a href=\"javascript:goList('{$page}')\" class=\"direction next\"><img src='/lib/image/btn_page_next.png' width=12 height=18 align=absmiddle></a>";
	} else if($page_now == $last_page){
		echo "<a href=\"javascript:goList('{$page}')\" class=\"direction next\"><img src='/lib/image/btn_page_next.png' width=12 height=18 align=absmiddle></a>";
	}
    //echo " <a href=\"javascript:goList('{$last_page}')\" class=\"direction next\">Next End <span></span><span></span></a> ";
}
else
{
    //echo "<a href=\"javascript:goList('0')\" class=\"direction prev\"><span></span><span></span> Prev End</a> ";
    echo "<a href=\"javascript:goList('0')\" class=\"direction prev\"><img src='/lib/image/btn_page_prev.png' width=12 height=18 align=absmiddle></a>";
    echo "<strong>1</strong>";
 	echo "<a href=\"javascript:goList('0')\" class=\"direction next\"><img src='/lib/image/btn_page_next.png' width=12 height=18 align=absmiddle></a>";
    //echo " <a href=\"javascript:goList('0')\" class=\"direction next\">Next End <span></span><span></span></a> ";
}
?>
</div>
<script type="text/javascript">
function goList(page)
{
    var f=document.frm;
    f.page_now.value=page;
    f.submit();
}
</script>
<style type="text/css">
.paginate_complex{padding:8px 0;line-height:normal;text-align:center; width:350px; float:none; margin:20px auto; font-size:16px}
.paginate_complex a,
.paginate_complex strong{display:inline-block;position:relative;z-index:2;margin:0;padding:0px 3px;font:16px Tahoma, Sans-serif;color:#999;text-decoration:none;vertical-align:top}
.paginate_complex a:hover,
.paginate_complex a:active,
.paginate_complex a:focus{}
.paginate_complex strong{color:#c40516;text-decoration:none;}
.paginate_complex a.pagenum{border-right:1px #ddd solid; padding-right:5px;}
.paginate_complex a.lastnum{border-right:0px}
.paginate_complex .direction{border:0;font-weight:normal;color:#767676;text-decoration:none !important;z-index:1}
.paginate_complex .direction:hover,
.paginate_complex .direction:active,
.paginate_complex .direction:focus{color:#c40516;background-color:#fff}
.paginate_complex .prev{border-left:0; margin-right:10px;}
.paginate_complex .next{border-right:0; margin-left:10px;}
.paginate_complex .direction span{display:inline-block;position:relative;top:4px;width:0;height:0;font-size:0;line-height:0;vertical-align:top}
.paginate_complex .prev span{*left:-4px;margin-right:1px;border:3px solid;border-top:solid #fff;border-bottom:solid #fff;border-left:0}
.paginate_complex .next span{margin-left:1px;border:3px solid;border-top:solid #fff;border-bottom:solid #fff;border-right:0}
</style>
