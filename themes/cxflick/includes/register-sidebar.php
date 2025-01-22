<?php
// Remove gutenberg widgets
add_filter('use_widgets_block_editor', '__return_false');

/* Better way to add multiple widgets areas */
function cxflick_widget_registration($name, $id, $description = ''): void {
	register_sidebar( array(
		'name' => $name,
		'id' => $id,
		'description' => $description,
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget' => '</section>',
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>',
	));
}

function cxflick_multiple_widget_init(): void {
	cxflick_widget_registration( esc_html__('Sidebar Main', 'cxflick'), 'sidebar-main' );
	cxflick_widget_registration( esc_html__('Sidebar Shop', 'cxflick'), 'sidebar-wc', esc_html__('Display sidebar on page shop.', 'cxflick') );
	cxflick_widget_registration( esc_html__('Sidebar Product', 'cxflick'), 'sidebar-wc-product', esc_html__('Display sidebar on page single product.', 'cxflick') );

	// sidebar footer
	$opt_number_columns = cxflick_get_option('opt_footer_columns', '4');
	for ( $i = 1; $i <= $opt_number_columns; $i++ ) {
		cxflick_widget_registration( esc_html__('Sidebar Footer Column ' . $i, 'cxflick'), 'sidebar-footer-column-' . $i );
	}
}

add_action('widgets_init', 'cxflick_multiple_widget_init');