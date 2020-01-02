<?php

/*
 * debug a given object in a nice way
 *
 * */
function debug( $obj ) {
	echo "<pre dir='lrt' style='text-align:left'>";
	var_dump( $obj );
	echo "</pre>";
}


$sogo_includes = array(

	'admin/admin.php',                              // Admin functions
	'lib/enqueue.php',                              // load scripts
	'lib/post-types.php',                           // register post type
	'lib/extras.php',                               // Sogo custom functions
	'lib/excerpt.php',                              // Initial theme setup and constants
	'lib/widget.php',                               // Initial theme setup and constants
	'lib/helpers.php',                              // helpers
	'lib/shortcodes.php'                                   // advanced custom fields
);
sogo_include( $sogo_includes );


function sogo_main_class_autoload( $sogo_includes ) {

	foreach ( glob( dirname( __FILE__ ) . "/lib/class/*.php" ) as $filename ) {
		$sogo_includes[] = "lib/class/" . basename( $filename );
	}

	// parent function.
	return $sogo_includes;
}

function sogo_include( $sogo_includes ) {

	foreach ( $sogo_includes as $file ) {
		if ( ! $filepath = locate_template( $file ) ) {
			trigger_error( sprintf( __( 'Error locating %s for include', 'sogo' ), $file ), E_USER_ERROR );
		}
		require_once $filepath;
	}
	unset( $file, $filepath );
}


function sogo_theme_setup() {
	// load text domain
	load_theme_textdomain( 'sogo', get_template_directory() . '/languages' );

}

add_action( 'after_setup_theme', 'sogo_theme_setup' );


/**
 * sogo text
 */
add_filter( 'sogo_text', 'wptexturize' );
add_filter( 'sogo_text', 'convert_smilies' );
add_filter( 'sogo_text', 'convert_chars' );
add_filter( 'sogo_text', 'wpautop' );
add_filter( 'sogo_text', 'shortcode_unautop' );
add_filter( 'sogo_text', 'do_shortcode' );




//function sogo_add_wp_adminbar(){
//	if(current_user_can('manage_options') && !is_admin_bar_showing() && !is_admin()){
//		include get_template_directory() . '/templates/content-admin-btn.php';
//	}
//}
//add_action( 'wp_footer', 'sogo_add_wp_adminbar' );
