<?php get_header(); 

$theme_terms = get_terms('theme', array(
	'hide_empty' => false,
));


$issue_terms = get_terms('issue', array(
	'hide_empty' => false,
));

?>

	<main id="main" class="container">

		<section class="top-stories-grid top-stories-boxed">
			<?php
				foreach($theme_terms as $key=>$item){
					$theme_top_posts = get_posts(array(
						'posts_per_page' => 1,
						'tax_query' => array(
							array(
								'taxonomy' => 'theme',
								'terms' => $item->term_id
							)
						)
					));

					foreach($theme_top_posts as $post){
						setup_postdata($post);
						get_template_part('template-parts/post-card');
					}

					wp_reset_postdata();
				} 
				wp_reset_postdata();
			?>
		</section>

		<section class="quotes-section">
			<header>
				<h2><?php echo $issue_terms[0]->description; ?></h2>
			</header>

			<?php
				$quote_posts = get_posts(array(
					'post_type' => 'quotes',
					'posts_per_page' => 4
				));

				foreach($quote_posts as $post){
					setup_postdata($post);
					get_template_part('template-parts/quote-snippet');
				}
			?>
		</section>

		<?php
			// get sections for each theme tag

			foreach($theme_terms as $key=>$item){ ?>

				<section class="site-content posts-section <?php echo 'theme-'.$item->slug; ?>">
					<header class="theme-section-title">
						<figure class="theme-icon"></figure>
						<a href="theme/<?php echo $item->slug; ?>"><?php echo $item->name; ?></a>
					</header>

					<div class="theme-section-posts">
					<?php
						$theme_posts = get_posts(array(
							'tax_query' => array(
								array(
									'taxonomy' => 'theme',
									'terms' => $item->term_id
								)
							)
						));

						foreach($theme_posts as $post){ 
							setup_postdata($post);
							$hide_theme_icon = true;
							include('template-parts/post-card.php');
						}
					?>
					</div>

				</section>

		<?php } ?>

		<section class="site-content news-section">
			<header>
				<h2>News from the College of Arts & Sciences</h2>
			</header>

			<?php
				$news_data = get_posts(array(
					'post_type' => 'news',
					'posts_per_page' => 1
				));

				foreach($news_data as $post){
					setup_postdata($post);

					the_content();
				}
			?>
		</section>
		
	</main>

<?php

get_footer();
