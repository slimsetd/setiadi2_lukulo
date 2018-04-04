<?php
/**
 * Copyright (C) 2017  Navis (navkandar@gmail.com)
 * Inspired, taken ,and modified from SLiMS 8 Akasia pop_pattern.php
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
// key to get full database access
define('DB_ACCESS', 'fa');

if (!defined('SB')) {
  // main system configuration
  require '../../../sysconfig.inc.php';
  // start the session
  require SB.'admin/default/session.inc.php';
}
// IP based access limitation
require LIB.'ip_based_access.inc.php';
do_checkIP('smc');
do_checkIP('smc-bibliography');

require SB.'admin/default/session_check.inc.php';
require SIMBIO.'simbio_FILE/simbio_directory.inc.php';
require SIMBIO.'simbio_GUI/form_maker/simbio_form_table_AJAX.inc.php';
require SIMBIO.'simbio_GUI/table/simbio_table.inc.php';
require SIMBIO.'simbio_DB/simbio_dbop.inc.php';
require MDLBS.'bibliography/long_biblio.inc.php';

// privileges checking
$can_write = utility::havePrivilege('bibliography', 'w');
if (!$can_write) {
  die('<div class="errorBox">'.__('You are not authorized to view this section').'</div>');
}

$page_title  = "Pembuat Pola";
$success_msg = "Pola berhasil disimpan.";
$error_msg   = "Pola tidak berhasil disimpan!.";
if (isset($_GET['op']) AND $_GET['op'] == 'insert') {
  // Grab data
  $_prefix = trim($dbs->escape_string(strip_tags($_GET['prefix'])));
  $_zero   = trim($dbs->escape_string(strip_tags($_GET['zero'])));
  $_suffix = trim($dbs->escape_string(strip_tags($_GET['suffix'])));
  // Check if its available or not
  $check = $dbs->query('SELECT pattern_prefix FROM long_pattern WHERE pattern_prefix="'.$_prefix.'"');
  // Check
  if ($check->num_rows > 0) {
    echo "Pola sudah ada!";
    exit();
  }
  // Convert
  $count_zero = strlen($_zero);
  // Set query
  $insert = $dbs->query("INSERT INTO long_pattern (pattern_prefix, pattern_zero, pattern_suffix, input_date) VALUES('".$_prefix."', '".$count_zero."', '".$_suffix."', '".date('Y-m-d')."')");
  // Check
  if ($insert) {
    echo 'scs';
  }
  exit();
}
// set Object
$tableSerial = @new longBiblioAtt();
// Make Table
echo $tableSerial->serialCodeMgr();
?>
<script type="text/javascript" src="<?php echo JWB; ?>jquery.js"></script>
<script type="text/javascript">
$(document).ready(function() {
  $('#scm').keyup(function() {
    $("#preview").text("");
    var prefix = $("#prefix").val();
    var zero = $("#zero").val();
    var suffix = $("#suffix").val();
    $("#preview").text( prefix + zero + suffix);
  });
  $('#simpan').click(function(){
      var server = "<?php echo $_SERVER['PHP_SELF']; ?>";
      var prefix = $("#prefix").val();
      var zero = $("#zero").val();
      var suffix = $("#suffix").val();
      var pattern = prefix+zero+suffix;
      var data = "&prefix="+prefix+"&zero="+zero+"&suffix="+suffix;
      $.ajax({
        url: server,
        data: "op=insert"+data,
        cache: false,
        success: function(msg){
          if (msg == 'scs') {
            //var last_id = "<?php longBiblioAtt::getLastID();?>";
            alert('<?php echo $success_msg;?>');
            parent.$.colorbox.close();
            <?php
              if (isset($_GET['in']) AND $_GET['in'] == 'master'){
                echo 'parent.$(\'#mainContent\').simbioAJAX(\''.MWB.'master_file/item_code_pattern.php\');';
              } else {
                echo "parent.$('#itemCodePattern').append('<option value=\"'+ prefix +'\">'+ pattern +'</option>');";
              }
            ?>
            //parent.$('#itemCodePattern').append('<option value="'+ last_id +'">'+ pattern +'</option>');
            return false;
          } else {
             alert('<?php echo $error_msg;?>');
          }
        }
      });
  });
});
</script>
<?php
$content = ob_get_clean();
//echo $content;
// include the page template
require SB.'/admin/'.$sysconf['admin_template']['dir'].'/notemplate_page_tpl.php';