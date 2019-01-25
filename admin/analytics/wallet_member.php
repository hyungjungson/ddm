<?php
 header("Access-Control-Allow-Origin: *");
 ?>
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

//일별
$joinDateSql = "SELECT left(join_datetime,10) dateStr, count(left(join_datetime,10)) joinCnt FROM tb_demo_member GROUP BY left(join_datetime,10) ORDER BY left(join_datetime,10)";
$joinDateRst = $dbw->get_results($joinDateSql);

//월별
$joinMonthSql = "SELECT left(join_datetime,7) dateStr, count(left(join_datetime,7)) joinCnt FROM tb_demo_member GROUP BY left(join_datetime,7) ORDER BY left(join_datetime,7)";
$joinMonthRst = $dbw->get_results($joinMonthSql);

//시간별
$joinTimeSql = "SELECT substring(join_datetime,12,2) dateStr, count(substring(join_datetime,12,2)) joinCnt FROM tb_demo_member GROUP BY substring(join_datetime,12,2) order by substring(join_datetime,12,2)";
$joinTimeRst = $dbw->get_results($joinTimeSql);

$allMemSql = "SELECT COUNT(*) cnt FROM tb_demo_member";
$allMemRst = $dbw->get_col($allMemSql);
$allMemCnt = $allMemRst[0];

$thisMonthSql = "SELECT count(*) FROM tb_demo_member a WHERE left(a.join_datetime,7) = LEFT(DATE_SUB(now(), INTERVAL 3 HOUR),7)";
$thisMonthRst = $dbw->get_col($thisMonthSql);
$thisMonthCnt = $thisMonthRst[0];

$todaySql = "SELECT count(*) FROM tb_demo_member a WHERE left(a.join_datetime,10) = LEFT(DATE_SUB(now(), INTERVAL 3 HOUR),10)";
$todayRst = $dbw->get_col($todaySql);
$todayCnt = $todayRst[0];

?>

<script>
	//일별
	var dAry = new Array();
	var dvAry = new Array();

	//월별
	var mAry = new Array();
	var mvAry = new Array();

	//시간대별
	var tAry = new Array();
	var tvAry = new Array();
</script>
<?php $i = 0; foreach ($joinDateRst as $data) { $dateStr = $data->dateStr; $joinCnt = $data->joinCnt;
?>
	<script>
		dAry[<?=$i?>] = '<?=$dateStr?>';
		dvAry[<?=$i?>] = '<?=$joinCnt?>';
	</script>
<?php $i++; } ?>

<?php $i = 0; foreach ($joinMonthRst as $data) { $dateStr = $data->dateStr; $joinCnt = $data->joinCnt;?>
	<script>
		mAry[<?=$i?>] = '<?=$dateStr?>';
		mvAry[<?=$i?>] = '<?=$joinCnt?>';
	</script>
<?php $i++; } ?>

<?php $i = 0; foreach ($joinTimeRst as $data) { $dateStr = $data->dateStr; $joinCnt = $data->joinCnt;?>
	<script>
		tAry[<?=$i?>] = '<?=$dateStr?>';
		tvAry[<?=$i?>] = '<?=$joinCnt?>';
	</script>
<?php $i++; } ?>

<script>
    $(document).ready(function(){

		$("body").on('DOMSubtreeModified', "#active-users-container", function() {
		    $("#actCnt").html($(".ActiveUsers-value").html());
		});

	    var ctx = $("#user-daily-chart");
	    var myChart = new Chart( ctx, {
	        type: 'line',
	        data: {
	            labels: dAry, type: 'line',
	            defaultFontFamily: 'Montserrat',
	            datasets: [ { label: "가입자수", data: dvAry,
	                backgroundColor: 'transparent', borderColor: 'rgba(95,0,255,0.75)',
	                borderWidth: 3, pointStyle: 'circle', pointRadius: 1,
	                pointBorderColor: 'transparent', pointBackgroundColor: 'rgba(95,0,255,0.75)',
                }]
	        },
	        options: {
	            responsive: true,
	            tooltips: { mode: 'index', titleFontSize: 12,
	                titleFontColor: '#000', bodyFontColor: '#000',
	                backgroundColor: '#fff', titleFontFamily: 'Montserrat',
	                bodyFontFamily: 'Montserrat', cornerRadius: 3, intersect: false,
	            },
	            legend: {
	                display: false,
	                labels: { usePointStyle: true, fontFamily: 'Montserrat', },
	            },
	            scales: {
	                xAxes: [ {
						display: true,
						gridLines: { display: false, drawBorder: false },
						scaleLabel: { display: false, labelString: 'Month' }
					} ],
	                yAxes: [ {
						display: true,
						gridLines: { display: false, drawBorder: false },
						scaleLabel: { display: true, labelString: 'member' }
					} ]
	            },
	            title: { display: false, text: '' }
	        }
	    });

		var ctx2 = $("#chart-1-container");
	    var myChart2 = new Chart( ctx2, {
	        type: 'line',
	        data: {
	            labels: mAry, type: 'line',
	            defaultFontFamily: 'Montserrat',
	            datasets: [ { label: "dailyChart", data: mvAry,
	                backgroundColor: 'transparent', borderColor: 'rgba(0, 123, 255,0.75)',
	                borderWidth: 3, pointStyle: 'circle', pointRadius: 1,
	                pointBorderColor: 'transparent', pointBackgroundColor: 'rgba(0, 123, 255,0.75)',
                }]
	        },
	        options: {
	            responsive: true,
	            tooltips: { mode: 'index', titleFontSize: 12,
	                titleFontColor: '#000', bodyFontColor: '#000',
	                backgroundColor: '#fff', titleFontFamily: 'Montserrat',
	                bodyFontFamily: 'Montserrat', cornerRadius: 3, intersect: false,
	            },
	            legend: {
	                display: false,
	                labels: { usePointStyle: true, fontFamily: 'Montserrat', },
	            },
	            scales: {
	                xAxes: [ {
						display: true,
						gridLines: { display: false, drawBorder: false },
						scaleLabel: { display: false, labelString: 'Month' }
					} ],
	                yAxes: [ {
						display: true,
						gridLines: { display: false, drawBorder: false },
						scaleLabel: { display: true, labelString: 'member' }
					} ]
	            },
	            title: { display: false, text: '' }
	        }
	    });

		var ctx3 = $("#chart-2-container");
	    var myChart3 = new Chart( ctx3, {
	        type: 'line',
	        data: {
	            labels: tAry, type: 'line',
	            defaultFontFamily: 'Montserrat',
	            datasets: [ { label: "dailyChart", data: tvAry,
	                backgroundColor: 'transparent', borderColor: 'rgba(53,220,69,0.75)',
	                borderWidth: 3, pointStyle: 'circle', pointRadius: 1,
	                pointBorderColor: 'transparent', pointBackgroundColor: 'rgba(53,220,69,0.75)',
                }]
	        },
	        options: {
	            responsive: true,
	            tooltips: { mode: 'index', titleFontSize: 12,
	                titleFontColor: '#000', bodyFontColor: '#000',
	                backgroundColor: '#fff', titleFontFamily: 'Montserrat',
	                bodyFontFamily: 'Montserrat', cornerRadius: 3, intersect: false,
	            },
	            legend: {
	                display: false,
	                labels: { usePointStyle: true, fontFamily: 'Montserrat', },
	            },
	            scales: {
	                xAxes: [ {
						display: true,
						gridLines: { display: false, drawBorder: false },
						scaleLabel: { display: false, labelString: 'Month' }
					} ],
	                yAxes: [ {
						display: true,
						gridLines: { display: false, drawBorder: false },
						scaleLabel: { display: true, labelString: 'member' }
					} ]
	            },
	            title: { display: false, text: '' }
	        }
	    });
	});
</script>

<script>
(function(w,d,s,g,js,fs){
  g=w.gapi||(w.gapi={});g.analytics={q:[],ready:function(f){this.q.push(f);}};
  js=d.createElement(s);fs=d.getElementsByTagName(s)[0];
  js.src='https://apis.google.com/js/platform.js';
  fs.parentNode.insertBefore(js,fs);js.onload=function(){g.load('analytics');};
}(window,document,'script'));
</script>

<!-- Right Panel -->
<div id="right-panel" class="right-panel">

	<!-- Header-->
	<?php include "../common/mem_header.php"; ?>
	<!-- /header -->


	<div class="content mt-3">
		<div class="col-xl-12">
			<div class="card">
				<div class="card-header">
                    <h4>M2O 지갑회원 통계</h4>
                </div>
				<div class="card-body">
					<div class="row">
						<div class="col-sm-4">
							<h4 class="card-title mb-0"></h4>
						</div>
					</div><!--/.row-->
					<div class="chart-wrapper mt-4" >

						<div class="col-lg-3 col-md-6">
	                        <div class="card">
	                            <div class="card-body">
	                                <div class="stat-widget-one">
	                                    <div class="stat-icon dib"><i class="ti-user text-success border-success"></i></div>
	                                    <div class="stat-content dib">
	                                        <div class="stat-text">전체 회원수</div>
	                                        <div class="stat-digit"><?=$allMemCnt?></div>
	                                    </div>
	                                </div>
	                            </div>
	                        </div>
	                    </div>

						<div class="col-lg-3 col-md-6">
	                        <div class="card">
	                            <div class="card-body">
	                                <div class="stat-widget-one">
	                                    <div class="stat-icon dib"><i class="ti-calendar text-primary border-primary"></i></div>
	                                    <div class="stat-content dib">
	                                        <div class="stat-text">이번달 가입자수</div>
	                                        <div class="stat-digit"><?=$thisMonthCnt?></div>
	                                    </div>
	                                </div>
	                            </div>
	                        </div>
	                    </div>

						<div class="col-lg-3 col-md-6">
	                        <div class="card">
	                            <div class="card-body">
	                                <div class="stat-widget-one">
	                                    <div class="stat-icon dib"><i class="ti-heart text-warning border-warning"></i></div>
	                                    <div class="stat-content dib">
	                                        <div class="stat-text">오늘 가입자수</div>
	                                        <div class="stat-digit"><?=$todayCnt?></div>
	                                    </div>
	                                </div>
	                            </div>
	                        </div>
	                    </div>

						<div class="col-lg-3 col-md-6">
	                        <div class="card">
	                            <div class="card-body">
	                                <div class="stat-widget-one">
	                                    <div class="stat-icon dib"><i class="ti-comment-alt text-danger border-danger"></i></div>
	                                    <div class="stat-content dib">
	                                        <div class="stat-text">지갑 활성 사용자 수</div>
	                                        <div class="stat-digit" id="actCnt"></div>
	                                    </div>
	                                </div>
	                            </div>
	                        </div>
	                    </div>

                        <div class="col-12">
                            <h4>일별 가입회원</h4>
                            <canvas id="user-daily-chart" height="60"></canvas>
                        </div>
						<br/><br/><br/>
                        <div class="col-6" style="margin-top:40px;">
                            <h4>월별 가입회원 </h4>
                            <canvas id="chart-1-container" height="60"></canvas>
                            <div id="chart-1-container-table">

                            </div>
                        </div>
                        <div class="col-6" style="margin-top:40px;">
                            <h4>시간별 가입통계 </h4>
                            <canvas id="chart-2-container" height="60"></canvas>
                            <div id="chart-2-container-table">

                            </div>
                        </div>
						<header style="">
    						<div id="embed-api-auth-container" ></div>
    						<div id="view-selector-container" ></div>
    						<div id="view-name"></div>
    						<div id="active-users-container"></div>
						</header>
					</div>
				</div>
			</div>
		</div>

	</div> <!-- .content -->
</div><!-- /#right-panel -->

<!-- Include the ViewSelector2 component script. -->
<script src="/admin/chartjs/view-selector2.js"></script>
<!-- Include the ActiveUsers component script. -->
<script src="/admin/chartjs/active-users.js"></script>

<script>

gapi.analytics.ready(function() {

	gapi.analytics.auth.authorize({
      container: 'embed-api-auth-container',
      clientid: '845397893015-519mfe79l9jkheq2bnnt8ts5p6nvh606.apps.googleusercontent.com'
    });

    var activeUsers = new gapi.analytics.ext.ActiveUsers({
      query: { 'ids' : "ga:181432449" },
      container: 'active-users-container',
      pollingInterval: 5
    });

	activeUsers.once('success', function() {
      var element = this.container.firstChild;
      var timeout;

      this.on('change', function(data) {
        var element = this.container.firstChild;
        var animationClass = data.delta > 0 ? 'is-increasing' : 'is-decreasing';
        element.className += (' ' + animationClass);

        clearTimeout(timeout);
        timeout = setTimeout(function() {
          element.className =
              element.className.replace(/ is-(increasing|decreasing)/g, '');
        }, 3000);
      });
    });

	var viewSelector = new gapi.analytics.ext.ViewSelector2({
		container: 'view-selector-container',
	}).execute();

	viewSelector.on('viewChange', function(data) {
		var vIds = "ga:181432449";
		data.ids = vIds;
		activeUsers.set(data).execute();
	});

});

</script>

<!-- footer -->
<?php include "../common/footer.php"; ?>
<!-- footer -->
