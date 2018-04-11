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
				
				<?php 
					$args = array(
						'redirect' => admin_url(), 
						'form_id' => 'loginform-mini',
						'label_username' => __( 'Email:' ),
						'label_password' => __( 'Password' ),
						'id_username'    => 'user_login_mini',
						'id_password'    => 'user_pass_mini',
						'id_submit'      => 'wp-submit_mini',
						'label_log_in'   => 'Resume Application',
						'remember' => false
					);
				?>
					
				<?php wp_login_form( $args ); ?>

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