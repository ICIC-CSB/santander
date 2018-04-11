<?php
/*
If you would like to edit this file, copy it to your current theme's directory and edit it there.
Theme My Login will always look in your theme's directory first, before using this default template.
*/
?>

<?php $criteria_title = get_field('login_criteria_title', 'options'); ?>
<?php $criteria_desc = get_field('login_criteria_desc', 'options'); ?>
<?php $criteria_url = get_field('login_criteria_link', 'options'); ?>
<?php $criteria_label = get_field('login_criteria_link_label', 'options'); ?>
<?php $intro_signin = get_field('intro_signin', 'options'); ?>

<div class="login-area">

	<div class="login-content">

		<div data-module="login-wrapper">

			<div class="login-wrapper-nav">
				<a href="<?php echo $template->get_action_url( 'register' ); ?>" class="active">Create account</a>
				<a href="<?php echo $template->get_action_url( 'login' ); ?>">Sign in</a>
			</div>

			<div class="login-wrapper-form tinymce">

				<h5><?php echo $intro_signin; ?></h5>

				<div class="tml tml-login" id="theme-my-login<?php $template->the_instance(); ?>">
					
					<?php $template->the_action_template_message( 'login' ); ?>
					<?php $template->the_errors(); ?>
					
					<form name="loginform" id="loginform<?php $template->the_instance(); ?>" class="validate" action="<?php $template->the_action_url( 'login', 'login_post' ); ?>" method="post">
						<p class="tml-user-login-wrap">
							<label for="user_login<?php $template->the_instance(); ?>"><?php
								if ( 'username' == $theme_my_login->get_option( 'login_type' ) ) {
									_e( 'Enter username', 'theme-my-login' );
								} elseif ( 'email' == $theme_my_login->get_option( 'login_type' ) ) {
									_e( 'Enter email', 'theme-my-login' );
								} else {
									_e( 'Enter username or email', 'theme-my-login' );
								}
							?></label>
							<input type="text" name="log" id="user_login<?php $template->the_instance(); ?>" class="required email input" value="<?php $template->the_posted_value( 'log' ); ?>" size="20" />
						</p>

						<p class="tml-user-pass-wrap">
							<label for="user_pass<?php $template->the_instance(); ?>"><?php _e( 'Enter password', 'theme-my-login' ); ?></label>
							<input type="password" name="pwd" id="user_pass<?php $template->the_instance(); ?>" class="required input" value="" size="20" autocomplete="off" />
						</p>

						<?php do_action( 'login_form' ); ?>

						<div class="tml-rememberme-submit-wrap">
							<p class="tml-rememberme-wrap">
								<input name="rememberme" type="checkbox" id="rememberme<?php $template->the_instance(); ?>" value="forever" />
								<label for="rememberme<?php $template->the_instance(); ?>"><?php esc_attr_e( 'Remember Me', 'theme-my-login' ); ?></label>
							</p>

							<p class="tml-submit-wrap">
								<input type="submit" name="wp-submit" id="wp-submit<?php $template->the_instance(); ?>" value="<?php esc_attr_e( 'Resume Application', 'theme-my-login' ); ?>" />
								<input type="hidden" name="redirect_to" value="<?php $template->the_redirect_url( 'login' ); ?>" />
								<input type="hidden" name="instance" value="<?php $template->the_instance(); ?>" />
								<input type="hidden" name="action" value="login" />
							</p>
						</div>
					</form>
					<?php $template->the_action_links( array( 'login' => false, 'register'=>false ) ); ?>
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