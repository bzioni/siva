<?php
$args          = array(
	'post_type'      => is_front_page() ? 'post' : get_post_type(),
	'post_status'    => 'publish',
	'post__not_in'   => array( get_the_ID() ),
	'posts_per_page' => 3,
);
$related_posts = new WP_Query( $args );
if ( $related_posts->have_posts() ): ?>

<h3 class="h1 text-center text-color-1 s-title-center s-title-color-3"><?php echo $related_title ?></h3>
<div class="row">
	<?php while ( $related_posts->have_posts() ): $related_posts->the_post(); ?>
        <article class="col-md-4">
			<?php include 'component-box-1.php'; ?>
        </article>
	<?php endwhile;
	wp_reset_postdata(); ?>
</div>
    <script>
        (function ($) {
            "use strict";

            $(document).ready(function () {
                $('#js-more-posts-slider').slick({
                    infinite: true,
                    rtl: true,
                    slidesToShow: 3,
                    slidesToScroll: 1,
                    autoplay: true,
                    autoplaySpeed: 2500,
                    draggable: true,
                    arrows: false,
                    dots: <?php echo is_front_page() ? 'false' : 'true' ?>,
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
                                arrows: false
                            }
                        }
                    ]
                });

            });
        })(jQuery);
    </script>


<?php endif ?>
