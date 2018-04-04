<?php
/**
 * Copyright (C) 2009  Arie Nugraha (dicarve@yahoo.com)
 * Some Modification By Navis (navkandar@gmail.com)
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

// main system configuration
require '../../../sysconfig.inc.php';
// IP based access limitation
require LIB.'ip_based_access.inc.php';
do_checkIP('smc');
do_checkIP('smc-masterfile');
// start the session
require SB.'admin/default/session.inc.php';
require SB.'admin/default/session_check.inc.php';
require SIMBIO.'simbio_GUI/table/simbio_table.inc.php';
require SIMBIO.'simbio_GUI/form_maker/simbio_form_table_AJAX.inc.php';
require SIMBIO.'simbio_GUI/paging/simbio_paging.inc.php';
require SIMBIO.'simbio_DB/datagrid/simbio_dbgrid.inc.php';
require SIMBIO.'simbio_DB/simbio_dbop.inc.php';

// privileges checking
$can_read = utility::havePrivilege('master_file', 'r');
$can_write = utility::havePrivilege('master_file', 'w');

if (!$can_read) {
    die('<div class="errorBox">'.__('You don\'t have enough privileges to access this area!').'</div>');
}

/* RECORD OPERATION */
$succces_msg = 'Pattern Deleted!';
$failed_msg = 'Pattern Delete Failed!';
if (isset($_GET['op']) AND $_GET['op'] == 'delete' AND isset($_GET['itemID'])) {
    if (!($can_read AND $can_write)) {
        die();
    }
    /* DATA DELETION PROCESS */
    $suffix = $dbs->escape_string($_GET['itemID']);
    // update
    $delete= $dbs->query('DELETE FROM long_pattern WHERE pattern_prefix="'.$suffix.'"');
    if ($delete) {
      echo 'scs';
    } else {
      echo 'error :'.$dbs->error;
    }
    exit();
}
/* item status update process end */

/* search form */
?>
<fieldset class="menuBox">
<div class="menuBoxInner masterFileIcon">
    <div class="per_title">
        <h2><?php echo __('Item Code Pattern'); ?></h2>
  </div>
    <div class="sub_section">
      <div class="btn-group">
      <a href="<?php echo MWB; ?>master_file/item_code_pattern.php" class="list btn btn-default"><i class="glyphicon glyphicon-list-alt"></i>&nbsp;<?php echo __('Pattern List'); ?></a>
          <a href="<?php echo MWB; ?>bibliography/pop_pattern.php?in=master" class="notAJAX btn btn-default openPopUp notIframe"><i class="glyphicon glyphicon-plus"></i>&nbsp;<?php echo __('Add New Pattern'); ?></a>
      </div>
    </div>
</div>
</fieldset>
<script type="text/javascript">
   function deletePattern(itemID) 
   {
     var server = "<?php echo $_SERVER['PHP_SELF']; ?>";
     $.ajax({
        url: server,
        data: "op=delete&itemID="+itemID,
        cache: false,
        success: function(msg){
            if (msg == 'scs') {
                alert('<?php echo $succces_msg;?>');
                $('a.list').trigger('click');
            } else {
                alert(msg);
            }
        }
     });
   }
</script>
<div class="fluid-container">
<?php
/* search form end */
/* main content */
if (isset($_POST['detail']) OR (isset($_GET['action']) AND $_GET['action'] == 'detail')) {
    if (!($can_read AND $can_write)) {
        die('<div class="errorBox">'.__('You don\'t have enough privileges to access this area!').'</div>');
    }
    // form add / edit
    echo 'tambah edit';
} else {
    // pattern list
    // load setting
    echo '<table class="table table-striped" width="100%">';
    $pattern_q = $dbs->query('SELECT pattern_prefix, pattern_zero, pattern_suffix FROM long_pattern');
    if ($pattern_q->num_rows > 0) {
        //;
        $n = 1;
        echo '<tr>';
        echo '<th>#</th>';
        echo '<th>Pattern</th>';
        echo '<th>Action</th>';
        echo '</tr>';
        while ($pattern_d = $pattern_q->fetch_object()) {
            echo '<tr>';
            echo '<td width="40px">'.$n.'</td>';
            echo '<td>'.$pattern_d->pattern_prefix.sprintf('%0'.$pattern_d->pattern_zero.'d', 0).$pattern_d->pattern_suffix.'</td>';
            echo '<td><a class="btn notAJAX btn-danger delete-pattern" onclick="deletePattern(\''.$pattern_d->pattern_prefix.'\')">Delete</a></td>';
            echo '</tr>';
            $n++;
        }
    } else {
        // no data
        echo 'No Patternt available. <a class="notAJAX btn btn-primary openPopUp notIframe" href="'.MWB.'bibliography/pop_pattern.php?in=master" height="420px" title="'.__('Add new pattern').'">
            <i class="glyphicon glyphicon-plus"></i> Add New Pattern</a>';
    }
    echo '</table>';
}
/* main content end */
?>
</div>