(function( $ ) {
	'use strict';

	jQuery( document ).ready( function( $ ) {



	    var $template_preview_slider = $('.lead_captor_template_preview');
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
	        }).flickity( 'select', parseInt( lead_captor_var.template - 1 ) );
	        var template_preview_slider_data = $template_preview_slider.data('flickity');
	    }); //images loaded

	    var $template_slider = $('.lead_captor_templates_wrapper');
	    $template_slider.imagesLoaded({
	        background: false
	    }, function($images, $proper, $broken) {

	        $template_slider.flickity({
	            contain: true,
	            cellSelector: '.slide',
	            cellAlign: 'left',
	            prevNextButtons: false,
	            pageDots: false,
	            asNavFor: '.lead_captor_template_preview',
	            arrowShape: {
	                x0: 10,
	                x1: 60,
	                y1: 50,
	                x2: 65,
	                y2: 45,
	                x3: 20
	            }
	        }).flickity( 'select', parseInt( lead_captor_var.template - 1 ) );
	        var template_slider_data = $template_slider.data('flickity');
	    }); //images loaded




	    $("body").on('click', '.lead_captor_templates_wrapper .slide', function(event) {
	    	event.preventDefault();
	    	/* Act on the event */
	    	$('.lead_captor_templates_wrapper .slide').removeClass('template-selected');
	    	$(this).addClass('template-selected');
	    	$("#lead_captor_popup_templates").val( $(this).attr('data-id') );
	    });


	    /* Live editing on preview */
	    $('#lead_captor_popup_title').bind('keyup change', function() {
		    $('.lead_captor_template_preview .lead_captor_title').text(this.value);
		});
		$('#lead_captor_popup_subtitle').bind('keyup change', function() {
		    $('.lead_captor_template_preview .lead_captor_subtitle').text(this.value);
		});
		$('#lead_captor_popup_content').bind('keyup change', function() {
		    $('.lead_captor_template_preview .lead_captor_content').html(this.value);
		});
		$('#lead_captor_popup_button_text').bind('keyup change', function() {
		    $('.lead_captor_template_preview .lead_captor_subscribe_btn').text(this.value);
		});
		$('#lead_captor_popup_placeholder').bind('keyup change', function() {
		    $('.lead_captor_template_preview .lead_captor_subscribe_input').attr('placeholder', this.value);
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

	                    $('#lead_captor_popup_image').val(attachment.id);

	                    $('.custom_media_url').val(attachment.url);

	                    $('#lead_captor_image_preview').attr('src',attachment.url).css('display','block');

	                    $('.lead_captor_template_preview .lead_captor_image img').attr('src',attachment.url);

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
	    $(".edit-php.post-type-lead-subscriber .tablenav.top .actions:nth-child(2)").after('<div class="alignleft"><a class="button" href="' + lead_captor_var.settings_page + '">' + lead_captor_var.export_text + '</a></div>');

	    //Add Quema Labs logo in Admin page
	    $(".tools_page_lead-captor-admin .lead_captor_admin > h2:first-child").append('<a href="https://www.quemalabs.com" class="ql_logo" target="_blank"><img src="' + lead_captor_var.image_url + 'quema-labs.png"></a>');


	});// on ready

})( jQuery );
