<?php


include 'functions/custom-fields.php';


// add editor styles

function site_block_editor_styles() {
    wp_enqueue_style( 'site-block-editor-styles', get_theme_file_uri( '/editor-style.css' ), false, '1.0', 'all' );
}
add_action( 'enqueue_block_editor_assets', 'site_block_editor_styles' );


// remove p tag around images
function filter_ptags_on_images($content){
	return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}
 
add_filter('the_content', 'filter_ptags_on_images');

// remove p tags on content
//remove_filter( 'the_content', 'wpautop' );


// remove native categories and tags from admin menu, we will do our own
function remove_menus(){
	remove_menu_page('edit-comments.php');

	remove_submenu_page('edit.php','edit-tags.php?taxonomy=post_tag');
	remove_submenu_page('edit.php','edit-tags.php?taxonomy=category');
}
add_action( 'admin_menu', 'remove_menus' );



// hide certain postboxes
function my_remove_meta_boxes() {
	remove_meta_box( 'tagsdiv-theme', 'post', 'side' );
	remove_meta_box( 'tagsdiv-issue', 'post', 'side' );

	remove_meta_box( 'tagsdiv-issue', 'quotes', 'side' );
	remove_meta_box( 'tagsdiv-issue', 'news', 'side' );

	remove_meta_box( 'tagsdiv-post_tag', 'post', 'side' );
	remove_meta_box( 'categorydiv', 'post', 'side' );
}
add_action( 'admin_menu', 'my_remove_meta_boxes' );




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
			'show_tagcloud' => false,
			'show_in_rest' => true
		));

		// magazine themes taxonomy
		register_taxonomy( 'theme', array( 'post' ), array(
			'labels' => array(
				'name' => _x( 'Themes', 'Taxonomy General Name', 'text_domain' ),
				'singular_name' => _x( 'Theme', 'Taxonomy Singular Name', 'text_domain' )
			),
			'hierarchical' => false,
			'public' => true,
			'show_ui' => true,
			'show_admin_column' => true,
			'show_in_nav_menus' => true,
			'show_in_rest' => true
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
			'show_in_rest' => true
		) );


		// news posts type
		register_post_type( 'news', array(
			'labels' => array(
				'name' => _x( 'News', 'Post Type General Name', 'text_domain' ),
				'singular_name' => _x( 'News Item', 'Post Type Singular Name', 'text_domain' ),
			),
			'menu_icon' => 'dashicons-media-text',
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
			'show_in_rest' => true
		) );



		// add theme support
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// navigation menus
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'regals_way' ),
		) );
		
	}
endif;
add_action( 'after_setup_theme', 'regals_way_setup' );



// custom display functions

function getRandomQuote(){
	$quote_posts = new WP_Query(array(
		'post_type' => 'quotes',
		'posts_per_page' => 1,
		'orderby' => 'rand'
	));

	while($quote_posts->have_posts()){
		$quote_posts->the_post();

		$term = wp_get_post_terms($quote_posts->post->ID,'issue')[0];

		echo '
			<header>
				<h2>'.$term->description.'</h2>
			</header>
		';

		get_template_part('template-parts/quote-snippet');
	}

	wp_reset_postdata();
}


function getTopThemePosts(){
	$theme_terms = get_terms('theme', array(
		'hide_empty' => false,
	));

	$highlight_post = array();
	$sorted_posts = array();

	foreach($theme_terms as $key=>$item){
		$theme_top_posts = new WP_Query(array(
			'post_type' => 'post',
			'posts_per_page' => 1,
			'tax_query' => array(
				array(
					'taxonomy' => 'theme',
					'terms' => $item->term_id
				)
			)
		));

		$top_posts[] = $theme_top_posts;

		while ( $theme_top_posts->have_posts() ) {
			$theme_top_posts->the_post();
		
			$sorted_posts[] += get_the_ID();
		};

		wp_reset_postdata();
	} 
	wp_reset_postdata();

	$top_posts_sorted = array_merge($highlight_post,$sorted_posts);
	
	$top_sorted_query = new WP_Query(
		array(
			'post_type' => 'post',
			'post__in' => $sorted_posts,
			'meta_key' => 'homepage_highlight',
			'orderby' => 'meta_value'
		) 
	);
	
	while($top_sorted_query->have_posts()){
		$top_sorted_query->the_post();
		get_template_part('template-parts/post-card');
	}
	wp_reset_postdata();
	
}



function showPagination(){
	the_posts_pagination( array(
		'mid_size'  => 10,
		'prev_text' => __( 'Newer', 'textdomain' ),
		'next_text' => __( 'Older', 'textdomain' ),
		'screen_reader_text' => __( 'Archive Navigation', 'textdominan' )
	));
}