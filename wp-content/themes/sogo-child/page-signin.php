<?php // Template Name: Signin page
if ( is_user_logged_in() ) {
	$page      = get_page_url_by_template_name( 'page-profile.php' );
	$user_id   = get_current_user_id();
	$user_role = get_user_role( $user_id );

	if ( $user_role && is_user_type( $user_role, [ 'therapist', 'family' ] ) ) {
		header( 'Location:' . $page . '?type=' . $user_role );
		exit();
	}
}
get_header();
the_post();

?>
<main <?php sogo_print_bg( array( 'url' => get_field( '_sogo_sign_background' ) ) ) ?>>
	<?php get_template_part( 'templates/component', 'breadcrumbs' ); ?>
    <section class="container bg-white mt-3">
        <div class="row pt-3 pb-5">
            <div class="col-md-4">
                <div class="row justify-content-center">
                    <div class="col-md-10 mb-3 mb-md-0">
                        <form id="sogo-signin-form" method="post" action="#">
                            <h1 class="h3 s-title-color-3 s-title-center text-center"><?php _e( 'Login', 'sogoc' ) ?></h1>
							<?php wp_nonce_field( 'sogo-signin', 'nonce-signin' ); ?>
							<?php echo sogo_print_input( __( 'Phone', 'sogoc' ), 'phone', true ,'', '', array('type'=>'tel')) ?>
<!--							--><?php //echo sogo_print_input( __( 'Password', 'sogoc' ), 'password', true, '', '', array( 'type' => 'password' ) ) ?>
                            <div class="d-flex justify-content-between mb-2">
								<?php echo sogo_print_checkbox( __( 'Remember password', 'sogoc' ), '', 'remember_password', 'true' ) ?>
<!--                                <button type="button" id="forgot-password" class="bg-transparent border-0 p mb-0 text-color-1">-->
<!--                                    <u>--><?php //_e( 'Forgot password', 'sogoc' ) ?><!--?</u>-->
<!--                                </button>-->
                            </div>
                            <div class="text-center">
								<?php
								sogo_print_btn( array(
									'text'   => __( 'Login', 'sogoc' ),
									'class'  => 's-btn-1',
									'button' => true,
									'type'   => 'submit'
								) );
								?>
                            </div>
                        </form>
                        <form id="sogo-resetpassword-form" class="d-none" method="post" action="#">
                            <h1 class="h3 s-title-color-3 s-title-center text-center"><?php _e( 'Reset password', 'sogoc' ) ?></h1>
							<?php wp_nonce_field( 'sogo-resetpassword', 'nonce-resetpassword' ); ?>
							<?php echo sogo_print_input( __( 'Email', 'sogoc' ), 'email', true, '', '', array( 'type' => 'tel' ) ) ?>
                            <div class="d-flex justify-content-between mb-2">
                                <button type="button" id="back-login" class="bg-transparent border-0 p mb-0 text-color-1">
                                    <u><?php _e( 'Back to login', 'sogoc' ) ?></u></button>
                            </div>
                            <div class="text-center">
								<?php
								sogo_print_btn( array(
									'text'   => __( 'Submit', 'sogoc' ),
									'class'  => 's-btn-1',
									'button' => true,
									'type'   => 'submit'
								) );
								?>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-auto"><span class="border-left-2 border-color-2 h-100 d-block"></span></div>
            <div class="col-md-7 text-center">
                <h2 class="h3 s-title-color-3 s-title-center"><?php _e( 'Create account', 'sogoc' ) ?></h2>
                <div class="mb-2 mx-auto" style="width:280px;">
					<?php
					sogo_print_btn( array(
						'text'  => __( 'Family signup', 'sogoc' ),
						'href'  => get_page_url_by_template_name( 'page-signup.php' ) . '?type=family',
						'class' => 's-btn-1 w-100',
					) );
					?>
                </div>
                <div class="mx-auto" style="width:280px;">
					<?php
					sogo_print_btn( array(
						'text'  => __( 'Therapist signup', 'sogoc' ),
						'href'  => get_page_url_by_template_name( 'page-signup.php' ) . '?type=therapist',
						'class' => 's-btn-2 w-100',
					) );
					?>
                </div>
            </div>
        </div>
    </section>
</main>

<script>
    (function ($) {
        'use strict';
        $(document).ready(function () {
            $('#forgot-password').on('click', function () {
                $('#sogo-signin-form').addClass('d-none');
                $('#sogo-resetpassword-form').removeClass('d-none');
            });
            $('#back-login').on('click', function () {
                $('#sogo-signin-form').removeClass('d-none');
                $('#sogo-resetpassword-form').addClass('d-none');
            });
        });
    })(jQuery);
</script>

<?php include 'templates/component-validate-user.php' ?>

<?php get_footer() ?>
