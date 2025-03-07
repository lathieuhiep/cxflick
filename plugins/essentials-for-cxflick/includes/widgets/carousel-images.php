<?php

use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class EFCXF_Widget_Carousel_Images extends Widget_Base {

	// widget name
	public function get_name(): string {
		return 'efcxf-carousel-images';
	}

	// widget title
	public function get_title(): string {
		return esc_html__( 'Ảnh trình chiếu', 'essentials-for-cxflick' );
	}

	// widget icon
	public function get_icon(): string {
		return 'eicon-slider-full-screen';
	}

	// widget categories
	public function get_categories(): array {
		return array( 'efcxf-addons' );
	}

	// widget style dependencies
	public function get_style_depends(): array {
		return [ 'owl.carousel' ];
	}

    // widget scripts dependencies
    public function get_script_depends(): array {
		return [ 'owl.carousel', 'efcxf-script' ];
	}

    // widget keywords
	public function get_keywords(): array
	{
		return ['carousel', 'image', 'slider'];
	}

	// widget controls
	protected function register_controls(): void {

		// Section carousel images
		$this->start_controls_section(
			'section_carousel_images',
			[
				'label' => esc_html__( 'Trình chiếu ảnh', 'essentials-for-cxflick' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'image_size',
			[
				'label' => esc_html__( 'Độ phân giải ảnh', 'lpbcolor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'large',
				'options' => efcxf_image_size_options(),
				'label_block' => true
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'list_title', [
				'label'       => esc_html__( 'Tên', 'essentials-for-cxflick' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'Tên #1', 'essentials-for-cxflick' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'list_image',
			[
				'label'   => esc_html__( 'Chọn ảnh', 'essentials-for-cxflick' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);

		$repeater->add_control(
			'list_link',
			[
				'label'       => esc_html__( 'URL', 'essentials-for-cxflick' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => esc_html__( 'https://your-link.com', 'essentials-for-cxflick' ),
				'default'     => [
					'url'               => '',
					'is_external'       => true,
					'nofollow'          => true,
					'custom_attributes' => '',
				],
			]
		);

		$this->add_control(
			'list',
			[
				'label'       => esc_html__( 'Danh sách', 'essentials-for-cxflick' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => [
					[
						'list_title' => __( 'Tên #1', 'essentials-for-cxflick' ),
					],
					[
						'list_title' => __( 'Tên #2', 'essentials-for-cxflick' ),
					],
					[
						'list_title' => __( 'Tên #3', 'essentials-for-cxflick' ),
					],
					[
						'list_title' => __( 'Tên #4', 'essentials-for-cxflick' ),
					],
				],
				'title_field' => '{{{ list_title }}}',
			]
		);

		$this->end_controls_section();

		// additional options
		$this->start_controls_section(
			'content_additional_options',
			[
				'label' => esc_html__( 'Tùy chọn bổ sung', 'essentials-for-cxflick' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'loop',
			[
				'type'         => Controls_Manager::SWITCHER,
				'label'        => esc_html__( 'Vòng lặp', 'essentials-for-cxflick' ),
				'label_on'     => esc_html__( 'Có', 'essentials-for-cxflick' ),
				'label_off'    => esc_html__( 'Không', 'essentials-for-cxflick' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'autoplay',
			[
				'label'        => esc_html__( 'Tự động chạy', 'essentials-for-cxflick' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Có', 'essentials-for-cxflick' ),
				'label_off'    => esc_html__( 'Không', 'essentials-for-cxflick' ),
				'return_value' => 'yes',
				'default'      => '',
			]
		);

		$this->add_control(
			'navigation',
			[
				'label' => esc_html__( 'Thanh điều hướng', 'essentials-for-cxflick' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'arrows',
				'options' => [
					'both'  => esc_html__( 'Mũi tên và Dấu chấm', 'essentials-for-cxflick' ),
					'arrows'  => esc_html__( 'Mũi tên', 'essentials-for-cxflick' ),
					'dots'  => esc_html__( 'Dấu chấm', 'essentials-for-cxflick' ),
					'none' => esc_html__( 'Không', 'essentials-for-cxflick' ),
				],
			]
		);

		$this->end_controls_section();

		// mobile options
		$this->start_controls_section(
			'mobile_options',
			[
				'label' => esc_html__( 'Dưới 480px', 'essentials-for-cxflick' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'mobile_items',
			[
				'label'   => esc_html__( 'Hiển thị', 'essentials-for-cxflick' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 1,
				'min'     => 1,
				'max'     => 100,
				'step'    => 1,
			]
		);

		$this->add_control(
			'mobile_spaces_between',
			[
				'label'   => esc_html__( 'Khoảng cách', 'essentials-for-cxflick' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 4,
				'min'     => 0,
				'max'     => 100,
				'step'    => 1,
			]
		);

		$this->end_controls_section();

		// mobile large options
		$this->start_controls_section(
			'mobile_large_options',
			[
				'label' => esc_html__( 'Từ 480px', 'essentials-for-cxflick' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'mobile_large_items',
			[
				'label'   => esc_html__( 'Hiển thị', 'essentials-for-cxflick' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 2,
				'min'     => 1,
				'max'     => 100,
				'step'    => 1,
			]
		);

		$this->add_control(
			'mobile_large_spaces_between',
			[
				'label'   => esc_html__( 'Khoảng cách', 'essentials-for-cxflick' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 8,
				'min'     => 1,
				'max'     => 100,
				'step'    => 1,
			]
		);

		$this->end_controls_section();

        // tablet small options
		$this->start_controls_section(
			'tablet_small_options',
			[
				'label' => esc_html__( 'Từ 576px', 'essentials-for-cxflick' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'tablet_small_items',
			[
				'label'   => esc_html__( 'Hiển thị', 'essentials-for-cxflick' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 2,
				'min'     => 1,
				'max'     => 100,
				'step'    => 1,
			]
		);

		$this->add_control(
			'tablet_small_spaces_between',
			[
				'label'   => esc_html__( 'Khoảng cách', 'essentials-for-cxflick' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 12,
				'min'     => 0,
				'max'     => 100,
				'step'    => 1,
			]
		);

		$this->end_controls_section();

        // tablet large options
		$this->start_controls_section(
			'tablet_large_options',
			[
				'label' => esc_html__( 'Từ 768px', 'essentials-for-cxflick' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'tablet_large_items',
			[
				'label'   => esc_html__( 'Hiển thị', 'essentials-for-cxflick' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 3,
				'min'     => 1,
				'max'     => 100,
				'step'    => 1,
			]
		);

		$this->add_control(
			'tablet_large_spaces_between',
			[
				'label'   => esc_html__( 'Khoảng cách', 'essentials-for-cxflick' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 16,
				'min'     => 0,
				'max'     => 100,
				'step'    => 1,
			]
		);

		$this->end_controls_section();

		// desktop small options
		$this->start_controls_section(
			'desktop_small_options',
			[
				'label' => esc_html__( 'Từ 992px', 'essentials-for-cxflick' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'desktop_small_items',
			[
				'label'   => esc_html__( 'Hiển thị', 'essentials-for-cxflick' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 3,
				'min'     => 1,
				'max'     => 100,
				'step'    => 1,
			]
		);

		$this->add_control(
			'desktop_small_spaces_between',
			[
				'label'   => esc_html__( 'Khoảng cách', 'essentials-for-cxflick' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 20,
				'min'     => 0,
				'max'     => 100,
				'step'    => 1,
			]
		);

		$this->end_controls_section();

		// desktop large options
		$this->start_controls_section(
			'desktop_large_options',
			[
				'label' => esc_html__( 'Từ 1200px', 'essentials-for-cxflick' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'desktop_large_items',
			[
				'label'   => esc_html__( 'Hiển thị', 'essentials-for-cxflick' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 4,
				'min'     => 1,
				'max'     => 100,
				'step'    => 1,
			]
		);

		$this->add_control(
			'desktop_large_spaces_between',
			[
				'label'   => esc_html__( 'Khoảng cách', 'essentials-for-cxflick' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 24,
				'min'     => 0,
				'max'     => 100,
				'step'    => 1,
			]
		);

		$this->end_controls_section();
	}

	// widget output on the frontend
	protected function render(): void {
		$settings = $this->get_settings_for_display();

		$data_settings_owl = [
			'loop'       => ( 'yes' === $settings['loop'] ),
			'nav'        => $settings['navigation'] == 'both' || $settings['navigation'] == 'arrows',
			'dots'       => $settings['navigation'] == 'both' || $settings['navigation'] == 'dots',
			'autoplay'   => ( 'yes' === $settings['autoplay'] ),
			'responsive' => [
				'0' => array(
					'items'  => $settings['mobile_items'],
					'margin' => $settings['mobile_spaces_between']
				),

				'480' => array(
					'items'  => $settings['mobile_large_items'],
					'margin' => $settings['mobile_large_spaces_between']
				),

				'576' => array(
					'items'  => $settings['tablet_small_items'],
					'margin' => $settings['tablet_small_spaces_between']
				),

				'768' => array(
					'items' => $settings['tablet_large_items'],
					'margin' => $settings['tablet_large_spaces_between']
				),

				'992' => array(
					'items' => $settings['desktop_small_items'],
					'margin' => $settings['desktop_small_spaces_between']
				),

				'1200' => array(
					'items' => $settings['desktop_large_items'],
					'margin' => $settings['desktop_large_spaces_between']
				),
			]
		];
		?>

        <div class="element-carousel-images">
            <div class="custom-owl-carousel owl-carousel owl-theme"
                 data-settings-owl='<?php echo wp_json_encode( $data_settings_owl ); ?>'>
				<?php
				foreach ( $settings['list'] as $index => $item ) :
					$image_id = $item['list_image']['id'];
					$url = $item['list_link']['url'];
					?>

                    <div class="item elementor-repeater-item-<?php echo esc_attr( $item['_id'] ); ?>">
						<?php
						echo wp_get_attachment_image( $image_id, $settings['image_size'] );

						if ( $url ) :
							$link_key = 'link_' . $index;
							$this->add_link_attributes( $link_key, $item['list_link'] );
							?>

                            <a class="item__link" <?php echo $this->get_render_attribute_string( $link_key ); ?>></a>

						<?php endif; ?>
                    </div>

				<?php endforeach; ?>
            </div>
        </div>

		<?php
	}
}