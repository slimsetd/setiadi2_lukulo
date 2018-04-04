<?php
/* JSON Object for amchart js. */
class amchartDiagram
{	
    var $type;
    var $theme;
    var $dataProvider;
    var $valueField;
    var $titleField;
    var $balloon;
    var $export;
    function amchartDiagram($data)
    {
        $this->dataProvider = json_decode($data);
        $this->type='pie';
        $this->theme='light';
        $this->valueField='total';
        $this->titleField='name';
        $balloonObj = new stdClass();	
        $balloonObj->fixedPosition=true;
        $this->balloon=$balloonObj;             
        $this->export=true;

    }    
}
?>