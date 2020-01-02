<?php

include 'lib/helpers.php';
include 'lib/ajax-requests.php';

function sogo_class_autoload() {

	$sogo_includes = array();
	$sogo_includes = sogo_main_class_autoload( $sogo_includes );
	foreach ( glob( __DIR__ . "/lib/class/*.php" ) as $filename ) {
		$sogo_includes[] = "lib/class/" . basename( $filename );
	}
	// parent function.
	sogo_include( $sogo_includes );

}

function sogo_print_script( $key ) {
	if ( function_exists( 'have_rows' ) ) {
		while ( have_rows( $key, 'option' ) ): the_row();
			echo PHP_EOL . "<!--    " . get_sub_field( 'name' ) . "        -->" . PHP_EOL;
			the_sub_field( 'scripts', false );
			echo PHP_EOL . "<!--   END -  " . get_sub_field( 'name' ) . "        -->" . PHP_EOL;
		endwhile;
	}

}

function sogo_child_theme_setup() {

	load_child_theme_textdomain( 'sogoc', get_stylesheet_directory() . '/languages' );


	// load external files
	$sogo_includes = array(
		'lib/init.php',
		'lib/widget.php',
		'lib/post-type-init.php',
		'lib/acf-init.php',
		'lib/extras.php',
		'lib/walkers.php',
	);
	//parent function.
	sogo_include( $sogo_includes );
	sogo_class_autoload();

	if ( ! current_user_can( 'administrator' ) && ! is_admin() ) {
		show_admin_bar( false );
	}
}

add_action( 'after_setup_theme', 'sogo_child_theme_setup' );

function sogo_child_scripts() {
	$ver = uniqid();
	if ( ! is_admin() ) {

		wp_enqueue_style( 'child-style', get_stylesheet_uri(), '', $ver );
		wp_enqueue_script( 'child-scripts', get_stylesheet_directory_uri() . '/bundle.js', array( 'jquery' ), $ver, true );

		wp_localize_script( 'child-scripts', 'sogoc', array(
			'rtl'            => is_rtl() ? 'true' : 'false',
			'thank_you_page' => get_field( '_sogo_link_thanks_page', 'option' ),
			'locale'         => function_exists( 'wpm_language_switcher' ) ? wpm_get_language() : 'he'
		) );

	}
}

add_action( 'wp_enqueue_scripts', 'sogo_child_scripts', 10 );


function sogo_add_atts_to_cf7( $out, $pairs, $atts ) {
	$my_atts = array( 'arrival_source' );

	foreach ( $my_atts as $my_att ) {
		if ( isset( $atts[ $my_att ] ) ) {
			$out[ $my_att ] = $atts[ $my_att ];
		}
	}

	return $out;
}

add_filter( 'shortcode_atts_wpcf7', 'sogo_add_atts_to_cf7', 10, 3 );


//function sogo_save_lead( $cf7 ) {
//	return false;
//	$submission = WPCF7_Submission::get_instance();
//	if ( $submission ) {
//		$formdata = $submission->get_posted_data();
//		$name     = isset( $formdata['fname'] ) ? $formdata['fname'] : $formdata['full-name'];
//		$email    = isset( $formdata['your-email'] ) ? $formdata['your-email'] : $formdata['email'];
//		$phone    = isset( $formdata['your-phone'] ) ? $formdata['your-phone'] : $formdata['phone'];
//		$comments = isset( $formdata['info'] ) ? $formdata['info'] : '';
//	}
//}
//add_action( 'wpcf7_mail_sent', 'sogo_save_lead' );

function sogo_create_theme() {
	// create general page
	wp_insert_post( array(
		'post_title'   => __( 'General page', 'sogoc' ),
		'post_content' => file_get_contents( __DIR__ . '/assets/general.txt' ),
		'post_type'    => 'page',
		'post_status'  => 'publish',
	) );
}


add_filter( 'acf/settings/save_json', 'my_acf_json_save_point' );

function my_acf_json_save_point( $path ) {

	// update path
	$path = get_stylesheet_directory() . '/acf-json';


	// return
	return $path;

}

function sogo_save_acf_group( $post_id ) {
//	if(wp_is_post_revision($post_id) || wp_is_post_autosave($post_id)) {
//		var_export('in');
//		die();
//	}
	if ( get_post_type( $post_id ) === 'acf-field-group' ) {
		// Set this variable to false initially.
		static $updated = false;
		// If title has already been set once, bail.
		if ( $updated ) {
			return;
		}
		$updated = true;

		$title = get_the_title( $post_id );
		$date  = date( 'd-m-y' );
		$title = $title . ' | ' . $date;
		if ( isset( $_POST['action'] ) && $_POST['action'] === 'editpost' ) {
			// Return the part of the string starting at the beginning and ending at the position where you first encounter the deliminator.
			$current_title = substr( $title, 0, strpos( $title, "|" ) );
			if ( $current_title ) {
				$title = $current_title . '| ' . $date;
			}
		}
		$post = array(
			'ID'         => $post_id,
			'post_title' => $title,
		);
		wp_update_post( $post );
	}
}

add_action( 'save_post', 'sogo_save_acf_group' );


function get_page_url_by_template_name( $TEMPLATE_NAME ) {
	$url   = null;
	$pages = get_pages( array(
		'meta_key'   => '_wp_page_template',
		'meta_value' => $TEMPLATE_NAME
	) );
	if ( isset( $pages[0] ) ) {
		$url = get_page_link( $pages[0]->ID );
	}

	return $url;
}

add_role( 'family', __( 'Family', 'sogoc' ), array( 'subscriber' ) );
add_role( 'therapist', __( 'Therapist', 'sogoc' ), array( 'subscriber' ) );


function search_filter( $query ) {
	if ( ! is_admin() && is_post_type_archive( 'therapists' ) && $query->is_main_query() ) {
		$query->set( 'posts_per_page', 15 );

		if ( $_GET ) {
			$args = array();
			$meta = array();


			foreach ( $_GET as $key => $param ) {
				if ( preg_match( '/flr_/', $key ) && $param ) {

					$param = esc_attr( $param );
//					switch ( $key ) {
//						case 'flr_author':
//							$query->set( 'author__in', array( $param ) );
//							break;
//						case 'flr_specialization':
//							$meta[] = array(
//								'key'     => '_sogo_specializtion_cat',
//								'value'   => $param,
//								'compare' => '=',
//							);
//							break;
//						case 'flr_industry':
//							$meta[] = array(
//								'key'     => '_sogo_industry',
//								'value'   => $param,
//								'compare' => '=',
//							);
//							break;
//						case 'flr_language':
//							$meta[] = array(
//								'key'     => '_sogo_language',
//								'value'   => $param,
//								'compare' => '=',
//							);
//							break;
//						case 'flr_start':
//							$date[] = array(
//								'after'     => $param,
//								'inclusive' => true,
//							);
//							break;
//						case 'flr_end':
//							$date[] = array(
//								'before'    => $param,
//								'inclusive' => true,
//							);
//							break;
//						case 'flr_title':
//							$args[] = array(
//								'taxonomy' => 'attorney_category',
//								'field'    => 'id',
//								'terms'    => $param,
//							);
//							break;
//						case 'flr_name':
//							$query->set( 'title', $param );
//							break;
////						default:
////							$args[] = array(
////								'taxonomy' => 'gears',
////								'field'    => 'id',
////								'terms'    => $_GET['flr_gears'],
////							);
//					}
					$meta[] = array(
						'key'     => '_sogo' . strstr( $key, '_' ),
						'value'   => $param,
						'compare' => '=',
					);

				}
			}

			if ( ! empty( $args ) ) {
				$query->set( 'tax_query', $args );
			}
			if ( ! empty( $meta ) ) {
				$query->set( 'meta_query', $meta );
			}

		}
	}
}

add_action( 'pre_get_posts', 'search_filter' );


function sogo_notices() {
	update_user_meta( get_current_user_id(), 'edit_lang', substr( get_locale(), 0, 2 ) );
//var_dump(wpm_get_language());
}

add_action( 'admin_notices', 'sogo_notices' );

//add_filter( 'acf/settings/default_language', 'my_acf_settings_default_language' );

function my_acf_settings_default_language( $language ) {
	// update_user_meta( $user_id, 'edit_lang', wpm_get_language() );
	return 'he';
}

//add_filter( 'acf/settings/current_language', 'my_acf_settings_current_language' );

function my_acf_settings_current_language( $language ) {

	var_dump( substr( get_locale(), 0, 2 ) );

	return substr( get_locale(), 0, 2 );


//	if ( ! is_admin() ) {
//		return wpm_get_language();
//	}
//
//	$lang = sogo_isset( 'lang', '', true );

}

add_action( 'init', 'sogo_logout' );
function sogo_logout() {
	if ( sogo_isset( 'logout' ) ) {
		wp_clear_auth_cookie();
		wp_redirect( site_url( "/" . wpm_get_language() ) );
		exit();
	}
}
