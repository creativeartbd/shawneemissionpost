<?php
/**
 * Post rendering content according to caller of get_template_part
 *
 * @package everstrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>
<article <?php post_class( 'paid-placement-wrapper' ); ?> id="post-<?php the_ID(); ?>">

	<header class="entry-header">
		<div class="entry-header-inner">
			<?php everstrap_post_categories(); ?>
			<div class="paid-placement"><?php _e( 'Paid Placement', 'everstrap' ); ?></div>
		</div>
		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
	</header><!-- .entry-header -->

	<?php if ( has_post_thumbnail() ) { ?>
		<div class="post-thumbnail">
			<a href="<?php echo esc_url( get_permalink() ); ?>">
				<?php echo get_the_post_thumbnail( get_the_ID(), 'paid-placement-thumb' ); ?>
			</a>
		</div>
	<?php } ?>

	<div class="entry-content">
		<?php the_content(); ?>
	</div>

</article><!-- #post-## -->
