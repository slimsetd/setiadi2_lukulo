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

// be sure that this file not accessed directly
if (!defined('INDEX_AUTH')) {
    die("can not access this file directly");
} elseif (INDEX_AUTH != 1) {
    die("can not access this file directly");
}

/* Include dependences */
include_once '../sysconfig.inc.php';

$locale = 'id_ID';
$domain = 'messages';
$encoding = 'UTF-8';

// set language to use
T_setlocale(LC_ALL, $locale);
// set locales dictionary location
_bindtextdomain($domain, LANG.'locale');
// codeset
_bind_textdomain_codeset($domain, $encoding);
// set .mo filename to use
_textdomain($domain);

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
	$icon           = array(
    'home'           => 'fa fa-home',
    'bibliography'   => 'fa fa-bookmark',
    'circulation'    => 'fa fa-clock-o',
    'membership'     => 'fa fa-user',
    'master_file'    => 'fa fa-files-o',
    'stock_take'     => 'fa fa-pencil-square-o',
    'system'         => 'fa fa-sliders',
    'reporting'      => 'fa fa-file-text',
    'serial_control' => 'fa fa-barcode',
    'logout'         => 'fa fa-sign-out',
    'opac'           => 'fa fa-desktop',
    'info'           => 'fa fa-info'
    );

	if (!is_null($icon[$mod])) {
		return $icon[$mod];
	}
	return 'fa fa-bars';
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
    $menu .= '<ul class="main_menu">';
    // $menu .= '<li><label class="click general" data-id="0" status="0"><i class="nav-icon '.getIcon('home').'"> </i>'.__('Home').'</label>'.modify_shorcut_menu().'<li>';
    $menu .= '<li><label class="dashboard general" href="'.AWB.'index.php?dashboard=true"><i class="nav-icon fa fa-dashboard"></i>Dashboard</label></li>';
    // $menu .= '<li><label class="opac general" href="../index.php"><i class="nav-icon '.getIcon('opac').'"></i>Opac</label></li>';
    // Default Number to make collapse works
    $no = 1;
    $sb = 1;
    $di = 1;
    // Loop array
 	foreach ($array_mod_chunk as $array_mod) {
		foreach ($array_mod as $module) {
			// Call icon function
			if (isset($_SESSION['priv'][$module['module_path']]['r']) && $_SESSION['priv'][$module['module_path']]['r'] && file_exists('modules'.DS.$module['module_path'])) {
				//$_icon = getIcon($module['module_name']);
				$menu .= '<li><label class="click '.$module['module_name'].'" data-id="'.$no++.'" status="0"><i class="nav-icon"> </i>'.str_replace('_', ' ', __($module['module_name'])).'</label>';
				$menu .= modify_sub_menu($module['module_path'], $module['module_name'], $sb++, $di++);
	            $menu .= '</li>';
        	}
		}
	}
	// Set General menu
	// $menu .= '<li><label class="logout general" href="logout.php"><i class="nav-icon '.getIcon('logout').'"> </i> Logout</label></li>';
	//$menu .= '<li><label class="about general" href="'.$_SERVER['PHP_SELF'].'?about=true"><i class="nav-icon '.getIcon('info').'"> </i> Tentang Modify</label></li>';
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
	$submenu .= '<ul id="sb'.$sbNumber.'" class="sub_menu" data-id="'.$diNumber.'">';
	// Loop Array
	foreach ($menu as $i => $val) {
		if ($val[0] == 'Header') {
			$submenu .= '<li><span class="header"><i class="fa fa-thumb-tack"></i>'.$menu[$i][1].'</span></li>';
		} else {
			$submenu .= '<li><a class="menu s-current-child submenu-'.$i.' '.strtolower(str_replace(' ', '-', $menu[$i][0])).'" href="'.$menu[$i][1].'" title="'.( isset($menu[$i][2])?$menu[$i][2]:$menu[$i][0] ).'"><i class="nav-icon fa fa-file-text-o"></i> '.$menu[$i][0].'</a></li>';		
		}
	}
	$submenu .= '</ul>';
	return $submenu;
}

function modify_shorcut_menu() {
	global $dbs;
    $shortcuts = array();
    // Set query
    $shortcuts_q = $dbs->query('SELECT * FROM setting WHERE setting_name LIKE \'shortcuts_'.$dbs->escape_string($_SESSION['uid']).'\'');
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
				$shorCutmenu .= '<li><span class="header"><i class="fa fa-thumb-tack"></i>'.$menu[$i][1].'</span></li>';
			} else {
				$shorCutmenu .= '<li><a class="menu '.$user_profil.' s-current-child submenu-0 '.strtolower(str_replace(' ', '-', $menu[$i][0])).'" href="'.$menu[$i][1].'" title="'.( isset($menu[$i][2])?$menu[$i][2]:$menu[$i][0] ).'"><i class="nav-icon fa fa-file-text-o"></i> '.$menu[$i][0].'</a></li>';
				$user_profil = NULL;
			}
		}
		$shorCutmenu .= '</ul>';
	// Set Out Shortcut	
    return $shorCutmenu;
}
?>