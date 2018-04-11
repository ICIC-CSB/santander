<?php
/*
If you would like to edit this file, copy it to your current theme's directory and edit it there.
Theme My Login will always look in your theme's directory first, before using this default template.
*/
?>
<div class="tml tml-profile" id="theme-my-login<?php $template->the_instance(); ?>">
	
	<form id="your-profile" action="<?php $template->the_action_url( 'profile', 'login_post' ); ?>" method="post">
		<?php wp_nonce_field( 'update-user_' . $current_user->ID ); ?>

		<input type="hidden" name="from" value="profile" />
		<input type="hidden" name="checkuser_id" value="<?php echo $current_user->ID; ?>" />

		<h3>Your Account Information</h3>

		<?php do_action( 'profile_personal_options', $profileuser ); ?>
		<?php $template->the_action_template_message( 'profile' ); ?>
		<?php $template->the_errors(); ?>

		<div class="profile-data-block">
			
			<div class="profile-data-preview">

				<div class="profile-data-info">
					<p><strong>Email:</strong></p>
					<p><?php echo esc_attr( $profileuser->user_email ); ?></p>
				</div>

				<div class="profile-data-info">
					<p><a class="button" id="expose-profile-email" href="#">Edit</a></p>
				</div>

			</div>

			<div class="profile-data-edit">

				<label for="email"><?php _e( 'Enter new email:', 'theme-my-login' ); ?></label>
				<input type="text" name="email" id="email" value="<?php echo esc_attr( $profileuser->user_email ); ?>" class="regular-text" />

				<?php $new_email = get_option( $current_user->ID . '_new_email' ); ?>
				
				<?php if ( $new_email && $new_email['newemail'] != $current_user->user_email ) : ?>
					<div class="updated inline">
						<p>
							<?php
							printf(
								__( 'There is a pending change of your e-mail to %1$s. <a href="%2$s">Cancel</a>', 'theme-my-login' ),
								'<code>' . $new_email['newemail'] . '</code>',
								esc_url( self_admin_url( 'profile.php?dismiss=' . $current_user->ID . '_new_email' ) )
						); ?>
						</p>
					</div>
				<?php endif; ?>

			</div>

		</div>

		<?php $show_password_fields = apply_filters( 'show_password_fields', true, $profileuser ); ?>
		<?php if ( $show_password_fields ) : ?>

		<div class="profile-data-block">

			<div class="profile-data-preview">

				<div class="profile-data-info">
					<p><strong>Password:</strong></p>
					<p>**********</p>
				</div>

				<div class="profile-data-info">
					<p><a class="button" id="expose-profile-password" href="#">Edit</a></p>
				</div>

			</div>

			<div class="profile-data-edit">

				<div class="input-wrap">
					<label for="pass1"><?php _e( 'Enter new password:', 'theme-my-login' ); ?></label>
					<input type="password" name="pass1" class="regular-text" value="" autocomplete="off" data-pw="<?php echo esc_attr( wp_generate_password( 24 ) ); ?>" aria-describedby="pass-strength-result" />
				</div>
			
				<div class="input-wrap">
					<label for="pass2"><?php _e( 'Confirm new password:', 'theme-my-login' ); ?></label>
					<input name="pass2" type="password" class="regular-text" value="" autocomplete="off" />
				</div>

			</div>

		</div>

		<?php endif; ?>

		<div class="profile-data-block two-factor-authentication">
			<div class="two-factor-authentication-wrap">
				<h3>Two-Factor Authentication</h3>
				<p>If you're like to increase the security of your account, enable Two-Factor Authentication below.</p>
				<div class="two-factor-notice">
					<h6>How do I install Two-Factor Authentication?</h6>
					<p><strong>1)</strong> Install the Google Authenticator app on your phone:</p>
					<ul>
						<li>Google Authenticator for <a target="_blank" href="https://itunes.apple.com/us/app/google-authenticator/id388497605?mt=8">iPhone</a></li>
						<li>Google Authenticator for <a target="_blank" href="https://play.google.com/store/apps/details?id=com.google.android.apps.authenticator2&hl=en">Android</a>.</li>
					</ul>
					<p><strong>2)</strong> Scan the QR Code below with the app.</p>
				</div>
				<?php echo do_shortcode('[twofactor_user_settings]'); ?>
			</div>
		</div>

		<p class="tml-submit-wrap">
			<input type="hidden" name="nickname" id="nickname" value="<?php echo esc_attr( $profileuser->nickname ); ?>" class="regular-text" />
			<input type="hidden" name="action" value="profile" />
			<input type="hidden" name="instance" value="<?php $template->the_instance(); ?>" />
			<input type="hidden" name="user_id" id="user_id" value="<?php echo esc_attr( $current_user->ID ); ?>" />
			<input type="submit" class="button-primary" value="<?php esc_attr_e( 'Update', 'theme-my-login' ); ?>" name="submit" id="submit" />
		</p>

	</form>

</div>
