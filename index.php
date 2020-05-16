<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
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
					$counter        = 1;
					$posts_per_page = get_option( 'posts_per_page' );
					$paged          = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 0;

					$args = array(
						'post_type' => 'post',
						'orderby'   => 'date',
						'order'     => 'DESC',
						'paged'     => $paged
					);

					$query = new WP_Query( $args );

					while( $query->have_posts() ) {
						$query->the_post();
							if( 1 == $counter ) {
								// Show full post on each page first post
								get_template_part( 'loop-templates/content', 'top-post' );

								// show paid placement meta posts and event posts after the first top post
								//get_template_part( 'template-parts/home', 'paid-placement' );
								get_template_part( 'template-parts/home', 'broadstreet-ad' );
								get_template_part( 'template-parts/home', 'event-paid-placement' );
								// Event calendar section
								get_template_part( 'template-parts/home', 'event-calendar' );

							} else {
								// Show bottom post's
								if( 4 == $counter || 8 == $counter ) {
									if ( is_active_sidebar( 'bottom-post-advertisement' ) ) {
										dynamic_sidebar( 'bottom-post-advertisement' );
									}
								}
								get_template_part( 'loop-templates/content' );
							}
						$counter++;
					}
					?>

				</main>
				<!-- The pagination component -->
				<?php everstrap_pagination(); ?>
				<!-- Do the right sidebar check -->
				<?php get_template_part( 'global-templates/right-sidebar-check' ); ?>
			</div><!-- .row -->
		</div><!-- #content -->
	</div><!-- #index-wrapper -->

<?php get_footer();
