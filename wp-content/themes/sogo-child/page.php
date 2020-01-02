<?php
get_header();
?>
<main class="container pb-5">
	<?php while ( have_posts() ) : the_post(); ?>
        <section>
			<?php the_post_thumbnail( 'full', array( 'class' => 'img-fluid mb-3' ) ) ?>
            <div class="entry-content mb-2">
				<?php the_content() ?>
            </div>
        </section>
	<?php endwhile; ?>
</main>
<?php get_footer() ?>
