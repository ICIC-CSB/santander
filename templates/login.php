<?php
/**
 * Template Name: Login
 *
 * @package WordPress
 * @subpackage WPX_Theme
 * @since 0.1.0
 * @version 1.0
 */

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

get_template_part( 'partials/hero' ); ?>

<?php $criteria_title = get_field('login_criteria_title', 'options'); ?>
<?php $criteria_desc = get_field('login_criteria_desc', 'options'); ?>
<?php $criteria_url = get_field('login_criteria_link', 'options'); ?>
<?php $criteria_label = get_field('login_criteria_link_label', 'options'); ?>
<?php $intro_signin = get_field('intro_signin', 'options'); ?>

<main>
	<div class="container">
		<article<?= empty( $max_width ) ? '' : ' style="max-width: ' . $max_width . 'px"' ?>>

			<div class="login-area">

				<div class="login-content">

					<div data-module="login-wrapper">

						<div class="login-wrapper-nav">
							<a href="<?php bloginfo('url') ?>/register/" class="active">Create account</a>
							<a href="<?php bloginfo('url') ?>/login/">Sign in</a>
						</div>

						<div class="login-wrapper-form tinymce">

							<h5><?php echo $intro_signin; ?></h5>

							<div class="tml tml-login">
								
								<?php \WPX\Custom\get_user_messaging($_GET); ?>

								<form name="loginform" id="loginform" action="<?php echo esc_url( site_url( 'wp-login.php', 'login_post' ) ); ?>" method="post">

									<p class="login-username">
										<label for="log">Username or Email Address</label>
										<input type="text" name="log" id="user_login" class="input required email valid" value="" size="20" autocomplete="off" aria-invalid="false">
									</p>
									<p class="login-password">
										<label for="user_pass">Password</label>
										<input type="password" name="pwd" id="user_pass" class="input required" value="" size="20" autocomplete="off">
									</p>
									<p>
										<label for="googleotp">Two-Factor Authentication<span id="google-auth-info"></span><br />
										<input type="text" name="googleotp" id="googleotp" class="input" value="" size="20" autocomplete="off" /></label>
										<em>If you don't have an authentication code, leave this field empty.</em>
									</p>
									
									<p class="login-remember"><label><input name="rememberme" type="checkbox" id="rememberme" value="forever"> Remember Me</label></p>
									<p class="submit">
										<input type="submit" name="wp-submit" id="wp-submit" class="button button-primary button-large" value="<?php esc_attr_e('Resume Application'); ?>" />
										<input type="hidden" name="redirect_to" value="<?php echo esc_attr(get_bloginfo('url').'/application/'); ?>" />
										<input type="hidden" name="testcookie" value="1" />
									</p>
								</form>

								<ul class="tml-action-links">
									<li><a href="<?php bloginfo('url'); ?>/lostpassword/" rel="nofollow">Forgot Password?</a></li>
								</ul>

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

		</article>
	</div>
	
	<a href="#to-top">Back to top</a>
</main>

<?php get_footer(); ?>