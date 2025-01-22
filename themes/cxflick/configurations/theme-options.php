<?php
// A Custom function for get an option
if ( ! function_exists( 'cxflick_get_option' ) ) {
	function cxflick_get_option( $option = '', $default = null ) {
		$options = get_option( 'options' );

		return ( isset( $options[ $option ] ) ) ? $options[ $option ] : $default;
	}
}

// Control core classes for avoid errors
if ( class_exists( 'CSF' ) ) {
	add_action( 'admin_enqueue_scripts', function () {
		// Hủy Font Awesome 5 mặc định của Codestar Framework
		wp_dequeue_style( 'csf-fa5' );
		wp_dequeue_style( 'csf-fa5-v4-shims' );

		// Thêm Font Awesome 6 vào khu vực admin
		wp_enqueue_style( 'font-awesome-6-admin', get_theme_file_uri( '/assets/libs/fontawesome/css/fontawesome.min.css' ), [], '6.7.2' );
	}, 10 );

	// remove icon
	add_filter( 'csf_field_icon_add_icons', 'customize_csf_icons' );
	function customize_csf_icons( $icons ) {
		foreach ($icons as $key => $list) {
			foreach ($list["icons"] as $icon_key =>  $icon) {
				if ($icon === 'fab fa-acquisitions-incorporated') {
					unset($list['icons'][$icon_key]);
					break;
				}
			}

			$icons[$key] = $list;
		}

		return $icons;
	}

	// Set a unique slug-like ID
	$cxflick_prefix   = 'options';
	$cxflick_my_theme = wp_get_theme();

	// Create options
	CSF::createOptions( $cxflick_prefix, array(
		'menu_title'          => esc_html__( 'Cài đặt theme', 'cxflick' ),
		'menu_slug'           => 'theme-options',
		'menu_position'       => 2,
		'admin_bar_menu_icon' => 'dashicons-admin-generic',
		'framework_title'     => $cxflick_my_theme->get( 'Name' ) . ' theme-options.php' . esc_html__( 'Options', 'cxflick' ),
		'footer_text'         => esc_html__( 'Cảm ơn bạn đã sử dụng theme của tôi', 'cxflick' ),
		'footer_after'        => '<pre>Liên hệ:<br />Zalo/Phone: 0975458209 - Skype: lathieuhiep - facebook: <a href="https://www.facebook.com/lathieuhiep" target="_blank">lathieuhiep</a></pre>',
	) );

	// Create a section general
	CSF::createSection( $cxflick_prefix, array(
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

	//
	// Create a section menu
	CSF::createSection( $cxflick_prefix, array(
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
		)
	) );

	//
	// -> Create a section blog
	CSF::createSection( $cxflick_prefix, array(
		'id'    => 'opt_post_section',
		'icon'  => 'fas fa-blog',
		'title' => esc_html__( 'Bài viết', 'cxflick' ),
	) );

	// Category Post
	CSF::createSection( $cxflick_prefix, array(
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
	CSF::createSection( $cxflick_prefix, array(
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

	//
	// Create a section social network
	CSF::createSection( $cxflick_prefix, array(
		'title'  => esc_html__( 'Mạng xã hội', 'cxflick' ),
		'icon'   => 'fab fa-hive',
		'fields' => array(
			array(
				'id'      => 'opt_social_network',
				'type'    => 'repeater',
				'title'   => esc_html__( 'Mạng xã hội', 'cxflick' ),
				'fields'  => array(
					array(
						'id'      => 'icon',
						'type'    => 'icon',
						'title'   => esc_html__( 'Icon', 'cxflick' ),
						'default' => 'fab fa-facebook-f'
					),

					array(
						'id'      => 'url',
						'type'    => 'text',
						'title'   => esc_html__( 'URL', 'cxflick' ),
						'default' => '#'
					),
				),
				'default' => array(
					array(
						'icon' => 'fab fa-facebook-f',
						'url'  => '#',
					),

					array(
						'icon' => 'fab fa-youtube',
						'url'  => '#',
					),
				)
			),
		)
	) );

	//
	// -> Create a section footer
	CSF::createSection( $cxflick_prefix, array(
		'id'    => 'opt_footer_section',
		'icon'  => 'fas fa-stream',
		'title' => esc_html__( 'Chân trang', 'cxflick' ),
	) );

	// footer columns
	CSF::createSection( $cxflick_prefix, array(
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
				'fields'     => array(
					array(
						'id'         => 'sm',
						'type'       => 'slider',
						'title'      => esc_html__( 'sm: ≥576px', 'clinic' ),
						'default'    => 12,
						'min'        => 1,
						'max'        => 12,
					),

					array(
						'id'         => 'md',
						'type'       => 'slider',
						'title'      => esc_html__( 'md: ≥768px', 'clinic' ),
						'default'    => 6,
						'min'        => 1,
						'max'        => 12,
					),

					array(
						'id'         => 'lg',
						'type'       => 'slider',
						'title'      => esc_html__( 'lg: ≥992px', 'clinic' ),
						'default'    => 3,
						'min'        => 1,
						'max'        => 12,
					),

					array(
						'id'         => 'xl',
						'type'       => 'slider',
						'title'      => esc_html__( 'lg: ≥1200px', 'clinic' ),
						'default'    => 3,
						'min'        => 1,
						'max'        => 12,
					),
				),
				'dependency' => array( 'opt_footer_columns', '!=', '0' )
			),

			// column width 2
			array(
				'id'         => 'opt_footer_column_width_2',
				'type'       => 'fieldset',
				'title'      => esc_html__( 'Độ rộng cột 2', 'cxflick' ),
				'fields'     => array(
					array(
						'id'         => 'sm',
						'type'       => 'slider',
						'title'      => esc_html__( 'sm: ≥576px', 'clinic' ),
						'default'    => 12,
						'min'        => 1,
						'max'        => 12,
					),

					array(
						'id'         => 'md',
						'type'       => 'slider',
						'title'      => esc_html__( 'md: ≥768px', 'clinic' ),
						'default'    => 6,
						'min'        => 1,
						'max'        => 12,
					),

					array(
						'id'         => 'lg',
						'type'       => 'slider',
						'title'      => esc_html__( 'lg: ≥992px', 'clinic' ),
						'default'    => 3,
						'min'        => 1,
						'max'        => 12,
					),

					array(
						'id'         => 'xl',
						'type'       => 'slider',
						'title'      => esc_html__( 'lg: ≥1200px', 'clinic' ),
						'default'    => 3,
						'min'        => 1,
						'max'        => 12,
					),
				),
				'dependency' => array( 'opt_footer_columns', 'not-any', '0,1' )
			),

			// column width 3
			array(
				'id'         => 'opt_footer_column_width_3',
				'type'       => 'fieldset',
				'title'      => esc_html__( 'Độ rộng cột 3', 'cxflick' ),
				'fields'     => array(
					array(
						'id'         => 'sm',
						'type'       => 'slider',
						'title'      => esc_html__( 'sm: ≥576px', 'clinic' ),
						'default'    => 12,
						'min'        => 1,
						'max'        => 12,
					),

					array(
						'id'         => 'md',
						'type'       => 'slider',
						'title'      => esc_html__( 'md: ≥768px', 'clinic' ),
						'default'    => 6,
						'min'        => 1,
						'max'        => 12,
					),

					array(
						'id'         => 'lg',
						'type'       => 'slider',
						'title'      => esc_html__( 'lg: ≥992px', 'clinic' ),
						'default'    => 3,
						'min'        => 1,
						'max'        => 12,
					),

					array(
						'id'         => 'xl',
						'type'       => 'slider',
						'title'      => esc_html__( 'lg: ≥1200px', 'clinic' ),
						'default'    => 3,
						'min'        => 1,
						'max'        => 12,
					),
				),
				'dependency' => array( 'opt_footer_columns', 'not-any', '0,1,2' )
			),

			// column width 4
			array(
				'id'         => 'opt_footer_column_width_4',
				'type'       => 'fieldset',
				'title'      => esc_html__( 'Độ rộng cột 4', 'cxflick' ),
				'fields'     => array(
					array(
						'id'         => 'sm',
						'type'       => 'slider',
						'title'      => esc_html__( 'sm: ≥576px', 'clinic' ),
						'default'    => 12,
						'min'        => 1,
						'max'        => 12,
					),

					array(
						'id'         => 'md',
						'type'       => 'slider',
						'title'      => esc_html__( 'md: ≥768px', 'clinic' ),
						'default'    => 6,
						'min'        => 1,
						'max'        => 12,
					),

					array(
						'id'         => 'lg',
						'type'       => 'slider',
						'title'      => esc_html__( 'lg: ≥992px', 'clinic' ),
						'default'    => 3,
						'min'        => 1,
						'max'        => 12,
					),

					array(
						'id'         => 'xl',
						'type'       => 'slider',
						'title'      => esc_html__( 'lg: ≥1200px', 'clinic' ),
						'default'    => 3,
						'min'        => 1,
						'max'        => 12,
					),
				),
				'dependency' => array( 'opt_footer_columns', 'not-any', '0,1,2,3' )
			),
		)
	) );

	// Copyright
	CSF::createSection( $cxflick_prefix, array(
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
}