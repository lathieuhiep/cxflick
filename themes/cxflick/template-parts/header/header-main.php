<?php
$sticky_menu = cxflick_get_option( 'opt_menu_sticky', '1' );
$logo = cxflick_get_option( 'opt_general_logo' );
$cart = cxflick_get_option( 'opt_menu_cart', '1' );
?>
<header class="main-header <?php echo esc_attr( $sticky_menu == '1' ? 'active-sticky-nav' : '' ); ?>">
    <nav class="main-header__warp container">
        <div class="logo d-flex align-items-center">
            <a href="<?php echo esc_url( get_home_url( '/' ) ); ?>" title="<?php bloginfo( 'name' ); ?>">
				<?php
				if ( ! empty( $logo['id'] ) ) :
					echo wp_get_attachment_image( $logo['id'], 'full' );
				else :
					?>

                    <img class="logo-default"
                         src="<?php echo esc_url( get_theme_file_uri( '/assets/images/logo.svg' ) ) ?>"
                         alt="<?php echo esc_attr( get_bloginfo( 'title' ) ); ?>" />

				<?php endif; ?>
            </a>

            <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#primary-menu"
                    aria-controls="site-menu" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa fa-bars" aria-hidden="true"></i>
            </button>
        </div>

        <div id="primary-menu" class="primary-menu collapse navbar-collapse d-lg-block">
			<?php
			if ( has_nav_menu( 'primary' ) ) :
				wp_nav_menu( array(
					'theme_location' => 'primary',
                    'menu_class' => 'd-lg-flex justify-content-lg-end',
					'container' => false,
				) );
			else:
				?>
                <ul class="main-menu">
                    <li>
                        <a href="<?php echo get_admin_url() . '/nav-menus.php'; ?>">
							<?php esc_html_e( 'Thêm Menu', 'cxflick' ); ?>
                        </a>
                    </li>
                </ul>
			<?php endif; ?>
        </div>
    </nav>
</header>