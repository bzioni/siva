<?php if ( ! is_post_type_archive( 'therapists' ) ): ?>
    <a href="<?php echo get_post_type_archive_link( 'therapists' ) ?>" id="js-cta"
       class="bg-color-1 border-2 border-white rounded-circle position-fixed pos-b-3 pos-l-3 z-index-2 p-4 hvr-grow shadow">
    <span class="xy-align text-white text-center">
        <?php the_field( '_sogo_cta_text', 'option' ) ?>
    </span>
    </a>
<?php endif; ?>

