<?php
// register scripts
add_action( 'wp_enqueue_scripts', 'efcxf_elementor_script_libs' );
function efcxf_elementor_script_libs (): void {
	$efcxf_check_elementor = get_post_meta( get_the_ID(), '_elementor_edit_mode', true );

	if ( $efcxf_check_elementor == 'builder' ) {
		// bootstrap
		wp_enqueue_style( 'bootstrap', EFCXF_PLUGIN_URL . 'assets/libs/bootstrap/bootstrap.min.css' );
		wp_enqueue_script( 'bootstrap', EFCXF_PLUGIN_URL . 'assets/libs/bootstrap/bootstrap.bundle.min.js', array('jquery'), null, true );

		// owl.carousel
		wp_register_style( 'owl.carousel', EFCXF_PLUGIN_URL . 'assets/libs/owl.carousel/owl.carousel.min.css' );
		wp_register_script('owl.carousel', EFCXF_PLUGIN_URL . 'assets/libs/owl.carousel/owl.carousel.min.js', array('jquery'), '2.3.4', true);

		// js plugin
		wp_register_script( 'efcxf-script', EFCXF_PLUGIN_URL . 'assets/js/elementor-addon.min.js', array( 'jquery' ), EFCXF_PLUGIN_VERSION, true );
	}
}

add_action( 'wp_enqueue_scripts', 'efcxf_elementor_scripts',21 );
function efcxf_elementor_scripts(): void {
	$efcxf_check_elementor = get_post_meta( get_the_ID(), '_elementor_edit_mode', true );

	if ( $efcxf_check_elementor == 'builder' ) {
		// style plugin
		wp_enqueue_style( 'efcxf-style', EFCXF_PLUGIN_URL . 'assets/css/addons.min.css', array(), EFCXF_PLUGIN_VERSION );
	}
}