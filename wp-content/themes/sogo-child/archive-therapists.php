<?php
get_header();
global $wp_query;
$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
//$per_page = get_option( 'posts_per_page' );
$per_page = 15;
$total    = $wp_query->found_posts;
$from     = $paged === 1 ? 1 : $per_page * ( $paged - 1 ) + 1;
$to       = $per_page * $paged < $total ? $per_page * $paged : $total;
?>
<main class="container pt-3" id="js-search-results">
    <section class="mb-2">
		<?php if ( $total > 0 ): ?>
            <span class="h5 mb-0"><?php echo sprintf( "%s %s-%s %s %s %s", __( 'Showing', 'sogoc' ), $from, $to, __( 'from', 'sogoc' ), $total, __( 'results', 'sogoc' ) ); ?></span>
		<?php endif; ?>
    </section>
    <section id="index-filters" class="d-flex mb-3"></section>

	<?php if ( have_posts() ) : ?>
        <section class="mb-3 mb-lg-5">
            <div class="row">
				<?php $key = 0;
				$arr       = array();
				while ( have_posts() ) : the_post();
					$item = '';
					$item .= '<article class="mb-3">';
					ob_start();
					include 'templates/component-box-2.php';
					$item .= ob_get_clean();
					$item .= '</article>';

					if ( ! isset( $arr[ $key ] ) ) {
						$arr[ $key ] = array( 'content' => '' );
					}
					$arr[ $key ]['content'] .= $item;

					if ( $key === 2 ) {
						$key = 0;
					} else {
						$key ++;
					}
				endwhile; ?>
				<?php if ( $arr ): ?>
					<?php foreach ( $arr as $column ): ?>
                        <div class="col-md-4">
							<?php echo $column['content'] ?>
                        </div>
					<?php endforeach; ?>
				<?php endif; ?>
            </div>
            <div class="page-navigation row justify-content-center">
				<?php function_exists( 'wp_pagenavi' ) ? wp_pagenavi() : null; ?>
            </div>
        </section>
	<?php endif; ?>
</main>
<script>
    (function ($) {
        'use strict';
        $(document).ready(function () {

            var searchParams = new URLSearchParams(window.location.search);
            if (searchParams.has('search-type')) {
                $('html, body').animate({
                    scrollTop: $("#js-search-results").offset().top - 70 // less header height
                }, 1500);
            }

            var filters = {};
            var $indexFilters = $('#index-filters');
            $.each($('form').serializeArray(), function (i, field) {
                if (field.name.indexOf('flr_') !== -1 && field.value !== '') {
                    var $inputText = $('[name=' + field.name + '] :selected');
                    var text = $inputText.length > 1 ? $inputText[0].text : $inputText.text();
                    if (!filters[this.name]) {
                        filters[this.name] = text;
                        $indexFilters.append('<div role="button" data-flr="' + field.name + '" class="js-remove-filter cursor-pointer text-color-1 px-1 mx-1 shadow-sm rounded">' + text + '<span class="ml-1"></span><span class="icon-close icon-xxs text-color-3"></span></div>')
                    }
                }
            });
            $('.js-remove-filter').on('click', function () {
                $('[name=' + $(this).data('flr') + ']').prop('selectedIndex', 0);
                $('form.show').submit()
            });


        });
    })(jQuery);
</script>


<?php get_footer() ?>
