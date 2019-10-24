<?php get_header(); 

$theme_terms = get_terms('theme', array(
	'hide_empty' => false,
));


?>

	<main id="main" class="container">

		<section class="top-stories-grid top-stories-boxed">
			<?php getTopThemePosts(); ?>
		</section>

		<section class="quotes-section">

			<?php getRandomQuote(); ?>
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

		<section class="site-content post">
			<header class="entry-header">
				<h2 class="entry-title">News from the College of Arts & Sciences</h2>
			</header>
			
			<article class="entry-content entry-hide">
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
			</article>
			<button class="btn btn-toggle" onclick="document.querySelector('.entry-hide').classList.toggle('entry-hide');">Read More</button>
		</section>
		
	</main>

<?php

get_footer();
