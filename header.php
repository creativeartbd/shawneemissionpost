<?php
/**
 * The header for our theme
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package everstrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php wp_head(); ?>
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-76474496-1"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());

		gtag('config', 'UA-76474496-1');
	</script>
</head>

<body <?php body_class(); ?>>
<?php do_action( 'everstrap_wp_body_open' ); ?>

<!-- Search Area Start -->
<div class="sidebar-menu-wrapper" id="sidebar-menu-wrapper">
	<div class="search-form-area">
		<div class="sidebar-search-logo">
			<?php everstrap_site_logo(); ?>
		</div>
		<h3><?php _e( 'What are you looking for?', 'everstrap' ); ?></h3>
		<form method="get" action="<?php bloginfo( 'url' ); ?>" role="search" class="sidebar-search-form">
			<div class="input-group">
				<div class="input-group-append" id="button-addon4">
					<button class="btn btn-outline-secondary for-i" type="button"><i class="fa fa-search"></i></button>
				</div>
				<input type="text" class="form-control search-input" placeholder="Search..." name="s">
				<div class="input-group-append" id="button-addon4">
					<button class="btn btn-outline-secondary for-i" type="submit"><i class="fa fa-arrow-right"></i>
					</button>
					<button class="btn btn-outline-secondary close-seaarch-popup for-i" type="button">
						<span>&#10005;</span></button>
				</div>
			</div>
		</form>
	</div>
</div>
<!-- Search Area End -->

<div class="site" id="page">

	<!--.nav-drawer-->
	<div id="nav-drawer" class="nav-drawer">
		<div class="nav-drawer-inner">

			<div class="nav-drawer-header">
				<span class="nav-drawer-close">&#10005;</span>
			</div>

			<div class="nav-drawer-logo">
				<?php everstrap_site_logo(); ?>
			</div>

			<div class="nav-drawer-subscribe">
				<?php
				if ( class_exists( 'acf' ) ) {
					$subscribe_account_btn = get_field( 'subscribe_and_account_section', 'option' );
					if ( $subscribe_account_btn ) {
						echo do_shortcode( $subscribe_account_btn );
					}
				}
				?>
			</div>

			<div class="nav-drawer-menu primary">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'primary',
						'menu_class'     => 'navmenu-list-item sidebar-header-menu',
						'menu_id'        => 'main-menu',
						'walker'         => new WP_Bootstrap_Navwalker(),
					)
				);
				?>
			</div>

			<div class="nav-drawer-menu columns">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'columns',
						'menu_id'        => 'sidebar-columns-menu',
						'menu_class'     => 'navmenu-list-item sidebar-columns-menu',
						'walker'         => new WP_Bootstrap_Navwalker(),
					)
				);
				?>
			</div>

			<div class="footer-social">
				<?php
				if ( class_exists( 'acf' ) ) {
					$sidebar_social      = get_field( 'sidebar_social_media', 'option' );
					$sidebar_search_icon = get_field( 'sidebar_search_icon', 'option' );
					if ( $sidebar_social ) {
						echo do_shortcode( $sidebar_social );
					}

					if ( $sidebar_search_icon ) {
						echo do_shortcode( $sidebar_search_icon );
					}
				}
				?>
			</div>
		</div>
	</div>
	<!--.nav-drawer -->

	<!-- header area -->
	<?php
		$everstrap_subscribe_and_login = class_exists( 'acf' ) ? get_field( 'top_subscribe_and_account', 'option' ) : false;
		$header_logo_style = is_user_logged_in() ? 'style="margin:auto;"' : '';		
	?>
	<div class="header">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-3 col-md-3 p-r-0 header-logo-col" <?php echo $header_logo_style; ?> >
					<?php if ( $everstrap_subscribe_and_login && !is_user_logged_in() ) :?>
					<div class="header-subscribe-section">
						<?php echo do_shortcode( $everstrap_subscribe_and_login );?>
					</div>
					<?php endif; ?>
					<div class="header-logo">
						<?php everstrap_site_logo(); ?>
					</div>
				</div>
				<div class="col-xs-12 col-sm-9 col-md-9">
					<?php
					if ( is_active_sidebar( 'header-advertisement-widget' ) ) {
						dynamic_sidebar( 'header-advertisement-widget' );
					}
					?>
				</div>
				<div class="mobile-logo">
					<?php
					if ( class_exists( 'acf' ) ) {
						$upload_header_sticky_logo = get_field( 'upload_header_sticky_logo', 'option' );
						if ( $upload_header_sticky_logo ) {
							$stikcy_logo = $upload_header_sticky_logo['url'];
							echo "<a href='" . site_url( '/' ) . "'><img src='{$stikcy_logo}'></a>";
						}
					}
					?>
				</div>
			</div>
		</div>
	</div>
	<!-- header area end -->

	<!-- ******************* The Navbar Area ******************* -->
	<div id="wrapper-navbar" itemscope itemtype="http://schema.org/WebSite">

		<a class="skip-link sr-only sr-only-focusable" href="#content"><?php esc_html_e( 'Skip to content', 'everstrap' ); ?></a>
		<nav id="main-nav" class="navbar navbar-expand-md main-navbar">
			<div class="container">
				<button class="hamburger-btn">
					<span class="hamburger-icon"></span>
				</button>
				<div class="sticky-logo">
					<?php
					if ( class_exists( 'acf' ) ) {
						$upload_header_sticky_logo = get_field( 'upload_header_sticky_logo', 'option' );
						if ( $upload_header_sticky_logo ) {
							$stikcy_logo = $upload_header_sticky_logo['url'];
							echo "<a href='" . site_url( '/' ) . "'><img src='{$stikcy_logo}'></a>";
						}
					}
					?>
				</div>
				<div class="header-subscribe-section">



					<?php
					if ( class_exists( 'acf' ) ) {
						$everstrap_subscribe_and_login = get_field( 'top_subscribe_and_account', 'option' );
						echo do_shortcode( $everstrap_subscribe_and_login );
					}
					?>
				</div>
				<!-- The WordPress Menu goes here -->

					<?php
					wp_nav_menu(
						array(
							'theme_location'  => 'primary',
							'container_class' => 'collapse navbar-collapse top-nav',
							'container_id'    => 'navbarNavDropdown',
							'menu_class'      => 'navbar-nav',
							'fallback_cb'     => '',
							'menu_id'         => 'main-menu',
							'depth'           => 2,
							'walker'          => new WP_Bootstrap_Navwalker(),
						)
					);
					?>
					<!-- Your site title as branding in the menu -->
					<div class="header-logo-area d-flex header-top-social">
						<?php
						if ( class_exists( 'acf' ) ) {
							$top_right_social_media = get_field( 'top_right_social_media', 'option' );
							if ( $top_right_social_media ) {
								echo do_shortcode( $top_right_social_media );
							}

							$top_right_search_icon = get_field( 'top_right_search_icon', 'option' );
							if ( $top_right_search_icon ) {
								echo do_shortcode( $top_right_search_icon );
							}
						}
						?>
					</div>

			</div><!-- .container -->
		</nav><!-- .site-navigation -->

		<nav id="main-nav" class="navbar navbar-expand-md sub-navbar">
			<div class="container">
				<?php
				wp_nav_menu(
					array(
						'theme_location'  => 'columns',
						'container_class' => 'collapse navbar-collapse columns',
						'container_id'    => 'navbarNavDropdown',
						'menu_class'      => 'navbar-nav',
						'fallback_cb'     => '',
						'menu_id'         => 'main-menu',
						'depth'           => 2,
						'walker'          => new WP_Bootstrap_Navwalker(),
					)
				);
				?>
			</div><!-- .container -->
		</nav><!-- .columns-navigation -->

	</div><!-- #wrapper-navbar end -->
