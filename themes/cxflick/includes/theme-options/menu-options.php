<?php
global $prefix_theme_options;

// Create a section menu
CSF::createSection( $prefix_theme_options, array(
	'title'  => esc_html__( 'Menu', 'cxflick' ),
	'icon'   => 'fas fa-bars',
	'fields' => array(
		// Sticky menu
		array(
			'id'         => 'opt_menu_sticky',
			'type'       => 'switcher',
			'title'      => esc_html__( 'Menu cố định', 'cxflick' ),
			'text_on'    => esc_html__( 'Có', 'cxflick' ),
			'text_off'   => esc_html__( 'Không', 'cxflick' ),
			'text_width' => 80,
			'default'    => true
		),

		// Show cart
		array(
			'id'         => 'opt_menu_cart',
			'type'       => 'switcher',
			'title'      => esc_html__( 'Hiện thị giỏ hàng trên menu', 'cxflick' ),
			'text_on'    => esc_html__( 'Có', 'cxflick' ),
			'text_off'   => esc_html__( 'Không', 'cxflick' ),
			'text_width' => 80,
			'default'    => true
		),
	)
) );