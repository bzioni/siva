<?php
get_header(); ?>
<main class="container py-3 py-lg-5">
	<?php if ( have_posts() ) : ?>
        <section>
            <div class="row">
				<?php while ( have_posts() ) : the_post(); ?>
                    <article class="col-md-4 mb-3">
                        <?php if(get_post_type() === 'post'): ?>
						<?php include 'templates/component-box-1.php'; ?>
                        <?php else: ?>
						<?php include 'templates/component-box-2.php'; ?>
                        <?php endif; ?>
                    </article>
				<?php endwhile; ?>
            </div>
            <div class="page-navigation row justify-content-center">
				<?php function_exists( 'wp_pagenavi' ) ? wp_pagenavi() : null; ?>
            </div>
        </section>
	<?php endif; ?>
</main>

<?php get_footer(); ?>
