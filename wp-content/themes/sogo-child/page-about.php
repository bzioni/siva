<?php // Template Name: About page
get_header();
the_post();
$tabs_title = get_field( '_sogo_about_tabs_title' );
$tabs_subtitle = get_field( '_sogo_about_tabs_subtitle' );
$tabs_bg    = get_field( '_sogo_about_tabs_bg' );
$tabs       = get_field( '_sogo_about_tabs' );
?>
<main class="pt-3">
    <section class="container mb-3 mb-md-5">
        <div class="row">
            <div class="col-md-6 entry-content mb-3 mb-lg-4">
				<?php the_content() ?>
            </div>
            <div class="col-md-6">
				<?php the_post_thumbnail( 'full', array( "class" => "img-fluid" ) ); ?>
            </div>
        </div>
    </section>
	<?php if ( $tabs ): ?>
        <section class="pt-4 pb-4 pb-md-5 mt-3 position-relative" <?php echo sogo_print_bg( array( 'url' => $tabs_bg ) ) ?>>
            <div class="position-absolute pos-b-0 pos-r-0 z-index-2 d-none d-md-block">
		        <?php echo wp_get_attachment_image( get_field('_sogo_about_tabs_right_img'), 'full', false, array( 'class' => 'img-fluid' ) ) ?>
            </div>
            <div class="position-absolute pos-b-0 pos-l-0 z-index-2 d-none d-md-block">
		        <?php echo wp_get_attachment_image( get_field('_sogo_about_tabs_left_img'), 'full', false, array( 'class' => 'img-fluid' ) ) ?>
            </div>
            <div class="w-100 h-100 bg-opacity xy-align z-index-1"></div>
            <div class="container position-relative z-index-2">
                <div class="row bg-white mx-2 mx-md-0">
                    <div class="py-3 col-md-10 mx-auto">
                        <h3 class="h1 text-color-1 text-center"><?php echo $tabs_title ?></h3>
                        <span class="h4 text-color-1 text-center d-block"><?php echo $tabs_subtitle ?></span>
                        <ul class="nav p-0 justify-content-around mb-3" id="myTab" role="tablist">
							<?php foreach ( $tabs as $key => $tab ): ?>
                                <li class="nav-item flex-grow-1 text-center">
                                    <a class="nav-link text-color-1-simple h6 mb-0 <?php echo $key === 0 ? 'active' : '' ?>" id="tab-id-<?php echo $key ?>" data-toggle="tab"
                                       href="#tab-<?php echo $key ?>" role="tab" aria-controls="tab-<?php echo $key ?>"
                                       aria-selected="<?php echo $key === 0 ? 'true' : '' ?>"><?php echo $tab['title'] ?></a>
                                </li>
							<?php endforeach; ?>
                        </ul>
                        <div class="tab-content" id="myTabContent">
							<?php foreach ( $tabs as $key => $tab ): ?>
                                <div class="tab-pane <?php echo $key === 0 ? 'show active' : '' ?>" id="tab-<?php echo $key ?>" role="tabpanel"
                                     aria-labelledby="tab-<?php echo $key ?>">
                                    <div class="entry-content">
										<?php echo $tab['text'] ?>
                                    </div>
                                </div>
							<?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
	<?php endif; ?>


</main>
<?php get_footer() ?>
