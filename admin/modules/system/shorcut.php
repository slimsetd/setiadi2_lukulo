<?php
/**
 * Copyright (C) 20017  Drajat Hasan (drajathasan20@gmail.com)
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
require SIMBIO.'simbio_DB/simbio_dbop.inc.php';
require SIMBIO.'simbio_GUI/form_maker/setiadi_form_maker.php';

// privileges checking
$can_read = utility::havePrivilege('system', 'r');
$can_write = utility::havePrivilege('system', 'w');

// Get Module list
if (isset($_GET['submenu']) AND !empty($_GET['mod'])) {
	$moduleName = trim($_GET['mod']);
	require MDLBS.$moduleName.'/submenu.php';
	$menu = array_chunk($menu, 1);
	$table   = "<form action=\"".$_SERVER['PHP_SELF']."\" method=\"POST\" target=\"blindSubmit\">";
	$table  .= "<table width=\"100%\" border=\"1\" class=\"table table-striped\">";
	foreach ($menu as $value) {
		$table .= "<tr>";
		foreach ($value as $val) {
			if ($val[0] == 'Header') {
				$table .= "<td style=\"background: #007bff!important; color: white;\"><b>".$val[1]."</b></td>";
			} else {
				$table .= "<td><input type=\"checkbox\" name=\"submenu[]\" value=\"".$val[0]."|".str_ireplace(MWB, '/', $val[1])."\" /> &nbsp;".$val[0]."</td>";
			}
		}
		$table .= "</tr>";
	}
	$table .= "<tr><td colspan=\"3\"><button name=\"saveShortcut\" class=\"btn btn-success\" style=\"float: right;\">Simpan</button></td></tr>";
	$table .= "</table>";
	$table .= "</form>";
	echo $table;
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
  	// Get modules data
  	
  	// Create Object
  	$setiadiForm = new setiadi_form($_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'], 'POST', false, 0, '');
  	// Create select 
  	// Get opt
  	$select_op = $dbs->query('SELECT module_name, module_path FROM mst_module');
  	$mod_opt = array();
  	while ($modOpt = $select_op->fetch_row()) {
  		$mod_opt[] = array($modOpt[1], $modOpt[0]);
  	}
  	// Reg Select
  	$setiadiForm->createModSelect('Modul', '', 'modul', $mod_opt);
  	// List
  	$setiadiForm->createAnything('<div style="display: none; width: 100%; height: auto; padding: 10px; background: #eaeaea;" id="submenuList"></div>');
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