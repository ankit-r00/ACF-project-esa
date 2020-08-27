<?php

// ==========================================================================
//    LOAD SCRIPTS
// ==========================================================================
function add_scripts() {
  if ( ! is_admin() ) {
    wp_enqueue_script( "jquery-js", 'https://code.jquery.com/jquery-3.4.0.min.js', false, true, true );
	  wp_enqueue_script( "bootstrap-js", 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js', false, true );
	  wp_enqueue_script( "wow-js", 'https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js', false, true, true );
	  wp_enqueue_script( "slick-js", 'https://cdn.jsdelivr.net/jquery.slick/1.3.15/slick.min.js', false, true, true );
    wp_enqueue_script( "custom-js", get_template_directory_uri() . "/js/custom.js", array(), 20190430, true );

  }
}

add_action( 'wp_enqueue_scripts', 'add_scripts' );


// ==========================================================================
//    LOAD STYLES
// ==========================================================================
function add_stylesheets() {
  if ( ! is_admin() ) {
    wp_enqueue_style( 'bootstrap-css', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css', '1.0.0', 'all' );
	  wp_enqueue_style( 'animate-css', 'https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css', array( ), '1.0.0', 'all' );
	  wp_enqueue_style( 'font-css', 'https://fonts.googleapis.com/css?family=Open+Sans:400,600,700', array( ), '1.0.0', 'all' );
	  wp_enqueue_style( 'fontawesome-css', 'https://pro.fontawesome.com/releases/v5.7.2/css/all.css', array( ), '1.0.0', 'all' );
    wp_enqueue_style( 'slick-css', 'https://cdn.jsdelivr.net/jquery.slick/1.3.15/slick.css', array( ), '1.3.0', 'all' );
    wp_enqueue_style( 'style', get_template_directory_uri() . '/css/master.css', array( ), '1.0.0', 'all' );
  }
}

add_action( 'wp_enqueue_scripts', 'add_stylesheets' );


// ==========================================================================
//    MENUS
// ==========================================================================
function register_nav() {

  register_nav_menu( 'main_nav', __( 'Main Menu' ) );
  register_nav_menu( 'footer_nav', __( 'Footer Menu' ) );
  register_nav_menu( 'top_nav', __( 'Top Menu' ) );

  $menus = array(
    array(
      'name' => 'Main Nav',
      'slug' => 'main_nav'
    ),
    array(
      'name' => 'Footer Nav',
      'slug' => 'footer_nav'
    ),
    array(
      'name' => 'Top Nav',
      'slug' => 'top_nav'
    ),
  );

  foreach ( $menus as $menu ) {

    // Check if the menu exists
    $menu_exists = wp_get_nav_menu_object( $menu['name'] );

    // If it doesn't exist, let's create it.
    if ( ! $menu_exists ) {

      $menu_id = wp_create_nav_menu( $menu['name'] );

      $locations                  = get_theme_mod( 'nav_menu_locations' );
      $locations[ $menu['slug'] ] = $menu_id;
      set_theme_mod( 'nav_menu_locations', $locations );

    }
  }

}

add_action( 'init', 'register_nav' );

// ==========================================================================
//    WIDGETS
// ==========================================================================
function register_widget_area() {
  register_sidebar( array(
    'name'          => 'Blog Sidebar',
    'id'            => 'blog-sidebar',
    'before_widget' => '<div class="sidebar__blog  %2$s ">',
    'after_widget'  => '</div><!--sidebar--block-->',
    'before_title'  => '<h2 class="sidebar__title text-uppercase">',
    'after_title'   => '</h2><div class="sidebar__content">',
  ) );
		register_sidebar( array(
			'name'          => 'Faq Sidebar',
			'id'            => 'faq-sidebar',
			'before_widget' => '<div class="sidebar__faq  %2$s ">',
			'after_widget'  => '</div><!--sidebar--block-->',
			'before_title'  => '<h2 class="sidebar__title text-uppercase">',
			'after_title'   => '</h2><div class="sidebar__content">',
		) );
	register_sidebar( array(
			'name'          => 'GD Sidebar',
			'id'            => 'gd-sidebar',
			'before_widget' => '<div class="sidebar__gd  %2$s ">',
			'after_widget'  => '</div><!--sidebar--block-->',
			'before_title'  => '<h2 class="sidebar__title text-uppercase">',
			'after_title'   => '</h2><div class="sidebar__content">',
	) );
  /* Added to add new widget for search on the top 
  register_sidebar( array(
    'name'          => 'Top Search',
    'id'            => 'top-search',
  ) );*/
}

add_action( 'widgets_init', 'register_widget_area' );

/* Added to remove the title from the widgets 
add_filter('widget_title','my_widget_title'); 
function my_widget_title($t)
{
    return null;
}
*/

// ==========================================================================
//    CUSTOM ADMIN LOGIN LOGO
// ==========================================================================
function custom_login_logo() {
  echo '<style type="text/css">
    .login h1 a { background-image: url(' . get_bloginfo( 'template_directory' ) . '/images/logo-main.svg); background-size: 100%; width: 100%;}
    </style>';
}

add_action( 'login_head', 'custom_login_logo' );


// ==========================================================================
//  RESET SOME WORDPRESS DEFAULTS
// ==========================================================================

