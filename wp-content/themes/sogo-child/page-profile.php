<?php // Template Name: Profile page
if ( ! isset( $_GET['type'] ) || ( $_GET['type'] !== 'family' && $_GET['type'] !== 'therapist' ) ) {
	header( 'Location:' . get_page_url_by_template_name( 'page-signin.php' ) );
	exit();
}

if ( is_user_logged_in() ) {
	$post_id = get_user_meta( get_current_user_id(), '_sogo_therapist_post', true );
	// to set the title
	set_query_var( 'post_id', $post_id );
} else {
	header( 'Location:' . get_page_url_by_template_name( 'page-signin.php' ) );
	exit();
}

get_header();
the_post();
?>
<main class="pt-3" <?php sogo_print_bg( array( 'url' => get_field( '_sogo_sign_background' ) ) ) ?>>
    <section class="container">
        <form id="sogo-profile-form" method="post" action="#" class="row">
            <input type="hidden" name="type" value="<?php echo $_GET['type'] ?>">
			<?php wp_nonce_field( 'sogo-profile', 'nonce', false );
			if ( sogo_isset( 'type', 'therapist' ) ):
				include get_stylesheet_directory() . '/templates/component-form-therapist.php';
            elseif ( sogo_isset( 'type', 'family' ) ):
				include get_stylesheet_directory() . '/templates/component-form-family.php';
			endif; ?>
        </form>
    </section>
</main>
<?php get_footer() ?>
