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
				<?php wp_nav_menu( array('theme_location' => 'primary', 'container' => 'ul', 'menu_class' => 'main' ) ); ?>
			</nav>
		</div>
	</section>
	
	<footer>
		<div class="container">
			<p>&copy; <?php date('Y'); ?> Santander Bank, N. A. Equal Housing Lender - Member FDIC</p>
			<nav>
				<?php wp_nav_menu( array('theme_location' => 'footer', 'container' => 'ul' ) ); ?>
			</nav>
		</div>
	</footer>

	<?php wp_footer(); ?>

	<?php if (WP_DEBUG == true) : ?>
		<!-- inject:yarn:js -->
		<script src="<?php echo assets_url(); ?>/js/libraries.js"></script>
		<!-- endinject -->
		<!-- inject:vendor:js -->
		<script src="<?php echo assets_url(); ?>/js/vendor/enquire.js"></script>
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