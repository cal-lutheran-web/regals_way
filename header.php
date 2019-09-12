<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Regals_Way
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<!-- <link rel="stylesheet" href="https://www.callutheran.edu/_resources/css/styles.css"> -->
	<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/style.css">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<a class="skip-link screen-reader-text sr-only" href="#content"><?php esc_html_e( 'Skip to content', 'regals_way' ); ?></a>

	<header id="masthead" class="container site-header">
		<div class="site-branding">
			<?php if(is_front_page() && is_home()){ ?>
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="site-title-mark"><?php bloginfo( 'name' ); ?></a></h1>
			<?php } else { ?>
				<div class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="site-title-mark"><?php bloginfo( 'name' ); ?></a></div>
			<?php } ?>

			<p class="site-description"><?php bloginfo('description'); ?></p>
			
		</div>

		<nav id="site-navigation" class="row main-navigation">
			<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'regals_way' ); ?></button>
			<?php
			// wp_nav_menu( array(
			// 	'theme_location' => 'menu-1',
			// 	'menu_id'        => 'primary-menu',
			// ) );
			?>
		</nav>
	</header>


