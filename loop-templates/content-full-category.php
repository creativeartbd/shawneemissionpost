<?php
/**
 * Post rendering content according to caller of get_template_part
 *
 * @package everstrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// Because we need to hide the first post
if ( get_query_var( 'paged' ) > 0 ) {
	return;
}

$term  = get_queried_object();
$args  = array(
	'post_type'      => 'post',
	'order'          => 'DESC',
	'orderby'        => 'publish_date',
	'posts_per_page' => 1,
	'post_status'    => 'publish',
	'tax_query'      => array(
		array(
			'taxonomy' => $term->taxonomy,
			'field'    => 'slug',
			'terms'    => $term->slug,
		),
	),
);
$posts = get_posts( $args );

if ( $posts ) {
	foreach ( $posts as $post ) {
		setup_postdata( $post );
		// Because we need to exclude this post from all bottom posts
		$GLOBALS['first_cat_post_id'] = get_the_ID();
		?>
		<article <?php post_class( 'category-full-post' ); ?> id="post-<?php the_ID(); ?>">
			<header class="entry-header">
				<?php
				everstrap_post_categories();
				the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
				?>
				<div class="entry-meta">
					<?php
					everstrap_post_author_avatar();
					everstrap_posted_on();
					?>
				</div>
			</header><!-- .entry-header -->
			<?php if ( has_post_thumbnail() && get_the_ID() > 87007 ) { ?>
				<div class="post-thumbnail">
					<a href="<?php echo esc_url( get_permalink() ); ?>">
						<?php echo get_the_post_thumbnail( get_the_ID(), 'sticky-image' ); ?>
					</a>
				</div>
			<?php } ?>
			<div class="entry-content <?php echo get_the_ID() > 87007 ? '' : 'remove-top-padding'; ?>">
				<?php the_content(); ?>
				<?php everstrap_post_social_share( get_the_ID(), [ 'facebook', 'messenger', 'twitter', 'envelope', 'link' ], 'Share this story' ); ?>
			</div>
		</article><!-- #post-## -->
		<?php
	}
	wp_reset_postdata();
}
