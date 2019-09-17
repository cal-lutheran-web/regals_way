<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Regals_Way
 */

get_header();
?>

	<main id="main" class="container">

		<section class="top-stories-grid">
			<?php
				// The Query
				$query = new WP_Query( array(
					'post_type' => array('post')
				) );


				// The Loop
				while($query->have_posts() ) {
					$query->the_post();
					
					get_template_part( 'template-parts/post-card');
					
				}
			

				// Restore original Post Data
				wp_reset_postdata();
			?>
		</section>


		<?php
			// get sections for each theme tag

			$theme_terms = get_terms( 'theme', array(
				'hide_empty' => false,
			) );

			foreach($theme_terms as $key=>$item){ ?>

				<section class="theme-section site-content <?php echo 'theme-'.$item->slug; ?>">
					<figure class="theme-icon"></figure>

				</section>

			<?php }
			
		?>

		
		
	</main>

<?php
get_sidebar();
get_footer();
