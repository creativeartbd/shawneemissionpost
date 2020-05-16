<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after
 *
 * @package everstrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>


<?php get_template_part( 'sidebar-templates/sidebar', 'footerfull' ); ?>

<div class="wrapper footer-area" id="wrapper-footer">

	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-lg-4 col-md-4">
				<?php
				if ( is_active_sidebar( 'footer-company' ) ) {
					dynamic_sidebar( 'footer-company' );
				}
				?>
			</div>
			<div class="col-sm-12 col-lg-2 col-md-3">
				<?php
				if ( is_active_sidebar( 'footer-about' ) ) {
					dynamic_sidebar( 'footer-about' );
				}
				?>
			</div>
			<div class="col-sm-12 col-lg-2 col-md-3">
				<?php
				if ( is_active_sidebar( 'footer-subscription' ) ) {
					dynamic_sidebar( 'footer-subscription' );
				}
				?>
			</div>
			<div class="col-sm-12 col-lg-2 col-md-2">
				<?php
				if ( is_active_sidebar( 'footer-contact' ) ) {
					dynamic_sidebar( 'footer-contact' );
				}
				?>
			</div>
		</div>
		<div class="row footer-bottom">
			<div class="col-md-6">
				<?php
				if ( is_active_sidebar( 'footer-copyright' ) ) {
					dynamic_sidebar( 'footer-copyright' );
				}
				?>
			</div>
			<div class="col-lg-4 offset-lg-2 col-md-6 subscribe-area">
				<?php
				if ( is_active_sidebar( 'footer-subscribe-form' ) ) {
					dynamic_sidebar( 'footer-subscribe-form' );
				}
				?>
			</div>
		</div>
	</div><!-- container end -->
</div><!-- wrapper end -->

</div><!-- #page we need this extra closing tag here -->

<?php wp_footer(); ?>

</body>
</html>
