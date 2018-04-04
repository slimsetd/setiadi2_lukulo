<?php
// be sure that this file not accessed directly
if (!defined('INDEX_AUTH')) {
  die("can not access this file directly");
} elseif (INDEX_AUTH != 1) { 
  die("can not access this file directly");
}
if (!defined('INDEX_AUTH')) {
  die("can not access this file directly");
} elseif (INDEX_AUTH != 1) {
  die("can not access this file directly");
}


class custom_ui_form {
  /*properties*/
  public $content = '';

  //sysout
  public function out()
  {
    return $this->content;
  }


  public function createUiStep(){    
    $content = '<div class="container">'.
                  '<div class="row bs-wizard" style="border-bottom:0;">'
                    .$this->stepOne().$this->stepTwo().$this->stepThree(). 
                  '</div>'.              
              '</div>';
    return $content;
  }

  public function stepOne(){    
    $content = '<div class="col-xs-3 bs-wizard-step complete">'.
                  '<div class="text-center bs-wizard-stepnum">Step 1</div>'.
                  '<div class="progress"><div class="progress-bar"></div></div>'.
                  '<a href="#" class="bs-wizard-dot"></a>'.
                  '<div class="bs-wizard-info text-center">GMD</div>'.
                '</div>';
    return $content;
  }

  public function stepTwo(){
    $content = '<div class="col-xs-3 bs-wizard-step complete"><!-- complete -->'.
                  '<div class="text-center bs-wizard-stepnum">Step 2</div>'.
                  '<div class="progress"><div class="progress-bar"></div></div>'.
                  '<a href="#" class="bs-wizard-dot"></a>'.
                  '<div class="bs-wizard-info text-center">Bibliography form</div>'.
                '</div>';
    return $content;
  }

  public function stepThree(){
    $content = '<div class="col-xs-3 bs-wizard-step active"><!-- complete -->'.
                  '<div class="text-center bs-wizard-stepnum">Step 3</div>'.
                  '<div class="progress"><div class="progress-bar"></div></div>'.
                  '<a href="#" class="bs-wizard-dot"></a>'.
                  '<div class="bs-wizard-info text-center">Approval</div>'.
                  '</div>';
    return $content;
  }

  public function createGMDForm($options){
      $content='<div class="gmd-section">'.      
          '<div class="form-group col-md-10">'.            
            $this->createSelect("gmd_id",$options,'GMD Type').            
          '</div>'.    
        '</div>';    
    return $content;
  }

  public function createBiblioForm(
    $freqOption,
    $publisherOption,
    $placeOption
  ){
     $content='<div class="biblio-section">'.      
          '<div class="form-group col-md-10">'.            
            $this->createText('title','Title').
            $this->createText('sor','Statement of Responsibility').
            $this->createText('edition','Edition').
            $this->createText('specDetailInfo','Specific Detail Info').
            $this->createSelect("frequencyID",$freqOption,'Frequency').
            __('Use this for Serial publication<br/>').
            $this->createText('isbn_issn','ISBN/ISSN').
            $this->createSelect("publisherID",$publisherOption,'Publisher').
            $this->createText('year','Publish Year').
            $this->createSelect("placeID",$placeOption,'Publishing Place').            
            $this->createText('collation','Collation').
            $this->createTextArea('seriesTitle','Series Title').
            $this->createText('callNumber','Collation').
            __('Sets of ID that put in the book spine.<br/>').                       
          '</div>'.    
        '</div>';    
    return $content;    
  }


  public function createText($element_name,$title,$value=''){
    $_buffer = '<label for="'.$element_name.'">'.$title.' : </label><input type="text" name="'.$element_name.'" id="'.$element_name.'" class="form-control" />';
    return $_buffer;
  }

  public function createTextArea($element_name,$title,$value=''){
    $_buffer = '<label for="'.$element_name.'">'.$title.' : </label><textarea name="'.$element_name.'" id="'.$element_name.'" class="form-control">'.$value.'</textarea>';
    return $_buffer;
  }

  public function createSelect($element_name,$options,$title,$selected = ''){
    $_buffer = '<label for="'.$element_name.'">'.$title.': </label><select name="'.$element_name.'" id="'.$element_name.'" class="form-control">'."\n";      
    foreach ($options as $option) {
         $_buffer .= '<option value="'.$option[0].'">';
         $_buffer .= $option[1].'</option>'."\n";
    }
    $_buffer .= '</select>'."\n";
    return $_buffer;
  }

}//end of class    
?>

  



  