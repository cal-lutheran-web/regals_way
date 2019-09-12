<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Regals_Way
 */

get_header();
?>

	<main id="main" class="container site-content">

	<?php
	while ( have_posts() ) :
		the_post();

		get_template_part( 'template-parts/content', get_post_type() );

		the_post_navigation();

	endwhile; // End of the loop.
	?>

	</main>

<?php
get_sidebar();
get_footer();
