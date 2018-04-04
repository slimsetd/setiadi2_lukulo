<?php
/**
* Modify Custom Menu Layout based Custom Menu Layout
* 
* Copyright (C) 2015 Eddy Subratha (eddy.subratha@gmail.com)
* Adding and modfying several code by Youk (koelingerti@gmail.com) 2018
*
* This program is free software; you can redistribute it and/or modify
* it under the terms of the GNU General Public License as published by
* the Free Software Foundation; either version 2 of the License, or
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

/* Modified by Drajat */

// be sure that this file not accessed directly
if (!defined('INDEX_AUTH')) {
    die("can not access this file directly");
} elseif (INDEX_AUTH != 1) {
    die("can not access this file directly");
}

/* Include dependences */
include_once '../sysconfig.inc.php';

// Get User Type
function getUType($uid) 
{
	global $dbs;
	$uid = $dbs->escape_string($uid);
	// Set query
	$user_type = 1;
	$utype_q = $dbs->query('SELECT user_type FROM user WHERE user_id = "'.$uid.'"');
	// Checking
	if ($utype_q) {
		$user_type = $utype_q->fetch_object()->user_type;
	}
	return $user_type;
}

// Set getIcon
function getIcon($mod)
{
	$mod = strtolower($mod);
	$icon           = array(
    'home'           => 'ti-home',
    'dashboard'		 => 'ti-dashboard',
    'etd'   		 => 'ti-book',
    'circulation'    => 'ti-exchange-vertical',
    'membership'     => 'ti-user',
    'master_file'    => 'ti-files',
    'stock_take'     => 'ti-share',
    'system'         => 'ti-panel',
    'reporting'      => 'ti-agenda',
    'serial_control' => 'ti-receipt',
    'logout'         => 'ti-power-off',
    'opac'           => 'ti-desktop',
    'info'           => 'ti-info'
    );

	if (isset($icon[$mod])) {
		return $icon[$mod];
	}
	return 'ti-pin-alt';
}

function getColor($num)
{
	$color = array('#2196f3', '#795548', '#2196f3', '#ff5722', '#673ab7', '#3f51b5', '#03a9f4', '#009688');
	if ($num > 7) {
		return 'black';
	}
	return $color[$num];
}

// Set Modfy Menu
function modify_menu()
{
	global $dbs;

	// Set query
	$getModule = $dbs->query("SELECT module_name, module_path, module_desc FROM mst_module");
	$array_module = array();
	
	// set Array
	while ($mod = $getModule->fetch_assoc()) {
		$array_module[] = $mod;
	}

	// Chunk
	$array_mod_chunk = array_chunk($array_module, 1);
	// Make Main Menu
	$menu  = '<div id="sidepan">';
    $menu .= '<ul class="nav main_menu">';
    $menu .= '<li class="submenu current"><label class="click home"><i class="'.getIcon('home').'"></i> Beranda <span class="caret pull-right"></span></label>'.modify_shorcut_menu().'</li>';
    $menu .= '<li class="current"><label class="click dashboard"><i class="'.getIcon('dashboard').'"></i> Dashboard</label></li>';
    $menu .= '<li class="current"><label class="click opac" href="../index.php"><i class="'.getIcon('opac').'"></i> Opac</label></li>';
    // Default Number to make collapse works
    $no = 1;
    $sb = 1;
    $di = 1;
    // Color index
    $co = 0;
    // Loop array
 	foreach ($array_mod_chunk as $array_mod) {
		foreach ($array_mod as $module) {
			// Call icon function
			if (isset($_SESSION['priv'][$module['module_path']]['r']) && $_SESSION['priv'][$module['module_path']]['r'] && file_exists('modules'.DS.$module['module_path'])) {
				$_icon = getIcon($module['module_name']);
				$menu .= '<li class="submenu current"><label><i class="'.$_icon.'" style="color:'.getColor($co).'"></i>&nbsp;'.str_replace('_', ' ', ucwords($module['module_name'])).'<span class="caret pull-right"></span></label>';
				$menu .= modify_sub_menu($module['module_path'], $module['module_name'], $sb++, $di++);
	            $menu .= '</li>';
	            $co++;
        	}
		}
	}
	// Set General menu
	$menu .= '<li class="current"><label class="click logout" href="logout.php"><i class="'.getIcon('logout').'"></i> Logout</label></li>';
	$menu .= '</div>';
    $menu .= '</ul>';
    echo $menu;
}

// Set Modify Sub Menu
function modify_sub_menu($module_path, $module_name, $sbNumber, $diNumber) {
	global $dbs;
	// Get Submenu File
	$submenu_file = 'modules/'.$module_path.'/submenu.php';
	// checking
	if (file_exists($submenu_file)) {
		include $submenu_file;
	} else {
		// Include default menu
		include 'default/submenu.php';
	}

	// Make sub_menu
	$submenu  = '';
	$submenu .= '<ul>';
	// Loop Array
	foreach ($menu as $i => $val) {
		if ($val[0] == 'Header') {
			$submenu .= '<li><span class="mheader"><i class="ti-pin-alt"></i> '.$menu[$i][1].'</span></li>';
		} else {
			$submenu .= '<li><a class="menu s-current-child submenu-'.$i.' '.strtolower(str_replace(' ', '-', $menu[$i][0])).'" href="'.$menu[$i][1].'" title="'.( isset($menu[$i][2])?$menu[$i][2]:$menu[$i][0] ).'"><i class="nav-icon ti-menu"></i> '.$menu[$i][0].'</a></li>';		
		}
	}
	$submenu .= '</ul>';
	return $submenu;
}

function modify_shorcut_menu() {
	global $dbs;
    $shortcuts = array();
    // Set query
    $shortcuts_q = $dbs->query('SELECT * FROM setting WHERE setting_name LIKE \'setiadi_shortcut_'.$dbs->escape_string($_SESSION['uid']).'\'');
    $shortcuts_d = $shortcuts_q->fetch_assoc();

	    if ($shortcuts_q->num_rows > 0) {
	      $shortcuts = unserialize($shortcuts_d['setting_value']);
	    }

	    // Set Shorcut
		include 'default/submenu.php';
		// Set for user profil
		$user_profil = '';
		if (is_array($menu['user-profile'])) {
			$user_profil = 'u-profil';
		 }
		// Checking for zero value
		if ($shortcuts) {
			foreach ($shortcuts as $val) {
			  $path = preg_replace('@^.+?\|/@i', '', $val);
			  $label = preg_replace('@\|.+$@i', '', $val);
			  $menu[] = array($label, MWB.$path, $label);
			}
		}

		// Make loop
		$shorCutmenu  = '';
		$shorCutmenu .= '<ul id="sb0" class="sub_menu" data-id="0">';
		foreach ($menu as $i => $val) {	
			if ($val[0] == 'Header') {
				$shorCutmenu .= '<li><span class="mheader"><i class="ti-pin-alt"></i>'.$menu[$i][1].'</span></li>';
			} else {
				$shorCutmenu .= '<li><a class="menu '.$user_profil.' s-current-child submenu-0 '.strtolower(str_replace(' ', '-', $menu[$i][0])).'" href="'.$menu[$i][1].'" title="'.( isset($menu[$i][2])?$menu[$i][2]:$menu[$i][0] ).'"><i class="nav-icon ti-menu"></i> '.$menu[$i][0].'</a></li>';
				$user_profil = NULL;
			}
		}
		$shorCutmenu .= '</ul>';
	// Set Out Shortcut	
    return $shorCutmenu;
}
?>