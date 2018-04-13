<?php
/**
 * Setiadi 2, recaptcha POP
 * Copyright (C) 2018 Drajat Hasan (drajathasan20@gmail.com)
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

// key to authenticate
define('INDEX_AUTH', '1');

// main system configuration
require '../../../sysconfig.inc.php';
// IP based access limitation
require LIB.'ip_based_access.inc.php';
do_checkIP('smc');
do_checkIP('smc-bibliography');
// start the session
require SB.'admin/default/session.inc.php';
require SB.'admin/default/session_check.inc.php';
require SIMBIO.'simbio_GUI/form_maker/setiadi_form_maker.php';
require LIB.'setiadi_utility.inc.php';
require LIB.'parsedown/Parsedown.php';

// Save Proses
if (isset($_POST['save'])) {
	$error = 0;
	$msg = array();
	if (empty($_POST['publickey']) AND empty($_POST['privatekey'])) {
		utility::jsAlert('Semua kunci harus terisi!');
		exit();
	}
	// SMC 
	$saveSMC = setiadi_utility::saveKey('smc', trim($_POST['publickey']), trim($_POST['privatekey']));
	// Member 
	$saveMem = setiadi_utility::saveKey('member', trim($_POST['publickey']), trim($_POST['privatekey']));
	// Set result
	if (!$saveSMC) {
		$error++;
		$msg[] = 'SMC Key failed to save!';
	}
	if (!$saveMem) {
		$error++;
		$msg[] = 'Member Key failed to save!'."\n";
	}

	// Set Message
	if ($error > 0) {
		$errMsg = '';
		foreach ($msg as $value) {
			$errMsg .= $value;
		}
		utility::jsAlert($errMsg);
	} else {
		utility::jsAlert('Repcaptcha key has been saved.');
	}
	exit();
}

// Manual Page
$manPage = (isset($_GET['type']) AND $_GET['type'] == 'manual_page')?true:false;

if (!$manPage) {
// Get css
echo '<link rel="stylesheet" type="text/css" href="'.AWB.'admin_template/setboot/style.css"/>';
echo '<link rel="stylesheet" type="text/css" href="'.AWB.'admin_template/setboot/bootstrap/css/bootstrap.min.css"/>';
// Get Key
require LIB.'recaptcha/smc_settings.inc.php';
// Create object
$form = new setiadi_form($_SERVER['PHP_SELF'], 'POST', false, false, false);
// Create Text
$form->createText('publickey', $sysconf['captcha']['smc']['publickey'], 'publickey', 'autofocus');
$form->createText('privatekey', $sysconf['captcha']['smc']['privatekey'], 'privatekey', false);
$form->createAnything('<button name="save" class="btn btn-success" style="margin-top: 20px; float: right;">Simpan</button>');
// Printout
echo $form->printOut();
} else {
	echo '<link rel="stylesheet" type="text/css" href="'.SWB.'template/bootstrap/css/bootstrap.min.css">';
	echo '<style>p{text-align: justify;} .doc {display: block; width: 100%; padding-left: 20px; padding-right: 20px;}</style>';
	echo '<div class="doc">';
	$html = file_get_contents(DOC.'general/recaptcha_doc/recaptcha.md');
	$Parsedown = new Parsedown();
	echo $Parsedown->text($html);
	echo '</div>';
}
?>