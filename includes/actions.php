<?php
/**
 * Actions
 *
 * @package WordPress
 * @subpackage WPX_Theme
 * @since 0.1.0
 * @version 1.0
 */
namespace WPX\Actions;

/**
 * Redirect wp-login.php to /login/ for non-admins
 */
function custom_login_page() {
	$new_login_page_url = home_url( '/login/' ); // new login page
	global $pagenow;
	if( $pagenow == "wp-login.php" && $_SERVER['REQUEST_METHOD'] == 'GET') {
		wp_redirect($new_login_page_url);
		exit;
	}
}

if(!is_user_logged_in()){
	add_action('init','\WPX\Actions\custom_login_page');
}

/**
 * redirect to /login/ with action query
 * for failed username
 */
function custom_login_failed() {
	$login_page  = home_url('/login/');
	wp_redirect($login_page . '?action=loginfailure');
	exit;
}
add_action('wp_login_failed', '\WPX\Actions\custom_login_failed');

/**
 * redirect to /login/ with action query
 * for failed password
 */

function verify_user_pass($user, $username, $password) {
	
	$login_page  = home_url('/login/');

	if($username == "" || $password == "") {
		wp_redirect($login_page . "?action=loginfailure");
		exit;
	}

	$secretKey = get_field('recaptcha_secret_key','options');

	if ($secretKey) {

		if( isset($_POST['g-recaptcha-response']) ) {
			$captcha = $_POST['g-recaptcha-response'];
		}

		if(!$captcha) {
			wp_redirect($login_page . "?action=recaptchafail");
			exit;
		} else {
			// post request to server
			$url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secretKey) .  '&response=' . urlencode($captcha);
			$response = file_get_contents($url);
			$responseKeys = json_decode($response,true);

			// should return JSON with success as true
			if( $responseKeys["success"] ) {
				// proceed
			} else {
				wp_redirect($login_page . "?action=recaptchafail");
				exit;
			}
		}

	}

}
add_filter('authenticate', '\WPX\Actions\verify_user_pass', 1, 3);

// logout
function logout_redirect() {
	$login_page  = home_url('/login/');
	wp_redirect($login_page . "?action=logout");
	exit;
}
add_action('wp_logout','\WPX\Actions\logout_redirect');

/**
 * Updates the User Account
 * So Application Can't Be Altered, Post Submission
 * in Ninja Forms
 */
function user_completed_form( $form_data ){

	$form_id = $form_data['form_id'];

	$is_saving = $form_data['extra'];

	// RSVP form
	if ($form_id == 2) {

		$form_fields =  $form_data[ 'fields' ];

		// loop thru fields
		foreach( $form_fields as $field ){

			$field_id    = $field[ 'id' ];
			$field_key   = $field[ 'key' ];
			$field_value = $field[ 'value' ];

			// if the field key is the hidden user ID
			if( 'hidden_1516060495900' == $field[ 'key' ] ){
				
				// and we're not saving
				if (empty($is_saving)) :
				
					// lock the user from filling out the form again
					update_user_meta( $field_value, 'user_is_locked', 1);

				endif;

			}
		}

	}

}
add_action( 'ninja_forms_after_submission', '\WPX\Actions\user_completed_form' );

/**
 * Disable Default Dashboard Widgets
 */
function dashboard_sidebar_widgets() {
	unregister_widget( 'WP_Widget_Archives' );
	unregister_widget( 'WP_Widget_Categories' );
	unregister_widget( 'WP_Widget_Links' );
	unregister_widget( 'WP_Widget_Calendar' );
	unregister_widget( 'WP_Widget_Tag_Cloud' );
	unregister_widget( 'WP_Widget_Pages' );
	unregister_widget( 'WP_Widget_Search' );
	unregister_widget( 'WP_Nav_Menu_Widget' );
	unregister_widget( 'WP_Widget_Meta' );
	unregister_widget( 'WP_Widget_Text' );
	unregister_widget( 'WP_Widget_RSS' );
	unregister_widget( 'WP_Widget_Recent_Comments' );
	unregister_widget( 'WP_Widget_Recent_Posts' );
	unregister_widget( 'Akismet_Widget' );
}
add_action( 'widgets_init', '\WPX\Actions\dashboard_sidebar_widgets' );