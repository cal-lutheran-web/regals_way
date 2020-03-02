<?php

	$post_tags = '';
	$theme_tags = wp_get_post_terms($post->ID,'theme');

	foreach($theme_tags as $key=>$item){
		$post_tags = $item->slug;
	}

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<aside><a href="<?php echo get_bloginfo('url').'/theme/'.$post_tags; ?>" class="theme-icon" title=""></a></aside>

	<header class="entry-header">
		<?php 
			if(is_singular()){
				the_title( '<h1 class="entry-title">', '</h1>' );
			} else {
				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			}
		?>
	</header>


	<div class="entry-content">

		<?php
			echo '<p class="post-intro">'.get_field('intro').'</p>';
		?>
			
		<?php
			$sidebar_data = get_field('sidebar');

			if(isset($sidebar_data)){
			echo '
				<div class="sidebar-box">
					<h3>'.get_field('sidebar')['sidebar_title'].'</h3>
					'.get_field('sidebar')['sidebar_content'].'
				</div>
			';
		}


		the_content( sprintf(
			wp_kses(
				/* translators: %s: Name of current post. Only visible to screen readers */
				__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'regals_way' ),
				array(
					'span' => array(
						'class' => array(),
					),
				)
			),
			get_the_title()
		) );


		
		?>
	</div>

	<footer class="entry-footer">
		<?php
			$issue_data = wp_get_post_terms($post->ID,'issue')[0];

			if(!empty($issue_data->slug)){
				echo '<p>Appeared in the <a href="'.get_bloginfo('url').'/issue/'.$issue_data->slug.'">'.$issue_data->name.'</a> issue.</p>';
			}
		?>
	</footer>
</article>