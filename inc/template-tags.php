<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package everstrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
if ( ! function_exists( 'everstrap_posted_on' ) ) {
	function everstrap_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">&nbsp;/&nbsp; %1$s</time>';
		$time_string = sprintf(
			$time_string,
			esc_attr( get_the_date( 'F d, Y h:i A' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);
		$posted_on   = apply_filters(
			'everstrap_posted_on',
			sprintf(
				'<span class="posted-on">%1$s <a href="%2$s" rel="bookmark">%3$s</a></span>',
				esc_html_x( '&nbsp;', 'post date', 'everstrap' ),
				esc_url( get_permalink() ),
				apply_filters( 'everstrap_posted_on_time', $time_string )
			)
		);
		$byline      = apply_filters(
			'everstrap_posted_by',
			sprintf(
				'<span class="byline"> %1$s<span class="author vcard"><a class="url fn n" href="%2$s"> %3$s</a></span></span>',
				$posted_on ? esc_html_x( '&nbsp;', 'post author', 'everstrap' ) : esc_html_x( 'Posted by', 'post author', 'everstrap' ),
				esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
				esc_html( get_the_author() )
			)
		);
		echo $byline . $posted_on;
	}
}


/**
 * Show post author avatar
 */
if ( ! function_exists( 'everstrap_post_author_avatar' ) ) {
	function everstrap_post_author_avatar() {
		echo get_avatar( get_the_author_meta( 'ID' ) );
	}
}

/**
 * Post social share
 */
if ( ! function_exists( 'everstrap_post_social_share' ) ) {
	function everstrap_post_social_share( $post_id, array $socials, $title = null ) {
		$html  = '';
		$html .= '<div class="social-share">';

		if ( $title ) {
			$html .= '<p>' . $title . '</p>';
		}

		$html .= '<ul>';
		foreach ( $socials as $social ) {
			$html .= '<li>';
			if ( 'messenger' === $social ) {
				$html .= "<a href='" . everstrap_get_share_link( $post_id, $social ) . "' target='_blank'><img src='" . get_template_directory_uri() . '/images/fb-messenger.svg' . "'></a>";
			} elseif ( 'sms' === $social ) {
				$html .= "<a href=''><img src='" . get_template_directory_uri() . '/images/sms-solid.svg' . "'></a>";
			} elseif ( 'envelope' === $social ) {
				$html .= "<a class='send-message' target='_blank' data-title='" . everstrap_get_share_link( $post_id, $social ) . "'><i class='fa fa-envelope'></i></a>";
			} elseif ( 'link' === $social ) {
				$html .= "<a class='click-to-copy' data-link='" . everstrap_get_share_link( $post_id, $social ) . "'><i class='fa fa-link'></i></a>";
			} else {
				$html .= "<a href='" . everstrap_get_share_link( $post_id, $social ) . "'><i class='fa fa-{$social}'></i></a>";
			}

			$html .= '</li>';
		}
		$html .= '</ul>';
		$html .= '</div>';
		echo $html;
	}
}


/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
if ( ! function_exists( 'everstrap_entry_footer' ) ) {
	function everstrap_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( esc_html__( ', ', 'everstrap' ) );
			if ( $categories_list && everstrap_categorized_blog() ) {
				/* translators: %s: Categories of current post */
				printf( '<span class="cat-links">' . esc_html__( 'Posted in %s', 'everstrap' ) . '</span>', $categories_list );
			}
			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html__( ', ', 'everstrap' ) );
			if ( $tags_list ) {
				/* translators: %s: Tags of current post */
				printf( '<span class="tags-links">' . esc_html__( 'Tagged %s', 'everstrap' ) . '</span>', $tags_list );
			}
		}
		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link( esc_html__( 'Leave a comment', 'everstrap' ), esc_html__( '1 Comment', 'everstrap' ), esc_html__( '% Comments', 'everstrap' ) );
			echo '</span>';
		}
		edit_post_link(
			sprintf(
			/* translators: %s: Name of current post */
				esc_html__( 'Edit %s', 'everstrap' ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			),
			'<span class="edit-link">',
			'</span>'
		);
	}
}


/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
if ( ! function_exists( 'everstrap_categorized_blog' ) ) {
	function everstrap_categorized_blog() {
		//phpcs:ignore WordPress.CodeAnalysis.AssignmentInCondition.Found
		if ( false === ( $all_the_cool_cats = get_transient( 'everstrap_categories' ) ) ) {
			// Create an array of all the categories that are attached to posts.
			$all_the_cool_cats = get_categories(
				array(
					'fields'     => 'ids',
					'hide_empty' => 1,
					// We only need to know if there is more than one category.
					'number'     => 2,
				)
			);
			// Count the number of categories that are attached to the posts.
			$all_the_cool_cats = count( $all_the_cool_cats );
			set_transient( 'everstrap_categories', $all_the_cool_cats );
		}
		if ( $all_the_cool_cats > 1 ) {
			// This blog has more than 1 category so components_categorized_blog should return true.
			return true;
		} else {
			// This blog has only 1 category so components_categorized_blog should return false.
			return false;
		}
	}
}


/**
 * Flush out the transients used in everstrap_categorized_blog.
 */
add_action( 'edit_category', 'everstrap_category_transient_flusher' );
add_action( 'save_post', 'everstrap_category_transient_flusher' );

if ( ! function_exists( 'everstrap_category_transient_flusher' ) ) {
	function everstrap_category_transient_flusher() {
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}
		// Like, beat it. Dig?
		delete_transient( 'everstrap_categories' );
	}
}


/**
 * Post Category Function
 */
if ( ! function_exists( 'everstrap_post_categories' ) ) {
	function everstrap_post_categories() {
		if ( 'post' === get_post_type() ) {

			$term              = everstrap_get_primary_term( get_the_ID() );

			$is_paid_placement = get_post_meta( get_the_ID(), 'paid_placement' );
			$is_paid_placement = 'paid' == $is_paid_placement[0];
			$is_sponsored_post = 'sponsored-posts' == $term->slug;

			if ( ! empty( $term ) ) : ?>
				<div class="post-category <?php echo ( $is_sponsored_post || $is_paid_placement ) ? 'paid-category' : ''; ?>">
					<a href="<?php echo esc_url( get_term_link( $term->term_id ) ); ?>">
						<?php if ( $is_sponsored_post ): ?>
							<?php _e( 'SPONSORED POST', 'everstrap' ); ?>
						<?php else: ?>
							<?php echo esc_html__( $term->name, 'everstrap' ); ?>
						<?php endif; ?>
					</a>
				</div>
			<?php
			endif;
		}
	}
}

/**
 * Event Category Function
 */
if ( ! function_exists( 'everstrap_event_categories' ) ) {
	function everstrap_event_categories( $post_id ) {
		if ( 'pro_event' === get_post_type() ) {
			$is_paid_placement = get_post_meta( get_the_ID(), 'paid_placement' );
			$terms = get_the_terms( $post_id, 'event_category' );
			$html  = [];
			if ( is_array( $terms ) ) {
				foreach ( $terms as $term ) {
					$html[] = "<a href='" . esc_url( get_term_link( $term->term_id ) ) . "'>" . esc_html__( $term->name, 'everstrap' ) . '</a>';
				}
				?>
				<div class="post-category <?php echo 'paid' == $is_paid_placement[0] ? 'paid-category' : ''; ?>">
					<?php echo implode( ', ', $html ); ?>
				</div>
				<?php
            }
		}
	}
}

/**
 * Post ByLine Function
 */
if ( ! function_exists( 'everstrap_post_byline' ) ) {
	function everstrap_post_byline() {
		if ( 'post' === get_post_type() ) {
			$posted_by = sprintf(
				'<span class="byline"> %1$s<a class="url fn n" href="%2$s"> %3$s</a></span>',
				esc_html_x( 'by', 'post author', 'everstrap' ),
				esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
				esc_html( get_the_author() )
			);
			echo $posted_by;
		}
	}
}

/**
 * Related post Function
 */
if ( ! function_exists( 'everstrap_related_post' ) ) {
	function everstrap_related_post( $post_id, $title = null ) {

		$terms = get_the_terms( $post_id, 'category' );
		if ( $terms ) {
			$args = array(
				'post_type'    => 'post',
				'post__not_in' => array( $post_id ),
				'numberposts'  => 3,
				'tax_query'    => array(
					array(
						'taxonomy' => 'category',
						'field'    => 'slug',
						'terms'    => array( $terms[0]->slug ),
					),
				),
			);

			$related_posts = get_posts( $args );
			if ( $related_posts ) {
				echo '<div class="single-post-related-post">';
				if ( $title ) {
					echo '<p>' . $title . '</p>';
				}
				$count = 1;
				foreach ( $related_posts as $post ) {
					setup_postdata( $post );
					$id = $post->ID;
					echo '<div class="related-post-inner"><span class="related_post_no">' . $count . '</span><h5><a href="' . esc_url( get_the_permalink( $id ) ) . '">' . $post->post_title . '</h5></a></div>';
					$count ++;
				}
				wp_reset_postdata();
				echo '</div>';
			}
		}
	}
}

/**
 * Get site logo
 */
if ( ! function_exists( 'everstrap_site_logo' ) ) {
	function everstrap_site_logo() {
		if ( has_custom_logo() ) {
			$custom_logo_id = get_theme_mod( 'custom_logo' );
			$logo           = wp_get_attachment_image_src( $custom_logo_id, 'large' );
			echo "<a href='" . site_url( '/' ) . "'><img src='{$logo[0]}'></a>";
		} else {
			echo get_bloginfo( 'name' );
		}
	}
}


/**
 * Related post slider
 */
if ( ! function_exists( 'everstrap_related_post_slider' ) ) {
	function everstrap_related_post_slider( $post_id ) {

		$terms = get_the_terms( $post_id, 'category' );

		if ( $terms ) {
			$args = array(
				'post_type'    => 'post',
				'post__not_in' => array( $post_id ),
				'tax_query'    => array(
					array(
						'taxonomy' => 'category',
						'field'    => 'slug',
						'terms'    => array( $terms[0]->slug ),
					),
				),
			);

			$related_posts = get_posts( $args );

			if ( $related_posts ) {
				echo '<div class="owl-carousel owl-theme">';
				foreach ( $related_posts as $post ) {
					setup_postdata( $post );
					$post_thumb     = get_the_post_thumbnail( $post->ID, 'prev-next-post-thumb' );
					$post_title     = get_the_title( $post->ID );
					$post_permalink = get_the_permalink( $post->ID )
					?>
						<div class="item">
							<a href="<?php echo $post_permalink; ?>">
								<?php echo $post_thumb; ?>
							</a>
							<h3>
								<a href="<?php echo $post_permalink ?>">
									<?php echo $post_title; ?>
								</a>
							</h3>
						</div>
					<?php
				}
				wp_reset_postdata();
				echo '</div>';
			}
		}
	}
}
