<?php
/**
 * The template for displaying the footer.
 *
 * @package WordPress
 * @subpackage WPX_Theme
 * @since 0.1.0
 * @version 1.0
 */
?>

	<section class="pre-footer bg-red">
		<div class="container">
			<nav>
				<?php wp_nav_menu( array('menu' => 'Primary Navigation', 'container' => 'ul', 'menu_class' => 'main' ) ); ?>
			</nav>
		</div>
	</section>
	
	<footer>
		<div class="container">
			<p>&copy; <?= date('Y') ?> Santander Bank, N. A. Equal Housing Lender - Member FDIC</p>
			<nav>
				<?php wp_nav_menu( array('menu' => 'Footer Navigation', 'container' => 'ul' ) ); ?>
			</nav>
		</div>
	</footer>

	<?php wp_footer(); ?>

	<?php if (WP_DEBUG == true) : ?>
		<!-- bower:js -->
		<script src="<?php bloginfo("url") ?>/wp-content/themes/wpx/assets/js/bower/jquery-placeholder/jquery.placeholder.js"></script>
		<script src="<?php bloginfo("url") ?>/wp-content/themes/wpx/assets/js/bower/jquery-validation/dist/jquery.validate.js"></script>
		<script src="<?php bloginfo("url") ?>/wp-content/themes/wpx/assets/js/bower/jquery.fitvids/jquery.fitvids.js"></script>
		<script src="<?php bloginfo("url") ?>/wp-content/themes/wpx/assets/js/bower/enquire/dist/enquire.js"></script>
		<script src="<?php bloginfo("url") ?>/wp-content/themes/wpx/assets/js/bower/slick-carousel/slick/slick.js"></script>
		<script src="<?php bloginfo("url") ?>/wp-content/themes/wpx/assets/js/bower/dense/src/dense.js"></script>
		<!-- endbower -->
		<!-- inject:vendor:js -->
		<script src="<?php echo assets_url(); ?>/js/vendor/jquery.imagesloaded.js"></script>
		<script src="<?php echo assets_url(); ?>/js/vendor/jquery.matchheight.js"></script>
		<!-- endinject -->
		<!-- inject:init:js -->
		<script src="<?php echo assets_url(); ?>/js/app.init.js"></script>
		<!-- endinject -->
		<!-- inject:modules:js -->
		<script src="<?php echo assets_url(); ?>/js/modules/layout.js"></script>
		<script src="<?php echo assets_url(); ?>/js/modules/utility.js"></script>
		<!-- endinject -->
	<?php endif; ?>

</body>