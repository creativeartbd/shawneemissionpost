<?php
/**
 * Home event calendar section
 *
 * Template for displaying home page event calendar
 *
 * @package everstrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

?>
<article>

		<div class="home-event-wrapper">
			<div class="event-advertisement">
				<?php
				if ( is_active_sidebar( 'home-event-calender-advertisement' ) ) {
					dynamic_sidebar( 'home-event-calender-advertisement' );
				}
				?>
			</div>
			<div class="event-section">
				<?php
				if ( is_active_sidebar( 'home-page-event-calendar' ) ) {
					dynamic_sidebar( 'home-page-event-calendar' );
				}
				?>
			</div>
		</div>

</article>
<?php
