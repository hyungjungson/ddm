<?php
header('Content-Type: text/html; charset=UTF-8');
define('ROOT_PATH', $_SERVER['DOCUMENT_ROOT']."/");

//아이피 체크
if( $_SERVER['REMOTE_ADDR'] != "14.52.204.59" && $_SERVER['REMOTE_ADDR'] != "125.129.24.198") {
    Header("Location:/");
}

require_once(ROOT_PATH."admin/session.php");
require_once(ROOT_PATH."config/global_config.php");
require_once(ROOT_PATH."lib/DB.php");
require_once(ROOT_PATH."lib/function.php");
require_once(ROOT_PATH."admin/session_permission.php");

if($sess_lev < 5){
	error("사이트 관리자가 아닙니다.","/");
	exit;
}

//관리자 요청
$admAplySql    = " SELECT idx FROM admin WHERE level = '1'";
$admAplyCnt  = $db->query($admAplySql);

//공지사항
$noticeSql   = " SELECT * FROM notice a WHERE del_yn != 'Y' ORDER BY idx DESC LIMIT 6";
$noticeCnt  = $db->query($noticeSql);
$noticeRst = $db->get_results($noticeSql);

//보도자료
$pressSql   = " SELECT * FROM press a WHERE del_yn != 'Y' ORDER BY idx DESC LIMIT 6";
$pressCnt  = $db->query($pressSql);
$pressRst = $db->get_results($pressSql);


?>
<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>M2O Global - Mileage to opportunity</title>
    <meta name="description" content="M2O Global - Mileage to opportunity">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="favicon.ico">

    <link rel="stylesheet" href="assets/css/normalize.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/css/cs-skin-elastic.css">
    <!-- <link rel="stylesheet" href="assets/css/bootstrap-select.less"> -->
    <link rel="stylesheet" href="assets/scss/style.css">
    <link href="assets/css/lib/vector-map/jqvmap.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
</head>
<body>

    <!-- Left Panel -->
    <?php include "./common/left_panel.php"; ?>
    <!-- Left Panel -->

    <!-- Right Panel -->

    <div id="right-panel" class="right-panel">

        <!-- Header-->
        <header id="header" class="header">

            <div class="header-menu">

                <div class="col-sm-7">
                    <a id="menuToggle" class="menutoggle pull-left"><i class="fa fa fa-tasks"></i></a>
                    <div class="header-left"></div>
                </div>

                <div class="col-sm-5">
                    <div class="user-area dropdown float-right">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: #1c3d5e; font-size: 30px; font-weight: 900;">
                            M
                        </a>

                        <div class="user-menu dropdown-menu">
                                <a class="nav-link" href="/admin/profile"><i class="fa fa- user"></i>My Profile</a>
                                <?php if( $sess_lev == 10 ) {?>
                                    <a class="nav-link" href="/admin/admManager"><i class="fa fa -cog"></i>Admin List</a>
                                <?php }?>
                                <a class="nav-link" href="/admin/logout"><i class="fa fa-power -off"></i>Logout</a>
                        </div>
                    </div>

                </div>
            </div>

        </header><!-- /header -->
        <!-- Header-->

        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Dashboard</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">&nbsp;</div>
            </div>
        </div>

        <div class="content mt-3">

			<?php if( $sess_lev == 10 && $admAplyCnt > 0 ){?>
            <div class="col-sm-12">
                <div class="alert  alert-success alert-dismissible fade show" role="alert" style="cursor:pointer;" onClick="location.href='/admin/admManager';">
                  <span class="badge badge-pill badge-success">알림</span> 관리자 요청이 들어왔습니다.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
			<?php } ?>


           <div class="col-sm-6 col-lg-3">
                <div class="card text-white bg-flat-color-1">
                    <div class="card-body pb-0">
                        <h4 class="mb-0">
                            <span class="count">10468</span>
                        </h4>
                        <p class="text-light">월별 홈페이지 방문자수</p>

                        <div class="chart-wrapper px-0" style="height:70px;" height="70">
                            <canvas id="widgetChart1"></canvas>
                        </div>

                    </div>

                </div>
            </div>
            <!--/.col-->

            <div class="col-sm-6 col-lg-3">
                <div class="card text-white bg-flat-color-2">
                    <div class="card-body pb-0">
                        <div class="dropdown float-right">
                        </div>
                        <h4 class="mb-0">
                            <span class="count">10468</span>
                        </h4>
                        <p class="text-light">시간대별 홈페이지 방문자수</p>

                        <div class="chart-wrapper px-0" style="height:70px;" height="70">
                            <canvas id="widgetChart2"></canvas>
                        </div>

                    </div>
                </div>
            </div>
            <!--/.col-->

            <div class="col-sm-6 col-lg-3">
                <div class="card text-white bg-flat-color-3">
                    <div class="card-body pb-0">
                        <div class="dropdown float-right"></div>
                        <h4 class="mb-0">
                            <span class="count">10468</span>
                        </h4>
                        <p class="text-light">월별 지갑 회원수</p>

                    </div>

                        <div class="chart-wrapper px-0" style="height:70px;" height="70">
                            <canvas id="widgetChart3"></canvas>
                        </div>
                </div>
            </div>
            <!--/.col-->

            <div class="col-sm-6 col-lg-3">
                <div class="card text-white bg-flat-color-4">
                    <div class="card-body pb-0">
                        <div class="dropdown float-right"></div>
                        <h4 class="mb-0">
                            <span class="count">10468</span>
                        </h4>
                        <p class="text-light">시간별 트랜잭션 발생비율</p>

                        <div class="chart-wrapper px-3" style="height:70px;" height="70">
                            <canvas id="widgetChart4"></canvas>
                        </div>

                    </div>
                </div>
            </div>
            <!--/.col-->

            <div class="col-xl-6">
                <div class="card">
    				<div class="card-body">
    					<div class="row">
    						<div class="col-sm-4">
    							<h4 class="card-title mb-0">공지사항</h4>
    						</div>
    						<!--/.col-->
    						<div class="col-sm-8 hidden-sm-down"> </div><!--/.col-->
    					</div><!--/.row-->
    					<div class="chart-wrapper mt-4" >
    						<table class="table">
    							<thead>
    								<tr>
    									<th scope="col">No</th>
    									<th scope="col">제목</th>
    									<th scope="col">등록일</th>
    								</tr>
    							</thead>
    							<tbody>
    								<?php
    								    if ($noticeRst) {
    								        $i = 0;
    								        foreach ($noticeRst as $data) {
    								            $idx = $data->idx;
    											$title = $data->title_ko;
    											$regdate = $data->regdate;
    											$regdate = substr($regdate,0,10);
    								?>
    								<tr>
    									<th scope="row"><?=$noticeCnt-$i?></th>
    									<td>
    										<a href="/admin/notice/write?table=notice&idx=<?=$idx?>&page_now=1"><?=$title?></a></td>
    									<td><?=$regdate?></td>
    								</tr>
    								<?php
    										$i++;
    								        }
    								    } else {
    								?>
    								<tr>
    								    <td colspan="3">등록된 게시물이 없습니다.</td>
    								</tr>
    								<?php } ?>
    							</tbody>
    						</table>

    					</div>
    				</div>
    			</div>
            </div>

           <div class="col-xl-3 col-lg-6">
                <section class="card">
                    <div class="twt-feed blue-bg">
                        <div class="corner-ribon black-ribon">
                            <i class="fa fa-twitter"></i>
                        </div>
                        <div class="fa fa-twitter wtt-mark"></div>

                        <div class="media">
                            <a href="#">
                                <img class="align-self-center rounded-circle mr-3" style="width:85px; height:85px;" alt="" src="images/admin.jpg">
                            </a>
                            <div class="media-body">
                                <h2 class="text-white display-6">M2O</h2>
                                <p class="text-light"></p>
                            </div>
                        </div>
                    </div>
                    <div class="weather-category twt-category">
                        <ul>
                            <li class="active">
                                <h5>53</h5>
                                Tweets
                            </li>
                            <li>
                                <h5>7</h5>
                                Following
                            </li>
                            <li>
                                <h5>17</h5>
                                Followers
                            </li>
                        </ul>
                    </div>
                </section>
            </div>

            <div class="col-xl-3 col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <div class="stat-widget-one">
                            <div class="stat-icon dib"><i class="ti-money text-success border-success"></i></div>
                            <div class="stat-content dib">
                                <div class="stat-text">일일 트랜잭션 M2O수량</div>
                                <div class="stat-digit">1,012</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-xl-3 col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <div class="stat-widget-one">
                            <div class="stat-icon dib"><i class="ti-user text-primary border-primary"></i></div>
                            <div class="stat-content dib">
                                <div class="stat-text">일일 지갑 회원</div>
                                <div class="stat-digit">961</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <div class="stat-widget-one">
                            <div class="stat-icon dib"><i class="ti-layout-grid2 text-warning border-warning"></i></div>
                            <div class="stat-content dib">
                                <div class="stat-text">KYC 인증 현황</div>
                                <div class="stat-digit">770</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-6">
                <div class="card">
    				<div class="card-body">
    					<div class="row">
    						<div class="col-sm-4">
    							<h4 class="card-title mb-0">보도자료</h4>
    						</div>
    						<!--/.col-->
    						<div class="col-sm-8 hidden-sm-down"> </div><!--/.col-->
    					</div><!--/.row-->
    					<div class="chart-wrapper mt-4" >
    						<table class="table">
    							<thead>
    								<tr>
    									<th scope="col">No</th>
    									<th scope="col">제목</th>
    									<th scope="col">등록일</th>
    								</tr>
    							</thead>
    							<tbody>
    								<?php
    								    if ($pressRst) {
    								        $i = 0;
    								        foreach ($pressRst as $data) {
    								            $idx = $data->idx;
    											$title = $data->title;
    											$regdate = $data->regdate;
    											$regdate = substr($regdate,0,10);
    								?>
    								<tr>
    									<th scope="row"><?=$pressCnt-$i?></th>
    									<td>
    										<a href="/admin/press/write?table=press&idx=<?=$idx?>&page_now=1"><?=$title?></a></td>
    									<td><?=$regdate?></td>
    								</tr>
    								<?php
    										$i++;
    								        }
    								    } else {
    								?>
    								<tr>
    								    <td colspan="3">등록된 게시물이 없습니다.</td>
    								</tr>
    								<?php } ?>
    							</tbody>
    						</table>

    					</div>
    				</div>
    			</div>
            </div>

            <div class="col-xl-6">
                <div class="card">
    				<div class="card-body">
    					<div class="row">
    						<div class="col-sm-4">
    							<h4 class="card-title mb-0">국가별 접속분포</h4>
    						</div>
    						<!--/.col-->
    						<div class="col-sm-8 hidden-sm-down"> </div><!--/.col-->
    					</div><!--/.row-->
    					<div class="chart-wrapper mt-4" >
    						<table class="table">
    							<thead>
    								<tr>
    									<th scope="col">No</th>
    									<th scope="col">제목</th>
    									<th scope="col">등록일</th>
    								</tr>
    							</thead>
    							<tbody>
    								<?php
    								    if ($pressRst) {
    								        $i = 0;
    								        foreach ($pressRst as $data) {
    								            $idx = $data->idx;
    											$title = $data->title;
    											$regdate = $data->regdate;
    											$regdate = substr($regdate,0,10);
    								?>
    								<tr>
    									<th scope="row"><?=$pressCnt-$i?></th>
    									<td>
    										<a href="/admin/press/write?table=press&idx=<?=$idx?>&page_now=1"><?=$title?></a></td>
    									<td><?=$regdate?></td>
    								</tr>
    								<?php
    										$i++;
    								        }
    								    } else {
    								?>
    								<tr>
    								    <td colspan="3">등록된 게시물이 없습니다.</td>
    								</tr>
    								<?php } ?>
    							</tbody>
    						</table>

    					</div>
    				</div>
    			</div>
            </div>

        </div> <!-- .content -->
    </div><!-- /#right-panel -->

    <!-- Right Panel -->


    <script src="assets/js/vendor/jquery-2.1.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"></script>
    <script src="assets/js/plugins.js"></script>
    <script src="assets/js/main.js"></script>

    <script src="assets/js/lib/chart-js/Chart.bundle.js"></script>
    <script src="assets/js/dashboard.js"></script>
    <script src="assets/js/widgets.js"></script>
</body>
</html>
