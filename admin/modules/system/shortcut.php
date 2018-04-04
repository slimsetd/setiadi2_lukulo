<?php
/**
 * Setiadi Shortcut Wizard
 * Copyright (C) 2018  Drajat Hasan (drajathasan20@gmail.com)
 * Insipred SLiMS 8 Shorcut.php
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
// Hide notice
error_reporting(E_ALL & ~E_NOTICE);
/* User Profile Viewer */

// key to authenticate
define('INDEX_AUTH', '1');

// main system configuration
require '../../../sysconfig.inc.php';
// IP based access limitation
require LIB.'ip_based_access.inc.php';
do_checkIP('smc');
do_checkIP('smc-system');

// start the session
require SB.'admin/default/session.inc.php';
require SB.'admin/default/session_check.inc.php';
require SIMBIO.'simbio_GUI/form_maker/setiadi_form_maker.php';
require LIB.'setiadi_utility.inc.php';

// privileges checking
$can_read = utility::havePrivilege('system', 'r');
$can_write = utility::havePrivilege('system', 'w');

if (!$can_read AND !$can_write) {
	die('You can\'t access this area!');
}

// Get opt
$select_op = $dbs->query('SELECT module_name, module_path FROM mst_module');
$mod_opt = array();
while ($modOpt = $select_op->fetch_row()) {
	$mod_opt[] = array($modOpt[1], $modOpt[0]);
}

// function get Shorcut data
function getShortCutData($dbs)
{
	// get shortcut data
	$short_data = $dbs->query('SELECT setting_value FROM setting WHERE setting_name = "setiadi_shortcut_'.$_SESSION['uid'].'"');
	if ($short_data) {
		$getscData = $short_data->fetch_assoc();
		$unseriaLize = unserialize($getscData['setting_value']);
		return $unseriaLize;
	}
	return false;
}

// checking dependences
$check_q = $dbs->query('SELECT setting_name FROM setting WHERE setting_name = "setiadi_shortcut_'.$_SESSION['uid'].'"');

if ($check_q->num_rows == 0) {
	$insert = $dbs->query('INSERT INTO setting (setting_name) VALUES(\'setiadi_shortcut_'.$dbs->escape_string($_SESSION['uid']).'\')');
	if (!$insert) {
		die($dbs->error);
	}
}

// Remove shorcut
if (isset($_POST['deleteShortcut'])) {
	// Get data
	$submenu = (isset($_POST['submenu']))?setiadi_utility::arrayEscapeString($dbs, $_POST['submenu']):NULL;
	// Encode
	$encode = serialize($submenu);
	// Update
	$update = $dbs->query('UPDATE setting SET setting_value = \''.$encode.'\' WHERE setting_name = "setiadi_shortcut_'.$_SESSION['uid'].'"');
	// Checking
	if (!$update) {
		utility::jsAlert('Pemintas gagal dihapus!');
	}
	// Success msg
	utility::jsAlert('Pemintas berhasil dihapus!');
	echo '<script type="text/javascript">top.location.href = "'.AWB.'index.php";</script>';
	exit();
}

// Save shorcut
if (isset($_POST['saveShortcut']) AND isset($_POST['submenu'])) {
	// Get shorcut data
	$shcrt_data = $dbs->query('SELECT setting_value FROM setting WHERE setting_name = "setiadi_shortcut_'.$_SESSION['uid'].'"');
	// checking
	if ($shcrt_data->num_rows == 1) {
		// Fetch data
		$shortcutData = $shcrt_data->fetch_assoc();
		// If its not null
		if (!is_null($shortcutData['setting_value']) AND !is_null($_POST['submenu'])) {
			// Decoding
			$decode = unserialize($shortcutData['setting_value']);
			// Prevent same shorcut
			if ($decode) {
				foreach ($decode as $key => $value) {
					$data = $_POST['submenu'];
					if ($value == $_POST['submenu'][$key]) {
						unset($_POST['submenu'][$key]);
						$data = $_POST['submenu'];
					}
				}
			} else {
				$data = $_POST['submenu'];
			}
			// merge 
			$submenu = setiadi_utility::arrayEscapeString($dbs, $data);
			$merge =  (is_null($decode))?$submenu:array_merge($decode, $submenu);
			$merge = serialize($merge);
			// Updating
			$update = $dbs->query('UPDATE setting SET setting_value = \''.$merge.'\' WHERE setting_name = "setiadi_shortcut_'.$_SESSION['uid'].'"');
			if ($update) {
				utility::jsAlert('Pintasan berhasil diperbaharui.');
				echo '<script type="text/javascript">top.location.href = "'.AWB.'index.php";</script>';
			} else {
				utility::jsAlert('Pintasan tidak berhasil diperbaharui.');
			}
		} else {
			//
			$submenu = setiadi_utility::arrayEscapeString($dbs, $_POST['submenu']);
			$encode = serialize($submenu);
			// Updating
			$update = $dbs->query('UPDATE setting SET setting_value = \''.$encode.'\' WHERE setting_name = "setiadi_shortcut_'.$_SESSION['uid'].'"');
			if ($update) {
				utility::jsAlert('Pintasan berhasil disimpan.');
				echo '<script type="text/javascript">top.location.href = "'.AWB.'index.php";</script>';
			} else {
				utility::jsAlert('Pintasan tidak berhasil disimpan.');
			}
		}
	}
	exit();
}

// Get Module list
if (isset($_GET['submenu']) AND !empty($_GET['mod'])) {
	$moduleName = trim($_GET['mod']);
	$moduleSubmenu = MDLBS.$moduleName.'/submenu.php';

	// If file exist
	if (file_exists($moduleSubmenu)) {
		require $moduleSubmenu;
		$menu 	 = array_chunk($menu, 1);
		$table   = "<form action=\"".$_SERVER['PHP_SELF']."\" method=\"POST\" target=\"blindSubmit\">";
		$table  .= "<table width=\"100%\" border=\"1\" class=\"table table-striped\">";
		$visibility = false;
		foreach ($menu as $value) {
			$table .= "<tr>";
			foreach ($value as $val) {
				$scData = getShortCutData($dbs);
				$_value = $val[0]."|".str_ireplace(MWB, '/', $val[1]);
				$checked = '';
				if (!empty($scData)) {
					if (in_array($_value, $scData)) {
						$checked = 'checked';
						$visibility = 0;
					}
				}
					
				if ($val[0] == 'Header') {
					$table .= "<td style=\"background: #007bff!important; color: white;\"><b>".$val[1]."</b></td>";
				} else {
					$table .= "<td><input type=\"checkbox\" name=\"submenu[]\" value=\"".$_value."\" ".$checked."/> &nbsp;".$val[0]."</td>";
				}
				$visibility++;
			}
			$table .= "</tr>";
		}
		$delete = '';
		// if ($visibility) {
		// 	$delete ="<button name=\"deleteShortcut\" class=\"btn btn-danger\" style=\"float: right;margin-right: 10px;\">Hapus pemintas terpilih</button>";
		// }
		$table .= "<tr><td colspan=\"3\"><button name=\"saveShortcut\" class=\"btn btn-success\" style=\"float: right;\">Simpan</button>".$delete."&nbsp;</td></tr>";
		$table .= "</table>";
		$table .= "</form>";
		echo $table;
	}
	// Stop Access
	exit();
}
?>
<fieldset class="menuBox">
<div class="menuBoxInner">
  <div class="per_title">
	    <h2><?php echo __('Shorcut'); ?></h2>
  </div>
  <div class="block">
  	<?php
  	// Create table if not get event change
  	$shrct_data = getShortCutData($dbs);
  	$table = '';
  	$show = 'display: none;';
  	if ($shrct_data) {
		$table  .= "<form action=\"".$_SERVER['PHP_SELF']."\" method=\"POST\" target=\"blindSubmit\">";
		$table  .= "<table width=\"100%\" border=\"1\" class=\"table table-striped\">";
		$table  .= "<td style=\"background: #007bff!important; color: white;\"><b>Daftar Pemintas Terpasang</b>  (Untuk menghapus pemintas, hilangkan centang lalu klik tombol 'Hapus pemintas terpilih')</td>";
		foreach ($shrct_data as $val) {
			$table .= "<tr>";
			$_value = preg_replace('@\|.+$@i', '', $val);
			$table .= "<td><input type=\"checkbox\" name=\"submenu[]\" value=\"".$val."\" checked/> &nbsp;".$_value."</td>";
			$table .= "</tr>";
		}
		$delete ="<button name=\"deleteShortcut\" class=\"btn btn-danger\" style=\"float: right;\">Hapus pemintas terpilih</button>";
		$table .= "<tr><td colspan=\"3\">".$delete."&nbsp;</td></tr>";
		$table .= "</table>";
		$table .= "</form>";
		$show = '';
	}
  	// Create Object
  	$setiadiForm = new setiadi_form($_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'], 'POST', false, 0, '');
  	// Create select 
  	// Reg Select
  	$setiadiForm->createModSelect('Modul', '', 'modul', $mod_opt);
  	// List
  	$setiadiForm->createAnything('<div style="'.$show.' width: 100%; height: auto; padding: 10px; background: #eaeaea;" id="submenuList">'.$table.'</div>');
  	// Set printOut
  	echo $setiadiForm->printOut();
  	?>
  </div>
</div>
</fieldset>
<script type="text/javascript">
	$('#modul').change(function(){
		var module = $(this).val();
		if (module != 0) {
			$('#submenuList').slideDown();
			$('#submenuList').load('<?php echo $_SERVER['PHP_SELF'];?>?submenu=true&mod='+module);
		} else {
			$('#submenuList').html(" ");
			$('#submenuList').slideUp();
		}
	});
</script>