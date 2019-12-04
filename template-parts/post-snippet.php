<?php

	$post_tags = '';
	$theme_tags = wp_get_post_terms($post->ID,'theme');

	foreach($theme_tags as $key=>$item){
		$post_tags = 'theme-'.$item->slug.' ';
	}

	if(has_post_thumbnail( $post->ID )){
		$featured_img = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID ), 'medium-large' )[0];
	} else {
		$featured_img = '';
	}	
	
?>

<article class="post-snippet <?php echo $post_tags; ?>">
	<div class="snippet-content">	
		<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
		<?php the_excerpt(); ?>
	</div>
	<figure class="snippet-image" style="background-image: url('<?php echo $featured_img; ?>');"></figure>
</article>