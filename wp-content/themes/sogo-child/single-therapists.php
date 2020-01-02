<?php
get_header();
the_post();
$post_id = get_the_ID();
set_query_var( 'post_id', get_the_ID() );
$gender          = sogo_get_post_meta_value( 'gender' );
$recommendations = sogo_get_post_meta_value( 'recommendations' )
?>

<main>
    <section class="container pt-3 pb-4">
        <div class="row">
            <div class="col-md-9">
                <!--FOLD 1-->
                <div class="col-12">
                    <div class="row bg-white mb-3 box-shadow py-2">
                        <div class="col-md-3">
							<?php include 'templates/component-therapist-avatar.php'; ?>
                        </div>
                        <div class="col-md-9">
                            <div class="mb-2">
								<?php include 'templates/component-therapist-title.php'; ?>
                            </div>
							<?php include 'templates/component-therapist-main-info.php'; ?>
                        </div>
                    </div>
                </div>
                <!--FOLD 2-->
                <div class="col-12 mb-3 mb-md-0">
                    <div class="row bg-white box-shadow py-2 px-2">
                        <div class="col-md-12">
                            <div class="row py-2">
                                <div class="col-md-3"><?php _e( 'About me', 'sogoc' ) ?></div>
                                <div class="col-md-9 entry-content">
									<?php echo sogo_get_post_meta_value( 'about_me' ) ?>
                                </div>
                            </div>
                            <div class="border-bottom-1 border-color-3"></div>
                            <div class="row py-2">
                                <div class="col-md-3"><?php _e( 'Recommendations', 'sogoc' ) ?></div>
                                <div class="col-md-9 entry-content">
									<?php echo sogo_get_post_meta_value( 'recommendations' ) ?>
                                </div>
                            </div>
                            <div class="border-bottom-1 border-color-3"></div>
                            <div class="row py-2">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <span><?php _e( 'My preferences', 'sogoc' ) ?></span>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="row">
												<?php
												$preferences = array(
													__( 'Work with women', 'sogoc' )    => 'work_with_women',
													__( 'Work with men', 'sogoc' )      => 'work_with_men',
													__( 'Including weekends', 'sogoc' ) => 'including_weekends',
													__( 'Like animals', 'sogoc' )       => 'like_animals',
													__( 'Including sleeping', 'sogoc' ) => 'including_sleeping',
												);
												foreach ( $preferences as $key => $preference ): ?>
													<?php if ( sogo_get_post_meta_value( $preference ) === 'true' ): ?>
                                                        <div class="col-md-4">
                                                            <span class="text-color-3 icon-checkcircle"></span>
                                                            <span class="ml-1"></span>
                                                            <span><?php echo $key ?></span>
                                                        </div>
													<?php endif; ?>
												<?php endforeach; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="border-bottom-1 border-color-3"></div>
                            <div class="row py-2">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <span><?php _e( 'My capabilities', 'sogoc' ) ?></span>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="row">
												<?php
												$capabilities = array(
													__( 'Cooking', 'sogoc' )  => 'cooking',
													__( 'Dressing', 'sogoc' ) => 'dressing',
													__( 'Cleaning', 'sogoc' ) => 'cleaning',
													__( 'Diapers', 'sogoc' )  => 'diapers',
													__( 'Washing', 'sogoc' )  => 'washing',
													__( 'Lifting', 'sogoc' )  => 'lifting',
												);
												foreach ( $capabilities as $key => $capability ): ?>
													<?php if ( sogo_get_post_meta_value( $capability ) === 'true' ): ?>
                                                        <div class="col-md-4">
                                                            <span class="text-color-3 icon-checkcircle"></span>
                                                            <span class="ml-1"></span>
                                                            <span><?php echo $key ?></span>
                                                        </div>
													<?php endif; ?>
												<?php endforeach; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="border-bottom-1 border-color-3"></div>
                            <div class="row py-2">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <span><?php _e( 'More info', 'sogoc' ) ?></span>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="row">
												<?php
												$more_info = array(
													__( 'Certified first aid', 'sogoc' ) => 'certified_first_aid',
													__( 'Certified CPR', 'sogoc' )       => 'certified_cpr',
													__( 'Driving license', 'sogoc' )     => 'driving_license',
													__( 'Smoking', 'sogoc' )             => 'smoking',
													__( 'Computers', 'sogoc' )           => 'computers',
												);
												foreach ( $more_info as $key => $info ): ?>
													<?php if ( sogo_get_post_meta_value( $info ) === 'true' ): ?>
                                                        <div class="col-md-4">
                                                            <span class="text-color-3 icon-checkcircle"></span>
                                                            <span class="ml-1"></span>
                                                            <span><?php echo $key ?></span>
                                                        </div>
													<?php endif; ?>
												<?php endforeach; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="border-bottom-1 border-color-3"></div>
                            <div class="row py-2">
                                <div class="col-md-3"><?php _e( 'Professional experience', 'sogoc' ) ?></div>
                                <div class="col-md-9 entry-content">
									<?php echo sogo_get_post_meta_value( 'professional_experience' ) ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="bg-color-1 text-white p-2">
                    <span class="h3 d-block"><?php _e( 'Contact the therapist', 'sogoc' ) ?></span>
                    <div class="border-bottom-1 border-white mb-2"></div>
					<?php if ( is_user_logged_in() ): ?>
                        <div class="text-center">
							<?php
							sogo_print_btn( array(
								'text'   => __( 'Show phone number', 'sogoc' ),
								'button' => 'true',
								'icon'   => 'icon-phone',
								'class'  => 's-btn-2 w-100 mb-2 px-0',
								'id'     => 'js-show-phone'
							) );
							sogo_print_btn( array(
								'text'  => sogo_get_post_meta_value( 'phone' ),
								'href'  => 'tel:' . sogo_get_post_meta_value( 'phone' ),
								'icon'  => 'icon-phone',
								'class' => 's-btn-2 d-none w-100 mb-2 px-0',
							) );
							sogo_print_btn( array(
								'text'  => __( 'Send email message', 'sogoc' ),
								'icon'  => 'icon-mail',
								'class' => 's-btn-3 w-100 mb-0 px-0',
								'href'  => 'mailto:' . sogo_get_post_meta_value( 'email' )
							) );
							?>
                        </div>
					<?php else: ?>
                        <p><?php _e( 'Website signup', 'sogoc' ) ?></p>
                        <div class="text-center">
							<?php
							sogo_print_btn( array(
								'text'  => __( 'Signup to website', 'sogoc' ),
								'class' => 's-btn-2',
								'href'  => get_page_url_by_template_name( 'page-signin.php' )
							) );
							?>
                            <div>
                                <span><?php _e( 'Already have account', 'sogoc' ) ?>?&nbsp;
                            <u><a class="text-white" href="<?php echo get_page_url_by_template_name( 'page-signin.php' ) ?>"><?php _e( 'Signin', 'sogoc' ) ?></a></u>
                        </span>
                            </div>
                        </div>
					<?php endif; ?>
                </div>
            </div>
        </div>

    </section>

    <section class="position-relative pt-3 pb-2" <?php sogo_print_bg( array(
		'url' => get_field( '_sogo_title_background', 'option' ),
	) ) ?>>
		<?php
		$search_title    = __( 'More therapists', 'sogoc' );
		$search_btn_url  = get_post_type_archive_link( 'therapists' );
		$search_btn_text = __( 'To all therapists', 'sogoc' )
		?>
        <div class="container">
			<?php include get_stylesheet_directory() . '/templates/section-search.php' ?>
        </div>
    </section>
</main>
<script>
    (function ($) {
        'use strict';
        $(document).ready(function () {
            $('#js-show-phone').on('click', function () {
                var $this = $(this);
                $this.next().removeClass('d-none');
                $this.remove();
            });
        });
    })(jQuery);
</script>


<?php get_footer(); ?>
