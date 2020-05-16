<?php
/**
 * The template for displaying single event
 *
 * @package everstrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
get_header();
$container = get_theme_mod( 'everstrap_container_type' );
?>

	<div class="wrapper p-0" id="index-wrapper">
		<div class="<?php echo esc_attr( $container ); ?>" id="content" tabindex="-1">
			<div class="row">
				<?php get_template_part( 'global-templates/left-sidebar-check' ); ?>
				<main>
					<?php
					if ( have_posts() ) {
						while ( have_posts() ) {
							the_post();
							the_content();
						}
					}
					// add event calendar
					?>
					<article>
						<?php get_template_part( 'template-parts/archive', 'event-calendar' ); ?>
					</article>
				</main>
				<?php get_template_part( 'global-templates/right-sidebar-check' ); ?>
			</div>
		</div>
	</div>

<?php
get_footer();
