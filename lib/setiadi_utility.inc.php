<?php
/**
 * Setiadi Utility Class
 * Copyright (C) 2018 Drajat Hasan (drajathasan20@gmail.com)
 *
 * Inspired from Utility Class created by Arie Nugraha (dicarve@yahoo.com)
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

// be sure that this file not accessed directly
if (!defined('INDEX_AUTH')) {
  die("can not access this file directly");
} elseif (INDEX_AUTH != 1) { 
  die("can not access this file directly");
}

class setiadi_utility
{
	// Function to checking value of select
	public static function newSelect($obj_db, $table, $coloumn, $value)
	{
		// Checking
		if (empty($coloumn) AND empty($value)) {
			return false;
		}
		// Inserting data
		$date = date('Y-m-d');
		$insertData = $obj_db->query("INSERT INTO ".$table." (".$coloumn.", input_date, last_update) VALUES('".$value."', '".$date."', '".$date."')");
		// GetInsertId
		if ($insertData) {
			$insertID = $obj_db->insert_id;
		}
		// Set Out
		return $insertID;
	}

	// Function to sanitate array
	public static function arrayEscapeString($dbs, $array)
	{
	   foreach($array as $key=>$value) {
	      if (is_array($value)) { 
	      	arrayEscapeString($value); 
	      } else { 
	      	$array[$key] = $dbs->escape_string($value); 
	      }
	   }
	   return $array;
	}
	
	// Function to generate random string
	function generateRandomString($length = 10) {
	    $char = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $charLength = strlen($char);
	    $randString = '';
	    for ($i = 0; $i < $length; $i++) {
	        $randString .= $char[rand(0, $charLength - 1)];
	    }
	    return $randString;
	}
}
?>
