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
 */

/* Reserve List */

// key to authenticate
define('INDEX_AUTH', '1');

// main system configuration
require '../../../sysconfig.inc.php';
// IP based access limitation
require LIB.'ip_based_access.inc.php';
do_checkIP('smc');
do_checkIP('smc-circulation');
// start the session
require SB.'admin/default/session.inc.php';
require SB.'admin/default/session_check.inc.php';
// privileges checking
$can_read = utility::havePrivilege('reporting', 'r');
$can_write = utility::havePrivilege('reporting', 'w');

if (!$can_read) {
    die('<div class="errorBox">'.__('You don\'t have enough privileges to access this area!').'</div>');
}

require SIMBIO.'simbio_GUI/template_parser/simbio_template_parser.inc.php';
require SIMBIO.'simbio_GUI/table/simbio_table.inc.php';
require SIMBIO.'simbio_GUI/paging/simbio_paging.inc.php';
require SIMBIO.'simbio_GUI/form_maker/simbio_form_element.inc.php';
require SIMBIO.'simbio_DB/datagrid/simbio_dbgrid.inc.php';
require MDLBS.'reporting/report_dbgrid.inc.php';


$page_title = 'Author Collaborate';
$reportView = false;
if (isset($_GET['reportView'])) {
    $reportView = true;
}

if (!$reportView) {
?>

    <link rel="stylesheet" href="<?php echo JWB; ?>treantjs/Treant.css" />
    <link rel="stylesheet" href="<?php echo JWB; ?>treantjs/basic.css" />
    <script type="text/javascript" src="<?php echo JWB; ?>treantjs/raphael.js"></script>
    <script type="text/javascript" src="<?php echo JWB; ?>treantjs/Treant.js"></script>    
    <div class="chart" id="AuthorTree"></div>
<?php
    /*added by doe*/

//get list of book which he/she writes 


$authId =(isset($_GET['auth_id']))?$dbs->real_escape_string($_GET['auth_id']):'';

$authorBook = $dbs->query("SELECT b.biblio_id,b.title,b.image,ba.level from biblio b
inner join biblio_author ba on b.biblio_id= ba.biblio_id WHERE ba.author_id = $authId");
$arrAuthoBook = array();

//children node (book contribute)
while ($data = $authorBook->fetch_row()) {    
    $row['biblio_id'] = $data[0];
    /*$row['image']= SWB.'images/docs/'.$data[2];*/
    $row['parent'] = true;

$arrAuthCollab = array();    
$authorCollaborate = $dbs->query("SELECT a.author_id,a.author_name,ba.level from mst_author a
inner join biblio_author ba on a.author_id= ba.author_id where 
ba.biblio_id =$data[0] and a.author_id <> $authId ");

//collaborate with
while ($dta = $authorCollaborate->fetch_row()) {        
    $r['text'] = array('name'=>$dta[1],'level'=>$sysconf['authority_level'][$dta[2]]);;       
    array_push($arrAuthCollab, $r);
}

$row['text'] = array(
    'name'=>$data[1],
    'level'=>$sysconf['authority_level'][$data[3]]                
    );

if($arrAuthCollab){
    $row['children'] =$arrAuthCollab;
    $row['parent'] = true;
}

    array_push($arrAuthoBook, $row);
}
//parent node
$arr_auth= array();
$authorDetail = $dbs->query("SELECT author_name from mst_author where author_id= $authId");
while ($dt = $authorDetail->fetch_row()) {        
    $rw['text'] = array('name'=>$dt[0]);;   
    $rw['parent'] = true;
    array_push($arr_auth, $rw);
}

}
?>
<script>
var parent =<?php echo json_encode($arr_auth); ?>;
var children =<?php echo json_encode($arrAuthoBook); ?>;
parent[0].children = children;

 var chart_config = {
        chart: {
            container: "#AuthorTree",
            rootOrientation:  'WEST', // NORTH || EAST || WEST || SOUTH
            // levelSeparation: 30,
            siblingSeparation:   15,
            subTeeSeparation:    50,
            scrollbar: "fancy",                    
            node: {                            
                HTMLclass: 'treeDefault'
            }                        
        },
        nodeStructure: parent[0]
    };

new Treant( chart_config );		
</script>
