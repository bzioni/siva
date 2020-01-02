<div class="pb-2 text-center">
    <div class="hover-box-1 mb-3">
        <div class="on-hover xy-align w-100 h-100 d-flex align-items-center justify-content-center">
            <div class="w-100 h-100 bg-opacity xy-align z-index-1"></div>
			<?php sogo_print_btn( array(
				'href'  => get_the_permalink(),
				'text'  => __( 'Read more', 'sogoc' ),
				'class' => 's-btn-2 z-index-2'
			) ) ?>
        </div>
		<?php the_post_thumbnail( 'post-thumbnail', array( "class" => "d-inline-block img-fluid rounded" ) ) ?>
    </div>
    <a href="<?php the_permalink() ?>">
        <span class="h4 px-2 text-color-1-simple d-block height-limit-title hover-color-3 transition"><?php the_title() ?></span>
    </a>
    <div class="entry-content px-2 height-limit-text"><?php the_excerpt() ?></div>
</div>
