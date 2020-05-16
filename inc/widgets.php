<?php
/**
 * Declaring widgets
 *
 * @package everstrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/**
 * Add filter to the parameters passed to a widget's display callback.
 * The filter is evaluated on both the front and the back end!
 *
 * @link https://developer.wordpress.org/reference/hooks/dynamic_sidebar_params/
 */
add_filter( 'dynamic_sidebar_params', 'everstrap_widget_classes' );

if ( ! function_exists( 'everstrap_widget_classes' ) ) {
	/**
	 * Count number of visible widgets in a sidebar and add classes to widgets accordingly,
	 * so widgets can be displayed one, two, three or four per row.
	 *
	 * @param array $params {
	 *
	 * @type array $args {
	 *         An array of widget display arguments.
	 *
	 * @type string $name Name of the sidebar the widget is assigned to.
	 * @type string $id ID of the sidebar the widget is assigned to.
	 * @type string $description The sidebar description.
	 * @type string $class CSS class applied to the sidebar container.
	 * @type string $before_widget HTML markup to prepend to each widget in the sidebar.
	 * @type string $after_widget HTML markup to append to each widget in the sidebar.
	 * @type string $before_title HTML markup to prepend to the widget title when displayed.
	 * @type string $after_title HTML markup to append to the widget title when displayed.
	 * @type string $widget_id ID of the widget.
	 * @type string $widget_name Name of the widget.
	 *     }
	 * @type array $widget_args {
	 *         An array of multi-widget arguments.
	 *
	 * @type int $number Number increment used for multiples of the same widget.
	 *     }
	 * }
	 * @return array $params
	 * @global array $sidebars_widgets
	 */
	function everstrap_widget_classes( $params ) {

		global $sidebars_widgets;

		/*
		 * When the corresponding filter is evaluated on the front end
		 * this takes into account that there might have been made other changes.
		 */
		$sidebars_widgets_count = apply_filters( 'sidebars_widgets', $sidebars_widgets ); //phpcs:ignore

		// Only apply changes if sidebar ID is set and the widget's classes depend on the number of widgets in the sidebar.
		if ( isset( $params[0]['id'] ) && strpos( $params[0]['before_widget'], 'dynamic-classes' ) ) {
			$sidebar_id   = $params[0]['id'];
			$widget_count = count( $sidebars_widgets_count[ $sidebar_id ] );

			$widget_classes = 'widget-count-' . $widget_count;
			if ( 0 === $widget_count % 4 || $widget_count > 6 ) {
				// Four widgets per row if there are exactly four or more than six.
				$widget_classes .= ' col-md-3';
			} elseif ( 6 === $widget_count ) {
				// If two widgets are published.
				$widget_classes .= ' col-md-2';
			} elseif ( $widget_count >= 3 ) {
				// Three widgets per row if there's three or more widgets.
				$widget_classes .= ' col-md-4';
			} elseif ( 2 === $widget_count ) {
				// If two widgets are published.
				$widget_classes .= ' col-md-6';
			} elseif ( 1 === $widget_count ) {
				// If just on widget is active.
				$widget_classes .= ' col-md-12';
			}

			// Replace the placeholder class 'dynamic-classes' with the classes stored in $widget_classes.
			$params[0]['before_widget'] = str_replace( 'dynamic-classes', $widget_classes, $params[0]['before_widget'] );
		}

		return $params;

	}
}

add_action( 'widgets_init', 'everstrap_widgets_init' );

if ( ! function_exists( 'everstrap_widgets_init' ) ) {
	/**
	 * Initializes themes widgets.
	 */
	function everstrap_widgets_init() {
		register_sidebar(
			array(
				'name'          => __( 'Right Sidebar', 'everstrap' ),
				'id'            => 'right-sidebar',
				'description'   => __( 'Right sidebar widget area', 'everstrap' ),
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget'  => '</aside>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			)
		);

		register_sidebar(
			array(
				'name'          => __( 'Left Sidebar', 'everstrap' ),
				'id'            => 'left-sidebar',
				'description'   => __( 'Left sidebar widget area', 'everstrap' ),
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget'  => '</aside>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			)
		);

		register_sidebar(
			array(
				'name'          => __( 'Header advertisement', 'everstrap' ),
				'id'            => 'header-advertisement-widget',
				'description'   => 'Enter your advertisement code',
				'before_widget' => '<div class="header-advertisement">',
				'after_widget'  => '</div>',
				'before_title'  => '<h3 class="footer-widget-title">',
				'after_title'   => '</h3>',
			)
		);

		register_sidebar(
			array(
				'name'          => __( 'Home event calender advertisement', 'everstrap' ),
				'id'            => 'home-event-calender-advertisement',
				'description'   => 'Enter advertisement code',
				'before_widget' => '<div class="home-event-caleder-advertisement">',
				'after_widget'  => '</div>',
				'before_title'  => '',
				'after_title'   => '',
			)
		);

		register_sidebar(
			array(
				'name'          => __( 'Subscription message below calendar', 'everstrap' ),
				'id'            => 'event-subscription-message',
				'description'   => 'Enter subscription message which will show below the event calendar',
				'before_widget' => '<div class="event-subscription-message">',
				'after_widget'  => '</div>',
				'before_title'  => '',
				'after_title'   => '',
			)
		);

		register_sidebar(
			array(
				'name'          => __( 'Bottom posts advertisement', 'everstrap' ),
				'id'            => 'bottom-post-advertisement',
				'description'   => 'Enter advertisement code which will show between the bottom posts',
				'before_widget' => '<div class="bottom-post-advertisement">',
				'after_widget'  => '</div>',
				'before_title'  => '',
				'after_title'   => '',
			)
		);

		register_sidebar(
			array(
				'name'          => __( 'Footer Company', 'everstrap' ),
				'id'            => 'footer-company',
				'description'   => 'Enter widget here',
				'before_widget' => '<div class="footer-company">',
				'after_widget'  => '</div>',
				'before_title'  => '<h3 class="footer-widget-title">',
				'after_title'   => '</h3>',
			)
		);

		register_sidebar(
			array(
				'name'          => __( 'Footer About', 'everstrap' ),
				'id'            => 'footer-about',
				'description'   => 'Enter widget here',
				'before_widget' => '<div class="footer-menu">',
				'after_widget'  => '</div>',
				'before_title'  => '<h3 class="footer-widget-title">',
				'after_title'   => '</h3>',
			)
		);

		register_sidebar(
			array(
				'name'          => __( 'Footer Subscription', 'everstrap' ),
				'id'            => 'footer-subscription',
				'description'   => 'Enter widget here',
				'before_widget' => '<div class="footer-menu">',
				'after_widget'  => '</div>',
				'before_title'  => '<h3 class="footer-widget-title">',
				'after_title'   => '</h3>',
			)
		);

		register_sidebar(
			array(
				'name'          => __( 'Footer Contact', 'everstrap' ),
				'id'            => 'footer-contact',
				'description'   => 'Enter widget here',
				'before_widget' => '<div class="footer-menu">',
				'after_widget'  => '</div>',
				'before_title'  => '<h3 class="footer-widget-title">',
				'after_title'   => '</h3>',
			)
		);

		register_sidebar(
			array(
				'name'          => __( 'Footer copyright', 'everstrap' ),
				'id'            => 'footer-copyright',
				'description'   => 'Enter widget here',
				'before_widget' => '<div class="footer-copyright">',
				'after_widget'  => '</div>',
				'before_title'  => '<h3 class="footer-widget-title">',
				'after_title'   => '</h3>',
			)
		);

		register_sidebar(
			array(
				'name'          => __( 'Footer subscription form', 'everstrap' ),
				'id'            => 'footer-subscribe-form',
				'description'   => 'Enter widget here',
				'before_widget' => '<div class="footer-subscribe-form">',
				'after_widget'  => '</div>',
				'before_title'  => '<h3 class="footer-widget-title">',
				'after_title'   => '</h3>',
			)
		);

		register_sidebar(
			array(
				'name'          => __( 'Sidebar advertisement banner', 'everstrap' ),
				'id'            => 'sidebar-advertisement-banner',
				'description'   => 'Enter widget here',
				'before_widget' => '<div class="sidebar-advertisement-banner">',
				'after_widget'  => '</div>',
				'before_title'  => '<h3 class="footer-widget-title">',
				'after_title'   => '</h3>',
			)
		);

		register_sidebar(
			array(
				'name'          => __( 'Single post advertisement banner', 'everstrap' ),
				'id'            => 'single-post-advertisement',
				'description'   => 'Enter widget here',
				'before_widget' => '<div class="single-post-advertisement">',
				'after_widget'  => '</div>',
				'before_title'  => '',
				'after_title'   => '',
			)
		);

		register_sidebar(
			array(
				'name'          => __( 'Home page event calendar', 'everstrap' ),
				'id'            => 'home-page-event-calendar',
				'description'   => 'Enter widget here',
				'before_widget' => '<div class="home-page-event-calendar">',
				'after_widget'  => '</div>',
				'before_title'  => '',
				'after_title'   => '',
			)
		);

		register_sidebar( array(
			'name'          => __( 'Event List Page Brand Ads', 'everstrap' ),
			'id'            => 'event-list-ads',
			'description'   => 'Brand Ads For Event List Page',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );
	}
}


if ( ! class_exists( 'Everstrap_ECP_Extended_Widget' ) ) {
	/**
	 *  Adds ECP_Extended_Widget widget.
	 */
	class Everstrap_ECP_Extended_Widget extends WP_Widget {
		/**
		 * Register widget with WordPress.
		 */
		public function __construct() {
			add_action( 'widgets_init', array( $this, 'register_ecp_widget' ) );
			parent::__construct(
				'ecp_widget', // Base ID
				esc_html__( 'Event Calendar Pro', 'everstrap' ),
				array( 'description' => esc_html__( 'Show and Filters Events', 'everstrap' ) )
			);
		}

		/**
		 * Frontend display
		 *
		 * @param  array  $widget_args Argument
		 * @param  string $instance Instance
		 */
		public function widget( $widget_args, $instance ) {

			echo $widget_args['before_widget'];

			if ( ! empty( $instance['title'] ) ) {
				$widget_title = apply_filters( 'widget_title', $instance['title'] );
				echo '<button class="event-community-btn">' . $widget_title . '</button>';
			}

			$events_page = ecp_get_settings( 'events_page', 'calendar', 'event_calendar_pro_page_settings' );

			$date = get_query_var( 'date' );
			if ( empty( $date ) ) {
				$date = date( 'Y-m-d', current_time( 'timestamp' ) );
			}

			$args = array(
				'order_by' => 'event_start_date',
				'order'    => 'DESC',
			);

			if ( ! empty( $date ) ) {
				$args['start_date'] = $date;
			}

			$args = apply_filters( 'ecp_widget_events_query_args', $args );

			$events = ecp_get_event_list( $args );

			ob_start();
			ecp_get_template( 'widget/main.php', [
				'events'		=> $events,
				'events_page'	=> $events_page,
			]);

			$html = ob_get_clean();
			echo $html;
			echo $widget_args['after_widget'];
		}

		/**
		 * Back-end widget form.
		 *
		 * @param array $instance Previously saved values from database.
		 *
		 * @see WP_Widget::form()
		 */
		public function form( $instance ) {
			$title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'Calendar', 'everstrap' );
			?>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>">
					<?php esc_attr_e( 'Title Changes:', 'everstrap' ); ?>
				</label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
			</p>
			<?php
		}

		/**
		 * Sanitize widget form values as they are saved.
		 *
		 * @param array $new_instance Values just sent to be saved.
		 * @param array $old_instance Previously saved values from database.
		 *
		 * @return array Updated safe values to be saved.
		 * @see WP_Widget::update()
		 */
		public function update( $new_instance, $old_instance ) {
			$instance                = array();
			$instance['title']       = ( ! empty( $new_instance['title'] ) ) ? sanitize_text_field( $new_instance['title'] ) : '';
			return $instance;
		}

		/**
		 * Register the wdiget
		 */
		public function register_ecp_widget() {
			register_widget( 'Everstrap_ECP_Extended_Widget' );
		}
	}

	$ecp_extended_widget = new Everstrap_ECP_Extended_Widget();
}
