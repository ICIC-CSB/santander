<?php
/**
 * Setup
 *
 * @package WordPress
 * @subpackage WPX_Theme
 * @since 0.1.0
 * @version 1.0
 */
 
// storage of arbitrary data; also compatibility with some SP code
$Custom = new stdClass();

/**
* Constants
*/
define( 'WPX_THEME_URL', get_bloginfo('template_url') );
define( 'WPX_THEME_PATH', dirname( __FILE__ ) . '/' );
define( 'WPX_DOMAIN', get_site_url() );
define( 'WPX_SITE_NAME', get_bloginfo('name'));
define( 'WPX_GA_ID', false);

/**
 * Functions
*/
require_once(WPX_THEME_PATH."includes/actions.php");
require_once(WPX_THEME_PATH."includes/filters.php");
require_once(WPX_THEME_PATH."includes/sidebars.php");
require_once(WPX_THEME_PATH."includes/enqueue.php");
require_once(WPX_THEME_PATH."includes/rewrites.php");
require_once(WPX_THEME_PATH."includes/utility.php");

/**
 * Widgets
*/
require_once(WPX_THEME_PATH."includes/widgets/categories.php");

// remove admin bar for non-admins
if ( ! current_user_can( 'manage_options' ) ) {
    show_admin_bar( false );
}

/**
 * CPTs & Taxonomies
 */
function wpx_architecture() {

	add_action( 'santander_reminder_email', 'reminder_email' );

	// include taxonomies
	require_once(WPX_THEME_PATH."includes/taxonomies/participant-year.php");
	require_once(WPX_THEME_PATH."includes/taxonomies/tab-group.php");

	// include cpts
	require_once(WPX_THEME_PATH."includes/content-types/participant.php");
	require_once(WPX_THEME_PATH."includes/content-types/partner.php");
	require_once(WPX_THEME_PATH."includes/content-types/csb-tab.php");

	// header/footer settings
	
	if( function_exists('acf_add_options_page') ) {
		
		// add parent
		$parent = acf_add_options_page(array(
			'page_title' 	=> 'Theme Settings',
			'menu_title' 	=> 'Options',
			'redirect' 		=> false,
			'icon_url' => 'dashicons-analytics',
			'position' => 78
		));

		// add sub page
		acf_add_options_sub_page(array(
			'page_title' 	=> 'Application Form Settings',
			'menu_title' 	=> 'Application',
			'parent_slug' 	=> $parent['menu_slug'],
		));

	}


}
add_action( 'init', 'wpx_architecture', 5);

/**
 * Theme Setup
 */
function wpx_setup() {

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support('post-thumbnails', array('post','page','partner','participant','csb-tab') );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	// enable excerpt meta box for Pages
	add_post_type_support('page', 'excerpt');

	// hide version #
	remove_action('wp_head', 'wp_generator');

	// nav menus
	register_nav_menus( array(
		'primary' => 'Primary Navigation',
		'footer' => 'Footer Navigation'
	) );

	/*
	 * Enable support for Post Formats.
	 *
	 * See: https://codex.wordpress.org/Post_Formats
	 */
	//add_theme_support( 'post-formats', array('image', 'video', 'link', 'gallery','audio') );

	// image crops
	//set_post_thumbnail_size( 640, 480, true );
	add_image_size( 'home-tabs-photo', 405, 320, true );
	
	
	add_editor_style('style.css');
	

}
add_action( 'after_setup_theme', 'wpx_setup', 0 );

/**
* Pre Get Posts
*/
function wpx_pre_get_posts( $wp_query ) {
	if ( $wp_query->is_feed() ) {
		$wp_query->set( 'post_type', array( 'post', 'page') );
	} elseif ( isset( $wp_query->query_vars['participant-year'] ) ) {
		$wp_query->set( 'posts_per_page', -1 );
	}
	
	return $wp_query;
}
add_action( 'pre_get_posts', 'wpx_pre_get_posts' );

/**
 * Assets Path
 */
function assets_url() {
	return WPX_THEME_URL.'/assets';
}


// get colors from .scss; or, hard-code them here
function wpx_get_theme_colors() {
	$return_array = array();
	
	if ( file_exists( WPX_THEME_PATH . '/scss/_variables.scss' ) ) {
		$colors = file_get_contents( WPX_THEME_PATH . '/scss/_variables.scss' );
		
		// get the $colors map
		preg_match( '@\$colors[^;]+;@mis', $colors, $colors );
		
		// now get each entry
		preg_match_all( '@[\'"]([^\'"]+)[\'"][^,]+?\:([^,]+)?,?\r?\n@', $colors[0], $colors );
		
		for( $i=0; $i < count( $colors[0] ); $i++ ) {
			$return_array[ trim( $colors[1][$i] ) ] = trim( $colors[2][$i] );
		}
	}
	
	return $return_array;
}


// pagination
function wpx_archive_pagination() {
	global $wp_query;

	$big = 999999999; // need an unlikely integer

	return paginate_links( array(
		'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
		'format' => '?paged=%#%',
		'current' => max( 1, get_query_var('paged') ),
		'total' => $wp_query->max_num_pages,
		'prev_text' => 'Previous',
		'next_text' => 'Next'
	) );
}


// utility function to set defaults and pull vals out of array
function wpx_load_meta( $id = false ) {
	if ( (int) $id < 1 ) {
		return false;
	}
	
	$meta = get_post_custom( $id );
	
	foreach ( $meta as $key => & $val ) {
		$val = $val[0];
		if ( $val == 'true' or $val == 'yes' or $val == '1' or $val === 1 ) {
			$val = true;
		} elseif ( $val == 'false' or $val == 'no' or $val == '0' or $val === 0 ) {
			$val = false;
		}
	}
	unset( $val );
	
	return $meta;
}

/**
 * Creates 5-min cron reminder
 */
function fiveminute_cron($schedules){
	if(!isset($schedules["fivemins"])){
		$schedules["fivemins"] = array(
			'interval' => 5*60,
			'display' => __('Once every 5 minutes'));
	}
	return $schedules;
}
add_filter('cron_schedules','fiveminute_cron');

/**
 * Sends Reminder Email
 *
 * This occurs once a day. It loops through all the submissions
 * finds ones that are not completed, and sends them reminder emails.
 */
function reminder_email() {

	\WPX\Custom\write_log('Executing reminder email.');

	// loop thru all subscribers
	$args = array( 'role' => 'Subscriber');
	$user_query = new \WP_User_Query($args);

	// if we have subscribers
	if ( ! empty( $user_query->get_results() ) ) :

		// for each subscriber
		foreach ( $user_query->get_results() as $user ) :

			// loop thru all completed submissions to see if we 
			// can find one that matches this user
			$has_submission = new \WP_Query(array(
				'posts_per_page' => -1,
				'post_type' => 'nf_sub',
				'no_found_rows'=> true,
				'meta_query' => array(
					array(
						'key'     => '_field_83', // the hidden user ID field
						'value'   => $user->ID,
						'compare' => 'IN',
					),
				))
			);

			// is this user verified or not?
			$verified = get_user_meta($user->ID, 'ur_confirm_email', true);  

			// we found a complete submissionor the user_is_locked field is active or the user is still pending registration
			if ($has_submission->have_posts() || get_user_meta($user->ID, 'user_is_locked', true) || $verified !== '1') :

				// this user does not need a reminder
				\WPX\Custom\write_log('user '.$user->user_email.' is locked or we found a submission');

			else :

				// we send an email to the subscriber
				// (there should not be users without applications)
				// (so technically if this email is going out to detached subscribers)
				// (then the subscriber needs to be deleted)

				\WPX\Custom\write_log('user '.$user->user_email.', who is not locked and has no submission, sent email');

				$copy_subject = get_field('reminder_subject_line','options');
				$copy_body = get_field('reminder_body_copy','options');
				$copy_from = get_field('reminder_from_line','options');

				$to = $user->user_email;
				$subject = $copy_subject;
				$body = $copy_body;
				$headers[] = $copy_from;
				$result = wp_mail( $to, $subject, $body, $headers);

			endif;

		endforeach;

	endif;

	wp_reset_postdata();

}