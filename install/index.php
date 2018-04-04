<?php
/**
 * Setiadi Installer
 *
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
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Setiadi 2 :: Installer</title>
		<script type="text/javascript" src="../js/jquery.js"></script>
		<link rel="stylesheet" type="text/css" href="../template/bootstrap/css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="asset/css/main.css">
	</head>
	<body>
			<div class="greeter">
				<div class="header">
					<img src="../images/logo.png">
					<h3>Welcome to Setiadi 2 Lukulo</h3>
				</div>
				<div class="banner">
				</div>
				<div class="footer">
					<a class="btn btn-link" href="#" style="margin: 17px;">Info</a>
					<a class="btn btn-link" href="#">About</a>
					<button style="margin: 20px; float: right;" class="next1 btn btn-primary">Next</button>
				</div>
				<div>
					<script type="text/javascript">
						$('.next1').click(function(){
							// $('.greeter').addClass('animated fadeOut');
							$('.greeter').load('checkDep.php', {limit: 25}, 
								function (responseText, textStatus, XMLHttpRequest) {
        							// XMLHttpRequest.responseText has the error info you want.
        							if (XMLHttpRequest.status != 200) {
        								$(this).html('<div class="erorMsg"><strong>AJAX Reload Error! Make sure your installer isn\'t corrupted. checkDep.php file isn\'t exist or missing.</strong></div>');
        								return false;
        							}
        						}
							);
						});
					</script>
				</div>
			</div>
	</body>
</html>