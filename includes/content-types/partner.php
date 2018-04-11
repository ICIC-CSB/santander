<?php
/**
 * CPT: Submissions
 *
 * @package WordPress
 * @subpackage WPX_Theme
 * @since 0.1.0
 * @version 1.0
*/
$args = array(
	'label' => 'Partners',
	'labels' => array(
		'name'=> 'Partners',
		'singular_name'=>'Partner',
		'menu_name'=>'Partners',
		'name_admin_bar'=>'Partners',
		'all_items'=>'Partners',
		'add_new'=>'Add New',
		'add_name_item'=>'Add New Partner',
		'edit_item'=>'Edit Partner',
		'new_item'=>'New Partner',
		'view_item'=>'View Partner',
		'search_items'=>'Search Partners',
		'not_found'=>'No Partners found',
		'not_found_in_trash'=>'No Partners found in Trash.'
	),
	'public'=>false,
	'rewrite'=>false,
	'exclude_from_search'=>true,
	'show_ui'=>true,
	'show_in_nav_menus'=>false,
	'show_in_menu'=>true,
	'show_in_admin_bar'=>false,
	'menu_icon'=>'dashicons-excerpt-view',
	'supports'=>array(
		'title',
		'editor',
		'thumbnail',
		'revisions'
	)
);

register_post_type( 'partner', $args );

?>