<?php
/**
 * Copyright (C) 2017  Drajat Hasan (drajathasan20@gmail.com)
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
if (INDEX_AUTH != 1) {
    die("can not access this file directly");
}

class alternativeTheme
{
	/**
	*	Function to checking active theme
	*	@param array $list
	*/
	public function checkActive($templateDir)
	{
		global $dbs;
		$sql_q = $dbs->query("SELECT setting_value FROM setting WHERE setting_name = 'admin_template'");
		$getData = $sql_q->fetch_object();
		$decode = unserialize($getData->setting_value);
		$dir = glob("../../".$templateDir."/*", GLOB_ONLYDIR);
		$list = array();
		$sum = count($dir);
		for ($i=0; $i < $sum ; $i++) { 
			$theme = substr($dir[$i], 21);
			// checking
			if (!in_array($theme, $decode)) {
				$list[] .= $theme;
			}
		}
		return $list;
	}

	/**
	*	Function to checking active public theme
	*	@param array $list
	*/
	public function checkPubActive($templateDir)
	{
		global $dbs;
		$sql_q = $dbs->query("SELECT setting_value FROM setting WHERE setting_name = 'template'");
		$getData = $sql_q->fetch_object();
		$decode = unserialize($getData->setting_value);
		$dir = glob("../../../".$templateDir."/*", GLOB_ONLYDIR);
		$list = array();
		$sum = count($dir);
		for ($i=0; $i < $sum ; $i++) { 
			$theme = substr($dir[$i], 18);
			// checking
			if (!in_array($theme, $decode)) {
				if ($theme != 'bootstrap') {
					$list[] .= $theme;
				}
			}
		}
		return $list;
	}

	/**
	*	Function to set image
	*	@param array $list
	*/
	public function getImage($templateDir)
	{
		// checking
		$img = SWB.'admin/admin_template/preview.png';
		$imgAvailibility = false;
		if (file_exists('../../admin_template/'.$templateDir.'/preview.png')) {
			$img = SWB.'admin/admin_template/'.$templateDir.'/preview.png';
			$imgAvailibility = true;
		} 
		$combine = array($imgAvailibility, $img);
		return $combine;
	}

	/**
	*	Function to set public image
	*	@param array $list
	*/
	public function getPubImage($templateDir)
	{
		// checking
		$img = SWB.'admin/admin_template/preview.png';
		$imgAvailibility = false;
		if (file_exists('../../../template/'.$templateDir.'/preview.png')) {
			$img = SWB.'template/'.$templateDir.'/preview.png';
			$imgAvailibility = true;
		} 
		$combine = array($imgAvailibility, $img);
		return $combine;
	}

	/**
	*	Function to set theme info
	*	@param array $themeInfo
	*/
	public function setInfo($templateDir)
	{
		$themeInfo = array();
		$file = '../../admin_template/'.$templateDir.'/info.theme.php';
		if (file_exists($file)){
			require $file;
			$themeInfo['theme']['origin']      = (isset($theme['info']['origin']))?$theme['info']['origin']:'Not Defined';
			$themeInfo['theme']['author']      = (isset($theme['info']['author']))?$theme['info']['author']:'Not Defined';
			$themeInfo['theme']['modified']    = (isset($theme['info']['modified']))?$theme['info']['modified']:'Not Defined';
			$themeInfo['theme']['version']     = (isset($theme['info']['version']))?$theme['info']['version']:'Not Defined';
			$themeInfo['theme']['description'] = (isset($theme['info']['description']))?$theme['info']['description']:'Not Defined';
		} else {
			$themeInfo['theme']['origin']      = 'None';
			$themeInfo['theme']['author']      = 'None';
			$themeInfo['theme']['modified']    = 'None';
			$themeInfo['theme']['version']     = 'None';
			$themeInfo['theme']['description'] = 'None';
		}
		return $themeInfo;
	}

	/**
	*	Function to set Pub theme info
	*	@param array $themeInfo
	*/
	public function setPubInfo($templateDir)
	{
		$themeInfo = array();
		$file = '../../../template/'.$templateDir.'/info.theme.php';
		if (file_exists($file)){
			require $file;
			$themeInfo['theme']['origin']      = (isset($theme['info']['origin']))?$theme['info']['origin']:'Not Defined';
			$themeInfo['theme']['author']      = (isset($theme['info']['author']))?$theme['info']['author']:'Not Defined';
			$themeInfo['theme']['modified']    = (isset($theme['info']['modified']))?$theme['info']['modified']:'Not Defined';
			$themeInfo['theme']['version']     = (isset($theme['info']['version']))?$theme['info']['version']:'Not Defined';
			$themeInfo['theme']['description'] = (isset($theme['info']['description']))?$theme['info']['description']:'Not Defined';
		} else {
			$themeInfo['theme']['origin']      = 'None';
			$themeInfo['theme']['author']      = 'None';
			$themeInfo['theme']['modified']    = 'None';
			$themeInfo['theme']['version']     = 'None';
			$themeInfo['theme']['description'] = 'None';
		}
		return $themeInfo;
	}

	/**
	*	Function to set active theme
	*	@param array $dirTheme
	*/
	public function setActiveTheme($dbs)
	{
		$sql_q = $dbs->query("SELECT setting_value FROM setting WHERE setting_name = 'admin_template'");
		$getData = $sql_q->fetch_object();
		$decode = unserialize($getData->setting_value);
		$theme_info = $this->setInfo($decode['theme']);
		$img = $this->getImage($decode['theme']);
		$dirTheme  = '<div class="row" style="width=100%; margin: 20px; background-color: white;">';
		$dirTheme .= '<div style="width:100%; display:block;">';
		$dirTheme .= '<div style="width:60%; display:block; padding: 20px; float: left;">';
		$dirTheme .= '<img src="'.$img[1].'" style="width: 100%; height: 300px;">';
		$dirTheme .= '</div>';
		$dirTheme .= '<div style="width:40%; display:block; padding: 20px; float: right;">';
		$dirTheme .= '<h4 style="margin: 0 !important; padding: 0 !important;">Template Admin '.$decode['theme'].'</h4>';
		$dirTheme .= '<table width="100%" style="margin-top: 20px;">';
		$dirTheme .= '<tr><td valign="top"><b>Diubah dari tema</b></td><td  valign="top">:</td><td valign="top">'.$theme_info['theme']['origin'].'</td></tr>';
		$dirTheme .= '<tr><td valign="top"><b>Dibuat oleh</b></td><td valign="top">:</td><td>'.$theme_info['theme']['author'].'</td></tr>';
		$dirTheme .= '<tr><td valign="top"><b>Diubah oleh</b></td><td valign="top">:</td><td>'.$theme_info['theme']['modified'].'</td></tr>';
		$dirTheme .= '<tr><td valign="top"><b>Versi</b></td><td valign="top">:</td><td>'.$theme_info['theme']['version'].'</td></tr>';
		$dirTheme .= '<tr><td valign="top"><b>Deskripsi</b></td><td valign="top">:</td><td>'.$theme_info['theme']['description'].'</td></tr>';
		$dirTheme .= '<tr><td colspan="3"><a style="float:right;margin:20px;" href="'.SWB.'admin/modules/system/pop_customize_theme.php" title="Pengaturan Template" class="btn notAJAX btn-success custome-admin-theme openPopUp">Customize</a></td></tr>';
		$dirTheme .= '</table>';
		$dirTheme .= '</div>';
		$dirTheme .= '</div>';
		$dirTheme .= '</div>';
		return $dirTheme;
	}

	/**
	*	Function to set active theme
	*	@param array $dirTheme
	*/
	public function setPubActiveTheme($dbs)
	{
		$sql_q = $dbs->query("SELECT setting_value FROM setting WHERE setting_name = 'template'");
		$getData = $sql_q->fetch_object();
		$decode = unserialize($getData->setting_value);
		$theme_info = $this->setPubInfo($decode['theme']);
		$img = $this->getPubImage($decode['theme']);
		$dirTheme  = '<div class="row" style="width=100%; margin: 20px; background-color: white;">';
		$dirTheme .= '<div style="width:100%; display:block;">';
		$dirTheme .= '<div style="width:60%; display:block; padding: 20px; float: left;">';
		$dirTheme .= '<img src="'.$img[1].'" style="width: 100%; height: 300px;">';
		$dirTheme .= '</div>';
		$dirTheme .= '<div style="width:40%; display:block; padding: 20px; float: right;">';
		$dirTheme .= '<h4 style="margin: 0 !important; padding: 0 !important;">Template Publik '.$decode['theme'].'</h4>';
		$dirTheme .= '<table width="100%" style="margin-top: 20px;">';
		$dirTheme .= '<tr><td valign="top"><b>Diubah dari tema</b></td><td  valign="top">:</td><td valign="top">'.$theme_info['theme']['origin'].'</td></tr>';
		$dirTheme .= '<tr><td valign="top"><b>Dibuat oleh</b></td><td valign="top">:</td><td>'.$theme_info['theme']['author'].'</td></tr>';
		$dirTheme .= '<tr><td valign="top"><b>Diubah oleh</b></td><td valign="top">:</td><td>'.$theme_info['theme']['modified'].'</td></tr>';
		$dirTheme .= '<tr><td valign="top"><b>Versi</b></td><td valign="top">:</td><td>'.$theme_info['theme']['version'].'</td></tr>';
		$dirTheme .= '<tr><td valign="top"><b>Deskripsi</b></td><td valign="top">:</td><td>'.$theme_info['theme']['description'].'</td></tr>';
		$dirTheme .= '<tr><td colspan="3"><a style="float:right;margin:20px;" href="'.SWB.'admin/modules/system/pop_customize_theme.php" title="Pengaturan Template" class="btn notAJAX btn-success custome-admin-theme openPopUp">Customize</a></td></tr>';
		$dirTheme .= '</table>';
		$dirTheme .= '</div>';
		$dirTheme .= '</div>';
		$dirTheme .= '</div>';
		return $dirTheme;
	}

	/**
	*	Function to set other theme
	*	@param array $dirTheme
	*/
	public function setTable($template_dir)
	{
		$arrayDir = $this->checkActive($template_dir);
		$dirTheme = '';
		foreach ($arrayDir as $dirTemplate) {
			$theme_info = $this->setInfo($dirTemplate);
			$img = $this->getImage($dirTemplate);
			$dirTheme .= '<div class="row" style="width=100%; margin: 20px; background-color: white;">';
			if ($img[0]){
				$dirTheme .= '<div style="width:100%; display:block;">';
				$dirTheme .= '<div style="width:60%; display:block; padding: 20px; float: left;">';
				$dirTheme .= '<img src="'.$img[1].'" style="width: 100%; height: 200px;">';
				$dirTheme .= '</div>';
				$dirTheme .= '<div style="width:40%; display:block; padding: 20px; float: right;">';
				$dirTheme .= '<h4 style="margin: 0 !important; padding: 0 !important;">Template Admin '.$dirTemplate.'</h4>';
				$dirTheme .= '<table width="100%" style="margin-top: 20px;">';
				$dirTheme .= '<tr><td valign="top"><b>Diubah dari tema</b></td><td  valign="top">:</td><td valign="top">'.$theme_info['theme']['origin'].'</td></tr>';
				$dirTheme .= '<tr><td valign="top"><b>Dibuat oleh</b></td><td valign="top">:</td><td>'.$theme_info['theme']['author'].'</td></tr>';
				$dirTheme .= '<tr><td valign="top"><b>Diubah oleh</b></td><td valign="top">:</td><td>'.$theme_info['theme']['modified'].'</td></tr>';
				$dirTheme .= '<tr><td valign="top"><b>Versi</b></td><td valign="top">:</td><td>'.$theme_info['theme']['version'].'</td></tr>';
				$dirTheme .= '<tr><td valign="top"><b>Deskripsi</b></td><td valign="top">:</td><td>'.$theme_info['theme']['description'].'</td></tr>';
				$dirTheme .= '<tr><td colspan="3"><button onclick="ActiveTheme(\''.MWB.'system/simple-theme.php\', \''.$dirTemplate.'\')"style="float:right;margin:20px;" class="btn">Aktifkan</button></td></tr>';
				$dirTheme .= '</table>';
				$dirTheme .= '</div>';
				$dirTheme .= '</div>';
			} else {
				$dirTheme .= '<div style="width:100%; display:block;">';
				$dirTheme .= '<div style="width:60%; display:block; padding: 20px; float: left;">';
				$dirTheme .= '<img src="'.$img[1].'" style="width: 100%; height: 200px;">';
				$dirTheme .= '</div>';
				$dirTheme .= '<div style="width:40%; display:block; padding: 20px; float: right;">';
				$dirTheme .= '<h4 style="margin: 0 !important; padding: 0 !important;">Template Admin '.$dirTemplate.'</h4>';
				$dirTheme .= '<table width="100%" style="margin-top: 20px;">';
				$dirTheme .= '<tr><td valign="top"><b>Diubah dari tema</b></td><td  valign="top">:</td><td valign="top">'.$theme_info['theme']['origin'].'</td></tr>';
				$dirTheme .= '<tr><td valign="top"><b>Dibuat oleh</b></td><td valign="top">:</td><td>'.$theme_info['theme']['author'].'</td></tr>';
				$dirTheme .= '<tr><td valign="top"><b>Diubah oleh</b></td><td valign="top">:</td><td>'.$theme_info['theme']['modified'].'</td></tr>';
				$dirTheme .= '<tr><td valign="top"><b>Versi</b></td><td valign="top">:</td><td>'.$theme_info['theme']['version'].'</td></tr>';
				$dirTheme .= '<tr><td valign="top"><b>Deskripsi</b></td><td valign="top">:</td><td>'.$theme_info['theme']['description'].'</td></tr>';
				$dirTheme .= '<tr><td colspan="3"><button onclick="ActiveTheme(\''.MWB.'system/simple-theme.php\', \''.$dirTemplate.'\')"style="float:right;margin:20px;" class="btn">Aktifkan</button></td></tr>';
				$dirTheme .= '</table>';
				$dirTheme .= '</div>';
				$dirTheme .= '</div>';
			}
			$dirTheme .= '</div>';
		}
		return $dirTheme;
	}

	/**
	*	Function to set other theme
	*	@param array $dirTheme
	*/
	public function setPubTable($template_dir)
	{
		$arrayDir = $this->checkPubActive($template_dir);
		$dirTheme = '';
		foreach ($arrayDir as $dirTemplate) {
			$theme_info = $this->setPubInfo($dirTemplate);
			$img = $this->getPubImage($dirTemplate);
			$dirTheme .= '<div class="row" style="width=100%; margin: 20px; background-color: white;">';
			if ($img[0]){
				$dirTheme .= '<div style="width:100%; display:block;">';
				$dirTheme .= '<div style="width:60%; display:block; padding: 20px; float: left;">';
				$dirTheme .= '<img src="'.$img[1].'" style="width: 100%; height: 200px;">';
				$dirTheme .= '</div>';
				$dirTheme .= '<div style="width:40%; display:block; padding: 20px; float: right;">';
				$dirTheme .= '<h4 style="margin: 0 !important; padding: 0 !important;">Template Publik '.$dirTemplate.'</h4>';
				$dirTheme .= '<table width="100%" style="margin-top: 20px;">';
				$dirTheme .= '<tr><td valign="top"><b>Diubah dari tema</b></td><td  valign="top">:</td><td valign="top">'.$theme_info['theme']['origin'].'</td></tr>';
				$dirTheme .= '<tr><td valign="top"><b>Dibuat oleh</b></td><td valign="top">:</td><td>'.$theme_info['theme']['author'].'</td></tr>';
				$dirTheme .= '<tr><td valign="top"><b>Diubah oleh</b></td><td valign="top">:</td><td>'.$theme_info['theme']['modified'].'</td></tr>';
				$dirTheme .= '<tr><td valign="top"><b>Versi</b></td><td valign="top">:</td><td>'.$theme_info['theme']['version'].'</td></tr>';
				$dirTheme .= '<tr><td valign="top"><b>Deskripsi</b></td><td valign="top">:</td><td>'.$theme_info['theme']['description'].'</td></tr>';
				$dirTheme .= '<tr><td colspan="3"><button onclick="ActivePubTheme(\''.MWB.'system/simple-theme.php\', \''.$dirTemplate.'\')"style="float:right;margin:20px;" class="btn">Aktifkan</button></td></tr>';
				$dirTheme .= '</table>';
				$dirTheme .= '</div>';
				$dirTheme .= '</div>';
			} else {
				$dirTheme .= '<div style="width:100%; display:block;">';
				$dirTheme .= '<div style="width:60%; display:block; padding: 20px; float: left;">';
				$dirTheme .= '<img src="'.$img[1].'" style="width: 100%; height: 200px;">';
				$dirTheme .= '</div>';
				$dirTheme .= '<div style="width:40%; display:block; padding: 20px; float: right;">';
				$dirTheme .= '<h4 style="margin: 0 !important; padding: 0 !important;">Template Publik '.$dirTemplate.'</h4>';
				$dirTheme .= '<table width="100%" style="margin-top: 20px;">';
				$dirTheme .= '<tr><td valign="top"><b>Diubah dari tema</b></td><td  valign="top">:</td><td valign="top">'.$theme_info['theme']['origin'].'</td></tr>';
				$dirTheme .= '<tr><td valign="top"><b>Dibuat oleh</b></td><td valign="top">:</td><td>'.$theme_info['theme']['author'].'</td></tr>';
				$dirTheme .= '<tr><td valign="top"><b>Diubah oleh</b></td><td valign="top">:</td><td>'.$theme_info['theme']['modified'].'</td></tr>';
				$dirTheme .= '<tr><td valign="top"><b>Versi</b></td><td valign="top">:</td><td>'.$theme_info['theme']['version'].'</td></tr>';
				$dirTheme .= '<tr><td valign="top"><b>Deskripsi</b></td><td valign="top">:</td><td>'.$theme_info['theme']['description'].'</td></tr>';
				$dirTheme .= '<tr><td colspan="3"><button onclick="ActivePubTheme(\''.MWB.'system/simple-theme.php\', \''.$dirTemplate.'\')"style="float:right;margin:20px;" class="btn">Aktifkan</button></td></tr>';
				$dirTheme .= '</table>';
				$dirTheme .= '</div>';
				$dirTheme .= '</div>';
			}
			$dirTheme .= '</div>';
		}
		return $dirTheme;
	}
}
?>
