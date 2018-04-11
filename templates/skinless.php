<?php
/**
 * Template Name: Skinless Frame
 *
 * @package WordPress
 * @subpackage WPX_Theme
 * @since 0.1.0
 * @version 1.0
 *
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

?>

<main class="skinless-ui">
	<div class="container">
		<article<?= empty( $max_width ) ? '' : ' style="max-width: ' . $max_width . 'px"' ?>>
			<?php the_content(); ?>
		</article>
	</div>
	
	<a href="#to-top">Back to top</a>
</main>

<?php get_footer(); ?>