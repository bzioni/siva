<?php

/**
 *  logo shortcode
 */
function sogo_print_logo( $atts ) {
	$a = shortcode_atts( array(
		'link_class'  => '',
		'image_class' => ''
	), $atts );
	ob_start();
	?>
    <a href="<?php echo get_home_url(); ?>" class="d-inline-block mb-2 <?php echo $a['link'] ?>">
        <img src="<?php echo get_stylesheet_directory_uri() . '/images/logo.png'; ?> " alt="logo" class="<?php echo $a['image'] ?>">
    </a>
	<?php
	return ob_get_clean();
}

add_shortcode( 'sogo_logo', 'sogo_print_logo' );


/**
 *  phone shortcode
 */
function sogo_print_phone( $atts ) {
	$a = shortcode_atts( array(
		'link_class'  => '',
		'icon_class'  => '',
		'phone_class' => ''
	), $atts );
	ob_start();
	if ( get_field( '_sogo_footer_phone_text', 'option' ) ) : ?>
        <a target="_blank" class="<?php echo $a['link_class']; ?>"
           href="tel:<?php echo esc_attr( get_field( '_sogo_phone', 'option' ) ); ?>" title="phone number">
            <span class="<?php echo $a['icon_class']; ?>"></span>
            <span class="<?php echo $a['phone_class']; ?>"><?php echo get_field( '_sogo_footer_phone_text', 'option' ); ?></span>
        </a>
	<?php endif;

	return ob_get_clean();
}

add_shortcode( 'sogo_phone', 'sogo_print_phone' );

/**
 * social shortcode
 */
function sogo_print_social( $atts ) {
	$a = shortcode_atts( array(
		'ul_class'   => '',
		'li_class'   => '',
		'link_class' => '',
		'icon_class' => ''
	), $atts );
	ob_start();
	if ( get_field( '_sogo_footer_social_media', 'option' ) ) : ?>
        <div class="<?php echo $a['ul_class']; ?>">
			<?php while ( have_rows( '_sogo_social', 'option' ) ) : the_row();
				$link = get_sub_field( 'url' );
				$icon = get_sub_field( 'icon' );
				$text = get_sub_field( 'text' );
				?>
                <div class="<?php echo $a['li_class']; ?>">
                    <a target="_blank" class="text-color-2-simple hover-color-1 "<?php echo $a['link_class']; ?>" href="<?php echo $link; ?>"
                       title="<?php echo $text; ?>"
                       aria-label="<?php _e( 'Social', 'sogoc' ) ?>">
                        <span style="font-size:18px;" class="<?php echo $icon . ' ' . $a['icon_class']; ?>"></span>
                    </a>
                </div>
			<?php endwhile; ?>
        </div>
	<?php endif;

	return ob_get_clean();
}

add_shortcode( 'sogo_social', 'sogo_print_social' );


/**
 * facebook page shortcode
 */
function sogo_print_facebook_page( $atts ) {
	$a = shortcode_atts( array(
		'width' => '500'
	), $atts );
	ob_start();
	?>
    <div class="fb-page text-center"
         data-href="<?php echo get_field( '_sogo_facebook_link', 'option' ); ?>"
         data-hide-cover="false"
         data-show-facepile="true"
         data-width="<?php echo $a['width']; ?>">
    </div>
	<?php
	return ob_get_clean();
}

add_shortcode( 'sogo_facebook_page', 'sogo_print_facebook_page' );


/**
 * facebook link
 */
function sogo_print_facebook() {
	ob_start();
	?>
    <a href="<?php echo esc_url( get_field( '_sogo_facebook_link', 'option' ) ); ?>" title="go to our facebook page">
        <span class="icon-facebook icon-s bg-white color-2 align-middle"></span>
        <span class="align-middle text-p color-white hover-1 transition"><?php _e( 'Visit us on facebook', 'sogo' ); ?></span>
    </a>
	<?php
	return ob_get_clean();
}

add_shortcode( 'sogo_facebook', 'sogo_print_facebook' );


/**
 * related posts
 */
function sogo_print_related_posts( $atts ) {
	$a = shortcode_atts( array(
		'post_type'           => '',
		'slider_classes_flag' => 'false',
	), $atts );
	ob_start();


	if ( $a['slider_classes_flag'] === 'true' ) {
		set_query_var( 'slider_classes_flag', true );
	}

	$args = array( 'post_type' => $a['post_type'], 'post__not_in' => array( get_the_ID() ) );
	$loop = new WP_Query( $args );
	while ( $loop->have_posts() ) : $loop->the_post();
		get_template_part( 'templates/component', 'post-' . $a['post_type'] );
	endwhile;
	wp_reset_postdata();

	return ob_get_clean();
}

add_shortcode( 'sogo_related_posts', 'sogo_print_related_posts' );
