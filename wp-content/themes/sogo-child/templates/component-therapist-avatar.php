<div class="position-relative text-center mb-2 mb-md-0">
	<?php
	$small_avatar = is_post_type_archive( 'therapists' ) || is_front_page() || is_search() || (isset($small_avatar_flag) ? $small_avatar_flag : null) ; // is_singular('therapists')
	$has_avatar          = has_post_thumbnail();
	$default             = 'defaultman';
	if ( ! $has_avatar && $gender === 'female' ) {
		$default = 'defaultwoman';
	}
	?>
    <div class="rounded-circle overflow-hidden mx-auto position-relative border-1 border-color-2 <?php echo $small_avatar ? 'avatar-img-wrapper-archive' : 'avatar-img-wrapper' ?>">
        <img src="
					<?php echo $has_avatar ? get_the_post_thumbnail_url( $post_id, 'full' ) : get_stylesheet_directory_uri() . "/assets/images/{$default}.jpg" ?>"
             alt="Profile image"
             class="h-100 xy-align">
    </div>
</div>
