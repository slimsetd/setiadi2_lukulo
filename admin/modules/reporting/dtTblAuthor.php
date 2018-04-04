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

$dtTable = $dbs->query("SELECT `author_id`,`author_name`,`author_year`,`authority_type` FROM `mst_author`");
$return_arr = array();
while ($data = $dtTable->fetch_row()) {
	$row['Dt_RowId'] = $data[0];
    $row['author_name'] = $data[1];
    $row['author_year'] = $data[2];    
    $row['authority_type'] = $data[3];
    array_push($return_arr, $row);
}
header('Content-Type: application/json');
echo json_encode(array('data' => $return_arr));
?>