<?php
$labeltype = is_post_type_archive( 'therapists' ) || is_front_page() || is_singular('therapists');
if ( $recommendations ): ?>
    <div class="bg-color-1 d-inline-block text-white mb-1 px-1 <?php echo is_rtl() ? 'rounded-left' : 'rounded-right' ?> <?php echo $labeltype ? 'has-recommendations' : '' ?>">
        <span><?php _e( 'Has recommendations', 'sogoc' ) ?></span>
    </div>
<?php endif; ?>
<div class="mb-1">
    <span class="text-color-3 icon-bubble"></span>
    <span class="ml-1"></span>
    <span><?php _e( 'Languages', 'sogoc' ) ?>:&nbsp;<?php echo sogo_get_post_meta_value( 'languages' ) ?></span>
</div>
<div class="mb-1">
    <span class="text-color-3 icon-star"></span>
    <span class="ml-1"></span>
    <span><?php _e( 'Position type', 'sogoc' ) ?>:&nbsp;<?php echo sogo_get_post_meta_value( 'position_type' ) ?></span>
</div>
<div class="mb-1">
    <span class="text-color-3 icon-location"></span>
    <span class="ml-1"></span>
    <span><?php _e( 'License area', 'sogoc' ) ?>:&nbsp;<?php echo sogo_get_post_meta_value( 'license_area' ) ?></span>
</div>
<div class="mb-1">
    <span class="text-color-3 icon-night"></span>
    <span class="ml-1"></span>
    <span><?php _e( 'Including sleeping', 'sogoc' ) ?>
        :&nbsp;<?php echo sogo_get_post_meta_value( 'including_sleeping' ) === 'true' ? __( 'Yes', 'sogoc' ) : __( 'No', 'sogoc' ) ?></span>
</div>
<div class="mb-1">
    <span class="text-color-3 icon-area"></span>
    <span class="ml-1"></span>
    <span><?php _e( 'Favorite area', 'sogoc' ) ?>:&nbsp;<?php echo sogo_get_post_meta_value( 'favorite_area' ) ?></span>
</div>
