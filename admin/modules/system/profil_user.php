<?php
/**
 * Copyright (C) 20017  Drajat Hasan (drajathasan20@gmail.com)
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

/* User Profile Viewer */

// key to authenticate
define('INDEX_AUTH', '1');

// main system configuration
require '../../../sysconfig.inc.php';
// IP based access limitation
require LIB.'ip_based_access.inc.php';
do_checkIP('smc');
do_checkIP('smc-system');

// start the session
require SB.'admin/default/session.inc.php';
require SB.'admin/default/session_check.inc.php';
require SIMBIO.'simbio_DB/simbio_dbop.inc.php';

// privileges checking
$can_read = utility::havePrivilege('system', 'r');
$can_write = utility::havePrivilege('system', 'w');

// Get E-mail data
$g_mail_data_q = "SELECT email, input_date, last_login, social_media FROM user WHERE user_id='".$_SESSION['uid']."'";
$g_mail_data_d = $dbs->query($g_mail_data_q);

if ($g_email = $g_mail_data_d->fetch_assoc()) {
    if (empty($g_email['email'])) {
        $email = "E-mail tidak disertakan.";
        $input_date = $g_email['input_date'];
        $last_login = $g_email['last_login'];
        $sosmed    = $g_email['social_media'];
    } else {
        $email = $g_email['email'];
        $input_date = $g_email['input_date'];
        $last_login = $g_email['last_login'];
        $sosmed    = $g_email['social_media'];
    }
}

// Image Change Function.
function get_nav_image() 
{
  if (!file_exists("../../../images/persons/".$_SESSION['upict'])) {
    $html_str = '<img class="bening-profil-img" src="../lib/minigalnano/createthumb.php?filename=../../'.IMG.'/persons/person.png&width=90">';
  } else {
    $html_str = '<img class="bening-profil-img" src="../lib/minigalnano/createthumb.php?filename=../../'.IMG.'/persons/'.urlencode(urlencode($_SESSION['upict'])).'&width=90">';
  }
  return $html_str;
}
?>
<script type="text/javascript">
$(document).ready(function () {
    // Random Background Color function took from http://jsfiddle.net/5XUST/2/
    // And some modification by Drajat Hasan
    var colors = ["#ff4625", "#ab6fc9", "#45a9e7", "#ff9b00"];
    
    var blocks = $(".random-color,.bening-btn-action");
    for(var x = 0; x < blocks.length; x++){
        var random = Math.floor(Math.random() * colors.length);
        var selectedColor = colors[random];
        $(blocks[x]).css("background", selectedColor);
        colors.splice(random, 1);
    }
});
</script>
<fieldset class="menuBox">
<div class="menuBoxInner">
  <div class="per_title">
	    <h2><?php echo __('Profil Pengguna'); ?></h2>
  </div>
  <div style="background: grey;">
    <div class="bening-profil">
      <div class="random-color">
          <?php echo get_nav_image();?>
          <strong class="bening-profil-name"><?php echo $_SESSION['uname'];?></strong>
          <strong class="bening-profil-email"><?php echo $email;?></strong>
      </div>
      <div class="register-info">
          <strong>Informasi :</strong>
          <br>
          <small>Terdaftar sejak  : <?php echo $input_date;?></small>
          <br>
          <small>Terakhir Masuk : <?php echo substr($last_login, 0,10)." Pukul ".substr($last_login, 11,20)." WIB";?></small>
          <br>
      </div>
    </div>
    <div class="bening-profil-detail">
      <div class="detail-info">
          <h4>Nama Lengkap</h4>
          <strong><?php echo $_SESSION['realname'];?></strong>
          <h4>Nama Pengguna</h4>
          <strong><?php echo $_SESSION['uname'];?></strong>
          <h4>Alamat Surel</h4>
          <strong><?php echo $email?></strong>
          <h4>Sosial Media</h4>
          <table style="margin-left: 20px; margin-bottom: 20px;">
          <?php 
           // Get Social Media Data
              $sosmed_array = array('fb' => 'Facebook', 'tw' => 'Twitter', 'li' => 'LinkedIn', 'rd' => 'Reddit',
                                    'pn' => 'Pinterest', 'gp' => 'Google Plus+', 'yt' => 'YouTube', 'bl' => 'Blog');
              if ($sosmed) {
                $get_sosmed_data = unserialize($sosmed);
                foreach ($get_sosmed_data as $sosmed_name => $value) {
                    $html_str  = '<tr>';
                    $html_str .= "<td>".$sosmed_array[$sosmed_name]."</td><td>&nbsp;:&nbsp;</td><td>".$value."</td>";
                    $html_str .= '</tr>';
                    echo $html_str;
                }
              } else {
                foreach ($sosmed_array as $value) {
                    $html_str  = '<tr>';
                    $html_str .= "<td>".$value."</td><td>&nbsp;:&nbsp;</td><td>-</td>";
                    $html_str .= '</tr>';
                    echo $html_str;
                }
              }
          ?>
          </table>
          <a class="bening-btn-action bening-info" href="<?php echo MWB.'system/app_user.php?changecurrent=true&action=detail'; ?>">Edit Data</a>
      </div>
    </div>
  </div>
</div>
</fieldset>
