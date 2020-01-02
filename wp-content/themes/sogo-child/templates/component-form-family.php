<div class="col-md-9">
    <!--FOLD 1-->
    <div class="col-12 bg-white mb-3 box-shadow py-2">
        <h2 class="h5 mb-2"><?php _e( 'Personal Details', 'sogoc' ) ?></h2>
        <div class="row">
            <div class="col-md-6 mb-2"><?php echo sogo_print_input( __( 'Patient name', 'sogoc' ), 'patient_name', true, sogo_get_user_meta_value( 'patient_name' ) ) ?></div>
            <div class="col-md-6 mb-2"><?php echo sogo_print_radio( __( 'Gender', 'sogoc' ), 'gender', array(
					'male'   => __( 'Male', 'sogoc' ),
					'female' => __( 'Female', 'sogoc' )
				), true, true, sogo_get_user_meta_value( 'gender' ) ) ?></div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-2"><?php echo sogo_print_input( __( 'City', 'sogoc' ), 'city', true, sogo_get_user_meta_value( 'city' ) ) ?></div>
            <div class="col-md-6 mb-2"><?php echo sogo_print_select( __( 'Dependency', 'sogoc' ), 'dependency', array(
					'male'   => __( 'Male', 'sogoc' ),
					'female' => __( 'Female', 'sogoc' )
				), __( 'Select', 'sogoc' ), true, sogo_get_user_meta_value( 'dependency' ) ) ?></div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-2"><?php echo sogo_print_select( __( 'Living inhouse', 'sogoc' ), 'living_inhouse', array(
					'male'   => __( 'Male', 'sogoc' ),
					'female' => __( 'Female', 'sogoc' )
				), __( 'Select', 'sogoc' ), true, sogo_get_user_meta_value( 'living_inhouse' ) ) ?></div>
            <div class="col-md-6 mb-2"><?php echo sogo_print_select( __( 'Nursing status', 'sogoc' ), 'nursing_status', array(
					'male'   => __( 'Male', 'sogoc' ),
					'female' => __( 'Female', 'sogoc' )
				), __( 'Select', 'sogoc' ), true, sogo_get_user_meta_value( 'nursing_status' ) ) ?></div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-2"><?php echo sogo_print_input( __( 'Contact person', 'sogoc' ), 'contact_person', true, sogo_get_user_meta_value( 'contact_person' ) ) ?></div>
            <div class="col-md-6 mb-2"><?php echo sogo_print_input( __( 'Contact phone', 'sogoc' ), 'contact_phone', true, sogo_get_user_meta_value( 'phone' ), 'phone', array( 'type' => 'tel' ) ) ?></div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-2"><?php echo sogo_print_input( __( 'Contact mail', 'sogoc' ), 'email', true, sogo_get_user_meta_value( 'email' ), '', array( 'type' => 'email' ) ) ?></div>
            <div class="col-md-4 mb-2"><?php echo sogo_print_checkbox( '*' . __( 'Confirm', 'sogoc' ) . ' <a href="' . get_field( '_sogo_tac_link', 'option' ) . '"><u>' . __( 'Website policy', 'sogoc' ) . '</u></a>', '', 'confirm', sogo_get_user_meta_value( 'confirm' ) ) ?></div>
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
