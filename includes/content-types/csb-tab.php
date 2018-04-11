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
	'label' => 'Tabs',
	'labels' => array(
		'name'=> 'Tabs',
		'singular_name'=>'Tab',
		'menu_name'=>'Tabs',
		'name_admin_bar'=>'Tabs',
		'all_items'=>'Tabs',
		'add_new'=>'Add New Tab',
		'add_name_item'=>'Add New Tab',
		'edit_item'=>'Edit Tab',
		'new_item'=>'New Tab',
		'view_item'=>'View Tab',
		'search_items'=>'Search Tabs',
		'not_found'=>'No Tabs found',
		'not_found_in_trash'=>'No Tabs found in Trash.'
	),
	'public'=>true,
	'exclude_from_search'=>false,
	'show_ui'=>true,
	'has_archive'=>true,
	'hierarchical'=>true,
	'show_in_nav_menus'=>true,
	'show_in_menu'=>true,
	'show_in_admin_bar'=>true,
	'menu_position'=>28.08,
	'menu_icon'=>'dashicons-welcome-widgets-menus',
	'supports'=>array(
		'title',
		'editor',
		'thumbnail',
		'revisions'
	),
	'taxonomies'=>array('csb-tab')
);

register_post_type( 'csb-tab', $args );

?>