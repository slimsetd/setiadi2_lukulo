/**
 * Drajat Hasan 2018
 * call Modal function
 *
 * Require : jQuery library, Bootstrap Js library
 **/

// Function to open .md file 
var open_info = function(str_title, sourceData) {
	$('.modal-title').html(str_title);
	$('.modal-body').load('getDoc.php?file='+sourceData, {limit: 25}, 
		function (responseText, textStatus, XMLHttpRequest) {
			if (XMLHttpRequest.status != 200 || responseText == 404) {
				$(this).html('<div class="erorMsg"><strong>AJAX Reload Error!.</strong></div>');
				return false;
			}
		}
	);
	return false;
}

$(document).ready(function(){
	$('.btn-link').click(function(){
		var btnLink = $(this)
		var title   = btnLink.attr('title');
		var data	= btnLink.attr('data');
		open_info(title, data);
	});
	$('.close,#close').click(function(){
		$('.modal-title').html('');
		$('.modal-body').html('');
	});
});