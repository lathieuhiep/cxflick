<?php
/*
*---------------------------------------------------------------------
* This file create and contains the template post_type meta elements
*---------------------------------------------------------------------
*/

add_action('init', 'cxflick_create_project', 10);

function cxflick_create_project() {

    /* Start post type template */
    $labels = array(   
        'name'                  =>  _x( 'Dự án', 'post type general name', 'cxflick' ),
        'singular_name'         =>  _x( 'Dự án', 'post type singular name', 'cxflick' ),
        'menu_name'             =>  _x( 'Dự án', 'admin menu', 'cxflick' ),
        'name_admin_bar'        =>  _x( 'Danh sách Dự án', 'add new on admin bar', 'cxflick' ),
        'add_new'               =>  _x( 'Thêm mới', 'Dự án', 'cxflick' ),
        'add_new_item'          =>  esc_html__( 'Thêm Dự án', 'cxflick' ),
        'edit_item'             =>  esc_html__( 'Sửa Dự án', 'cxflick' ),
        'new_item'              =>  esc_html__( 'Dự án mới', 'cxflick' ),
        'view_item'             =>  esc_html__( 'Xem dự án', 'cxflick' ),
        'all_items'             =>  esc_html__( 'Tất cả dự án', 'cxflick' ),
        'search_items'          =>  esc_html__( 'Tìm kiếm dự án', 'cxflick' ),
        'not_found'             =>  esc_html__( 'Không tìm thấy', 'cxflick' ),
        'not_found_in_trash'    =>  esc_html__( 'Không tìm thấy trong thùng rác', 'cxflick' ),
        'parent_item_colon'     =>  ''
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'menu_icon'          => 'dashicons-open-folder',
        'capability_type'    => 'post',
        'rewrite'            => array('slug' => 'du-an' ),
        'has_archive'        => true,
        'hierarchical'       => true,
        'menu_position'      => 5,
        'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
    );

    register_post_type('cxflick_project', $args );
    /* End post type template */

    /* Start taxonomy */
    $taxonomy_labels = array(
        'name'              => _x( 'Danh mục dự án', 'taxonomy general name', 'cxflick' ),
        'singular_name'     => _x( 'Danh mục dự án', 'taxonomy singular name', 'cxflick' ),
        'search_items'      => __( 'Tìm kiếm danh mục', 'cxflick' ),
        'all_items'         => __( 'Tất cả danh mục', 'cxflick' ),
        'parent_item'       => __( 'Danh mục cha', 'cxflick' ),
        'parent_item_colon' => __( 'Danh mục cha:', 'cxflick' ),
        'edit_item'         => __( 'Sửa', 'cxflick' ),
        'update_item'       => __( 'Cập nhật', 'cxflick' ),
        'add_new_item'      => __( 'Thêm mới', 'cxflick' ),
        'new_item_name'     => __( 'Tên mới', 'cxflick' ),
        'menu_name'         => __( 'Danh mục', 'cxflick' ),
    );

    $taxonomy_args = array(

        'labels'            => $taxonomy_labels,
        'hierarchical'      => true,
        'public'            => true,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'danh-muc-du-an' ),
    );

    register_taxonomy( 'cxflick_project_cat', array( 'cxflick_project' ), $taxonomy_args );
    /* End taxonomy */

}