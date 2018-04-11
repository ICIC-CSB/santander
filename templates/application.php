<?php
/**
 * Template Name: Application
 *
 * @package WordPress
 * @subpackage WPX_Theme
 * @since 0.1.0
 * @version 1.0
 *
*/

the_post();

get_header();

$application_form = get_field('application_form', 'options');
$thank_you_message = get_field('thank_you_message', 'options');

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

<main class="skinless-ui half-padding">
	<div class="container">
		<article<?= empty( $max_width ) ? '' : ' style="max-width: ' . $max_width . 'px"' ?>>
			<?php
				// if we can find a submission with this user field, then don't let them fill it out again
				$has_submission = new WP_Query(array(
					'posts_per_page' => -1,
					'post_type' => 'nf_sub',
					'no_found_rows'=> true,
					'meta_query' => array(
						array(
							'key'     => '_field_83', // the hidden user ID field
							'value'   => get_current_user_id(),
							'compare' => 'IN',
						),
					))
				);
			?>
			<?php // if we have a submission and the user is locked ?>
			<?php if ($has_submission->have_posts() && get_user_meta(get_current_user_id(), 'user_is_locked', true)) : ?>
				<div class="tinymce application-form-thankyou">
					<p>Cultivate Small Business Application</p>
					<?php if ($thank_you_message) : ?><p class="larger"><?php echo $thank_you_message; ?></p><?php endif; ?>
					<p><a href="<?php echo bloginfo('url'); ?>" class="button">Home</a></p>
					<p><?php wp_loginout(); ?>
				</div>
			<?php else : ?>
				<?php if ($application_form) : Ninja_Forms()->display( $application_form ); endif; ?>
			<?php endif; ?>
		</article>
	</div>
	
	<a href="#to-top">Back to top</a>
</main>

<?php get_footer(); ?>