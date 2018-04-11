<?php
/**
 * Tab Group
 *
 * @package WordPress
 * @subpackage WPX_Theme
 * @since 0.1.0
 * @version 1.0
*/
$args = array(
	'label' => 'Tab Group',
	'labels' => array(
		'name'=> 'Tab Group',
		'singular_name'=>'Tab Group',
		'menu_name'=>'Tab Groups',
		'all_items'=>'All Tab Groups',
		'edit_item'=>'Edit Tab Group',
		'view_item'=>'View Tab Group',
		'update_item'=>'Update Tab Group',
		'add_new_item'=>'Add Tab Group',
		'new_item_name'=>'New Tab Group',
		'search_items'=>'Search Tab Groups',
		'popular_items'=>'Popular Tab Groups',
		'separate_items_with_commas'=>'Separate Tab Groups with commas',
		'add_or_remove_items'=>'Add or remove Tab Groups',
		'choose_from_most_used'=>'Choose from the most used Tab Groups',
		'not_found'=>'No Tab Groups found.'
	),
	'public'=>true,
	'show_ui'=>true,
	'show_in_nav_menus'=>false,
	'show_tagcloud'=>false,
	'show_admin_column'=>true,
	'hierarchical'=>true
);
register_taxonomy( 'csb-tab-group', array('csb-tab'), $args );

?>