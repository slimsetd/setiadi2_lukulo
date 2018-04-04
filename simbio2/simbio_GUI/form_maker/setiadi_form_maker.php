<?php
/**
 * Setiadi Form Maker Class
 * Copyright (C) 2018 Drajat Hasan (drajathasan20@gmail.com)
 *
 * Inspired from Simbio Form Maker Class created by Arie Nugraha (dicarve@yahoo.com)
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

// be sure that this file not accessed directly
if (!defined('INDEX_AUTH')) {
  die("can not access this file directly");
} elseif (INDEX_AUTH != 1) { 
  die("can not access this file directly");
}

class setiadi_form
{
	public $tableAttr   	 = array();
	public $actionForm 		 = '';
	public $methodForm 		 = '';
	public $itemID     		 = '';
	public $inPop	  		 = false;
	public $specSelectWidth  = '95%';

	/**
	*   Construct
	*/
	public function __construct($action, $method = "POST", $inPop, $isEnable, $item_id)
	{
		$this->actionForm = $action;
		$this->methodForm = $method;
		$this->enableForm = $isEnable;
		$this->itemID 	  = $item_id;
		$this->inPop      = $inPop;
		$this->specSelectWidth  = ($this->inPop)?'92%':$this->specSelectWidth;
	}

	/**
	 *	Function to create text
	 *  @param string $text
	 */
	public function createText($label, $value='', $str_value, $focus = '')
	{
		$value = (empty($value))?NULL:'value="'.$value.'"';
		$label = ucwords(strtolower($label));
		$text  = '<span>'.$label.'</span>';
        $text .= '<input style="width: 100%;" type="text" name="'.$str_value.'" id="'.$str_value.'" '.$value.' '.$focus.'/>';
        $this->tableAttr[] = $text;
	}

	/**
	 *	Function to create textarea
	 *  @param string $text
	 */
	public function createTextArea($label, $value='', $str_value)
	{
		$value = (empty($value))?NULL:$value;
		$label = ucwords(strtolower($label));
		$text  = '<span>'.$label.'</span>';
        $text .= '<textarea style="width: 100%;margin: 0px; height: 93px;" name="'.$str_value.'" id="'.$str_value.'">'.$value.'</textarea>';
        $this->tableAttr[] = $text;
	}

	/**
	 *	Function to create select
	 *  @param string $select
	 */
	public function createSelect($label, $value = '', $str_value, $opt)
	{
		$opt   = (!is_array($opt))?'<option>Option isnt array!</option>':$opt;
		$label = ucwords(strtolower($label));
		$select  = '<span>'.$label.'</span>';
        $select .= '<select style="width: '.$this->specSelectWidth.';"name="'.$str_value.'" id="'.$str_value.'">';
        $select .= '<option value="0"> Pilih </option>';
        	   // Loop
        	   foreach ($opt as $option) {
        	   	  $selected = ($value == $option[1])?'selected':'';
        	   	  $select .= '<option value="'.$option[0].'" '.$selected.'>'.$option[1].'</option>';
        	   }
        $select .= '</select>';
        $select .= '<input id="'.$str_value.'2" style="width: '.$this->specSelectWidth.'; display: none;" type="text" placeholder="Masukan isian yang anda inginkan">';
        $select .= '&nbsp;<a class="addSelect notAJAX btn btn-success" style="float: right;" data="'.$str_value.'"><i class="glyphicon glyphicon-plus"></i></a>';
        $this->tableAttr[] = $select;
	}

	/**
	 *	Function to create reguler select
	 *  @param string $select
	 */
	public function createRegSelect($label, $value = '', $str_value, $opt)
	{
		$opt   = (!is_array($opt))?'<option>Option isnt array!</option>':$opt;
		$label = ucwords(strtolower($label));
		$select  = '<span>'.$label.'</span>';
        $select .= '<select style="width: 100%;"name="'.$str_value.'" id="'.$str_value.'">';
        $select .= '<option value="0"> Pilih </option>';
        	   // Loop
        	   foreach ($opt as $option) {
        	   	  $selected = ($value == $option)?'selected':'';
        	   	  $select .= '<option value="'.$option.'" '.$selected.'>'.$option.'</option>';
        	   }
        $select .= '</select>';
        $this->tableAttr[] = $select;
	}

	/**
	 *	Function to create module select
	 *  @param string $select
	 */
	public function createModSelect($label, $value = '', $str_value, $opt)
	{
		$opt   = (!is_array($opt))?'<option>Option isnt array!</option>':$opt;
		$label = ucwords(strtolower($label));
		$select  = '<span>'.$label.'</span>';
        $select .= '<select style="width: 100%;"name="'.$str_value.'" id="'.$str_value.'">';
        $select .= '<option value="0"> Pilih </option>';
        	   // Loop
        	   foreach ($opt as $option) {
        	   	  $select .= '<option value="'.$option[0].'">'.$option[1].'</option>';
        	   }
        $select .= '</select>';
        $this->tableAttr[] = $select;
	}


	/**
	* Function to create step number
	* @param string $step
	*/
	public function createStep($array_step)
	{
		// Checking
		if (!is_array($array_step)) {
			return false;
		}
		// Make step
		$visited = 'visited';
		$aFirst  = '<a class="notAJAX" href="#">';
		$aLast   = '</a>';
		$step  = '<section>';
		$step .= '<nav>';
		$step .= '<ol class="cd-multi-steps text-bottom count">';
			foreach ($array_step as $value) {
		  		$step .= '<li class="li-steps '.strtolower($value).'l '.$visited.'" data="'.strtolower($value).'">'.$aFirst.$value.$aLast.'</li>';
		  		$visited = '';
		  		$aFirst  = '<em>';
		  		$aLast   = '</em>';
		  	}
		$step .= '</ol>';
		$step .= '</nav>';
		$step .= '</section>';
		return $step;
	}

	/**
	*  Function to create div separator
	*  @param string separator
	*/
	public function createButton($str)
	{
		$attr  = '<div style="text-align: left; margin-top: 20px; width: 100%;">';
		$attr .= '<i style="text-align: center; display: block; font-size: 50pt;color:#28a745!important" class="glyphicon glyphicon-ok-sign"></i><br>';
  		$attr .= '<h1 style="text-align:center; display: block;line-height: 0;padding-bottom: 10px;">Selamat</h1>';
  		$attr .= '<span style="display:block; text-align:center;font-size: 16pt;padding-bottom: 10px;">Data-data telah lengkap, kini anda dapat menekan tombol simpan untuk menyimpan data.</span>';
  		$attr .= '<button name="saveData" class="push-right btn btn-success" style="width: 100%;">'.$str.'</button>';
  		$attr .= '</div>';
  		$this->tableAttr[] = $attr;
	}

	/**
	*  Function to create anything
	*  @param string
	*/
	public function createAnything($str)
	{
		$this->tableAttr[] = $str;
	}

	/**
	*  Function to create div separator
	*  @param string separator
	*/
	public function setSeparator($sepName, $active='', $style='')
	{
		$this->tableAttr[] = '<div class="separator '.$active.' '.$sepName.'" '.$style.'>';
	}

	/**
	*  Function to create close div separator
	*  @param string separator
	*/
	public function setCloseSeparator()
	{
		$this->tableAttr[] = '</div>';
	}

	/**
	 *	Function to printOut Attr
	 *  @param string $table
	 */
	public function printOut()
	{
		$table  = '<div class="form-biblio">';
		$table .= '<form class="setiadi-form" action="'.$this->actionForm.'" method="'.$this->methodForm.'" target="blindSubmit" enctype="multipart/form-data">';
		foreach ($this->tableAttr as $table_attr) {
			$table .= $table_attr;
		}
		$table .= '</form>';
		$table .= '</div>';
		return $table;
	}
}
?>