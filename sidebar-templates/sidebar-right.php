<?php
/**
 * The right sidebar containing the main widget area
 *
 * @package everstrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( ! is_active_sidebar( 'right-sidebar' ) ) {
	return;
}

// when both sidebars turned on reduce col size to 3 from 4.
$sidebar_pos = get_theme_mod( 'everstrap_sidebar_position' );
?>

<?php if ( 'both' === $sidebar_pos ) : ?>
<div class="col-12 col-md-4 widget-area" id="right-sidebar" role="complementary">
	<?php else : ?>
	<div class="col-12 col-md-4 widget-area" id="right-sidebar" role="complementary">
		<?php endif; ?>
		<?php if ( is_active_sidebar( 'sidebar-advertisement-banner' ) ) : ?>
			<?php dynamic_sidebar( 'sidebar-advertisement-banner' ); ?>
		<?php endif; ?>
		<div class="smp-right-sidebar-wrapper">
			<?php dynamic_sidebar( 'right-sidebar' ); ?>
		</div>
	</div><!-- #right-sidebar -->
