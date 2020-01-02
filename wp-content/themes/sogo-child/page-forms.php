<?php // Template Name: Forms page
get_header();
the_post();
?>
<main class="container pt-3 pb-3 pb-md-4">
    <section>
		<?php if ( have_rows( '_sogo_forms' ) ): ?>
            <ul class="list-unstyled p-0 d-flex d-md-inline-flex justify-content-center mb-3 js-filters-forms js-filters-slider">
                <li class="m<?php echo is_rtl() ? 'l' : 'r' ?>-2 py-1 text-center">
                    <a href="#"
                       data-cat=""
                       class="js-filter-forms transition active-tab color-inherit text-center">
						<?php _e( 'All forms', 'sogoc' ); ?>
                    </a>
                </li>
				<?php $key = 0;
				$temp_arr  = array();
				while ( have_rows( '_sogo_forms' ) ): the_row();
					if ( in_array( get_sub_field( 'category' ), $temp_arr ) ) {
						continue;
					}
					$temp_arr[] = get_sub_field( 'category' );
					echo sprintf(
						'<li class="m%s-2 py-1 text-center"><a class="color-inherit text-center js-filter-forms transition" href="#" data-cat="%s" title="%s">%s</a></li>',
						is_rtl() ? 'l' : 'r',
						get_sub_field( 'category' ),
						get_sub_field( 'category' ),
						get_sub_field( 'category' )
					);
					$key ++;
				endwhile; ?>
            </ul>
		<?php endif; ?>

		<?php if ( have_rows( '_sogo_forms' ) ): ?>
            <div class="row forms">
				<?php $key = 0;
				while ( have_rows( '_sogo_forms' ) ): the_row(); ?>
                    <div class="col-md-6 mb-3" data-cat="<?php the_sub_field( 'category' ) ?>" data-title="<?php the_sub_field( 'title' ) ?>">
                        <a href="<?php the_sub_field( 'file' ) ?>" download
                           class="hover-form-component rounded d-flex justify-content-between align-items-center overflow-hidden box-shadow">
                            <span class="p mb-0 text-color-1 px-2"><?php the_sub_field( 'title' ) ?></span>
                            <div class="bg-color-3 position-relative icon-download-wrapper" style="height: 45px; width: 45px">
                                <span class="icon-download text-white xy-align"></span>
                            </div>
                        </a>
                    </div>
					<?php
					$key ++;
				endwhile; ?>
            </div>
		<?php endif; ?>

    </section>
</main>

<script>
    (function ($) {
        'use strict';
        $(document).ready(function () {
            $(document).on('click', '.js-filter-forms', function () {
                $('.js-filters-forms').children().each(function (i, e) {
                    $(e).find('a').removeClass('active-tab');
                });
                var $this = $(this);
                $('.forms').children().each(function (i, e) {
                    $(e).removeClass('d-none');
                    $this.addClass('active-tab');
                    if ($this.data('cat') && $(e).data('cat') !== $this.data('cat')) {
                        $(e).addClass('d-none')
                    }
                })
            });


            var $window = $(window);
            var $slider = $('.js-filters-slider');

            var settings = {
                rtl: sogoc.rtl === 'true',
                dots: false,
                arrows: false,
                centerMode: true,
                centerPadding: '25%',
                slidesToShow: 1,
                infinite: true,
                nextArrow: '<i class="fa fa-chevron-left y-align pos-l-2 cursor-pointer text-color-3 z-index-1"></i>',
                prevArrow: '<i class="fa fa-chevron-right y-align pos-r-2 cursor-pointer text-color-3 z-index-1"></i>',
            };

            slick_on_mobile($slider, settings);

            function slick_on_mobile(slider, settings) {
                $window.on('load resize', function () {
                    if ($window.width() > mobile_width) {
                        if (slider.hasClass('slick-initialized')) {
                            slider.slick('unslick');
                        }
                        return
                    }
                    if (!slider.hasClass('slick-initialized')) {
                        return slider.slick(settings);
                    }
                });
            }

        });
    })(jQuery);
</script>


<?php get_footer() ?>
