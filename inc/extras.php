<?php //phpcs:ignore
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package everstrap
 */

//phpcs:ignore PHPCompatibility.Syntax.NewShortArray.Found

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

add_filter( 'body_class', 'everstrap_body_classes' );

if ( ! function_exists( 'everstrap_body_classes' ) ) {
	/**
	 * Adds custom classes to the array of body classes.
	 *
	 * @param array $classes Classes for the body element.
	 *
	 * @return array
	 */
	function everstrap_body_classes( $classes ) {
		// Adds a class of group-blog to blogs with more than 1 published author.
		if ( is_multi_author() ) {
			$classes[] = 'group-blog';
		}
		// Adds a class of hfeed to non-singular pages.
		if ( ! is_singular() ) {
			$classes[] = 'hfeed';
		}

		return $classes;
	}
}

// Removes tag class from the body_class array to avoid Bootstrap markup styling issues.
add_filter( 'body_class', 'everstrap_adjust_body_class' );

if ( ! function_exists( 'everstrap_adjust_body_class' ) ) {
	/**
	 * Setup body classes.
	 *
	 * @param string $classes CSS classes.
	 *
	 * @return mixed
	 */
	function everstrap_adjust_body_class( $classes ) {

		foreach ( $classes as $key => $value ) {
			if ( 'tag' === $value ) {
				unset( $classes[ $key ] );
			}		}

		return $classes;

	}
}

// Filter custom logo with correct classes.
add_filter( 'get_custom_logo', 'everstrap_change_logo_class' );

if ( ! function_exists( 'everstrap_change_logo_class' ) ) {
	/**
	 * Replaces logo CSS class.
	 *
	 * @param string $html Markup.
	 *
	 * @return mixed
	 */
	function everstrap_change_logo_class( $html ) {

		$html = str_replace( 'class="custom-logo"', 'class="img-fluid"', $html );
		$html = str_replace( 'class="custom-logo-link"', 'class="navbar-brand custom-logo-link"', $html );
		$html = str_replace( 'alt=""', 'title="Home" alt="logo"', $html );

		return $html;
	}
}

/**
 * Display navigation to next/previous post when applicable.
 */

if ( ! function_exists( 'everstrap_post_nav' ) ) {
	/**
	 * Prints post navigation
	 */
	function everstrap_post_nav() {
		// Don't print empty markup if there's nowhere to navigate.
		$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
		$next     = get_adjacent_post( false, '', false );

		if ( ! $next && ! $previous ) {
			return;
		}
		?>
		<nav class="container navigation post-navigation">
			<h2 class="sr-only"><?php esc_html_e( 'Post navigation', 'everstrap' ); ?></h2>
			<div class="row nav-links justify-content-between">
				<?php
				if ( get_previous_post_link() ) {
					previous_post_link( '<span class="nav-previous">%link</span>', _x( '<i class="fa fa-angle-left"></i>&nbsp;%title', 'Previous post link', 'everstrap' ) );
				}
				if ( get_next_post_link() ) {
					next_post_link( '<span class="nav-next">%link</span>', _x( '%title&nbsp;<i class="fa fa-angle-right"></i>', 'Next post link', 'everstrap' ) );
				}
				?>
			</div><!-- .nav-links -->
		</nav><!-- .navigation -->
		<?php
	}
}

if ( ! function_exists( 'everstrap_pingback' ) ) {
	/**
	 * Add a pingback url auto-discovery header for single posts of any post type.
	 */
	function everstrap_pingback() {
		if ( is_singular() && pings_open() ) {
			echo '<link rel="pingback" href="' . esc_url( get_bloginfo( 'pingback_url' ) ) . '">' . "\n";
		}
	}
}
add_action( 'wp_head', 'everstrap_pingback' );

if ( ! function_exists( 'everstrap_mobile_web_app_meta' ) ) {
	/**
	 * Add mobile-web-app meta.
	 */
	function everstrap_mobile_web_app_meta() {
		echo '<meta name="mobile-web-app-capable" content="yes">' . "\n";
		echo '<meta name="apple-mobile-web-app-capable" content="yes">' . "\n";
		echo '<meta name="apple-mobile-web-app-title" content="' . esc_attr( get_bloginfo( 'name' ) ) . ' - ' . esc_attr( get_bloginfo( 'description' ) ) . '">' . "\n";
	}
}
add_action( 'wp_head', 'everstrap_mobile_web_app_meta' );


/**
 * Primary Taxonomy Function
 *
 * @param bool $post_id
 * @param string $taxonomy
 *
 * @return array|bool|null|WP_Error|WP_Term
 */
if ( ! function_exists( 'everstrap_get_primary_term' ) ) {
	function everstrap_get_primary_term( $post_id = false, $taxonomy = 'category' ) {
		if ( ! $taxonomy ) {
			return false;
		}

		if ( ! $post_id ) {
			$post_id = get_the_ID();
		}

		if ( class_exists( 'WPSEO_Primary_Term' ) ) {
			$wpseo_primary_term = new WPSEO_Primary_Term( $taxonomy, $post_id );
			$wpseo_primary_term = $wpseo_primary_term->get_primary_term();
			if ( $wpseo_primary_term ) {
				return get_term( $wpseo_primary_term );
			}
		}

		$terms = get_the_terms( $post_id, $taxonomy );

		if ( ! $terms || is_wp_error( $terms ) ) {
			return false;
		}

		return $terms[0];
	}
}


/**
 * Social Share Function
 *
 * @param $post_id
 * @param $type
 *
 * @return string
 */
if ( ! function_exists( 'everstrap_get_share_link' ) ) {
	function everstrap_get_share_link( $post_id, $type ) {
		$url = '';
		switch ( $type ) {
			case 'facebook':
				$url = add_query_arg(
					[
						'u'       => get_the_permalink( $post_id ),
						'[title]' => apply_filters( 'everstrap_share_fb_title', get_the_title( $post_id ) ),
					],
					'http://www.facebook.com/sharer.php'
				);
				break;

			case 'twitter':
				$url = add_query_arg(
					[
						'url'  => get_the_permalink( $post_id ),
						'text' => apply_filters( 'everstrap_share_twitter_text', get_the_title( $post_id ) ),
						'via'  => '',
					],
					'http://twitter.com/share'
				);
				break;

			case 'linkedin':
				$url = add_query_arg(
					[
						'url'     => get_the_permalink( $post_id ),
						'title'   => apply_filters( 'everstrap_share_twitter_text', wp_strip_all_tags( get_the_title( $post_id ) ) ),
						'summary' => get_post_field( 'the_excerpt', $post_id ),
					],
					'https://www.linkedin.com/shareArticle?mini=true'
				);
				break;

			case 'envelope':
				$url = get_the_permalink( $post_id );
				break;

			case 'link':
				$url = get_the_permalink( $post_id );
				break;
		}

		return $url;
	}

}

/**
 * Cache Busting -- used for maintenance work
 */
function sdt_remove_ver_css_js( $src ) {
    if ( strpos( $src, 'ver=' ) )
        $src = remove_query_arg( 'ver', $src );
        $src = $src . '?ver=1.0.1';
    return $src;
}
add_filter( 'script_loader_src', 'sdt_remove_ver_css_js', 9999 );
add_filter( 'style_loader_src', 'sdt_remove_ver_css_js', 9999 );


function everstrap_save_event_meta( $post_id, $posted ) {
	$buy_ticket             = ! empty( $posted['buy_ticket'] ) ? sanitize_text_field( $posted['buy_ticket'] ) : '';
	$featured_description   = ! empty( $posted['featured_description'] ) ? $posted['featured_description'] : '';
	$cost_door              = ! empty( $posted['cost_door'] ) ? sanitize_text_field( $posted['cost_door'] ) : '';

	update_post_meta( $post_id, 'buy_ticket', $buy_ticket );
	update_post_meta( $post_id, 'featured_description', $featured_description );
	update_post_meta( $post_id, 'cost_door', $cost_door );
}

add_action( 'event_calendar_pro_event_saved', 'everstrap_save_event_meta', 11, 2 );