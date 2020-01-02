<?php
$post_id = get_the_ID();
set_query_var( 'post_id', get_the_ID() );
$gender          = sogo_get_post_meta_value( 'gender' );
$recommendations = sogo_get_post_meta_value( 'recommendations' )
?>
<div class="component-box-2 d-block bg-white px-3 pt-2 overflow-hidden rounded position-relative box-shadow">
    <div class="row mb-3 align-items-center">
        <div class="col-md-4">
			<?php include 'component-therapist-avatar.php'; ?>
        </div>

        <div class="col-md-8">
			<?php include 'component-therapist-title.php'; ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-10">
			<?php include 'component-therapist-main-info.php'; ?>
        </div>
    </div>
    <a href="<?php the_permalink() ?>" class="d-flex bg-color-1 x-align w-100 pos-b-0 align-items-center justify-content-center" style="height: 40px">
        <span class="text-white"><?php _e( 'For more info', 'sogoc' ) ?></span>
    </a>
</div>

