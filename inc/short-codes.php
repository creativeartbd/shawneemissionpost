<?php
/**
 * EverStrap short code functions
 *
 * @package everstrap
 */

add_shortcode( 'shawmee_social_media', 'everstrap_social_media_func' );
function everstrap_social_media_func() {

	// If ACF class is not available / active
	if ( ! class_exists( 'acf' ) ) {
		return;
	}

	$fields = [
		'email_address' => 'fa fa-envelope',
		'twiiter'       => 'fa fa-twitter',
		'facebook'      => 'fa fa-facebook',
		'instagram'     => 'fa fa-instagram',
	];
	$id     = 'option';
	$data   = '';
	foreach ( $fields as $field => $class ) {
		if ( get_field( $field, $id ) ) {
			if ( 'email_address' == $field ) {
				$data .= "<a href='mailto:" . get_field( $field, $id ) . "'>";
			} else {
				$data .= "<a href='" . get_field( $field, $id ) . "'>";
			}

			$data .= "<i class='{$class}' aria-hidden='true'></i>";
			$data .= '</a>';
		}
	}

	return $data;
}

add_shortcode( 'shawmee_search_icon', 'everstrap_shawmee_search_func' );
function everstrap_shawmee_search_func() {
	return "<a class='search-icon'><i class='fa fa-search'></i></a>";
}

add_shortcode( 'shawmee_subscribe_and_login', 'everstrap_subscribe_and_login_func' );
function everstrap_subscribe_and_login_func() {
	$sign_in_url       = wp_login_url();
	$logout_url        = wp_logout_url();
	$registration_url  = wp_registration_url();
	$profile_url       = get_edit_profile_url( get_current_user_id() );
	$current_date      = date( 'F d, Y' );
	$sign_in_text      = __( 'Sign In', 'everstrap' );
	$myaccount_text    = __( 'My Account', 'everstrap' );
	$logout_text       = __( 'Log Out', 'everstrap' );
	$subscribe_today   = __( 'Subscribe today', 'everstrap' );
	$subscriber_log_in = __( 'Subscriber log in', 'everstrap' );

	/*
	// Commented because client don't want login system
	if ( is_user_logged_in() ) {
		$user_account_link = "<a href='{$profile_url}'>{$myaccount_text}</a><a href='{$logout_url}'>{$logout_text}</a><span>{$current_date}</span>";
	} else {
		$user_account_link = "<a href='{$registration_url}'>{$myaccount_text}</a><a href='{$sign_in_url}'>{$sign_in_text}</a>
		<span>{$current_date}</span>";
	}
	*/

	$user_account_link = "<a href='/?pn=manage_account'>{$subscriber_log_in}</a>";

	$data = <<<EOD
	<div class="subscribe-now">
		<a href='https://api.pico.tools/pn/shawneemissionpost' target='_blank' >
			<button type="button" class="subscribe-btn PicoSignal">{$subscribe_today}</button>
		</a>
	</div>
	<div class="account-box">
		$user_account_link
	</div>
EOD;

	if( !is_user_logged_in() ) {
		return $data;
	}
	return;
}
