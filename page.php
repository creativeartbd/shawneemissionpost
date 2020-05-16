<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package everstrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
get_header();
?>

<div class="wrapper p-0" id="page-wrapper">
	<div class="container" id="content" tabindex="-1">
		<div class="row">
			<!-- Do the left sidebar check -->
			<?php get_template_part( 'global-templates/left-sidebar-check' ); ?>
			<main class="site-main" id="main">
				<?php
				while ( have_posts() ) :
					the_post();
					?>
					<?php
					if ( has_shortcode( get_the_content(), 'event_calendar_pro_event_list' ) ) {
						get_template_part( 'loop-templates/content', 'event-page' );
					} else {
						get_template_part( 'loop-templates/content', 'page' );
					}
					?>

				<?php endwhile; // end of the loop. ?>
			</main><!-- #main -->
			<!-- Do the right sidebar check -->
			<?php get_template_part( 'global-templates/right-sidebar-check' ); ?>
		</div><!-- .row -->
	</div><!-- #content -->
</div><!-- #page-wrapper -->
<?php
get_footer();
