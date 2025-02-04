<?php
add_action('cmb2_admin_init', 'cxflick_post_meta_boxes');
function cxflick_post_meta_boxes(): void {
    $cmb = new_cmb2_box(array(
        'id' => 'cxflick_cmb_post',
        'title' => esc_html__('Tùy chọn metabox', 'cxflick'),
        'object_types' => array('post'),
        'context' => 'normal',
        'priority' => 'low',
        'show_names' => true,
    ));

    $cmb->add_field( array(
        'id'   => 'cxflick_cmb_post_title',
        'name' => esc_html__( 'Test Title', 'cxflick' ),
        'type' => 'title',
        'desc' => esc_html__( 'This is a title description', 'cxflick' ),
    ) );
}