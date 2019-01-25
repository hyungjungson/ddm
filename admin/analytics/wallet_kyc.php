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
$joinDateSql = "SELECT left(create_date,10) dateStr, count(left(create_date,10)) joinCnt FROM tb_demo_kyc_certification GROUP BY left(create_date,10) ORDER BY left(create_date,10)";
$joinDateRst = $dbw->get_results($joinDateSql);

//월별
$joinMonthSql = "SELECT left(create_date,7) dateStr, count(left(create_date,7)) joinCnt FROM tb_demo_kyc_certification GROUP BY left(create_date,7) ORDER BY left(create_date,7)";
$joinMonthRst = $dbw->get_results($joinMonthSql);

//시간별
$joinTimeSql = "SELECT substring(create_date,12,2) dateStr, count(substring(create_date,12,2)) joinCnt FROM tb_demo_kyc_certification GROUP BY substring(create_date,12,2) order by substring(create_date,12,2)";
$joinTimeRst = $dbw->get_results($joinTimeSql);

$aMemSql = "SELECT COUNT(*) cnt FROM tb_demo_kyc_certification";
$aMemRst = $dbw->get_col($aMemSql);
$aMemCnt = $aMemRst[0];

$oMemSql = "SELECT COUNT(*) cnt FROM tb_demo_kyc_certification WHERE kyc_yn = 'Y'";
$oMemRst = $dbw->get_col($oMemSql);
$oMemCnt = $oMemRst[0];

$xMemSql = "SELECT count(*) FROM tb_demo_kyc_certification WHERE kyc_yn = 'N'";
$xMemRst = $dbw->get_col($xMemSql);
$xMemCnt = $xMemRst[0];

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

						<div class="col-lg-4 col-md-6">
	                        <div class="card">
	                            <div class="card-body">
	                                <div class="stat-widget-one">
	                                    <div class="stat-icon dib"><i class="ti-user text-success border-success"></i></div>
	                                    <div class="stat-content dib">
	                                        <div class="stat-text">전체 KYC 요청수</div>
	                                        <div class="stat-digit"><?=$aMemCnt?></div>
	                                    </div>
	                                </div>
	                            </div>
	                        </div>
	                    </div>

						<div class="col-lg-4 col-md-6">
	                        <div class="card">
	                            <div class="card-body">
	                                <div class="stat-widget-one">
	                                    <div class="stat-icon dib"><i class="ti-check text-primary border-primary"></i></div>
	                                    <div class="stat-content dib">
	                                        <div class="stat-text">승인 KYC 요청수</div>
	                                        <div class="stat-digit"><?=$oMemCnt?></div>
	                                    </div>
	                                </div>
	                            </div>
	                        </div>
	                    </div>

						<div class="col-lg-4 col-md-6">
	                        <div class="card">
	                            <div class="card-body">
	                                <div class="stat-widget-one">
	                                    <div class="stat-icon dib"><i class="ti-more text-danger border-danger"></i></div>
	                                    <div class="stat-content dib">
	                                        <div class="stat-text">미승인 KYC 요청수</div>
	                                        <div class="stat-digit"><?=$xMemCnt?></div>
	                                    </div>
	                                </div>
	                            </div>
	                        </div>
	                    </div>

                        <div class="col-12">
                            <h4>일별 KYC 요청수</h4>
                            <canvas id="user-daily-chart" height="60"></canvas>
                        </div>
						<br/><br/><br/>
                        <div class="col-6" style="margin-top:40px;">
                            <h4>월별 KYC 요청수 </h4>
                            <canvas id="chart-1-container" height="60"></canvas>
                            <div id="chart-1-container-table">

                            </div>
                        </div>
                        <div class="col-6" style="margin-top:40px;">
                            <h4>시간별 KYC 요청수 </h4>
                            <canvas id="chart-2-container" height="60"></canvas>
                            <div id="chart-2-container-table">

                            </div>
                        </div>
					</div>
				</div>
			</div>
		</div>

	</div> <!-- .content -->
</div><!-- /#right-panel -->

<!-- footer -->
<?php include "../common/footer.php"; ?>
<!-- footer -->
