<?php
/**
 * Login Form in Header
 *
 * @package WordPress
 * @subpackage WPX_Theme
 * @since 0.1.0
 * @version 1.0
 */
?>
<li class="featured menu-item menu-item-type-post_type menu-item-object-page"><?php if ( ! is_user_logged_in() ) : ?><a href="<?php bloginfo('url'); ?>/login/">Log in</a><?php else :  ?><a href="<?php bloginfo('url'); ?>/account/">Account</a><?php endif; ?>

	<div class="login-mini-wrap">

		<a class="close-login-mini-wrap" href="#"><i class="icon-cancel"></i></a>

		<div class="login-mini-wrap-inner">

			<?php if ( ! is_user_logged_in() ) { ?>
				
				<form name="loginform-mini" id="loginform-mini" action="<?php echo esc_url( site_url( 'wp-login.php', 'login_post' ) ); ?>" method="post" class="validate">
					
					<p class="login-username">
						<label for="user_login_mini">Email:</label>
						<input type="text" name="log" id="user_login_mini" class="input required email valid" value="" size="20" autocomplete="off" aria-invalid="false">
					</p>

					<p class="login-password">
						<label for="user_pass_mini">Password</label>
						<input type="password" name="pwd" id="user_pass_mini" class="input required" value="" size="20" autocomplete="off">
					</p>

					<p>
						<label for="googleotp">Two-Factor Authentication</label>
						<input type="text" name="googleotp" id="googleotp" class="input" value="" size="20" autocomplete="off" />
						<em>If you don't have one, leave empty.</em>
					</p>

					<div class="g-recaptcha" style="margin-bottom: 20px;" data-sitekey="6LfendESAAAAAN1stiEC5LgfvCWi-Otl2T1KdddW"></div>

					<p class="login-submit">
						<input type="submit" name="wp-submit" id="wp-submit_mini" class="button button-primary" value="Resume Application">
						<input type="hidden" name="redirect_to" value="<?php echo esc_attr(get_bloginfo('url').'/application/'); ?>" />
						<input type="hidden" name="testcookie" value="1" />
					</p>
					
				</form>

				<p><a href="<?php bloginfo('url'); ?>/register/">Create Account</a></p>
				<p><a href="<?php bloginfo('url'); ?>/lostpassword/">Forgot Password?</a></p>

			<?php } else { ?>

				<p><a class="login-link" href="<?php bloginfo('url'); ?>/application/"><i class="icon-right-open"></i>Go to application</a></p>
				<p><a class="login-link" href="<?php bloginfo('url'); ?>/account/"><i class="icon-right-open"></i>Edit account info</a></p>
				<p><a class="login-link" href="<?php echo wp_logout_url(); ?>"><i class="icon-right-open"></i>Log out</a></p>
			
			<?php } ?>

		</div>

	</div>
</li>