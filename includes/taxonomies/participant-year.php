<?php
/**
 * Participant Year
 *
 * @package WordPress
 * @subpackage WPX_Theme
 * @since 0.1.0
 * @version 1.0
*/
$args = array(
	'label' => 'Participant Year',
	'labels' => array(
		'name'=> 'Participant Year',
		'singular_name'=>'Participant Year',
		'menu_name'=>'Participant Years',
		'all_items'=>'All Participant Years',
		'edit_item'=>'Edit Participant Year',
		'view_item'=>'View Participant Year',
		'update_item'=>'Update Participant Year',
		'add_new_item'=>'Add Participant Year',
		'new_item_name'=>'New Participant Year',
		'search_items'=>'Search Participant Years',
		'popular_items'=>'Popular Participant Years',
		'separate_items_with_commas'=>'Separate Participant Years with commas',
		'add_or_remove_items'=>'Add or remove Participant Years',
		'choose_from_most_used'=>'Choose from the most used Participant Years',
		'not_found'=>'No Participant Years found.'
	),
	'public'=>true,
	'show_ui'=>true,
	'show_in_nav_menus'=>false,
	'show_tagcloud'=>false,
	'show_admin_column'=>true,
	'hierarchical'=>true
);
register_taxonomy( 'participant-year', array('participant'), $args );

?>