<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<title>Last Minute - Circular Countdown</title>
<?php
$currentY=date("Y");
$currentM=date("n");
$currentD=date("j");
$currentH=date("H");
$currentMin=date("i");
$currentS=date("s");
?>
<style type="text/css">
html, body {
margin:0px;
padding:0px;
overflow-x: hidden;
}

</style>

<!-- must have -->
<link href="countdown_with_background.css" rel="stylesheet" type="text/css">

<link href='http://fonts.googleapis.com/css?family=Aldrich' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=PT+Serif:400,700' rel='stylesheet' type='text/css'>


<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js" type="text/javascript"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
<script src="js/countdown_with_background.js" type="text/javascript"></script>
<script src="js/jquery.touchSwipe.min.js" type="text/javascript"></script>
<!-- must have -->


	<script>
		jQuery(function() {

			jQuery('#countdown_with_background_v1').countdown_with_background({
				//countdown parameters
				beginDate:'2014,10,30,22,30,10', //year,month,day,hour,minute,second
				launchingDate:'2016,6,30,16,28,10',  //year,month,day,hour,minute,second
				nowDate:'<?=$currentY?>,<?=$currentM?>,<?=$currentD?>,<?=$currentH?>,<?=$currentMin?>,<?=$currentS?>',  //year,month,day,hour,minute,second
				complete:function() { alert( 'Done!' ); window.open("http://www.google.com","_blank") },
				pluginFontFamily:"'PT Serif', serif",
				circleRadius:100,
				circleLineWidth:10,
				behindCircleLineWidthExpand:0,
				behindCircleAlphaDays:50,
				behindCircleAlphaHours:50,
				behindCircleAlphaMinutes:50,
				behindCircleAlphaSeconds:50,
				circleColorDays:"#ffcc00",
				circleColorHours:"#ffcc00",
				circleColorMinutes:"#ffcc00",
				circleColorSeconds:"#ffcc00",
				textColorDays:"#FFFFFF",
				textColorHours:"#FFFFFF",
				textColorMinutes:"#FFFFFF",
				textColorSeconds:"#FFFFFF",
				h3Size:18,
				h3Color:'#FFFFFF',
				h4Color:'#FFFFFF',
				
				
				
				
				
				
				//bg parameters
				fadeSlides:true,
				enableTouchScreen:true,
				showNavArrows:false,
				showBottomNav:true,
				autoHideBottomNav:true,
				bottomNavLateralMargin:25, //only for left & right
				showPreviewThumbs:false,
				texturePath:'skins/patternFullScreenBg_3.png',
				thumbsWrapperMarginTop: -55
			});		
		});
		
			
		
	</script>
</head>

<body>
	<!-- countdown_with_background start -->
    <!-- background start -->
    <div id="countdown_with_background_v1">
            <div class="myloader"></div>
            <ul class="fullscreen_background_list">
                <li><img src="countdown_images/backgrounds/lastminutes/01_bullets.jpg" alt="" width="1920" height="1200" /></li>
             
                <li><img src="countdown_images/backgrounds/lastminutes/02_bullets.jpg" alt="" width="1920" height="1200" /></li>

                <li><img src="countdown_images/backgrounds/lastminutes/03_bullets.jpg" alt="" width="1920" height="1200" /></li>                   
                
                <li><img src="countdown_images/backgrounds/lastminutes/04_bullets.jpg" alt="" width="1920" height="1200" /></li>
            </ul>
	</div>
    <!-- background end -->
    <!-- countdown start -->
    <div class="my_counter">
                    <div class="logoDiv"><a href="http://codecanyon.net/user/LambertGroup?ref=LambertGroup" target="_blank"><img src="countdown_images/logo_sun.png" alt="logo" border="0" /></a></div>
                    <h2>LAST MINUTE - ONLY $350</h2>
<h3>PHILEMATIUM HOTEL - 5 star/all inclusive/5 nights. Save 40%, call now! (+39) 06.808.45.22</h3>
                    <div class="theCircles group">
                        <div class="daysDiv">	
                            <canvas class="canvasDays"></canvas>
                            <div class="innerNumber">0</div>
                            <div class="innerText">DAYS</div>
                        </div>
                        <div class="hoursDiv">	
                            <canvas class="canvasHours"></canvas>
                            <div class="innerNumber">0</div>
                            <div class="innerText">HOURS</div>
                        </div>
                        <div class="minutesDiv">	
                            <canvas class="canvasMinutes"></canvas>
                            <div class="innerNumber">0</div>
                            <div class="innerText">MINUTES</div>
                        </div>
                        <div class="secondsDiv">	
                            <canvas class="canvasSeconds"></canvas>
                            <div class="innerNumber">0</div>
                            <div class="innerText">SECONDS</div>
                        </div>
                    </div>
                    <div class="socialIconsDiv">
                        <h4>Stay in touch with us through our social channels</h4>
                        <ul class="socialIcons">
                            <li><a href="#"><img src="countdown_images/social_icons/facebook.png" width="24" height="24" alt="facebook" /></a></li>
                            <li><a href="#"><img src="countdown_images/social_icons/tweeter.png" width="24" height="24" alt="tweeter" /></a></li>
                            <li><a href="#"><img src="countdown_images/social_icons/tumblr.png" width="24" height="24" alt="tumblr" /></a></li>
                            <li><a href="#"><img src="countdown_images/social_icons/pinit.png" width="24" height="24" alt="pinit" /></a></li>
                            <li><a href="#"><img src="countdown_images/social_icons/google.png" width="24" height="24" alt="google" /></a></li>
                        </ul>
                      
                    </div>
        </div>
        <!-- countdown start -->
		<!-- countdown_with_background end -->
</body>
</html>
