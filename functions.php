<?php


// remove native categories and tags from admin menu, we will do our own
function remove_menus(){
	remove_menu_page('edit-comments.php');

	//remove_submenu_page('edit.php?post_type=quotes','edit-tags.php?taxonomy=post_tag');
	//remove_submenu_page('edit.php?post_type=quotes','edit-tags.php?taxonomy=category');
}
add_action( 'admin_menu', 'remove_menus' );




// Register Sidebars
function sidebar() {

	$args = array(
		'id'            => 'main_sidebar',
		'name'          => __( 'Main Sidebar', 'text_domain' ),
	);
	register_sidebar( $args );

}
add_action( 'widgets_init', 'sidebar' );








if ( ! function_exists( 'regals_way_setup' ) ) :
	function regals_way_setup() {

		// magazine issues taxonomy
		register_taxonomy( 'issue', array( 'post', 'quotes' ), array(
			'labels' => array(
				'name' => _x( 'Issues', 'Taxonomy General Name', 'text_domain' ),
				'singular_name' => _x( 'Issue', 'Taxonomy Singular Name', 'text_domain' )
			),
			'hierarchical' => false,
			'public' => true,
			'show_ui' => true,
			'show_admin_column' => true,
			'show_in_nav_menus' => true,
		));

		// magazine themes taxonomy
		register_taxonomy( 'theme', array( 'post', 'quotes' ), array(
			'labels' => array(
				'name' => _x( 'Themes', 'Taxonomy General Name', 'text_domain' ),
				'singular_name' => _x( 'Theme', 'Taxonomy Singular Name', 'text_domain' )
			),
			'hierarchical' => false,
			'public' => true,
			'show_ui' => true,
			'show_admin_column' => true,
			'show_in_nav_menus' => true,
		));


		// quotes posts type
		register_post_type( 'quotes', array(
			'labels' => array(
				'name' => _x( 'Quotes', 'Post Type General Name', 'text_domain' ),
				'singular_name' => _x( 'Quote', 'Post Type Singular Name', 'text_domain' ),
			),
			'menu_icon' => 'dashicons-format-quote',
			'supports' => array('title', 'thumbnail'),
			'taxonomies' => array( 'issue' ),
			'hierarchical'          => false,
			'public'                => true,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'menu_position'         => 5,
			'show_in_admin_bar'     => true,
			'show_in_nav_menus'     => true,
			'can_export'            => true,
			'has_archive'           => true,
			'exclude_from_search'   => false,
			'publicly_queryable'    => true,
			'capability_type'       => 'post',
		) );


		// news posts type
		register_post_type( 'news', array(
			'labels' => array(
				'name' => _x( 'News', 'Post Type General Name', 'text_domain' ),
				'singular_name' => _x( 'News Item', 'Post Type Singular Name', 'text_domain' ),
			),
			'menu_icon' => 'dashicons-text-page',
			'supports' => array('title', 'editor', 'excerpt', 'thumbnail'),
			'taxonomies' => array( 'issue' ),
			'hierarchical'          => false,
			'public'                => true,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'menu_position'         => 5,
			'show_in_admin_bar'     => true,
			'show_in_nav_menus'     => true,
			'can_export'            => true,
			'has_archive'           => true,
			'exclude_from_search'   => false,
			'publicly_queryable'    => true,
			'capability_type'       => 'post',
		) );




		





		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'regals_way' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );
	}
endif;
add_action( 'after_setup_theme', 'regals_way_setup' );