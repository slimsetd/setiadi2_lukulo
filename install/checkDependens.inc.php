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
/* Dependences checking function */
// Set Error
$error 		= 0;
// PHP Version
$PHPversion = explode('.', PHP_VERSION);
$PHPversion = $PHPversion[0].'.'.$PHPversion[1];
$CheckPHP	= ($PHPversion < '5.5')?$error++:1;
// MySQLi
$MYSQLisLoad = (extension_loaded('mysqli'))?1:$error++;
$MySQLiLabel = ($MYSQLisLoad == 1)?'MySQL':'Unknown';
// GD
$GDisLoad = (function_exists('gd_info'))?1:$error++;
$GDLabel  = ($GDisLoad == 1)?'Yes':'No';
// YAZ
$YAZisLoad = (extension_loaded('yaz'))?1:$error++;
$YAZLabel  = ($YAZisLoad == 1)?'Yes':'No';
// Gettext
$GettextisLoad = (extension_loaded('gettext'))?1:$error++;
$GettextLabel  = ($GettextisLoad == 1)?'Yes':'No';
// Combine In An array
$dependence = array('PHP' => $CheckPHP, 'MySQLi' => $MYSQLisLoad, 'GD' => $GDisLoad, 'YAZ' => $YAZisLoad, 'Gettext' => $GettextisLoad);
?>