
	
	var stmnLEFT = 0;
	var stmnGAP1 = 20; // 위쪽 여백 
	var stmnGAP2 = 70; // 스크롤시 브라우저 위쪽과 떨어지는 거리 
	var stmnBASE = 70; // 스크롤 시작위치 
	var stmnActivateSpeed = 3; 
	var stmnScrollSpeed = 3; 
	var stmnTimer; 

	function RefreshscrMenu() 
	{ 
		var stmnStartPoint, stmnEndPoint; 
		stmnStartPoint = parseInt(document.getElementById('quick_menu').style.top, 10); 
		stmnEndPoint = Math.max(document.documentElement.scrollTop, document.body.scrollTop) + stmnGAP2; 
		if (stmnEndPoint < stmnGAP1) stmnEndPoint = stmnGAP1; 
		if (stmnStartPoint != stmnEndPoint) 
		{ 
			stmnScrollAmount = Math.ceil( Math.abs( stmnEndPoint - stmnStartPoint ) / 15 ); 
			document.getElementById('quick_menu').style.top =
			parseInt(document.getElementById('quick_menu').style.top, 10) + ((stmnEndPoint<stmnStartPoint) ? -stmnScrollAmount : stmnScrollAmount ) + 'px'; 
			stmnRefreshTimer = stmnScrollSpeed; 
		}
		stmnTimer = setTimeout("RefreshscrMenu();", stmnActivateSpeed); 
	} 
	function InitializescrMenu() 
	{
		document.getElementById('quick_menu').style.right = stmnLEFT + 'px'; 
		document.getElementById('quick_menu').style.top = document.body.scrollTop + stmnBASE + 'px'; 
		RefreshscrMenu();
	}