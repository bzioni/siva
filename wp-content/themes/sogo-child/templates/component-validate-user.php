<form class="modal fade" id="validate-user-modal" tabindex="-1" role="dialog" aria-labelledby="validate-user-modal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
				<?php echo sogo_print_input( __( 'Please type the code you got on the phone', 'sogoc' ), 'code', true, '', '', array( 'type' => 'tel' ) ) ?>
            </div>
            <div class="modal-footer d-flex justify-content-center justify-content-md-between">
				<?php sogo_print_btn( array(
					'text'   => __( 'Send code again', 'sogoc' ),
					'button' => true,
					'class'  => 's-btn-2 px-1',
					'id'     => 'js-send-code-again'
				) ) ?>
				<?php sogo_print_btn( array(
					'text'   => __( 'Continue', 'sogoc' ),
					'button' => true,
					'type'   => 'submit',
					'class'  => 's-btn-1 px-1',
				) ) ?>
            </div>
        </div>
    </div>
</form>
