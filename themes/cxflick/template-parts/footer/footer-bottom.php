<?php
$show_copyright = cxflick_get_option('opt_footer_copyright_show', '1');
$copyright = cxflick_get_option('opt_footer_copyright_content', 'Copyright &copy; DiepLK');

if ( $show_copyright == '1' ) :
?>
    <div class="global-footer__bottom">
        <div class="container">
            <div class="grid">
                <div class="item copyright">
                    <?php echo wpautop( $copyright ); ?>
                </div>

                <?php cxflick_get_social_url(); ?>
            </div>
        </div>
    </div>
<?php endif; ?>