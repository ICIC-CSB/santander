<?php
/**
 * Template Name: Register
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

<?php $intro_register = get_field('intro_register', 'options'); ?>
<?php $criteria_title = get_field('login_criteria_title', 'options'); ?>
<?php $criteria_desc = get_field('login_criteria_desc', 'options'); ?>
<?php $criteria_url = get_field('login_criteria_link', 'options'); ?>
<?php $criteria_label = get_field('login_criteria_link_label', 'options'); ?>

<main>
	<div class="container">
		<article<?= empty( $max_width ) ? '' : ' style="max-width: ' . $max_width . 'px"' ?>>

			<div class="login-area">

				<div class="login-content register-form">

					<div data-module="login-wrapper">

						<div class="login-wrapper-nav">
							<a href="<?php bloginfo('url') ?>/register/">Create account</a>
							<a href="<?php bloginfo('url') ?>/login/" class="active">Sign in</a>
						</div>

						<div class="login-wrapper-form tinymce">

							<div class="tml tml-register">

								<?php if ($intro_register) : ?><p class="larger"><?php echo $intro_register; ?></p><?php endif; ?>

								<?php the_content(); ?>

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