<?php
/**
 * Copyright (C) 2018  Drajat Hasan (drajathasan20@gmail.com)
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
/* Install Function */
define('INDEX_AUTH', 1);
define('noWrite', 0);
define('UpdateAdmin', 3);
// Setiadi Utility
require '../lib/setiadi_utility.inc.php';
/* Function to install setiadi */
function doInstall($dbs, $array_data)
{	
	// Filtering
	$withUpdate = false;
	$data = setiadi_utility::arrayEscapeString($dbs, $array_data);
	// Get Query
	$setiadi_query = file_get_contents('setiadi.sql');
	if (!empty($data['uname']) AND !empty($data['upass'])) {
		$setiadi_query .= 'UPDATE user SET username="'.$data['uname'].'", passwd="'.password_hash($data['upass'], PASSWORD_BCRYPT).'" WHERE user_id = 1;';
		file_put_contents('setiadi-new.sql', $setiadi_query);
		$withUpdate = true;
	}
	// IsWriteable
	if (is_writable('../db_config')) {
		// Run query
		$getQuery = ($withUpdate)?file_get_contents('setiadi-new.sql'):$setiadi_query;
		$install_query = $dbs->multi_query($getQuery);
		if ($install_query) {
			$sysconfig = file_get_contents('../db_config/sysconfig.local.inc-sample.php');
			$sysconfig = str_replace('_DB_HOST_', $data['host'], $sysconfig);
			$sysconfig = str_replace('_DB_NAME_', $data['dbname'], $sysconfig);
			$sysconfig = str_replace('_DB_USERNAME_', $data['dbuname'], $sysconfig);
			$sysconfig = str_replace('_DB_PASSWORD_', $data['dbpass'], $sysconfig);
			file_put_contents('../db_config/sysconfig.local.inc.php', $sysconfig);
			if (!empty($data['uname']) AND !empty($data['upass'])) {
				return UpdateAdmin;
			}
			return true;
		} else {
			return false;
		}
	} else {
		return noWrite;
	}
	return false;
}
?>