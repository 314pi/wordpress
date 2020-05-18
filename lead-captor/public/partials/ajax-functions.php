<?php
if( 'POST' == $_SERVER['REQUEST_METHOD'] && ! empty( $_POST['action'] )) {

	$token = $_POST['token'];
	if( wp_verify_nonce( $token, 'lead-captor-secret' ) ){

		$email = sanitize_email( $_POST['email'] );

		$post = array(
		  'post_title'    => $email,
		  'post_content'  => $email,
		  'post_status'   => 'publish',
		  'post_type'     => 'lead-subscriber',
		);
		 
		// Insert the post into the database
		$post_result = wp_insert_post( $post, true );

		if ( is_wp_error( $post_result ) ) {

			wp_send_json_error( $post_result );

		}else{

			//Mail Chimp
			if ( ! empty( $this->mailchimp_options['lead_captor_mailchimp_list'] ) && '0' != $this->mailchimp_options['lead_captor_mailchimp_list'] ) {

				$Lead_Captor_MailChimp = new Lead_Captor_MailChimp( $this->mailchimp_options['lead_captor_mailchimp_api_key'] );
				$list_id = $this->mailchimp_options['lead_captor_mailchimp_list'];

				$result = $Lead_Captor_MailChimp->post( "lists/$list_id/members", [
								'email_address' => $email,
								'status'        => 'subscribed',
							] );
			}

			wp_send_json_success( $post_result );

		}		

	}else{

		wp_send_json_error( 'Invalid Nonce' ); //This do not render to the front-end

	}//end token

} // end IF
