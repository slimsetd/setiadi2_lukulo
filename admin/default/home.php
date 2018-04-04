<?php
/**
 *
 * Copyright (C) 2007,2008  Arie Nugraha (dicarve@yahoo.com)
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
 * some patches by hendro
 */

// key to authenticate
if (!defined('INDEX_AUTH')) {
    define('INDEX_AUTH', '1');
}

if (basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
    include_once '../../sysconfig.inc.php';
}
if (!isset($_COOKIE['admin_logged_in'])) {
  header('Location: ../../?p=login');
}

// Add dependence
require LIB.'setiadi_utility.inc.php';
?>
<fieldset class="menuBox adminHome">
<div class="menuBoxInner">
	<div class="per_title">
    	<h2><?php echo __('Library Administration'); ?></h2>
	</div>
</div>
</fieldset>
<?php

// generate warning messages
$warnings = array();
// check GD extension
if (!extension_loaded('gd')) {
    $warnings[] = __('<strong>PHP GD</strong> extension is not installed. Please install it or application won\'t be able to create image thumbnail and barcode.');
} else {
    // check GD Freetype
    if (!function_exists('imagettftext')) {
        $warnings[] = __('<strong>Freetype</strong> support is not enabled in PHP GD extension. Rebuild PHP GD extension with Freetype support or application won\'t be able to create barcode.');
    }
}
// check for overdue
$overdue_q = $dbs->query('SELECT COUNT(loan_id) FROM loan AS l WHERE (l.is_lent=1 AND l.is_return=0 AND TO_DAYS(due_date) < TO_DAYS(\''.date('Y-m-d').'\')) GROUP BY member_id');
$num_overdue = $overdue_q->num_rows;
if ($num_overdue > 0) {
    $warnings[] = str_replace('{num_overdue}', $num_overdue, __('There is currently <strong>{num_overdue}</strong> library members having overdue. Please check at <b>Circulation</b> module at <b>Overdues</b> section for more detail')); //mfc
    $overdue_q->free_result();
}
// check if images dir is writable or not
if (!is_writable(IMGBS) OR !is_writable(IMGBS.'barcodes') OR !is_writable(IMGBS.'persons') OR !is_writable(IMGBS.'docs')) {
    $warnings[] = __('<strong>Images</strong> directory and directories under it is not writable. Make sure it is writable by changing its permission or you won\'t be able to upload any images and create barcodes');
}
// check if file repository dir is writable or not
if (!is_writable(REPOBS)) {
    $warnings[] = __('<strong>Repository</strong> directory is not writable. Make sure it is writable (and all directories under it) by changing its permission or you won\'t be able to upload any bibliographic attachments.');
}
// check if file upload dir is writable or not
if (!is_writable(UPLOAD)) {
    $warnings[] = __('<strong>File upload</strong> directory is not writable. Make sure it is writable (and all directories under it) by changing its permission or you won\'t be able to upload any file, create report files and create database backups.');
}
// check mysqldump
if (!file_exists($sysconf['mysqldump'])) {
    $warnings[] = __('The PATH for <strong>mysqldump</strong> program is not right! Please check configuration file or you won\'t be able to do any database backups.');
}
// check installer directory
if (is_dir('../install/')) {
    $warnings[] = __('Installer folder is still exist inside your server. Please remove it or rename to another name for security reason. <button id="rmdir" class="btn btn-primary">Remove Installer</button>');
}

if ($_SESSION['uid'] === '1') {
  $warnings[] = __('<strong><i>You are logged in as Super User. With great power comes great responsibility.</i></strong>');
  // check need to be repaired mysql database
  $query_of_tables = $dbs->query('SHOW TABLES');
  $num_of_tables = $query_of_tables->num_rows;
  $prevtable = '';
  $is_repaired = false;

  if (isset ($_POST['do_repair'])) {
    if ($_POST['do_repair'] == 1) {
      while ($row = $query_of_tables->fetch_row()) {
        $sql_of_repair = 'REPAIR TABLE '.$row[0];
        $query_of_repair = $dbs->query ($sql_of_repair);
      }
    }
  }
  
  if (isset($_POST['removeDir']) AND ($_POST['removeDir'] == true)) {
    $renameIt = rename('../install', '../.'.setiadi_utility::generateRandomString(32));
    if ($renameIt) {
      echo '1';
    } else {
      echo "Failed to remove the installer folder! make sure your installer folder its owned by apache daemon user.";
    }
    exit();
  }	

  while ($row = $query_of_tables->fetch_row()) {
    $query_of_check = $dbs->query('CHECK TABLE '.$row[0]);
    while ($rowcheck = $query_of_check->fetch_assoc()) {
      if (!(($rowcheck['Msg_type'] == "status") && ($rowcheck['Msg_text'] == "OK"))) {
        if ($row[0] != $prevtable) {
          echo '<li class="warning">Table '.$row[0].' might need to be repaired.</li>';
        }
        $prevtable = $row[0];
        $is_repaired = true;
      }
    }
  }
  if (($is_repaired) && !isset($_POST['do_repair'])) {
    echo '<li class="warning"><form method="POST"><input type="hidden" name="do_repair" value="1"><input value="Repair Tables" type="submit"></form></li>';
  }
}


// if there are any warnings
if ($warnings) {
    echo '<div class="message">';
    echo '<ul>';
    foreach ($warnings as $warning_msg) {
        echo '<li class="warning"><i class="glyphicon glyphicon-warning-sign"></i> '.$warning_msg.'</li>';
    }
    echo '</ul>';
    echo '</div>';
}

function getDataAuthor($level, $isDistinct = true)
{
  global $dbs;
  // Level 
  switch ($level) {
    case 2: // dosen
      $level = "IN (2, 3)";
      break;
    
    case 3: // penguji
      $level = "IN (4, 5)";
      break;

    default: // penulis
      $level = "= 1";
      break;
  }
  // Query
  $distinct = ($isDistinct)?'DISTINCT':'';
  $level    = $dbs->escape_string($level);
  $author_q = $dbs->query("SELECT ".$distinct." author_id, level FROM biblio_author WHERE level ".$level."");
  // Set printout
  return $author_q->num_rows;
}

function getGMD($dbs)
{
  // query
  $gmd_q = $dbs->query('SELECT gmd_id FROM mst_gmd');
  // output
  return $gmd_q->num_rows;
}

function getBookData($dbs)
{
  // query
  $biblio_q = $dbs->query('SELECT biblio_id FROM biblio');
  // output
  return $biblio_q->num_rows;
}
?>

<style type="text/css">
  #dashboardTable td {
    text-align: center;
    height: 200px;
    padding: 5px;
    font-size: 12pt;
  }

  .first {
    background: #2d89ef;
    color: white;
    height: 100%;
    border-radius: 5px;
  }

  .general {
    background: lightblue;
    height: 100%; 
    color: white;
    border-radius: 5px;
  }

  .icon {
    padding-top: 35px;
    padding-bottom: 10px;
    font-size: 80px;
  }

  .visual:hover {
    background: black;
    cursor: pointer;
  }
</style>
<table id="dashboardTable" width="100%" border="0">
  <tr>
    <td colspan="2" style="width: 170px;"><div class="box-dasboard first"><b class="icon fa fa-info-circle"></b><br><b>Hi, Selamat datang di laman admin</b></div></td>
    <td><div class="box-dasboard first general" style="background: #ff0097;"><b class="icon fa fa-user"></b><br><b>Dosen</b><br><b><?php echo getDataAuthor(2, true);?> Orang</b></div></td>
    <td><div class="box-dasboard general" style="background: #9f00a7"><b class="icon fa fa-users"></b><br><b>Penguji</b><br><b><?php echo getDataAuthor(3, true);?> Orang</b></td>
  </tr>
  <tr>
    <td><div class="box-dasboard general" style="background: #00aba9;"><b class="icon fa fa-user-circle"></b><br><b>Penulis</b><br><b><?php echo getDataAuthor(1, true);?> Orang</b></div></td>
    <td><div class="box-dasboard general" style="background: #99b433;"><b class="icon fa fa-bookmark"></b><br><b>Jumlah ETD</b><br><b><?php echo getBookData($dbs);?> Judul</b<</div></td>
    <td><div class="box-dasboard general" style="background: #ee1111;"><b class="icon fa fa-book"></b><br><b>GMD</b><br><b><?php echo getGMD($dbs);?> Nama</b></div></td>
    <td><div class="box-dasboard general visual" style="background: #2b5797;"><b class="icon fa fa-chart-pie"></b><br><b>Visual Diagram</b></div></td>
  </tr>
</table>
<script type="text/javascript">
  // Post process
  $('#rmdir').click(function(){
      $.post("<?php echo $_SERVER['PHP_SELF'];?>", {removeDir: true}, function(result){
        if (result != 1) {
          alert('Installer has been removed!');
          window.location.href = "<?php echo AWB;?>";
        } 
      });
  });
</script>

