<?php
/**
 * The template for displaying the author pages
 *
 * Learn more: https://codex.wordpress.org/Author_Templates
 *
 * @package everstrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
get_header();
?>

<div class="wrapper p-0" id="author-wrapper">
	<div class="container" id="content" tabindex="-1">
		<div class="row">
			<!-- Do the left sidebar check -->
			<?php get_template_part( 'global-templates/left-sidebar-check' ); ?>
			<main class="site-main" id="main">
				<div class="author-page">
					<header class="page-header author-header">
						<?php
						if ( isset( $_GET['author_name'] ) ) { //phpcs:ignore
							$curauth = get_user_by( 'slug', $author_name );//phpcs:ignore
						} else {
							$curauth = get_userdata( intval( $author ) ); //phpcs:ignore
						}
						?>
						<?php if ( ! empty( $curauth->ID ) ) : ?>
							<?php echo get_avatar( $curauth->ID ); ?>
						<?php endif; ?>

						<div class="author-meta">
							<h1><?php echo esc_html__( 'About:', 'everstrap' ) . ' ' . esc_html( $curauth->nickname ); ?></h1>
							<?php if ( ! empty( $curauth->user_url ) || ! empty( $curauth->user_description ) ) : ?>
								<dl>
									<?php if ( ! empty( $curauth->user_url ) ) : ?>
										<dt><?php esc_html_e( 'Website', 'everstrap' ); ?></dt>
										<dd>
											<a href="<?php echo esc_url( $curauth->user_url ); ?>"><?php echo esc_html( $curauth->user_url ); ?></a>
										</dd>
									<?php endif; ?>
									<?php if ( ! empty( $curauth->user_description ) ) : ?>
										<dt><?php esc_html_e( 'Profile', 'everstrap' ); ?></dt>
										<dd><?php wp_kses_post(_e( $curauth->user_description, 'everstrap' ) ); ?></dd>
									<?php endif; ?>
								</dl>
							<?php endif; ?>
						</div>
					</header><!-- .page-header -->

					<div class="author-posts">
						<h2><?php echo esc_html( 'Posts by', 'everstrap' ) . ' ' . esc_html( $curauth->nickname ); ?>:</h2>
							<?php if ( have_posts() ) : ?>
								<?php
								while ( have_posts() ) :
									the_post();
									?>
									<div class="author-post">
										<?php echo get_the_post_thumbnail( get_the_ID(), 'event-list-thumb' ); ?>
										<div class="author-post-title">
											<h3>
												<a href="<?php echo get_the_permalink(); ?>">
													<?php echo get_the_title(); ?>
												</a>
											</h3>
											<div class="author-post-meta">
												<?php everstrap_posted_on(); ?>
												<?php esc_html_e( 'in', 'everstrap' ); ?>
												<?php the_category( '&' ); ?>
											</div>
										</div>
									</div>
								<?php endwhile; ?>
							<?php else : ?>
								<?php get_template_part( 'loop-templates/content', 'none' ); ?>
							<?php endif; ?>
							<!-- End Loop -->
						</ol>
					</div>
				</div>
			</main><!-- #main -->
			<!-- The pagination component -->
			<?php everstrap_pagination(); ?>
			<!-- Do the right sidebar check -->
			<?php get_template_part( 'global-templates/right-sidebar-check' ); ?>
		</div> <!-- .row -->
	</div><!-- #content -->
</div><!-- #author-wrapper -->
<?php
get_footer();
