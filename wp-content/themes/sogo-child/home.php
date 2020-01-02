<?php
get_header(); ?>
<main class="container pt-3">
	<?php echo get_search_form() ?>
	<?php if ( have_posts() ) : ?>
        <ul class="list-unstyled p-0 d-flex d-md-inline-flex justify-content-center mb-3 js-tax-slider">

			<?php
			$current         = 0;
			$is_current_all  = ( ! is_category() && ! is_tax() ) || is_home() && ! isset( $_GET['search'] );
			$current_classes = 'bg-color-1 text-white px-1 py-0-1 rounded'
			?>

            <li class="m<?php echo is_rtl() ? 'l' : 'r' ?>-2 py-1 text-center">
                <a href="<?php echo get_post_type_archive_link( get_post_type() ); ?>"
                   class="<?php echo $is_current_all ? $current_classes : ''; ?> color-inherit text-center">
					<?php _e( 'All articles', 'sogoc' ); ?>
                </a>
            </li>
			<?php
			$terms = get_terms(
				array(
					'taxonomy'   => 'category',
					'hide_empty' => true
				) );
			if ( $terms ) {
				foreach ( $terms as $key => $term ) {
					$term_link  = get_term_link( $term );
					$is_current = get_queried_object_id() == $term->term_id && ! isset( $_GET['search'] );
					if ( $is_current ) {
						$current = $key + 1;
					}
					echo sprintf(
						'<li class="m%s-2 py-1 text-center"><a class="%s color-inherit text-center" href="%s" title="%s">%s</a></li>',
						is_rtl() ? 'l' : 'r',
						$is_current ? $current_classes : '',
						$term_link,
						$term->name,
						$term->name
					);
				}
			}
			?>
        </ul>
        <section>
            <div class="row">
				<?php while ( have_posts() ) : the_post(); ?>
                    <article class="col-md-4 mb-3">
						<?php include 'templates/component-box-1.php'; ?>
                    </article>
				<?php endwhile; ?>
            </div>
            <div class="page-navigation row justify-content-center">
				<?php function_exists( 'wp_pagenavi' ) ? wp_pagenavi() : null; ?>
            </div>
        </section>
	<?php else: ?>
        <span class="h2 text-center d-block"><?php _e( 'No results found' ) ?></span>
	<?php endif; ?>
</main>

<script>
    (function ($) {
        'use strict';


        $(document).ready(function () {

            var $window = $(window);
            var $slider = $('.js-tax-slider');

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
