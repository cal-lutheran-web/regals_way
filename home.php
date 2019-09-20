<?php
get_header();
?>

	<main id="main" class="container">

		<section class="top-stories-grid top-stories-boxed">
			<?php
				$theme_terms = get_terms('theme', array(
					'hide_empty' => false,
				));

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


		<div class="page-wrapper ">
			<div class="page-content site-content">
				<?php
					// get sections for each theme tag

					foreach($theme_terms as $key=>$item){ ?>

						<section class="posts-section <?php echo 'theme-'.$item->slug; ?>">
							<header class="theme-section-title"><?php echo $item->name; ?></header>

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
									get_template_part('template-parts/post-card');
								}
							?>
							</div>

						</section>

					<?php }

					
				?>
			</div>

			<aside class="page-sidebar site-content">
				<?php dynamic_sidebar( 'main-sidebar' ); ?>
			</aside>
		
	</main>

<?php

get_footer();
