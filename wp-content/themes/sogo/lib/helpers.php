<?php

function sogo_is_woocommerce() {
	if ( class_exists( 'woocommerce' ) ) {
		return true;
	}

	return false;
}

