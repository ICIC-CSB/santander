<?php
/**
 * Front End Assets
 *
 * @package WordPress
 * @subpackage WPX_Theme
 * @since 0.1.0
 * @version 1.0
 */
namespace WPX\Enqueue;

/**
* Main Asset Queue
*/
function enqueue_assets() {

	if (WP_DEBUG == true) {

		wp_enqueue_style( 'wpx.styles.src', assets_url().'/styles/screen.css', false, false);
		wp_enqueue_script('poulin.scripts', WPX_THEME_URL . '/assets/js/scripts.js', array('jquery'), false, false);

	} else {

		wp_enqueue_style( 'wpx.styles.min', assets_url().'/styles/screen.min.css', false, false);
		wp_enqueue_script( 'wpx.script.min', assets_url().'/js/app.min.js', false, null, true);
		wp_enqueue_script('poulin.scripts', WPX_THEME_URL . '/assets/js/scripts.js', array('jquery'), false, false);

	}

	if (is_page('account')) {
		wp_enqueue_script('wpx.authenticator', '/wp-content/plugins/google-authenticator/jquery.qrcode.min.js', array('jquery'), false, false);
	}

}
add_action( 'wp_enqueue_scripts', '\WPX\Enqueue\enqueue_assets' );

/**
* Google Analytics
*/
function enqueue_ga() {
	if (WPX_GA_ID) :
?>
<script>
	(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

	ga('create', '<?php echo WPX_GA_ID; ?>', 'auto');
	ga('require', 'displayfeatures');
	ga('send', 'pageview');
</script>
<?php 
	endif;
}
add_action('wp_head', '\WPX\Enqueue\enqueue_ga');