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
/* Checking Dependences Template */
include 'checkDependens.inc.php';
// Visibility
// $isVisible = ($error > 1)?'disabled':NULL;
switch ($error) {
	case 'value':
		# code...
		break;
	
	default:
		# code...
		break;
}
// Function to set status
function setStatus($serviceName)
{
	$class 	= ($serviceName == 1)?'text-info fa fa-check-circle':'text-red fa fa-exclamation-circle';
	$title 	= ($serviceName == 1)?'Ketergantungan sudah terpasang.':'Kertergantungan belum terpasang mohon tekan pranala \'Info\' pada pojok kiri bagian bawah untuk detil lebih lanjut.';
	$result = array($class, $title);
	return $result;
}
?>
<div class="animated fadeIn">
	<div class="check-dep-header">
		<h3>Step 1 - Dependency Checking</h3>
	</div>
	<div class="contain">
		<span style="    display: block;font-weight: bold;padding-left: 18px;">Checking the minimum dependency for installing Setiadi</span>
		<br>
		<table width="100%">
			<tr>
				<td class="dep-label">PHP Version</td>
				<td class="small">:</td>
				<td class="value"><b><?php echo $PHPversion;?></b></td>
				<td class="small2"><b style="font-size: 16pt;" class="<?php $php = setStatus($dependence['PHP']); echo $php[0];?>" title="<?php echo $php[1];?>"></b></td>
			</tr>
			<tr>
				<td class="dep-label">Database Engine</td>
				<td class="small">:</td>
				<td class="value"><b><?php echo $MySQLiLabel;?></b></td>
				<td class="small2"><b style="font-size: 16pt;" class="<?php $mysql = setStatus($dependence['MySQLi']); echo $mysql[0]?>" title="<?php echo $mysql[1];?>"></b></td>
			</tr>
			<tr>
				<td class="dep-label">GD</td>
				<td class="small">:</td>
				<td class="value"><b><?php echo $GDLabel;?></b></td>
				<td class="small2"><b style="font-size: 16pt;" class="<?php $gd = setStatus($dependence['GD']);echo $gd[0];?>" title="<?php echo $gd[1];?>"></b></td>
			</tr>
			<tr>
				<td class="dep-label">YAZ</td>
				<td class="small">:</td>
				<td class="value"><b><?php echo $YAZLabel;?></b></td>
				<td class="small2"><b style="font-size: 16pt;" class="<?php $yaz = setStatus($dependence['YAZ']); echo $yaz[0]?>" title="<?php echo $yaz[1];?>"></b></td>
			</tr>
			<tr>
				<td class="dep-label">Gettext</td>
				<td class="small">:</td>
				<td class="value"><b><?php echo $GettextLabel;?></b></td>
				<td class="small2"><b style="font-size: 16pt;" class="<?php $gettext = setStatus($dependence['Gettext']);echo $gettext[0];?>" title="<?php echo $gettext[1];?>"></b></td>
			</tr>
		</table>
	</div>
	<div class="footer">
		<a class="btn btn-link" href="#" style="margin: 17px;" title="Informasi Ketergantungan" data="dependency-info" data-toggle="modal" data-target="#myModal">Info</a>
		<!-- <a class="btn btn-link" href="#">About</a> -->
		<button style="margin: 20px; float: right;" class="next2 btn btn-primary" <?php echo $isVisible;?> >Next</button>
	</div>
	<div>
		<script type="text/javascript" src="doDi.js"></script>
		<script type="text/javascript">
			$('.next2').click(function(){
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