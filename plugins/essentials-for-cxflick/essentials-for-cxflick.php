<?php
/**
 * Plugin Name: Essentials For CXFlick Theme
 * Plugin URI: https://example.com/
 * Description: A plugin that provides additional widgets and features for Elementor.
 * Version: 1.0
 * Author: La Khắc Điệp
 * Author URI: https://example.com/
 * Text Domain: essentials-for-cxflick
 * Domain Path: /languages
 */

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Define constants
const EFCXF_PLUGIN_VERSION = '1.0';
define( 'EFCXF_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
define( 'EFCXF_PLUGIN_URL', plugin_dir_url( __FILE__ ) );


// check active plugin elementor
add_action( 'plugins_loaded', 'efcxf_check_elementor' );
function efcxf_check_elementor(): void {
	if ( ! did_action( 'elementor/loaded' ) ) {
		add_action( 'admin_notices', 'efcxf_elementor_missing_notice' );

        return;
	}

	// Load core functionality
	require_once EFCXF_PLUGIN_PATH . 'includes/helpers.php';
	require_once EFCXF_PLUGIN_PATH . 'includes/enqueue.php';
	require_once EFCXF_PLUGIN_PATH . 'includes/widgets.php';

    // create category addons
	add_action( 'elementor/elements/categories_registered', 'efcxf_add_elementor_widget_categories' );
}

// notice not active elementor
function efcxf_elementor_missing_notice(): void {
	?>
    <div class="notice notice-error is-dismissible">
        <p><?php esc_html_e( 'Essentials for Basic plugin requires Elementor to be installed and activated.', 'essentials-for-cxflick' ); ?></p>
    </div>
	<?php
}

// Register widget category
function efcxf_add_elementor_widget_categories( $elements_manager ): void {
	$elements_manager->add_category(
		'efcxf-addons',
		[
			'title' => esc_html__( 'Essentials Addons', 'essentials-for-cxflick' ),
			'icon'  => 'icon-goes-here',
		]
	);
}