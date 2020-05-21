!function(e,n){"function"==typeof define&&define.amd?define(n):"object"==typeof exports?module.exports=n(require,exports,module):e.pi_popup_fire=n()}(this,function(e,n,o){return function(e,n){"use strict";function o(e,n){return"undefined"==typeof e?n:e}function i(e){var n=24*e*60*60*1e3,o=new Date;return o.setTime(o.getTime()+n),"; expires="+o.toUTCString()}function t(){s()||(L.addEventListener("mouseleave",u),L.addEventListener("mouseenter",r),L.addEventListener("keydown",c))}function u(e){e.clientY>k||(D=setTimeout(m,y))}function r(){D&&(clearTimeout(D),D=null)}function c(e){g||e.metaKey&&76===e.keyCode&&(g=!0,D=setTimeout(m,y))}function d(e,n){return a()[e]===n}function a(){for(var e=document.cookie.split("; "),n={},o=e.length-1;o>=0;o--){var i=e[o].split("=");n[i[0]]=i[1]}return n}function s(){return d(T,"true")&&!v}function m(){s()||(e&&(e.style.display="block"),E(),f())}function f(e){var n=e||{};"undefined"!=typeof n.cookieExpire&&(b=i(n.cookieExpire)),n.sitewide===!0&&(w=";path=/"),"undefined"!=typeof n.cookieDomain&&(x=";domain="+n.cookieDomain),"undefined"!=typeof n.cookieName&&(T=n.cookieName),document.cookie=T+"=true"+b+x+w,L.removeEventListener("mouseleave",u),L.removeEventListener("mouseenter",r),L.removeEventListener("keydown",c)}var l=n||{},v=l.aggressive||!1,k=o(l.sensitivity,20),p=o(l.timer,1e3),y=o(l.delay,0),E=l.callback||function(){},b=i(l.cookieExpire)||"",x=l.cookieDomain?";domain="+l.cookieDomain:"",T=l.cookieName?l.cookieName:"viewedOuibounceModal",w=l.sitewide===!0?";path=/":"",D=null,L=document.documentElement;setTimeout(t,p);var g=!1;return{fire:m,disable:f,isDisabled:s}}});

(function( $ ) {
	'use strict';

	$(document).ready(function($) {

		setTimeout(function(){ 
			//$("body").addClass('pi_popup_popup_open');
		}, 1000);



		$('html').on("click touchstart", function(){
		  $("body").removeClass('pi_popup_popup_open');
		});
		$('.pi_popup_popup').on("click touchstart", function(event){
		    event.stopPropagation();
		});




		var $pi_popup_popup = $( ".pi_popup_popup" );
		$pi_popup_popup.find( ".pi_popup_form" ).submit(function( event ) {
			event.preventDefault();

			if ( $pi_popup_popup.hasClass('pi_popup_form_success') ) {
				return false;
			}

			$pi_popup_popup.addClass('pi_popup_form_loading');


			$.ajax({
				url: pi_popup_behavior.ajax_url,
				type: 'POST',
				data: {
					email: $('.pi_popup_subscribe_input').val(),
					token: $('#token').val(),
					action: 'pi_popup_save_subscriber'
				},
			})
			.done(function(data) {

				$pi_popup_popup.removeClass('pi_popup_form_loading');

				if ( data.success == true ) {

					$pi_popup_popup.addClass('pi_popup_form_success');

				}else{

					$pi_popup_popup.addClass('pi_popup_form_error');

				}

			})
			.fail(function() {
				$pi_popup_popup.removeClass('pi_popup_form_loading');
				$pi_popup_popup.addClass('pi_popup_form_error');
			});

		});// submit






	});//DOM ready

	var pi_popup = pi_popup_fire(document.getElementById(''), {
	delay: parseInt( pi_popup_behavior.delay ),
	timer: parseInt( pi_popup_behavior.timer ),
	sensitivity: parseInt( pi_popup_behavior.sensitivity ),
	cookie_expiration: parseInt( pi_popup_behavior.cookie_expiration ),
	aggressive: stringToBoolean( pi_popup_behavior.aggressive_mode ),
	cookieName: pi_popup_behavior.cookie_name,
	callback: function() {
		$("body").addClass('pi_popup_popup_open');
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