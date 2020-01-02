<?php

function sogo_get_post_types() {
	return array(

		array(
			'type'         => 'therapists',
			'label'        => __( 'Therapists', 'sogoc' ),
			'menu_icon'    => 'dashicons-editor-code',
			'hierarchical' => true,
			'rewrite'      => array( 'slug' => 'therapists' ),
			'supports'     => array(
				'title',
				'editor',
				'excerpt',
				'thumbnail',
			)
		),


	);


}

function sogo_get_taxonomies() {
	return array(
//		array(
//			'label'     => __( 'Type', 'sogoc' ),
//			'slug'      => 'projects-type',
//			'name'      => 'type',
//			'post_type' => 'projects'
//		),
	);

}

