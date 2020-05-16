<?php
/**
 * Post rendering content according to caller of get_template_part
 *
 * @package everstrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$first_category_id = isset( $GLOBALS['first_cat_post_id'] ) ? (int) $GLOBALS['first_cat_post_id'] : 0;
$term              = get_queried_object();
$paged             = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 0;

$args = array(
	'post_type'      => 'post',
	'order'          => 'DESC',
	'orderby'        => 'publish_date',
	'post_status'    => 'publish',
	'post__not_in'   => [ $first_category_id ],
	'paged'          => $paged,
	'tax_query'      => array(
		array(
			'taxonomy' => $term->taxonomy,
			'field'    => 'slug',
			'terms'    => $term->slug,
		),
	),
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
		// The pagination component
		everstrap_pagination( array(
			'total'        => $query->max_num_pages,
		) );
		wp_reset_postdata();
	}
}
