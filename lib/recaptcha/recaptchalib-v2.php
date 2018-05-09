<?php
/**
 *
 * Setiadi 2 Recaptcha v2 function
 * Copyright (C) 2018 Drajat Hasan (drajathasan20@gmail.com)
 * Inspired and some code taken from official slims v2 recaptcha and recaptchalib.php
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
// Verify Server
define('VERIFY_SERVER', 'https://www.google.com/recaptcha/api/siteverify');

/**
 *	ReCaptchaResonse Class
 *	@param bool $is_valid
 *  @param array $error
 *  @param string $dump
 */
class ReCaptchaResponse {
        var $is_valid;
        var $error;
        var $dump;
}

/**
 * Function getResponse()
 * @param string $serResAddress
 * @param string $secret
 * @param string $captchaResponse
 * @param string $remoteIP
 * @param string $response
 */
function getResponse($serverResAddress, $secret, $captchaResponse, $remoteIP)
{
	$address = $serverResAddress.'?secret='.$secret.'&response='.$captchaResponse.'&remoteip='.$remoteIP;
	$response = false;
	// We check the allow_url_fopen is enable or not in your server
	// several cpanel server disable the allow_url_fopen
	if (ini_get('allow_url_fopen')) {
	    $response = file_get_contents($address);
	} else {
	    // The alternative for resolve the problem is use curl_init
	    if (!function_exists('curl_init')){ 
	        die('CURL is not installed!');
	    }
	    $ch = curl_init();
	    curl_setopt($ch, CURLOPT_URL, $address);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	    $response = curl_exec($ch);
	    curl_close($ch);
	}
	return $response;
}

/**
 * Function recaptcha_check_answer()
 * @param string $privkey
 * @param string $remoteIP
 * @param string $gRecapresponse
 */
function recaptcha_check_answer($privkey, $remoteip, $gRecapresponse) 
{
	// Checking key
	if (empty($privkey)) {
		die("To use reCAPTCHA 2 you must get an API key from <a href='https://www.google.com/recaptcha/admin/create'>https://www.google.com/recaptcha/admin/create</a>");
	} 

	// Checking Remote IP
	if (empty($remoteip)) {
		die("For security reasons, you must pass the remote ip to reCAPTCHA");
	}

	// Check Recaptcha
	if (!$gRecapresponse) {
		die('Please check the captcha form.');
	}

	// Get response
	$response = getResponse(VERIFY_SERVER, $privkey, $gRecapresponse, $remoteip);
	// Set Response Class
	$recaptcha_response = new ReCaptchaResponse();
	// Decode
	$result = json_decode($response);
	// Result
	if ($result->success == false) {
		$recaptcha_response->is_valid = false;
		$error = 'error-codes'; // Inspired from Ido Alit
		$recaptcha_response->error = print_r($result->$error); // because the result of object error-codes is an array.
		// For debugging purpose
		// $recaptcha_response->dump = $response;
	} else {
		$recaptcha_response->is_valid = true;
	}
	return $recaptcha_response;
}

/**
 * Function recaptcha_get_html
 */
function recaptcha_get_html($publickey)
{
	$html_tag  = "<script src='https://www.google.com/recaptcha/api.js'></script>";
	$html_tag .= '<div class="g-recaptcha" data-sitekey="'.$publickey.'"></div>';
	return $html_tag;
}

?>
