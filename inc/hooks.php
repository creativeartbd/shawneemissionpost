<?php
/**
 * Custom hooks
 *
 * @package everstrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'everstrap_site_info' ) ) {
	/**
	 * Add site info hook to WP hook library.
	 */
	function everstrap_site_info() {
		do_action( 'everstrap_site_info' );
	}
}

if ( ! function_exists( 'everstrap_add_site_info' ) ) {
	add_action( 'everstrap_site_info', 'everstrap_add_site_info' );

	/**
	 * Add site info content.
	 */
	function everstrap_add_site_info() {
		$the_theme   = wp_get_theme();
		$curent_year = date( 'Y' );

		$site_info = sprintf(
			'<p class="site-info-text">%1$s<span class="sep"> | </span>%2$s</p>',
			sprintf(
				esc_html__( '© %1$s Magazine ' . $curent_year . ', All rights reserved.', 'everstrap' ),
				'<a href="' . esc_url( __( site_url( '/' ), 'everstrap' ) ) . '">' . $the_theme->get( 'Name' ) . '</a>'
			),
			sprintf(
				esc_html__( 'Website by %1$s .', 'everstrap' ),
				'<a href="' . esc_url( __( 'https://webpublisherpro.com/', 'everstrap' ) ) . '">' . __( 'Web Publisher PRO', 'everstrap' ) . '</a>'
			)
		);
		echo apply_filters( 'everstrap_site_info_content', $site_info ); // "phpcs:ignore
	}
}

function custom_excerpt_length( $length ) {
	global $post;
	// Cut the content based on condition
	if ( in_array( 'paid', get_post_meta( $post->ID, 'paid_placement' ) ) ) {
		// Cut 150 words from the content paid placement content
		$length = 150;
	} else {
		// Cut 30 words from the content
		$length = 30;
	}
	return $length;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );


// Add view details button to below the post
add_filter( 'the_excerpt', 'everstrap_add_view_details' );
function everstrap_add_view_details( $content ) {
	global $post;

	// view details link
	$view_link = get_the_permalink();

	if ( $content ) {
		// Change the read more text based on 'paid' post meta
		if ( in_array( 'paid', get_post_meta( $post->ID, 'paid_placement' ), true ) ) {
			$read_more_text = __( 'View Details >', 'everstrap' );
		} else {
			$read_more_text = __( 'Keep Reading >', 'everstrap' );
		}

		$content .= '<div class="read-more-link"><a href="' . $view_link . '" class="view-details">' . __( $read_more_text, 'everstrap' ) . '</a></div>';
		return $content;
	}
}

// Cut 150 words from the_content() becuase we are allowing HTML on the front page sponsored posts
add_filter( 'the_content', 'cut_word_from_the_content' );
function cut_word_from_the_content( $content ) {
	global $post;

	$paid_placement = get_post_meta( $post->ID, 'paid_placement' );

	if( $paid_placement ) {

		if ( in_array( 'paid', $paid_placement, true )  && ! is_single() ) {

			$content = preg_split( '/\s+/', $content, 151 );
			array_pop( $content );
			$content = implode( ' ', $content );
			// Because some posts has image directly in the content and we need to replace it only from the home page
			$content = preg_replace("/<img[^>]+\>/i", " ", $content);

			// view details link
			$view_link      = get_the_permalink( $post->ID );
			$read_more_text = __( 'View Details >', 'everstrap' );

			$content .= '<div class="read-more-link"><a href="' . $view_link . '" class="view-details">' . __( $read_more_text, 'everstrap' ) . '</a></div>';

			return $content;
		}
	}

	return $content;
}

// Add meta box to check the post as Paid Placement
add_action( 'add_meta_boxes', 'everstrap_add_sticky_post_meta_box' );
function everstrap_add_sticky_post_meta_box() {
	add_meta_box( 'paid_placement', 'Is paid placement post?', 'everstrap_paid_placement_callback', [
		'post',
		'pro_event',
	], 'side' );
}

function everstrap_paid_placement_callback() {
	global $post;
	$paid_placement = get_post_meta( $post->ID, 'paid_placement', true );
	$checked        = checked( $paid_placement, 'paid', false );
	echo "<input type='checkbox' name='paid_placement' id='paid_placement' value='paid' {$checked} >";
	wp_nonce_field( 'name_of_my_action', 'name_of_nonce_field' );
}

// Save the Paid Placement meta box value
add_action( 'save_post', 'everstrap_save_paid_placement' );
function everstrap_save_paid_placement() {
	global $post;
	$nonce = isset( $_POST['name_of_nonce_field'] ) ? wp_unslash( $_POST['name_of_nonce_field'] ) : '';
	if ( wp_verify_nonce( $nonce, 'name_of_my_action' ) ) {
		$paid_placement = isset( $_POST['paid_placement'] ) ? wp_unslash( $_POST['paid_placement'] ) : '';
		update_post_meta( $post->ID, 'paid_placement', $paid_placement );
	}
}

// Redirect user after login
add_filter( 'login_redirect', 'everstrap_redirect_user_after_login', 10, 3 );
function everstrap_redirect_user_after_login( $redirect_to, $request, $user ) {
	if ( isset( $user->roles ) && is_array( $user->roles ) ) {
		if ( in_array( 'administrator', $user->roles ) ) {
			return $redirect_to;
		} else {
			return home_url();
		}
	} else {
		return $redirect_to;
	}
}

