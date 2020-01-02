<?php
get_header();
the_post();
?>

<main class="container py-3 py-md-4">
    <article>
        <div class="row mb-3 flex-md-row-reverse">
            <div class="col-lg-6 text-center mb-3">
				<?php the_post_thumbnail( 'full', array( "class" => "img-fluid" ) ); ?>
            </div>
            <div class="col-lg-6">
                <div class="entry-content border-color-3 border-bottom-1">
			        <?php the_content(); ?>
                </div>
                <div class="d-flex align-items-center justify-content-between my-2 my-lg-1">
			        <?php
			        $recipe_terms = get_the_terms( get_the_ID(), 'category' );
			        if ( $recipe_terms ):
				        ?>
                        <!-- terms -->
                        <div>

                            <span><?php _e( 'Categories', 'sogoc' ); ?>:</span>

					        <?php


					        $recipe_terms_count = count( $recipe_terms );
					        $index              = 1;
					        //the $term_ids is used more down in the code - for the section more recipes
					        $term_ids = array();
					        foreach ( $recipe_terms as $recipe_term ): ?>

                                <a href="<?php echo get_term_link( $recipe_term->term_id, 'category' ) ?>"
                                   class="text-color-3">
                                    <u>
								        <?php echo $recipe_term->name;
								        echo $index > $recipe_terms_count - 1 ? '' : ', ';
								        ?>
                                    </u>
                                </a>

						        <?php
						        array_push( $term_ids, $recipe_term->term_id );
						        $index ++;
					        endforeach; ?>

                        </div>
			        <?php endif; ?>
                    <!-- share btn's -->
			        <?php echo do_shortcode( '[addtoany]' ); ?>

                </div>
            </div>
        </div>
    </article>
    <section>
		<?php $related_title = __( 'More articles', 'sogoc' );
		include "templates/content-more-articles.php"; ?>
        <div class="text-center">
		    <?php sogo_print_btn( array(
			    'href'  => get_post_type_archive_link( 'post' ),
			    'text'  => __('More articles', 'sogoc'),
			    'class' => 's-btn-1'
		    ) ) ?>
        </div>
    </section>
</main>
<?php get_footer(); ?>
