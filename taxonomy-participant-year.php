<?php
/**
 * The template for the Archives.
 *
 * @package WordPress
 * @subpackage WPX_Theme
 * @since 0.1.0
 * @version 1.0
 */
 
if ( ! have_posts() ) :
	echo file_get_contents( WPX_DOMAIN . '/error/' );
	exit;
endif;

get_header();

global $Custom, $wpdb;

$Custom->hero = get_page_by_path('participants');

get_template_part( 'partials/hero' );

$Custom->generic_portrait = $wpdb->get_var( "select guid from $wpdb->posts where locate('mystery-man.png', guid) > 0 and post_type='attachment'" );

if ( $Custom->generic_portrait ) :
	$Custom->generic_portrait = '<img src="' . $Custom->generic_portrait . '" alt="Missing portrait">';
endif;
 ?>

<main>
	<div class="container">
		<ul class="participant-years">
			<?php wp_list_categories( array(
				'taxonomy' => 'participant-year',
				'title_li' => ''
			)); ?>
		</ul>
		
		<div class="participants">
			<?php while ( have_posts() ) : the_post();
				$thumb = $Custom->generic_portrait;
				if ( has_post_thumbnail() ) :
					$thumb = get_the_post_thumbnail( $post->ID, 'medium' );
				endif;
			?>
				<article>
					<figure><a href="<?php the_permalink(); ?>"><?= $thumb ?></a></figure>
					
					<div class="participant-info">
						<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
						
						<?php if ( get_field( 'participant_company_name', $post->ID ) ) : ?>
							<p><?= get_field( 'participant_company_name', $post->ID ) ?></p>
						<?php endif; ?>
						
						<div class="participant-bio">
							<?php the_content(); ?>
						</div>
					</div>
				</article>
			<?php endwhile; ?>
		</div>
	</div>
	
	<a href="#to-top">Back to top</a>
</main>

<?php get_footer(); ?>