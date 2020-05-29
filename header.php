<?php
	if($_SERVER['SERVER_NAME'] == 'clu-wp.local'){
		echo '<!-- '.get_page_template(). ' -->';
	}
?>

<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="shortcut icon" href="<?php bloginfo('template_url'); ?>/images/favicon.ico">

	<?php if(is_single()){ 
		$desc = get_field('intro') ? get_field('intro') : get_the_excerpt();		
	?>
		<meta property="og:url" content="<?php the_permalink(); ?>">
		<meta property="og:type" content="article">
		<meta property="og:title" content="<?php the_title(); ?>">
		<meta property="og:description" content="<?php echo $desc; ?>">
		<?php if(has_post_thumbnail( $post->ID )){ 
			$featured_img = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID ), 'large' )	
		?>
			<meta property="og:image" content="<?php echo $featured_img[0]; ?>">
			<meta property="og:image:width" content="<?php echo $featured_img[1]; ?>">
			<meta property="og:image:height" content="<?php echo $featured_img[2]; ?>">
		<?php } ?>
	<?php } ?>

	<link rel="profile" href="https://gmpg.org/xfn/11">

	<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/style.css<?php echo '?v='.rand(1,10000); ?>">

	<?php if($_SERVER['SERVER_NAME'] !== 'clu-wp.local'){ ?>
		<!-- Global site tag (gtag.js) - Google Analytics -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=UA-123836-39 "></script>
		<script>window.dataLayer = window.dataLayer || []; function gtag(){dataLayer.push(arguments);} gtag('js', new Date()); gtag('config', 'UA-123836-39');</script> 
	<?php } ?>


	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<a class="skip-link screen-reader-text sr-only" href="#content"><?php esc_html_e( 'Skip to content', 'regals_way' ); ?></a>

	<header id="masthead" class="container site-header">
		<div class="site-branding">
			
			<?php if(is_front_page() && is_home()){ ?>
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="site-title-mark"><span class="sr-only"><?php bloginfo( 'name' ); ?></span></a></h1>
			<?php } else { ?>
				<div class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="site-title-mark"><span class="sr-only"><?php bloginfo( 'name' ); ?></span></a></div>
			<?php } ?>

			<p class="site-description"><?php bloginfo('description'); ?></p>
			
		</div>

		<nav id="site-navigation" class="site-navigation">
			<ul class="site-nav-list">
				<?php
					$theme_terms = get_terms( 'theme', array(
						'hide_empty' => false,
					) );
					foreach($theme_terms as $key=>$item){
						echo '<li class="theme-'.$item->slug.'"><a href="'.get_bloginfo('url').'/theme/'.$item->slug.'" class="theme-icon"><span class="sr-only">'.$item->name.'</span></a></li>';
					}
				?>
			</ul>
		</nav>

		<?php /* <nav id="social-media-links" class="social-media-links">
			<ul class="social-media-list">
				<li><a href="https://www.instagram.com/clu_coas/" title="Instagram" class="social-media-icon sm-instagram"><?php include 'images/social-media/instagram.svg'; ?></a></li>
			</ul>
		</nav>
		*/ ?>
	</header>


