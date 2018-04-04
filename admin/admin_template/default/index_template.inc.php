<!DOCTYPE html>
<html><head><title><?php echo $page_title; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Pragma" content="no-cache" />
<meta http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate, post-check=0, pre-check=0" />
<meta http-equiv="Expires" content="Sat, 26 Jul 1997 05:00:00 GMT" />
<link rel="icon" href="<?php echo SWB; ?>webicon.ico" type="image/x-icon" />
<link rel="shortcut icon" href="<?php echo SWB; ?>webicon.ico" type="image/x-icon" />
<link href="<?php echo SWB; ?>template/core.style.css" rel="stylesheet" type="text/css" />
<link href="<?php echo SWB; ?>template/default/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo SWB; ?>template/default/css/bootstrap-responsive.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $sysconf['admin_template']['css']; ?>" rel="stylesheet" type="text/css" />
<link href="<?php echo JWB; ?>chosen/chosen.css" rel="stylesheet" type="text/css" />
<link href="<?php echo JWB; ?>colorbox/colorbox.css" rel="stylesheet" type="text/css" />
<link href="<?php echo JWB; ?>jquery.imgareaselect/css/imgareaselect-default.css" rel="stylesheet" type="text/css" />
<link href="<?php echo AWB; ?>admin_template/default/jquery.sidr.light.css" rel="stylesheet" type="text/css" />



<script type="text/javascript" src="<?php echo JWB; ?>jquery.js"></script>
<script type="text/javascript" src="<?php echo JWB; ?>updater.js"></script>
<script type="text/javascript" src="<?php echo JWB; ?>gui.js"></script>
<script type="text/javascript" src="<?php echo JWB; ?>form.js"></script>
<script type="text/javascript" src="<?php echo JWB; ?>calendar.js"></script>
<script type="text/javascript" src="<?php echo JWB; ?>tiny_mce/tiny_mce.js"></script>
<script type="text/javascript" src="<?php echo JWB; ?>keyboard.js"></script>
<script type="text/javascript" src="<?php echo JWB; ?>chosen/chosen.jquery.min.js"></script>
<script type="text/javascript" src="<?php echo JWB; ?>chosen/ajax-chosen.min.js"></script>
<script type="text/javascript" src="<?php echo JWB; ?>tooltipsy.js"></script>
<script type="text/javascript" src="<?php echo JWB; ?>colorbox/jquery.colorbox-min.js"></script>
<script type="text/javascript" src="<?php echo JWB; ?>jquery.imgareaselect/scripts/jquery.imgareaselect.pack.js"></script>
<script type="text/javascript" src="<?php echo JWB; ?>webcam.js"></script>
<script type="text/javascript" src="<?php echo JWB; ?>scanner.js"></script>
<script type="text/javascript" src="<?php echo AWB; ?>admin_template/default/jquery.sidr.min.js"></script>
<!-- This template is created by: Arie Nugraha (dicarve@gmail.com)
     based on template by Eddy Subratha -->

<script type="text/javascript" src="<?php echo JWB; ?>amcharts/amcharts.js"></script>
<script type="text/javascript" src="<?php echo JWB; ?>amcharts/pie.js"></script>
<script type="text/javascript" src="<?php echo JWB; ?>amcharts/plugins/export/export.min.js"></script>
<link rel="stylesheet" href="<?php echo JWB; ?>amcharts/plugins/export/export.css" type="text/css" media="all" />
<script type="text/javascript" src="<?php echo JWB; ?>amcharts/themes/light.js"></script>
<!-- added custom resource by doe 
	customize for visualize collection statistic
	-amChart CDN
-->
<script type="text/javascript" src="<?php echo JWB; ?>datatables.js"></script>
<link rel="stylesheet" href="<?php echo JWB; ?>datatables.css" type="text/css" media="all" />

<style>
#chartDiv {
	width		: 85%;
	height		: 400px;
	font-size	: 11px;
	}
	
.bs-wizard {
	border-bottom: solid 1px #e0e0e0; 
	padding: 0 0 10px 0;
	}
.bs-wizard > .bs-wizard-step {
	padding: 0; 
	position: relative;
	}
.bs-wizard > .bs-wizard-step + .bs-wizard-step {}
.bs-wizard > .bs-wizard-step .bs-wizard-stepnum {
	color: #595959; 
	font-size: 16px; 
	margin-bottom: 5px;
	}
.bs-wizard > .bs-wizard-step .bs-wizard-info {
	color: #999; 
	font-size: 14px;
	}
.bs-wizard > .bs-wizard-step > .bs-wizard-dot {
	position: absolute; 
	width: 30px; 
	height: 30px; 
	display: block; 
	background: #fbe8aa; 
	top: 45px; 
	left: 50%; 
	margin-top: -15px;
	margin-left: -15px; 
	border-radius: 50%;
	} 
.bs-wizard > .bs-wizard-step > .bs-wizard-dot:after {
	content: ' '; 
	width: 14px; 
	height: 14px; 
	background: #fbbd19; 
	border-radius: 50px; 
	position: absolute; 
	top: 8px; 
	left: 8px;
	} 
.bs-wizard > .bs-wizard-step > .progress {
	position: relative; 
	border-radius: 0px; 
	height: 8px; 
	box-shadow: none; 
	margin: 20px 0;
	}
.bs-wizard > .bs-wizard-step > .progress > .progress-bar {
	width:0px; 
	box-shadow: none; 
	background: #fbe8aa;
	}
.bs-wizard > .bs-wizard-step.complete > .progress > .progress-bar {width:100%;}
.bs-wizard > .bs-wizard-step.active > .progress > .progress-bar {width:50%;}
.bs-wizard > .bs-wizard-step:first-child.active > .progress > .progress-bar {width:0%;}
.bs-wizard > .bs-wizard-step:last-child.active > .progress > .progress-bar {width: 100%;}
.bs-wizard > .bs-wizard-step.disabled > .bs-wizard-dot {background-color: #f5f5f5;}
.bs-wizard > .bs-wizard-step.disabled > .bs-wizard-dot:after {opacity: 0;}
.bs-wizard > .bs-wizard-step:first-child  > .progress {left: 50%; width: 50%;}
.bs-wizard > .bs-wizard-step:last-child  > .progress {width: 50%;}
.bs-wizard > .bs-wizard-step.disabled a.bs-wizard-dot{ pointer-events: none; }


</style>
</head>
<body id="main">
<div id="sidepan">
<?php echo $sub_menu; ?>
</div>

<!-- main menu -->
<div id="mainMenu"><?php echo $main_menu; ?></div>
<!-- main menu end -->

<!-- header-->
<div id="header">
	<a class="sidebar-open btn btn-info" href="#"><i class="icon-list glyphicon glyphicon-align-justify"></i></a>
	<div id="headerImage">&nbsp;</div>
	<div id="libraryName">
		<a href="./index.php"><?php echo $sysconf['library_name']; ?></a>
	</div>
	<div id="librarySubName">
		<?php echo $sysconf['library_subname']; ?>
	</div>
</div>
<!-- header end-->

<table id="main" cellpadding="0" cellspacing="0">
<tr>
    <td>
    	<a name="top"></a>
	    <div class="loader"><?php echo $info; ?></div>
	    <div id="mainContent">
	    <?php echo $main_content; ?>
	    </div>
    </td>
</tr>
</table>

<!-- license info -->
<div id="footer"><?php echo $sysconf['page_footer']; ?></div>
<!-- license info end --><!-- fake submit iframe for search form, DONT REMOVE THIS! -->
<iframe name="blindSubmit" style="visibility: hidden; width: 0; height: 0;"></iframe>
<!-- <iframe name="blindSubmit" style="visibility: visible; width: 100%; height: 300px;"></iframe> -->
<!-- fake submit iframe -->

<script type="text/javascript">
jQuery(document).ready( function() {

 $('a.menuCurrent, .sidebar-open').sidr({
   name: 'sidepan',
   side: 'left'
	});

 // $.sidr('open', 'sidepan');
 $(document).ajaxStart(function() { $('.loader').fadeIn('fast'); }).ajaxStop(function() {
	  $.sidr('close', 'sidepan');
		setTimeout(function() { $('.loader').fadeOut('slow'); },  1000);
	});

 // bind arrow button event to show sidebar
 $(document).on('keypress', function(evt) {
   if (evt.altKey && (evt.keyCode == 39 || evt.keyCode == 37)) {
     $('.sidebar-open').trigger('click');
	 }
 });

})
</script>

</body>
</html>
