<?php

use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Widget_Base;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class EFA_Widget_Grid_Linker extends Widget_Base
{

    // widget name
    public function get_name(): string
    {
        return 'efa-grid-linker';
    }

    // widget title
    public function get_title(): string
    {
        return esc_html__('Liên Kết Lưới', 'clinic');
    }

    // widget icon
    public function get_icon(): string
    {
        return 'eicon-gallery-grid';
    }

    // widget categories
    public function get_categories(): array
    {
        return ['efa-addons'];
    }

    // widget keywords
    public function get_keywords(): array
    {
        return ['image', 'grid', 'gallery', 'linker' ];
    }

    // widget controls
    protected function register_controls(): void
    {
        // layout section
        $this->start_controls_section(
            'layout_section',
            [
                'label' => esc_html__( 'Bố cục', 'clinic' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_responsive_control(
            'columns',
            [
                'label' => esc_html__( 'Cột', 'clinic' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
                'step' => 1,
                'default' => 3,
                'selectors' => [
                    '{{WRAPPER}} .element-gallery-grid-box__warp' => 'grid-template-columns: repeat({{VALUE}}, 1fr);',
                ],
            ]
        );

        $this->add_responsive_control(
            'row_gap',
            [
                'label' => esc_html__( 'Khoảng cách hàng', 'clinic' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'rem', 'custom' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 24,
                ],
                'selectors' => [
                    '{{WRAPPER}} .element-gallery-grid-box__warp' => 'grid-column-gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'column_gap',
            [
                'label' => esc_html__( 'Khoảng cách cột', 'clinic' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'rem', 'custom' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 24,
                ],
                'selectors' => [
                    '{{WRAPPER}} .element-gallery-grid-box__warp' => 'grid-row-gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // content section
        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'Nội dung', 'clinic' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'html_tag',
            [
                'label'   => esc_html__( 'HTML Tag', 'essential-features-addon' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'h3',
                'options' => [
                    'h1' => 'H1',
                    'h2' => 'H2',
                    'h3' => 'H3',
                    'h4' => 'H4',
                    'h5' => 'H5',
                    'h6' => 'H6'
                ],
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'list_title', [
                'label' => esc_html__( 'Tiêu đề', 'clinic' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'List Title' , 'clinic' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'list_image', [
                'label' => esc_html__( 'Ảnh', 'clinic' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater->add_control(
            'list_url', [
                'label' => esc_html__( 'Link tùy chỉnh', 'clinic' ),
                'type' => Controls_Manager::URL,
                'placeholder' => 'https://your-link.com',
                'show_external' => false,
                'default' => [
                    'url' => '',
                    'is_external' => false,
                    'nofollow' => false,
                ],
            ]
        );

        $this->add_control(
            'list',
            [
                'label' => esc_html__( 'Danh sách', 'clinic' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'list_title' => esc_html__( 'Title #1', 'clinic' ),
                    ],
                    [
                        'list_title' => esc_html__( 'Title #2', 'clinic' ),
                    ],
                ],
                'title_field' => '{{{ list_title }}}',
            ]
        );

        $this->end_controls_section();
    }

    /**
     * Render oEmbed widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @access protected
     */
    protected function render(): void
    {
        $settings = $this->get_settings_for_display();
        $tag = $settings['html_tag'];
        ?>
        <div class="element-grid-linker">
            <?php foreach ( $settings['list'] as $item ) : ?>
                <div class="item elementor-repeater-item-<?php echo esc_attr( $item['_id'] ); ?>">
                    <?php if ( !empty( $item['list_image']['id'] ) ) : ?>
                        <div class="item__thumbnail <?php echo esc_attr( $settings['image_align'] ); ?>">
                            <?php echo wp_get_attachment_image( $item['list_image']['id'], 'large' ); ?>
                        </div>
                    <?php endif; ?>

                    <div class="item__body">
                        <?php if ( $item['list_title'] ) : ?>
                            <<?php echo esc_html( $tag ); ?> class="title <?php echo esc_attr( $settings['title_align'] ); ?>">
                                <?php echo esc_html( $item['list_title'] ); ?>
                            </<?php echo esc_html( $tag ); ?>>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <?php
    }
}