<?php
/**
 * Partners page; displays standard content, then loops through CPT partners
 *
 * @package WordPress
 * @subpackage WPX_Theme
 * @since 0.1.0
 * @version 1.0
 */

the_post();

get_header();

global $Custom;

get_template_part( 'partials/hero' );
 ?>

<main>
	<div class="container">
		<article<?= empty( $max_width ) ? '' : ' style="max-width: ' . $max_width . 'px"' ?>>
			<?php the_content(); ?>
			
			<?php
			$Custom->partners = get_posts( array(
				'numberposts' => -1,
				'post_type' => 'partner',
				'post_status' => 'publish',
				'orderby' => 'menu_order',
				'order' => 'ASC'
			));
			
			if ( count( $Custom->partners > 0 ) ) : ?>
				<div class="partner-list">
					<?php foreach( $Custom->partners as $partner ) :
						$meta = wpx_load_meta( $partner->ID );
						
						// logo scaling?
						if ( ! empty( $meta['logo_scaling'] ) and (float) $meta['logo_scaling'] < 100 ) :
							$meta['logo_scaling'] = array( 'style' => 'width: ' . ( (float) $meta['logo_scaling'] ) . '%' );
						else :
							$meta['logo_scaling'] = false;
						endif;
						?>
						
						<div class="clear">
							<figure>
								<?= get_the_post_thumbnail( $partner->ID, 'full', $meta['logo_scaling'] ) ?>
							</figure>
							<div class="partner-info">
								<h4 class="text-gray"><?= apply_filters( 'the_title', $partner->post_title ) ?></h4>
								<?= apply_filters( 'the_content', $partner->post_content ) ?>
								
								<?php if ( ! empty( $meta['partner_extended_content'] ) ) : ?>
									<div class="hidden">
										<?= apply_filters( 'the_content', $meta['partner_extended_content'] ) ?>
									</div>
									
									<a href="#" class="opener" rel="previous" data-closed-text="More" data-open-text="Less">More</a>
								<?php endif; ?>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>	
		</article>
	</div>
	
	<a href="#to-top">Back to top</a>
</main>

<?php get_footer(); ?>