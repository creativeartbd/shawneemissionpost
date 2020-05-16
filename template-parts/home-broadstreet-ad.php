<?php
/**
 * Home Paid Placement Template
 *
 * Template for displaying broadstreet ad
 *
 * @package everstrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
$community_partner = get_category_by_slug( 'community-partner' );
$community_partner_link = $community_partner ? get_category_link( $community_partner ) : '#';
?>
<article class="paid-placement-wrapper">

	<header class="entry-header">
		<div class="entry-header-inner">
            <div class="post-category paid-category">
                <a href="<?php echo $community_partner_link; ?>">Community Partner</a>
            </div>
			<div class="paid-placement"><?php _e( 'Paid Placement', 'everstrap' ); ?></div>
		</div>
	</header>

	<div class="entry-content">
        <broadstreet-zone zone-id="80041"></broadstreet-zone>
	</div>

</article><!-- #post-## -->