<?php
class dataTableObj
{	             
    var $dom;
    var $destroy;
    //var $ajax;
    var $columns;

    function dataTableObj()
    {
        //$this->dataProvider = json_decode($data);       
        $this->dom='trp';             
        $this->destroy=true;
        //$this->ajax=Array("url"=>MWB.'reporting/getItemFromDiagram.php?type='.$type,"type"=>"GET");		
		$col1 = Array("title"=>"Title","data"=>"title"); 
        $col2 = Array("title"=>"Series Title","data"=>"series_title"); 
        $col3 = Array("title"=>"Publish Year","data"=>"publish_year"); 
        $this->columns = Array($col1,$col2,$col3);
        
        
    }    
}
?>
<script>
	
</script>