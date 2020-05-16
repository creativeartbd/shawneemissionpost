<?php
/**
 * Home sticky post template
 *
 * Template for displaying a sticky post
 *
 * @package everstrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$stickies = get_option( 'sticky_posts' );

if ( false === $stickies ) {
	return;
}

$args = [
	'post_type'           => 'post',
	'post__in'            => $stickies,
//	'posts_per_page'      => -1,
];

$posts = get_posts( $args );

if ( $posts ) {
	foreach ( $posts as $post ) {
		setup_postdata( $post );
		get_template_part( 'loop-templates/content', 'sticky' );
		$GLOBALS['count_home_page_post'] += 1;
	}
	wp_reset_postdata();
}
