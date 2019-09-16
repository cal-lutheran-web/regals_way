<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Regals_Way
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<aside class="theme-icon"></aside>

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

			if(get_field('sidebar')['sidebar_content'] !== ''){
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
	</div><!-- .entry-content -->

	<footer class="entry-footer">

	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
