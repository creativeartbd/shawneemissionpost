<?php
/**
 * Home Paid Placement Template
 *
 * Template for displaying paid post
 *
 * @package everstrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
// Get posts which meta key name is paid_placement and value is equal to 'paid'
$args = array(
	'post_type'   => 'post',
	'post_status' => 'publish',
	'order'       => 'DESC',
	'orderby'     => 'publish_date',
	'meta_query'  => array(
		array(
			'key'     => 'paid_placement',
			'value'   => 'paid',
			'compare' => '=',
		),
	),
);

$posts = get_posts( $args );

if ( $posts ) {
	foreach ( $posts as $post ) {
		setup_postdata( $post );
		get_template_part( 'loop-templates/content', 'paid-placement' );
	}
	wp_reset_postdata();
}
