<?php
	require_once('../core/db_connect.php');
	require_once('../core/header.php');
	
	$role = (isset($_SESSION['role'])) ? $_SESSION['role'] : '';
	$header = getHeader($role);
?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
	
	<title>School Quiz</title>
	
	<!-- css -->
	<link rel="icon" href="../assets/icons/site_icon.png">
	<link href="http://fonts.googleapis.com/css?family=Chivo:400,900" rel="stylesheet" />
	<link href="../styles/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="../styles/css/style.css" rel="stylesheet">
	<link href="../styles/css/default.css" rel="stylesheet" type="text/css" media="all" />
	<link href="../styles/css/fonts.css" rel="stylesheet" type="text/css" media="all" />
</head>
<!-- Image Slider Code -->
<script src="../core/scripts/jquery-1.11.3.min.js" type="text/javascript"></script>
<script src="../core/scripts/jssor.slider-27.5.0.min.js" type="text/javascript"></script>
<script type="text/javascript">
	jQuery(document).ready(function ($) {

		var jssor_1_SlideoTransitions = [
		  [{b:-1,d:1,o:-0.7}],
		  [{b:900,d:2000,x:-379,e:{x:7}}],
		  [{b:900,d:2000,x:-379,e:{x:7}}],
		  [{b:-1,d:1,o:-1,sX:2,sY:2},{b:0,d:900,x:-171,y:-341,o:1,sX:-2,sY:-2,e:{x:3,y:3,sX:3,sY:3}},{b:900,d:1600,x:-283,o:-1,e:{x:16}}]
		];

		var jssor_1_options = {
		  $AutoPlay: 1,
		  $SlideDuration: 800,
		  $SlideEasing: $Jease$.$OutQuint,
		  $CaptionSliderOptions: {
			$Class: $JssorCaptionSlideo$,
			$Transitions: jssor_1_SlideoTransitions
		  },
		  $ArrowNavigatorOptions: {
			$Class: $JssorArrowNavigator$
		  },
		  $BulletNavigatorOptions: {
			$Class: $JssorBulletNavigator$
		  }
		};

		var jssor_1_slider = new $JssorSlider$("jssor_1", jssor_1_options);

		/*#region responsive code begin*/

		var MAX_WIDTH = 3000;

		function ScaleSlider() {
			var containerElement = jssor_1_slider.$Elmt.parentNode;
			var containerWidth = containerElement.clientWidth;

			if (containerWidth) {

				var expectedWidth = Math.min(MAX_WIDTH || containerWidth, containerWidth);

				jssor_1_slider.$ScaleWidth(expectedWidth);
			}
			else {
				window.setTimeout(ScaleSlider, 30);
			}
		}

		ScaleSlider();

		$(window).bind("load", ScaleSlider);
		$(window).bind("resize", ScaleSlider);
		$(window).bind("orientationchange", ScaleSlider);
		/*#endregion responsive code end*/
	});
</script>

<link href="//fonts.googleapis.com/css?family=Roboto+Condensed:300,300italic,regular,italic,700,700italic&subset=latin-ext,greek-ext,cyrillic-ext,greek,vietnamese,latin,cyrillic" rel="stylesheet" type="text/css" />
<style>
	/*jssor slider loading skin spin css*/
	.jssorl-009-spin img {
		animation-name: jssorl-009-spin;
		animation-duration: 1.6s;
		animation-iteration-count: infinite;
		animation-timing-function: linear;
	}

	@keyframes jssorl-009-spin {
		from { transform: rotate(0deg); }
		to { transform: rotate(360deg); }
	}

	/*jssor slider bullet skin 032 css*/
	.jssorb032 {position:absolute;}
	.jssorb032 .i {position:absolute;cursor:pointer;}
	.jssorb032 .i .b {fill:#fff;fill-opacity:0.7;stroke:#000;stroke-width:1200;stroke-miterlimit:10;stroke-opacity:0.25;}
	.jssorb032 .i:hover .b {fill:#000;fill-opacity:.6;stroke:#fff;stroke-opacity:.35;}
	.jssorb032 .iav .b {fill:#000;fill-opacity:1;stroke:#fff;stroke-opacity:.35;}
	.jssorb032 .i.idn {opacity:.3;}

	/*jssor slider arrow skin 051 css*/
	.jssora051 {display:block;position:absolute;cursor:pointer;}
	.jssora051 .a {fill:none;stroke:#fff;stroke-width:360;stroke-miterlimit:10;}
	.jssora051:hover {opacity:.8;}
	.jssora051.jssora051dn {opacity:.5;}
	.jssora051.jssora051ds {opacity:.3;pointer-events:none;}
</style>
<!-- Image slider code end -->

<body>
	<div id="wrapper">
		<div id="header-wrapper">
			<div id="header" class="container-header">
				<div id="logo">
					<h1><a href="#">School Quiz</a></h1>
					<p>Δοκιμασε τις γνωσεις σου</p>
				</div>
			</div>
		</div>
		<div id="menu-wrapper">
			<div id="menu" class="container-header">
				 <?php echo $header; ?>
			</div>
			<!-- end #menu --> 
		</div>
		<div id="page" class="container-header">
			<div id="content">
				<div class="title">
					<h2>Αναμετρησου με τον εαυτο σου</h2>
					<span class="byline">Ανακαλυψε μεχρι που φτανουν οι γνωσεις σου</span>
				</div>
				<div class="title">
					<h2>Δες τα κενα σου</h2>
					<span class="byline">Ενημερωσου αμεσα για το που μπορεις να αναπληρωσεις τις γνωσεις που σε οδηγησαν σε τυχον λαθος απαντησεις</span>
				</div>
				<!-- Image Slider -->
				<div id="jssor_1" style="position:relative;margin:0 auto;top:0px;left:0px;width:1300px;height:500px;overflow:hidden;visibility:hidden;">
					<!-- Loading Screen -->
					<div data-u="loading" class="jssorl-009-spin" style="position:absolute;top:0px;left:0px;width:100%;height:100%;text-align:center;background-color:rgba(0,0,0,0.7);">
						<img style="margin-top:-19px;position:relative;top:50%;width:38px;height:38px;" src="assets/slider/spin.svg" />
					</div>
					<div data-u="slides" style="cursor:default;position:relative;top:0px;left:0px;width:1300px;height:500px;overflow:hidden;">
						<div>
							<img data-u="image" src="../assets/slider/1.jpg" />	
						</div>
						<div>
							<img data-u="image" src="../assets/slider/2.jpg" />
						</div>
						<div>
							<img data-u="image" src="../assets/slider/3.jpg" />
						</div>
					</div>
					<!-- Bullet Navigator -->
					<div data-u="navigator" class="jssorb032" style="position:absolute;bottom:12px;right:12px;" data-autocenter="1" data-scale="0.5" data-scale-bottom="0.75">
						<div data-u="prototype" class="i" style="width:16px;height:16px;">
							<svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
								<circle class="b" cx="8000" cy="8000" r="5800"></circle>
							</svg>
						</div>
					</div>
					<!-- Arrow Navigator -->
					<div data-u="arrowleft" class="jssora051" style="width:65px;height:65px;top:0px;left:25px;" data-autocenter="2" data-scale="0.75" data-scale-left="0.75">
						<svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
							<polyline class="a" points="11040,1920 4960,8000 11040,14080 "></polyline>
						</svg>
					</div>
					<div data-u="arrowright" class="jssora051" style="width:65px;height:65px;top:0px;right:25px;" data-autocenter="2" data-scale="0.75" data-scale-right="0.75">
						<svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
							<polyline class="a" points="4960,1920 11040,8000 4960,14080 "></polyline>
						</svg>
					</div>
				</div>
				<!-- Image Slider end-->
			</div>
		</div>
	</div>

	<div id="copyright" class="container">
		<img data-u="image" src="../assets/bodybg/pan.jpg" width="50" height="50" />
		<p>&copy; All rights reserved by </p>
			<p>	Kafteranis Evangelos  </p>
	</div>
</body>
</html>
