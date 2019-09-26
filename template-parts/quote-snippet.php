<?php

	if(has_post_thumbnail( $post->ID )){
		$featured_img = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID ), 'thumbnail' )[0];
	} else {
		$featured_img = '';
	}	
	
?>

<article class="quote-snippet">
	<blockquote>
		<p><?php the_field('quote'); ?></p>
		<cite><strong><?php the_title(); ?></strong><br /><?php the_field('subtitle'); ?></cite>
	</blockquote>

	<?php if($featured_img !== ''){ ?>
		<img src="<?php echo $featured_img; ?>" class="quote-img" />
	<?php } ?>
</article>