<?php
/**
 * Post rendering content according to caller of get_template_part
 *
 * @package everstrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<article <?php post_class( 'simple-post' ); ?> id="post-<?php the_ID(); ?>">
	<?php if ( has_post_thumbnail() ) { ?>
		<div class="post-thumbnail">
			<a href="<?php echo esc_url( get_permalink() ); ?>">
				<?php echo get_the_post_thumbnail( get_the_ID(), 'loop-thumb' ); ?>
			</a>
		</div>
	<?php } ?>
	<header class="entry-header">
		<?php
		everstrap_post_categories();
		the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
		?>
		<div class="entry-content">
			<?php the_excerpt(); ?>
		</div>
	</header><!-- .entry-header -->
</article><!-- #post-## -->

<?php
if ( isset( $GLOBALS['count'] ) &&  1 === $GLOBALS['count'] ) {
 	if ( is_active_sidebar( 'bottom-post-advertisement' ) ) {
 		dynamic_sidebar( 'bottom-post-advertisement' );
 	}
}
?>
