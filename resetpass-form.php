<?php
/*
If you would like to edit this file, copy it to your current theme's directory and edit it there.
Theme My Login will always look in your theme's directory first, before using this default template.
*/
?>
<div class="login-area">

	<div class="login-content">

		<h2>Create New Password</h2>

		<div class="tinymce larger">
			<?php $template->the_action_template_message( 'resetpass' ); ?>
			<?php $template->the_errors(); ?>
		</div>

		<div data-module="login-wrapper">

			<div class="login-wrapper-form tinymce">

				<div class="tml tml-resetpass" id="theme-my-login<?php $template->the_instance(); ?>">

					<form name="resetpassform" id="resetpassform<?php $template->the_instance(); ?>" action="<?php $template->the_action_url( 'resetpass', 'login_post' ); ?>" method="post" autocomplete="off">

						<p class="field-wrap">
							<label for="pass1"><?php _e( 'Enter new password:', 'theme-my-login' ); ?></label>
							<input type="password" name="pass1" class="input password-input" value="" autocomplete="off" />
						</p>

						<p class="field-wrap">
							<label for="pass2"><?php _e( 'Confirm new password', 'theme-my-login' ); ?></label>
							<input type="password" name="pass2" class="input" size="20" value="" autocomplete="off" />
						</p>

						<?php do_action( 'resetpassword_form' ); ?>

						<p class="tml-submit-wrap">
							<input type="submit" name="wp-submit" id="wp-submit<?php $template->the_instance(); ?>" value="<?php esc_attr_e( 'Confirm', 'theme-my-login' ); ?>" />
							<input type="hidden" id="user_login" value="<?php echo esc_attr( $GLOBALS['rp_login'] ); ?>" autocomplete="off" />
							<input type="hidden" name="rp_key" value="<?php echo esc_attr( $GLOBALS['rp_key'] ); ?>" />
							<input type="hidden" name="instance" value="<?php $template->the_instance(); ?>" />
							<input type="hidden" name="action" value="resetpass" />
						</p>
					</form>
					<?php $template->the_action_links( array(
						'login' => false,
						'register' => false,
						'lostpassword' => false
					) ); ?>
				</div>

			</div>

		</div>

	</div>

</div>