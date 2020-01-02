<?php
function sogo_signup() {

	$posted_data = isset( $_POST ) ? $_POST : array();
	$file_data   = isset( $_FILES ) ? $_FILES : array();

	$data = array_merge( $posted_data, $file_data );

	if ( username_exists( $data['phone'] ) || email_exists( $data['email'] ) ) {
		wp_send_json_error( __( 'User is already exists, please go to LOGIN page', 'sogoc' ) );
	}

	if ( ! wp_verify_nonce( $data['nonce'], 'sogo-signup' ) ) {
		wp_send_json_error( __( 'Permission denied', 'sogoc' ) );
	}

	// CAN BE DELETED IF WE WANT SIGNUP WITH USERNAME & PASSWORD
	if ( ! sogo_get_signcode( $data['phone'], $data['code'] ) ) {
		wp_send_json_error( __( 'Code is not valid', 'sogoc' ) );
	}

	unset( $data['nonce'] );

	$userdata = array(
		'role'         => $data['type'],
		'user_login'   => $data['phone'],    // SHOULD BE 'display_name' FOR REGULAR LOGIN
		'display_name' => $data['type'] === 'family' ? $data['contact_person'] : $data['first_name'] . ' ' . $data['last_name'],
		'first_name'   => $data['first_name'],
		'last_name'    => $data['last_name'],
		'user_email'   => $data['email'],
//		'user_pass'    => $data['password']
	);
	$user_id  = wp_insert_user( $userdata );

	if ( is_wp_error( $user_id ) ) {
		wp_send_json_error( $user_id->get_error_message() );
		die();
	}

	if ( $data['type'] === 'therapist' ) {
		$post    = array(
			'post_type'    => 'therapists',
			'post_title'   => $data['first_name'] . ' ' . $data['last_name'],
			'post_content' => '',
			'post_status'  => $data['account_active'],
			'post_author'  => $user_id,
		);
		$post_id = wp_insert_post( $post );


		if ( is_wp_error( $post_id ) ) {
			wp_delete_user( $user_id );
			wp_send_json_error( $post_id->get_error_message() );
			die();
		}


		foreach ( $data as $key => $value ) {
			update_post_meta( $post_id, '_sogo_' . $key, $value );
		}

		// connect user to his new post
		update_user_meta( $user_id, '_sogo_therapist_post', $post_id );

		if ( isset( $data['avatar'] ) && ! empty( $data['avatar'] ) ) {
			upload_user_image( $data['avatar'], $post_id );
		}

	} elseif ( $data['type'] === 'family' ) {

		foreach ( $data as $key => $value ) {
			update_user_meta( $user_id, '_sogo_' . $key, $value );
		}

	}

	wp_clear_auth_cookie();
	wp_set_current_user( $user_id );
	wp_set_auth_cookie( $user_id );
//	wp_new_user_notification( $user_id, null, 'both' );
	wp_send_json_success( __( 'User register successfully', 'sogoc' ) );

	die();
}

add_action( 'wp_ajax_sogo_signup', 'sogo_signup' );
add_action( 'wp_ajax_nopriv_sogo_signup', 'sogo_signup' );

function sogo_update_profile() {
	$posted_data = isset( $_POST ) ? $_POST : array();
	$file_data   = isset( $_FILES ) ? $_FILES : array();

	$data = array_merge( $posted_data, $file_data );

	if ( ! wp_verify_nonce( $data['nonce'], 'sogo-profile' ) ) {
		wp_send_json_error( __( 'Permission denied', 'sogoc' ) );
	}

	unset( $data['nonce'] );

	$user_id = get_current_user_id();

	if ( $data['type'] === 'therapist' ) {

		$post_id = get_user_meta( $user_id, '_sogo_therapist_post', true );

		foreach ( $data as $key => $value ) {
			sogo_update_phone( $key, $value, $user_id );
			update_post_meta( $post_id, '_sogo_' . $key, $value );
		}

		if ( isset( $data['avatar'] ) && ! empty( $data['avatar'] ) ) {
			upload_user_image( $data['avatar'], $post_id );
		}

		wp_update_post( array(
			'ID'          => $post_id,
			'post_status' => $data['account_active']
		) );
	} elseif ( $data['type'] === 'family' ) {

		foreach ( $data as $key => $value ) {
			sogo_update_phone( $key, $value, $user_id );
			update_user_meta( $user_id, '_sogo_' . $key, $value );
		}

	}
	wp_send_json_success( __( 'Profile update successfully', 'sogoc' ) );
	die();
}

add_action( 'wp_ajax_sogo_update_profile', 'sogo_update_profile' );
add_action( 'wp_ajax_nopriv_sogo_update_profile', 'sogo_update_profile' );

function sogo_signin() {

	$data = $_POST;


	// CAN BE DELETED IF WE WANT SIGNUP WITH USERNAME & PASSWORD
	if ( ! sogo_get_signcode( $data['phone'], $data['code'] ) ) {
		wp_send_json_error( __( 'Code is not valid', 'sogoc' ) );
	}
	if ( ! username_exists( $data['phone'] ) ) {
		wp_send_json_error( __( 'User is not exists, please sign up first', 'sogoc' ) );
	}


	if ( ! wp_verify_nonce( $data['nonce-signin'], 'sogo-signin' ) ) {
		wp_send_json_error( __( 'Permission denied', 'sogoc' ) );
	}


//	$creds = array();
//	$creds['user_login']    = $data['username'];
//	$creds['user_password'] = $data['password'];
//	$creds['remember']   = $data['remember_password'];
//	$user                = wp_signon( $creds, false );

	$user = get_user_by( 'login', $data['phone'] );
	if ( is_wp_error( $user ) ) {
		wp_send_json_error( __( 'Wrong username / password', 'sogoc' ) );
	} else {
		wp_clear_auth_cookie();
		wp_set_current_user( $user->ID );
		wp_set_auth_cookie( $user->ID );
//		do_action( 'wp_login', $user->user_login );

		wp_send_json_success( __( 'User signin successfully', 'sogoc' ) );
	}

	die();
}

add_action( 'wp_ajax_sogo_signin', 'sogo_signin' );
add_action( 'wp_ajax_nopriv_sogo_signin', 'sogo_signin' );

function sogo_reset_password() {
	$x = sogo_send_sms( 'Hello', '0526680171' );
	var_dump( $x );
	die();
	$data = $_POST;

	if ( ! wp_verify_nonce( $data['nonce-resetpassword'], 'sogo-resetpassword' ) ) {
		wp_send_json_error( __( 'Permission denied', 'sogoc' ) );
	}

	$email = trim( $data['email'] );

	if ( empty( $email ) ) {
		wp_send_json_error( __( 'Email or username is required', 'sogoc' ) );
	} else if ( ! is_email( $email ) ) {
		wp_send_json_error( __( 'Invalid username or e-mail address', 'sogoc' ) );
	} else if ( ! email_exists( $email ) ) {
		wp_send_json_error( __( 'There is no user registered with that email address', 'sogoc' ) );
	} else {

		$random_password = wp_generate_password( 12, false );
		$user            = get_user_by( 'email', $email );

		$update_user = wp_update_user( array(
				'ID'        => $user->ID,
				'user_pass' => $random_password
			)
		);

		// if  update user return true then lets send user an email containing the new password
		if ( $update_user ) {
			$to      = $email;
			$subject = 'Your new password';
			$sender  = get_option( 'name' );

			$message = 'Your new password is: ' . $random_password;

			$headers[] = 'MIME-Version: 1.0' . "\r\n";
			$headers[] = 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			$headers[] = "X-Mailer: PHP \r\n";
			$headers[] = 'From: ' . $sender . ' < ' . $email . '>' . "\r\n";

			$mail = wp_mail( $to, $subject, $message, $headers );
			if ( $mail ) {
				wp_send_json_success( __( 'Check your email address for you new password', 'sogoc' ) );
			}

		} else {
			wp_send_json_error( __( 'Oops something went wrong updaing your account', 'sogoc' ) );
		}

	}


//	$user_id = wp_insert_user( $userdata );
//
//	if ( is_wp_error( $user_id ) ) {
//		wp_send_json_error( $user_id->get_error_message() );
//	} else {
//		wp_clear_auth_cookie();
//		wp_set_current_user( $user_id );
//		wp_set_auth_cookie( $user_id );
//		wp_send_json_success( __( 'User register successfully', 'sogoc' ) );
//	}


	die();
}

add_action( 'wp_ajax_sogo_reset_password', 'sogo_reset_password' );
add_action( 'wp_ajax_nopriv_sogo_reset_password', 'sogo_reset_password' );

function sogo_contact_frontpage() {

	$data = $_POST;


	$to      = get_field( '_sogo_frontpage_contant_mailto', 'option' );
	$subject = get_field( '_sogo_frontpage_contant_subject', 'option' );
	$message = '';
	foreach ( $data as $key => $value ) {
		$message .= $key . ': ' . $value . "\n";
	}
	if ( ! $to ) {
		wp_send_json_error( __( 'No recipients', 'sogoc' ) );
		die();
	}

	$headers = array(
		'Content-Type: text/html; charset=UTF-8',
		'From: No-Reply ' . get_bloginfo( "name" ) . ' <noreply@seiva.com>',
		'Reply-To: noreply@' . site_url( "/" ) . '',
		'X-Mailer: PHP/' . phpversion()
	);
	wp_mail( $to, $subject, $message, $headers );
	wp_send_json_success( __( 'Message sent successfully', 'sogoc' ) );
	die();
}

add_action( 'wp_ajax_sogo_contact_frontpage', 'sogo_contact_frontpage' );
add_action( 'wp_ajax_nopriv_sogo_contact_frontpage', 'sogo_contact_frontpage' );

function sogo_set_validate_buy_phone() {

	$data = $_POST;

	$phone_valid = sogo_validate_phone( $data['phone'] );

	if ( ! $phone_valid ) {
		wp_send_json_error( __( 'Phone is not valid', 'sogoc' ) );
	}

	sogo_set_signcode( $data['phone'] );

	wp_send_json_success( __( 'Message sent successfully', 'sogoc' ) );
	die();
}

add_action( 'wp_ajax_sogo_set_validate_buy_phone', 'sogo_set_validate_buy_phone' );
add_action( 'wp_ajax_nopriv_sogo_set_validate_buy_phone', 'sogo_set_validate_buy_phone' );


function sogo_send_code_again() {

	$phone = sanitize_text_field( $_POST['phone'] );

	global $wpdb;
	$table   = 'signcodes'; //$wpdb->prefix . ;
	$results = $wpdb->get_row( "SELECT * FROM $table WHERE phone=$phone" );

	$message = __( 'Your code is' ) . ': ' . $results->code;

	sogo_send_sms( $message, $phone );

	wp_send_json_success( __( 'Code sent again, we disabled the button to prevent spam', 'sogoc' ) );
	die();
}

add_action( 'wp_ajax_sogo_send_code_again', 'sogo_send_code_again' );
add_action( 'wp_ajax_nopriv_sogo_send_code_again', 'sogo_send_code_again' );
