<div class="search-component">
    <?php if(is_front_page()): ?>
        <span class="h3 d-block text-white text-center"><?php _e( 'Find therapists', 'sogoc' ) ?></span>
    <?php endif; ?>
    <ul class="nav nav-tabs px-0 border-bottom-0 d-flex flex-nowrap  overflow-y-hidden" id="myTab" role="tablist">
        <li class="nav-item ">
            <a class="nav-link h4 mb-0 d-flex align-items-center <?php echo ! sogo_isset( 'search-type' ) || sogo_isset( 'search-type', 'regular' ) ? 'active' : '' ?>"
               id="regular-tab"
               data-toggle="tab"
               href="#regular"
               role="tab"
               aria-controls="regular"
               aria-selected="true">
                <span class="icon-user"></span>
                <span class="ml-1 d-inline-block"></span>
                <span class="white-space-nowrap"><?php _e( 'Regular', 'sogoc' ) ?></span>
            </a>
        </li>
        <li class="nav-item" >
            <a class="nav-link h4 mb-0 d-flex align-items-center <?php echo sogo_isset( 'search-type', 'advanced' ) ? 'active' : '' ?>"
               id="advanced-tab"
               data-toggle="tab"
               href="#advanced"
               role="tab"
               aria-controls="advanced"
               aria-selected="false">
                <span class="icon-search"></span>
                <span class="ml-1 d-inline-block"></span>
                <span class="white-space-nowrap"><?php _e( 'Advanced', 'sogoc' ) ?></span>
            </a>
        </li>
    </ul>
    <div class="bg-white py-3 px-md-3 rounded-bottom <?php echo is_rtl() ? 'rounded-left' : 'rounded-right' ?>">
        <div class="tab-content" id="myTabContent">
            <form action="<?php echo is_front_page() ? get_post_type_archive_link('therapists') : '' ?>" class="tab-pane fade col-12 <?php echo ! sogo_isset( 'search-type' ) || sogo_isset( 'search-type', 'regular' ) ? 'show active' : '' ?>" id="regular" role="tabpanel" aria-labelledby="regular-tab">
                <input type="hidden" name="search-type" value="regular">
				<?php $fold_1 = ob_start() ?>
                <div class="row">
                    <div class="col-md-4">
						<?php echo sogo_print_select( __( 'Gender', 'sogoc' ), 'flr_gender', array(
							'male'   => __( 'Male', 'sogoc' ),
							'female' => __( 'Female', 'sogoc' )
						), __( 'Never mind', 'sogoc' ), false, sogo_isset('flr_gender', '', true) ) ?>
                    </div>
                    <div class="col-md-4">
						<?php echo sogo_print_select( __( 'Languages', 'sogoc' ), 'flr_languages', array(
							'male'   => __( 'Male', 'sogoc' ),
							'female' => __( 'Female', 'sogoc' )
						), __( 'Never mind', 'sogoc' ), false, sogo_isset('flr_languages', '', true) ) ?>
                    </div>
                    <div class="col-md-4">
						<?php echo sogo_print_select( __( 'License area', 'sogoc' ), 'flr_license_area', array(
							'male'   => __( 'Male', 'sogoc' ),
							'female' => __( 'Female', 'sogoc' )
						), __( 'All areas', 'sogoc' ), false, sogo_isset('flr_license_area', '', true) ) ?>
                    </div>
                </div>
				<?php
				$fold_1 = ob_get_clean();
				echo $fold_1
				?>
                <div class="text-center mt-2">
					<?php
					sogo_print_btn( array(
						'text'   => __( 'Find therapists', 'sogoc' ),
						'class'  => 's-btn-2',
						'button' => true,
						'type'   => 'submit'
					) );
					?>
                </div>
            </form>
            <form action="<?php echo is_front_page() ? get_post_type_archive_link('therapists') : '' ?>" class="tab-pane fade col-12 <?php echo sogo_isset( 'search-type', 'advanced' ) ? 'show active' : '' ?>" id="advanced" role="tabpanel" aria-labelledby="advanced-tab">
                <input type="hidden" name="search-type" value="advanced">
				<?php echo $fold_1 ?>
                <div class="row">
                    <div class="col-md-4">
						<?php echo sogo_print_select( __( 'Position type', 'sogoc' ), 'flr_position_type', array(
							'male'   => __( 'Male', 'sogoc' ),
							'female' => __( 'Female', 'sogoc' )
						), __( 'All kinds', 'sogoc' ), false, sogo_isset('flr_position_type', '', true) ) ?>
                    </div>
                    <div class="col-md-4">
						<?php echo sogo_print_select( __( 'Favorite area', 'sogoc' ), 'favorite_area', array(
							'male'   => __( 'Male', 'sogoc' ),
							'female' => __( 'Female', 'sogoc' )
						), __( 'Never mind', 'sogoc' ), false, sogo_isset('favorite_area', '', true) ) ?>
                    </div>
                    <div class="col-md-4">
						<?php echo sogo_print_select( __( 'Country', 'sogoc' ), 'flr_country', array(
							'male'   => __( 'Male', 'sogoc' ),
							'female' => __( 'Female', 'sogoc' )
						), __( 'Never mind', 'sogoc' ), false, sogo_isset('flr_country', '', true) ) ?>
                    </div>
                </div>
                <div class="text-center mt-2">
					<?php
					sogo_print_btn( array(
						'text'   => __( 'Find therapists', 'sogoc' ),
						'class'  => 's-btn-2',
						'button' => true,
						'type'   => 'submit'
					) );
					?>
                </div>
            </form>
        </div>
    </div>
</div>
