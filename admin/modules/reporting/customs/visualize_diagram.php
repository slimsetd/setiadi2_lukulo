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
require '../../../../sysconfig.inc.php';
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


$page_title = 'Visualize Diagram';
$reportView = false;
if (isset($_GET['reportView'])) {
    $reportView = true;
}

if (!$reportView) {
?>
    <!-- filter -->
    <style>
    	table.for-diagram th, td{
    		border: 1px dotted #ddd!important;
    	}
    </style>
    <fieldset>
    <div class="per_title">
    	<h2><?php echo __('Visualize Diagram'); ?></h2>
    </div>
    <div class="infoBox">
    <?php echo __('Collection Graph'); ?>
    </div>
    <div class="sub_section">

        <div class="divRow">
            <div class="divRowLabel"><?php echo __('Show Report'); ?></div>
            <div class="divRowContent">                          
                <select name="selectReport" id="selectReport">                    
                    <option value="" selected>--select--</option>
                    <option value="diagram">Type Collection</option>
                    <option value="author">Author Collaborate</option>
                </select>
            </div>
        </div>    		
		<div class="diagram-section" style="display:none">
            <div id="chartDiv"></div>
            <div style="padding-bottom:5%;">
                <table id="dataFromDiagram" class="for-diagram table-striped table-bordered"></table>
            </div>    
        </div>
        <div class="author-section" style="display:none">
        	<div id="treeView" style="display:none">
        		
        	</div>
             <div style="padding-bottom:5%;">
                 <table id="tblAuthor" style="width:100%" class="for diagram table-bordered"></table>
             </div>                        
        </div>
        	    
    </div>
    </fieldset>
    <!-- filter end -->
    
<?php
/*added by doe*/

$visualize_query = $dbs->query('SELECT gmd_name as `name`, COUNT(biblio_id) AS total_titles FROM `biblio` AS b
    INNER JOIN mst_gmd AS gmd ON b.gmd_id = gmd.gmd_id GROUP BY b.gmd_id 
    UNION
    SELECT gmd_name AS `name`,0 AS total_titles
    FROM mst_gmd ORDER BY `name` ASC');



$return_arr = array();
while ($data = $visualize_query->fetch_row()) {
    $row['name'] = $data[0];
    $row['total'] = $data[1];    
    array_push($return_arr, $row);
}

include '../visualizeDiagram.php';
$diagram = new amchartDiagram(json_encode($return_arr));
}
?>
<script>
$(document).ready(function(){

    //diagram section
    var chart = AmCharts.makeChart("chartDiv",<?php echo json_encode(get_object_vars($diagram)); ?> );
    chart.addListener("clickSlice", function(e){        
        var ajax = {
            'url':'<?php echo MWB;?>reporting/getItemFromDiagram.php?type='+ e.dataItem.title,
            'type':'GET'
            }
        var dtTblProp = {
            dom:'trp',
            ajax:ajax,
            select:false,
            destroy:true,
            columns:[
                {'title':'title','data':'title'},
                {'title':'Series Title','data':'series_title'},
                {'title':'Publish Year','data':'publish_year'},
                ]}      
        $("#dataFromDiagram").DataTable(dtTblProp);
    })
    //author section

    $('#selectReport').on('change',function(){        
        if($(this).val()){           
           if($(this).val()=='diagram'){
                $('.diagram-section').show();
                $('.author-section').hide();
           }else if($(this).val()=='author'){
                $('.diagram-section').hide();
                $('.author-section').show();
           } 
        }else{
            $('.diagram-section').hide();
            $('.author-section').hide();
        }
    })

    var dtTblProp = {
            dom:'trp',
            ajax:'<?php echo MWB;?>reporting/dtTblAuthor.php',
            destroy:true,
            select: {
              style: 'single',
            },
            columns:[
                {'title':'Author Name','data':'author_name'},
                {'title':'Author Year','data':'author_year'},
                {'title':'Authority Type','data':'authority_type'},
                ],
            columnDefs :[
            {
                'targets':0,
                'render':function(data,type,row){
                    return  '<a class="notAJAX openPopUp" href="<?php echo MWB; ?>reporting/getTreeView.php?auth_id='+ row['Dt_RowId']+'" width="700" height="470" title="'+row['author_name']+'">'+ row['author_name']+ '</a>'
                }
            },{
                'targets':2,render:function(data, type, row){
                if(row['authority_type']=='p'){
                    return 'Personal';
                }
            }}]
            }

    var table=  $('#tblAuthor').DataTable(dtTblProp);

    table.on( 'select', function ( e, dt, type, indexes ) {        
        var rowData = table.rows( { selected: true } ).data()[0];        
    });

})			
</script>
<script>
    new Treant( simple_chart_config );    
</script>





