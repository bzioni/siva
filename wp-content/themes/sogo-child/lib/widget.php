<?php
/**
 * Register sidebars
 */
function sogo_widgets_init() {

//	register_sidebar( array(
//		'name'          => __( 'Blog', 'sogoc' ),
//		'id'            => 'articles_sidebar',
//		'before_widget' => '<aside class="widget-articles-sidebar">',
//		'after_widget'  => '</aside>',
//		'before_title'  => '<h3 class="">',
//		'after_title'   => "</h3>",
//	) );


	register_sidebar( array(
		'name'          => __( 'Footer column 1', 'sogoc' ),
		'id'            => 'footer-col-1',
		'before_widget' => '<aside>',
		'after_widget'  => '</aside>',
		'before_title'  => '',
		'after_title'   => ''
	) );

	for ( $i = 2; $i < 5; $i ++ ) {
		register_sidebar( array(
			'name'          => __( 'Footer column ' . $i, 'sogoc' ),
			'id'            => 'footer-col-' . $i,
			'before_widget' => '<aside>',
			'after_widget'  => '</aside>',
			'before_title'  => '<div class="position-relative d-flex justify-content-center justify-content-md-start js-open-footer-menu"><h5 class="h5 mb-0 text-center text-lg-right text-color-1">',
			'after_title'   => '</h3><i class="fa fa-chevron-down d-md-none m' . ( is_rtl() ? 'r' : 'l' ) . '-3"></i></div>'
		) );
	}


}

add_action( 'widgets_init', 'sogo_widgets_init' );


