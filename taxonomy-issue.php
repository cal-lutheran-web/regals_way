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

$quote_posts = get_posts(array(
	'post_type' => 'quotes',
	'posts_per_page' => -1,
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

	<main id="main" class="container">
	
		<header class="page-header">
			<h1><?php echo single_cat_title(); ?></h1>
		</header>

		<section class="issue-top-posts theme-section-posts top-stories-boxed">
			<?php getTopThemePosts(); ?>
		</section>

		<section class="site-content quotes-section">
			<header>
				<h2><?php echo $issue_terms[0]->description; ?></h2>
			</header>

			<?php
				foreach($quote_posts as $post){
					setup_postdata($post);
					echo '<hr />';
					get_template_part('template-parts/quote-snippet');
				}
				wp_reset_postdata();
			?>
			
		</section>

		<section class="site-content">
			<header class="entry-header">
				<h2 class="entry-title">News from the College of Arts & Sciences</h2>
			</header>
			
			<article class="entry-content">
			<?php

				foreach($news_posts as $post){
					setup_postdata($post);
					
					the_content();
				}

				wp_reset_postdata();

			?>
			</article>
		</section>


		<?php
			$this_term = get_queried_object();
			$issuu_eng = get_field('issuu_eng',$this_term);
			$issuu_esp = get_field('issuu_esp',$this_term);

			if(!empty($issuu_eng) || !empty($issuu_esp)){
		?>

			<section class="site-content">
				<header class="entry-header">
					<h2 class="entry-title">Print Archive of this Issue</h2>
				</header>

				<div class="issuu-embeds">
					<?php if($issuu_eng !== ''){ ?>
						<div class="embed-card">
							<h3>English Edition</h3>
							<?php echo $issuu_eng; ?>
						</div>
					<?php } ?>

					<?php if($issuu_esp !== ''){ ?>
						<div class="embed-card">
							<h3>Spanish Edition</h3>
							<?php echo $issuu_esp; ?>
						</div>
					<?php } ?>
				</div>
			</section>

		<?php } ?>


	</main>


<?php get_footer(); ?>
