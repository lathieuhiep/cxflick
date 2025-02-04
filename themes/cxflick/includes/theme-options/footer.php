<?php
global $prefix_theme_options;

$column_width_fields = [
	[
		'id'      => 'sm',
		'type'    => 'slider',
		'title'   => esc_html__( 'sm: ≥576px', 'clinic' ),
		'default' => 12,
		'min'     => 1,
		'max'     => 12,
	],

	[
		'id'      => 'md',
		'type'    => 'slider',
		'title'   => esc_html__( 'md: ≥768px', 'clinic' ),
		'default' => 6,
		'min'     => 1,
		'max'     => 12,
	],

	[
		'id'      => 'lg',
		'type'    => 'slider',
		'title'   => esc_html__( 'lg: ≥992px', 'clinic' ),
		'default' => 3,
		'min'     => 1,
		'max'     => 12,
	],

	[
		'id'      => 'xl',
		'type'    => 'slider',
		'title'   => esc_html__( 'lg: ≥1200px', 'clinic' ),
		'default' => 3,
		'min'     => 1,
		'max'     => 12,
	],
];

//
// -> Create a section footer
CSF::createSection( $prefix_theme_options, array(
	'id'    => 'opt_footer_section',
	'icon'  => 'fas fa-stream',
	'title' => esc_html__( 'Chân trang', 'cxflick' ),
) );

// footer columns
CSF::createSection( $prefix_theme_options, array(
	'parent' => 'opt_footer_section',
	'title'  => esc_html__( 'Cài đặt cột sidebar', 'cxflick' ),
	'fields' => array(
		// select columns
		array(
			'id'      => 'opt_footer_columns',
			'type'    => 'select',
			'title'   => esc_html__( 'Number of footer columns', 'cxflick' ),
			'options' => array(
				'0' => esc_html__( 'Hide', 'cxflick' ),
				'1' => 1,
				'2' => 2,
				'3' => 3,
				'4' => 4,
			),
			'default' => '4'
		),

		// column width 1
		array(
			'id'         => 'opt_footer_column_width_1',
			'type'       => 'fieldset',
			'title'      => esc_html__( 'Độ rộng cột 1', 'cxflick' ),
			'fields'     => $column_width_fields,
			'dependency' => array( 'opt_footer_columns', '!=', '0' )
		),

		// column width 2
		array(
			'id'         => 'opt_footer_column_width_2',
			'type'       => 'fieldset',
			'title'      => esc_html__( 'Độ rộng cột 2', 'cxflick' ),
			'fields'     => $column_width_fields,
			'dependency' => array( 'opt_footer_columns', 'not-any', '0,1' )
		),

		// column width 3
		array(
			'id'         => 'opt_footer_column_width_3',
			'type'       => 'fieldset',
			'title'      => esc_html__( 'Độ rộng cột 3', 'cxflick' ),
			'fields'     => $column_width_fields,
			'dependency' => array( 'opt_footer_columns', 'not-any', '0,1,2' )
		),

		// column width 4
		array(
			'id'         => 'opt_footer_column_width_4',
			'type'       => 'fieldset',
			'title'      => esc_html__( 'Độ rộng cột 4', 'cxflick' ),
			'fields'     => $column_width_fields,
			'dependency' => array( 'opt_footer_columns', 'not-any', '0,1,2,3' )
		),
	)
) );

// Copyright
CSF::createSection( $prefix_theme_options, array(
	'parent' => 'opt_footer_section',
	'title'  => esc_html__( 'Copyright', 'cxflick' ),
	'fields' => array(
		// show
		array(
			'id'         => 'opt_footer_copyright_show',
			'type'       => 'switcher',
			'title'      => esc_html__( 'Hiện thị copyright', 'cxflick' ),
			'text_on'    => esc_html__( 'Có', 'cxflick' ),
			'text_off'   => esc_html__( 'Không', 'cxflick' ),
			'text_width' => 80,
			'default'    => true
		),

		// content
		array(
			'id'            => 'opt_footer_copyright_content',
			'type'          => 'wp_editor',
			'title'         => esc_html__( 'Nội dung', 'cxflick' ),
			'media_buttons' => false,
			'default'       => esc_html__( 'Copyright &copy; DiepLK', 'cxflick' )
		),
	)
) );