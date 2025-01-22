<?php
// add property
add_action( 'wp_head', 'cxflick_opengraph', 5 );
function cxflick_opengraph(): void {
	global $post;

	if ( is_single() ) :
		if ( has_post_thumbnail( $post->ID ) ) :
			$img_src = get_the_post_thumbnail_url( get_the_ID(), 'full' );
		else :
			$img_src = get_theme_file_uri( '/images/no-image.png' );
		endif;

		$excerpt = $post->post_excerpt;

		if ( $excerpt ) :
			$excerpt = strip_tags( $post->post_excerpt );
			$excerpt = str_replace( "", "'", $excerpt );
		else :
			$excerpt = get_bloginfo( 'description' );
		endif;

		?>
		<meta property="og:url" content="<?php the_permalink(); ?>" />
		<meta property="og:type" content="website" />
		<meta property="og:title" content="<?php the_title(); ?>" />
		<meta property="og:description" content="<?php echo esc_attr( $excerpt ); ?>" />
		<meta property="og:image" content="<?php echo esc_url( $img_src ); ?>" />
	<?php
	endif;
}

// Sanitize Pagination
add_action( 'navigation_markup_template', 'cxflick_sanitize_pagination' );
function cxflick_sanitize_pagination( $cxflick_content ): string {
	// Remove role attribute
	$cxflick_content = str_replace( 'role="navigation"', '', $cxflick_content );

	// Remove h2 tag
	return preg_replace( '#<h2.*?>(.*?)<\/h2>#si', '', $cxflick_content );
}

// Walker for the main menu
add_filter( 'walker_nav_menu_start_el', 'cxflick_add_arrow',10,4);
function cxflick_add_arrow( $output, $item, $depth, $args ){
	if('primary' == $args->theme_location && $depth >= 0 ){
		if (in_array("menu-item-has-children", $item->classes)) {
			$output .='<span class="sub-menu-toggle"></span>';
		}
	}

	return $output;
}

// Custom Search Post
add_action( 'pre_get_posts', 'cxflick_include_custom_post_types_in_search_results' );
function cxflick_include_custom_post_types_in_search_results( $query ): void {
	if ( $query->is_main_query() && $query->is_search() && ! is_admin() ) {
		$query->set( 'post_type', array( 'post' ) );
	}
}

//Disable emojis in WordPress
add_action( 'init', 'cxflick_disable_emojis' );
function cxflick_disable_emojis() {
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
	add_filter( 'tiny_mce_plugins', 'cxflick_disable_emojis_tinymce' );
}

function cxflick_disable_emojis_tinymce( $plugins ) {
	if ( is_array( $plugins ) ) {
		return array_diff( $plugins, array( 'wpemoji' ) );
	} else {
		return array();
	}
}
