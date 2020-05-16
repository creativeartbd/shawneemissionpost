<?php
/**
 * Home normal post template
 *
 * Template for displaying normal post
 *
 * @package everstrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 0;
$args  = array(
	'post_type'    => 'post',
	'order'        => 'DESC',
	'orderby'      => 'publish_date',
	'post_status'  => 'publish',
	'paged'        => $paged,
	'post__not_in' => get_option( 'sticky_posts' ),
);

$query = new WP_Query( $args );
if ( $query ) {
	if ( $query->have_posts() ) {
		$count = 0;
		while ( $query->have_posts() ) {
			$GLOBALS['count'] = $count;
			$query->the_post();
			get_template_part( 'loop-templates/content' );
			$count ++;
		}
		unset( $GLOBALS['count'] );
	}
}

wp_reset_postdata();
