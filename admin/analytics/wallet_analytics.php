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

?>

<!-- Right Panel -->
<div id="right-panel" class="right-panel">

	<!-- Header-->
	<?php include "../common/mem_header.php"; ?>
	<!-- /header -->

    <script>
    (function(w,d,s,g,js,fs){
      g=w.gapi||(w.gapi={});g.analytics={q:[],ready:function(f){this.q.push(f);}};
      js=d.createElement(s);fs=d.getElementsByTagName(s)[0];
      js.src='https://apis.google.com/js/platform.js';
      fs.parentNode.insertBefore(js,fs);js.onload=function(){g.load('analytics');};
    }(window,document,'script'));
    </script>

	<div class="content mt-3">
		<div class="col-xl-12">
			<div class="card">
				<div class="card-header">
                    <h4>M2O 지갑 통계</h4>
                </div>
				<div class="card-body">
					<div class="row">
						<div class="col-sm-4">
							<h4 class="card-title mb-0"></h4>
						</div>
					</div><!--/.row-->
					<div class="chart-wrapper mt-4" >
                        <div class="col-12">
                            <h4>일별 사용자 세션</h4>
                            <div id="chart-user-container"></div>
                        </div>
                        <div class="col-6">
                            <h4> 국가별 접속통계 </h4>
                            <div id="chart-1-container"></div>
                            <div id="chart-1-container-table"></div>
                        </div>
                        <div class="col-6">
                            <h4> 브라우저별 접속통계 </h4>
                            <div id="chart-2-container"></div>
                            <div id="chart-2-container-table"></div>
                        </div>
                        <div id="embed-api-auth-container"></div>
                        <div class="col-6" id="view-selector-1-container" ></div>
					</div>
				</div>
			</div>
		</div>

	</div> <!-- .content -->
</div><!-- /#right-panel -->
<!-- This demo uses the Chart.js graphing library and Moment.js to do date
     formatting and manipulation. -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/1.0.2/Chart.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>

<!-- Include the ViewSelector2 component script. -->
<script src="/admin/chartjs/view-selector2.js"></script>

<!-- Include the DateRangeSelector component script. -->
<script src="/admin/chartjs/date-range-selector.js"></script>

<!-- Include the ActiveUsers component script. -->
<script src="/admin/chartjs/active-users.js"></script>

<!-- Include the CSS that styles the charts. -->
<link rel="stylesheet" href="/admin/chartjs/chartjs-visualizations.css">
<script>

gapi.analytics.ready(function() {

    gapi.analytics.auth.authorize({
        container: 'embed-api-auth-container',
        clientid: '845397893015-519mfe79l9jkheq2bnnt8ts5p6nvh606.apps.googleusercontent.com'
    });

    var viewSelector1 = new gapi.analytics.ViewSelector({
        container: 'view-selector-1-container'
    });

    viewSelector1.execute();

    var userChart = new gapi.analytics.googleCharts.DataChart({
      query: {
        metrics: 'ga:sessions',
        dimensions: 'ga:date',
        'start-date': '2018-09-01',
        'end-date': 'today'
      },
      chart: {
        container: 'chart-user-container',
        type: 'LINE',
        options: {
          width: '100%'
        }
      }
    });

  var dataChart1 = new gapi.analytics.googleCharts.DataChart({
    query: {
      metrics: 'ga:sessions',
      dimensions: 'ga:country',
      'start-date': '2018-09-01',
      'end-date': 'today',
      'max-results': 10,
      sort: '-ga:sessions'
    },
    chart: {
      container: 'chart-1-container',
      type: 'PIE',
      options: {
        width: '100%',
        pieHole: 4/9
      }
    }
  });


  /**
   * Create the second DataChart for top countries over the past 30 days.
   * It will be rendered inside an element with the id "chart-2-container".
   */
  var dataChart2 = new gapi.analytics.googleCharts.DataChart({
    query: {
      'metrics': 'ga:sessions',
      'dimensions': 'ga:browser',
      'start-date': '2018-09-01',
      'end-date': 'today',
      'max-results': 10,
      sort: '-ga:sessions'
    },
    chart: {
      container: 'chart-2-container',
      type: 'PIE',
      options: {
        width: '100%',
        pieHole: 4/9
      }
    }
  });

  /**
   * Create a table chart showing top browsers for users to interact with.
   * Clicking on a row in the table will update a second timeline chart with
   * data from the selected browser.
   */
   var mainChart1 = new gapi.analytics.googleCharts.DataChart({
     query: {
         'metrics': 'ga:sessions',
         'dimensions': 'ga:country',
         'start-date': '2018-09-01',
         'end-date': 'today',
         'sort': '-ga:sessions',
         'max-results': 10
     },
     chart: {
       type: 'TABLE',
       container: 'chart-1-container-table',
       options: {
         width: '100%'
       }
     }
   });
  var mainChart2 = new gapi.analytics.googleCharts.DataChart({
    query: {
        'metrics': 'ga:sessions',
        'dimensions': 'ga:browser',
        'start-date': '2018-09-01',
        'end-date': 'today',
        'sort': '-ga:sessions',
        'max-results': 10
    },
    chart: {
      type: 'TABLE',
      container: 'chart-2-container-table',
      options: {
        width: '100%'
      }
    }
  });

  /**
   * Update the first dataChart when the first view selecter is changed.
   */
  var mainChart1RowClickListener;
  var mainChart2RowClickListener;
  viewSelector1.on('change', function(ids) {

	var vIds = "ga:181432449";

    //일별 사용자 세션
    userChart.set({query: {ids: vIds}}).execute();

    /*
    * 국가별
    */
    //파이형 그래프
    dataChart1.set({query: {ids: vIds}}).execute();

    //테이블형 그래프
    if (mainChart2RowClickListener) {
      google.visualization.events.removeListener(mainChart2RowClickListener);
    }
    mainChart1.set({query: {ids: vIds}}).execute();

    /*
    * 브라우저별
    */
    //파이형 그래프
    dataChart2.set({query: {ids: vIds}}).execute();

    //테이블형 그래프
    if (mainChart2RowClickListener) {
      google.visualization.events.removeListener(mainChart2RowClickListener);
    }
    mainChart2.set({query: {ids: vIds}}).execute();
  });


  mainChart1.on('success', function(response) {

    var chart = response.chart;
    var dataTable = response.dataTable;

    // Store a reference to this listener so it can be cleaned up later.
    mainChart1RowClickListener = google.visualization.events
        .addListener(chart, 'select', function(event) {

      // When you unselect a row, the "select" event still fires
      // but the selection is empty. Ignore that case.
      if (!chart.getSelection().length) return;

      var row =  chart.getSelection()[0].row;
      var country =  dataTable.getValue(row, 0);
      var options = {
        query: { filters: 'ga:country==' + country },
        chart: {
          options: {
            title: country
          }
        }
      };
    });
  });

  mainChart2.on('success', function(response) {

    var chart = response.chart;
    var dataTable = response.dataTable;

    // Store a reference to this listener so it can be cleaned up later.
    mainChart2RowClickListener = google.visualization.events
        .addListener(chart, 'select', function(event) {

      // When you unselect a row, the "select" event still fires
      // but the selection is empty. Ignore that case.
      if (!chart.getSelection().length) return;

      var row =  chart.getSelection()[0].row;
      var browser =  dataTable.getValue(row, 0);
      var options = {
        query: { filters: 'ga:browser==' + browser },
        chart: {
          options: {
            title: browser
          }
        }
      };
    });
  });

});
</script>

<!-- Right Panel -->

<!-- footer -->
<?php include "../common/footer.php"; ?>
<!-- footer -->
