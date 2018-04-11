<?php
/**
 * Participant
 *
 * @package WordPress
 * @subpackage WPX_Theme
 * @since 0.1.0
 * @version 1.0
*/
$args = array(
	'label' => 'Participants',
	'labels' => array(
		'name'=> 'Participants',
		'singular_name'=>'Participant',
		'menu_name'=>'Participants',
		'name_admin_bar'=>'Participants',
		'all_items'=>'Participants',
		'add_new'=>'Add New',
		'add_name_item'=>'Add New Participant',
		'edit_item'=>'Edit Participant',
		'new_item'=>'New Participant',
		'view_item'=>'View Participant',
		'search_items'=>'Search Participants',
		'not_found'=>'No Participants found',
		'not_found_in_trash'=>'No Participants found in Trash.'
	),
	'public'=>true,
	'exclude_from_search'=>false,
	'show_ui'=>true,
	'has_archive'=>false,
	'hierarchical'=>false,
	'show_in_nav_menus'=>true,
	'show_in_menu'=>true,
	'show_in_admin_bar'=>true,
	'menu_position'=>28.08,
	'menu_icon'=>'dashicons-id',
	'supports'=>array(
		'title',
		'editor',
		'thumbnail',
		'revisions'
	),
	'taxonomies'=>array('participant-year')
);

register_post_type( 'participant', $args );

?>