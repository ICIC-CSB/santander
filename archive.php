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

global $Custom;
$Custom->page = get_queried_object();

$Custom->title = '';

$Custom->tags = get_tags();

if ( is_category() ) :	
	$Custom->title = 'Category: ' . $Custom->page->name;
	
elseif ( is_tax() ) :
	$tax = get_taxonomy( $Custom->page->taxonomy );
	$Custom->title = $tax->label . ': ' . $Custom->page->name;
	
elseif ( is_tag() ) :
	$Custom->title = 'Tag: ' . $Custom->page->name;
	
elseif ( is_day() ) :
	$Custom->title = 'Archive for ' . get_the_time('F jS, Y');
	
elseif ( is_month() ) :
	$Custom->title = 'Archive for ' . get_the_time('F, Y');
	
elseif ( is_year() ) :
	$Custom->title = 'Archive for ' . get_the_time('Y');
	
elseif ( is_author() ) :
	$Custom->title = 'Articles by ' . get_the_author();
	
elseif ( is_search() ) :
	$Custom->title = 'Search Results for <i>"' . urldecode( $_GET['s'] ) . '"</i>';
	
elseif ( ! is_post_type_archive ( 'post' ) ) :
	
	$Custom->title = $Custom->page->label;

endif;

$description = term_description();

get_template_part( 'partials/hero' );
 ?>

<main>
	<div class="container">
		<?php if ($description) :
			echo apply_filters( 'the_content', $description );
		endif; ?>
		
		<?php while ( have_posts() ) : the_post(); ?>
			<article>
				<time><?php the_time(get_option('date_format')); ?></time>
				<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
				
				<?php if ( strlen( $post->post_excerpt ) > 0 ) : ?>
					<p><?= $post->post_excerpt ?></p>
					<p><a class="button" href="<?php the_permalink(); ?>">Read More</a></p>
				<?php else: ?>
					<p><?= wp_trim_excerpt(); ?></p>
					<p><a class="button" href="<?php the_permalink(); ?>">Read More</a></p>
				<?php endif; ?>
			</article>
			<hr>
		<?php endwhile;
		
		$pagination = wpx_archive_pagination();
		if ( ! empty( $pagination ) ) : ?>
			<article><?= $pagination ?></article>
		<?php endif; ?>
	</div>
	
	<a href="#to-top">Back to top</a>
</main>

<?php get_footer(); ?>