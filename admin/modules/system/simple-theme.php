<?php
/**
 * Copyright (C) 2017  Drajat Hasan (drajathasan20@gmail.com)
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA
 *
 */
// key to authenticate
if (!defined('INDEX_AUTH')) {
  define('INDEX_AUTH', '1');
}

// key to get full database access
define('DB_ACCESS', 'fa');

if (!defined('SB')) {
    // main system configuration
    require '../../../sysconfig.inc.php';
    // start the session
    require SB.'admin/default/session.inc.php';
}
// IP based access limitation
require LIB.'ip_based_access.inc.php';
do_checkIP('smc');
do_checkIP('smc-system');

require SB.'admin/default/session_check.inc.php';
require SIMBIO.'simbio_FILE/simbio_directory.inc.php';
require SIMBIO.'simbio_GUI/table/simbio_table.inc.php';
require SIMBIO.'simbio_GUI/form_maker/simbio_form_table_AJAX.inc.php';
require SIMBIO.'simbio_DB/simbio_dbop.inc.php';
require MDLBS.'system/simple-theme.inc.php';

$alterTheme = new alternativeTheme();
if (isset($_POST['theme_name']) AND !empty($_POST['theme_name'])) {
	// Sanitize
	$theme = $dbs->escape_string($_POST['theme_name']);
	// Set array 
	$array_data = array('theme' => $theme, 'css' => 'admin_template/'.$theme.'/style.css');
	$encode     = serialize($array_data);
	// Set query
	$change_theme = $dbs->query("UPDATE setting SET setting_value='".$encode."' WHERE setting_name = 'admin_template'");
	// Set Msg
	if ($change_theme) {
		utility::writeLogs($dbs, 'staff', $_SESSION['uid'], 'system', $_SESSION['realname'].' success change admin theme with '.$_SERVER['REMOTE_ADDR']);
		echo "scs";
	} else {
		utility::writeLogs($dbs, 'staff', $_SESSION['uid'], 'system', $_SESSION['realname'].' failed change admin theme with '.$_SERVER['REMOTE_ADDR']);
		echo "err";
	}
	exit();
}

if (isset($_POST['pub_theme_name']) AND !empty($_POST['pub_theme_name'])) {
	// Sanitize
	$theme = $dbs->escape_string($_POST['pub_theme_name']);
	// Set array 
	$array_data = array('theme' => $theme, 'css' => 'template/'.$theme.'/style.css');
	$encode     = serialize($array_data);
	// Set query
	$change_theme = $dbs->query("UPDATE setting SET setting_value='".$encode."' WHERE setting_name = 'template'");
	// Set Msg
	if ($change_theme) {
		utility::writeLogs($dbs, 'staff', $_SESSION['uid'], 'system', $_SESSION['realname'].' success change public theme with '.$_SERVER['REMOTE_ADDR']);
		echo "scs";
	} else {
		utility::writeLogs($dbs, 'staff', $_SESSION['uid'], 'system', $_SESSION['realname'].' failed change public theme with '.$_SERVER['REMOTE_ADDR']);
		echo "err";
	}
	exit();
}
?>
<style type="text/css">
	#row {
		margin-right: -15px;
    	margin-left: -15px;
	}

	.notClick {
		cursor: pointer;
		background:#e8e8e8;
		width: 9%; 
		padding: 10px; 
		display: inline-block;
	}
</style>
<fieldset class="menuBox">
  <div class="menuBoxInner systemIcon">
    <div class="per_title">
      <h2><?php echo __('Theme Configuration'); ?></h2>
    </div>
    <div class="infoBox">
      <?php echo __('Customize theme preferences'); ?>
    </div>
  </div>
</fieldset>
<div class="clickArea" style="width: 100%; height: 100%;margin-top: 10px;">
	<div class="clickTab admin" data="admin" style="cursor: pointer;background: #3c8dbc !important; color: white; width: 9%; padding: 10px; display: inline-block;">
		<span style="display: block;"><i class="ti-user"></i> &nbsp;Admin</span>
	</div>
	<div class="clickTab public notClick" data="public">
		<span style="display: block;"><i class="ti-world"></i> &nbsp;Public</span>
	</div>
</div>
<div class="adminTemplate" style="background: #f7f7f7; padding-top: 10px;padding-bottom: 10px;">
<!-- Set Active Theme -->
<h4 style="padding-left: 23px;">Template admin aktif</h4>
<?php echo $alterTheme->setActiveTheme($dbs);?>		
<!-- Set Other Theme -->
<h4 style="padding-left: 23px;">Template admin lainnya</h4>
<?php echo $alterTheme->setTable('admin_template');?>
</div>
<div class="publicTemplate" style="display: none">
<!-- Set Active Theme -->
<h4 style="padding-left: 23px;">Template admin aktif</h4>
<?php echo $alterTheme->setPubActiveTheme($dbs);?>
<!-- Set Other Theme -->
<h4 style="padding-left: 23px;">Template admin lainnya</h4>
<?php echo $alterTheme->setPubTable('template');?>	
</div>


<script type="text/javascript">
  	$('.clickTab').click(function(){
  		var data = $(this).attr('data');
  		if (data == 'admin') {
  			$('.'+data+'Template').attr('style', 'background: #f7f7f7; padding-top: 10px;padding-bottom: 10px;');
  			$(this).attr('style', 'cursor: pointer;background: #3c8dbc !important; color: white; width: 9%; padding: 10px; display: inline-block;');
  			$(this).removeClass('notClick');
  			$(this).addClass('active');
  			$('.publicTemplate').attr('style', 'display:none');
  			$('.public').attr('style', 'cursor: pointer;background:#e8e8e8;width: 9%; padding: 10px; display: inline-block;');
  		} else {
  			$('.'+data+'Template').attr('style', 'background: #f7f7f7; padding-top: 10px;padding-bottom: 10px;');
  			$(this).attr('style', 'cursor: pointer;background: #3c8dbc !important; color: white; width: 9%; padding: 10px; display: inline-block;');
  			$(this).removeClass('notClick');
  			$(this).addClass('active');
  			$('.adminTemplate').attr('style', 'display:none');
  			$('.admin').attr('style', 'cursor: pointer;background:#e8e8e8;width: 9%; padding: 10px; display: inline-block;');
  		}
  	});
    // Admin Theme
    function ActiveTheme(str_handler_file, themeName) {
	    jQuery.ajax({ 
	    	url: str_handler_file, 
	    	type: 'POST',
	        data: 'theme_name=' + themeName,
	        success: function(ajaxRespond) {
	        	if (ajaxRespond == 'scs'){
	        		<?php echo 'top.location.href = \''.AWB.'index.php\';';?>
	        	} else {
	        		alert('error');
	        	}
	        } 
	    });
    }
    // Public Theme
    function ActivePubTheme(str_handler_file, themeName) {
	    jQuery.ajax({ 
	    	url: str_handler_file, 
	    	type: 'POST',
	        data: 'pub_theme_name=' + themeName,
	        success: function(ajaxRespond) {
	        	if (ajaxRespond == 'scs'){
	        		alert('Template berhasil dirubah.');
	        		parent.$('#mainContent').simbioAJAX('<?php echo MWB;?>system/simple-theme.php');
	        		$('.clickArea .public').trigger('click');
	        		parent.$('.opac').trigger('click');
	        	} else {
	        		alert('error');
	        	}
	        } 
	    });
    }
  </script>