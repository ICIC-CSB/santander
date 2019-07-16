<?php
/**
 * Header
 *
 * @package WordPress
 * @subpackage WPX_Theme
 * @since 0.1.0
 * @version 1.0
 */
global $Custom;

// server side mobile & browser detection
include_once( 'includes/Mobile_Detect.php' );
$Custom->device = new Mobile_Detect;

// isMobile() includes tablets, so we'll make our own property
$Custom->device->is_phone = $Custom->device->isMobile();
if ( $Custom->device->isTablet() ) {
	$Custom->device->is_phone = false;
}

// browser detection - the ones we care about get assigned to <html>'s class
$html_class = 'desktop';

// older IE
$Custom->device->is_ie = (bool) preg_match( '@MSIE (\d{1,2})\.\d+?@', $Custom->device->getUserAgent(), $ie );

// newer IE - 10+
if ( ! $Custom->device->is_ie ) {
	$Custom->device->is_ie = (bool) preg_match( '@Trident.+rv:(\d+)\.\d+@', $Custom->device->getUserAgent(), $ie );
}

if ( $Custom->device->is_ie ) {
	$Custom->device->is_ie = 'IE' . $ie[1];
	
	$html_class .= ' ' . $Custom->device->is_ie;
}

// iOS
$Custom->device->is_ios = (bool) preg_match( '@ipad|iphone@i', $Custom->device->getUserAgent() );
if ( $Custom->device->is_ios ) {
	$html_class = 'iOS';
}

// android
$Custom->device->is_android = (bool) preg_match( '@Android@i', $Custom->device->getUserAgent() );
if ( $Custom->device->is_android ) {
	$html_class = 'Android';
}

$Custom->device->is_safari = ( stripos( $Custom->device->getUserAgent(), 'Safari' ) !== false ) && ( stripos( $Custom->device->getUserAgent(), 'Chrome' ) === false ) && ( stripos( $Custom->device->getUserAgent(), 'Windows' ) === false );
if ( $Custom->device->is_safari ) {
	$html_class .= ' Safari';
}

// webkit
$Custom->device->is_webkit = (bool) preg_match( '@WebKit@', $Custom->device->getUserAgent() );

$html_class = ' class="' . $html_class . '"';


?><!DOCTYPE HTML>
<html class="<?= $html_class ?>">
<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="icon" href="<?php echo WPX_THEME_URL; ?>/favicon.png">
	<!--[if IE]><link rel="shortcut icon" href="<?php echo WPX_THEME_URL; ?>/favicon.ico"><![endif]-->
	<meta name="msapplication-TileColor" content="#ec0000">
	<meta name="msapplication-TileImage" content="<?php echo WPX_THEME_URL; ?>/tileicon.png">
	<link rel="apple-touch-icon" href="<?php echo WPX_THEME_URL; ?>/apple-touch-icon.png">
	
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800" rel="stylesheet">
	
	<link rel="stylesheet" type="text/css" media="all" href="<?= WPX_THEME_URL ?>/style.css">
	
	<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>
	<header>
		<div class="container">
			<a href="#mobile-menu">Menu</a>
			<h3><a href="/">Cultivate Small Business</a></h3>
			
			<nav>
				<a href="#close">&#10005;</a>
				<ul id="menu-primary-navigation" class="main nav-primary">
					<?php wp_nav_menu( array('menu' => 'Primary Navigation', 'container' => '', 'items_wrap' => '%3$s', 'menu_class' => 'main nav-primary' ) ); ?>
					<?php include_once(WPX_THEME_PATH.'/partials/mini-login.php'); ?>
				</ul>
			</nav>
			
			<a href="/" class="logo"><img src="<?= WPX_THEME_URL ?>/assets/images/Santander-Logo.svg" alt="Santander Logo"></a>
		</div>
	</header>