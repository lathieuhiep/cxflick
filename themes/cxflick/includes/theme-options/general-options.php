<?php
global $prefix_theme_options;

// Create a section general
CSF::createSection( $prefix_theme_options, array(
	'title'  => esc_html__( 'Cài đặt chung', 'cxflick' ),
	'icon'   => 'fas fa-cog',
	'fields' => array(
		// logo
		array(
			'id'      => 'opt_general_logo',
			'type'    => 'media',
			'title'   => esc_html__( 'Chọn ảnh logo', 'cxflick' ),
			'library' => 'image',
			'url'     => false
		),

		// show loading
		array(
			'id'         => 'opt_general_loading',
			'type'       => 'switcher',
			'title'      => esc_html__( 'Hiện tải trang', 'cxflick' ),
			'text_on'    => esc_html__( 'Có', 'cxflick' ),
			'text_off'   => esc_html__( 'Không', 'cxflick' ),
			'text_width' => 80,
			'default'    => false
		),

		array(
			'id'         => 'opt_general_image_loading',
			'type'       => 'media',
			'title'      => esc_html__( 'Chọn ảnh tải trang', 'cxflick' ),
			'subtitle'   => esc_html__( 'Sử dụng ảnh .git', 'cxflick' ) . ' <a href="https://loading.io/" target="_blank">loading.io</a>',
			'dependency' => array( 'opt_general_loading', '==', 'true' ),
			'url'        => false
		),

		// show back to top
		array(
			'id'         => 'opt_general_back_to_top',
			'type'       => 'switcher',
			'title'      => esc_html__( 'Hiện nút quay về đầu trang', 'cxflick' ),
			'text_on'    => esc_html__( 'Có', 'cxflick' ),
			'text_off'   => esc_html__( 'Không', 'cxflick' ),
			'text_width' => 80,
			'default'    => true
		),
	)
) );