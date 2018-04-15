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
/* Error Msg Template */
if (isset($_GET['msg'])) {
	switch ($_GET['msg']) {
		case 0:
			$msg = "Error Connecting to Database, Please check your configuration!";
			break;
		
		case 2:
			$msg = "Folder db_config isn't writeable! please make sure it writeable or not.";
			break;
		case 5:
			$msg = "The installation is successful but admin data isn't updated!";
	}
}
?>
<div class="check-dep-header">
	<h3>Step 3 - Installing Setiadi</h3>
</div>
<div class="contain">
	<div class="erorMsg">
		<strong><?php echo $msg;?></strong>
	</div>
	<div class="btnArea">
		<a class="btn btn-link" href="#" style="margin: 17px;" title="Informasi Galat" data="error-msg" data-toggle="modal" data-target="#myModal">Info</a>
		<button style="margin: 20px; float: right;" class="back btn btn-primary">Back to form</button>
	</div>
	<div>
		<script type="text/javascript" src="doDi.js"></script>
		<script type="text/javascript">
		// Back to db configuration form
			$('.back').click(function(){
				$('.greeter').load('configDB.php', {limit: 25}, 
				function (responseText, textStatus, XMLHttpRequest) {
					// XMLHttpRequest.responseText has the error info you want.
					if (XMLHttpRequest.status != 200) {
						$(this).html('<div class="erorMsg"><strong>AJAX Reload Error! Make sure your installer isn\'t corrupted. configDB.php file isn\'t exist or missing.</strong></div>');
						return false;
					}
				}
			);
			});
		</script>
	</div>
</div>