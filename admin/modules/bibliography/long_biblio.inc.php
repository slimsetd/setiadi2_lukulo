<?php
/**
 * Copyright (C) 2017  Navis (navkandar@gmail.com)
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

class longBiblioAtt
{
	// Get Pattern 
	public function getPattern($p_prefix, $dbs) 
	{
		$pattern_q = $dbs->query('SELECT pattern_prefix, pattern_zero, pattern_suffix FROM long_pattern WHERE pattern_prefix REGEXP "'.$p_prefix.'"');
		if ($get = $pattern_q->fetch_object()) {
			$pattern_array = array();
			$pattern_array['prefix'] = $get->pattern_prefix;
			$pattern_array['zero'] = $get->pattern_zero;
			$pattern_array['suffix'] = $get->pattern_suffix;
			return $pattern_array;
		}
	}

	public static function getLastID()
	{
		global $dbs;
		// set query
		$sql_d = $dbs->query("SELECT pattern_id FROM long_pattern");
		// Get Last ID
		$lastID = $sql_d->num_rows;
		echo $lastID+1;
	}
	// Get Last ItemCode
	public function getLastNumber($dbs, $p_prefix)
	{
		// Last Number
		$p_prefix = (string)$p_prefix;
		$lastNumber = $this->getPattern($p_prefix, $dbs);
		// Set query 
		$sql_q = $dbs->query('SELECT item_code FROM item WHERE item_code REGEXP "'.$lastNumber['prefix'].'"');
		// Check its available or not
		if ($sql_q->num_rows == 0) {
			$getNumber = 1;
		} else {
			$getNumber = $sql_q->num_rows+1;
		}
		return $getNumber;
	}

	// Set List
	public function setList($dbs) 
	{
		$pattern_q = $dbs->query('SELECT pattern_prefix, pattern_zero, pattern_suffix FROM long_pattern');
		$list = array();
		while ($getList = $pattern_q->fetch_object()) {
			$list[] = array($getList->pattern_prefix, $getList->pattern_prefix.sprintf('%0'.$getList->pattern_zero.'d', 0).$getList->pattern_suffix);
		}
		return $list;
	}

	// Additional CSS
	public static function setCss()
	{
		echo "<style>\n";
		echo "#row5 tr {";
		echo "height: 0;";
		echo "overflow: hidden;";
		echo "transition: height 400ms linear;";
		echo "}";
		echo "#toggle {";
		echo "display: none;";
		echo "}";
		echo "#toggle:checked ~ .fieldsetContainer {";
		echo "height: 300px;";
		echo "}";
		echo "label .arrow-dn { display: inline-block; }";
		echo "label .arrow-up { display: none; }";
		echo "#toggle:checked ~ label .arrow-dn { display: none; }";
		echo "#toggle:checked ~ label .arrow-up { display: inline-block; }";
		echo ".expand {";
		echo "background-color: #337ab7;";
		echo "color: white;";
		echo "padding: 10px;";
		echo "border-radius: 5px;";
		echo "}";
		echo "</style>";
	}

	public static function setToggleButton()
	{
		echo '<input type="checkbox" id="toggle" />';
    	echo '<label for="toggle">';
        echo '<span class="expand">Show</span>';
    	echo '</label>';
	}

	// Set SerialCode Manager
	public function serialCodeMgr()
	{
		//$scm  = '';
		$scm = '<table id="scm" width="100%">';
		$scm .= '<tr>';
		$scm .= '<td>Awalan</td><td>:</td><td><input type="text" id="prefix" placeholder="B" autocomplete="off" autofocus/></td>';
		$scm .= '</tr>';
		$scm .= '<tr>';
		$scm .= '<td>Angka Nol</td><td>:</td><td><input type="text" id="zero" placeholder="00000" autocomplete="off"/></td>';
		$scm .= '</tr>';
		$scm .= '<tr>';
		$scm .= '<td>Akhiran</td><td>:</td><td><input type="text" id="suffix" placeholder="S" autocomplete="off"/></td>';
		$scm .= '</tr>';
		$scm .= '<tr><td colspan="9"><h3 style="width:100px !important; margin:0 !important;">Preview:</h3><br><h4 style="font-weight:bold !important;" id="preview">B00000S</h4> <button id="simpan" style="float:right" class="notAJAX button btn btn-info openPopUp">Simpan</button></td></tr>';
		$scm .= '</table>';
		return $scm;
	}
}
?>
