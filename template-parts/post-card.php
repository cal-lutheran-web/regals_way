<?php

	$post_tags = '';
	$theme_tags = wp_get_post_terms($post->ID,'theme');

	foreach($theme_tags as $key=>$item){
		$post_tags = 'theme-'.$item->slug.' ';
	}
	

?>

<article class="post-card <?php echo $post_tags; ?>">
	<header><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></header>
	<figure class="post-card-image"></figure>
	<figure class="theme-icon"></figure>
</article>