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
 * Update RSVP
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

			// if this is the RSVP code field
			if( 'hidden_1516060495900' == $field[ 'key' ] ){
				
				// if we're not saving
				if (empty($is_saving)) :
				
					// lock the user from filling out the form again
					update_user_meta( $field_value, 'user_is_locked', 1);

				endif;

			}
		}

	}

}
add_action( 'ninja_forms_after_submission', '\WPX\Actions\user_completed_form' );

function remove_password_strength() {
	if ( wp_script_is( 'wc-password-strength-meter', 'enqueued' ) ) {
		wp_dequeue_script( 'wc-password-strength-meter' );
	}
}
add_action( 'wp_print_scripts', '\WPX\Actions\remove_password_strength', 100 );

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