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

$issue_terms = get_terms('issue', array(
	'hide_empty' => false,
));


get_header(); 

while(have_posts()){
	the_post();

echo 'hi';
}

?>

	<main id="main" class="container">
	
		<header class="page-header">
			<h1><?php echo single_cat_title(); ?></h1>
		</header>

		<section class="site-content theme-section-posts">
			<?php getTopThemePosts(); ?>
		</section>

		<section class="site-content quotes-section">
			<header>
				<h2><?php echo $issue_terms[0]->description; ?></h2>
			</header>

			<?php getRandomQuote(); ?>
		</section>

		<section class="site-content news-section">
			<header>
				<h2>News from the College of Arts & Sciences</h2>
			</header>
			
			<article class="news-content">
			<?php

				foreach($news_posts as $post){
					setup_postdata($post);
					
					the_content();
				}

				wp_reset_postdata();

			?>
			</article>
		</section>


	</main>


<?php get_footer(); ?>
