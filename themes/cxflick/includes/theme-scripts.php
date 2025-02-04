<?php
// Register Back-End script
add_action('admin_enqueue_scripts', 'cxflick_register_back_end_scripts');
function cxflick_register_back_end_scripts(): void {
	/* Start Get CSS Admin */
	wp_enqueue_style( 'admin', get_theme_file_uri( '/backend/assets/css/admin.css' ) );

	wp_enqueue_script( 'admin', get_theme_file_uri( '/backend/assets/js/admin.js' ), array('jquery'), cxflick_get_version_theme(), true );
}

// Remove jquery migrate
add_action( 'wp_default_scripts', 'cxflick_remove_jquery_migrate' );
function cxflick_remove_jquery_migrate( $scripts ): void {
	if ( ! is_admin() && isset( $scripts->registered['jquery'] ) ) {
		$script = $scripts->registered['jquery'];
		if ( $script->deps ) {
			$script->deps = array_diff( $script->deps, array( 'jquery-migrate' ) );
		}
	}
}

// load libs front-end style +scrip
add_action('wp_enqueue_scripts', 'cxflick_front_end_libs', 5);
function cxflick_front_end_libs(): void {
	// remove style gutenberg
	wp_dequeue_style('wp-block-library');
	wp_dequeue_style('wp-block-library-theme');
	wp_dequeue_style( 'classic-theme-styles' );

	wp_dequeue_style('wc-blocks-style');
	wp_dequeue_style('storefront-gutenberg-blocks');

	// bootstrap css
	wp_enqueue_style( 'bootstrap', get_theme_file_uri( '/assets/libs/bootstrap/bootstrap.min.css' ), array(), null );
	wp_enqueue_script( 'bootstrap', get_theme_file_uri( '/assets/libs/bootstrap/bootstrap.bundle.min.js' ), array('jquery'), null, true );

	// fontawesome
	wp_enqueue_style( 'fontawesome', get_theme_file_uri( '/assets/libs/fontawesome/css/fontawesome.min.css' ), array(), '6.7.2' );
}

// load front-end styles
add_action('wp_enqueue_scripts', 'cxflick_front_end_scripts', 22);
function cxflick_front_end_scripts (): void {
	/** Load css **/

	// style theme
	wp_enqueue_style( 'cxflick-style', get_theme_file_uri( '/assets/css/style-theme.min.css' ), array(), cxflick_get_version_theme() );

	// style post
	if ( cxflick_is_blog() ) {
		wp_enqueue_style( 'category-post', get_theme_file_uri( '/assets/css/post-type/post/archive.min.css' ), array(), cxflick_get_version_theme() );
	}

	if (is_singular('post')) {
		wp_enqueue_style( 'single-post', get_theme_file_uri( '/assets/css/post-type/post/single.min.css' ), array(), cxflick_get_version_theme() );
	}

	// style page 404
	if ( is_404() ) {
		wp_enqueue_style( 'page-404', get_theme_file_uri( '/assets/css/page-templates/page-404.min.css' ), array(), cxflick_get_version_theme() );
	}

	/** Load js **/
	// comment reply
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// custom js
	wp_enqueue_script( 'cxflick-custom', get_theme_file_uri( '/assets/js/custom.min.js' ), array('jquery'), cxflick_get_version_theme(), true );
}