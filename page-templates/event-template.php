<?php
/**
 * Template Name: Event Listing Template
 *
 * Template for displaying all event listing.
 *
 * @package everstrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
get_header();
?>

<div class="wrapper" id="page-wrapper">
	<div class="container" id="content" tabindex="-1">
		<div class="row">
		<!-- Do the left sidebar check -->
		<?php get_template_part( 'global-templates/left-sidebar-check' ); ?>
			<main class="site-main" id="main">
				<?php
				while ( have_posts() ) :
					the_post();
						?>
						<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
							<div class="entry-content">
								<?php the_content(); ?>
								<?php
								wp_link_pages(
									array(
										'before' => '<div class="page-links">' . __( 'Pages:', 'everstrap' ),
										'after'  => '</div>',
									)
								);
								?>
							</div><!-- .entry-content -->
							<footer class="entry-footer">
								<?php edit_post_link( __( 'Edit', 'everstrap' ), '<span class="edit-link">', '</span>' ); ?>
							</footer><!-- .entry-footer -->

						</article><!-- #post-## -->
				<?php
				endwhile;
				?>
			</main>
			<!-- Do the right sidebar check -->
			<?php get_template_part( 'global-templates/right-sidebar-check' ); ?>
		</div>
	</div>
</div>

<?php
get_footer();
