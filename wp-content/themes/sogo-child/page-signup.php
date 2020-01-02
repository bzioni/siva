<?php // Template Name: Signup page
if ( is_user_logged_in() ) {
	$page      = get_page_url_by_template_name( 'page-profile.php' );
	$user_id = get_current_user_id();
	$user_role = get_user_role( $user_id );

	if ( $user_role && is_user_type($user_role, ['therapist', 'family']) ) {
		header( 'Location:' . $page . '?type=' . $user_role );
		exit();
	}
}
if ( ! isset( $_GET['type'] ) || ( $_GET['type'] !== 'family' && $_GET['type'] !== 'therapist' ) ) {
	header( 'Location:' . get_page_url_by_template_name( 'page-signin.php' ) );
	exit();
}
get_header();
the_post();
?>
<main class="pt-3 pb-4" <?php sogo_print_bg( array( 'url' => get_field( '_sogo_sign_background' ) ) ) ?>>
    <section class="container">
        <form id="sogo-signup-form" method="post" action="#" class="row">
            <input type="hidden" name="type" value="<?php echo $_GET['type'] ?>">
			<?php wp_nonce_field( 'sogo-signup', 'nonce', false );
			if ( sogo_isset( 'type', 'therapist' ) ):
				include get_stylesheet_directory() . '/templates/component-form-therapist.php';
            elseif ( sogo_isset( 'type', 'family' ) ):
				include get_stylesheet_directory() . '/templates/component-form-family.php';
			endif; ?>
        </form>
    </section>
</main>

<?php include 'templates/component-validate-user.php' ?>

<?php get_footer() ?>
