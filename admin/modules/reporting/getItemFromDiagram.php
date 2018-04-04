<?php
// key to authentication
define('INDEX_AUTH', '1');
if (!defined('SB')) {
    // main system configuration
    require '../../../sysconfig.inc.php';
    // start the session
    require SB.'admin/default/session.inc.php';
}

// IP based access limitation
require LIB.'ip_based_access.inc.php';
do_checkIP('smc');
do_checkIP('smc-reporting');

$type =(isset($_GET['type']))?mysql_real_escape_string($_GET['type']):'';
$dtTable = $dbs->query("SELECT `title`,`series_title`,`publish_year`,`edition` FROM `biblio` WHERE gmd_id =(SELECT gmd_id FROM `mst_gmd` WHERE gmd_name like '$type')");
$return_arr = array();
while ($data = $dtTable->fetch_row()) {
    $row['title'] = $data[0];
    $row['series_title'] = $data[1];    
    $row['publish_year'] = $data[2];
    array_push($return_arr, $row);
}
header('Content-Type: application/json');
echo json_encode(array('data' => $return_arr));
?>