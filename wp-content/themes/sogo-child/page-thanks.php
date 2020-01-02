<?php // Template Name: Thanks page
get_header();
the_post();
?>
<main class="pb-5">
    <section>
		<?php the_post_thumbnail( 'full', array( 'class' => 'img-fluid' ) );
		get_template_part( 'templates/component', 'breadcrumbs' )
		?>
        <div class="container">
            <h1 class="mb-3 text-color-1 text-center mt-3 s-title-color-3 s-title-center"><?php the_title() ?></h1>
            <div class="entry-content mb-4 text-center">
				<?php the_content() ?>
            </div>
            <div class="text-center">
				<?php sogo_print_btn( array(
					'href'  => home_url(),
					'text'  => __( 'Back to homepage', 'sogoc' ),
					'class' => 's-btn-1'
				) ) ?>
            </div>
        </div>
    </section>
</main>
<?php get_footer() ?>
