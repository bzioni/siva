<?php
function sogo_isset( $param, $to_compare = false, $return_value = false ) {

	if ( ! isset( $_GET[ $param ] ) || empty( $_GET[ $param ] ) ) {
		return false;
	}
	if ( $to_compare ) {
		return $_GET[ $param ] == $to_compare;
	}

	if ( $return_value ) {
		return $_GET[ $param ];
	}

	return true;

}

function is_odd( $number ) {
	return $number % 2 !== 0;
}

function sogo_is_checked( $checkbox ) {
	return $checkbox === 'true';
}

function sogo_get_post_meta_value( $param, $single = true ) {
	$post_id = get_query_var( 'post_id' );
	if ( ! $post_id ) {
		return '';
	}

	return get_post_meta( $post_id, '_sogo_' . $param, $single );
}

function sogo_get_user_meta_value( $param, $single = true ) {
	$user_id = get_current_user_id();
	if ( ! $user_id ) {
		return '';
	}

	return get_user_meta( $user_id, '_sogo_' . $param, $single );
}

function upload_user_image( $image, $post_id ) {
	$file_return = wp_handle_upload( $image, array( 'test_form' => false ) );
	if ( ! isset( $file_return['error'] ) || ! isset( $file_return['upload_error_handler'] ) ) {
		$filename      = $file_return['file'];
		$attachment    = array(
			'post_mime_type' => $file_return['type'],
			'post_title'     => preg_replace( '/\.[^.]+$/', '', basename( $filename ) ),
			'post_content'   => '',
			'post_status'    => 'inherit',
			'guid'           => $file_return['url']
		);
		$attachment_id = wp_insert_attachment( $attachment, $file_return['url'] );
		require_once( ABSPATH . 'wp-admin/includes/image.php' );
		$attachment_data = wp_generate_attachment_metadata( $attachment_id, $filename );
		wp_update_attachment_metadata( $attachment_id, $attachment_data );
		if ( 0 < intval( $attachment_id ) ) {
			set_post_thumbnail( $post_id, $attachment_id );
		}
	}

}

function get_user_role( $user_id ) {
	$user_meta  = get_userdata( $user_id );
	$user_roles = $user_meta->roles;

	if ( ! $user_roles['0'] ) {
		return false;
	}

	return $user_roles['0'];
}

function is_user_type( $user_id, $types = array() ) {
	return in_array( $user_id, $types );
}

/*
 * PROVIDER: https://www.inforu.co.il/wp-content/uploads/2019/12/SMS_UAPI-5.4.pdf
 * Returns array with response:
 * @param Status
 * @param Description
 * @param NumberOfRecipients
 */
function sogo_send_sms( $message_text, $recipients ) {
	$sms_user     = "Askedinia";
	$sms_apitoken = "bo4huiqhbugoyhe60jncq3hd0";
	$sms_sender   = "Seiva";

	$message_text = preg_replace( "/\r|\n/", "", $message_text ); // remove line breaks
	$xml          = '';
	$xml          .= '<Inforu>' . PHP_EOL;
	$xml          .= ' <User>' . PHP_EOL;
	$xml          .= ' <Username>' . htmlspecialchars( $sms_user ) . '</Username>' . PHP_EOL;
	$xml          .= ' <ApiToken>' . htmlspecialchars( $sms_apitoken ) . '</ApiToken>' . PHP_EOL;
	$xml          .= ' </User>' . PHP_EOL;
	$xml          .= ' <Content Type="sms">' . PHP_EOL;
	$xml          .= ' <Message>' . htmlspecialchars( $message_text ) . '</Message>' . PHP_EOL;
	$xml          .= ' </Content>' . PHP_EOL;
	$xml          .= ' <Recipients>' . PHP_EOL;
	$xml          .= ' <PhoneNumber>' . htmlspecialchars( $recipients ) . '</PhoneNumber>' . PHP_EOL;
	$xml          .= ' </Recipients>' . PHP_EOL;
	$xml          .= ' <Settings>' . PHP_EOL;
	$xml          .= ' <Sender>' . htmlspecialchars( $sms_sender ) . '</Sender>' . PHP_EOL;
	$xml          .= ' </Settings>' . PHP_EOL;
	$xml          .= '</Inforu>';
	$ch           = curl_init();
	curl_setopt( $ch, CURLOPT_URL, 'https://uapi.inforu.co.il/SendMessageXml.ashx' );
	curl_setopt( $ch, CURLOPT_POST, true );
	curl_setopt( $ch, CURLOPT_POSTFIELDS, 'InforuXML=' . urlencode( $xml ) );
	curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
	$response = curl_exec( $ch );
	curl_close( $ch );

	// convert xml to array
	$xml  = simplexml_load_string( $response );
	$json = json_encode( $xml );
	$arr  = json_decode( $json, true );

	return $arr;
}

function sogo_set_signcode( $phone ) {
	$code    = rand( 1000, 10000 );
	$message = __( 'Your code is' ) . ': ' . $code;
	global $wpdb;
	$table = 'signcodes'; //$wpdb->prefix . ;

	$results = $wpdb->get_row( "SELECT * FROM $table WHERE phone=$phone" );
	if ( $results ) {
		$wpdb->delete( $table, array( 'id' => $results->id ) );
	}

	$wpdb->insert( $table, array(
		'phone' => $phone,
		'code'  => $code
	) );
	sogo_send_sms( $message, $phone );
}

function sogo_get_signcode( $phone, $code, $delete = true ) {
	global $wpdb;
	$table   = 'signcodes'; //$wpdb->prefix . ;
	$results = $wpdb->get_row( "SELECT * FROM $table WHERE phone=$phone AND code=$code" );

	if ( $results ) {
		if ( $delete ) {
			$wpdb->delete( $table, array( 'id' => $results->id ) );
		}

		return true;
	}

	return false;
}

function sogo_validate_phone( $phone ) {
	if ( ! isset( $phone ) || empty( $phone ) ) {
		return false;
	}

	// Same regex as forms.js
	$re  = '/^0(5[^8]|[2-4]|[8-9]|7[0-9])[0-9]{7}$/i';
	$str = $phone;

	preg_match_all( $re, $str, $matches, PREG_SET_ORDER, 0 );

	return $matches;
}


function sogo_update_phone( $key, $value, $user_id ) {
	if ( $key === 'phone' ) {
		$current_username_phone = get_user_by( 'id', $user_id )->user_login;

		if ( $value === $current_username_phone ) {
			return;
		}

		if ( $value != $current_username_phone ) {
			if ( ! username_exists( $value ) ) {
				global $wpdb;
				$sql = "UPDATE {$wpdb->users} SET user_login = %s WHERE ID = %d";
				$sql = $wpdb->prepare( $sql, $value, $user_id );
				$wpdb->query( $sql );
			} else {
				wp_send_json_error( __( 'Username already exists', 'sogoc' ) );
			}
		}
	}
}
