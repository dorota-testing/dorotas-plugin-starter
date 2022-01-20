jQuery(document).ready(function($){

//this sets delay of popup for 20s	
function openPopup() {
    setTimeout( function() {$('.dps-wrap').css('display','block'); }, 20000);
}	
    var visited = dpsGetCookie('dps_dismissed');
    if (visited == true) {
        return false;
    } else {
        openPopup();
    }
	
	$('#dps-close').click(function(e) {
//		alert('popup');
		$('.dps-wrap').css('display','none');
		dpsCreateCookie('dps_dismissed', true, 60);
		
	});
	$('.dps-wrap img').click(function(e) {
//		alert('popup');
		dpsCreateCookie('dps_dismissed', true, 60);
		
	});

	function dpsCreateCookie(name, value, days) {
		var expires;

		if (days) {
			var date = new Date();
			date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
			expires = "; expires=" + date.toGMTString();
		} else {
			expires = "";
		}
		document.cookie = encodeURIComponent(name) + "=" + encodeURIComponent(value) + expires + "; path=/";
	};
	
	function dpsGetCookie(name) {
	  var value = "; " + document.cookie;
	  var parts = value.split("; " + name + "=");
	  if (parts.length == 2) return parts.pop().split(";").shift();
	}
});