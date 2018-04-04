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
/* Form Template */
include 'checkDependens.inc.php';
if ($error > 1) {
	die('<div class="erorMsg"><strong>Your dependences is not complete!</strong></div>');
}
if (isset($_POST['host'])) {
	require 'doInstall.inc.php';
	$host = trim($_POST['host']);
	$dbname = trim($_POST['dbname']);
	$dbuname = trim($_POST['dbuname']);
	$dbupass = trim($_POST['dbpass']);
	$dbport = 3306;
	$dbs = new mysqli($host, $dbuname, $dbupass,  $dbname, $dbport);
	// Check Error
	if (mysqli_connect_error()) {
        echo "0";
        exit();
    }
    $install = doInstall($dbs, $_POST);
    if ($install) {
    	echo "1";
    } else if ($install = 2) {
		echo "2";
	} else {
		echo "5";
	}
    exit();
}
?>
<div class="animated fadeIn">
	<div class="check-dep-header">
		<h3>Step 2 - Configuring Database</h3>
	</div>
	<div class="contain">
			<table width="100%" class="form-install">
				<tr>
					<td colspan="3"><strong class="text-info">Database Connection Information</strong></td>
				</tr>
				<tr>
					<td class="dep-label">Database Hostname</td>
					<td class="small">:</td>
					<td class="value"><input type="text" id="dbhost" autofocus/> <i><b>default: localhost</b></i></td>
				</tr>
				<tr>
					<td class="dep-label">Database Name</td>
					<td class="small">:</td>
					<td class="value"><input type="text" id="dbname"/></td>
				</tr>
				<tr>
					<td class="dep-label">Database Username</td>
					<td class="small">:</td>
					<td class="value"><input type="text" id="dbuname"/></td>
				</tr>
				<tr>
					<td class="dep-label">Database Password</td>
					<td class="small">:</td>
					<td class="value"><input type="password" id="dbupass"/></td>
				</tr>
				<tr>
					<td colspan="3"><strong class="text-info">Web Administrator form data (Optional)</strong></td>
				</tr>
				<tr>
					<td class="dep-label">Admin Username</td>
					<td class="small">:</td>
					<td class="value"><input type="text" id="Aduname"/> <i><b>default: admin</b></i></td>
				</tr>
				<tr>
					<td class="dep-label">Password</td>
					<td class="small">:</td>
					<td class="value"><input type="password" id="Adupass"/> <i><b>default: admin</b></i></td>
				</tr>
				<tr>
					<td class="dep-label">ReType Password</td>
					<td class="small">:</td>
					<td class="value"><input type="password" id="Adrupass"/> <i><b>default: admin</b></i></td>
				</tr>
				<tr>
					<td colspan="3"><button style="float : right; margin-right: 10px;" class="btn btn-success" id="install">Install</button></td>
				</tr>
			</table>
	</div>
	<div>
		<script type="text/javascript">
			$('#install').click(function(){
				// Database information
				var Host = $('#dbhost').val();
				var DBName = $('#dbname').val();
				var DBUname = $('#dbuname').val();
				var DBUpass = $('#dbupass').val();
				// User information
				var userName = $('#Aduname').val();
				var userPass1 = $('#Adupass').val();
				var userPass2 = $('#Adrupass').val();
				// Checking
				if (userPass1 != '' && userName != '') {
					if (userPass1 != userPass2) {
						alert('Admin Password is not match!');
						return false;
					} else {
						var userPass = userPass1;
					}
				}
				// DB Check
				if (DBName == '' && DBUname == '') {
					alert('Database name can\'t be empty!');
					return false;
				}
				// Post Data
				 $.post("configDB.php", 
				 {
				 	host: Host, 
				 	dbname: DBName, 
				 	dbuname: DBUname, 
				 	dbpass: DBUpass,
				 	uname: userName,
				 	upass: userPass
				 }, function(result){
				 	if (result == 1) {
			        	$('.greeter').load('successMsg.php');
			        } else {
			        	$('.greeter').load('errorMsg.php?msg='+result);
			        }
			    });
			});
		</script>
	</div>
</div>