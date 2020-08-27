<?php
/**
 * esaweb functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package esaweb
 */

if ( ! function_exists( 'esaweb_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function esaweb_setup() {
		/*
				 * Make theme available for translation.
				 * Translations can be filed in the /languages/ directory.
				 * If you're building a theme based on esaweb, use a find and replace
				 * to change 'esaweb' to the name of your theme in all the template files.
				 */
		load_theme_textdomain( 'esaweb', get_template_directory() . '/languages' );

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

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'esaweb_setup' );


$theme_includes = [
		'lib/theme_support.php',
		'lib/aq_resizer.php',
		'lib/acf_layout.php',
		'lib/acf_customization.php',
		'lib/custom_post_types.php',
		'lib/custom_toolbar.php',
		'lib/hex2rgba.php',
		'lib/shortcodes.php',
		'lib/setup.php',
		'lib/integration.php',
		'lib/breadcrumbs.php',
		'lib/category_images.php',
];


foreach ( $theme_includes as $file ) {
	if ( ! $filepath = locate_template( $file ) ) {
		trigger_error( sprintf( __( 'Error locating %s for inclusion' ), $file ), E_USER_ERROR );
	}

	require_once $filepath;
}
unset( $file, $filepath );



/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}



//function my_nav_wrap() {
//  // default value of 'items_wrap' is <ul id="%1$s" class="%2$s">%3$s</ul>'
//
//  // open the <ul>, set 'menu_class' and 'menu_id' values
//  $wrap  = '<ul id="%1$s" class="%2$s">';
//
//
//  // the static link
//  $wrap .= '<li><a rel="nofollow" class="active">FOR</a></li>';
//
//  // get nav items as configured in /wp-admin/
//  $wrap .= '%3$s';
//
//  // close the <ul>
//  $wrap .= '</ul>';
//  // return the result
//  return $wrap;
//}

function check_file_exits($filename){
	$file_headers = @get_headers($filename);
	if($file_headers[0] == 'HTTP/1.0 404 Not Found' || $file_headers[0] == 'HTTP/1.1 301 Moved Permanently' ){
		return false;
	} else if ($file_headers[0] == 'HTTP/1.0 302 Found' && $file_headers[7] == 'HTTP/1.0 404 Not Found'){
		return false;
	} else {
		return true;
	}
}
/// for faqs custom post type
function my_cptui_change_posts_per_page( $query ) {
	if ( is_admin() || ! $query->is_main_query() ) {
		return;
	}

	if ( is_post_type_archive( 'faqs' ) ) {
		$query->set( 'posts_per_page', 9999 );
	}
}
add_filter( 'pre_get_posts', 'my_cptui_change_posts_per_page' );

/// For Companies CPT
function my_cptui_change_places_posts_per_page( $query ) {
	if ( is_admin() || ! $query->is_main_query() ) {
		return;
	}

	if ( is_post_type_archive( 'gd_place' ) ) {
		$query->set( 'posts_per_page', 30 );
	}
}
add_filter( 'pre_get_posts', 'my_cptui_change_places_posts_per_page' );


// Added to extend allowed files types in Media upload
add_filter('upload_mimes', 'custom_upload_mimes');
function custom_upload_mimes ( $existing_mimes=array() ) {

// Add *.EPS files to Media upload
	$existing_mimes['eps'] = 'application/postscript';

	return $existing_mimes;
}

remove_filter('template_redirect', 'redirect_canonical');

/*
 * This changes the event link to the event website URL if that is set.
 */
function tribe_set_link_website ( $link, $postId ) {
	$website_url = tribe_get_event_website_url( $postId );
	// Only swaps link if set
	if ( !empty( $website_url ) ) {
		$link = $website_url;
	}
	return $link;
}
add_filter( 'tribe_get_event_link', 'tribe_set_link_website', 100, 2 );


////Rename default post to news
function revcon_change_post_label() {
	global $menu;
	global $submenu;
	$menu[5][0] = 'News';
	$submenu['edit.php'][5][0] = 'News';
	$submenu['edit.php'][10][0] = 'Add News';
	$submenu['edit.php'][16][0] = 'News Tags';
}
function revcon_change_post_object() {
	global $wp_post_types;
	$labels = &$wp_post_types['post']->labels;
	$labels->name = 'News';
	$labels->singular_name = 'News';
	$labels->add_new = 'Add News';
	$labels->add_new_item = 'Add News';
	$labels->edit_item = 'Edit News';
	$labels->new_item = 'News';
	$labels->view_item = 'View News';
	$labels->search_items = 'Search News';
	$labels->not_found = 'No News found';
	$labels->not_found_in_trash = 'No News found in Trash';
	$labels->all_items = 'All News';
	$labels->menu_name = 'News';
	$labels->name_admin_bar = 'News';
}

add_action( 'admin_menu', 'revcon_change_post_label' );
add_action( 'init', 'revcon_change_post_object' );

/**
 * Sets a cookie for popup shown once in a day.
 */
// function set_cookie() {
// 	$cookie_value = date('F j, Y g:i a');
// 	print_r($_COOKIE);
// 	if ( !isset($_COOKIE['popup']) && !is_user_logged_in() ) {

// 		setcookie('popup', $cookie_value, time()+86400, '/', 'esaweb.org');
// 	}
// }
// add_action( 'init', 'set_cookie' );


// Allow subscribers to see Private posts and pages

$subRole = get_role( 'subscriber' );
$subRole->add_cap( 'read_private_posts' );
$subRole->add_cap( 'read_private_pages' );

add_action('init', 'remove_admin_bar');

function remove_admin_bar() {
	if (current_user_can('subscriber') && !is_admin()) {
		show_admin_bar(false);
	}
}

// Hide Grid View layout in geodirectory

function gd_snippet_240619_layout_options( $layouts, $frontend ) {
	if ( $frontend ) {
		//unset( $layouts["0"] ); // Hide List view
		unset( $layouts["1"] ); // Hide Grid View (One Column)
		//unset( $layouts["2"] ); // Hide Grid View (Two Columns)
		//unset( $layouts["3"] ); // Hide Grid View (Three Columns)
		unset( $layouts["4"] ); // Hide Grid View (Four Columns)
		unset( $layouts["5"] ); // Hide Grid View (Five Columns)
	}

	return $layouts;
}
add_filter( 'geodir_layout_options', 'gd_snippet_240619_layout_options', 10, 2 );

/**
 * Sets a cookie for popup shown once in a day.
 */

add_action( 'wp_enqueue_scripts', 'sg_scripts' );
function sg_scripts() {

	$current_slug = time();
	wp_enqueue_script( 'sg_custom_js', get_template_directory_uri() . '/js/custom-cookie.php?slug=' . $current_slug);

}





function custom_meta_box_markup($object)
{
	wp_nonce_field(basename(__FILE__), "meta-box-nonce");

	?>
	<div>
		<label for="meta-box-text">Text</label>
		<input name="meta-box-text" type="text" value="<?php echo get_post_meta($object->ID, "meta-box-text", true); ?>">

		<br>

		<label for="meta-box-dropdown">Dropdown</label>
		<select name="meta-box-dropdown">
			<?php
			$option_values = array(1, 2, 3);

			foreach($option_values as $key => $value)
			{
				if($value == get_post_meta($object->ID, "meta-box-dropdown", true))
				{
					?>
					<option selected><?php echo $value; ?></option>
					<?php
				}
				else
				{
					?>
					<option><?php echo $value; ?></option>
					<?php
				}
			}
			?>
		</select>

		<br>

		<label for="meta-box-checkbox">Check Box</label>
		<?php
		$checkbox_value = get_post_meta($object->ID, "meta-box-checkbox", true);

		if($checkbox_value == "")
		{
			?>
			<input name="meta-box-checkbox" type="checkbox" value="true">
			<?php
		}
		else if($checkbox_value == "true")
		{
			?>
			<input name="meta-box-checkbox" type="checkbox" value="true" checked>
			<?php
		}
		?>
	</div>
	<?php
}
