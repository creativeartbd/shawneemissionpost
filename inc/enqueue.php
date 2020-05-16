<?php
/**
 * EverStrap enqueue scripts
 *
 * @package everstrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'everstrap_scripts' ) ) {
	/**
	 * Load theme's JavaScript and CSS sources.
	 */
	function everstrap_scripts() {
		// Get the theme data.
		$the_theme     = wp_get_theme();
		$theme_version = $the_theme->get( 'Version' );

		wp_enqueue_style( 'own-carousel-min', get_template_directory_uri() . '/assets/css/owl.carousel.min.css', array(), $theme_version );
		wp_enqueue_style( 'everstrap-styles', get_template_directory_uri() . '/assets/css/style.css', array(), $theme_version );

		wp_enqueue_script( 'owl-carousel', get_template_directory_uri() . '/assets/js/owl.carousel.js', array( 'jquery' ), $theme_version, true );
		wp_enqueue_script( 'everstrap-scripts', get_template_directory_uri() . '/assets/js/bundle.js', array( 'jquery' ), $theme_version, true );

		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}
}

add_action( 'wp_enqueue_scripts', 'everstrap_scripts' );
