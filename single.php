<?php
/**
 * The template for displaying all single posts
 *
 * @package everstrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
get_header();
?>
	<div class="wrapper p-0" id="single-wrapper">
		<div class="container" id="content" tabindex="-1">
			<div class="row">
				<!-- Do the left sidebar check -->
				<?php get_template_part( 'global-templates/left-sidebar-check' ); ?>
				<main class="site-main" id="main">
					<?php while ( have_posts() ) : the_post(); ?>
						<?php get_template_part( 'loop-templates/content', 'single' ); ?>
					<?php endwhile; // end of the loop. ?>

					<!-- Show prev and next link -->
					<div class="prev-next-posts-section">
						<div class="prev-post">
							<div class="prev-link">
								<?php
								$prev =  __( 'PREV', 'everstrap' );
								previous_post_link( '%link', "<i class='fa fa-arrow-left' aria-hidden='true'></i>&nbsp;<strong>{$prev}</strong>", true ); ?>
							</div>
						</div>
						<div class="next-post">
							<div class="next-link">
								<?php
								$next =  __( 'NEXT', 'everstrap' );
								next_post_link( '%link', "<strong>{$next}</strong>&nbsp;<i class='fa fa-arrow-right' aria-hidden='true'></i>" ); ?>
							</div>
						</div>
					</div>

					<?php everstrap_related_post_slider( get_the_ID() ); ?>

					<div class="post-comments">
						<?php
						if ( comments_open() || get_comments_number() ) {
							comments_template();
						}
						?>
					</div>

				</main><!-- #main -->
				<!-- Do the right sidebar check -->
				<?php get_template_part( 'global-templates/right-sidebar-check' ); ?>
			</div><!-- .row -->
		</div><!-- #content -->
	</div><!-- #single-wrapper -->
<?php
get_footer();
