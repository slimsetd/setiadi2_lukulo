<?php
/**
 * Markdown Reader
 *
 * Copyright (C) 2018  Drajat Hasan (drajathasan20@gmail.com)
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

function getDoc($docFile)
{
	// We need parsedown library to read .md file as .html output
	require '../lib/parsedown/Parsedown.php';
	$html = '';
	if  (file_exists('docs/'.$docFile.'.md')) {
		$html = 'docs/'.$docFile.'.md';
	} else {
		$file = 404;
		return $file;
	}
	$html = file_get_contents($html);
	$Parsedown = new Parsedown();
	$template  = '<div class="doc">';
	$template .= $Parsedown->text($html);
	$template .= '</div>';	
	return $template;
}
// SetOut
$file = trim($_GET['file']);
$result = getDoc($file);
echo $result;
exit();
?>