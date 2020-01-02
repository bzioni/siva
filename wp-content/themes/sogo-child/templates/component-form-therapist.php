<div class="col-md-9">
    <!--FOLD 1-->
    <div class="col-12">
        <div class="row bg-white mb-3 box-shadow py-2">
            <div class="col-md-3">
                <div class="position-relative text-center">
					<?php
					$post_id    = get_query_var( 'post_id' );
					$has_avatar = has_post_thumbnail( $post_id );
					$default    = 'defaultman';
					if ( is_user_logged_in() && ! $has_avatar && sogo_get_post_meta_value( 'gender' ) === 'female' ) {
						$default = 'defaultwoman';
					}
					?>
                    <div class="rounded-circle overflow-hidden mx-auto position-relative avatar-img-wrapper border-1 border-color-2">
                        <img src="
					<?php echo $has_avatar ? get_the_post_thumbnail_url( $post_id, 'full' ) : get_stylesheet_directory_uri() . "/assets/images/{$default}.jpg" ?>"
                             alt="Profile image"
                             class="h-100 xy-align"
                             id="avatar-img">
                    </div>
                    <label for="avatar" class="p-2 position-absolute bg-color-3 rounded-circle x-align pos-b-0 mb-0 cursor-pointer"
                           style="transform: translateX(1rem)">
                        <span class="<?php echo $has_avatar ? 'icon-pencil' : 'icon-plus' ?> xy-align text-white"></span>
                    </label>
                    <input type="file" name="avatar" id="avatar" accept=".png, .jpg, .jpeg" class="sr-only">
                </div>
            </div>
            <div class="col-md-9">
                <h2 class="h5 mb-2"><?php _e( 'Personal Details', 'sogoc' ) ?></h2>
                <div class="row">
                    <div class="col-md-6 mb-2"><?php echo sogo_print_input( __( 'First name', 'sogoc' ), 'first_name', true, sogo_get_post_meta_value( 'first_name' ) ) ?></div>
                    <div class="col-md-6 mb-2"><?php echo sogo_print_input( __( 'Last name', 'sogoc' ), 'last_name', true, sogo_get_post_meta_value( 'last_name' ) ) ?></div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-2"><?php echo sogo_print_radio( __( 'Gender', 'sogoc' ), 'gender', array(
							'male'   => __( 'Male', 'sogoc' ),
							'female' => __( 'Female', 'sogoc' )
						), true, true, sogo_get_post_meta_value( 'gender' ) ) ?></div>
                    <div class="col-md-6 mb-2"><?php echo sogo_print_input( __( 'Country', 'sogoc' ), 'country', true, sogo_get_post_meta_value( 'country' ) ) ?></div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-2"><?php echo sogo_print_input( __( 'Phone', 'sogoc' ), 'phone', true, sogo_get_post_meta_value( 'phone' ), '', array( 'type' => 'tel' ) ) ?></div>
                    <div class="col-md-6 mb-2"><?php echo sogo_print_input( __( 'Email', 'sogoc' ), 'email', true, sogo_get_post_meta_value( 'email' ), '', array( 'type' => 'email' ) ) ?></div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-2"><?php echo sogo_print_select( __( 'License area', 'sogoc' ), 'license_area', array(
							'male'   => __( 'Male', 'sogoc' ),
							'female' => __( 'Female', 'sogoc' )
						), __( 'Select license area', 'sogoc' ), true, sogo_get_post_meta_value( 'license_area' ) ) ?></div>
                    <div class="col-md-6 mb-2"><?php echo sogo_print_select( __( 'Favorite area', 'sogoc' ), 'favorite_area', array(
							'male'   => __( 'Male', 'sogoc' ),
							'female' => __( 'Female', 'sogoc' )
						), __( 'Select favorite area', 'sogoc' ), true, sogo_get_post_meta_value( 'favorite_area' ) ) ?></div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-2"><?php echo sogo_print_select( __( 'Languages', 'sogoc' ), 'languages', array(
							'male'   => __( 'Male', 'sogoc' ),
							'female' => __( 'Female', 'sogoc' )
						), __( 'Select languages', 'sogoc' ), true, sogo_get_post_meta_value( 'languages' ), '' ) ?></div>
                    <div class="col-md-6 mb-2"><?php echo sogo_print_select( __( 'Position type', 'sogoc' ), 'position_type', array(
							'male'   => __( 'Male', 'sogoc' ),
							'female' => __( 'Female', 'sogoc' )
						), __( 'Select position type', 'sogoc' ), true, sogo_get_post_meta_value( 'position_type' ) ) ?></div>
                </div>
            </div>
        </div>
    </div>
    <!--FOLD 2-->
    <div class="col-12">
        <div class="row bg-white mb-3 box-shadow py-2">
            <div class="col-md-12">
                <div class="row py-2">
                    <div class="col-12"><?php echo sogo_print_textarea( __( 'About me', 'sogoc' ), 'about_me', '', sogo_get_post_meta_value( 'about_me' ) ) ?></div>
                </div>
                <div class="border-bottom-1 border-color-3"></div>
                <div class="row pt-3 pb-2">
                    <div class="col-12"><?php echo sogo_print_textarea( __( 'Recommendations', 'sogoc' ), 'recommendations', '', sogo_get_post_meta_value( 'recommendations' ) ) ?></div>
                </div>
                <div class="border-bottom-1 border-color-3"></div>
                <div class="row pt-3 pb-2">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-md-3 mb-2">
                                <span><?php _e( 'My preferences', 'sogoc' ) ?></span>
                            </div>
                            <div class="col-md-9">
                                <div class="row">
                                    <div class="col-md-4  mb-2"><?php echo sogo_print_checkbox( __( 'Work with women', 'sogoc' ), '', 'work_with_women', sogo_get_post_meta_value( 'work_with_women' ) ) ?></div>
                                    <div class="col-md-4 mb-2"><?php echo sogo_print_checkbox( __( 'Work with men', 'sogoc' ), '', 'work_with_men', sogo_get_post_meta_value( 'work_with_men' ) ) ?></div>
                                    <div class="col-md-4 mb-2"><?php echo sogo_print_checkbox( __( 'Including weekends', 'sogoc' ), '', 'including_weekends', sogo_get_post_meta_value( 'including_weekends' ) ) ?></div>
                                    <div class="col-md-4 mb-2"><?php echo sogo_print_checkbox( __( 'Like animals', 'sogoc' ), '', 'like_animals', sogo_get_post_meta_value( 'like_animals' ) ) ?></div>
                                    <div class="col-md-4 mb-2"><?php echo sogo_print_checkbox( __( 'Including sleeping', 'sogoc' ), '', 'including_sleeping', sogo_get_post_meta_value( 'including_sleeping' ) ) ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="border-bottom-1 border-color-3"></div>
                <div class="row pt-3 pb-2">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-md-3 mb-2">
                                <span><?php _e( 'My capabilities', 'sogoc' ) ?></span>
                            </div>
                            <div class="col-md-9">
                                <div class="row">
                                    <div class="col-md-4 mb-2"><?php echo sogo_print_checkbox( __( 'Cooking', 'sogoc' ), '', 'cooking', sogo_get_post_meta_value( 'cooking' ) ) ?></div>
                                    <div class="col-md-4  mb-2"><?php echo sogo_print_checkbox( __( 'Dressing', 'sogoc' ), '', 'dressing', sogo_get_post_meta_value( 'dressing' ) ) ?></div>
                                    <div class="col-md-4 mb-2"><?php echo sogo_print_checkbox( __( 'Cleaning', 'sogoc' ), '', 'cleaning', sogo_get_post_meta_value( 'cleaning' ) ) ?></div>
                                    <div class="col-md-4 mb-2"><?php echo sogo_print_checkbox( __( 'Diapers', 'sogoc' ), '', 'diapers', sogo_get_post_meta_value( 'diapers' ) ) ?></div>
                                    <div class="col-md-4 mb-2"><?php echo sogo_print_checkbox( __( 'Washing', 'sogoc' ), '', 'washing', sogo_get_post_meta_value( 'washing' ) ) ?></div>
                                    <div class="col-md-4 mb-2"><?php echo sogo_print_checkbox( __( 'Lifting', 'sogoc' ), '', 'lifting', sogo_get_post_meta_value( 'lifting' ) ) ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="border-bottom-1 border-color-3"></div>
                <div class="row pt-3 pb-2">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-md-3 mb-2">
                                <span><?php _e( 'More info', 'sogoc' ) ?></span>
                            </div>
                            <div class="col-md-9">
                                <div class="row">
                                    <div class="col-md-4 mb-2"><?php echo sogo_print_checkbox( __( 'Certified first aid', 'sogoc' ), '', 'certified_first_aid', sogo_get_post_meta_value( 'certified_first_aid' ) ) ?></div>
                                    <div class="col-md-4 mb-2"><?php echo sogo_print_checkbox( __( 'Certified CPR', 'sogoc' ), '', 'certified_cpr', sogo_get_post_meta_value( 'certified_cpr' ) ) ?></div>
                                    <div class="col-md-4 mb-2"><?php echo sogo_print_checkbox( __( 'Driving license', 'sogoc' ), '', 'driving_license', sogo_get_post_meta_value( 'driving_license' ) ) ?></div>
                                    <div class="col-md-4 mb-2"><?php echo sogo_print_checkbox( __( 'Smoking', 'sogoc' ), '', 'smoking', sogo_get_post_meta_value( 'smoking' ) ) ?></div>
                                    <div class="col-md-4 mb-2"><?php echo sogo_print_checkbox( __( 'Computers', 'sogoc' ), '', 'computers', sogo_get_post_meta_value( 'computers' ) ) ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="border-bottom-1 border-color-3"></div>
                <div class="row pt-3">
                    <div class="col-12"><?php echo sogo_print_textarea( __( 'Professional experience', 'sogoc' ), 'professional_experience', '', sogo_get_post_meta_value( 'professional_experience' ) ) ?></div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 d-flex justify-content-end">
			<?php
			if ( is_user_logged_in() ) {
				sogo_print_btn( array(
					'text'  => __( 'Logout', 'sogoc' ),
					'class' => 's-btn-danger mx-2',
					'href'  => site_url( "/" . wpm_get_language() . "/?logout=true" )
				) );
			}
			?>
			<?php
			sogo_print_btn( array(
				'text'   => get_page_template_slug() === 'page-signup.php' ? __( 'Signup', 'sogoc' ) : __( 'Update', 'sogoc' ),
				'class'  => 's-btn-1',
				'button' => true,
				'type'   => 'submit'
			) );
			?>

        </div>
    </div>
</div>

<div class="col-md-3">
    <div class="bg-color-1 text-white p-2">
        <span class="h3 d-block"><?php _e( 'Settings', 'sogoc' ) ?></span>
        <div class="border-bottom-1 border-white mb-2"></div>
		<?php
		$value = sogo_get_post_meta_value( 'account_active' );
		echo sogo_print_radio( __( 'Account status', 'sogoc' ), 'account_active', array(
			'publish' => __( 'Account active', 'sogoc' ),
			'draft'   => __( 'Account not active', 'sogoc' )
		), '', true, ( ! empty( $value ) ? sogo_get_post_meta_value( 'account_active' ) : 'publish' ) ) ?>
    </div>
</div>
