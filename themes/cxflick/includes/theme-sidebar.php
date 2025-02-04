<?php
/* Better way to add multiple widgets areas */
function cxflick_register_sidebar( $name, $id, $description = '' ): void {
	register_sidebar( array(
		'name'          => $name,
		'id'            => $id,
		'description'   => $description,
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}

add_action( 'widgets_init', 'cxflick_multiple_widget_init' );
function cxflick_multiple_widget_init(): void {
	cxflick_register_sidebar( esc_html__( 'Sidebar Chính', 'cxflick' ), 'sidebar-main', 'Dùng ở các trang bài viết' );

	cxflick_register_sidebar( esc_html__( 'Sidebar Shop', 'cxflick' ), 'sidebar-wc', esc_html__( 'Dùng ở trang danh mục sản phẩm.', 'cxflick' ) );

	cxflick_register_sidebar( esc_html__( 'Sidebar Product', 'cxflick' ), 'sidebar-wc-product', esc_html__( 'Dùng cho trang chi tiết sản phẩm', 'cxflick' ) );

	// sidebar footer
	$opt_number_columns = cxflick_get_option( 'opt_footer_columns', '4' );
	for ( $i = 1; $i <= $opt_number_columns; $i ++ ) {
		cxflick_register_sidebar( esc_html__( 'Sidebar Footer Column ' . $i, 'cxflick' ), 'sidebar-footer-column-' . $i, 'Dùng ở chân trang' );
	}
}