<?php

function sogo_acf_init() {
	if ( function_exists( 'acf_add_options_page' ) ) {

		acf_add_options_page(
			array(
				'page_title' => 'Sogo settings',
				'menu_title' => 'Sogo settings',
				'menu_slug'  => 'theme-general-settings',
			)
		);

		acf_add_options_sub_page(
			array(
				'menu_title'  => 'General',
				'page_title'  => 'General',
				'parent_slug' => 'theme-general-settings',
			)
		);
		acf_add_options_sub_page(
			array(
				'page_title'  => 'Archive',
				'menu_title'  => 'Archive',
				'parent_slug' => 'theme-general-settings',
			)
		);



	}
}

add_action( 'acf/init', 'sogo_acf_init' );
