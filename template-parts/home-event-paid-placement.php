<?php
/**
 * Home Event Paid Post Template
 *
 * Template for displaying paid placement event
 *
 * @package everstrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
// Get event posts which meta key name is paid_placement and featured and value is equal to 'paid' and 'yes'
$args = array(
	'post_type'   => 'pro_event',
	'order'       => 'DESC',
	'orderby'     => 'publish_date',
	'meta_query'  => array(
		'relation'	=> 'AND',
		array(
			'key'     => 'paid_placement',
			'value'   => 'paid',
			'compare' => '=',
		),
		array(
			'key'     => 'featured',
			'value'   => 'yes',
			'compare' => '=',
		)
	),
);

$posts = get_posts( $args );

if ( $posts ) {
	foreach ( $posts as $post ) {
		setup_postdata( $post );
		get_template_part( 'loop-templates/content', 'event-paid-placement' );
	}
	wp_reset_postdata();
}

