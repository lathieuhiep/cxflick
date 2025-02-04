<?php
$show_related = cxflick_get_option('opt_post_single_related', '1');
?>

<div id="post-<?php the_ID() ?>" class="single-post-content">
    <?php if ( has_post_thumbnail() ) :?>
        <div class="single-post-content__image">
            <?php the_post_thumbnail('full'); ?>
        </div>
    <?php endif; ?>

    <h2 class="single-post-content__title">
		<?php the_title(); ?>
    </h2>

	<?php cxflick_post_meta(); ?>

    <div class="single-post-content__detail">
		<?php
		the_content();

		cxflick_link_page();
		?>
    </div>

    <div class="single-post-content__tax">
		<?php if( get_the_category() ): ?>
            <p class="post-category">
				<?php
				esc_html_e('Category: ','cxflick');
				the_category( ', ' );
				?>
            </p>
		<?php
		endif;

		if( get_the_tags() ):
        ?>
            <p class="post-tag">
				<?php
				esc_html_e( 'Tag: ','cxflick' );
				the_tags('',', ');
				?>
            </p>
		<?php endif; ?>
    </div>
</div>

<?php
get_template_part( 'template-parts/parts/comment','form' );

if ( $show_related == '1' ) :
    get_template_part( 'template-parts/post/inc','related-post' );
endif;