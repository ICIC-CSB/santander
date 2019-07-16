<?php
/**
 * Custom Utility Functions
 *
 * @package WordPress
 * @subpackage WPX_Theme
 * @since 0.1.0
 * @version 1.0
 */
namespace WPX\Custom;

function create_secret() {
	$chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ234567'; // allowed characters in Base32
	$secret = '';
	for ( $i = 0; $i < 16; $i++ ) {
		$secret .= substr( $chars, wp_rand( 0, strlen( $chars ) - 1 ), 1 );
	}
	return $secret;
}


function get_user_messaging($state=false) {

	if (isset($state['action'])) {

		if ($state['action'] == 'loginfailure') {

			echo '<p class="message warning">Your password, username, or authentication code is incorrect.</p>';

		} else if ($state['action'] == 'recaptchafail') {

			echo '<p class="message warning">Please enter the reCAPTCHA code.</p>';

		} else if ($state['action'] == 'logout') {

			echo '<p class="message">You are now logged out.</p>';

		}

	} elseif (isset($state['ur_token'])) {

		echo '<p class="message">Your account has been activated. You may now log in.</p>';

	} else {
		return false;
	}

}

/**
 * Writes Errors to Log File
 */
function write_log ( $log )  {
	if ( is_array( $log ) || is_object( $log ) ) {
		error_log( print_r( $log, true ) );
	} else {
		error_log( $log );
	}
}