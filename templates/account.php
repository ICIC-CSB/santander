<?php
/**
 * Template Name: Account
 *
 * @package WordPress
 * @subpackage WPX_Theme
 * @since 0.1.0
 * @version 1.0
 */
if (is_user_logged_in()) {

	$current_user = wp_get_current_user();

	wp_register_script('qrcode_script_account', WPX_DOMAIN.'/wp-content/plugins/google-authenticator/jquery.qrcode.min.js', array("jquery"));
	wp_enqueue_script('qrcode_script');

	$GA_secret = trim( get_user_option( 'googleauthenticator_secret', $current_user->ID ) );
	$GA_description	= trim( get_user_option( 'googleauthenticator_description',  $current_user->ID ) );

	// In case the user has no secret ready (new install), we create one. or use the one they just posted
	if ( '' == $GA_secret ) {
		$GA_secret = array_key_exists( 'GA_secret', $_POST ) ? sanitize_text_field( $_POST[ 'GA_secret' ] ) : \WPX\Custom\create_secret();
	}

	if ( '' == $GA_description ) {
		$GA_description = sanitize_text_field( get_bloginfo( 'name' ) );
	}

	if ( $_SERVER['REQUEST_METHOD'] == 'POST' && !empty( $_POST['action'] ) && $_POST['action'] == 'update-user' ) {

		/* Check nonce first to see if this is a legit request */
		if( !isset( $_POST['_wpnonce'] ) || !wp_verify_nonce( $_POST['_wpnonce'], 'update-user' ) ) {
			wp_redirect( get_permalink() . '?validation=unknown' );
			exit;
		}

		/* Check honeypot for autmated requests */
		if( !empty($_POST['honey-name']) ) {
			wp_redirect( get_permalink() . '?validation=unknown' );
			exit;
		}

		if ( !empty( $_POST['email'] ) ){

			$posted_email = esc_attr( $_POST['email'] );

			if ( !is_email( $posted_email ) ) {
				wp_redirect( get_permalink() . '?validation=emailnotvalid' );
				exit;
			} elseif( email_exists( $posted_email ) && ( email_exists( $posted_email ) != $current_user->ID ) ) {
				wp_redirect( get_permalink() . '?validation=emailexists' );
				exit;
			} else{
				wp_update_user( array ('ID' => $current_user->ID, 'user_email' => $posted_email ) );
			}
		}

		if ( !empty($_POST['pass1'] ) || !empty( $_POST['pass2'] ) ) {

			if ( $_POST['pass1'] == $_POST['pass2'] ) {
				wp_update_user( array( 'ID' => $current_user->ID, 'user_pass' => esc_attr( $_POST['pass1'] ) ) );
			}
			else {
				wp_redirect( get_permalink() . '?validation=passwordmismatch' );
				exit;
			}
				
		}

		if ( !empty( $_POST['GA_secret'] ) ) {
			update_user_option( $current_user->ID, 'googleauthenticator_secret', $_POST[ 'GA_secret' ], true );
		}

		 if ( !empty( $_POST['GA_description'] ) ) {
			update_user_option( $current_user->ID, 'googleauthenticator_description', $_POST[ 'GA_description' ], true );
		}

		$GA_enabled	     = ! empty( $_POST['GA_enabled'] );
		$GA_hidefromuser = ! empty( $_POST['GA_hidefromuser'] );

		if ( ! $GA_enabled ) {
			$GA_enabled = 'disabled';
		} else {
			$GA_enabled = 'enabled';
		}

		if ( ! $GA_hidefromuser ) {
			$GA_hidefromuser = 'disabled';
		} else {
			$GA_hidefromuser = 'enabled';
		}

		update_user_option( $current_user->ID, 'googleauthenticator_enabled', $GA_enabled, true );
		update_user_option( $current_user->ID, 'googleauthenticator_hidefromuser', $GA_hidefromuser, true );

		/* Let plugins hook in, like ACF who is handling the profile picture all by itself. Got to love the Elliot */
		do_action('edit_user_profile_update', $current_user->ID);

		/* We got here, assuming everything went OK */
		wp_redirect( get_permalink() . '?updated=true' );
		exit;

	}

	the_post();

	get_header();

	$max_width = get_field('max_content_width', $post->ID);
	if ( ! empty ( $max_width ) ) :
		if ( $max_width < 320 ) :
			$max_width = 320;
		endif;
		if ( $max_width > 1200 ) :
			$max_width = 1200;
		endif;
	endif;

	?>

	<main class="skinless-ui">
		<div class="container">
			<article<?= empty( $max_width ) ? '' : ' style="max-width: ' . $max_width . 'px"' ?>>

				<section id="dashboard-content" class="tml tml-profile">
				
					<div class="wrap">

						<?php $current_user = wp_get_current_user(); ?>

						<form method="post" id="adduser" class="tml-profile" action="<?php the_permalink(); ?>">

							<h3><?php _e('Your Account Information', 'textdomain'); ?></h3>

							<?php if( !empty( $_GET['updated'] ) ): ?>
								<p class="success"><?php _e('Your account was successfully updated.', 'textdomain'); ?></p>
							<?php endif; ?>

							<?php if( !empty( $_GET['validation'] ) ): ?>
								
								<?php if( $_GET['validation'] == 'emailnotvalid' ): ?>
									<p class="error"><?php _e('The given email address is not valid.', 'textdomain'); ?></p>
								<?php elseif( $_GET['validation'] == 'emailexists' ): ?>
									<p class="error"><?php _e('The given email address already exists.', 'textdomain'); ?></p>
								<?php elseif( $_GET['validation'] == 'ganotvalid' ): ?>
									<p class="error"><?php _e('Two-Factor Authentication is missing secret key.', 'textdomain'); ?></p>
								<?php elseif( $_GET['validation'] == 'passwordmismatch' ): ?>
									<p class="error"><?php _e('The given passwords did not match.', 'textdomain'); ?></p>
								<?php elseif( $_GET['validation'] == 'unknown' ): ?>
									<p class="error"><?php _e('An unknown error occurred, please try again or contact the website administrator.', 'textdomain'); ?></p>
								<?php endif; ?>

							<?php endif; ?>

							<div class="profile-data-block">
								
								<div class="profile-data-preview">

									<div class="profile-data-info">
										<p><strong>Email:</strong></p>
										<p><?php the_author_meta( 'user_email', $current_user->ID ); ?></p>
									</div>

									<div class="profile-data-info">
										<p><a class="button" id="expose-profile-email" href="#">Edit</a></p>
									</div>

								</div>

								<div class="profile-data-edit">
									<label for="email"><?php _e('E-mail *', 'textdomain'); ?></label>
									<input class="text-input" name="email" type="text" id="email" value="<?php the_author_meta( 'user_email', $current_user->ID ); ?>" />
								</div>

							</div>

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
										<label for="pass1"><?php _e('Enter New Password:', 'profile'); ?> </label>
										<input class="text-input" name="pass1" type="password" id="pass1" />
									</div>

									<div class="input-wrap">
										<label for="pass2"><?php _e('Confirm new password:', 'profile'); ?></label>
										<input class="text-input" name="pass2" type="password" id="pass2" />
									</div>

								</div>

							</div>

							<div class="profile-data-block two-factor-authentication">

								<div class="two-factor-authentication-wrap">

									<h3>Two-Factor Authentication</h3>

									<p>If you're like to increase the security of your account, enable Two-Factor Authentication below.</p>

									<div class="two-factor-notice">
										<h6>How do I install Two-Factor Authentication?</h6>
										<p><strong>1)</strong> Install the Authy app on your phone and Scan the QR Code below with the app:</p>
										<ul>
											<li>Google Authenticator for <a target="_blank" href="https://itunes.apple.com/us/app/authy/id494168017?mt=8">iPhone</a></li>
											<li>Google Authenticator for <a target="_blank" href="https://play.google.com/store/apps/details?id=com.authy.authy&hl=en_US">Android</a></li>
										</ul>
										<p><strong>2)</strong> Check "Enable two-factor login," and Update your account.</p>
										<p><strong>3)</strong> Next time you log in, enter the authentication code provided by the app in addition to your email and password.</p>
									</div>

									<?php do_action('edit_user_profile', $current_user); ?>

									<input name="GA_secret" id="GA_secret" value="<?php echo $GA_secret; ?>" readonly="readonly" type="text" size="25">

									<input name="GA_description" id="GA_description" value="Cultivate Small Business | Santander" readonly="true" type="text" size="25">

									<div id="GA_QR_INFO"><div id="GA_QRCODE"></div></div>

									<script>
										var qrcode="otpauth://totp/WordPress:"+escape(jQuery('#GA_description').val())+"?secret="+jQuery('#GA_secret').val()+"&issuer=WordPress";
										jQuery('#GA_QRCODE').qrcode(qrcode);
										var GAnonce ='<?php echo wp_create_nonce('GoogleAuthenticatoraction'); ?>';
									</script>

								</div>
							</div>

							<div class="form-submit">
								<input name="updateuser" type="submit" id="updateuser" class="submit button" value="<?php _e('Update', 'textdomain'); ?>" />
								<?php wp_nonce_field( 'update-user' ) ?>
								<input name="honey-name" value="" type="text" style="display:none;"></input>
								<input name="action" type="hidden" id="action" value="update-user" />
							</div>

						</form>

					</div>

			</article>
		</div>
		
		<a href="#to-top">Back to top</a>
	</main>

	<?php get_footer();

} else {

	wp_redirect(get_bloginfo('url').'/login/');

}