!function(e,n){"function"==typeof define&&define.amd?define(n):"object"==typeof exports?module.exports=n(require,exports,module):e.lead_captor_fire=n()}(this,function(e,n,o){return function(e,n){"use strict";function o(e,n){return"undefined"==typeof e?n:e}function i(e){var n=24*e*60*60*1e3,o=new Date;return o.setTime(o.getTime()+n),"; expires="+o.toUTCString()}function t(){s()||(L.addEventListener("mouseleave",u),L.addEventListener("mouseenter",r),L.addEventListener("keydown",c))}function u(e){e.clientY>k||(D=setTimeout(m,y))}function r(){D&&(clearTimeout(D),D=null)}function c(e){g||e.metaKey&&76===e.keyCode&&(g=!0,D=setTimeout(m,y))}function d(e,n){return a()[e]===n}function a(){for(var e=document.cookie.split("; "),n={},o=e.length-1;o>=0;o--){var i=e[o].split("=");n[i[0]]=i[1]}return n}function s(){return d(T,"true")&&!v}function m(){s()||(e&&(e.style.display="block"),E(),f())}function f(e){var n=e||{};"undefined"!=typeof n.cookieExpire&&(b=i(n.cookieExpire)),n.sitewide===!0&&(w=";path=/"),"undefined"!=typeof n.cookieDomain&&(x=";domain="+n.cookieDomain),"undefined"!=typeof n.cookieName&&(T=n.cookieName),document.cookie=T+"=true"+b+x+w,L.removeEventListener("mouseleave",u),L.removeEventListener("mouseenter",r),L.removeEventListener("keydown",c)}var l=n||{},v=l.aggressive||!1,k=o(l.sensitivity,20),p=o(l.timer,1e3),y=o(l.delay,0),E=l.callback||function(){},b=i(l.cookieExpire)||"",x=l.cookieDomain?";domain="+l.cookieDomain:"",T=l.cookieName?l.cookieName:"viewedOuibounceModal",w=l.sitewide===!0?";path=/":"",D=null,L=document.documentElement;setTimeout(t,p);var g=!1;return{fire:m,disable:f,isDisabled:s}}});

(function( $ ) {
	'use strict';

	$(document).ready(function($) {

		setTimeout(function(){ 
			//$("body").addClass('lead_captor_popup_open');
		}, 1000);



		$('html').on("click touchstart", function(){
		  $("body").removeClass('lead_captor_popup_open');
		});
		$('.lead_captor_popup').on("click touchstart", function(event){
		    event.stopPropagation();
		});




		var $lead_captor_popup = $( ".lead_captor_popup" );
		$lead_captor_popup.find( ".lead_captor_form" ).submit(function( event ) {
			event.preventDefault();

			if ( $lead_captor_popup.hasClass('lead_captor_form_success') ) {
				return false;
			}

			$lead_captor_popup.addClass('lead_captor_form_loading');


			$.ajax({
				url: lead_captor_behavior.ajax_url,
				type: 'POST',
				data: {
					email: $('.lead_captor_subscribe_input').val(),
					token: $('#token').val(),
					action: 'lead_captor_save_subscriber'
				},
			})
			.done(function(data) {

				$lead_captor_popup.removeClass('lead_captor_form_loading');

				if ( data.success == true ) {

					$lead_captor_popup.addClass('lead_captor_form_success');

				}else{

					$lead_captor_popup.addClass('lead_captor_form_error');

				}

			})
			.fail(function() {
				$lead_captor_popup.removeClass('lead_captor_form_loading');
				$lead_captor_popup.addClass('lead_captor_form_error');
			});

		});// submit






	});//DOM ready

	var lead_captor = lead_captor_fire(document.getElementById(''), {
	delay: parseInt( lead_captor_behavior.delay ),
	timer: parseInt( lead_captor_behavior.timer ),
	sensitivity: parseInt( lead_captor_behavior.sensitivity ),
	cookie_expiration: parseInt( lead_captor_behavior.cookie_expiration ),
	aggressive: stringToBoolean( lead_captor_behavior.aggressive_mode ),
	cookieName: lead_captor_behavior.cookie_name,
	callback: function() {
		$("body").addClass('lead_captor_popup_open');
	}
	});

	function stringToBoolean(string){
        switch(string.toLowerCase()){
                case "true": case "yes": case "1": return true;
                case "false": case "no": case "0": case null: return false;
                default: return Boolean(string);
        }
	}

})( jQuery );