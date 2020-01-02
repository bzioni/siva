<?php
get_header();
the_post();
$img   = get_field( '_sogo_404_bg', 'option' );
$title = get_field( '_sogo_404_title', 'option' );
$text  = get_field( '_sogo_404_text', 'option' );
?>
<main class="pb-5">
    <section>
		<?php
        echo wp_get_attachment_image( $img, 'full', false, array( 'class' => 'img-fluid' ) );
		get_template_part( 'templates/component', 'breadcrumbs' )
		?>
        <div class="container">
            <h1 class="mb-3 text-color-1 mt-3 text-center s-title-color-3 s-title-center"><?php echo $title ?></h1>
            <div class="entry-content mb-4 text-center">
				<?php echo $text ?>
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
