<?php
//메뉴 표시
$dirPath = $_SERVER['PHP_SELF'];
$spath = explode("/", $dirPath);
$rdir = $spath[count($spath) - 2];


$dir_arr = array(""
,"notice"
,"road_show"
,"video"
,"press"
,"blog_review"
);

$menu_num = 0;
$i = 0;
foreach($dir_arr as $data){
	if($rdir == $data){
		
		$menu_num = $i;
	}
	$i++;
}	

if($sess_lev == 9){
	if( "/admin/".$dir_arr[$menu_num]."/" != $sess_url){
		error("해당메뉴의 접근권한이 없습니다.");
		exit();
	}
}

?>
<script>
jQuery(function($){
	cur_menu(<?=$menu_num?>);
	$("#container").hover(function(e) {
		$(".menu").removeClass("menu_on");
		$(".sub_menu").hide();
        cur_menu(<?=$menu_num?>);
    });
	$("#menu_up").hover(function(e) {
		$(".menu").removeClass("menu_on");
		$(".sub_menu").hide();
        cur_menu(<?=$menu_num?>);
    });
	
	//$(".sub_menu").hide(0);
});
</script>
<div id="menu_up">
	<div class="left" style="padding-left:10px;">
		<a href="/admin">
			<!--<img src="/admin/img/logo_120x160.png" height="30" style="vertical-align:middle" />-->
			M2O Homepage 관리자
		</a>
	</div>
	
    <div class="right">
    	<ul class="top_menu">
        	<li><a href="/" target="_blank">홈페이지</a></li>
            <li><a href="/admin/logout.php">로그아웃</a></li>
        </ul>
    </div>
    <div class="clear"></div>
</div>
<ul class="main_menu">
    <li class="menu" id="main1" target="sub1">
        <a href="/admin/notice/">Notice</a>
    </li>
    <li class="menu" id="main2" target="sub2">
        <a href="/admin/road_show/">ROAD SHOW</a>
    </li>
    <li class="menu" id="main3" target="sub3">
        <a href="/admin/video/">VIDEO</a>
    </li>
    <li class="menu" id="main4" target="sub4">
        <a href="/admin/press/">Press Release</a>
    </li>
	<li class="menu" id="main5" target="sub5">
        <a href="/admin/blog_review/">BLOG REVIEW</a>
    </li> 
    
</ul>
<!--
<ul class="sub_menu" id="sub1">
    <li style="padding-left:0px"><a href="/admin/member/">일반회원</a></li>
</ul>
<ul class="sub_menu" id="sub2">
    <li style="padding-left:100px"><a href="/admin/medi/">진료사례</a></li>
    <li><a href="/admin/medi/qna.php">Q&amp;A</a></li>
</ul>
<ul class="sub_menu" id="sub3">
    <li style="padding-left:200px"><a href="/admin/issue/">오늘의이슈</a></li>
    <li><a href="/admin/issue/news.php">뉴스</a></li>
</ul>
<ul class="sub_menu" id="sub4">
    <li style="padding-left:300px"><a href="/admin/board/">무찌마</a></li>
     <li><a href="/admin/board/women.php">여의도</a></li>
</ul>
<ul class="sub_menu" id="sub5">
    <li style="padding-left:400px"><a href="/admin/community/">메뉴관리</a></li>
    <li><a href="/admin/community/board.php">게시글관리</a></li>
</ul>
<ul class="sub_menu" id="sub6">
    <li style="padding-left:500px"><a href="/admin/etc/">약관관리</a></li>
    <li><a href="/admin/etc/cate.php">진료카테고리</a></li>
    <li><a href="/admin/etc/notice.php">공지관리</a></li>
    <li><a href="/admin/etc/call.php">문의확인</a></li>
    <li><a href="/admin/etc/comm.php">댓글관리</a></li>
</ul>
<ul class="sub_menu" id="sub7">
    <li style="padding-left:600px"><a href="/admin/push/">푸쉬보내기</a></li>
</ul>
-->