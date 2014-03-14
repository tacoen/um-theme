<?php 

if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

function umc_scripts() { 
	// return;
}

function umc_styles() {
	// this will bring dashicon and opensans
	// wp_enqueue_style( 'open-sans');
	// wp_enqueue_style( 'dashicons');
}
	

if (! is_admin() ) {
	add_action( 'wp_enqueue_scripts', 'umc_scripts');
	add_action( 'wp_print_styles', 'umc_styles');
}

?>