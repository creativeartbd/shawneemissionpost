<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package everstrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();
?>

<div class="wrapper p-0" id="error-404-wrapper">

	<div class="container" id="content" tabindex="-1">

		<div class="row">

			<div class="col-md-12 content-area" id="primary">

				<main class="site-main" id="main">

					<section class="error-404 not-found text-center h-100 mt-5">

						<header class="page-header">

							<h1 class="page-title"><?php esc_html_e( '404', 'everstrap' ); ?></h1>

						</header><!-- .page-header -->

						<div class="page-content m-5 pb-5">

							<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'everstrap' ); ?></p>

							<p>
								<?php
								echo sprintf( '%s <a href="%s">%s</a>',
									esc_html__( 'Want to go home?', 'everstrap' ),
									get_home_url(),
									esc_html__( 'click here', 'everstrap' )
								);
								?>
							</p>

							<?php get_search_form(); ?>

						</div><!-- .page-content -->

					</section><!-- .error-404 -->

				</main><!-- #main -->

			</div><!-- #primary -->


		</div><!-- .row -->

	</div><!-- #content -->

</div><!-- #error-404-wrapper -->

<?php
get_footer();
