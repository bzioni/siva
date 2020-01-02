<div class="text-center text-md-<?php echo is_rtl() ? 'right' : 'left' ?>">
    <span class="d-block text-color-3 h3 mb-0"><?php echo sogo_get_post_meta_value( 'first_name' ) . ' ' . sogo_get_post_meta_value( 'last_name' ) ?></span>
    <span class="d-block h6 mb-0">
    <?php echo $gender === 'male' ? __( 'Male therapist', 'sogoc' ) : __( 'Female therapist', 'sogoc' ) ?>
        &#183; <?php echo sogo_get_post_meta_value( 'country' ) ?>
    </span>
</div>
