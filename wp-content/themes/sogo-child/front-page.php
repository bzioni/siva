<?php
// Template Name: Front page
get_header();
the_post();
$is_rtl = is_rtl();
// intro
$intro_display    = get_field( '_sogo_intro_display' );
$intro_bg         = get_field( '_sogo_intro_background' . ( $is_rtl ? '_rtl' : '' ) . ( wp_is_mobile() ? '_mobile' : '' ) );
$intro_pre_title  = get_field( '_sogo_intro_pre_title' );
$intro_title      = get_field( '_sogo_intro_title' );
$intro_subtitle   = get_field( '_sogo_intro_subtitle' );
$intro_text_color = get_field( '_sogo_intro_text_color' );
// activity
$activity_display  = get_field( '_sogo_activity_display' );
$activity_title    = get_field( '_sogo_activity_title' );
$activity_subtitle = get_field( '_sogo_activity_subtitle' );
$activity          = '_sogo_activity';

// cta
$cta_display = get_field( '_sogo_cta_display' );
$cta_bg      = get_field( '_sogo_cta_background' );
$cta_right   = get_field( '_sogo_cta_right' );
$cta_left    = get_field( '_sogo_cta_left' );

// search
$search_display  = get_field( '_sogo_search_display' );
$search_title    = get_field( '_sogo_search_title' );
$search_btn_text = get_field( '_sogo_search_btn_text' );
$search_btn_url  = get_field( '_sogo_search_btn_url' );
// contact
$contact_display   = get_field( '_sogo_contact_display' );
$contact_bg        = get_field( '_sogo_contact_background' );
$contact_title     = get_field( '_sogo_contact_title' );
$contact_text      = get_field( '_sogo_contact_text' );
$contact_form_dest = get_field( '_sogo_contact_form_dest' );

// rec
$rec_display = get_field( '_sogo_rec_display' );
$rec_title   = get_field( '_sogo_rec_title' );
$rec         = '_sogo_rec';
?>
    <main>

		<?php if ( $intro_display ): ?>
            <section class="position-relative py-3 py-lg-5" <?php sogo_print_bg( array(
				'url'      => $intro_bg,
				'position' => 'center ' . ( $is_rtl ? 'right' : 'left' )
			) ) ?>>
                <div class="w-100 h-100 bg-opacity xy-align z-index-1"></div>
                <div class="text-center position-relative z-index-2 mb-4" style="color: <?php echo $intro_text_color ?> !important;">
                    <span class="h1 mb-0"><?php echo $intro_pre_title ?></span>
                    <h1 class="text-slider-title mb-0"><?php echo $intro_title ?></h1>
                    <h2 class="h1"><?php echo $intro_subtitle ?></h2>
                </div>
                <div class="container position-relative z-index-2">
					<?php include "templates/component-search.php"; ?>
                </div>
            </section>
		<?php endif; ?>

		<?php if ( $activity_display ): ?>
            <section class="container text-center py-3 py-lg-5">
                <h2 class="h1 s-title-center s-title-color-3"><?php echo $activity_title ?></h2>
                <h3 class="h6 mb-3"><?php echo $activity_subtitle ?></h3>
				<?php if ( have_rows( $activity ) ): ?>
                    <div class="row">
						<?php $key = 1;
						while ( have_rows( $activity ) ): the_row(); ?>
                            <div class="col-md-3" data-aos="fade-up" data-aos-delay="<?php echo $key * 100 ?>">
                                <div class="p-2 hover-bg-color-3 rounded hover-color-white transition">
                                    <span class="<?php the_sub_field( 'icon' ) ?> icon-xl text-color-3-simple d-block mb-2"></span>
                                    <h3 class="h4"><?php the_sub_field( 'title' ) ?></h3>
                                    <p class="mb-0"><?php the_sub_field( 'text' ) ?></p>
                                </div>
                            </div>
							<?php
							$key ++;
						endwhile; ?>
                    </div>
				<?php endif; ?>
            </section>
		<?php endif; ?>

		<?php if ( $cta_display ): ?>
            <section class="position-relative py-3 py-lg-5 text-white" <?php sogo_print_bg( array( 'url' => $cta_bg ) ) ?>>
                <div class="position-absolute pos-b-0 pos-<?php echo $is_rtl ? 'r' : 'l' ?>-0 z-index-2 d-none d-md-block">
					<?php echo wp_get_attachment_image( $cta_right[ 'image' . ( $is_rtl ? '_rtl' : '' ) ], 'full', false, array( 'class' => 'img-fluid' ) ) ?>
                </div>
                <div class="position-absolute pos-b-0 pos-<?php echo $is_rtl ? 'l' : 'r' ?>-0 z-index-2 d-none d-md-block">
					<?php echo wp_get_attachment_image( $cta_left[ 'image' . ( $is_rtl ? '_rtl' : '' ) ], 'full', false, array( 'class' => 'img-fluid' ) ) ?>
                </div>
                <div class="w-100 h-100 bg-opacity xy-align z-index-1"></div>
                <div class="container position-relative z-index-2">
                    <div class="row">
                        <div class="col-md-6 mb-3 mb-lg-0">
                            <h3 class="h1 s-title-<?php echo $is_rtl ? 'right' : 'left' ?> s-title-color-white"><?php echo $cta_right['title'] ?></h3>
                            <p data-aos="fade-up" data-aos-delay="100" class="h6 mb-4"><?php echo $cta_right['text'] ?></p>
                            <div data-aos="fade-up" data-aos-delay="200"  class="text-center text-md-<?php echo $is_rtl ? 'right' : 'left' ?>">
								<?php sogo_print_btn( array(
									'href'  => $cta_right['btn_url'],
									'text'  => $cta_right['btn_text'],
									'class' => 's-btn-2'
								) ) ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h3 class="h1 s-title-<?php echo $is_rtl ? 'right' : 'left' ?> s-title-color-white"><?php echo $cta_left['title'] ?></h3>
                            <p data-aos="fade-up" data-aos-delay="100" class="h6 mb-4"><?php echo $cta_left['text'] ?></p>
                            <div data-aos="fade-up" data-aos-delay="200" class="text-center text-md-<?php echo $is_rtl ? 'right' : 'left' ?>">
								<?php sogo_print_btn( array(
									'href'  => $cta_left['btn_url'],
									'text'  => $cta_left['btn_text'],
									'class' => 's-btn-2'
								) ) ?>
                            </div>
                        </div>
                        <div class="col-md-6"></div>
                    </div>
                </div>
            </section>
		<?php endif; ?>

		<?php if ( $search_display ): ?>
            <section class="container py-3 py-lg-5">
				<?php include get_stylesheet_directory() . '/templates/section-search.php' ?>
            </section>
		<?php endif; ?>

		<?php if ( $contact_display ): ?>
            <section class="py-3 py-lg-5" <?php echo sogo_print_bg( array( 'url' => $contact_bg ) ) ?>>
                <div class="container">
                    <h3 class="h1 text-white text-center s-title-center s-title-color-white"><?php echo $contact_title ?></h3>
                    <div data-aos="fade-up" class="entry-content text-white mb-3"><?php echo $contact_text ?></div>
                    <form id="front-page-form">
                        <div class="row">
                            <div class="col-md-3 mb-1 mb-md-2"><?php echo sogo_print_input( __( 'Full name', 'sogoc' ), 'full_name', true, '', '', array( 'label-class' => 'text-white' ) ) ?></div>
                            <div class="col-md-3 mb-1 mb-md-2"><?php echo sogo_print_input( __( 'Phone', 'sogoc' ), 'phone', true, '', '', array(
									'label-class' => 'text-white',
									'type'        => 'tel'
								) ) ?></div>
                            <div class="col-md-3 mb-1 mb-md-2"><?php echo sogo_print_select( __( 'Gender', 'sogoc' ), 'gender', array(
									'male'   => __( 'Male', 'sogoc' ),
									'female' => __( 'Female', 'sogoc' )
								), __( 'Select', 'sogoc' ), true, '', '', array( 'label-class' => 'text-white' ) ) ?></div>
                            <div class="col-md-3 mb-1 mb-md-2"><?php echo sogo_print_select( __( 'Nursing status', 'sogoc' ), 'nursing_status', array(
									'male'   => __( 'Male', 'sogoc' ),
									'female' => __( 'Female', 'sogoc' )
								), __( 'Select', 'sogoc' ), true, '', '', array( 'label-class' => 'text-white' ) ) ?></div>
                            <div class="col-md-6"><?php echo sogo_print_input( __( 'Address', 'sogoc' ), 'address', false, '', '', array( 'label-class' => 'text-white' ) ) ?></div>
                            <div class="col-md-3 mb-1 mb-md-2"><?php echo sogo_print_select( __( 'Personal status', 'sogoc' ), 'personal_status', array(
									'male'   => __( 'Male', 'sogoc' ),
									'female' => __( 'Female', 'sogoc' )
								), __( 'Select', 'sogoc' ), true, '', '', array( 'label-class' => 'text-white' ) ) ?></div>
                            <div class="col-md-3 mb-1 mb-md-2"><?php echo sogo_print_select( __( 'National insurance eligibility', 'sogoc' ), 'national_insurance_eligibility', array(
									'male'   => __( 'Male', 'sogoc' ),
									'female' => __( 'Female', 'sogoc' )
								), __( 'Select', 'sogoc' ), true, '', '', array( 'label-class' => 'text-white' ) ) ?></div>
                            <div class="col-12 mb-1 mb-md-2"><?php echo sogo_print_textarea( __( 'About the therapist', 'sogoc' ), 'about_the_therapist', '', '', 3.5, '', '', false, array( 'label-class' => 'text-white' ) ) ?></div>
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
            </section>
		<?php endif; ?>

		<?php if ( $rec_display ): ?>
            <section class="py-3 py-lg-5 bg-white">
                <div class="container">
                    <h3 class="h1 text-center s-title-center s-title-color-3"><?php echo $rec_title ?></h3>
					<?php if ( have_rows( $rec ) ): ?>
                        <div id="js-rec-slider" class="row pb-3">
							<?php $key = 0;
							while ( have_rows( $rec ) ): the_row(); ?>
                                <article class="col-12 px-2 pb-4">
                                    <div class="text-center position-relative border-1 border-color-3 rounded pt-2 pb-4">
                                        <span class="h4 text-color-3 mb-2 d-block"><?php the_sub_field( 'title' ) ?></span>
                                        <p class="px-2 h6"><?php the_sub_field( 'text' ) ?></p>
                                        <div class="x-align" style="bottom:-18%">
                                            <div class="bg-white xy-align rounded-circle z-index-1" style="width: 120%; height: 120%"></div>
                                            <div class="rounded-circle overflow-hidden border-1 border-color-2 position-relative z-index-2">
												<?php echo wp_get_attachment_image( get_sub_field( 'image' ), 'full', false, array( 'class' => 'img-fluid' ) ) ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-center mt-4">
                                        <span class="p mb-0 d-block"><?php the_sub_field( 'name' ) ?></span>
                                        <span class="p mb-0 d-block text-color-2"><?php the_sub_field( 'city' ) ?></span>
                                    </div>
                                </article>
								<?php
								$key ++;
							endwhile; ?>
                        </div>
                        <script>
                            (function ($) {
                                "use strict";

                                $(document).ready(function () {
                                    $('#js-rec-slider').slick({
                                        infinite: true,
                                        rtl: sogoc.locale === 'he',
                                        slidesToShow: 3,
                                        slidesToScroll: 1,
                                        autoplay: true,
                                        autoplaySpeed: 2500,
                                        centerMode: true,
                                        centerPadding: '0',
                                        draggable: true,
                                        arrows: false,
                                        dots: true,
                                        responsive: [
                                            {
                                                breakpoint: ipad_width,
                                                settings: {
                                                    slidesToShow: 2
                                                }
                                            },
                                            {
                                                breakpoint: mobile_width,
                                                settings: {
                                                    slidesToShow: 1,
                                                }
                                            }
                                        ]
                                    });

                                });
                            })(jQuery);
                        </script>
					<?php endif; ?>

                </div>
            </section>
		<?php endif; ?>

    </main>

<?php get_footer();
