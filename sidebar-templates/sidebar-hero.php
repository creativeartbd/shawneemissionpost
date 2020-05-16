<?php
/**
 * Sidebar - hero setup
 *
 * @package everstrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<?php if ( is_active_sidebar( 'hero' ) ) : ?>

	<!-- ******************* The Hero Widget Area ******************* -->

	<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">

		<div class="carousel-inner" role="listbox">

			<?php dynamic_sidebar( 'hero' ); ?>

		</div>

		<a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">

			<span class="carousel-control-prev-icon" aria-hidden="true"></span>

			<span class="sr-only"><?php esc_html_e( 'Previous', 'everstrap' ); ?></span>

		</a>

		<a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">

			<span class="carousel-control-next-icon" aria-hidden="true"></span>

			<span class="sr-only"><?php esc_html_e( 'Next', 'everstrap' ); ?></span>

		</a>

	</div><!-- .carousel -->

	<script>
	jQuery( ".carousel-item" ).first().addClass( "active" );
	</script>

<?php endif;
