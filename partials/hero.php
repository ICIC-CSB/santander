<?php
global $Custom;

if ( ! isset( $Custom->hero ) ) :
	if ( is_single() or is_page() ) :
		$Custom->hero = $post;
	else :
		$Custom->hero = get_page_by_path('generic-hero');
	endif;
endif;

$Custom->hero->bg = '';
if ( has_post_thumbnail( $Custom->hero->ID ) ) :
	$Custom->hero->bg = ' style="background-image: url( ' . get_the_post_thumbnail_url( $Custom->hero->ID, 'full' ) . ' )"';
	
	$Custom->hero->content = get_field('hero_content', $Custom->hero->ID);
endif;
 ?>

<section class="hero <?= get_field('hero_content_placement', $Custom->hero->ID) ?> bg-gray-pale"<?= $Custom->hero->bg ?>>
	<div class="container">
		<div class="hero-content">
			<figure>&nbsp;</figure>
			
			<?php if ( ! empty( $Custom->title ) ) : ?>
				<h1><?= apply_filters( 'the_title', $Custom->title ) ?></h1>
			<?php elseif ( ! empty( $Custom->hero->content ) ) :
				echo apply_filters( 'the_content', $Custom->hero->content );
			else : ?>
				<h1><?= apply_filters( 'the_title', $post->post_title ) ?></h1>
			<?php endif; ?>
			
			<figure>&nbsp;</figure>
		</div>
	</div>
</section>