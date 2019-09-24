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

<article class="post-card <?php echo $post_tags; ?>">
	<header><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></header>
	<figure class="post-card-image" style="background-image: url('<?php echo $featured_img; ?>');"></figure>
	<?php if($hide_theme_icon !== true){ ?>
	<figure class="theme-icon size-small"></figure>
	<?php } ?>
</article>