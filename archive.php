<?php get_header(); 

	$theme_tags = wp_get_post_terms($post->ID,'theme');

	foreach($theme_tags as $key=>$item){
		$post_tags = 'theme-'.$item->slug.' ';
	}
?>

	<main id="main" class="container site-content <?php echo $post_tags; ?>">

		<?php if ( have_posts() ) { ?>

			<header class="page-header">
				<h1 class="theme-section-title"><?php single_tag_title('', true); ?></h1>
			</header>

			<?php while ( have_posts() ) {
				the_post();

				get_template_part( 'template-parts/post-snippet');
			
			}



		} else {

			get_template_part( 'template-parts/content', 'none' );

		}
		?>

		<footer>
			<?php showPagination(); ?>
		</footer>

	</main>


<?php get_footer(); ?>
