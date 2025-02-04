<?php
global $prefix_theme_options;

//
// -> Create a section blog (parent)
CSF::createSection( $prefix_theme_options, array(
	'id'    => 'opt_post_section',
	'icon'  => 'fas fa-blog',
	'title' => esc_html__( 'Bài viết', 'cxflick' ),
) );

// Category Post
CSF::createSection( $prefix_theme_options, array(
	'parent'      => 'opt_post_section',
	'title'       => esc_html__( 'Danh mục', 'cxflick' ),
	'description' => esc_html__( 'Sử dụng cho các trang archive, index, tìm kiếm', 'cxflick' ),
	'fields'      => array(
		// Sidebar
		array(
			'id'      => 'opt_post_cat_sidebar_position',
			'type'    => 'select',
			'title'   => esc_html__( 'Vị trí sidebar', 'cxflick' ),
			'options' => array(
				'hide'  => esc_html__( 'Ẩn', 'cxflick' ),
				'left'  => esc_html__( 'Trái', 'cxflick' ),
				'right' => esc_html__( 'Phải', 'cxflick' ),
			),
			'default' => 'right'
		),

		// Per Row
		array(
			'id'      => 'opt_post_cat_per_row',
			'type'    => 'select',
			'title'   => esc_html__( 'Số bài viết trên mỗi hàng', 'cxflick' ),
			'options' => array(
				'3' => esc_html__( '3', 'cxflick' ),
				'4' => esc_html__( '4', 'cxflick' ),
			),
			'default' => '3'
		),
	)
) );

// Single Post
CSF::createSection( $prefix_theme_options, array(
	'parent' => 'opt_post_section',
	'title'  => esc_html__( 'Bài viết chi tiết', 'cxflick' ),
	'fields' => array(
		array(
			'id'      => 'opt_post_single_sidebar_position',
			'type'    => 'select',
			'title'   => esc_html__( 'Vị trí sidebar', 'cxflick' ),
			'options' => array(
				'hide'  => esc_html__( 'Ẩn', 'cxflick' ),
				'left'  => esc_html__( 'Trái', 'cxflick' ),
				'right' => esc_html__( 'Phải', 'cxflick' ),
			),
			'default' => 'right'
		),

		// Show related post
		array(
			'id'         => 'opt_post_single_related',
			'type'       => 'switcher',
			'title'      => esc_html__( 'Hiện thị bài viết liên quan', 'cxflick' ),
			'text_on'    => esc_html__( 'Có', 'cxflick' ),
			'text_off'   => esc_html__( 'Không', 'cxflick' ),
			'default'    => true,
			'text_width' => 80
		),

		// Limit related post
		array(
			'id'      => 'opt_post_single_related_limit',
			'type'    => 'number',
			'title'   => esc_html__( 'Số lượng bài viết liên quan', 'cxflick' ),
			'default' => 3,
		),
	)
) );