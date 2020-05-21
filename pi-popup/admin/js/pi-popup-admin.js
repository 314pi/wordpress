(function( $ ) {
	'use strict';

	jQuery( document ).ready( function( $ ) {



	    var $template_preview_slider = $('.pi_popup_template_preview');
	    $template_preview_slider.imagesLoaded({
	        background: false
	    }, function($images, $proper, $broken) {

	        $template_preview_slider.flickity({
	            contain: true,
	            cellSelector: '.slide',
	            cellAlign: 'left',
	            prevNextButtons: false,
	            pageDots: false,
	            draggable: false,
	            arrowShape: {
	                x0: 10,
	                x1: 60,
	                y1: 50,
	                x2: 65,
	                y2: 45,
	                x3: 20
	            }
	        }).flickity( 'select', parseInt( pi_popup_var.template - 1 ) );
	        var template_preview_slider_data = $template_preview_slider.data('flickity');
	    }); //images loaded

	    var $template_slider = $('.pi_popup_templates_wrapper');
	    $template_slider.imagesLoaded({
	        background: false
	    }, function($images, $proper, $broken) {

	        $template_slider.flickity({
	            contain: true,
	            cellSelector: '.slide',
	            cellAlign: 'left',
	            prevNextButtons: false,
	            pageDots: false,
	            asNavFor: '.pi_popup_template_preview',
	            arrowShape: {
	                x0: 10,
	                x1: 60,
	                y1: 50,
	                x2: 65,
	                y2: 45,
	                x3: 20
	            }
	        }).flickity( 'select', parseInt( pi_popup_var.template - 1 ) );
	        var template_slider_data = $template_slider.data('flickity');
	    }); //images loaded




	    $("body").on('click', '.pi_popup_templates_wrapper .slide', function(event) {
	    	event.preventDefault();
	    	/* Act on the event */
	    	$('.pi_popup_templates_wrapper .slide').removeClass('template-selected');
	    	$(this).addClass('template-selected');
	    	$("#pi_popup_popup_templates").val( $(this).attr('data-id') );
	    });


	    /* Live editing on preview */
	    $('#pi_popup_popup_title').bind('keyup change', function() {
		    $('.pi_popup_template_preview .pi_popup_title').text(this.value);
		});
		$('#pi_popup_popup_subtitle').bind('keyup change', function() {
		    $('.pi_popup_template_preview .pi_popup_subtitle').text(this.value);
		});
		$('#pi_popup_popup_content').bind('keyup change', function() {
		    $('.pi_popup_template_preview .pi_popup_content').html(this.value);
		});
		$('#pi_popup_popup_button_text').bind('keyup change', function() {
		    $('.pi_popup_template_preview .pi_popup_subscribe_btn').text(this.value);
		});
		$('#pi_popup_popup_placeholder').bind('keyup change', function() {
		    $('.pi_popup_template_preview .pi_popup_subscribe_input').attr('placeholder', this.value);
		});








	 	//Upload Image Button
		function media_upload(button_class) {

	        var _custom_media = true,

	        _orig_send_attachment = wp.media.editor.send.attachment;

	        $('body').on('click', button_class, function(e) {

	            var button_id ='#'+$(this).attr('id');

	            var self = $(button_id);

	            var send_attachment_bkp = wp.media.editor.send.attachment;

	            var button = $(button_id);

	            var id = button.attr('id').replace('_button', '');

	            _custom_media = true;

	            wp.media.editor.send.attachment = function(props, attachment){

	                if ( _custom_media  ) {

	                    $('#pi_popup_popup_image').val(attachment.id);

	                    $('.custom_media_url').val(attachment.url);

	                    $('#pi_popup_image_preview').attr('src',attachment.url).css('display','block');

	                    $('.pi_popup_template_preview .pi_popup_image img').attr('src',attachment.url);

	                } else {

	                    return _orig_send_attachment.apply( button_id, [props, attachment] );

	                }

	            }

	            wp.media.editor.open(button);

	                return false;

	        });

	    }

	    media_upload('.custom_media_button.button');


	    //Add Export CSV button on Edit Subscriber Page
	    $(".edit-php.post-type-lead-subscriber .tablenav.top .actions:nth-child(2)").after('<div class="alignleft"><a class="button" href="' + pi_popup_var.settings_page + '">' + pi_popup_var.export_text + '</a></div>');

	    //Add MagicPi logo in Admin page
	    $(".tools_page_pi-popup-admin .pi_popup_admin > h2:first-child").append('<a href="https://www.magicpi.top" class="ql_logo" target="_blank"><img src="' + pi_popup_var.image_url + 'quema-labs.png"></a>');


	});// on ready

})( jQuery );
