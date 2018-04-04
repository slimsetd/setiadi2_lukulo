<?php

include 'setboot_function.php';
?>

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
<link href="<?php echo AWB; ?>admin_template/setboot/css/styles.css" rel="stylesheet">

<script type="text/javascript" src="<?php echo JWB; ?>jquery.js"></script>
<script src="<?php echo AWB; ?>admin_template/setboot/js/custom.js"></script>
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

<script type="text/javascript">
$(document).ready(function(){
	$('.dashboard').click(function(){
		window.location = 'index.php';
	});

	$('.logout').click(function(){
		window.location = 'logout.php';
	});

	$('.opac').bind('click', function(evt) {
    	evt.preventDefault();
    	top.jQuery.colorbox({iframe:true,
    	  href: $(this).attr('href'),
          width: function() { return parseInt($(window).width())-50; },
          height: function() { return parseInt($(window).height())-50; },
          title: function() { return '<i class="ti-desktop"></i>&nbsp;Online Public Access Catalog'; } }
        );
    });

    $('.user-table').click(function(){
    	parent.$('#mainContent').simbioAJAX('<?php echo MWB;?>system/profil_user.php');
    });

    $('.visual').click(function(){
    	parent.$('#mainContent').simbioAJAX('<?php echo MWB;?>reporting/customs/visualize_diagram.php');
    });
    <?php
    	if (isset($_GET['mod']) AND $_GET['mod'] == 'system') {
    		?>
    			$('ul.main_menu a.<?php echo __('system-configuration');?>').trigger('click');
    		<?php
    	}
    	if (isset($_GET['mod']) AND $_GET['mod'] == 'bibliography') {
    		?>
    			$('ul.main_menu a.daftar-bibliografi').trigger('click');
    		<?php
    	}
    ?>
});
</script>
<link rel="stylesheet" href="<?php echo JWB; ?>datatables.css" type="text/css" media="all" />
    <style type="text/css">
    	#chartDiv {
		width		: 85%;
		height		: 400px;
		font-size	: 11px;
		}

		.caret {
			margin-top: 7px !important;
		}
	    .setiadi-footer {
		    background-color: #2c3742;
		    box-shadow: inset 0px 0px 3px #111;
		    color: #fff;
		    font-size: 14px;
		    bottom: 0;
		    position: fixed;
		    width: 100%;
		}

		.setiadi-header {
			position: fixed !important;
			top: 0;
			width: 100%;
			margin-bottom: 100px;
			z-index: 2;
		}

		.box {
		    width: 79.333333%;
    		margin-left: 41px;
		}

		.click,.submenu label {
			cursor: pointer;
		}
    </style>
  </head>
  <body>
  	<div class="setiadi-header header">
	     <div class="container">
	        <div class="row">
	           <div class="col-md-5">
	              <!-- Logo -->
	              <div class="logo">
	                 <a href="<?php echo AWB;?>" style="text-decoration: none; color: white;"><img src="../images/logo.png" style="display:  inline-block;width: 47px;padding-bottom: 7px;" /><h1 style="display: inline-block; margin-left: 10px;font-size: 19pt;margin-bottom: 20px;"><?php echo $sysconf['library_subname'];?></h1></a>
	              </div>
	           </div>
	           <div style="color: white;float: right;">
	           		<table class="user-table" style="cursor: pointer;">
	           			<tr>
	           				<td rowspan="2">
	           					<img style="width:40px;height:40px;display: inline-block; background: white; border-radius: 50px; margin-top: 4px;" src="<?php echo SWB; ?>images/persons/<?php echo $_SESSION['upict'];?>">
	           				</td>
	           				<td valiang="middle" style="color: white; padding-left: 5px;">
	           					<span style="color: white;"><?php echo ucwords($_SESSION['uname']);?></span>
	           				</td>
	           			</tr>
	           		</table>
	           </div>
	        </div>
	     </div>
	</div>

    <div class="page-content">
    	<div class="row">
		  <div class="col-md-2">
		  	<div class="sidebar content-box" style="display: block; margin-top: 40px;width: 240px; height: 81%;">
		  		<div class="overflow" style="overflow: auto;height: 100%">
		  			<?php
	                	echo modify_menu();
	                ?>
		  		</div>
             </div>
		  </div>
		  <div class="box col-md-10">
		  	<div class="content-box-large" style="margin-top: 40px;">
		  		<div class="loader" style="display: none;"><?php echo $info; ?></div>
				<div id="mainContent" style="display: block;">
					<?php echo $main_content; ?>
				</div>
		  	</div>
		  </div>
		</div>
    </div>
    <iframe name="blindSubmit" style="visibility: hidden; width: 0; height: 0;"></iframe>
  </body>
</html>