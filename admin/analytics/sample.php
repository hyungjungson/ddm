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
                    <h4>홈페이지 통계</h4>
                </div>
				<div class="card-body">
					<div class="row">
						<div class="col-sm-4">
							<h4 class="card-title mb-0"></h4>
						</div>
					</div><!--/.row-->
					<div class="chart-wrapper mt-4" >
                        <header>
                          <div id="embed-api-auth-container"></div>
                          <div id="view-selector-container"></div>
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

// == NOTE ==
// This code uses ES6 promises. If you want to use this code in a browser
// that doesn't supporting promises natively, you'll have to include a polyfill.

gapi.analytics.ready(function() {

  /**
   * Authorize the user immediately if the user has already granted access.
   * If no access has been created, render an authorize button inside the
   * element with the ID "embed-api-auth-container".
   */
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


  /**
   * Create a new ViewSelector2 instance to be rendered inside of an
   * element with the id "view-selector-container".
   */
  var viewSelector = new gapi.analytics.ext.ViewSelector2({
    container: 'view-selector-container',
  }).execute();


  /**
   * Update the activeUsers component, the Chartjs charts, and the dashboard
   * title whenever the user changes the view.
   */
  viewSelector.on('viewChange', function(data) {
    // Start tracking active users for this view.
    activeUsers.set(data).execute();
  });


});
</script>
<!-- Right Panel -->

<!-- footer -->
<?php include "../common/footer.php"; ?>
<!-- footer -->
