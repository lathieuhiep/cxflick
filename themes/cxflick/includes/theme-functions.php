<?php
// get version theme
function cxflick_get_version_theme(): string {
	return wp_get_theme()->get( 'Version' );
}

// check is blog
function cxflick_is_blog(): bool {
	return ( is_archive() || is_category() || is_tag() || is_author() || is_home() || ( is_search() && get_post_type() === 'post' ) );
}

// Callback Comment List
function cxflick_comments( $cxflick_comment, $cxflick_comment_args, $cxflick_comment_depth ): void {
	if ( $cxflick_comment_args['style'] == 'div' ) :
		$cxflick_comment_tag       = 'div';
		$cxflick_comment_add_below = 'comment';
	else :
		$cxflick_comment_tag       = 'li';
		$cxflick_comment_add_below = 'div-comment';
	endif;

	?>
    <<?php echo $cxflick_comment_tag . ' ' ?><?php comment_class( empty( $cxflick_comment_args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID() ?>">

	<?php if ( 'div' != $cxflick_comment_args['style'] ) : ?>

        <div id="div-comment-<?php comment_ID() ?>" class="comment__body">

	<?php endif; ?>
    <div class="author vcard">
        <div class="author__avatar">
			<?php if ( $cxflick_comment_args['avatar_size'] != 0 ) {
				echo get_avatar( $cxflick_comment, $cxflick_comment_args['avatar_size'] );
			} ?>
        </div>

        <div class="author__info">
            <span class="name"><?php comment_author_link(); ?></span>

            <span class="date"><?php comment_date(); ?></span>
        </div>
    </div>

	<?php if ( $cxflick_comment->comment_approved == '0' ) : ?>
        <div class="awaiting">
			<?php esc_html_e( 'Bình luận của bạn đang chờ kiểm duyệt.', 'cxflick' ); ?>
        </div>
	<?php endif; ?>

    <div class="content">
		<?php comment_text(); ?>
    </div>

    <div class="action">
		<?php edit_comment_link( esc_html__( 'Sửa ', 'cxflick' ) ); ?>

		<?php comment_reply_link( array_merge( $cxflick_comment_args, array(
			'add_below' => $cxflick_comment_add_below,
			'depth'     => $cxflick_comment_depth,
			'max_depth' => $cxflick_comment_args['max_depth']
		) ) ); ?>
    </div>

	<?php if ( $cxflick_comment_args['style'] != 'div' ) : ?>

        </div>

	<?php
	endif;
}

// Content Nav
function cxflick_comment_nav(): void {
	if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
		?>
        <nav class="navigation comment-navigation">
            <h2 class="screen-reader-text">
				<?php esc_html_e( 'Điều hướng bình luận', 'cxflick' ); ?>
            </h2>

            <div class="nav-links">
				<?php
				if ( $prev_link = get_previous_comments_link( esc_html__( 'Bình luận cũ hơn', 'cxflick' ) ) ) :
					printf( '<div class="nav-previous">%s</div>', $prev_link );
				endif;

				if ( $next_link = get_next_comments_link( esc_html__( 'Bình luận mới hơn', 'cxflick' ) ) ) :
					printf( '<div class="nav-next">%s</div>', $next_link );
				endif;
				?>
            </div>
        </nav>
	<?php
	endif;
}

// Pagination
function cxflick_pagination(): void {
	the_posts_pagination( array(
		'type'               => 'list',
		'mid_size'           => 2,
		'prev_text'          => esc_html__( 'Trước', 'cxflick' ),
		'next_text'          => esc_html__( 'Sau', 'cxflick' ),
		'screen_reader_text' => '&nbsp;',
	) );
}

// Pagination Nav Query
function cxflick_paging_nav_query( $query ): void {

	$args = array(
		'prev_text' => esc_html__( ' Trước', 'cxflick' ),
		'next_text' => esc_html__( 'Sau', 'cxflick' ),
		'current'   => max( 1, get_query_var( 'paged' ) ),
		'total'     => $query->max_num_pages,
		'type'      => 'list',
	);

	$paginate_links = paginate_links( $args );

	if ( $paginate_links ) :

		?>
        <nav class="pagination">
			<?php echo $paginate_links; ?>
        </nav>

	<?php

	endif;
}

// Get col global
function cxflick_col_use_sidebar( $option_sidebar, $active_sidebar ): string {
	if ( $option_sidebar != 'hide' && is_active_sidebar( $active_sidebar ) ):

		if ( $option_sidebar == 'left' ) :
			$class_position_sidebar = ' order-1 order-md-2';
		else:
			$class_position_sidebar = ' order-1';
		endif;

		$class_col_content = 'col-12 col-md-8 col-lg-9' . $class_position_sidebar;
	else:
		$class_col_content = 'col-md-12';
	endif;

	return $class_col_content;
}

function cxflick_col_sidebar(): string {
	return 'col-12 col-md-4 col-lg-3';
}

// Post Meta
function cxflick_post_meta(): void {
	?>

    <div class="post-meta">
        <span class="post-meta__author">
            <?php esc_html_e( 'Tác giả:', 'cxflick' ); ?>

            <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
                <?php the_author(); ?>
            </a>
        </span>

        <span class="post-meta__date">
            <?php esc_html_e( 'Ngày đăng: ', 'cxflick' );
            the_date(); ?>
        </span>

        <span class="post-meta__comments">
            <?php
            comments_popup_link( '0 ' . esc_html__( 'Bình luận', 'cxflick' ), '1 ' . esc_html__( 'Bình luận', 'cxflick' ), '% ' . esc_html__( 'Bình luận', 'cxflick' ) );
            ?>
        </span>
    </div>

	<?php
}

// Link Pages
function cxflick_link_page(): void {
	wp_link_pages( array(
		'before'      => '<div class="page-links">' . esc_html__( 'Trang:', 'cxflick' ),
		'after'       => '</div>',
		'link_before' => '<span class="page-number">',
		'link_after'  => '</span>',
	) );
}

// Get Category Check Box
function cxflick_check_get_cat( $type_taxonomy ): array {
	$cat_check = array();
	$category  = get_terms(
		array(
			'taxonomy'   => $type_taxonomy,
			'hide_empty' => false
		)
	);

	if ( isset( $category ) && ! empty( $category ) ):
		foreach ( $category as $item ) {
			$cat_check[ $item->term_id ] = $item->name;
		}
	endif;

	return $cat_check;
}

// Get Contact Form 7
function cxflick_get_form_cf7(): array {
	$options = array();

	if ( function_exists( 'wpcf7' ) ) {

		$wpcf7_form_list = get_posts( array(
			'post_type'   => 'wpcf7_contact_form',
			'numberposts' => - 1,
		) );

		$options[0] = esc_html__( 'Chọn một mẫu liên hệ', 'cxflick' );

		if ( ! empty( $wpcf7_form_list ) && ! is_wp_error( $wpcf7_form_list ) ) :
			foreach ( $wpcf7_form_list as $item ) :
				$options[ $item->ID ] = $item->post_title;
			endforeach;
		else :
			$options[0] = esc_html__( 'Tạo biểu mẫu trước tiên', 'cxflick' );
		endif;

	}

	return $options;
}

// Social Network
function cxflick_get_social_url(): void {
	$opt_social_networks = cxflick_get_option( 'opt_social_network', '' );

	if ( ! empty( $opt_social_networks ) ) :
		foreach ( $opt_social_networks as $item ) :
			?>
            <div class="social-network-item">
                <a href="<?php echo esc_url( $item['url'] ); ?>" target="_blank">
                    <i class="<?php echo $item['icon']; ?>"></i>
                </a>
            </div>
		<?php

		endforeach;
	endif;
}