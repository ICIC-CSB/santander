<?php
/**
 * Filters
 *
 * @package WordPress
 * @subpackage WPX_Theme
 * @since 0.1.0
 * @version 1.0
 */
namespace WPX\Filters;

/**
 * Add Post State
 */
function add_post_state( $post_states, $post ) {

	if( $post->post_name == 'edit-profile' ) {
		$post_states[] = 'Edit Profile';
	}

	return $post_states;
}

add_filter( 'display_post_states', '\WPX\Filters\add_post_state', 10, 2 );

/**
 * Redirect to Application After Successful Login.
 *
 * @param string $redirect_to URL to redirect to.
 * @param string $request URL the user is coming from.
 * @param object $user Logged user's data.
 * @return string
 */
function my_login_redirect( $redirect_to, $request, $user ) {
	//is there a user to check?
	if (isset($user->roles) && is_array($user->roles)) {
		//check for subscribers
		if (in_array('subscriber', $user->roles)) {
			// redirect them to another URL, in this case, the homepage 
			$redirect_to = get_bloginfo().'/application/';
		}
	}

	return $redirect_to;
}

add_filter( 'login_redirect', 'WPX\Filters\my_login_redirect', 10, 3 );

/**
 * Move Featured Image Metabox
 * (after Publish box)
 */
add_action('add_meta_boxes', function() {
	add_meta_box('submitdiv', __('Publish'), 'post_submit_meta_box', 'post', 'side', 'high');
	add_meta_box('postimagediv', __('Featured Image'), 'post_thumbnail_meta_box', 'post', 'side', 'high');
});

/**
 * Featured Image Instructions
 * @param [type] $content [description]
 */
function add_featured_image_instruction( $content, $id ) {
	if ( get_post_type( $id ) == 'page' ) {
		$content .= "<h3>Choose your hero image here.</h3><p class='description'><b>Landing page:</b> The Featured Image should be at least 1800x1100 pixels.</p><p class='description'><b>Other pages:</b> The Featured Image should be at least 1800x775 pixels.</p>";
	} elseif ( get_post_type( $id ) == 'participant' ) {
		$content .= "<h3>Choose the participant's photo here.</h3><p class='description'>The photo should be square, 400 pixels minimum.</p>";
	} elseif ( get_post_type( $id ) == 'partner' ) {
		$content .= "<h3>Choose the partner's logo here.</h3><p class='description'>The logo should be about 450 pixels wide.</p>";
	} elseif ( get_post_type( $id ) == 'csb-tab' ) {
		$content .= "<h3>Choose the tab icon here.</h3><p class='description'>The icon should be red, and measure 360x260 pixels.</p>";
	}
		
	return $content;
}
add_filter( 'admin_post_thumbnail_html', '\WPX\Filters\add_featured_image_instruction', 10, 2);

/**
 * Change text for the post excerpt
 *
 * @since 1.0.0
 * @param string $translated_text
 * @param string $text
 * @param string $domain
 * @return string 
 */
function change_excerpt_name( $translation, $original ) {
	if ( 'Excerpt' == $original ) {
		return 'Excerpt';
	} else {
		$pos = strpos($original, 'Excerpts are optional hand-crafted summaries of your content that can be');
		if ($pos !== false) {
			return  'This text is used as a teaser of the post\'s content in any archive. Try to keep it to a single sentence. It\'s also used as the meta description for the post. If you need the meta description to be different than the teaser, use the Yoast SEO panel below to specify a unique meta description.';
		}
	}
	return $translation;
}
add_filter( 'gettext', '\WPX\Filters\change_excerpt_name', 10, 2 );

/**
 * Remove Yoast SEO Columns
 */
function remove_seo_columns( $columns ) {
	// remove the Yoast SEO columns
	unset( $columns['wpseo-score'] );
	unset( $columns['wpseo-title'] );
	unset( $columns['wpseo-metadesc'] );
	unset( $columns['wpseo-focuskw'] );
	return $columns;
}
add_filter ( 'manage_edit-post_columns', '\WPX\Filters\remove_seo_columns' );

/**
 * Stop WP from Rearranging Terms
 *
 * WP by default puts the selected term in the term metabox on top after
 * the post is saved. This prevents WP from doing that.
 * 
 */
function stop_reordering_my_categories($args) {
	$args['checked_ontop'] = false;
	return $args;
}

add_filter('wp_terms_checklist_args','\WPX\Filters\stop_reordering_my_categories');

/**
 * Add Body Classes
 */
function add_body_classes($classes) {

	global $post;

	// allows slug-based classes
	if ($post) {
		$classes[] = 'slug'.'-'.$post->post_name;
	}

	return $classes;

}
add_filter('body_class', '\WPX\Filters\add_body_classes');

/**
 * Force Yoast to bottom
 */
function yoasttobottom() {
	return 'low';
}
add_filter( 'wpseo_metabox_prio', '\WPX\Filters\yoasttobottom');

/**
 * Custom Images Sizes to Menus
 */
add_filter( 'image_size_names_choose', function ( $sizes ) {
  global $_wp_additional_image_sizes;
  if ( empty($_wp_additional_image_sizes) ) {
	return $sizes;
  }

  foreach ( $_wp_additional_image_sizes as $id => $data ) {
	if ( !isset($sizes[$id]) )
	  $sizes[$id] = ucfirst( str_replace( '-', ' ', $id ) );
  }

  return $sizes;
} );


/**
 * Scott/Shortcodes
 */
add_filter('mce_buttons_2', function ( $buttons ) {
	$but1 = array_slice( $buttons, 0, 1 );
	$but2 = array_slice( $buttons, 1 );
	$buttons = array_merge( $but1, array('styleselect'), $but2 );
	return $buttons;
} );

add_filter('mce_buttons', function ( $buttons ) {
	$but1 = array_slice( $buttons, 0, 2 );
	$but2 = array_slice( $buttons, 2 );
	$buttons = array_merge( $but1, array('superscript', 'subscript'), $but2 );
	return $buttons;
} );

add_filter( 'tiny_mce_before_init', function ( $init_array ) {
	// Define the style_formats array
	$style_formats = array(  
		// Each array child is a format with it's own settings
		array(  
			'title' => 'Align Left',  
			'block' => 'p',  
			'classes' => 'text-left',
			'wrapper' => false
		),
		array(  
			'title' => 'Align Center',  
			'block' => 'p',  
			'classes' => 'text-center',
			'wrapper' => false
		),
		array(  
			'title' => 'Align Right',  
			'block' => 'p',  
			'classes' => 'text-right',
			'wrapper' => false
		),
		array(  
			'title' => 'Align Justify',  
			'block' => 'p',  
			'classes' => 'text-justify',
			'wrapper' => false
		),
		array(  
			'title' => 'Button',  
			'selector' => 'a',
			'classes' => 'button',
			'wrapper' => false
		),
		array(  
			'title' => 'Big',  
			'inline' => 'span',
			'classes' => 'big',
			'wrapper' => false
		),
		array(  
			'title' => 'Small',  
			'inline' => 'span',
			'classes' => 'small',
			'wrapper' => false
		),
		array(  
			'title' => 'Smaller',  
			'inline' => 'span',
			'classes' => 'smaller',
			'wrapper' => false
		)
	);
	
	// colors
	foreach( wpx_get_theme_colors() as $color => $val ) {
		$style_formats[] = array(  
			'title' => 'Text ' . ucwords( str_replace( '-', ' ', $color ) ),  
			'inline' => 'span',
			'classes' => 'text-' . $color,
			'wrapper' => false
		);
	}
	
	// weights
	$colors = array( 400, 600, 700 );
	foreach( $colors as $color ) {
		$style_formats[] = array(  
			'title' => 'Text Weight ' . $color,  
			'inline' => 'span',
			'classes' => 'text-weight-' . $color,
			'wrapper' => false
		);
	}
	
	// Insert the array, JSON ENCODED, into 'style_formats'
	$init_array['style_formats'] = json_encode( $style_formats );
	
	
	// fix table editing bug with TinyMCE Advanced
	$init_array['object_resizing'] = ":not(*)";
	
	return $init_array;  
  
} );


/**
 * Add Post Thumbnail to Admin Cols
 */
add_filter('manage_posts_columns', function ($defaults){
	$defaults['riv_post_thumbs'] = __('Thumbs');
	return $defaults;
}, 5);

add_action('manage_posts_custom_column', function ($column_name, $id){
	if($column_name === 'riv_post_thumbs'){
		echo the_post_thumbnail( array(75, 75) );
	}
}, 5, 2);