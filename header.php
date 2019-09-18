<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/style.css<?php echo '?v='.rand(1,10000); ?>">

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
						echo '<li class="theme-'.$item->slug.'"><a href="#" class="theme-icon"><span class="sr-only">'.$item->name.'</span></a></li>';
					}
				?>
			</ul>
		</nav>
	</header>


