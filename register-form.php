<?php
/*
If you would like to edit this file, copy it to your current theme's directory and edit it there.
Theme My Login will always look in your theme's directory first, before using this default template.
*/
?>

<?php $intro_register = get_field('intro_register', 'options'); ?>
<?php $criteria_title = get_field('login_criteria_title', 'options'); ?>
<?php $criteria_desc = get_field('login_criteria_desc', 'options'); ?>
<?php $criteria_url = get_field('login_criteria_link', 'options'); ?>
<?php $criteria_label = get_field('login_criteria_link_label', 'options'); ?>

<div class="login-area">

	<div class="login-content register-form">

		<div data-module="login-wrapper">

			<div class="login-wrapper-nav">
				<a href="<?php echo $template->get_action_url( 'register' ); ?>">Create account</a>
				<a href="<?php echo $template->get_action_url( 'login' ); ?>" class="active">Sign in</a>
			</div>

			<div class="login-wrapper-form tinymce">

				<div class="tml tml-register" id="theme-my-login<?php $template->the_instance(); ?>">
					<?php if ($intro_register) : ?><p class="larger"><?php echo $intro_register; ?></p><?php endif; ?>
					<?php $template->the_action_template_message( 'register' ); ?>
					<?php $template->the_errors(); ?>
					<form name="registerform" id="registerform<?php $template->the_instance(); ?>" class="validate" action="<?php $template->the_action_url( 'register', 'login_post' ); ?>" method="post">
						
						<?php if ( 'email' != $theme_my_login->get_option( 'login_type' ) ) : ?>
							<p class="tml-user-login-wrap">
								<label for="user_login<?php $template->the_instance(); ?>"><?php _e( 'Enter your username:', 'theme-my-login' ); ?></label>
								<input type="text" name="user_login" id="user_login<?php $template->the_instance(); ?>_register" class="input email required" value="<?php $template->the_posted_value( 'user_login' ); ?>" size="20" />
							</p>
						<?php endif; ?>

						<p class="tml-user-email-wrap">
							<label for="user_email<?php $template->the_instance(); ?>"><?php _e( 'Enter your email:', 'theme-my-login' ); ?></label>
							<input type="text" name="user_email" id="user_email<?php $template->the_instance(); ?>_register" class="input required" value="<?php $template->the_posted_value( 'user_email' ); ?>" size="20" />
						</p>

						<?php do_action( 'register_form' ); ?>

						<p class="tml-registration-confirmation" id="reg_passmail<?php $template->the_instance(); ?>_register"><?php echo apply_filters( 'tml_register_passmail_template_message', __( 'Registration confirmation will be e-mailed to you.', 'theme-my-login' ) ); ?></p>

						<p class="tml-submit-wrap">
							<input type="submit" name="wp-submit" id="wp-submit<?php $template->the_instance(); ?>" value="<?php esc_attr_e( 'Start application', 'theme-my-login' ); ?>" />
							<input type="hidden" name="redirect_to" value="<?php $template->the_redirect_url( 'register' ); ?>" />
							<input type="hidden" name="instance" value="<?php $template->the_instance(); ?>" />
							<input type="hidden" name="action" value="register" />
						</p>
					</form>

				</div>

			</div>

		</div>

	</div>

	<div class="login-sidebar tinymce">

		<?php if ($criteria_title) : ?><h4><?php echo $criteria_title; ?></h4><?php endif; ?>

		<?php if ($criteria_desc) : ?>
			<?php echo apply_filters('the_content', $criteria_desc); ?>
		<?php endif; ?>

		<?php if ($criteria_url) : ?><p><a href="<?php echo $criteria_url; ?>"><?php echo $criteria_label; ?></a></p><?php endif; ?>

	</div>

</div>