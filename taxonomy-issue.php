<?php 

$current_issue = get_term_by( 'slug', get_query_var('term'), get_query_var('taxonomy') );
			
$theme_posts = get_posts(array(
	'tax_query' => array(
		array(
			'taxonomy' => 'issue',
			'field' => 'slug',
			'terms' => $current_issue->slug
		)
	)
));

$news_posts = get_posts(array(
	'post_type' => 'news',
	'tax_query' => array(
		array(
			'taxonomy' => 'issue',
			'field' => 'slug',
			'terms' => $current_issue->slug
		)
	)
));


get_header(); 

?>

	<main id="main" class="container site-content">
	
		<header class="page-header">
			<h1><?php the_title(); ?></h1>
		</header>

		<section class="theme-section-posts">
		<?php

			foreach($theme_posts as $post){
				setup_postdata($post);
				
				get_template_part('template-parts/post-card');
			}

			wp_reset_postdata();

		?>
		</section>

		<section class="quotes-section">
			quotes
		</section>

		<section class="news-section">
			<?php

				foreach($news_posts as $post){
					setup_postdata($post);
					
					the_content();
				}

				wp_reset_postdata();

			?>
		</section>


	</main>


<?php get_footer(); ?>
