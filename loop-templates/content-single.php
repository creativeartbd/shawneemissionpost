<?php
/**
 * Post rendering content according to caller of get_template_part
 *
 * @package everstrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
$post_id = get_the_ID();
?>

<article <?php post_class( 'single-post' ); ?> id="post-<?php the_ID(); ?>">
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
	</header>
	<!-- .entry-header -->
	<?php if ( has_post_thumbnail() && get_the_ID() > 87007 ) {
		?>
		<div class="post-thumbnail">
			<a href="<?php echo esc_url( get_permalink() ); ?>">
				<?php echo get_the_post_thumbnail( get_the_ID(), 'sticky-image' ); ?>
			</a>
			<!-- Show post thumbnail caption if it is exist -->
			<?php if ( get_the_post_thumbnail_caption() ) : ?>
				<div class="post-thumbnail-caption">
					<p>
						<?php echo get_the_post_thumbnail_caption(); ?>
					</p>
				</div>
			<?php endif; ?>
		</div>

	<?php } ?>
	<div class="entry-content <?php echo get_the_ID() > 87007 ? '' : 'remove-top-padding'; ?>">
		<?php the_content(); ?>
		<?php everstrap_post_social_share( get_the_ID(), [
			'facebook',
			'messenger',
			'twitter',
			'envelope',
			'link'
		], 'Share this story' ); ?>
	</div>

	<?php
	// Show advertisement
	if ( is_active_sidebar( 'single-post-advertisement' ) ) {
		dynamic_sidebar( 'single-post-advertisement' );
	}

	// Show related post
	//everstrap_related_post( get_the_ID(), 'Related Stories' );
	?>
</article><!-- #post-## -->
