<?php
/*
 *  This file handle only enqueue scripts and style for the parent theme
 * expose:
 *  add_action( 'wp_enqueue_scripts', 'sogo_load_fancybox' );
 *  add_action( 'wp_enqueue_scripts', 'sogo_load_bxslider' );
 *  add_action( 'wp_enqueue_scripts', 'sogo_load_lightbox' );
 * */
function sogo_scripts() {
	if ( ! is_admin() ) {
		$ver = uniqid();

		// enqueue to header
		wp_enqueue_script( 'jquery' );
		wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/dist/style.css', '', $ver );
		wp_enqueue_script( 'parent-scripts', get_template_directory_uri() . '/dist/bundle.js', array( 'jquery' ), $ver, false );



		// Enable threaded comments
		if ( ( ! is_admin() ) && is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

		wp_localize_script( 'parent-scripts', 'sogo', array(
			'ajaxurl' => admin_url( 'admin-ajax.php' ),
		) );

	}
}

add_action( 'wp_enqueue_scripts', 'sogo_scripts' );


function sogo_add_mce_button() {
	if ( !current_user_can( 'edit_posts' ) &&  !current_user_can( 'edit_pages' ) ) {
		return;
	}
	if ( 'true' == get_user_option( 'rich_editing' ) ) {
		add_filter( 'mce_external_plugins', 'sogo_add_tinymce_plugin' );
		add_filter( 'mce_buttons', 'sogo_register_mce_button' );
	}
}
add_action('admin_head', 'sogo_add_mce_button');

function sogo_register_mce_button( $buttons ) {
	array_push( $buttons, 'sogo_lorem_ipsum' );
	return $buttons;
}


function sogo_add_tinymce_plugin( $plugin_array ) {
	$plugin_array['sogo_lorem_ipsum'] = get_template_directory_uri() .'/src/js/sogo-lorem-ipsum.js';
	return $plugin_array;
}
